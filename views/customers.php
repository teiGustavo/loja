<?php /** @noinspection PhpUndefinedVariableInspection */
$v = $this;

$params = [
    "title" => "Clientes"
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
              <h1>Clientes</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $router->route("home") ; ?>">Início</a></li>
                <li class="breadcrumb-item active">Clientes</li>
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
                      data-target="#modal-add-cliente"><i class="nav-icon fas fa-plus"></i> Adicionar</button></div>
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
                  <table class="table table-hover text-nowrap" id="customersTable">
                    <thead>
                      <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($customers)):
                        foreach ($customers as $customer):

                            $v->insert("fragments/customer", ["customer" => $customer]);
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

        <div class="modal fade" id="modal-add-cliente">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Cadastrar Novo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_add_cliente" action="<?= $router->route("customer.create"); ?>">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="cpf_cliente_add">CPF</label>
                    <input type="text" class="form-control" id="cpf_cliente_add" name="cpf"
                      placeholder="Informe o CPF do novo cliente">
                  </div>
                  <div class="form-group">
                    <label for="nome_cliente_add">Nome</label>
                    <input type="text" class="form-control" id="nome_cliente_add" placeholder="Informe o nome" name="name">
                  </div>
                  <div class="form-group">
                    <label for="email_cliente_add">Email</label>
                    <input type="email" class="form-control" id="email_cliente_add" placeholder="Informe o email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="datanasc_cliente_add">Data de Nascimento</label>
                    <input type="date" class="form-control" id="datanasc_cliente_add" name="datanasc"
                      placeholder="Informe a data de nascimento">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_cliente_add">Salvar</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-edit-cliente">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_edit_cliente" action="<?= $router->route("customer.update"); ?>">
                <input type="hidden" id="id_cliente_edit" name="id" value="">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="cpf_cliente_edit">CPF</label>
                    <input type="text" class="form-control" id="cpf_cliente_edit" value="" name="cpf" autofocus>
                    <input type="hidden" id="cpf_cliente_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_cliente_edit">Nome</label>
                    <input type="text" class="form-control" id="nome_cliente_edit" value="" name="name" autofocus>
                    <input type="hidden" id="nome_cliente_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="email_cliente_edit">Email</label>
                    <input type="text" class="form-control" id="email_cliente_edit" value="" name="email" autofocus>
                    <input type="hidden" id="email_cliente_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="datanasc_cliente_edit">Data de Nascimento</label>
                    <input type="date" class="form-control" id="datanasc_cliente_edit" value="" name="datanasc" autofocus>
                    <input type="hidden" id="datanasc_cliente_edit" value="">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal"
                    id="btn_fechar_cliente_edit">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_cliente_edit">Salvar</button>
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
        const BODY = $("body");
        const CPF = $("#cpf_cliente_add");
        const CPF_EDIT = $("#cpf_cliente_edit");

        CPF.mask('000.000.000-00');
        CPF_EDIT.mask('000.000.000-00');

        $(function () {
            $("#form_add_cliente").submit(function (e) {
                e.preventDefault();

                let form = $(this);
                let customers = $("tbody");
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

                        if (callback.customer) {
                            customers.append(callback.customer).fadeIn();
                            $("#cpf_cliente_add").val("");
                            $("#nome_cliente_add").val("");
                            $("#email_cliente_add").val("");
                            $("#datanasc_cliente_add").val("");
                            $("#closeModal").trigger("click");
                        }
                    }
                });
            });

            BODY.on("click", "[data-update]", function (e) {
                e.preventDefault();

                let data = $(this).data();
                let div = $(this).parent().parent();

                $("#id_cliente_edit").val(data.id);

                $.ajax({
                    url: data.action,
                    data: {
                        id: data.id
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function (callback) {
                        $("#cpf_cliente_edit").val(callback.customer.cpf);
                        $("#nome_cliente_edit").val(callback.customer.nome);
                        $("#email_cliente_edit").val(callback.customer.email);
                        $("#datanasc_cliente_edit").val(callback.customer.datanasc);
                    }
                });

                $("#form_edit_cliente").submit(function (e) {
                    e.preventDefault();

                    let form = $(this);
                    let customers = $("tbody");
                    let feedback = $(".invalid-feedback");

                    $("#btn_salvar_cliente_edit").attr("disabled");

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
                                    $("#nome_cliente_edit").val("");
                                });
                            }

                            if (callback.customer) {
                                div.fadeOut();
                                customers.append(callback.customer).fadeIn();
                                $("#btn_fechar_cliente_edit").trigger("click");
                                $("#btn_salvar_cliente_edit").removeAttr("disabled");
                            }
                        }
                    });
                });
            });

            BODY.on("click", "[data-delete]", function (e) {
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