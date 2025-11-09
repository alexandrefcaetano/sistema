$(function () {



    $(".form").validate({
        focusInvalid: true,
        ignore: ":not(:visible),[readonly]",
        rules: {
            name:{    required: true },
            email:{  required: true },
            cpf:{   required: true }
        },
        submitHandler: function (e) {
            var dadosItens = $('.table-contato').bootstrapTable("getData");

            if (dadosItens.length > 0) {
                $('input[type=hidden][name=contato]').val(JSON.stringify(dadosItens));
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Obrigatorio contato!',
                    type: "error",
                    showConfirmButton: false
                });
                return false;
            }
            email = false;
            $.each(dadosItens, function (index, row) {
                if (row.tipo_contato === 'EM') {
                    email = true;
                }
            });
            if(email == false){
                Swal.fire({
                    icon: 'error',
                    title: 'E-mail obrigatório!',
                    type: "error",
                    showConfirmButton: false
                });
                return false;
            }
            return true;
        }
    });

    $(".form-contato").validate({

        focusInvalid: true,
        ignore: ":not(:visible),[readonly]",
        rules: {
            descricao_contato: { required: true },
            flg_principal: { required: true },
            tipo_contato: { required: true },
        },
        submitHandler: function (form) {
            // Prevenir o comportamento padrão de submissão
            event.preventDefault();
            let repetido = false;
            let principalExiste = false;
            let row2 = {
                tipo: $(form).find('[name=tipo_contato] option:selected').html(),
                tipo_contato: $(form).find('[name=tipo_contato] option:selected').val(),
                descricao: $(form).find('[name=descricao_contato]').val(),
                flg_principal: $(form).find('[name=flg_principal]:checked').val()
            };
            let table = $('.table-contato');

            if ($(form).find('[name=index]').val() !== '') {
                table.bootstrapTable('updateRow', { index: $(form).find('[name=index]').val(), row: row2 });
            } else {
                var dadosItens = table.bootstrapTable("getData");
                $.each(dadosItens, function (index, row) {
                    if (row.flg_principal === "T") {
                        principalExiste = true;
                    }
                    if (row.descricao === row2.descricao) {
                        repetido = true;
                    }
                });

                // Lógica para evitar múltiplos contatos principais
                if (row2.flg_principal === "T" && principalExiste) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        type: "error",
                        text: 'Já existe um contato principal. Apenas um contato pode ser marcado como principal.',
                        showConfirmButton: false
                    });

                    return false;
                }

                if (!repetido) {
                    table.bootstrapTable("insertRow", { index: dadosItens.length, row: row2 });
                    fecharModalContato(); // Certifique-se de que essa função está definida
                    return true;
                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        type: "error",
                        text: 'O Contato "' + row2.descricao + '" já existe',
                        showConfirmButton: false
                    });


                }
            }
        }
    });

        $('.table-contato').bootstrapTable('load', window.itensAtributo);

});

// Aplica máscara e tipo conforme o tipo de contato selecionado
$(document).on('change', 'select[name="tipo_contato"]', function () {
    const tipo = $(this).val();
    const campoContato = $('input[name="descricao_contato"]');

    // Remove qualquer máscara e volta para tipo texto
    campoContato.unmask && campoContato.unmask();
    campoContato.attr('type', 'text');
    campoContato.val(''); // opcional: limpa o valor ao trocar o tipo

    if (tipo === 'CL') {
        // Celular: aplica máscara de celular
        campoContato.mask('(00) 00000-0000');
    } else if (tipo === 'TF') {
        // Telefone fixo
        campoContato.mask('(00) 0000-0000');
    } else if (tipo === 'EM') {
        // E-mail: muda tipo do input
        campoContato.attr('type', 'email');
    }
});


function abrirModalContato(index) {
    limparCamposModal();
    let modal = $('#modal-contato');
    modal.find('#tipo-operacao').html('Incluir');
    modal.modal('show');
}

function fecharModalContato(index) {
    limparCamposModal();
    $('#modal-contato').modal('hide');
}

function limparCamposModal() {
    let form = $('[name=form-contato]');
    let validator = form.validate();

    form.find(".has-error").removeClass("has-error");
    validator.resetForm();
    validator.reset();

    form.find('[name=index]').val('');
    form.find('[name=cod_atributo_valor]').val('');
    form.find('[name=num_ordem]').val('');
    form.find('[name=qci_grupo_id]').val('');
    form.find('[name=nome_grupo]').val('');
}

function formatAcao(value, row, index) {

    let btnExcluir = '<a class="btn btn-sm btn-danger btn-icon btn-icon-md" href="javascript:exibirModalExclusao(' + index + ')" title="Excluir" style="margin: 2px;">'
        + '<i class="la la-trash"></i>'
        + '</a>';

    return btnExcluir;
}

function formatPrincipal(value, row, index) {
    var principal = "";

    if (value == 'F') {
        principal = 'Não';
    } else if (value == 'T') {
        principal = 'Sim';
    }

    return principal;
}




function exibirModalExclusao(index) {
    let valor = index;
    $('#modal-excluir').find('[name=index]').val(valor);
    var modal = $('#modal-excluir');
    modal.modal('show');
}

function excluirRegistro() {
    var modal = $('#modal-excluir');
    valor = modal.find('[name=index]').val();

    modal.modal('hide');
    let table = $('.table-contato');
    var dados = table.bootstrapTable("getData");
    dados.splice(valor, 1);
    table.bootstrapTable("load", dados);

    $(table).closest('form').data("changed", true);
}



$('.table-contato').bootstrapTable({
    locale: 'pt-BR',
    // Outras configurações da tabela
});
