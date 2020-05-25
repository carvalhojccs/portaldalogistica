@extends('adminlte::page')
@section('content_header')
@include('admin.includes.alerts')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Listagem das {{ request()->segment(2) }}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Rrequisições do Item</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        {{ $autorizacoes->first()->itemEmpenho->empenho->empenho }} > {{ $autorizacoes->first()->itemEmpenho->descricao }} 
    </div>
    <div class="card-body">
        @foreach($autorizacoes as $autorizacao)
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th style="width: 150px;">Autorização</th>
                    <th colspan="2"><button 
                                        class="btn btn-success btn-sm adicionaRequisicao" 
                                        id="btnAdicionarRequisicao"
                                        data-itemEmpenhoAutorizadoId='{{ $autorizacao->id }}'
                                        >Adicionar requisição</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="align-middle">{{ $autorizacao->autorizado }}</td>
                    <td>
                        <table class="table table-sm table-bordered">
                            <tbody>
                                @forelse($autorizacao->requisicoes as $requisicao)
                                <tr>
                                    <td class="align-middle">{{ $requisicao->requisicao }}</td>
                                    <td class="align-middle text-center"  style="width: 100px;">
                                        <button class="btn btn-sm btn-success editarRequisicao" data-requisicaoId='{{ $requisicao->id }}'><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger deletarRequisicao" data-requisicaoId='{{ $requisicao->id }}'><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>Não existe requisição cadastrada para esta autorização!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
            </div>
        </div>
        @endforeach
    </div>
    <div class="card-footer">
        <a href="{{ route('itens_empenhos.index',$autorizacoes->first()->itemEmpenho->empenho->id) }}" class="btn btn-info btn-sm"><i class="fas fa-reply">&nbsp;</i>Voltar</a>
    </div>
</div>
<div id="modalRequisicao" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss='modal'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="alert"></span>
                <form id="formData">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Requisição</label>
                        <input type="hidden" id="item_empenho_autorizado_id" name="item_empenho_autorizado_id">
                        <input type="hidden" id="requisicao_id" name="requisicao_id">
                        <input type="text" name="requisicao" id="requisicao" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type='submit' class="btn btn-primary" id="btnAcao"></button>
                        <button type="button" class="btn btn-default" data-dismiss='modal'>Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.includes.confirm_modal')
@stop
@section('js')
<script>
    $(document).ready(function(){
        var url = "{{ url('admin') }}";
        var route = '';
        var item_empenho_autorizado_id = '';
        var requisicao_id = '';
        
        $('.adicionaRequisicao').on('click',function(e)
        {
            e.preventDefault();
            item_empenho_autorizado_id = $(this).attr('data-itemEmpenhoAutorizadoId');

            $('.modal-title').text('Adicionar uma nova requisição!');
            $('#btnAcao').text('Adicionar');
            $('#item_empenho_autorizado_id').val(item_empenho_autorizado_id);
            $('#modalRequisicao').modal('show');
            $('#modalRequisicao').on('shown.bs.modal',function(){
                $('#requisicao').focus();
            });
        });
        
        $('.editarRequisicao').on('click',function(e){
            e.preventDefault();
            requisicao_id = $(this).attr('data-requisicaoId');
            
            $.ajax({
               url: url + '/requisicoes/' + requisicao_id + '/edit',
               dataType: 'json',
               success: function(response)
               {
                    $('#requisicao').val(response.result.requisicao);
                    $('#requisicao_id').val(requisicao_id);
                    $('.modal-title').text('Editar requisição!');
                    $('#btnAcao').text('Editar');
                    $('#modalRequisicao').modal('show');
                    $('#modalRequisicao').on('shown.bs.modal',function(){
                        $('#requisicao').focus();
                    });
               }
            });
        });
        
        $('#btnAcao').on('click',function(e)
        {
            e.preventDefault();
            if($('#btnAcao').text() == 'Adicionar')
            {
                route = "{{ route('requisicoes.store') }}";
            }
            
            if($('#btnAcao').text() == 'Editar')
            {
                route = "{{ route('requisicoes.update') }}";
            }
            
            $.ajax({
                url: route,
                type: "post",
                data: $('#formData').serialize(),
                dataType: "json",
                success: function(response)
                {
                    var html ='';
                    
                    if(response.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var i = 0; i < response.errors.length; i++)
                        {
                            html += '<p>' + response.errors[i] + '</p>';
                        }
                        html += '</div>';
                        $('#requisicao').focus();
                    }

                    if(response.success)
                    {
                        $('#formData')[0].reset();
                        html += '<div class="alert alert-success">' + response.success + '</div>';
                    }

                    $('#alert').html(html);
                    
                }
            });
            
            
        });
        
        $('.deletarRequisicao').on('click',function(){
            requisicao_id = $(this).attr('data-requisicaoId');
            
            $('#confirmModal').modal('show');
        });
        
        $('#btnOk').on('click', function(){
            console.log('Id: ' + requisicao_id);
            
            $.ajax({
                url: url + '/requisicoes/destroy/' + requisicao_id,
                
                beforeSend: function()
                {
                    $('#btnOk').text('Deletando...');
                },
                success: function(response)
                {
                    setTimeout(function()
                    {
                        $('#confirmModal').modal('hide');
                    }, 2000);
                }
            });
        });
        
        
        
        $('#modalRequisicao').on('hidden.bs.modal',function(){
            window.location.href = "{{ route('requisicoes.index',$autorizacoes->first()->itemEmpenho->id) }}";
        });
        
        $('#confirmModal').on('hidden.bs.modal',function(){
            window.location.href = "{{ route('requisicoes.index',$autorizacoes->first()->itemEmpenho->id) }}";
        });
    });
</script>
@stop