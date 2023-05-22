<?php
$params = [
    "title" => "Produtos",
    "tableId" => "productsTable",
    "idSuffix" => "produto",
    "modalEditTitle" => "Cadastrar Novo Produto",
    "modalAddTitle" => "Editar Produto"
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

<?php if (isset($products) && $products != null):
    foreach ($products as $product):
        ?>

        <tr id="product<?= $product->codigo_produto; ?>">
            <td id="productName<?= $product->codigo_produto; ?>">
                <?= $product->nome; ?>
            </td>

            <td>
                <?= $product->data_cadastro; ?>
            </td>

            <td>
                <button type='button' id='btnEditar' value="<?= $product->codigo_produto; ?>"
                    class='btn btn-secondary btn-sm' data-toggle='modal' data-target='#modal-edit-produto'><i
                        class='nav-icon fas fa-edit'></i>Editar</button>
                <button type='button' id='btnExcluir' value="<?= $product->codigo_produto; ?>" class='btn btn-danger btn-sm'
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
        <label for="nome_produto">Nome</label>
        <input type="text" class="form-control" id="nome_produto_add" placeholder="Informe o nome da nova produto">
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" id="closeModal" class="btn btn-default" data-dismiss="modal">Fechar</button>
    <button type="submit" class="btn btn-success" id="btn_salvar_produto_add">Salvar</button>
</div>

<?php $this->stop(); ?>

<?php $this->start("modal-edit-form"); ?>

<div class="modal-body">
    <div class="form-group">
        <label for="nome_produto_edit">Nome</label>
        <input type="text" class="form-control" id="nome_produto_edit" value="" autofocus>
        <input type="hidden" id="nome_produto_edit" value="">
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" id="btn_fechar_produto_edit" data-dismiss="modal">Fechar</button>
    <button type="submit" class="btn btn-success" id="btn_salvar_produto_edit">Salvar</button>
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

    function addproduct(name) {
        nowDate = getNowDate();

        buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
            "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.25rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";


        product = "<tr id=" + name + " style='display: none;'>" +
            "<td>" + name + "</td>" +
            "<td>" + nowDate + "</td>" +
            "<td>" + buttons + "</td>" +
            "</tr>";

        $("#productsTable tbody").append(product);

        $("#" + name).fadeIn(500);

        $("#closeModal").trigger("click");

        $("#nome_produto_add").val("");
    }

    function removeproduct(id) {
        $("#product" + id).hide(1000);
    }

    //Formulário responsável por adicionar uma produto
    $("#form_add_produto").submit(function (event) {
        event.preventDefault();

        addproduct($("#nome_produto_add").val());

        $.ajax({
            url: "<?= $router->route("product.create"); ?>",
            dataType: "json",
            type: "POST",
            data: {
                name: $("#nome_produto_add").val()
            }
        });
    });

    //Botao de excluir produtos
    $("body").on("click", "#btnExcluir", function () {
        removeproduct($(this).val());

        $.ajax({
            url: "<?= $router->route("product.delete"); ?>",
            dataType: "json",
            type: "POST",
            data: {
                id: $(this).val()
            }
        });
    });

    function modifyproduct(id, name) {
        id = "productName" + id;

        $("#" + id).text(name);
        $("#btn_fechar_produto_edit").trigger("click");
    }

    //Botao de editar produtos
    $("body").on("click", "#btnEditar", function () {
        id = $(this).val();

        nameVal = $("#productName" + id).text();
        $("#nome_produto_edit").val(nameVal.trim());

        //Formulário responsável por editar uma produto
        $("#form_edit_produto").submit(function (event) {
            event.preventDefault();

            modifyproduct(id, $("#nome_produto_edit").val());

            $.ajax({
                url: "<?= $router->route("product.update"); ?>",
                dataType: "json",
                type: "POST",
                data: {
                    id: id,
                    name: $("#nome_produto_edit").val()
                }
            });
        });
    });
</script>

<?php $this->stop(); ?>