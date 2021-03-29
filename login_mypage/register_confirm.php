<?php
//　内部エンコーディングを指定
mb_internal_encoding('utf8');
// 仮保存されたファイル名で画像ファイル取得　サーバーへ仮アップロードされたディレクと名前

$temp_pic_name =$_FILES['picture']['tmp_name'];
// 元のファイル名で画像ファイル取得　事前に画像を入れるimageフォルダを作ること(つくってある)
$original_pic_name = $_FILES['picture']['name'];
// ファイルパス
$path_filename='./image/'.$original_pic_name;
// 仮保存のファイル名元の名でをimageふぉるだに移動させる
var_dump($original_pic_name);
if(empty($original_pic_name)){
$original_pic_name="./profile_pic.jpg";
}else{
move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);}
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="./register_confirm.css">
</head>
<body>
<!--    マイページ登録の表示-->

    <header>
        <img src="4eachblog_logo.jpg">
    </header>
    
    <main>
<!--      cssを完成させる　boxになってない画像を表示させる -->
       <form action="register_insert.php" method="post">
            <div class="form_contents">
                <div class="forme_contents">
                <h2>会員登録確認</h2>
                <div class="picture">
                <?php 
                    if(!empty($original_pic_name)){
                        //必須ではないため
                        //sqlにはパス入っている
                    echo "<img width='200' src='./image/".$original_pic_name."'>";
                    }else{
                        echo "<img width='200' src='./profile_pic.jpg'>";//暫定
                    }
                ?>
                </div>
                <div class="name">
                    <label>氏名</label><br>                  
                    <?php echo $_POST['name']; ?>
                </div>
                <div class="mail">
                    <label>メールアドレス</label><br>                  
                    <?php echo $_POST['mail']; ?>
                </div>
                <div class="password">
                    <label>パスワード</label><br>
                    <?php echo $_POST['password']?>
                </div>

                <div class="comments">
                    <label>コメント</label><br>                  
                    <?php echo $_POST['comments']; ?>
                </div>
                    <div class="toroku">
                        <input type="submit" class="submit_button" value="登録" size=35>
                    </div>
                </div>
            </div>
           <input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
           <input type="hidden" name="mail" value="<?php echo $_POST['mail'];?>">
           <input type="hidden" name="password" value="<?php echo $_POST['password'];?>">
           <input type="hidden" name="comments" value="<?php echo $_POST['comments'];?>">
<!--           画像は既にimgeファイルの中なので、パスのみ渡す-->
           <input type="hidden" name="picture" 
                  value="<?php echo $original_pic_name;?>">
        </form>
    </main>
    
    <footer>
        © 2018 InterNous.inc. All rights reserved
    </footer>
</body>
</html>