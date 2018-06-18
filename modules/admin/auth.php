<?php
$title = 'Авторизация';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
if(isset($_POST['ok'])){
	$_POST['pass'] = input($_POST['pass']);
	if(empty($config['password'])){
		$db->query("UPDATE `config` SET `password`='".md5($_POST['pass'])."'");
		setcookie("password", md5($_POST['pass']), time()+60*60*24*30, "/");
		header('location:/admin');
	}else{
		if(md5($_POST['pass']) != $config['password']){
			echo 'Неверный пароль<br>';
		}else{
			setcookie("password", md5($_POST['pass']), time()+60*60*24*30, "/");
			header('location:/admin');
		}
	}
}
?>
<form action="" method="POST">
	Пароль админа:<br>
	<input type="password" name="pass"><br>
	<input type="submit" name="ok" value="Войти">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>