@extends('adminlte::page')
@section('content_header')
@include('admin.includes.alerts')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem das linhas de crédito
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Linhas de crédito</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route(request()->segment(2).'.create') }}" class="btn btn-success btn-sm"><i class="fas fa-file">&nbsp;</i>Novo</a>
    </div>
    <div class="card-body">
        <div class="alert alert-success d-none" id="sucesso"></div>
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>PI</th>
                    <th>PTRES</th>
                    <th>Fonte</th>
                    <th style="text-align: right">Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->pi }}</td>
                    <td>{{ $item->ptres }}</td>
                    <td>{{ $item->fonte }}</td>
                    <td style="text-align: right"><a href="{{ route(request()->segment(2).'.show', $item->id) }}" class="btn btn-primary btn-sm">Detalhes</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Nenhum cadastro encontrado!</td>
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
