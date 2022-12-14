<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Terjadi Kesalahan') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <h1 class="display-1 fw-bold"><?= http_response_code() ?></h1>
            <p class="fs-3 mb-0 text-danger">Oops! Terjadi Kesalahan</p>

            <p class="lead mb-3 fs-6">Yuk kembali ke jalan yang benar.</p>
            <a href="<?= base_url() ?>" class="btn btn-primary">Ke Rumah</a>
        </div>
    </div>
</body>

</html>
