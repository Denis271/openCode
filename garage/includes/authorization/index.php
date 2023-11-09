<?php //уничтожение ссесий
if (!isset($_SESSION)) { session_start(); } 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация</title>
</head>
<body>
    <div class="formConteiner">
        <form id="Form" name="Form" action="" method="POST">
            <div class="nameInput">Логин</div>
            <input name="login" type="text">
            <div class="nameInput">Пароль</div>
            <input name="password" type="password">
            <span id="errorForm" >Неверно введен логин или пароль</span>
            <input id="butForm" type="submit" value="Вход">
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>