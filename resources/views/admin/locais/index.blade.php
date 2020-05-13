@extends('adminlte::page')
@section('content_header')
@include('admin.includes.alerts')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem dos {{ request()->segment(2) }}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">{{ ucfirst(Util::p2s(request()->segment(2))) }}</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-body">
        <form action="{{ route(request()->segment(2).'.search') }}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="nome" placeholder="Nome do Local" class="form-control-sm" value="{{ $filters['nome'] ?? '' }}">
            <input type="text" name="sigla" placeholder="Sigla do Local" class="form-control-sm" value="{{ $filters['sigla'] ?? '' }}">
            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search">&nbsp;</i>Pesquisar</button>
            @if(isset($filters))
            <a href="{{ route(request()->segment(2).'.index') }}" class="btn btn-dark btn-sm"><i class="fas fa-sync"></i></a>
            @endif
        </form>
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
                    <th>Sigla</th>
                    <th style="text-align: right">Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->sigla }}</td>
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
        @if(isset($filters))
            {{ $data->appends($filters)->links() }}
        @else
            {{ $data->links() }}
        @endif
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/vendor/toastr/css/toastr.min.css') }}">
@stop
@section('js')
<script src="{{ asset('/vendor/toastr/js/toastr.min.js') }}"></script>
@stop
