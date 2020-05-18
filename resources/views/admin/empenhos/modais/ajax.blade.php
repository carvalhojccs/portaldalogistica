@section('js')
<script>
$(document).ready(function () {

    var url = "{{ url('admin') }}";

    $('#formData').submit(function (e)
    {
        e.preventDefault();

        var action_url = '';

        if ($('#action').val() == 'Adicionar') {
            action_url = "{{ route('itens_empenhos.store') }}";
            console.log('add');
        }

        if ($('#action').val() == 'Editar') {
            action_url = "{{ route('itens_empenhos.update') }}";
            console.log('edit');
        }

        $.ajax({
            url: action_url,
            type: "post",
            data: $(this).serialize(),
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
                    $('#formData')[0].reset();
                    $('#descricao').focus();
                    html += '<div class="alert alert-success">' + response.success + '</div>';
                }

                $('#alert').html(html);
            }
        });
    });

    $('#formModal').on('hidden.bs.modal', function () {
        window.location.href = "{{ route('empenhos.show',$data->id) }}";
    });

    var item_empenho_id;

    $('.deletar').on('click', function () {
        item_empenho_id = $(this).val();
        console.log(item_empenho_id);
        $('#confirmModal').modal('show');
        $('#btnOk').text('Deletar');
    });

    $('#btnOk').on('click', function () {
        $.ajax({
            url: url + "/itens_empenhos/destroy/" + item_empenho_id,

            beforeSend: function () {
                $('#btnOk').text('Deletando...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    alert('Item deletado!');
                }, 2000);
            }
        });
    });

    $('#confirmModal').on('hidden.bs.modal', function () {
        window.location.href = "{{ route('empenhos.show',$data->id) }}";
    });

    $('.editar').on('click', function () {
        item_empenho_id = $(this).val();

        $('#alert').html('');
        $.ajax({
            url: url + "/itens_empenhos/" + item_empenho_id + "/edit",

            dataType: "json",
            success: function (data) {
                $('#descricao').val(data.result.descricao);
                $('#quantidade').val(data.result.quantidade);
                $('#valor').val(data.result.valor);
                $('#hidden_id').val(item_empenho_id);
                $('.modal-title').text('Editar Item');
                $('#action_button').val('Editar');
                $('#action').val('Editar');
                $('#formModal').modal('show');
            }
        });
    });
});
</script>
@stop