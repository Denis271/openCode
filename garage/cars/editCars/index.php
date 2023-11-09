<?php
require_once '../../includes/checkSession.php';
require_once '../../includes/db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Машина</title>
</head>
<body>
    <div class="butBack"><a href="../index">Назад</a></div>
    <?php
    $idCar = $_GET['idCar'];
    $db = new dataBase;
    $result = $db->selectOne('car','id',$idCar);
    $idDriver = $result['driver'];
    ?>

    <div class="conteinerForm">
        <div class="errorForm" style="display:none" id="errorInput">Все поля обязательны для заполнения</div>
        <form id="Form" action="" method="POST">
            <div>Гос. номер</div>   
            <input name="idCar" type="hidden"  value="<?php echo $idCar;?>">
            <input name="driver" type="hidden"  value="<?php echo $idDriver;?>">           
            <input class="inputForm" placeholder="С065МК777" maxlength="10" name="stateNumber" type="text" onblur="checkStateNumber()" value="<?php echo $result['stateNumber'];?>">
            <span class="errorForm" style="display:none" id="errorStateNumberDB">Машина с данным Гос. номером уже существует</span>
            <span class="errorForm" style="display:none" id="errorStateNumber">Некорректно введены данные</span>

            <div>Год выхода</div>    
            <input class="inputForm" onblur="checkYear()" placeholder="1994" maxlength="4" name="year" type="text" value="<?php echo $result['year'];?>">
            <span class="errorForm" style="display:none" id="errorYear">Некорректно введены данные</span>

            <div>Номер шасси</div>  
            <input class="inputForm" maxlength="17" placeholder="WKESDP27061287498" onblur="checkChassisNumber()" name="chassisNumber" type="text" value="<?php echo $result['chassisNumber'];?>">
            <span class="errorForm" style="display:none" id="errorChassisNumber">Номер должен состоять из 17 символов</span>

            <div>Номер кузова</div> 
            <input class="inputForm" placeholder="WKESDP27061287498" onblur="checkBodyNumber()" maxlength="17" name="bodyNumber" type="text" value="<?php echo $result['bodyNumber'];?>">
            <span class="errorForm" style="display:none" id="errorBodyNumberr">Номер должен состоять от 9 до 17 символов</span>
            

            <div>Категория шасси</div>
            <input class="inputForm" placeholder="A1" maxlength="3" onblur="checkСategories()" name="category" type="text" value="<?php echo $result['category'];?>">
            <span class="errorForm" style="display:none" id="errorCategories">Некорректно введены данные</span><br>  

            <input class="butForm" name="submit" id="butForm" type="submit" value="Сохранить">
        </form>
    </div>

    <div onclick="deleteCarDB(<?php echo $idCar.','.$idDriver; ?>)" class="deleteBut">Удалить машину</div>


    <div class="conteinerDriver"> <!-- машины водителя -->
        <table>    
    <?php
    $result = $db->selectOne('drivers','id',$idDriver);
        if ($result == null) {
            echo '<th>Водителя нет</th>';
        }else{
            ?>
             <caption>Водитель</caption>
            <tr class="headerTable">
                <th>ФИО Водителя</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>№ водительского удостоверения</th>
                <th>Дата выдачи удостоверения</th>
                <th>Категории транспортных средств</th>
                <th></th>
            </tr>

            <tr>
                <th><?php echo $result["name"]; ?></th>
                <th><?php echo date("d-m-Y", strtotime($result["dateBirth"])); ?></th>
                <th><?php echo $result["tel"]; ?></th>
                <th><?php echo $result["idNumber"]; ?></th>
                <th><?php echo date("d-m-Y", strtotime($result["dateIssue"])); ?></th>
                <th><?php echo $result["categories"]; ?></th>
                <th class="butTh"><a href="../../drivers/editDrivers/index?idDriver=<?php echo $idDriver; ?>">Открыть</a></th>
            </tr>
            <?php
        }  
        ?>
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>