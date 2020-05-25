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
@include('admin.includes.alerts')
<div class="card">
    
    <div class="card-body">
        <table class="table table-sm">
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
                    <td style="width: 130px;" class="align-middle"><button class="btn btn-primary" id='btnTelefoneCreate'><strong>Telefones</strong></button></td>
                    <td>
                        <table class="table table-sm">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Número</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($data->telefones as $telefone)
                                <tr>
                                    <td>{{ Util::formatPhone($telefone->numero) }}</td>
                                    <td style="width: 150px; text-align: center">
                                        <button class="btn btn-warning btn-sm editar " value="{{ $telefone->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm deletar deletarTelefone" value="{{ $telefone->id }}"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td>Nenhum telefone cadastrado!</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 130px;" class="align-middle"><button class="btn btn-primary" id="btnColaboradorCreate"><strong>Colaboradores</strong></button></td>
                    <td>
                        <table class="table table-sm">
                            <thead class="bg-primary">
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th class="text-center">Ações</th>
                            </thead>
                            <tbody>
                                @forelse($data->colaboradores as $colaborador)
                                <tr>
                                    <td>{{ $colaborador->nome }}</td>
                                    <td>{{ $colaborador->email }}</td>
                                    <td style="width: 150px; text-align: center">
                                        <button class="btn btn-warning btn-sm editar" value="{{ $colaborador->id }}"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm deletar deletarColaborador" value="{{ $colaborador->id }}"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td>Nenhum colaborador cadastrado!</td></tr>
                        @endforelse
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

<!-- Modal !-->
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
                                <input type="text" name="numero" class="form-control" id="numero">
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
                                <label>Nome:</label>
                                <input type="hidden" name="empresa_id" value="{{ $data->id }}">
                                <input type="text" name="nome" class="form-control" id="nomeColaborador">
                            </div>
                            <div class="col-sm-10">
                                <label>E-mail</label>
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

@include('admin.includes.confirm_modal')
 
@stop

@include('admin.empresas.modais.script')
