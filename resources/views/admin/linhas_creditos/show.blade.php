@extends('adminlte::page')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Detalhes da linha de crédito
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route(request()->segment(2).'.index') }}">Linhas de crédito</a></li>
                <li class="breadcrumb-item active"><a href="#">Detalhes</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form class="form-horizontal">
            <fieldset disabled>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">PI</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $data->pi }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">PTRES</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $data->ptres }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Fonte</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $data->fonte }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cadastrado por</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $data->user->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Criado em</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $data->created_at->format('d/m/Y') }}">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="card-footer">
        <form action="{{ route(request()->segment(2).'.destroy', $data->id) }}" id="formDestroy" method="POST">
            @csrf
            @method('DELETE')
            <a href="{{ route(request()->segment(2).'.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
            <a href="{{ route(request()->segment(2).'.edit',$data->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit">&nbsp;</i>Editar</a>
            <button type="submit" class="btn btn-danger btn-sm float-sm-right" id="btnDeletar"><i class="fas fa-trash">&nbsp;</i>Deletar</button>
        </form>
    </div>
</div>
@stop
@section('js')
    <script src="{{ asset('includes/js/confirm.delete.js') }}"></script>
@stop