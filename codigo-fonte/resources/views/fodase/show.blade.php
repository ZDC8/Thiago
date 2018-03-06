@extends('layout.master')
@section('conteudo')
@include('layout.erros')

{!! LayoutBuilder::gerarBreadCrumb([
    'Início' => url('default/index'),
    'Lista de Fodases' => url('fodase/index'),
    'Visualizar Fodase'
]) !!}

@section('javascript')
{!! Html::script('resources/assets/js/fodase/show.js') !!}
@stop

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        
        @include('layout.erros')
        
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-sharp bold uppercase">Visualizar Fodase</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="col-md-12">
                    <fieldset>
      
                        <div class="col-sm-6">
                            <div class="form-body">
                                <label class="control-label">{{ $model->labels['nome'] }}</label>
        <div class="form-control">{{ $model->nome }}</div>
                                
                            </div>
                        </div>
      
                        <div class="col-sm-6">
                            <div class="form-body">
                                <label class="control-label">{{ $model->labels['carro'] }}</label>
        <div class="form-control">{{ $model->carro }}</div>
                                
                            </div>
                        </div>
      
                        <div class="col-sm-6">
                            <div class="form-body">
                                <label class="control-label">{{ $model->labels['teste'] }}</label>
        <div class="form-control">{{ $model->teste }}</div>
                                
                            </div>
                        </div>

                    </fieldset>    
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url('fodase/index') }}"><button type="button" class="btn btn-default">Voltar</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
