<?php   
require_once '../../includes/db.php';
function phone_format($phone) 
{
	$phone = trim($phone);
 
	$res = preg_replace(
		array(
			'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
			'/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
			'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
			'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',	
			'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
			'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',					
		), 
		array(
			'+7 ($2) $3-$4-$5', 
			'+7 ($2) $3-$4-$5', 
			'+7 ($2) $3-$4-$5', 
			'+7 ($2) $3-$4-$5', 	
			'+7 ($2) $3-$4', 
			'+7 ($2) $3-$4', 
		), 
		$phone
	);
	return $res;
}
$db = new dataBase;
//UPDATE drive
if(isset($_GET['idDriver']) && isset($_GET['fio']) && isset($_GET['dateBirth']) && isset($_GET['tel']) && isset($_GET['idNumber']) && isset($_GET['dateIssue']) && isset($_GET['categories']) && isset($_GET['update'])){
	$idDriver = $_GET['idDriver'];
	$fio = $_GET['fio'];
	$dateBirth = $_GET['dateBirth'];
	$tel = phone_format($_GET['tel']);
	$idNumber = $_GET['idNumber'];
	$dateIssue = $_GET['dateIssue'];
	$car = $_GET['car'];
	$categories = str_replace('-',',', $_GET['categories']);
	

	$requy = "SELECT * FROM `drivers` where  `id` != '$idDriver' AND `idNumber` = '$idNumber'";
	$result = $db->queryReturnDB($requy);
	if($result){
		echo 1;
	}else{
		echo 0;
		$requy = "UPDATE `drivers` SET `name` = '".$fio."', `dateBirth` = '".$dateBirth."', `tel` = '".$tel."', `idNumber` = '".$idNumber."', `dateIssue` = '".$dateIssue."', `categories` = '".$categories."' WHERE `drivers`.`id` = ".$idDriver;
		$db->queryDB($requy);

		//удаление машин если категория не соответствует 
		$arrCategories = explode(",", $categories);
		$query = "SELECT * FROM `car` where `driver`= '$idDriver'";
    	$result = $db->queryReturnDBAll($query);
		if ($result->num_rows != null) {
			while ($row = $result->fetch_assoc()) {
				if(!in_array( $row["category"] ,$arrCategories) )
				{
					$requy2 = "UPDATE `car` SET `driver` = '0' WHERE `car`.`id` = ".$row["id"];
					$db->queryDB($requy2);
					$car--;
					$requy2 = "UPDATE `drivers` SET `car` = '".$car."' WHERE `drivers`.`id` = ".$idDriver;
					$db->queryDB($requy2);
				}
			}
		}   
	}
}

if(isset($_GET['idCar']) && isset($_GET['idDriver']) && isset($_GET['addCar'])){ //прикрепление манины к водителю
	$idCar = $_GET['idCar'];
	$idDriver = $_GET['idDriver'];
	$requy = "UPDATE `drivers` SET `car` = `car` + 1 WHERE `drivers`.`id` = ".$idDriver;
	$db->queryDB($requy);
	$requy = "UPDATE `car` SET `driver` = '".$idDriver."' WHERE `car`.`id` = ".$idCar;
	$db->queryDB($requy);
	echo 0;
}


if(isset($_GET['idCar']) && isset($_GET['idDriver']) && isset($_GET['deleteCar'])){ //открепление машины от водителя
	$idCar = $_GET['idCar'];
	$idDriver = $_GET['idDriver'];

	$requy = "UPDATE `drivers` SET `car` = `car` - 1 WHERE `drivers`.`id` = ".$idDriver;
	$db->queryDB($requy);
	$requy = "UPDATE `car` SET `driver` = '0' WHERE `car`.`id` = ".$idCar;
	$db->queryDB($requy);
	echo 0;
}

if(isset($_GET['idDriver']) && isset($_GET['deleteDriverDB'])){ //удаление водителя
    $idDriver = $_GET['idDriver'];
    $requy = "DELETE FROM `drivers` where  `id` = '$idDriver'";
    $db->queryDB($requy);
    $requy = "UPDATE `car` SET `driver` = 0 WHERE `car`.`driver` = ".$idDriver;
	$db->queryDB($requy);
    echo 0;
}
//ADD CAR


?>