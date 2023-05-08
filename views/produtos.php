<?php require __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $title_prefix; ?> | Produtos
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= url("/plugins/fontawesome-free/css/all.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= url("/views/assets/css/adminlte.min.css"); ?>">

  <link rel="stylesheet" href="<?= url("/views/assets/css/loading.css"); ?>">

  <link rel="stylesheet" href="<?= url("/views/assets/css/select.css"); ?>">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include 'partials/menus.php'; ?>

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
                <li class="breadcrumb-item"><a href="index.php">Início</a></li>
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
                  <div class="card-title"><button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                      data-target="#modal-add-produto"><i class="nav-icon fas fa-plus"></i> Adicionar</button></div>
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Pesquisar">

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
                    <tbody>
                      <?php foreach ($products as $product):
                        ?>
                        <tr id="product-<?= $product->codigo_produto; ?>">
                          <td id="productName-<?= $product->codigo_produto; ?>">
                            <?= $product->nome; ?>
                          </td>

                          <td id="productPrice-<?= $product->codigo_produto; ?>">
                            <?= $product->preco; ?>
                          </td>

                          <td id="productQtd-<?= $product->codigo_produto; ?>">
                            <?= $product->quantidade; ?>
                          </td>

                          <td>
                            <?= $product->data_cadastro; ?>
                          </td>

                          <td id="productCategory-<?= $product->codigo_produto; ?>" style="display: none;">
                            <?= $product->categoria; ?>
                          </td>

                          <td>
                            <button type="button" id="btnEditar" value="<?= $product->codigo_produto; ?>"
                              class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-edit-produto"><i
                                class="nav-icon fas fa-edit"></i>Editar</button>
                            <button type="button" id="btnExcluir" value="<?= $product->codigo_produto; ?>"
                              class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"
                                style='margin-right: 0.1rem;'></i>Excluir</button>
                          </td>
                        </tr>
                      <?php endforeach;
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

              <form id="form_add_produto">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_produto">Nome</label>
                    <input type="text" class="form-control" id="nome_produto_add"
                      placeholder="Informe o nome do novo produto" required>
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit">Preço</label>
                    <input type="text" class="form-control" id="preco_produto_add"
                      placeholder="Informe o preço do produto" required>
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_add">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade_produto_add"
                      placeholder="Informe a quantidade em estoque" required>
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit" class="form-label">Categoria</label>
                    <select class="select" id="categoria_produto_add">
                      <option selected>Selecione a categoria</option>

                      <?php foreach ($categories as $category):
                        ?>

                        <option value="<?= $category->codigo_categoria; ?>"><?= $category->nome; ?></option>

                      <?php endforeach; ?>

                    </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" id="closeModal" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_produto_add">Salvar</button>
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

              <form id="form_edit_produto">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_produto_edit">Nome</label>
                    <input type="text" class="form-control" id="nome_produto_edit" value="" autofocus>
                    <input type="hidden" id="nome_produto_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit">Preço</label>
                    <input type="text" class="form-control" id="preco_produto_edit" value="" autofocus>
                    <input type="hidden" id="preco_produto_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade_produto_edit" value="" autofocus>
                    <input type="hidden" id="quantidade_produto_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit" class="form-label">Categoria</label>
                    <select class="select" id="categoria_produto_edit">

                      <?php foreach ($categories as $category):
                        ?>

                        <option value="<?= $category->codigo_categoria; ?>"><?= $category->nome; ?></option>

                      <?php endforeach; ?>

                    </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" id="btn_fechar_produto_edit" class="btn btn-default"
                    data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_produto_edit">Salvar</button>
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
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= url("/plugins/jquery/jquery.min.js"); ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= url("/plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= url("/views/assets/js/adminlte.min.js"); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= url("/views/assets/js/demo.js"); ?>"></script>
  <!-- Bootbox  -->
  <script src="<?= url("/views/assets/js/bootbox.min.js"); ?>"></script>
  <!-- jQuery Mask  -->
  <script src="<?= url("/plugins/jquery/jquery.mask.min.js"); ?>"></script>

</body>

<script>
  const NAME = $("#nome_produto_add");
  const PRICE = $("#preco_produto_add");
  const QUANTITY = $("#quantidade_produto_add");
  const CATEGORY = $("#categoria_produto_add");

  const NAME_EDIT = $("#nome_produto_edit");
  const PRICE_EDIT = $("#preco_produto_edit");
  const QUANTITY_EDIT = $("#quantidade_produto_edit");
  const CATEGORY_EDIT = $("#categoria_produto_edit");

  PRICE.mask("000.000.000.000.000,00", { reverse: true });
  PRICE_EDIT.mask("000.000.000.000.000,00", { reverse: true });

  function addProduct(name, price, qtd, category) {
    buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
      "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.2rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";

    product = "<tr id=" + name + " style='display: none;'>" +
      "<td>" + name + "</td>" +
      "<td>" + "R$ " + price + "</td>" +
      "<td>" + qtd + "</td>" +
      "<td>" + "00/00/0000" + "</td>" +
      "<td>" + buttons + "</td>" +
      "</tr>";

    $("#productsTable tbody").append(product);

    $("#closeModal").trigger("click");

    $("#" + name).fadeIn(500);
  }

  //Formulário responsável por adicionar um produto
  $("#form_add_produto").submit(function (event) {
    event.preventDefault();

    name = NAME.val();
    price = PRICE.val();
    qtd = QUANTITY.val();
    category = CATEGORY.val();

    addProduct(name, price, qtd, category);

    $.ajax({
      url: "<?= $router->route("loja.cadastrar.produto"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        name: name,
        price: price,
        qtd: qtd,
        category: category
      }
    });
  });

  function removeProduct(id) {
    $("#product-" + id).hide(1000);
  }

  //Botao de excluir categorias
  $("body").on("click", "#btnExcluir", function () {
    removeProduct($(this).val());

    $.ajax({
      url: "<?= $router->route("loja.excluir.produto"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        id: $(this).val()
      }
    });
  });

  function modifyProduct(id, name, price, qtd) {
    $("#btn_fechar_produto_edit").trigger("click");

    price = "R$ " + price;

    $("#productName-" + id).text(name);
    $("#productPrice-" + id).text(price);
    $("#productQuantity-" + id).text(qtd);
  }

  //Botao de editar Produtos
  $("body").on("click", "#btnEditar", function () {
    id = $(this).val();

    nameVal = $("#productName-" + id).text();
    priceVal = $("#productPrice-" + id).text().replace("R$", "");
    qtdVal = $("#productQtd-" + id).text();
    categoryVal = $("#productCategory-" + id).text();

    NAME_EDIT.val(nameVal.trim());
    PRICE_EDIT.val(priceVal.trim());
    QUANTITY_EDIT.val(qtdVal.trim());
    CATEGORY_EDIT.val(categoryVal.trim()).attr("selected");

    //Formulário responsável por editar um produto
    $("#form_edit_produto").submit(function (event) {
      event.preventDefault();

      name = NAME_EDIT.val();
      price = PRICE_EDIT.val();
      qtd = QUANTITY_EDIT.val();
      category = CATEGORY_EDIT.val();

      modifyProduct(id, name, price, qtd);

      $.ajax({
        url: "<?= $router->route("loja.editar.produto"); ?>",
        dataType: "json",
        type: "POST",
        data: {
          id: id,
          name: name,
          price: price,
          qtd: qtd,
          category: category
        }
      });
    });
  });
</script>

</html>