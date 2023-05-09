<?php require __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title_prefix; ?> | Vendas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= url("/plugins/fontawesome-free/css/all.min.css"); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= url("/views/assets/css/adminlte.min.css"); ?>">
  <link rel="stylesheet" href="<?= url("/views/assets/css/loading.css"); ?>"
  >
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
              <h1>Vendas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Início</a></li>
                <li class="breadcrumb-item active">Vendas</li>
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
                      data-target="#modal-add-venda"><i class="nav-icon fas fa-plus"></i> Adicionar</button></div>
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
                  <table class="table table-hover text-nowrap" id="ordersTable">
                    <thead>
                      <tr>
                        <th>CPF</th>
                        <th>Forma de Pagamento</th>
                        <th>Número de Parcelas</th>
                        <th>Data da Venda</th>
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($orders as $order):
                        ?>
                        <tr id="order-<?= $order->id; ?>">
                          <td id="orderCpf-<?= $order->id; ?>">
                            <?= $order->cliente; ?>
                          </td>

                          <td id="orderPaymentMethod-<?= $order->id; ?>">
                            <?= $order->formapgto; ?>
                          </td>

                          <td id="orderQuantity-<?= $order->id; ?>">
                            <?= $order->numparcelas . "x sem juros"; ?>
                          </td>

                          <td>
                            <?= $order->datavenda; ?>
                          </td>

                          <td>
                            <button type="button" class="btn btn-secondary btn-sm" id="btnEditar"
                              value="<?= $order->id; ?>" data-toggle="modal" data-target="#modal-edit-venda"><i
                                class="nav-icon fas fa-edit"></i>
                              Editar</button>
                            <button type="button" class="btn btn-danger btn-sm" id="btnExcluir"
                              value="<?= $order->id; ?>"><i class="nav-icon fas fa-trash"></i>
                              Excluir</button>
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

        <div class="modal fade" id="modal-add-venda">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Cadastrar Nova Venda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_add_venda">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="cpf_venda">CPF</label>
                    <input type="text" class="form-control" id="cpf_venda_add"
                      placeholder="Informe o CPF da nova venda">
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit" class="form-label">Categoria</label>
                    <select class="select" id="forma_pgto_venda_add">
                      <option selected>Selecione a categoria</option>

                      <?php foreach ($methodPayments as $methodPayment):
                        ?>

                        <option value="<?= $methodPayment->codigo; ?>"><?= $methodPayment->descricao; ?></option>

                      <?php endforeach; ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nome_venda">Número de Parcelas</label>
                    <input type="number" class="form-control" id="numero_parcelas_venda_add" placeholder="Informe a quantidade de parcelas" min="1" max="12">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_venda_add">Salvar</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-edit-venda">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Venda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_edit_venda">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_venda_edit">CPF</label>
                    <input type="text" class="form-control" id="cpf_venda_edit" value="" autofocus>
                    <input type="hidden" id="cpf_venda_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_produto_edit" class="form-label">Categoria</label>
                    <select class="select" id="forma_pgto_venda_edit">

                      <?php foreach ($methodPayments as $methodPayment):
                        ?>

                        <option value="<?= $methodPayment->codigo; ?>"><?= $methodPayment->descricao; ?></option>

                      <?php endforeach; ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nome_venda">Número de Parcelas</label>
                    <input type="number" class="form-control" id="numero_parcelas_venda_edit" min="1" max="12">
                    <input type="hidden" id="numero_parcelas_venda_edit" value="">
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal"
                    id="btn_fechar_venda_edit">Fechar</button>
                  <button type="submit" class="btn btn-success" id="btn_salvar_venda_edit">Salvar</button>
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
  const CPF = $("#cpf_venda_add");
  const PAYMENT_METHOD = $("#forma_pgto_venda_add");
  const QUANTITY_PARCELAS = $("#numero_parcelas_venda_add");


  const CPF_EDIT = $("#cpf_venda_edit");
  const PAYMENT_METHOD_EDIT = $("#forma_pgto_venda_edit");
  const QUANTITY_PARCELAS_EDIT = $("#numero_parcelas_venda_edit");



  CPF.mask('000.000.000-00');
  CPF_EDIT.mask('000.000.000-00');

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

  function addOrder(cpf, paymentMethod, quantity) {
    cpfUnmask = CPF.unmask().val();
    dateCad = getNowDate();

    buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
      "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.2rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";

    order = "<tr id=" + cpfUnmask + " style='display: none;'>" +
      "<td>" + cpf + "</td>" +
      "<td>" + paymentMethod + "</td>" +
      "<td>" + quantity + "x sem juros</td>" +
      "<td>" + dateCad + "</td>" +
      "<td>" + buttons + "</td>" +
      "</tr>";

    $("#ordersTable tbody").append(order);
    $("#closeModal").trigger("click");

    $("#" + cpfUnmask).fadeIn(500);
  }

  //Formulário responsável por adicionar um order
  $("#form_add_venda").submit(function (event) {
    event.preventDefault();
    
    cpf = CPF.val();
    paymentMethod = PAYMENT_METHOD.val();
    quantity = QUANTITY_PARCELAS.unmask().val();
    
    addOrder(cpf, paymentMethod, quantity);
    
    cpf = CPF.unmask().val();

    $.ajax({
      url: "<?= $router->route("loja.cadastrar.venda"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        cpf: cpf,
        paymentMethod: paymentMethod,
        quantity: quantity
      }
    })
  });

  function removeOrder(id) {
    $("#order-" + id).hide(1000);
  }

  //Botao de excluir Vendas
  $("body").on("click", "#btnExcluir", function () {
    removeOrder($(this).val());

    $.ajax({
      url: "<?= $router->route("loja.excluir.venda"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        id: $(this).val()
      }
    });
  });

  function modifyOrder(id, cpf, paymentMethod, quantity) {
    $("#btn_fechar_venda_edit").trigger("click");

    $("#orderCpf-" + id).text(cpf);
    $("#orderPaymentMethod-" + id).text(paymentMethod);
    $("#orderQuantity-" + id).text(quantity + "x sem juros");
  }

  //Botao de editar Vendas
  $("body").on("click", "#btnEditar", function () {
    id = $(this).val();

    cpfVal = $("#orderCpf-" + id).text();
    paymentVal = $("#orderPaymentMethod-" + id).text();
    quantityVal = $("#orderQuantity-" + id).text().replace("x sem juros", ""); 

    CPF_EDIT.val(cpfVal.trim());
    PAYMENT_METHOD_EDIT.val(paymentVal.trim());
    QUANTITY_PARCELAS_EDIT.val(quantityVal.trim());

    $("#form_edit_venda").submit(function (event) {
      event.preventDefault();

      cpf = CPF_EDIT.val();
      paymentMethod = PAYMENT_METHOD_EDIT.val();
      quantity = QUANTITY_PARCELAS_EDIT.val();

      modifyOrder(id, cpf, paymentMethod, quantity);

      unmaskCpf = CPF_EDIT.unmask().val();

      $.ajax({
        url: "<?= $router->route("loja.editar.venda"); ?>",
        dataType: "json",
        type: "POST",
        data: {
          id: id,
          cpf: unmaskCpf,
          paymentMethod: paymentMethod,
          quantity: quantity
        }
      });
    });
  });
</script>

</html>