<?php   
require_once '../../includes/db.php';




$db = new dataBase;


if(isset($_GET['stateNumber']) && isset($_GET['year']) && isset($_GET['chassisNumber']) && isset($_GET['bodyNumber']) && isset($_GET['category']) && isset($_GET['idCar']) && isset($_GET['idDriver']) && isset($_GET['update'])){
    $stateNumber = $_GET['stateNumber'];
    $year = $_GET['year'];
    $chassisNumber = $_GET['chassisNumber'];
    $bodyNumber = $_GET['bodyNumber'];
    $category = $_GET['category'];
    $idCar = $_GET['idCar'];
    $idDriver = $_GET['idDriver'];

    $requy = "SELECT * FROM `car` where  `id` != '$idCar' AND `stateNumber` = '$stateNumber'";
    $result = $db->queryReturnDB($requy);
    
    if($result){
        $data = true;
      
	}else{
        
        $data = false;
        $requy = "UPDATE `car` SET `stateNumber` = '".$stateNumber."', `year` = '".$year."', `chassisNumber` = '".$chassisNumber."', `bodyNumber` = '".$bodyNumber."', `category` = '".$category."' WHERE `car`.`id` = ".$idCar;
		$db->queryDB($requy);

 
        if($idDriver != 0){
            $result = $db->selectOne('drivers','id',$idDriver);
            $arrCategories = explode(",", $result['categories']);
            if(!in_array( $category ,$arrCategories)){
				$requy2 = "UPDATE `car` SET `driver` = '0' WHERE `car`.`id` = ".$idCar;
				$db->queryDB($requy2);
				
				$requy2 = "UPDATE `drivers` SET `car` = IF(`car` > 0, `car`- 1, 0) WHERE `drivers`.`id` = ".$idDriver;
				$db->queryDB($requy2);
			}
        }
    }
}
if(isset($_GET['idCar']) && isset($_GET['deleteCarDB']) && isset($_GET['idDriver'])){
    $idCar = $_GET['idCar'];
    $idDriver = $_GET['idDriver'];
    $requy = "DELETE FROM `car` where  `id` = '$idCar'";
    $db->queryDB($requy);
    $requy = "UPDATE `drivers` SET `car` = IF(`car` > 0, `car`- 1, 0) WHERE `drivers`.`id` = ".$idDriver;
	$db->queryDB($requy);
    echo 0;
}


//echo $data;
?>