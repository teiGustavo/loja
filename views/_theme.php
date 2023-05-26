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
            <img class="animation__shake" src="<?= url("/views/assets/img/favicon.ico"); ?>" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <?php include "partials/menus.php"; ?>

        <?= $this->section("contents"); ?>

        <?php include "partials/footer.php"; ?>

    </div>


    <script src="<?= url("/plugins/jquery/jquery.min.js"); ?>"></script>
    <script src="<?= url("/plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?= url("/views/assets/js/adminlte.min.js"); ?>"></script>
    <script src="<?= url("/views/assets/js/demo.js"); ?>"></script>
    <script src="<?= url("/views/assets/js/bootbox.min.js"); ?>"></script>

    <?= $this->section("script"); ?>

</body>

<?= $this->section("js"); ?>

</html>