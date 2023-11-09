<?php
require_once '../../includes/checkSession.php';
require_once '../../includes/db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <title>Водитель</title>
</head>
<body>
    <div class="butBack"><a href="../index.php">Назад</a></div>
    <?php
    $idDriver = $_GET['idDriver'];
    $db = new dataBase;
    $result = $db->selectOne('drivers','id',$idDriver);
    $categoriesDriver = $result['categories'];
    ?>

    <div class="conteinerForm">
        <div class="errorForm" style="display:none" id="errorInput">Все поля обязательны для заполнения</div>
        <form id="Form" action="" method="POST">
            <input name="idDriver" type="hidden" value="<?php echo $result['id'];?>">
            <input name="car" type="hidden" value="<?php echo $result['car'];?>">

            <div>ФИО Водителя</div>            
            <input class="inputForm" placeholder="Иванов Иван Иванович" maxlength="255" name="fio" type="text" value="<?php echo $result['name'];?>">

            <div>Дата рождения</div>    
            <input class="inputForm" name="dateBirth" type="date" value="<?php echo $result['dateBirth'];?>">

            <div>Телефон</div>  
            <input class="inputForm" placeholder="89372008000" onblur="checkTel()" name="tel"  maxlength="20" type="tel" value="<?php echo $result['tel'];?>">
            <span class="errorForm" style="display:none" id="errorTel">Некорректно введены данные</span>

            <div>№ водительского удостоверения</div> 
            <input class="inputForm" placeholder="7701397000" onblur="checkIdNumber()" maxlength="10" name="idNumber" type="text" value="<?php echo $result['idNumber'];?>">
            <span class="errorForm" style="display:none" id="errorIdNumber">Некорректно введены данные</span>
            <span class="errorForm" style="display:none" id="errorIdNumberDB">Водитель с данным номером водительского удостоверения уже существует</span>

            <div>Дата выдачи удостоверения</div>
            <input class="inputForm" name="dateIssue" type="date" value="<?php echo $result['dateIssue'];?>">

            <div>Категории транспортных средств</div>
            <input class="inputForm" placeholder="A,A1,B" onblur="checkСategories()" name="categories" type="text" value="<?php echo $result['categories'];?>">
            <span class="errorForm" style="display:none" id="errorCategories">Некорректно введены данные</span><br>  

            <input class="butForm" name="submit" id="butForm" type="submit" value="Сохранить">
        </form>
    </div>

    <div onclick="deleteDriverDB(<?php echo $idDriver; ?>)" class="deleteBut">Удалить водителя</div>

    <div class="conteinerCar"> <!-- машины водителя -->
        <table>
           
    <?php
    $query = "SELECT * FROM `car` where `driver`= '$idDriver'";
    $result = $db->queryReturnDBAll($query);
        if ($result->num_rows == null) {
            echo '<th>Машин нет</th>';
        }else{
            ?>
             <caption>Машины</caption>
            <tr class="headerTable">
                <th>Гос. номер</th>
                <th>Год выхода</th>
                <th>Номер шасси</th>
                <th>Номер кузова</th>
                <th>Категория ТС</th>
                <th></th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <th><?php echo $row["stateNumber"]; ?></th>
                    <th><?php echo $row["year"]; ?></th>
                    <th><?php echo $row["chassisNumbe"]; ?></th>
                    <th><?php echo $row["bodyNumber"]; ?></th>
                    <th><?php echo $row["category"]; ?></th>
                    <th class="butTh"><div onclick="deleteCar(<?php echo $row['id'].','.$idDriver; ?>)">Удалить</div></th>
                </tr>
            <?php
            }
        }   
        ?>
        </table>
    </div>



    <div class="conteinerCar">  <!-- Доступные машины -->
        <table>
            <caption>Доступные машины</caption>
            <tr class="headerTable">
                <th>Гос. номер</th>
                <th>Год выхода</th>
                <th>Номер шасси</th>
                <th>Номер кузова</th>
                <th>Категория ТС</th>
                <th></th>
            </tr>
            <?php
        
            $arrCategories = explode(",", $categoriesDriver);

            foreach ($arrCategories as $valueArrCat) {
                $query = "SELECT * FROM `car` where `driver`= '0' AND `category` = '".$valueArrCat."'";
                $result = $db->queryReturnDBAll($query);
                if ($result->num_rows != null) {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <th><?php echo $row["stateNumber"]; ?></th>
                            <th><?php echo $row["year"]; ?></th>
                            <th><?php echo $row["chassisNumbe"]; ?></th>
                            <th><?php echo $row["bodyNumber"]; ?></th>
                            <th><?php echo $row["category"]; ?></th>
                            <th class="butTh"><div onclick="addCar(<?php echo $row['id'].','.$idDriver; ?>)">Добавить</div></th>
                        </tr>
                    <?php    
                    }
                }
            }
        ?>
        </table>
    </div>

    <script src="script.js"></script>
</body>
</html>