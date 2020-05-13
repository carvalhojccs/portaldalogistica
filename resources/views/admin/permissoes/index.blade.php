@extends('adminlte::page')
@section('title','Portal da Logística')
@section('content_header')
@include('admin.includes.breadcrumb_index')
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
            @include('admin.papeis._partials.search')
        <div class="card">
            <div class="card-header">
            <a href="{{ route(request()->segment(2).'.create') }}" class="btn btn-sm btn-success"><i class="fa fa-file"></i><span>&nbsp;&nbsp;</span><span>Novo</span></a>
        </div>
            <div class="card-body">
                @include('admin.includes.alerts')
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Permissão</th>
                            <th>Descrição</th>
                            <th>Última Alteração</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->descricao }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}</td>
                            <td>
                            <a href="{{ route(request()->segment(2).'.show', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye">&nbsp;</i>Detalhes</a>
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td><h3>Nenhum item encontrado!</h3></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                @include('admin.includes.links')
            </div>
        </div>
    </div>
</div>
@stop