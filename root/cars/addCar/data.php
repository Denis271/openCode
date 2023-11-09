<?php   
require_once '../../includes/db.php';
$connection2 = mysqli_connect('localhost','root','usbw','garage');
$stateNumber = $_GET['stateNumber'];
$year = $_GET['year'];
$chassisNumber = $_GET['chassisNumber'];
$bodyNumber = $_GET['bodyNumber'];
$category = $_GET['category'];


$db = new dataBase;

 $result = $db->selectOne('car','stateNumber',$stateNumber);
if($result){
    $data = true;
}else{
   $data = false;
    $column = array('id','stateNumber','year','chassisNumber','bodyNumber','category','driver');
    $value = array('NULL',$stateNumber,$year,$chassisNumber,$bodyNumber,$category,0);  
   // $e = "INSERT INTO `car` (`id`,`stateNumber`,`year`,`chassisNumber`,`bodyNumber`,`category`,`driver`) VALUES (NULL,'$stateNumber','$year','$chassisNumber','$bodyNumber','$category','0')";
   $e = "INSERT INTO `car` (`id`,`stateNumber`,`year`,`chassisNumber`,`bodyNumber`,`category`,`driver`) VALUES (NULL,'$stateNumber','$year','$chassisNumber','$bodyNumber','$category','0')";
   //print_r($e);
  mysqli_query($connection2, $e);
    //$db->queryDB($e);
    //print_r($value);
    //$db->INSERT('car',$column,$value);
 }
 echo $data;
?>