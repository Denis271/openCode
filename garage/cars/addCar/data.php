<?php
require_once('../../includes/db.php');

$stateNumber = $_GET['stateNumber'];
$year = $_GET['year'];
$chassisNumber = $_GET['chassisNumber'];
$bodyNumber = $_GET['bodyNumber'];
$category = $_GET['category'];

$db = new dataBase;

$result = $db->selectOne('car','stateNumber',$stateNumber);
 print_r($result);
if($result){
    $data = 1;
}else{
   $data = 0;
    $column = array('id','stateNumber','year','chassisNumber','bodyNumber','category','driver');
    $value = array('NULL',$stateNumber,$year,$chassisNumber,$bodyNumber,$category,0); 
    $db->INSERT('car',$column,$value);
 }
 echo $data;
?>