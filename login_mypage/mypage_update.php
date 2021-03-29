<?php
mb_internal_encoding('utf8');
session_start();

try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインしてください。</p>");
}
// UPDATE テーブル名 SET カラム=新しい値　where 条件
$stmt = $pdo->prepare("update login_mypage set 
    name = ?,
    mail = ?,
    password = ?,
    comments = ?
    
    where id = ?");
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
//　変更すべき個人を特定する where条件で一致させる
$stmt->bindValue(5,$_SESSION['id']);
$stmt->execute();
//-------------------------------------------------------
$stmt = $pdo->prepare("select * from login_mypage where id = ? ");
$stmt->bindValue(1,$_SESSION['id']);

$stmt->execute();
$pdo=NULL;

while($row=$stmt->fetch()){
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['pass'] = $row['password'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['comme'] = $row['comments'];
    $_SESSION['id'] = $row['id'];
}

header('Location:mypage.php');
?>