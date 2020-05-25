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
    <div class="card-header">
        <a href="{{ route('itens_empenhos.index', $data->id) }}" class="btn btn-primary">Adicionar itens no empenho</a>
    </div>
    <div class="card-body">
        <table class="table text-nowrap table-bordered table-sm">
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
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ route('empenhos.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
    </div>
</div>
@stop
