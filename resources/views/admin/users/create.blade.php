@extends('adminlte::page')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Cadastrar  usuário
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
<script>
$(document).ready(function(){
    $('#local').select2();
    
    $('#name').prop('disabled',true);
    $('#email').prop('disabled',true);
    $('#password').prop('disabled',true);
    
    $('#local').on('change',function(e){
        $('#name').prop('disabled',false);
        $('#email').prop('disabled',false);
        $('#password').prop('disabled',false);
    });
});
</script>
@stop