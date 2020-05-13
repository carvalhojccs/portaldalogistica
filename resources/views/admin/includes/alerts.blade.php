@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif

@if(session('success'))
@section('js')
    <script>
        $(function() {
            $(document).Toasts('create', {
                class: 'bg-success', 
                title: "<i class='fas fa-exclamation-triangle'>&nbsp;</i>AVISO!",
                subtitle: '',
                body: 'Operação realizada com sucesso!',
            });
        });
    </script>
@stop
@endif

@if(session('successDelete'))
    <div class="alert alert-info">
        {{ session('successDelete') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-warning">
        {{ session('info') }}
    </div>
@endif