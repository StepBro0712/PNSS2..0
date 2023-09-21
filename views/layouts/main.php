<?php

use Src\Auth\Auth;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>У-МУ</title>
    <link href="../../../mvc/public/assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <nav>
        <h1 class="Logo"><a href="<?= app()->route->getUrl('/hello') ?>">У-МУ</a></h1>
        <div class="navi">
            <?php
            if (app()->auth::check()):
                ?>
                <a href="<?= app()->route->getUrl('/profile') ?>"><p><?= app()->auth::user()->role; ?></p></a>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
            <?php
            endif;
            ?>
        </div>
    </nav>

</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>


