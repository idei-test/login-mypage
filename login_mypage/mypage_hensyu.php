<?php
mb_internal_encoding("utf8");
session_start();
//マイページからのPOSTで乱数を使用する
if(!isset($_POST['from_mypage'])){
    header("Location:login_error.php");
}
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>マイページ登録</title>
    <link type="text/css" rel="stylesheet" href="mypage.css">
</head>
<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="login"><a href="./log_out.php" >ログアウト</a></div>
    </header>
    
    <main>
<!--セッションで前のページの値を取得してinputにいれておく　テキストエリアにvlueがない-->
                <div class="forme_contents">

            <form action="./mypage_update.php" method="post">
            <div class="form_contents">
                <h2>会員情報</h2>
                    <p>こんにちは！ <?php echo $_SESSION['name'];?>さん</p>
                <div class="picture">
                <?php 
                    if(isset($_SESSION['pic'])){
                        //必須ではないため
                        //sqlには./image/画像名 までパス入っている
                    echo "<img width='200' src='./image/".$_SESSION['pic']."'>";
                    }else{
                        echo "<img width='200' src='./profile_pic.jpg'>";//デフォ
                        // 画像の大きさを制限してフォームを整形
                    }
                ?>
                </div>
                <div class="name">
                    <label>氏名</label><br>
                    <input type="text" class="formbox" size="40" name="name"
                        value=<?php echo  "'".$_SESSION['name']."'";?> required>
                </div>
                <div class="mail">
                    <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" name="mail" 
                           pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" 
                           value=<?php echo  "'".$_SESSION['mail']."'";?> required>
                </div>
                <div class="password">
                    <label>パスワード(半角英数字6文字以上)</label><br>
                    <input type="password" class="formbox" size="40" name="password" id="password"pattern="^[a-zA-z0-9]{6,}$" 
                           value=<?php echo  "'".$_SESSION['pass']."'";?> required>
                </div>
                <div class="comments">
                    <label>コメント</label><br>
                    <textarea rows="5" cols="45" name="comments" ></textarea>
<!--                    テキストエリアにvlueがないのでセッションしない-->
                </div>
                
                <div class="toroku">
                    <input type="submit" class="submit_button" size="35" value="登録する">
                </div>

                </div>
        </form>
        </div>


    </main>
    <footer>
        © 2018 InterNous.inc. All rights reserved
    </footer>  
</body>
</html>