<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location: /includes/authorization/index.php");
}