@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="nome" class="form-control" placeholder="Nome" value="{{ $data->nome ?? old('nome') }}">
</div>
<div class="form-group">
    <label>Sigla:</label>
    <input type="text" name="sigla" class="form-control" placeholder="Sigla" value="{{ $data->sigla ?? old('sigla') }}">
</div>