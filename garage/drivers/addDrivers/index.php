<?php
require_once '../../includes/checkSession.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <title>Новый водитель</title>
</head>
<body>
    <div class="butBack"><a href="../index">Назад</a></div>
    <div class="conteinerForm">
        <div class="errorForm" style="display:none" id="errorInput">Все поля обязательны для заполнения</div>
        <form id="Form" action="" method="POST">
            <div>ФИО Водителя</div>            
            <input class="inputForm" placeholder="Иванов Иван Иванович" maxlength="255" name="fio" type="text">

            <div>Дата рождения</div>    
            <input class="inputForm" name="dateBirth" type="date">

            <div>Телефон</div>  
            <input class="inputForm" placeholder="89372008000" onblur="checkTel()" name="tel" type="text">
            <span class="errorForm" style="display:none" id="errorTel">Некорректно введены данные</span>

            <div>№ водительского удостоверения</div> 
            <input class="inputForm" placeholder="7701397000" onblur="checkIdNumber()" maxlength="10" name="idNumber" type="text">
            <span class="errorForm" style="display:none" id="errorIdNumber">Некорректно введены данные</span>
            <span class="errorForm" style="display:none" id="errorIdNumberDB">Водитель с данным номером водительского удостоверения уже существует</span>

            <div>Дата выдачи удостоверения</div>
            <input class="inputForm" name="dateIssue" type="date">

            <div>Категории транспортных средств</div>
            <input class="inputForm" placeholder="A,A1,B" onblur="checkСategories()" name="categories" type="text">
            <span class="errorForm" style="display:none" id="errorCategories">Некорректно введены данные</span><br>  

            <input class="butForm" name="submit" id="butForm" type="submit" value="Добавить">
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>