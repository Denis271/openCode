<?php
require_once '../includes/checkSession.php';
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <title>Водители</title>
</head>
<body>
    <div class="butBack"><a href="../index">Назад</a></div>
    <div class="conteinerDrivers">
        <table>
            <caption>Водители</caption>
            <tr class="headerTable">
                <th>ФИО</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Номер прав</th>
                <th>Дата выдачи</th>
                <th>Категории</th>
                <th>Кол-во машин</th>
                <th></th>
            </tr>
        <?php
        $db = new dataBase;
        $result = $db->selectAll('drivers');
        if ($result->num_rows == null) {
            echo '<th>Водителей нет</th>';
        }else{
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <th><?php echo $row["name"]; ?></th>
                    <th><?php echo date("d-m-Y", strtotime($row["dateBirth"])); ?></th>
                    <th><?php echo $row["tel"]; ?></th>
                    <th><?php echo $row["idNumber"]; ?></th>
                    <th><?php echo date("d-m-Y", strtotime($row["dateIssue"])); ?></th>
                    <th><?php echo $row["categories"]; ?></th>
                    <th><?php echo $row["car"]; ?></th>
                    <th class="butTh"><a href="editDrivers/index.php?idDriver=<?php echo $row['id']; ?>">Редактировать</a></th>
                </tr>
                
            <?php
            }
        }   
        ?>
        </table>
    </div>
    
    <div class="butAddDrivers"><a href="addDrivers/index">Добавить водителя</a></div>
    
</body>
</html>