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
    <title>Новая машина</title>
</head>
<body>
    <div class="butBack"><a href="../index">Назад</a></div>
    <div class="conteinerForm">
        <div class="errorForm" style="display:none" id="errorInput">Все поля обязательны для заполнения</div>
        <form id="Form" action="" method="POST">
            <div>Гос. номер</div>            
            <input class="inputForm" placeholder="С065МК777" maxlength="10" name="stateNumber" type="text" onblur="checkStateNumber()">
            <span class="errorForm" style="display:none" id="errorStateNumberDB">Машина с данным Гос. номером уже существует</span>
            <span class="errorForm" style="display:none" id="errorStateNumber">Некорректно введены данные</span>

            <div>Год выхода</div>    
            <input class="inputForm" onblur="checkYear()" placeholder="1994" maxlength="4" name="year" type="text">
            <span class="errorForm" style="display:none" id="errorYear">Некорректно введены данные</span>

            <div>Номер шасси</div>  
            <input class="inputForm" maxlength="17" placeholder="WKESDP27061287498" onblur="checkChassisNumber()" name="chassisNumber" type="text">
            <span class="errorForm" style="display:none" id="errorChassisNumber">Номер должен состоять из 17 символов</span>

            <div>Номер кузова</div> 
            <input class="inputForm" placeholder="WKESDP27061287498" onblur="checkBodyNumber()" maxlength="17" name="bodyNumber" type="text">
            <span class="errorForm" style="display:none" id="errorBodyNumberr">Номер должен состоять от 9 до 17 символов</span>
            

            <div>Категория шасси</div>
            <input class="inputForm" placeholder="A1" maxlength="3" onblur="checkСategories()" name="category" type="text">
            <span class="errorForm" style="display:none" id="errorCategories">Некорректно введены данные</span><br>  

            <input class="butForm" name="submit" id="butForm" type="submit" value="Добавить">
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>