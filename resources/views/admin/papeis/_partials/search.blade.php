<div class="card card-primary">
    <div class="card-body">
        {{ Form::open(['route' => request()->segment(2).'.search','class' => 'form form-inline']) }}
        {{ Form::text('nome',$filters['nome'] ?? '',['placeholder' => 'Nome','class' => 'form-control']) }}
        {{ Form::text('descricao',$filters['descricao'] ?? '',['placeholder' => 'Descrição','class' => 'form-control']) }}
        {{ Form::button('<i class="fa fa-search"></i> Pesquisar',['class' => 'btn btn-sm btn-primary', 'type' => 'submit']) }}
        @if(isset($filters))
        <a href="{{ route(request()->segment(2).'.index') }}">(x) Limpar Resultados da Pesquisa</a>
        @endif
        {{ Form::close() }}
    </div>
</div>