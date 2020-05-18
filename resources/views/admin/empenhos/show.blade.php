@extends('adminlte::page')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Detalhes do {{ ucfirst(Util::p2s(request()->segment(2))) }}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route(request()->segment(2).'.index') }}">{{ ucfirst(request()->segment(2)) }}</a></li>
                <li class="breadcrumb-item active"><a href="#">Detalhes</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table text-nowrap table-bordered">
            <tr>
                <td style="width: 130px;"><strong>Tipo Item</strong></td>
                <td colspan="5">{{ $data->tipoItem->nome }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Processo</strong></td>
                <td colspan="5">{{ $data->processo }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Empresa</strong></td>
                <td>{{ $data->empresa->nome }}</td>
                <td style="width: 130px;"><strong>CNPJ</strong></td>
                <td colspan="3">{{ $data->empresa->cnpj }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Fonte</strong></td>
                <td>{{ $data->linhaCredito->fonte }}</td>
                <td style="width: 130px;"><strong>PI</strong></td>
                <td>{{ $data->linhaCredito->pi }}</td>
                <td style="width: 130px;"><strong>Natureza</strong></td>
                <td>{{ $data->natureza->natureza }}</td>
            </tr>
            <tr>
                <td style="width: 130px;" class="align-middle"><button class="btn btn-primary" data-toggle="modal" data-target="#formModal"><strong>Itens Empenho</strong></button></td>
                <td colspan="5">
                    <table class="table  table-hover table-sm table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>V. Unit</th>
                                <th>V. Total</th>
                                <th>Status</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        @forelse($data->itensEmpenhos as $itemEmpenho)
                        <tr class="text-uppercase">
                            <td>{{ $itemEmpenho->descricao }}</td>
                            <td>{{ $itemEmpenho->quantidade }}</td>
                            <td>R$ {{ number_format($itemEmpenho->valor,2,',','.') }}</td>
                            <td>R$ {{ number_format(($itemEmpenho->valor * $itemEmpenho->quantidade),2,',','.') }}</td>
                            <td>{{ $itemEmpenho->statusItemEmpenho->status }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm editar" value="{{ $itemEmpenho->id }}">Editar</button>
                                <button class="btn btn-danger btn-sm deletar" value="{{ $itemEmpenho->id }}">Deletar</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6">Enhum item cadastrado!</td></tr>
                        @endforelse
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Valor Solicitado</strong></td>
                <td colspan="5">R$ {{ number_format($data->valor_solicitacao,2,',','.') }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Data Solicitação</strong></td>
                <td colspan="5">{{ $data->data_solicitacao }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Solicitação</strong></td>
                <td colspan="5">{{ $data->solicitacao }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Status</strong></td>
                <td colspan="5">{{ $data->statusEmpenho->status }}</td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Saldo</strong></td>
                <td colspan="5">R$ 1.000,00</td>
            </tr>
            <tr>
                <td style="width: 130px;" class="align-middle"><button class="btn btn-primary"><strong>Orçamentos</strong></button></td>
                <td colspan="5">
                    <table class="table table-borderless table-sm">
                        <tr><td>OS 001</td> </tr>
                        <tr><td>OS 002</td> </tr>
                        <tr><td>OS 003</td> </tr>
                    </table>
                </td>
            </tr>
        </table>

        @include('admin.empenhos.modais.action_modal')
        @include('admin.empenhos.modais.confirm_modal')
        
    </div>
</div>
@stop
@include('admin.empenhos.modais.ajax')