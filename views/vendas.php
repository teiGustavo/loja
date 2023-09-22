<?php require __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title_prefix; ?> | Vendas
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

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= url("/vendor/select2/select2/dist/css/select2.min.css"); ?>">
    <!-- Favicon.ico -->
    <link rel="shortcut icon" href="<?= url("/views/assets/img/favicon.ico"); ?>">
    <!-- Default CSS -->
    <link rel="stylesheet" href="<?= url("/views/assets/css/default.css"); ?>">
</head>

<body class="hold-transition sidebar-mini dark-mode sidebar-collapse">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= url("/views/assets/img/favicon.ico"); ?>" alt="AdminLTELogo" height="60"
             width="60">
    </div>

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
                            <li class="breadcrumb-item"><a href="<?= $router->route("home"); ?>">Início</a></li>
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
                                <div class="card-title">
                                    <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                                            data-target="#modal-add-venda"><i class="nav-icon fas fa-plus"></i>
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
                                <table class="table table-hover text-nowrap" id="ordersTable">
                                    <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Forma de Pagamento</th>
                                        <th>Número de Parcelas</th>
                                        <th>Valor</th>
                                        <th>Data da Venda</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orders as $order):
                                        $order->getCustomer()->data();
                                        $order->getPayment()->data();
                                        $order->getOrderDetails()->data();
                                        ?>
                                        <tr id="order-<?= $order->id; ?>">
                                            <td id="orderCpf-<?= $order->id; ?>">
                                                <?= $order->customer->cpf; ?>
                                            </td>

                                            <td id="orderPaymentMethod-<?= $order->id; ?>">
                                                <?= $order->payment->descricao; ?>
                                            </td>

                                            <td id="orderPaymentMethodId-<?= $order->id; ?>" class="d-none">
                                                <?= $order->payment->codigo; ?>
                                            </td>

                                            <ul id="orderProduct-<?= $order->id; ?>" class="d-none">
                                                <?php if ($order->orderDetails != null):
                                                    foreach ($order->orderDetails as $orderDetail):
                                                    //var_dump($orderDetail->data());
                                                    ?>

                                                    <li class="d-none">
                                                        <?= $orderDetail->produto; ?>
                                                    </li>

                                                <?php endforeach;
                                                    endif; ?>
                                            </ul>

                                            <td id="orderQuantity-<?= $order->id; ?>">
                                                <?= $order->numparcelas . "x sem juros"; ?>
                                            </td>

                                            <td id="orderValue-<?= $order->id; ?>">
                                                <?php
                                                $orderValue = 0.0;

                                                if ($order->orderDetails != null) {
                                                    foreach ($order->orderDetails as $orderDetail) {
                                                        $orderValue += $orderDetail->valor;
                                                    }
                                                }

                                                $orderValue = number_format($orderValue, 2, ",", ".");

                                                $order->totalValue = "R$ " . $orderValue;
                                                ?>

                                                <?= $order->totalValue; ?>
                                            </td>

                                            <td>
                                                <?= $order->datavenda; ?>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm" id="btnEditar"
                                                        value="<?= $order->id; ?>" data-toggle="modal"
                                                        data-target="#modal-edit-venda"><i
                                                            class="nav-icon fas fa-edit"></i>
                                                    Editar
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" id="btnExcluir"
                                                        value="<?= $order->id; ?>"><i class="nav-icon fas fa-trash"></i>
                                                    Excluir
                                                </button>
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
                                <!--div class="form-group">
                                  <label for="cpf_venda">CPF</label>
                                  <input type="text" class="form-control" id="cpf_venda_add"
                                    placeholder="Informe o CPF da nova venda">
                                </div-->

                                <div class="form-group d-flex flex-column">
                                    <label for="cpf_venda_add" class="form-label">Cliente</label>
                                    <select class="js-example-basic-single" id="cpf_venda_add">
                                        <option selected>Selecione o cliente</option>

                                        <?php foreach ($customers as $customer):
                                            ?>

                                            <option value="<?= $customer->cpf; ?>">
                                                <?= $customer->nome . " - " . $customer->cpf; ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="form-group d-flex flex-column">
                                    <label for="forma_pgto_venda_add" class="form-label">Forma de Pagamento</label>
                                    <select class="select" id="forma_pgto_venda_add">
                                        <option selected>Selecione a forma de pagamento</option>

                                        <?php foreach ($methodPayments as $methodPayment):
                                            ?>

                                            <option id="optionPayment-<?= $methodPayment->codigo; ?>"
                                                    value="<?= $methodPayment->codigo; ?>">
                                                <?= $methodPayment->descricao; ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="form-group d-flex flex-column select2-dark">
                                    <label for="forma_pgto_venda_add" class="form-label">Produtos</label>

                                    <!--select class="select" id="forma_pgto_venda_add"-->
                                    <select class="js-example-theme-multiple" name="states[]" multiple="multiple"
                                            id="produtos_venda_add">
                                        <!--option selected>Selecione a forma de pagamento</option-->

                                        <?php foreach ($products as $product):
                                            ?>

                                            <option value="<?= $product->codigo_produto; ?>">
                                                <?= mb_strimwidth($product->nome, 0, 60, "..."); ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nome_venda">Número de Parcelas</label>
                                    <input type="number" class="form-control" id="numero_parcelas_venda_add"
                                           placeholder="Informe a quantidade de parcelas" value="1" min="1" max="12">
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">
                                    Fechar
                                </button>
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
                                <div class="form-group d-flex flex-column">
                                    <label for="cpf_venda_edit" class="form-label">Cliente</label>
                                    <select class="" id="cpf_venda_edit">
                                        <?php foreach ($customers as $customer):
                                            ?>

                                            <option value="<?= $customer->cpf; ?>">
                                                <?= $customer->nome . " - " . $customer->cpf; ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nome_produto_edit" class="form-label">Forma de Pagamento</label>
                                    <!--select class="js-example-basic-multiple" name="states[]" multiple="multiple"-->
                                    <select class="select" id="forma_pgto_venda_edit">

                                        <?php foreach ($methodPayments as $methodPayment):
                                            ?>

                                            <option value="<?= $methodPayment->codigo; ?>"><?= $methodPayment->descricao; ?></option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nome_venda">Número de Parcelas</label>
                                    <input type="number" class="form-control" id="numero_parcelas_venda_edit" value="1"
                                           min="1"
                                           max="12">
                                    <input type="hidden" id="numero_parcelas_venda_edit" value="">
                                </div>

                                <div class="form-group d-flex flex-column select2-dark">
                                    <label for="produtos_venda_edit" class="form-label">Produtos</label>

                                    <!--select class="select" id="forma_pgto_venda_add"-->
                                    <select class="js-example-theme-multiple" name="products[]" multiple="multiple"
                                            id="produtos_venda_edit">
                                        <!--option selected>Selecione a forma de pagamento</option-->

                                        <?php foreach ($products as $product):
                                            ?>

                                            <option value="<?= $product->codigo_produto; ?>"><?= mb_strimwidth($product->nome, 0, 60, "..."); ?></option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>

                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                        id="btn_fechar_venda_edit">Fechar
                                </button>
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
<!-- Select2  -->
<script src="<?= url("/vendor/select2/select2/dist/js/select2.min.js"); ?>"></script>

</body>

<script>
    const CPF = $("#cpf_venda_add");
    const PAYMENT_METHOD = $("#forma_pgto_venda_add");
    const QUANTITY_PARCELAS = $("#numero_parcelas_venda_add");
    const PRODUCTS = $("#produtos_venda_add");

    const CPF_EDIT = $("#cpf_venda_edit");
    const PAYMENT_METHOD_EDIT = $("#forma_pgto_venda_edit");
    const QUANTITY_PARCELAS_EDIT = $("#numero_parcelas_venda_edit");
    const PRODUCTS_EDIT = $("#produtos_venda_edit");

    PAYMENT_METHOD.addClass("p-2");

    //CPF.mask('000.000.000-00');
    //CPF_EDIT.mask('000.000.000-00');

    $(document).ready(function () {
        $('.js-example-basic-single').select2({
            placeholder: "Selecione o CPF do cliente"
        });

        $('.js-example-theme-multiple').select2({
            placeholder: "Selecione os produtos"
        });

        $("span").addClass("bg-dark");
        $("span .select2-selection").addClass("h-auto");
        $("span .select2-selection__arrow").css("height", "95%");
    });

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
        cpfUnmask = cpf.replace(".", "");
        cpfUnmask = cpfUnmask.replace("-", "").substring(0, 5);
        dateCad = getNowDate();
        payment = $("#optionPayment-" + paymentMethod).text();

        buttons = "<button type='button' class='btn btn-secondary btn-sm'><i class='nav-icon fas fa-edit'></i>Editar</button>" +
            "<button type='button' id='btnExcluir' class='btn btn-danger btn-sm' style='margin-left: 0.2rem;'><i class='nav-icon fas fa-trash' style='margin-right: 0.1rem;'></i>Excluir</button>";

        order = "<tr id=" + cpfUnmask + " style='display: none;'>" +
            "<td>" + cpf + "</td>" +
            "<td>" + payment + "</td>" +
            "<td>" + quantity + "x sem juros</td>" +
            "<td>" + dateCad + "</td>" +
            "<td>" + buttons + "</td>" +
            "</tr>";

        $("#ordersTable tbody").append(order);
        $("#closeModal").trigger("click");

        $("#" + cpfUnmask).fadeIn(500);

        PAYMENT_METHOD.val("Selecione a forma de pagamento");
        QUANTITY_PARCELAS.val(1);
        PRODUCTS.val(null).trigger("change");
        CPF.val(null).trigger("change");
    }

    //Formulário responsável por adicionar um order
    $("#form_add_venda").submit(function (event) {
        event.preventDefault();

        cpf = CPF.val();
        paymentMethod = PAYMENT_METHOD.val();
        quantity = QUANTITY_PARCELAS.unmask().val();
        products = PRODUCTS.val();

        addOrder(cpf, paymentMethod, quantity);

        $.ajax({
            url: "<?= $router->route("order.create"); ?>",
            dataType: "json",
            type: "POST",
            data: {
                cpf: cpf,
                paymentMethod: paymentMethod,
                quantity: quantity,
                products: products
            }
        })
    });

    function removeOrder(id) {
        $("#order-" + id).hide(1000);
    }

    //Botão de excluir Vendas
    $("body").on("click", "#btnExcluir", function () {
        removeOrder($(this).val());

        $.ajax({
            url: "<?= $router->route("order.delete"); ?>",
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

        PRODUCTS_EDIT.val(null).trigger("change");
    }

    //Botão de editar Vendas
    $("body").on("click", "#btnEditar", function () {
        id = $(this).val();

        cpfVal = $("#orderCpf-" + id).text();
        paymentVal = $("#orderPaymentMethodId-" + id).text();
        quantityVal = $("#orderQuantity-" + id).text().replace("x sem juros", "");

        var productsVal = [];
        $("#orderProduct-" + id + " li").each(function (i) {
            productsVal.push($(this).text().trim());
        });

        CPF_EDIT.val(cpfVal.trim());
        PAYMENT_METHOD_EDIT.val(paymentVal.trim()).attr("selected");
        QUANTITY_PARCELAS_EDIT.val(quantityVal.trim());

        PRODUCTS_EDIT.val(productsVal);
        PRODUCTS_EDIT.trigger("change");

        $("#form_edit_venda").submit(function (event) {
            event.preventDefault();

            cpf = CPF_EDIT.val();
            paymentMethod = PAYMENT_METHOD_EDIT.val();
            quantity = QUANTITY_PARCELAS_EDIT.val();
            products = PRODUCTS_EDIT.val();

            modifyOrder(id, cpf, paymentMethod, quantity);

            $.ajax({
                url: "<?= $router->route("order.update"); ?>",
                dataType: "json",
                type: "POST",
                data: {
                    id: id,
                    cpf: cpf,
                    paymentMethod: paymentMethod,
                    quantity: quantity,
                    products: products
                }
            });
        });
    });
</script>

</html>