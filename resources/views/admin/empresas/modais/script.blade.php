@section('js')
    <script src="{{ asset('includes/js/confirm.delete.js') }}"></script>
    <script src="{{ asset('includes/js/telefones/create.js') }}"></script>
    
    <script>
    $(document).ready(function(){
        var url = "{{ url('admin') }}";
        var colaborador_id = '';
        var telefone_id = '';
        var route = '';
        $('#btnTelefoneCreate').on('click', function(){
            $('#telefonesCreate').modal('show');
            $('#telefonesCreate').on('shown.bs.modal', function(){
               $('#numero').focus(); 
            });
        });
        
        $('#btnColaboradorCreate').on('click',function(){
            $('#colaboradoresCreate').modal('show');
            $('#colaboradoresCreate').on('shown.bs.modal', function(){
                $('#nomeColaborador').focus()
            });
        })
        
        $('.deletarTelefone').on('click', function () {
            telefone_id = $(this).val();
            $('#confirmModal').modal('show');
            $('#btnOk').attr('name','telefone');
            $('#btnOk').text('Deletar');
        });
        
        
        $('.deletarColaborador').on('click', function () {
            colaborador_id = $(this).val();
            $('#confirmModal').modal('show');
            $('#btnOk').attr('name','colaborador');
            $('#btnOk').text('Deletar');
        });
        
        
        $('#btnOk').on('click', function () {
            if($('#btnOk').attr('name') == 'telefone'){
                route = url + "/telefones/destroy/" + telefone_id;
            }
            
            if($('#btnOk').attr('name') == 'colaborador'){
                route = url + "/colaboradores/destroy/" + colaborador_id;
            }
            
            console.log(route);
            
            $.ajax({
                url: route,
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
            window.location.href = "{{ route('empresas.show',$data->id) }}";
        });
    });
    </script>
@stop
