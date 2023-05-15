<?php
$params = [
    "title" => "Categorias",
    "tableId" => "categoriesTable",
    "idSuffix" => "categoria",
    "modalEditTitle" => "Cadastrar Nova Categoria",
    "modalAddTitle" => "Editar Categoria"
];

$this->layout("_template", $params);
?>

<?php $this->start("table-thead"); ?>

<tr>
    <th>Nome</th>
    <th>Data de Cadastro</th>
    <th>Ações</th>
</tr>

<?php $this->stop(); ?>

<?php $this->start("table-tbody"); ?>

<?php if (isset($categories) && $categories != null):
    foreach ($categories as $category):
        ?>

        <tr id="category<?= $category->codigo_categoria; ?>">
            <td id="categoryName<?= $category->codigo_categoria; ?>">
                <?= $category->nome; ?>
            </td>

            <td>
                <?= $category->data_cadastro; ?>
            </td>

            <td>
                <button type='button' id='btnEditar' value="<?= $category->codigo_categoria; ?>"
                    class='btn btn-secondary btn-sm' data-toggle='modal' data-target='#modal-edit-categoria'><i
                        class='nav-icon fas fa-edit'></i>Editar</button>
                <button type='button' id='btnExcluir' value="<?= $category->codigo_categoria; ?>" class='btn btn-danger btn-sm'
                    style='margin-left: 0.25rem;'><i class='nav-icon fas fa-trash'
                        style='margin-right: 0.1rem;'></i>Excluir</button>
            </td>
        </tr>

    <?php endforeach; ?>
<?php endif; ?>

<?php $this->stop(); ?>

<?php $this->start("modal-add-form"); ?>

<div class="modal-body">
    <div class="form-group">
        <label for="nome_categoria">Nome</label>
        <input type="text" class="form-control" id="nome_categoria_add" placeholder="Informe o nome da nova categoria">
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" id="closeModal" class="btn btn-default" data-dismiss="modal">Fechar</button>
    <button type="submit" class="btn btn-success" id="btn_salvar_categoria_add">Salvar</button>
</div>

<?php $this->stop(); ?>

<?php $this->start("modal-edit-form"); ?>

<div class="modal-body">
    <div class="form-group">
        <label for="nome_categoria_edit">Nome</label>
        <input type="text" class="form-control" id="nome_categoria_edit" value="" autofocus>
        <input type="hidden" id="nome_categoria_edit" value="">
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" id="btn_fechar_categoria_edit" data-dismiss="modal">Fechar</button>
    <button type="submit" class="btn btn-success" id="btn_salvar_categoria_edit">Salvar</button>
</div>

<?php $this->stop(); ?>

<?php $this->start("script"); ?>

<script>
    function getNowDate() {
        d = new Date();
        day = d.getDate();
        month = (d.getMonth()) + 1;
        year = d.getFullYear();

        if (day <= 9) {
            day = "0" + day;
        }

        if (month <= 9) {
            month = "0" + month;
        }

        nowDate = day + "/" + month + "/" + year;

        return nowDate;
    }

    function addCategory(name) {
        nowDate = getNowDate();

        buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
            "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.25rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";


        category = "<tr id=" + name + " style='display: none;'>" +
            "<td>" + name + "</td>" +
            "<td>" + nowDate + "</td>" +
            "<td>" + buttons + "</td>" +
            "</tr>";

        $("#categoriesTable tbody").append(category);

        $("#" + name).fadeIn(500);

        $("#closeModal").trigger("click");

        $("#nome_categoria_add").val("");
    }

    //Formulário responsável por adicionar uma categoria
    $("#form_add_categoria").submit(function (event) {
        event.preventDefault();

        addCategory($("#nome_categoria_add").val());

        $.ajax({
            url: "<?= $router->route("loja.cadastrar.categoria"); ?>",
            dataType: "json",
            type: "POST",
            data: {
                name: $("#nome_categoria_add").val()
            }
        });
    });

    function removeCategory(id) {
        $("#category" + id).hide(1000);
    }

    //Botao de excluir categorias
    $("body").on("click", "#btnExcluir", function () {
        removeCategory($(this).val());

        $.ajax({
            url: "<?= $router->route("loja.excluir.categoria"); ?>",
            dataType: "json",
            type: "POST",
            data: {
                id: $(this).val()
            }
        });
    });

    function modifyCategory(id, name) {
        id = "categoryName" + id;

        $("#" + id).text(name);
        $("#btn_fechar_categoria_edit").trigger("click");
    }

    //Botao de editar categorias
    $("body").on("click", "#btnEditar", function () {
        id = $(this).val();

        nameVal = $("#categoryName" + id).text();
        $("#nome_categoria_edit").val(nameVal.trim());

        //Formulário responsável por editar uma categoria
        $("#form_edit_categoria").submit(function (event) {
            event.preventDefault();

            modifyCategory(id, $("#nome_categoria_edit").val());

            $.ajax({
                url: "<?= $router->route("loja.editar.categoria"); ?>",
                dataType: "json",
                type: "POST",
                data: {
                    id: id,
                    name: $("#nome_categoria_edit").val()
                }
            });
        });
    });
</script>

<?php $this->stop(); ?>