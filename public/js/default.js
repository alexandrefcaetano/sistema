$(document).on("blur", "#cd_dependencia", function () {
    const agencia = $(this).val();

    if (!agencia) {
        $("#cd_dependencia").val("");
        return;
    }

    $.get("/json/dependencias/" + agencia)
        .done(function (data) {
            // 🔥 Se o backend retornar { error: "..."}
            if (data.error) {
                console.warn(data.error);
                $("#no_unidade").val("");
                return;
            }

            // 🔥 Se vier um objeto válido
            if (data && data.nm_dependencia) {
                $("#no_unidade").val(data.nm_dependencia);
            } else {
                $("#no_unidade").val("");
            }
        })
        .fail(function (xhr) {
            // 🔥 Tratar erros HTTP
            if (xhr.status === 404) {
                console.warn("Dependência não encontrada!");
            } else if (xhr.status === 422) {
                console.warn("Código de dependência inválido.");
            } else {
                console.error("Erro ao buscar dependência.");
            }

            $("#no_unidade").val("");
        });
});


// phone number format
$(".mask_celular").inputmask("mask", {
    "mask": "(99) 9999-9999"
});
