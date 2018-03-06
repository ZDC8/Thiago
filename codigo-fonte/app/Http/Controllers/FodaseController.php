<?php
/* @var Controller $this */
namespace App\Http\Controllers;

//Base do controlador
use App\Http\Controllers\Controller;
use App\Http\Requests\FodaseFormRequest;
use App\DataTables\FodaseDataTable as DataTable;
use Illuminate\Http\Request;
use Response;

//Modelo da controller
use App\Models\Fodase; 

/**
 * Controlador Fodase
 *
 * @author Thiago Farias <thiago.amarante.farias@gmail.com>
 */
class FodaseController extends Controller {

    /**
     * @var Model Fodase
     */
    protected $model;
    
    /**
     * @var DataTable
     */
    protected $dataTable;
    
    /**
     * FodaseController constructor.
     * @param Fodase $fodase
     */
    public function __construct(Fodase $fodase, DataTable $dataTable) {
        $this->model = $fodase;
        $this->dataTable = $dataTable;
    }
    
    /**
     * Monta a listagem dos Fodase
     * @param Request $request dados do formulário
     * @return Response
     */
    public function index(Request $request) {
        $this->authorize('FODASE_LISTAR', 'PermissaoPolicy');
        $this->model->fill($request->all());
        $this->dataTable->model = $this->model;
        
        if (app('request')->isXmlHttpRequest()) {
            return $this->dataTable->ajax();
        }
        
        return view('fodase.index', array(
            'model' => $this->model,
            'dataTable' => $this->dataTable->html(),
        ));
    }
        
    /**
     * Consultar dados dos Fodases para construir o datatables
     * @param Request $request
     * @return json
     */
    public function consultar(Request $request) {
        $this->model->fill($request->all());
        return $this->model->consultarDataTables();
    }
        
    /**
     * Mostra o formulário para criar/editar um Fodase
     * @return Response
     */    
    public function form(Request $request) {
        $id = $request->route('id');
        $this->model->setAttributes($request->all()); 
        $model = $this->model;
        
        if ($id) {
            $this->authorize('FODASE_EDITAR', 'PermissaoPolicy');
            $model = $this->model->find($id);
            $model->formatAttributes('get');
        
            if (!$model) {
                $this->setMessage('O Fodase não foi encontrado', 'danger');
                return redirect(url('Fodase/index'));
            }
        } else {
            $this->authorize('FODASE_CADASTRAR', 'PermissaoPolicy');
        }
        
        return view('fodase.form', array(
            'model' => $model,
        ));
    }
    
    /**
     * Salva o Fodase     * @param $request ajusta os dados que vem do formulário
     * @return Response
     */
    public function save(FodaseFormRequest $request) {
        $this->model->fill($request->all());
        
        
        if (!empty($this->model->id)) {
            $alterar = $this->model->find($this->model->id);
    
            if (empty($alterar) || is_null($alterar)) {
                $this->setMessage('O Fodase a ser alterado não existe no banco de dados!', 'danger');    
            } else {
                $this->setMessage('O Fodase foi alterado com sucesso!', 'success');    
                $alterar->update($this->model->toArray());
            }
        } else {
            $this->model->create($this->model->toArray());
            $this->setMessage('O Fodase foi salvo com sucesso!', 'success');
        }
        
        return redirect(url('Fodase/index'));
    }
    
    /**
     * Mostra o detalhe do Fodase     * @param  int $id Identificador
     * @return Response
     */
    public function show($id) {
        $this->authorize('FODASE_DETALHAR', 'PermissaoPolicy');
        $model = $this->model->find($id);
        
        if (!$model) {
            $this->setMessage('O Fodase não foi encontrado', 'danger');
            return redirect(url('Fodase/index'));
        }
        
        return view('fodase.show', [
            'model' => $model,
        ]);
    }

    /**
     * Ação de destruir/excluir um Fodase
     *
     * @param integer $id
     * @return Response::json
     */
    public function destroy($id) {
        $model = $this->model->find($id);

        $model->findOrFail($id)->delete();
        
        return Response::json(array(
            'success' => true,
            'msg' => 'O Fodase foi excluido com sucesso!',
        ));
    }
}
