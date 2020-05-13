@include('admin.includes.alerts')
<div class="form-group">
    <label>PI:</label>
    <input type="text" name="pi" class="form-control" placeholder="Plano interno" value="{{ $data->pi ?? old('pi') }}">
</div>
<div class="form-group">
    <label>PTRES:</label>
    <input type="text" name="ptres" class="form-control" placeholder="Plano de trabalho resumido" value="{{ $data->ptres ?? old('ptres') }}">
</div>
<div class="form-group">
    <label>Fonte:</label>
    <input type="text" name="fonte" class="form-control" placeholder="Fonte do recurso" value="{{ $data->fonte ?? old('fonte') }}">
</div>