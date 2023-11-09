<?php
require_once '../includes/checkSession.php';
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Машины</title>
</head>
<body>
    <div class="butBack"><a href="../index">Назад</a></div>
    <div class="conteinerCar">
        <table>
            <caption>Машины</caption>
            <tr class="headerTable">
                <th>Гос. номер</th>
                <th>Год выхода</th>
                <th>Номер шасси</th>
                <th>Номер кузова</th>
                <th>Категория ТС</th>
                <th>Водитель</th>
                <th></th>
            </tr>
            <?php
            $db = new dataBase;
            $result = $db->selectAll('car');
            if ($result->num_rows == null) {
                echo '<th>Машин нет</th>';
            }else{
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <th><?php echo $row["stateNumber"]; ?></th>
                        <th><?php echo $row["year"];?></th>
                        <th><?php echo $row["chassisNumber"]; ?></th>
                        <th><?php echo $row["bodyNumber"]; ?></th>
                        <th><?php echo $row["category"];?></th>
                        <th>
                            <?php 
                             $result2 = $db->selectOne('drivers','id',$row["driver"]);
                             echo $result2['name'];
                            
                            ?>
                        </th>
                        <th class="butTh"><a href="editCars/index.php?idCar=<?php echo $row["id"]; ?>">Редактировать</a></th>
                    </tr>
            <?php
            }
        }   
        ?>
        </table>
    </div>
    <div class="butAddCar"><a href="addCar/index">Добавить машину</a></div>
</body>
</html>