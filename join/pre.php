<?php
session_start();
require('../dbconnect.php');
$push= $_POST["push"];
if($push ==1){
  header('Location:thank.php');
  exit();
}elseif($push==2) {
    header('Location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
	<input type="hidden" name="push" value="1">
	<input type="submit" value="登録しないで進む">
</form>
<form action="" method="post">
	<input type="hidden" name="push" value="2">
	<input type="submit" value="登録して進む">
</form>

</body>
</html>
