<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SistemAdm</title>
</head>
<body>
    <?php
    require './vendor/autoload.php';
    $home = new Core\ConfigController();
    $home->loadPage();

    ?>
</body>
</html>