$("#form_add_categoria").submit(function(event) {
    event.preventDefault();

    $("#Loading").removeClass("d-none");
    $("#btn_salvar_categoria_add").attr("disabled", true);
    $("#btn_salvar_categoria_add").text("Salvando...");

    $.post()
});