<div id="modalAdicionarItemEmpenho" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Adicionar item ao empenho</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="alertItemEmpenho"></span>
                <form id="formItemEmpenho" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4" >Descrição : </label>
                        <div class="col-md-8">
                            <input type="text" name="descricao" id="descricao" class="form-control text-uppercase">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Quantidade : </label>
                        <div class="col-md-8">
                            <input type="text" name="quantidade" id="quantidade" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Valor : </label>
                        <div class="col-md-8">
                            <input type="text" name="valor" id="valor" class="form-control">
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="empenho_id" value="{{ $empenho->id }}">
                        <input type="hidden" name="edit_item_empenho_id" id="edit_item_empenho_id">
                        <button type="submit" id="btnAcaoItemEmpenho" class="btn btn-success"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>