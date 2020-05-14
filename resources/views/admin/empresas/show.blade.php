@extends('adminlte::page')
@section('content_header')
<div class="container-fluid border-bottom">
    <div class="row mb-2">
        <div class="col-sm-6">
            Detalhes da {{ ucfirst(Util::p2s(request()->segment(2))) }}
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
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 40px;"><strong>Cidade/Estado:</strong></td>
                    <td>{{ $data->cidade->nome }}/{{ $data->estado->uf }}</td>
                </tr>
                <tr>
                    <td style="width: 30px;"><strong>CNPJ:</strong></td>
                    <td>{{ Util::formatCNPJ($data->cnpj) }}</td>
                </tr>
                <tr>
                    <td style="width: 30px;"><strong>Razão Social:</strong></td>
                    <td>{{ $data->nome }}</td>
                </tr>
                <tr>
                    <td style="width: 30px;"><strong>Telefones:</strong></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#telefonesCreate"><i class="fas fa fa-phone">&nbsp;</i></button>
                        <table class="table">
                            <thead>
                            <th>Número</th>
                            </thead>
                            <tbody>
                            @foreach($data->telefones as $telefone)
                                <tr>
                                    <td>{{ $telefone->numero }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30px;"><strong>Colaboradores:</strong></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#colaboradoresCreate"><i class="fas fa fa-users">&nbsp;</i></button>
                        <table class="table">
                            <thead>
                            <th>Nome</th>
                            <th>E-mail</th>
                            </thead>
                            <tbody>
                                @foreach($data->colaboradores as $colaborador)
                                <tr>
                                    <td>{{ $colaborador->nome }}</td>
                                    <td>{{ $colaborador->email }}</td>
                                </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
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

<div class="modal fade" id="telefonesCreate" tabindex="-1" role="dialog" aria-labelledby="cadastroTelefone" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('telefones.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">Cadastro de contatos</div>
                    <div class="card-body">
                        @include('admin.includes.alerts')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="empresa_id" value="{{ $data->id }}">
                                <input type="text" name="numero" class="form-control" placeholder="(  ) ____-____" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm" ><i class="fas fa-save">&nbsp;</i>Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="colaboradoresCreate" tabindex="-1" role="dialog" aria-labelledby="cadastroColaboradores" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('colaboradores.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">Cadastro de colaborador</div>
                    <div class="card-body">
                        @include('admin.includes.alerts')
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="hidden" name="empresa_id" value="{{ $data->id }}">
                                <input type="text" name="nome" class="form-control" placeholder="Nome do colaborador">
                            </div>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" placeholder="Email do colaborador">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save">&nbsp;</i>Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
    <script src="{{ asset('includes/js/confirm.delete.js') }}"></script>
    <script src="{{ asset('includes/js/telefones/create.js') }}"></script>
@stop

