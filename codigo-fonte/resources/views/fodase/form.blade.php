@extends('layout.master')
@section('conteudo')

{!! LayoutBuilder::gerarBreadCrumb([
    'Início' => url('default/index'),
    'Lista de Fodases' => url('fodase/index'),
    'Cadastrar Fodase',
]) !!}

@section('javascript')
{!! Html::script('resources/assets/js/fodase/form.js') !!}
@stop

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12">
        
        @include('layout.erros')
        
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-sharp bold uppercase">{{ $model->id ? 'Atualizar': 'Cadastrar' }} Fodase</span>
                </div>
            </div>
            <div class="portlet-body form">
                    {{ Form::open(['id' => 'model_form', 'method' => 'post', 'url' => url('fodase/save'), 'class' => 'form-horizontal']) }}
                    <div class="form-body">
                        
                        <input type="hidden" name="id" class="model_id" value="{{ $model->id }}">
                        
                        <div class="col-md-12">
                            <fieldset>
                                    <div class="col-sm-6">
                                        <div class="form-body {{ $errors->first("nome", "has-error") }}">
                                            <label class="control-label">{{ $model->labels['nome'] }}  <span class="request">*</span>:</label>
                                            {{ Form::text('nome', $model->nome, ['data-required' => 1,'aria-required' => 'true' ,'class' => 'form-control  ', 'placeholder' => '']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-body {{ $errors->first("carro", "has-error") }}">
                                            <label class="control-label">{{ $model->labels['carro'] }}  <span class="request">*</span>:</label>
                                            {{ Form::select('carro', $model::$carros, $model->carro, ['data-required' => 1, 'aria-required' => 'true' ,'class' => 'form-control select2']) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-body {{ $errors->first("teste", "has-error") }}">
                                            <label class="control-label">{{ $model->labels['teste'] }}  :</label>
                                            {{ Form::text('teste', $model->teste, ['data-required' => 1,'aria-required' => 'true' ,'class' => 'form-control maskCpf ', 'placeholder' => '']) }}
                                        </div>
                                    </div>
                                       
                            </fieldset>    
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::button('Salvar', ['type' => 'submit', 'class' => 'btn blue salvarForm']) }}
                            <a href="{{ url('fodase/index') }}"><button type="button" class="btn btn-default">Cancelar</button></a>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection

