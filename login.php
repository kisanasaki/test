<?php 
session_start();
require('dbconnect.php');
 
if ($_COOKIE['email'] !== '') {
  $email = $_COOKIE['email'];
}
 
if (!empty($_POST)) { //$_POST->PHP定義済み関数
  $email = $_POST['email'];
  // ログインの処理
  if ($_POST['email'] !== '' && $_POST['password'] !== '') {
    $login = $db->prepare('SELECT * FROM members WHERE email=?
    AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));
    $member = $login->fetch();
 
    if($member) { 
      //ログイン成功
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();
 
      if ($_POST['save'] === 'on') {
        setcookie('email', $_POST['email'], time()+60*60*24*14);
      }
 
      header('Location: index.php');
      exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
  }
}
//guest login 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>login</title>
</head>
<body>
  <div id="wrap">
    <div id="head">
      <h1>ログインする</h1>    
    </div>
    <div id="content">
      <form action="" method="post">
        <dl>
          <?php //メールアドレス入力フォーム&エラーチェック?>
          <dd>
            <input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['email'],ENT_QUOTES);?>" placeholder="メールアドレス"/>
          </dd>
          <?php if ($error['login'] === 'blank'): ?>
                <p class="error">* メールアドレスとパスワードをご記入ください</p>
              <?php endif; ?>
              <?php if ($error['login'] === 'failed'): ?>
                <p class="error">* ログインに失敗しました。正しくご記入ください</p>
              <?php endif; ?>
          <?php //パスワード入力フォーム&エラーチェック?>  
          <dd>
            <input type="text" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password'],ENT_QUOTES);?>" placeholder="パスワード"/>
          </dd>

         
          <dd>
             <input id="save" type="checkbox" name="save" value="on">
             <label for="save">次回からは自動的にログインする</label>
          </dd>
        </dl>
          <div>
            <input type="submit" value="ログインする" />
          </div>

        </dl>
      
      </form>
    </div>
  </div>
</body>
</html>
