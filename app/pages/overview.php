<?php must_login() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Ikhtisar') ?></title>
    <?php include './app/pages/_layouts/css.php' ?>
</head>

<body class="waska-body bg-lighter npc-general has-sidebar">
    <div class="waska-app-root">
        <div class="waska-main">
            <?php include './app/pages/_layouts/sidebar.php' ?>

            <div class="waska-wrap">
                <?php include './app/pages/_layouts/header.php' ?>

                <div class="waska-content">
                </div>

                <?php include './app/pages/_layouts/footer.php' ?>
            </div>
        </div>
    </div>

    <?php include './app/pages/_layouts/js.php' ?>
</body>

</html>
