<?php
namespace App\DataTables;

use App\Models\Fodase;
use App\Http\Helper\Formatar;
//use App\Http\Helper\Util;
use Yajra\Datatables\Services\DataTable;
/**
 * DataTable para o modelo de Fodase * @author Thiago Farias <thiago.amarante.farias@gmail.com>
 */
class FodaseDataTable extends DataTable {
    
    public $model;

    /**
     * Mostra a resposta em ajax
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax() {

        return $this->datatables->of($this->model->consultar())
            ->addColumn('acoes', function ($query) {
                $botoes = [];
                
                if (\Auth::user()->verificarPermissao('FODASE_DETALHAR')) {
                    $botoes[] = '<a  href="' . url('fodase/show', ['id' => $query->id]) . '"><button class="btn btn-default"><i class="fa fa-search"></i></button></a>';
                }
                
                if (\Auth::user()->verificarPermissao('FODASE_EDITAR')) {
                    $botoes[] = '<a  href="' . url('fodase/form', ['id' => $query->id]) . '"><button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>';
                }
                    
                if (\Auth::user()->verificarPermissao('FODASE_EXCLUIR')) {
                    $botoes[] = '<a  href="#devNull" class="destroyTr" data-rel="' . $query->id . '" ><button class="btn btn-danger"><i class="fa fa-times"></i></button></a>';
                }
                
                return implode('', $botoes);
            })
            
            ->editColumn('carro', function ($query) {
                return ($query->carro ? $query::$carros[$query->carro] : '');
            })
            ->make(true);
            
    }

    /**
     * Pega a consulta em objeto para ser processada pelo DataTables
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query() {} //Não está sendo utilizado pela necessidade dos filtros

    /**
     * Método opcional se você quiser usar o construtor de HTML
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html() {
    return $this->builder()
                ->columns($this->getColumns())
                ->ajax([])
                ->parameters($this->getBuilderParameters());
    }

    /**
     * Pega as colunas
     * @return array
     */
    protected function getColumns() {
    
        return [
            [
                'name' => 'nome',
                'title' => $this->model->labels['nome'],
                'style' => 'width:20%',
            ],
            [
                'name' => 'carro',
                'title' => $this->model->labels['carro'],
                'style' => 'width:20%',
            ],
            [
                'name' => 'teste',
                'title' => $this->model->labels['teste'],
                'style' => 'width:20%',
            ],
            [
                'name' => 'acoes',
                'title' => 'Ações',
                'style' => 'width:20%',
            ]
        ];
    }

    /**
     * Pega o nome do arquivo para exportanção
     * @return string
     */
    protected function filename() {
        return 'fodase_' . time();
    }
}
