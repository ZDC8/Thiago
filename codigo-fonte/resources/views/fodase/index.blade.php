@extends('layout.master')
@section('conteudo')

{!! LayoutBuilder::gerarBreadCrumb([
    'Início' => url('fodase/index'),
    'Lista de Fodases',
]) !!}

@section('javascript')
{!!Html::script('resources/assets/js/fodase/index.js')!!}
@stop

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        
        @include('layout.erros')
        
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-sharp bold uppercase">Listar Fodase</span>
                </div>
            </div>
            
            @include('fodase.index.search')
            
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group" >
                            <a href="{{ url('fodase/form') }}">
                                <button class="btn sbold layoutBtnColor"> Adicionar
                                    <i class="fa fa-plus"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="portlet-body">
                {!! $dataTable->table(['class' => 'table table-striped table-bordered table-hover order-column', 'id' => 'data_table']) !!}
            </div>
        </div>
    </div>
</div>

@stop
