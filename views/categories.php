<?php
$v = $this;

$params = [
  "title" => "Categorias"
];

$v->layout("_theme", $params);
?>

<?php $v->start("contents"); ?>
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
            <li class="breadcrumb-item"><a href="<?= $router->route("home"); ?>">Início</a></li>
            <li class="breadcrumb-item"><a href="<?= $router->route("products"); ?>">Produtos</a></li>
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
                  <input type="text" id="search" name="table_search" class="form-control float-right" placeholder="Pesquisar">

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
                    <th>Quantidade de Produtos</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody class="categories">
                  <?php
                  if (!empty($categories)):
                    foreach ($categories as $category):
                      $category->getProduct();
                      $v->insert("fragments/category", ["category" => $category]);
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

    <div class="modal fade" id="modal-add-categoria">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Cadastrar Nova Categoria</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form id="form_add_categoria" action="<?= $router->route("category.create"); ?>">
            <div class="modal-body">
              <div class="form-group">
                <label for="nome_categoria_add">Nome</label>
                <input type="text" class="form-control" id="nome_categoria_add" name="nome"
                  placeholder="Informe o nome da nova categoria">
              </div>
              <div class="invalid-feedback text-center">Essa categoria já existe!</div>
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

          <form id="form_edit_categoria" action="<?= $router->route("category.update"); ?>">
            <div class="modal-body">
              <div class="form-group">
                <label for="nome_categoria_edit">Nome</label>
                <input type="text" class="form-control" id="nome_categoria_edit" name="nome" value="" autofocus>
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
<?php $v->stop(); ?>

<?php $v->start("js"); ?>
<script>
    $("#search").on("keyup", function () {
        let val = $(this).val();
        val = (val.charAt(0).toUpperCase() + val.slice(1));
        let td = $("td:not(:contains(" + val + "))");

        if (val !== "") {
            td.hide();
        } else {
            $("td").show();
            $("tr").show();
        }
    });

  $(function () {
    $("#form_add_categoria").submit(function (e) {
      e.preventDefault();

      let form = $(this);
      let categories = $(".categories");
      let feedback = $(".invalid-feedback");

      $.ajax({
        url: form.attr("action"),
        data: form.serialize(),
        type: "POST",
        dataType: "JSON",
        beforeSend: function () {

        },
        success: function (callback) {
          if (callback.message) {
            feedback.html(callback.message).fadeIn();
          } else {
            feedback.fadeOut(function () {
              $(this).html("");
            });
          }

          if (callback.category) {
            categories.append(callback.category).fadeIn();
            $("#nome_categoria_add").val("");
            $("#closeModal").trigger("click");
          }
        },
        complete: function () {

        }
      });
    });

    $("body").on("click", "[data-update]", function (e) {
      e.preventDefault();

      let data = $(this).data();
      let div = $(this).parent().parent();

      $.ajax({
        url: data.action,
        data: {
          id : data.id
        },
        type: "POST",
        dataType: "JSON",
        success: function (callback) {
          $("#nome_categoria_edit").val(callback.category.nome);
        }
      });

      $("#form_edit_categoria").submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let categories = $(".categories");
        let feedback = $(".invalid-feedback");

        $("#btn_salvar_categoria_edit").attr("disabled");

        $.ajax({
          url: form.attr("action"),
          data: {
            id: data.id,
            nome: $("#nome_categoria_edit").val()
          },
          type: "POST",
          dataType: "JSON",
          success: function (callback) {
            if (callback.message) {
              feedback.html(callback.message).fadeIn();
            } else {
              feedback.fadeOut(function () {
                $(this).html("");
                $("#nome_categoria_edit").val("");
              });
            }

            if (callback.category) {
              div.fadeOut();
              categories.append(callback.category).fadeIn();
              $("#btn_fechar_categoria_edit").trigger("click");
              $("#btn_salvar_categoria_edit").removeAttr("disabled");
            }
          }
        });
      });
    });

    $("body").on("click", "[data-delete]", function (e) {
      e.preventDefault();

      let data = $(this).data();
      let div = $(this).parent().parent();

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