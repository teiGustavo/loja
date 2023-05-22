<?php require __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $title_prefix; ?> | Categorias de Produtos
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= url("/plugins/fontawesome-free/css/all.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= url("/views/assets/css/adminlte.min.css"); ?>">
  <link rel="stylesheet" href="<?= url("/views/assets/css/loading.css"); ?>">
  <!-- Favicon.ico -->
  <link rel="shortcut icon" href="<?= url("/views/assets/img/favicon.ico"); ?>">
  <!-- Default CSS -->
  <link rel="stylesheet" href="<?= url("/views/assets/css/default.css"); ?>">
</head>

<body class="hold-transition sidebar-mini dark-mode sidebar-collapse">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= url("/views/assets/img/favicon.ico"); ?>" alt="AdminLTELogo"
        height="60" width="60">
    </div>

    <?php include "partials/menus.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Categorias de Produtos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Início</a></li>
                <li class="breadcrumb-item"><a href="produtos.php">Produtos</a></li>
                <li class="breadcrumb-item active">Categorias</li>
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
                      data-target="#modal-add-categoria"><i class="nav-icon fas fa-plus"></i>
                      Adicionar</button>
                  </div>
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
                  <table class="table table-hover text-nowrap" id="categoriesTable">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($categories as $category):
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
                            <button type='button' id='btnExcluir' value="<?= $category->codigo_categoria; ?>"
                              class='btn btn-danger btn-sm' style='margin-left: 0.25rem;'><i class='nav-icon fas fa-trash'
                                style='margin-right: 0.1rem;'></i>Excluir</button>
                          </td>
                        </tr>

                      <?php endforeach; ?>
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

        <div class="modal fade" id="modal-add-categoria">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Cadastrar Nova Categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_add_categoria">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_categoria">Nome</label>
                    <input type="text" class="form-control" id="nome_categoria_add"
                      placeholder="Informe o nome da nova categoria">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" id="closeModal" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_categoria_add">Salvar</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-edit-categoria">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Categoria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_edit_categoria">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_categoria_edit">Nome</label>
                    <input type="text" class="form-control" id="nome_categoria_edit" value="" autofocus>
                    <input type="hidden" id="nome_categoria_edit" value="">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" id="btn_fechar_categoria_edit"
                    data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_categoria_edit">Salvar</button>
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

    <?php include "partials/footer.php"; ?>

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

  <script src="<?= url("/views/assets/js/categorias.js"); ?>"></script>

</body>

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

    name = $("#nome_categoria_add").val();

    addCategory(name);

    $.ajax({
      url: "<?= $router->route("category.create"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        name: name
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
      url: "<?= $router->route("category.delete"); ?>",
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
        url: "<?= $router->route("category.update"); ?>",
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

</html>