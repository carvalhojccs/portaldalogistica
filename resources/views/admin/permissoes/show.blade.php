@extends('adminlte::page')
@section('title','Portal da Logística')
@section('content_header')
@include('admin.includes.breadcrumb_show')
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalhes do permissão</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Permissão</th>
                            <th>Descrição</th>
                            <th>Última Alteração</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->nome }}</td>
                            <td>{{ $data->descricao }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                @include('admin.includes.btn_show')
            </div>
        </div>
    </div>
</div>
@stop
