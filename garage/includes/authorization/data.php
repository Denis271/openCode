<?php
session_start();
require_once '../db.php';
$login = $_GET['login'];
$password = $_GET['password'];
$data = array();

$db = new dataBase;
$result = $db->selectOne('users','login',$login);

//$result = mysqli_query($connection2, "SELECT * FROM `user` where `$column`= '$value'");

$hash = md5($password . $salt);
if ($hash == $result['password']) {
    $data['chackUser'] = 1;
    $_SESSION['user'] = [
        "id" => $result["id"],
        "login"=> $result["login"], 
    ];
}else{
    $data['chackUser'] = 0;
 
}
echo json_encode($data);
?>