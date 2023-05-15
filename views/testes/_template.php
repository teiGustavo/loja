<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $title_prefix; ?> |
    <?= $this->e($title); ?>
  </title>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= url("/plugins/fontawesome-free/css/all.min.css"); ?>">
  <link rel="stylesheet" href="<?= url("/views/assets/css/adminlte.min.css"); ?>">
  <link rel="stylesheet" href="<?= url("/views/assets/css/loading.css"); ?>">
  <link rel="shortcut icon" href="<?= url("/views/assets/img/favicon.ico"); ?>">

  <!-- Extra Styles -->
  <?= $this->section("style"); ?>
</head>

<body class="hold-transition sidebar-mini dark-mode sidebar-collapse">

  <div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= url("/views/assets/img/favicon.ico"); ?>" alt="AdminLTELogo" height="60"
        width="60">
    </div>

    <?php include "partials/menus.php"; ?>

    <div class="content-wrapper">

      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">

            <div class="col-sm-6">
              <h1>
                <?= $this->e($title); ?>
              </h1>
            </div>

          </div>
        </div>
      </section>

      <section class="content">

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <div class="card-title">
                    <button type="button" class="btn btn-success btn-flat" data-toggle="modal"
                      data-target="#modal-add-<?= $this->e($idSuffix); ?>"><i class="nav-icon fas fa-plus"></i>
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

                <div class="card-body table-responsive p-0">

                  <table class="table table-hover text-nowrap" id="<?= $this->e($tableId); ?>">
                    <thead>
                      <?= $this->section("table-thead"); ?>
                    </thead>
                    <tbody>
                      <?= $this->section("table-tbody"); ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal-add-<?= $this->e($idSuffix); ?>">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">
                  <?= $this->e($modalAddTitle); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_add_<?= $this->e($idSuffix); ?>">
                <?= $this->section("modal-add-form"); ?>
              </form>

            </div>
          </div>
        </div>

        <div class="modal fade" id="modal-edit-<?= $this->e($idSuffix); ?>">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">
                  <?= $this->e($modaEditlTitle); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form id="form_edit_<?= $this->e($idSuffix); ?>">
                <?= $this->section("modal-edit-form"); ?>
              </form>

              <div id="Loading" class="d-none"></div>
            </div>
          </div>
        </div>
      </section>

    </div>

    <footer class="main-footer">

      <div class="float-right d-none d-sm-block">
        
        <b>ShopGestor - Version</b> 1.0.0
      </div>

      <strong>
        Copyright &copy; 2023
      </strong>

    </footer>


    <!--aside class="control-sidebar control-sidebar-dark"></aside-->

  </div>


  <script src="<?= url("/plugins/jquery/jquery.min.js"); ?>"></script>
  <script src="<?= url("/plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
  <script src="<?= url("/views/assets/js/adminlte.min.js"); ?>"></script>
  <script src="<?= url("/views/assets/js/demo.js"); ?>"></script>
  <script src="<?= url("/views/assets/js/bootbox.min.js"); ?>"></script>
  <script src="<?= url("/views/assets/js/categorias.js"); ?>"></script>

</body>

<?= $this->section("script"); ?>

</html>