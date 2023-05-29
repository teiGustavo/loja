<?php /** @noinspection PhpUndefinedVariableInspection */
$v = $this;

$params = [
    "title" => "Produtos"
];

$v->layout("_theme", $params);
?>

<?php $v->start("style"); ?>
    <link rel="stylesheet" href="<?= url("/views/assets/css/select.css"); ?>">
    <!-- Default CSS -->
    <link rel="stylesheet" href="<?= url("/views/assets/css/default.css"); ?>">
<?php $v->stop(); ?>

<?php $v->start("contents"); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Produtos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $router->route("home"); ?>">Início</a></li>
                            <li class="breadcrumb-item active">Produtos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                                            data-target="#modal-add-produto"><i class="nav-icon fas fa-plus"></i>
                                        Adicionar
                                    </button>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Pesquisar">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="productsTable">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Preço</th>
                                        <th>Estoque</th>
                                        <th>Data de Cadastro</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody class="products">
                                    <?php
                                    if (!empty($products)):
                                        foreach ($products as $product):

                                            $v->insert("fragments/product", ["product" => $product]);
                                        endforeach;
                                    endif;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="modal fade" id="modal-add-produto">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cadastrar Novo Produto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="form_add_produto" action="<?= $router->route("product.create"); ?>">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nome_produto_add">Nome</label>
                                    <input type="text" class="form-control" id="nome_produto_add" name="name"
                                           placeholder="Informe o nome do novo produto" required>
                                </div>
                                <div class="form-group">
                                    <label for="preco_produto_add">Preço</label>
                                    <input type="text" class="form-control" id="preco_produto_add" name="price"
                                           placeholder="Informe o preço do produto" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantidade_produto_add">Quantidade</label>
                                    <input type="number" class="form-control" id="quantidade_produto_add" name="qtd"
                                           placeholder="Informe a quantidade em estoque" required>
                                </div>
                                <div class="form-group">
                                    <label for="categoria_produto_add" class="form-label">Categoria</label>
                                    <select class="select" id="categoria_produto_add" name="category">
                                        <option selected>Selecione a categoria</option>

                                        <?php foreach ($categories as $category):
                                            ?>

                                            <option value="<?= $category->codigo_categoria; ?>"><?= $category->nome; ?></option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" id="closeModal" data-dismiss="modal">
                                    Fechar
                                </button>
                                <button type="submit" class="btn btn-success" id="btn_salvar_produto_add">Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-edit-produto">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar produto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="form_edit_produto" action="<?= $router->route("product.update"); ?>">
                            <input type="hidden" id="id_produto_edit" name="id" value="">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nome_produto_edit">Nome</label>
                                    <input type="text" class="form-control" id="nome_produto_edit" value="" name="name" autofocus>
                                    <input type="hidden" id="nome_produto_edit" value="">
                                </div>
                                <div class="form-group">
                                    <label for="preco_produto_edit">Preço</label>
                                    <input type="text" class="form-control" id="preco_produto_edit" value="" name="price" autofocus>
                                    <input type="hidden" id="preco_produto_edit" value="">
                                </div>
                                <div class="form-group">
                                    <label for="quantidade_produto_edit">Quantidade</label>
                                    <input type="number" class="form-control" id="quantidade_produto_edit" name="qtd" value=""
                                           autofocus>
                                    <input type="hidden" id="quantidade_produto_edit" value="">
                                </div>
                                <div class="form-group">
                                    <label for="categoria_produto_edit" class="form-label">Categoria</label>
                                    <select class="select" id="categoria_produto_edit" name="category">

                                        <?php foreach ($categories as $category):
                                            ?>

                                            <option value="<?= $category->codigo_categoria; ?>"><?= $category->nome; ?></option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" id="btn_fechar_produto_edit" class="btn btn-default"
                                        data-dismiss="modal">Fechar
                                </button>
                                <button type="submit" class="btn btn-success" id="btn_salvar_produto_edit">Salvar
                                </button>
                            </div>
                        </form>
                        <div id="Loading" class="d-none"></div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $v->stop(); ?>

<?php $v->start("script"); ?>
    <script src="<?= url("/plugins/jquery/jquery.mask.min.js"); ?>"></script>
<?php $v->stop(); ?>

<?php $v->start("js"); ?>
    <script>
        const PRICE = $("#preco_produto_add");
        const PRICE_EDIT = $("#preco_produto_edit");
        const BODY = $("body");

        PRICE.mask("000.000.000.000.000,00", {reverse: true});
        PRICE_EDIT.mask("000.000.000.000.000,00", {reverse: true});

        $(function () {
            $("#form_add_produto").submit(function (e) {
                e.preventDefault();

                let form = $(this);
                let categories = $(".products");
                let feedback = $(".invalid-feedback");

                $.ajax({
                    url: form.attr("action"),
                    data: form.serialize(),
                    type: "POST",
                    dataType: "JSON",
                    success: function (callback) {
                        if (callback.message) {
                            feedback.html(callback.message).fadeIn();
                        } else {
                            feedback.fadeOut(function () {
                                $(this).html("");
                            });
                        }

                        if (callback.product) {
                            categories.append(callback.product).fadeIn();
                            $("#nome_produto_add").val("");
                            $("#preco_produto_add").val("");
                            $("#quantidade_produto_add").val("");
                            $("#categoria_produto_add").val("");
                            $("#closeModal").trigger("click");
                        }
                    }
                });
            });

            BODY.on("click", "[data-update]", function (e) {
                e.preventDefault();

                let data = $(this).data();
                let div = $(this).parent().parent();

                $("#id_produto_edit").val(data.id);

                $.ajax({
                    url: data.action,
                    data: {
                        id: data.id
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function (callback) {
                        $("#nome_produto_edit").val(callback.product.nome);
                        $("#preco_produto_edit").val(callback.product.preco);
                        $("#quantidade_produto_edit").val(callback.product.quantidade);
                        $("#categoria_produto_edit").val(callback.product.categoria);
                    }
                });

                $("#form_edit_produto").submit(function (e) {
                    e.preventDefault();

                    let form = $(this);
                    let products = $(".products");
                    let feedback = $(".invalid-feedback");

                    $("#btn_salvar_produto_edit").attr("disabled");

                    $.ajax({
                        url: form.attr("action"),
                        data: form.serialize(),
                        type: "POST",
                        dataType: "JSON",
                        success: function (callback) {
                            if (callback.message) {
                                feedback.html(callback.message).fadeIn();
                            } else {
                                feedback.fadeOut(function () {
                                    $(this).html("");
                                    $("#nome_produto_edit").val("");
                                });
                            }

                            if (callback.product) {
                                div.fadeOut();
                                products.append(callback.product).fadeIn();
                                $("#btn_fechar_produto_edit").trigger("click");
                                $("#btn_salvar_produto_edit").removeAttr("disabled");
                            }
                        }
                    });
                });
            });

            BODY.on("click", "[data-delete]", function (e) {
                e.preventDefault();

                let data = $(this).data();
                let div = $(this).parent().parent();

                console.log(data);

                $.post(data.action, data, "json")
                    .done(function (callback) {
                        div.fadeOut();
                    })
                    .fail(function () {
                        alert("Erro ao processar a requisição!");
                    });
            });
        });
    </script>
<?php $v->stop(); ?>