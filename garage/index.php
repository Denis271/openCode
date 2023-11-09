<?php
require_once 'includes/checkSession.php';
require_once 'includes/db.php';


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/free-icon-garage-846316.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гараж</title>
</head>
<body>
    <div class="butExitUser"><a href="includes/authorization/index">выход</a></div>
    <div class='conteiner'>
        <a href="drivers/index"><div>Водители</div></a>
        <a href="cars/index"><div>Автомобили</div></a>
    </div>
</body>
</html>