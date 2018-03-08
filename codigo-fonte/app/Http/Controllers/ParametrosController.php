<?php
/* @var Controller $this */

namespace App\Http\Controllers;

//Base do controlador
use App\Http\Controllers\Controller; //Base do controlador
use Illuminate\Http\Request; //Controle de dados por request
use App\Http\Requests\ParametrosFormRequest;
use App\DataTables\ParametrosDataTable as DataTable;

//Modelo da controller
use App\Models\Parametros; 
use Laracasts\Utilities\JavaScript\JavaScriptFacade as Javascript;

use Response;

/**
 * Controlador dos Planos anuais
 * @author Thiago do Amarante Farias <thiago.farias@jointecnologia.com.br>
 */
class ParametrosController extends Controller {
    
    /**
     * @var Parametros
     */
    protected $model;
    
    /**
     * @var DataTable
     */
    protected $dataTable;
    
    /**
     * ParametrosController constructor.
     * @param Parametros $parametros
     */
    public function __construct(Parametros $parametros, DataTable $dataTable) {
        $this->model = $parametros;
        $this->dataTable = $dataTable;
    }
    
    /**
     * Monta a listagem dos Parametros
     * @param Request $request dados do formulário
     * @return Response
     */
    public function index(Request $request) {
        $this->authorize('PARAMETROS_LISTAR', 'PermissaoPolicy');
        $this->model->setAttributes($request->all());
        
        if (app('request')->isXmlHttpRequest()) {
            $this->dataTable->model = $this->model;
            return $this->dataTable->ajax();
        }
        
        return view('parametros.index', array(
            'model' => $this->model->get(),
            'dataTable' => $this->dataTable->html(),
        ));
    }
    
    /**
     * Consultar dados dos Parametros para construir o datatables
     * @param Request $request
     * @return json
     */
    public function consultar(Request $request) {
        $this->model->setAttributes($request->all());
        return $this->model->consultarDataTables();
    }
    
    /**
     * Mostra o formulário para criar/editar um Parametro
     * @return Response
     */
    public function form(Request $request) {
        $id = $request->route('id');
        $this->model->fill($request->all());
        $model = $this->model;
        
        $dadosFormulario = $request->session()->has('_old_input') ? $request->session()->get('_old_input') : [];
        
        if ($id) {
            $this->authorize('PARAMETROS_EDITAR', 'PermissaoPolicy');
            $model = $this->model->find($id);
            $model->formatAttributes('get');

            if (!$model) {
                $this->setMessage('O Parametro não foi encontrado', 'danger');
                return redirect(url('parametros/index'));
            }
            
            $dadosFormulario = $model->popularDadosFormulario($dadosFormulario);
            
        } else {
            $this->authorize('PARAMETROS_CADASTRAR', 'PermissaoPolicy');
        }
        
        Javascript::put([
            'TIPO_BOOLEAN' => Parametros::TIPO_BOOLEAN,
            'TIPO_DROPDOWN' => Parametros::TIPO_DROPDOWN,
            'TIPO' => (!empty($dadosFormulario) ? $dadosFormulario['tipo'] : ''),
            'VALOR' => (!empty($dadosFormulario) ? $dadosFormulario['valor'] : ''),
        ]);
        
        $dados = [
            'inputLabelRadioTrue' => '',
            'inputLabelRadioFalse' => '',
            'dropdownValor' => [],
            'dropdownNome' => [],
        ];
        
        if (!empty($dadosFormulario)) {
            $dados['inputLabelRadioTrue'] = $dadosFormulario['inputLabelRadioTrue'];
            $dados['inputLabelRadioFalse'] = $dadosFormulario['inputLabelRadioFalse'];
            $dados['dropdownValor'] = $dadosFormulario['dropdownValor'];
            $dados['dropdownNome'] = $dadosFormulario['dropdownNome'];
        }
        
        return view('parametros.form', array(
            'model' => $model,
            'dados' => $dados,
        ));
    }

    /**
     * Salva o Parametro
     * @param $request ajusta os dados que vem do formulário
     * @return Response
     */
    public function save(ParametrosFormRequest $request) {
        $this->model->setAttributes($request->all());
        $this->model->formatAttributes('save');
        
        $return = $this->model->salvar();
        $this->setMessage($return['msg'], $return['status']);
        
        if ($return['status'] == 'danger') {
            return \Illuminate\Support\Facades\Redirect::back()->withInput();
        }
        
        return redirect(url('parametros/index'));
    }

    /**
     * Mostra o detalhe
     * @param  int $id Identificador do Parametro
     * @return Response
     */
    public function show($id) {
        $this->authorize('PARAMETROS_DETALHAR', 'PermissaoPolicy');
        $model = Parametros::find($id);
        $model->formatAttributes('get');
        
        if (!$model) {
            $this->setMessage('O Parametro não foi encontrado', 'danger');
            return redirect(url('parametros/index'));
        }
        
        $model->buscarValorPorTipo();
        
        return view('parametros.show', ['model' => $model]);
    }

    /**
     * Ação de destruir/excluir um Parametro
     * @param integer $id
     * @return Response::json
     */
    public function destroy($id) {
        $model = $this->model->find($id);

        if ($model->tipo == $model::TIPO_DROPDOWN || $model->tipo == $model::TIPO_BOOLEAN) {
            \App\Models\ParametroValoresTipos::where('parametro_id', $id)->delete();
        }
        
        $model->findOrFail($id)->delete();
        
        return Response::json(array(
            'success' => true,
            'msg' => 'O Parametro foi excluido com sucesso!',
        ));
    }
    
    /**
     * Lista de parâmetros para configurar
     * @return Response::json
     */
    public function configurar() {
        $this->authorize('PARAMETROS_LISTAR', 'PermissaoPolicy');
        return view('parametros.configurar', ['model' => $this->model]);
    }
    
    /**
     * Altera o valor do parâmetro.
     */
    public function alterarValor(Request $request) {
        
        $dados = $request->all();
        $status = 'success';
        $msg = 'Parâmetro alterado com sucesso.';
        
        if (!$this->model->find($dados['id'])->update(['valor' => $dados['valor']])) {
            $status = 'danger';
            $msg = 'Erro ao editar a permissão.';
        }
        
        return Response::json(array(
            'success' => $status,
            'msg' => $msg,
        ));
    }
}
