<?php
$title = 'Деавторизация';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
if(isset($_POST['yes'])){
	setcookie("password", "", time()-60*60*24*30, "/");
	header('location:/admin');
}elseif(isset($_POST['no'])){
	header('location:/admin');
}
?>
<form action="" method="POST">
	Вы действительно хотите деавторизоваться?<br>
	<input type="submit" name="yes" value="Да"><br>
	<input type="submit" name="no" value="Нет">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>