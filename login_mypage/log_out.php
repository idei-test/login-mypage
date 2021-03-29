<?php 

session_start();
//セッション切断
session_destroy();
//ログインへ
header("Location:login.php");



?>