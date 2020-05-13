@extends('adminlte::page')
@section('content_header')
@include('admin.includes.breadcrumb_create')
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cadastro</h3>
            </div>
            <div class="card-body">
                {{ Form::open(['route' => request()->segment(2).'.store','class' => 'form']) }}
                    @include('admin.'.request()->segment(2).'._partials.form')
                
            </div>
            <div class="card-footer">
                {{ Form::button('<i class="fa fa-save"></i> Salvar',['class' => 'btn btn-sm btn-success', 'type' => 'submit']) }}
                <a href="{{ route(request()->segment(2).'.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-backward">&nbsp;</i>Voltar</a>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
