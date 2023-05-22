<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= url("/plugins/fontawesome-free/css/all.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/vendor/twbs/bootstrap/dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/views/assets/css/adminlte.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/views/assets/css/default.css"); ?>">
    <link rel="shortcut icon" href="<?= url("/views/assets/img/favicon.ico"); ?>">

    <title>
        <?= $title_prefix; ?> |
        <?= $this->e($title); ?>
    </title>
</head>

<body class="bg-dark-subtle dark-mode d-flex justify-content-center JetBrainsMono"
    style="height: 100vh !important; width: 100vw;">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= url("/views/assets/img/favicon.ico"); ?>" alt="AdminLTELogo" height="60"
            width="60">
    </div>

    <div class="d-flex" style="height: 100vh;">
        <main class="align-self-center" style="width: 50vh;">
            <div class="container bg-dark rounded-2 text-center p-5 h-50">
                <div class="mb-5">
                    <img src="<?= url("/views/assets/img/favicon.ico"); ?>" alt="Favicon.ico" style="width: 5vw;">
                </div>

                <form class="needs-validation" method="POST" action="<?= $router->route("auth.authenticate"); ?>" id="authForm">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" required>
                        <div class="valid-feedback" id="valid-feedback">
                            Parece Bom!
                        </div>
                        <div class="invalid-feedback" id="invalid-feedback">
                            O email informado é invalido!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="password" id="inputPassword" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Manter conectado</label>
                        <div class="invalid-feedback">
                            Email e/ou senha inválidos!
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-light">Entrar</button>
                </form>
            </div>
        </main>
    </div>

    <script src="<?= url("/plugins/jquery/jquery.min.js"); ?>"></script>
    <script src="<?= url("/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?= url("/views/assets/js/adminlte.js"); ?>"></script>
</body>

</html>