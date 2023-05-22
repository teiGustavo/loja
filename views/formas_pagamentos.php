<?php require __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $title_prefix; ?> | Formas de Pagamento
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

    <?php include 'partials/menus.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Formas de Pagamentos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Início</a></li>
                <li class="breadcrumb-item active">Formas de Pagamento</li>
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
                      data-target="#modal-add-forma_pgto"><i class="nav-icon fas fa-plus"></i> Adicionar</button></div>
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
                  <table class="table table-hover text-nowrap" id="paymentsTable">
                    <thead>
                      <tr>
                        <th>Descrição</th>
                        <th>Vezes Utilizada</th>
                        <th>Valor Total</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($payments != null):
                        foreach ($payments as $payment):
                          $payment->getTimesUsed()->getTotalValue();
                          ?>
                          <tr id="payment-<?= $payment->codigo; ?>">
                            <td id="paymentMethod-<?= $payment->codigo; ?>">
                              <?= $payment->descricao; ?>
                            </td>

                            <td codigo="paymentTimesUsed-<?= $payment->codigo; ?>">
                              <?= $payment->timesUsed . "x"; ?>
                            </td>

                            <td codigo="paymentTotalValue-<?= $payment->codigo; ?>">
                              <?= $payment->totalValue != "" ? $payment->totalValue : "R$ 0,00"; ?>
                            </td>

                            <td>
                              <button type="button" class="btn btn-secondary btn-sm" id="btnEditar"
                                value="<?= $payment->codigo; ?>" data-toggle="modal" data-target="#modal-edit-forma_pgto"><i
                                  class="nav-icon fas fa-edit"></i>
                                Editar</button>
                              <button type="button" class="btn btn-danger btn-sm" id="btnExcluir"
                                value="<?= $payment->codigo; ?>"><i class="nav-icon fas fa-trash"></i>
                                Excluir</button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
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

        <div class="modal fade" id="modal-add-forma_pgto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Cadastrar nova Forma de Pagamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_add_forma_pgto">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_forma_pgto">Descrição</label>
                    <input type="text" class="form-control" id="nome_forma_pgto_add"
                      placeholder="Informe a descrição da nova forma de pagamento">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_forma_pgto_add">Salvar</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-edit-forma_pgto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar forma de pagamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_edit_forma_pgto">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_forma_pgto_edit">Nome</label>
                    <input type="text" class="form-control" id="nome_forma_pgto_edit" value="" autofocus>
                    <input type="hidden" id="codigo_forma_pgto_edit" value="">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal"
                    id="btn_fechar_forma_pgto_edit">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_forma_pgto_edit">Salvar</button>
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
  <!-- jQuery Mask  -->
  <script src="<?= url("/plugins/jquery/jquery.mask.min.js"); ?>"></script>

</body>

<script>
  const DESCRIPTION = $("#nome_forma_pgto_add");
  const DESCRIPTION_EDIT = $("#nome_forma_pgto_edit");

  function addPaymentMethod(desc) {
    id = desc.replace(/ /g, '');
    buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
      "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.2rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";

    payment = "<tr id=" + id + " style='display: none;'>" +
      "<td>" + desc + "</td>" +
      "<td>" + "0x" + "</td>" +
      "<td>" + "R$ 0,00" + "</td>" +
      "<td>" + buttons + "</td>" +
      "</tr>";

    $("#paymentsTable tbody").append(payment);
    $("#closeModal").trigger("click");

    $("#" + id).fadeIn(500);
  }

  $("#form_add_forma_pgto").submit(function (event) {
    event.preventDefault();

    desc = DESCRIPTION.val();

    addPaymentMethod(desc);

    $.ajax({
      url: "<?= $router->route("payment-method.create"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        desc: desc
      }
    });
  });

  function removePayment(id) {
    $("#payment-" + id).hide(1000);
  }

  $("body").on("click", "#btnExcluir", function () {
    removePayment($(this).val());

    $.ajax({
      url: "<?= $router->route("payment-method.delete"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        id: $(this).val()
      }
    });
  });

  function modifyCustomer(id, desc) {
    $("#btn_fechar_forma_pgto_edit").trigger("click");

    $("#paymentMethod-" + id).text(desc);
  }

  $("body").on("click", "#btnEditar", function () {
    id = $(this).val();

    descVal = $("#paymentMethod-" + id).text();
    DESCRIPTION_EDIT.val(descVal.trim());

    $("#form_edit_forma_pgto").submit(function (event) {
      event.preventDefault();

      desc = DESCRIPTION_EDIT.val();

      modifyCustomer(id, desc);

      $.ajax({
        url: "<?= $router->route("payment-method.update"); ?>",
        dataType: "json",
        type: "POST",
        data: {
          id: id,
          desc: desc
        }
      });
    });
  });
</script>

</html>