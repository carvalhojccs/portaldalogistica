@extends('adminlte::page')
@section('content_header')
@include('admin.includes.alerts')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem dos usuários
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Usuários</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-body">
        @include('admin.users._partials.search')
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="{{ route(request()->segment(2).'.create') }}" class="btn btn-success btn-sm"><i class="fas fa-file">&nbsp;</i>Novo</a>
    </div>
    <div class="card-body">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Local</th>
                    <th style="text-align: right">Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->local->sigla }}</td>
                    <td style="text-align: right"><a href="{{ route(request()->segment(2).'.show', $item->id) }}" class="btn btn-primary btn-sm">Detalhes</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="3"><div class="container-fluid">Nenhum cadastro encontrato</div></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @include('admin.includes.links')
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/vendor/toastr/css/toastr.min.css') }}">
@stop
@section('js')
<script src="{{ asset('/vendor/toastr/js/toastr.min.js') }}"></script>
@stop
