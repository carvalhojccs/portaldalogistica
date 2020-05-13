@extends('adminlte::page')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Cadastrar  linhas de crédito
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route(request()->segment(2).'.index') }}">Linha de crédito</a></li>
                <li class="breadcrumb-item active"><a href="#">Cadastrar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <form action="{{ route(request()->segment(2).'.store') }}" class="form" method="POST">
        @csrf
        <div class="card-body">
            @include('admin.'.request()->segment(2).'._partials.form')
        </div>
        @include('admin.includes.btn_create')
    </form>
</div>
@stop