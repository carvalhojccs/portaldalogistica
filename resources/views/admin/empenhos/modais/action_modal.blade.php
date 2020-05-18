<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Adicionar item ao pregão</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="alert"></span>
                <form method="post" id="formData" class="form-horizontal">
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
                        <input type="hidden" name="action" id="action" value="Adicionar">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" name="empenho_id" value="{{ $data->id }}">
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Adicionar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>