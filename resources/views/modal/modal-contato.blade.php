
<div class="modal fade" id="modal-contato" tabindex="-1" role="modal-contato" aria-labelledby="modal-contato" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" name="form-contato" class="kt-form kt-form--label-right form-contato" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cod_atributo_valor" id="cod_atributo_valor" value="">
                <input type="hidden" name="index" id="index" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="contaNmaer">Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label>Tipo:</label>
                            <select name="tipo_contato" required class="form-control" tabindex="-98" aria-required="true">
                                <option value="">Selecione...</option>
                                <option value="CL">Celular</option>
                                <option value="EM">Email</option>
                                <option value="TF">Telefone fixo</option>
                            </select>
                            <span class="form-text text-muted">Tipo de Contato</span>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-control-label">Contato:</label>
                            <input type="text" class="form-control" name="descricao_contato"  aria-required="true">
                            <span class="form-text text-muted">Entre com seu contato</span>
                        </div>
                        <div class="col-lg-4">
                            <label class="">Principal:</label>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="flg_principal"  value="T">Sim
                                    <span></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="flg_principal" checked="checked" value="F">Não
                                    <span></span>
                                </label>
                            </div>
                            <span class="form-text text-muted">Contato Principal?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Incluir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade show" id="modal-excluir" tabindex="-1" role="modal-excluir" aria-labelledby="modal-excluir" aria-modal="true" style="display: none;" >
    <input type="hidden" name="index"/>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir o Contato?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Não</button>
                <button type="button" onclick="excluirRegistro();" class="btn btn-primary">Sim</button>
            </div>
        </div>
    </div>
</div>
