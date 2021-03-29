
<?php
mb_internal_encoding("utf8");
//セッション開始
session_start();
//-------------------------------------------セッションないならDB確認
if(empty($_SESSION['id'])){

try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインしてください。</p>");
}


// 一致するレコードをすべて取得する 一致しないなら空の判定
$stmt = $pdo->prepare("select * from login_mypage where mail = ? and password = ?");
$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);
// sql実行
$stmt->execute();
// 切断
$pdo=NULL;
//fetch　取得
while($row=$stmt->fetch()){
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['pass'] = $row['password'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['comme'] = $row['comments'];
    $_SESSION['pic'] = $row['picture'];
    $_SESSION['id'] = $row['id'];
}
// 空ならリダイレクト（エラー画面へ）
if(empty($_SESSION['id'])){
    // エラー用のページ
    header('Location:login_error.php');
}
if(!empty($_POST['login_keep'])){
    //ログインページのチェックをpostで受け取りセッションへ
    // この後クッキーセット

    $_SESSION['login_keep']=$_POST['login_keep'];
}
}
// --------------------------------------------------

// cockie をセット (クッキー毎回確認)
if(!empty($_SESSION['id']&& !empty($_SESSION['login_keep']))){
    setcookie('mail',$_SESSION['mail'],time()+60*5);
    //7日だがテストで5分
    setcookie('pass',$_SESSION['pass'],time()+60*5);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*5);
    
}else if(empty($_SESSION['login_keep'])){
    // keepが空ならクッキーを過去に設定
    setcookie('mail','',time()-1);
    setcookie('pass','',time()-1);
    setcookie('login_keep','',time()-1);
}

?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>マイページ</title>
    <link rel="stylesheet" type="text/css" href="./mypage.css">
</head>
<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="./log_out.php" >ログアウト</a></div>
    </header>
    <main>
        <form action="mypage_hensyu.php" method="post">
            <div class="form_contents">
                <div class="forme_contents">
                <h2>会員情報</h2>
                    <p>こんにちは！ <?php echo $_SESSION['name'];?>さん</p>
                <div class="picture">
                <?php 
                    if(isset($_SESSION['pic'])){
                        //必須ではないため

                    echo "<img width='200' src='./image/".$_SESSION['pic']."'>";
                    }else{
                        echo "<img width='200' src='./profile_pic.jpg'>";//暫定
                    }
                ?>
                </div>
                <div class="name">
                    <label>氏名:</label>                  
                    <?php echo $_SESSION['name']; ?>
                </div>
                <div class="mail">
                    <label>メールアドレス:</label>   
                    <?php echo $_SESSION['mail']; ?>
                </div>
                <div class="password">
                    <label>パスワード:</label>
                    <?php echo $_SESSION['pass'];?>
                </div>

                <div class="comments">
                                    
                    <?php //必須ではないため
                    if(isset($_SESSION['comme'])){
                    echo $_SESSION['comme'];
                    }else{echo "※コメントなし";
                    }
                    ?>
                </div>
                

<!--                <form action="maypage_hensyu.php" method="post">-->
                    <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
                    <div type="toroku" >
                    <input type="submit" class="submit_button" size="35" value="編集する"></div>
                
            </div>
        </div>
        </form>
    </main>
    <footer>
        © 2018 InterNous.inc. All rights reserved
    </footer>  
</body>
</html>