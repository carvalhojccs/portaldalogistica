@extends('adminlte::page')
@section('title','Portal da Logística')
@section('content_header')
@stop
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalPapeis }}</h3>
                <p>Papeis Cadastrados</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('papeis.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalLinhasCreditos }}</h3>
                <p>Linhas de Crédito Cadastradas</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('linhas_creditos.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
    @stop