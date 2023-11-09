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

$fio = $_GET['fio'];
$dateBirth = $_GET['dateBirth'];
$tel = phone_format($_GET['tel']);
$idNumber = $_GET['idNumber'];
$dateIssue = $_GET['dateIssue'];
$categories = str_replace('-',',', $_GET['categories']);

$db = new dataBase;

$result = $db->selectOne('drivers','idNumber',$idNumber);
if($result){
    $data = true;
}else{
    $data = false;
	
    $column = array('id','name','dateBirth','tel','idNumber','dateIssue','categories');
    $value = array('NULL',$fio,$dateBirth,$tel,$idNumber,$dateIssue,$categories);  
    $db->INSERT('drivers',$column,$value);
}
echo $data;
?>