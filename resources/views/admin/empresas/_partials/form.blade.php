@include('admin.includes.alerts')
<div class="form-group">
    <label>Local:</label>
    <select name="estado_id" class="form-control" id="estado">
        <option value="">Selecione um local...</option>
        @foreach($estados as $estado_id => $estado)
            <option value="{{$estado_id}}"
                    @if(isset($data) && $data->estado->id == $estado_id)
                        selected
                    @endif
                    >{{$estado}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Cidade:</label>
    <select name="cidade_id" class="form-control" id="cidade">
            <option value="0">Selecione...</option>
    </select>
</div>
<div class="form-group">
    <label>CNPJ:</label>
    <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0001-00" value="{{ $data->cnpj ?? old('cnpj') }}">
</div>
<div class="form-group">
    <label>Razão Social:</label>
    <input type="text" name="nome" id="nome" class="form-control" placeholder="Razão Social" value="{{ $data->nome ?? old('nome') }}">
</div>

