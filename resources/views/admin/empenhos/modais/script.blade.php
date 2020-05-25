@section('js')
<script>
$(document).ready(function () 
{
    var url = "{{ url('admin') }}";
    var route = '';
    var item_empenho_id = '';
    var quantidade = '';
    var saldo = '';

    $('#btnNovoItem').on('click', function(e)
    {
        e.preventDefault();
        
        $('.modal-title').text('Adicionar um novo item ao empenho!');
        $('#btnAcaoItemEmpenho').text('Cadastrar');
        $('#modalAdicionarItemEmpenho').modal('show');
        $('#modalAdicionarItemEmpenho').on('shown.bs.modal', function()
        {
           $('#descricao').focus();
        });
        
    });
    
    $('#btnAcaoItemEmpenho').on('click',function (e)
    {
        e.preventDefault();

        if ($('#btnAcaoItemEmpenho').text() == 'Cadastrar')
        {
            route = "{{ route('itens_empenhos.store') }}";
        }

        if ($('#btnAcaoItemEmpenho').text() == 'Editar') 
        {
            route = "{{ route('itens_empenhos.update') }}";
        }

        $.ajax({
            url: route,
            type: "post",
            data: $('#formItemEmpenho').serialize(),
            dataType: "json",
            success: function (response)
            {
                var html = '';
                if (response.errors)
                {
                    html = '<div class="alert alert-danger"';
                    for (var count = 0; count < response.errors.length; count++)
                    {
                        html += '<p>' + response.errors[count] + '</p>';
                    }
                    html += '</div>';
                }

                if (response.success)
                {
                    $('#formItemEmpenho')[0].reset();
                    $('#descricao').focus();
                    html += '<div class="alert alert-success">' + response.success + '</div>';
                }

                $('#alertItemEmpenho').html(html);
            }
        });
    });

    $('#modalAdicionarItemEmpenho').on('hidden.bs.modal', function () {
        window.location.href = "{{ route('itens_empenhos.index',$empenho->id) }}";
    });

    

    $('.deletarItemEmpenho').on('click', function () {
        item_empenho_id = $(this).val();
        
        $.ajax({
            url: url + "/itens_empenhos/destroy/" + item_empenho_id,
            success: function(response)
            {
                console.log(response);
                if(response.error)
                {
                    $('.avisoVinculo').text(response.error);
                    $('#avisoModal').modal('show');
                }
                else
                {
                    $('#confirmModal').modal('show');
                }
            }
        });

        
    });

    $('#btnOk').on('click', function () {
        $.ajax({
            url: url + "/itens_empenhos/destroy/" + item_empenho_id,

            beforeSend: function () 
            {
                $('#btnOk').text('Deletando...');
            },
            success: function (data) 
            {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    alert('Item deletado!');
                }, 2000);
            }
        });
    });

    $('#confirmModal').on('hidden.bs.modal', function () 
    {
        window.location.href = "{{ route('itens_empenhos.index',$empenho->id) }}";
    });

    $('.editarItemEmpenho').on('click', function () 
    {
        item_empenho_id = $(this).val();

        $('#alert').html('');
        $.ajax({
            url: url + "/itens_empenhos/" + item_empenho_id + "/edit",

            dataType: "json",
            success: function (data) {
                $('#descricao').val(data.result.descricao);
                $('#quantidade').val(data.result.quantidade);
                $('#valor').val(data.result.valor);
                $('#edit_item_empenho_id').val(item_empenho_id);
                $('.modal-title').text('Editar Item');
                $('#btnAcaoItemEmpenho').text('Editar');
                $('#action').val('Editar');
                $('#modalAdicionarItemEmpenho').modal('show');
            }
        });
    });
    
    $('.autorizar').on('click',function()
    {
        $('#btnAcao').text('Autorizar');
        quantidade = $(this).attr('data-qtd');
        saldo = $(this).attr('data-saldo');
        $('#item_empenho_id').val($(this).attr('data-itemEmpenhoId'));
        
        $('#modalAutorizar').modal('show');
        $('#autorizado').val(saldo);

        $('#modalAutorizar').on('shown.bs.modal',function(){
           $('#autorizado').focus();
        });
    });
    
    $('#btnAcao').on('click', function(e)
    {
        e.preventDefault();
        
        
        if($('#autorizado').val() > saldo)
        {
            $('#alert').html('<div class="alert alert-danger">Quantidade superior a disponível</div>');
        } 
        else 
        {
            $('#alert').html('');
        
            $.ajax({
                url: "{{ route('autorizado.store') }}",
                type: "post",
                data: $('#formData').serialize(),
                dataType: "json",
                success: function(response)
                {
                    var html = '';

                    if(response.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for (var i = 0; i < response.errors.length; i++)
                        {
                            html += '<p>' + response.errors[i] + '</p>';
                        }
                        html += '</div>';
                    }

                    if(response.seuccess)
                    {
                        $('#formData')[0].reset();
                        html += '<div class="alert alert-success">' + response.success + '</div>';

                    }

                    $('#alert').html(html);
                    $('#btnAcao').text('Autorizando...');
                    setTimeout(function(){
                        $('#modalAutorizar').modal('hide');
                    },2000);
                }
            });
        }
    });
    
    $('#modalAutorizar').on('hidden.bs.modal',function()
    {
        window.location.href = "{{ route('itens_empenhos.index',$empenho->id) }}";
    });
});
</script>
@stop