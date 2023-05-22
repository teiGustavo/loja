<?php require __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $title_prefix; ?> | Clientes
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
              <h1>Clientes</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Início</a></li>
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
                      <?php foreach ($customers as $customer):
                        ?>
                        <tr id="customer-<?= $customer->id; ?>">
                          <td id="customerCpf-<?= $customer->id; ?>">
                            <?= $customer->cpf; ?>
                          </td>

                          <td id="customerName-<?= $customer->id; ?>">
                            <?= $customer->nome; ?>
                          </td>

                          <td id="customerEmail-<?= $customer->id; ?>">
                            <?= $customer->email; ?>
                          </td>

                          <td id="customerDateBirth-<?= $customer->id; ?>" class="d-none">
                            <?= $customer->datanasc; ?>
                          </td>

                          <td>
                            <?= $customer->datacadastro; ?>
                          </td>

                          <td>
                            <button type="button" class="btn btn-secondary btn-sm" id="btnEditar"
                              value="<?= $customer->id; ?>" data-toggle="modal" data-target="#modal-edit-cliente"><i
                                class="nav-icon fas fa-edit"></i>
                              Editar</button>
                            <button type="button" class="btn btn-danger btn-sm" id="btnExcluir"
                              value="<?= $customer->id; ?>"><i class="nav-icon fas fa-trash"></i>
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

        <div class="modal fade" id="modal-add-cliente">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Cadastrar Novo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_add_cliente">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="cpf_cliente">CPF</label>
                    <input type="text" class="form-control" id="cpf_cliente_add"
                      placeholder="Informe o CPF do novo cliente">
                  </div>
                  <div class="form-group">
                    <label for="nome_cliente">Nome</label>
                    <input type="text" class="form-control" id="nome_cliente_add" placeholder="Informe o nome">
                  </div>
                  <div class="form-group">
                    <label for="email_cliente">Email</label>
                    <input type="email" class="form-control" id="email_cliente_add" placeholder="Informe o email">
                  </div>
                  <div class="form-group">
                    <label for="datanasc_cliente">Data de Nascimento</label>
                    <input type="date" class="form-control" id="datanasc_cliente_add"
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

              <form id="form_edit_cliente">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nome_cliente_edit">CPF</label>
                    <input type="text" class="form-control" id="cpf_cliente_edit" value="" autofocus>
                    <input type="hidden" id="cpf_cliente_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_cliente_edit">Nome</label>
                    <input type="text" class="form-control" id="nome_cliente_edit" value="" autofocus>
                    <input type="hidden" id="nome_cliente_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_cliente_edit">Email</label>
                    <input type="text" class="form-control" id="email_cliente_edit" value="" autofocus>
                    <input type="hidden" id="email_cliente_edit" value="">
                  </div>
                  <div class="form-group">
                    <label for="nome_cliente_edit">Data de Nascimento</label>
                    <input type="date" class="form-control" id="datanasc_cliente_edit" value="" autofocus>
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
  const CPF = $("#cpf_cliente_add");
  const NAME = $("#nome_cliente_add");
  const EMAIL = $("#email_cliente_add");
  const DATE_BIRTH = $("#datanasc_cliente_add");

  const CPF_EDIT = $("#cpf_cliente_edit");
  const NAME_EDIT = $("#nome_cliente_edit");
  const EMAIL_EDIT = $("#email_cliente_edit");
  const DATE_BIRTH_EDIT = $("#datanasc_cliente_edit");

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

  function addCustomer(cpf, name, email) {
    cpfUnmask = CPF.unmask().val();
    dateCad = getNowDate();

    buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
      "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.2rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";

    customer = "<tr id=" + cpfUnmask + " style='display: none;'>" +
      "<td>" + cpf + "</td>" +
      "<td>" + name + "</td>" +
      "<td>" + email + "</td>" +
      "<td>" + dateCad + "</td>" +
      "<td>" + buttons + "</td>" +
      "</tr>";

    $("#customersTable tbody").append(customer);
    $("#closeModal").trigger("click");

    $("#" + cpfUnmask).fadeIn(500);

    CPF.val("").mask('000.000.000-00');
    NAME.val("");
    EMAIL.val("");
    DATE_BIRTH.val("");
  }

  //Formulário responsável por adicionar um cliente
  $("#form_add_cliente").submit(function (event) {
    event.preventDefault();

    cpf = CPF.val();
    name = NAME.val();
    email = EMAIL.val();
    dateBirth = DATE_BIRTH.val();

    addCustomer(cpf, name, email);

    //cpf = CPF.unmask().val();

    $.ajax({
      url: "<?= $router->route("customer.create"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        cpf: cpf,
        name: name,
        email: email,
        dateBirth: dateBirth
      }
    })
  });

  function removeCustomer(id) {
    $("#customer-" + id).hide(1000);
  }

  //Botao de excluir clientes
  $("body").on("click", "#btnExcluir", function () {
    removeCustomer($(this).val());

    $.ajax({
      url: "<?= $router->route("customer.delete"); ?>",
      dataType: "json",
      type: "POST",
      data: {
        id: $(this).val()
      }
    });
  });

  function modifyCustomer(id, cpf, name, email, dateBirth) {
    $("#btn_fechar_cliente_edit").trigger("click");

    $("#customerCpf-" + id).text(cpf);
    $("#customerName-" + id).text(name);
    $("#customerEmail-" + id).text(email);
    $("#customerDateBirth-" + id).text(dateBirth);
  }

  //Botao de editar Clientes
  $("body").on("click", "#btnEditar", function () {
    id = $(this).val();

    cpfVal = $("#customerCpf-" + id).text().trim();
    nameVal = $("#customerName-" + id).text().trim();
    emailVal = $("#customerEmail-" + id).text().trim();
    dateVal = $("#customerDateBirth-" + id).text().trim();

    dateVals = dateVal.split("/");
    dateVal = dateVals[2] + "-" + dateVals[1] + "-" + dateVals[0];

    CPF_EDIT.val(cpfVal);
    NAME_EDIT.val(nameVal);
    EMAIL_EDIT.val(emailVal);
    DATE_BIRTH_EDIT.val(dateVal);

    //Formulário responsável por editar um cliente
    $("#form_edit_cliente").submit(function (event) {
      event.preventDefault();

      cpf = CPF_EDIT.val();
      name = NAME_EDIT.val();
      email = EMAIL_EDIT.val();
      dateBirth = DATE_BIRTH_EDIT.val();

      modifyCustomer(id, cpf, name, email, dateBirth);

      //cpf = CPF_EDIT.unmask().val();

      $.ajax({
        url: "<?= $router->route("customer.update"); ?>",
        dataType: "json",
        type: "POST",
        data: {
          id: id,
          cpf: cpf,
          name: name,
          email: email,
          dateBirth: dateBirth
        }
      });
    });
  });
</script>

</html>