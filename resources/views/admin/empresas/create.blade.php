@extends('adminlte::page')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Cadastrar  {{ request()->segment(2) }}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route(request()->segment(2).'.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active"><a href="#">Cadastrar</a></li>
            </ol>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="card">
    <form action="{{ route(request()->segment(2).'.store') }}" class="form" method="POST">
        @csrf
        <div class="card-body">
            @include('admin.'.request()->segment(2).'._partials.form')
        </div>
        @include('admin.includes.btn_create')
    </form>
</div>
@stop
@section('js')
<script src="{{ asset('vendor/jquery/jquery.mask.min.js') }}"></script>
<script>
    $(document).ready(function(){
       $('#estado').select2();
       $('#cidade').select2();
       
       $('#cidade').prop('disabled',true);
       $('#cnpj').prop('disabled',true);
       $('#nome').prop('disabled',true);
       
       $('#estado').on('change',function(e){
          var estado_id = e.target.value;
          $('#cidade').prop('disabled',false);
          $('#cidade').empty();
          $('#cidade').append('<option>Selecione...</option>');
          $.get('http://portaldalogistica.local.br/api/cidades?estado_id='+estado_id, function(data){
              $.each(data,function(index,cidade){
                 $('#cidade').append('<option value="'+cidade.id+'">'+cidade.nome+'</option>'); 
              });
          });
          
          $('#cidade').select2('open');
       });
       
       $('#cidade').on('change',function(e){
           $('#cnpj').prop('disabled', false);
           $('#nome').prop('disabled',false);
       });
       
       $('#cnpj').mask('00.000.000/0000-00',{reverse: true});
       
    });
</script>
@stop