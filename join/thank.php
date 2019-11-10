
<?php
session_start();
require('../dbconnect.php');
$push= $_POST["push"];
if($push ==1){
  header('Location:../autologin.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="../style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>会員登録</h1>
</div>

<div id="content">
<p>成功！</p>
<form action="" method="post">
	<input type="hidden" name="push" value="1">
	<input type="submit" value="go">
</form>
</div>

</div>
</body>
</html>
