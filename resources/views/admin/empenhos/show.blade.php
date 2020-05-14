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
                <td style="width: 130px;" class="align-middle"><button class="btn btn-primary"><strong>Itens Empenho</strong></button></td>
                <td colspan="5">
                    <table class="table table-borderless table-sm">
                        <tr><td>item01</td> </tr>
                        <tr><td>item01</td> </tr>
                        <tr><td>item01</td> </tr>
                        <tr><td>item01</td> </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 130px;"><strong>Valor Solicitado</strong></td>
                <td colspan="5">{{ $data->valor_solicitacao }}</td>
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