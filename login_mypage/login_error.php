<?php
//ログイン時　アクセスしたらマイページへ
if(isset($_SESSION['id'])){
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
        <div class="login"><a herf="login.php">ログイン</a></div>
    </header>
    <main>
        <form action="mypage.php" method="post">
            <div class="form_contents">

                    <p class="error">メールアドレスまたはパスワードが間違っています。</p>

                <div class="mail">
                    <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" name="mail" required>
                </div>
                <div class="password">
                <label>パスワード</label><br>
                    <input type="password" class="formbox" size="40" name="password" required>
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