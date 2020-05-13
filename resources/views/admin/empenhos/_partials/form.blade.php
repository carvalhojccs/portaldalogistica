@include('admin.includes.alerts')
<div class="form-group">
    <label>Tipo Item:</label>
    <select name="tipo_item_id" class="form-control" id="tipoItem">
        <option value="">Selecione um tipo...</option>
        @foreach($tiposItens as $id => $tipoItem)
            <option value="{{ $id }}"
                    @if(isset($data) && $data->tipoItem->id == $id)
                        selected
                    @endif
                    >{{ $tipoItem }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Processo:</label>
    <input type="text" name="processo" class="form-control" placeholder="XXX/XXXX" value="{{ $data->processo ?? old('processo') }}">
</div>
<div class="form-group">
    <label>Empresa:</label>
    <select name="empresa_id" class="form-control" id="empresa">
        <option value="">Selecione uma empresa...</option>
        @foreach($empresas as $id => $empresa)
            <option value="{{$id}}"
                    @if(isset($data) && $data->empresa->id == $id)
                        selected
                    @endif
                    >{{$empresa}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Linha Crédito:</label>
    <select name="linha_credito_id" class="form-control" id="linhaCredito">
        <option value="">Selecione uma linha de crédito...</option>
        @foreach($linhasCreditos as $linhaCredito)
            <option value="{{$linhaCredito->id}}"
                    @if(isset($data) && $data->linhaCredito->id == $linhaCredito->id)
                        selected
                    @endif
                    >{{ $linhaCredito->pi }} - {{ $linhaCredito->ptres }} - {{ $linhaCredito->fonte }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>ND:</label>
    <select name="natureza_id" class="form-control" id="natureza">
        <option value="">Selecione uma natureza de despesa...</option>
        @foreach($naturezas as $id => $natureza)
            <option value="{{ $id }}"
                    @if(isset($data) && $data->natureza->id == $id)
                        selected
                    @endif
                    >{{ $natureza }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Valor Empenho:</label>
    <input type="text" name="valor_solicitacao" class="form-control" placeholder="R$ 0,00" value="{{ $data->valor_solicitacao ?? old('valor_solicitacao') }}">
</div>
<div class="form-group">
    <label>Data Solicitação:</label>
    <input type="date" name="data_solicitacao" class="form-control" value="{{ $data->data_solicitacao ?? old('data_solicitacao') }}">
</div>
<div class="form-group">
    <label>Solicitação:</label>
    <input type="text" name="solicitacao" class="form-control" placeholder="Solicitação" value="{{ $data->solicitacao ?? old('solicitacao') }}">
</div>
<div class="form-group">
    <label>Status solicitação:</label>
    <select name="status_empenho_id" class="form-control" id="natureza">
        <option value="">Selecione um status..</option>
        @foreach($statusEmpenhos as $id => $statusEmpenho)
            <option value="{{ $id }}"
                    @if(isset($data) && $data->statusEmpenho->id == $id)
                        selected
                    @endif
                    >{{ $statusEmpenho }}</option>
        @endforeach
    </select>
</div>
