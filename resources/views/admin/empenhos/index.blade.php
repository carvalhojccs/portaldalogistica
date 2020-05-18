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
        @include('admin.'.request()->segment(2).'._partials.search')
    </div>
</div>
<div class="card">
    <div class="card-header">
        <a href="{{ route(request()->segment(2).'.create') }}" class="btn btn-success btn-sm"><i class="fas fa-file">&nbsp;</i>Novo</a>
    </div>
    <div class="card-body table-responsive ">
        <table class="table table-sm table-bordered text-nowrap">
            <thead>
                <tr>
                    <th>Tipo do item</th>
                    <th>Processo</th>
                    <th>Empresa</th>
                    <th>CNPJ</th>
                    <th>Fonte</th>
                    <th>Plano Interno</th>
                    <th>ND</th>
                    <th>Itens da NE</th>
                    <th>Valor Empenho</th>
                    <th>Data Solicitação</th>
                    <th>Solicitação</th>
                    <th>Status Solicitação</th>
                    <th>Empenho</th>
                    <th>Saldo empenho</th>
                    <th>RM</th>
                    <th style="text-align: right">Detalhe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td class="align-middle">{{ $item->tipoItem->nome }}</td>
                    <td class="align-middle">{{ $item->processo }}</td>
                    <td class="align-middle">{{ $item->empresa->nome }}</td>
                    <td class="align-middle">{{ $item->empresa->cnpj }}</td>
                    <td class="align-middle">{{ $item->linhaCredito->fonte }}</td>
                    <td class="align-middle">{{ $item->linhaCredito->pi }}</td>
                    <td class="align-middle">{{ $item->natureza->natureza }}</td>
                    <td class="align-middle">
                        <table class="table  table-hover table-sm table-borderless">
                        @forelse($item->itensEmpenhos as $itemEmpenho)
                        <tr>
                            <td>{{ $itemEmpenho->descricao }}</td>
                        </tr>
                        @empty
                        <tr><td>Enhum item cadastrado!</td></tr>
                        @endforelse
                    </table>
                    </td>
                    <td class="align-middle">R$ {{ number_format($item->valor_solicitacao,2,',','.') }}</td>
                    <td class="align-middle">{{ Carbon\Carbon::parse($item->data_solicitacao)->format('d/m/Y') }}</td>
                    <td class="align-middle">{{ $item->solicitacao }}</td>
                    <td class="align-middle">{{ $item->statusEmpenho->status }}</td>
                    <td class="align-middle">{{ $item->empenho }}</td>
                    <td class="align-middle">R$ 1.000,00</td>
                    <td class="align-middle">RM001/SDS/2020</td>
                    <td  class="align-middle" style="text-align: right"><a href="{{ route(request()->segment(2).'.show', $item->id) }}" class="btn btn-primary btn-sm">Detalhes</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="17"><div class="container-fluid">Nenhum cadastro encontrato</div></td>
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
