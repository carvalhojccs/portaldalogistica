@extends('adminlte::page')
@section('content_header')

<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem dos itens do empenho <strong>{{ $empenho->empenho }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Itens do empenho</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card card-primary">
    <div class="card-body">
        #FormSearch
    </div>
</div>
@include('admin.includes.alerts')
<div class="card">
    <div class="card-header">
        <button class="btn btn-success btn-sm" id="btnNovoItem"><i class="fas fa-file">&nbsp;</i>Novo item</button>
    </div>
    <div class="card-body table-responsive">
        <table class="table  table-hover table-sm table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>V. Unit</th>
                                <th>V. Total</th>
                                <th>Autorizado</th>
                                <th>Saldo</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        @forelse($data as $itemEmpenho)
                        <tr class="text-uppercase">
                            <td class="text-center">
                                <button class="btn btn-success btn-sm editarItemEmpenho" value="{{ $itemEmpenho->id }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm deletarItemEmpenho" value="{{ $itemEmpenho->id }}"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>{{ $itemEmpenho->descricao }}</td>
                            <td class="quantidade">{{ $itemEmpenho->quantidade }}</td>
                            <td>R$ {{ number_format($itemEmpenho->valor,2,',','.') }}</td>
                            <td>R$ {{ number_format(($itemEmpenho->valor * $itemEmpenho->quantidade),2,',','.') }}</td>
                            <td>{{ $itemEmpenho->ItensEmpenhoAutorizados->sum('autorizado') }}</td>
                            <td>{{ $itemEmpenho->quantidade - $itemEmpenho->ItensEmpenhoAutorizados->sum('autorizado') }}</td>
                            <td class="text-center">
                                
                                @if(($itemEmpenho->quantidade - $itemEmpenho->ItensEmpenhoAutorizados->sum('autorizado')) <= 0)
                                <button class="btn btn-info btn-sm" disabled>Autorizar</button>
                                @else
                                <button class="btn btn-info btn-sm autorizar" 
                                        data-qtd='{{ $itemEmpenho->quantidade }}'
                                        data-itemEmpenhoId='{{$itemEmpenho->id}}'
                                        data-saldo='{{ $itemEmpenho->quantidade - $itemEmpenho->ItensEmpenhoAutorizados->sum('autorizado') }}'
                                        value="{{ $itemEmpenho->id }}">Autorizar</button>
                                @endif
                                <a href="{{ route('requisicoes.index',$itemEmpenho->id) }}" class="btn btn-warning btn-sm rm">RM</a>
                                
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6">Enhum item cadastrado!</td></tr>
                        @endforelse
                    </table>
    </div>
    <div class="card-footer">
        <a href="{{ route('empenhos.show',$empenho->id) }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
    </div>
</div>

<div id='modalAutorizar' class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Quantidade a autorizar</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="alert"></span>
                <form method="post" id="formData" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Quantidade</label>
                        <input type="hidden" id="item_empenho_id" name="item_empenho_id">
                        <input type="text" name="autorizado" id="autorizado" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btnAcao"></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.empenhos.modais.item_empenho_modal')
@include('admin.empenhos.modais.aviso_modal')
@include('admin.includes.confirm_modal')
@stop
@include('admin.empenhos.modais.script')
