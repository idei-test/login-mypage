<?php
mb_internal_encoding("utf8");
try{
// DB接続
$pdo = new PDO("mysql:dbname=lesson01;host=localhost","root","");
}catch(PDOException $e){
    die("<p>申し訳ございません。サーバーが混み合っておりアクセスできません。</p><br>
<a href='./register.php'>戻る</a>");
}


//プリペアードステートメント　あらかじめ設定を伝える
// stmtにpdoクラスのメソッド追加（引数がsqlクエリとなる）
$stmt = $pdo->prepare(
    "insert into login_mypage(name,mail,password,picture,comments)values(?,?,?,?,?)");
// 第一引数は？の位置　第二引数は入れるもの
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['picture']);
$stmt->bindValue(5,$_POST['comments']);
// 実行
$stmt->execute();
// 切断　インスタンス放棄？
$pdo=NULL;

//完了画面へリダイレクト
header('Location:after_register.html');
?>