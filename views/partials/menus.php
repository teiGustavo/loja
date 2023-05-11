<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= $router->route("loja.home") ?>" class="nav-link">Início</a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="<?= $router->route("loja.home") ?>" class="brand-link">
    <img src="<?= url("/views/assets/img/AdminLTELogo.png"); ?>" alt="Nossa Loja" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?= $title_prefix; ?></span>
</a>

<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="<?= $router->route("loja.home") ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Início</p>
        </a>
        </li>

        <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-barcode"></i>
            <p>Produtos <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
            <a href="<?= $router->route("loja.produtos") ?>" class="nav-link">
                <i class="nav-icon fas fa-bars"></i>
                <p>Listar</p>
            </a>
            </li>
            <li class="nav-item">
            <a href="<?= $router->route("loja.categorias") ?>" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>Categorias</p>
            </a>
            </li>
        </ul>
        </li>

        <li class="nav-item">
        <a href="<?= $router->route("loja.clientes") ?>" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Clientes</p>
        </a>
        </li>

        <li class="nav-item">
        <a href="<?= $router->route("loja.vendas") ?>" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Vendas</p>
        </a>
        </li>

        <li class="nav-item">
        <a href="<?= $router->route("loja.formaspgto") ?>" class="nav-link">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>Formas de Pagamento</p>
        </a>
        </li>

    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>