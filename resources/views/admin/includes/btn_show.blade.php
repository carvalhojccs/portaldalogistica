{{ Form::open(['route' => [request()->segment(2).'.destroy',$data->id],'class' => 'form', 'method' => 'DELETE']) }}
    <a href="{{ route(request()->segment(2).'.edit',$data->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit">&nbsp;</i>Editar</a>
    <button class="btn btn-danger btn-sm" onclick="return confirm('Deletar {{$data->nome}}?')"><i class="fa fa-trash">&nbsp;</i>Deletar</button>
    <a href="{{ route(request()->segment(2).'.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-backward">&nbsp;</i>Voltar</a>
{{ Form::close() }}