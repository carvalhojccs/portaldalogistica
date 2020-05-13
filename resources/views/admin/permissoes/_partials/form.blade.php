<div class="form-group">
    {{ Form::label('nome','Nome') }}
    {{ Form::text('nome', $data->nome ?? '', ['placeholder' => 'Nome da permissão', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('descricao','Descrição') }}
    {{ Form::text('descricao', $data->descricao ?? '', ['placeholder' => 'Descrição da permissão', 'class' => 'form-control']) }}
</div>