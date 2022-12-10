<?php must_login(true) ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Masuk') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="<?= current_url() ?>" method="POST">
            <img class="mb-0" src="<?= base_url('assets/img/waska.png') ?>" alt="<?= APP_NAME ?>" height="120">
            <h1 class="h3 mb-3 fw-normal">Masuk ke <?= APP_NAME ?></h1>

            <?php if (flashdata('error')) : ?>
                <div class="text-start alert alert-danger" role="alert">
                    <?= flashdata('error') ?>
                </div>
            <?php endif ?>

            <?php if (flashdata('success')) : ?>
                <div class="text-start alert alert-success" role="alert">
                    <?= flashdata('success') ?>
                </div>
            <?php endif ?>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna">
                <label for="username">Nama Pengguna</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
                <label for="password">Kata Sandi</label>
            </div>

            <div class="checkbox mb-3">
                <label class="d-flex align-items-center justify-content-center gap-2">
                    <input type="checkbox" class="form-check-input mt-0" name="remember" value="1"> Tetap masuk
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
            <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?> <?= APP_NAME ?></p>
        </form>
    </main>
</body>

</html>
