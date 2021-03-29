<?php
session_start();
if(isset($_SESSION['id'])){
    // セッションあるならリダイレクト
    header("Location:mypage.php");
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link type="text/css" rel="stylesheet" href="./login.css">
</head>
<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="./register.php">新規登録</a></div>
    </header>
    <main>
        <form action="mypage.php" method="post">
            <div class="form_contents">
                
                <div class="mail">
                    <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" name="mail" 
                           <?php
                           if(isset($_COOKIE['pass'])){
                               echo "value='".$_COOKIE['mail']."'";}
                           ?> required>
                </div>
                <div class="password">
                <label>パスワード</label><br>
                    <input type="password" class="formbox" size="40" name="password" <?php
                           if(isset($_COOKIE['pass'])){
                               echo "value='".$_COOKIE['pass']."'";}
                           ?> required>
                </div>
<!--                ログイン保持ボタン-->
                <div class="check">
                    <label>
                        <input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep"
                        <?php if(isset($_COOKIE['login_keep'])){echo "checked='checked'";}?>>ログインを保持する
                    </label>
                </div>
                
                
                <div class="toroku">
                    <input type="submit" class="submit_button" value="ログイン">
                </div>
                
            </div>
        </form>
    </main>
    <footer>
        © 2018 InterNous.inc. All rights reserved
    </footer>
</body>
</html>