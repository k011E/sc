<?php
$title = 'Авторизация';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
if(isset($_POST['ok'])){
	$_POST['email'] = input($_POST['email']);
	if(empty($_POST['email'])){
		echo 'Введите E-Mail';
	}elseif(empty($_POST['password'])){
		echo 'Введите пароль';
	}else{
		if($db->query("SELECT `id` FROM `workers` WHERE `email`='".$_POST['email']."' AND `password`='".md5($_POST['password'])."'")->num_rows != 0){
			setcookie("email", $_POST['email'], time() + 60 * 60 * 24 * 30, "/");
			setcookie("pwd", md5($_POST['password']), time() + 60 * 60 * 24 * 30, "/");
			header('location:/worker_space');
		}else{
			echo 'Неверные данные для входа!';
		}
	}
}
?>
<h1>Авторизация</h1>
<form action="" method="POST">
	E-Mail:<br>
	<input type="text" name="email"><br>
	Пароль:<br>
	<input type="password" name="password"><br>
	<input type="submit" name="ok">	
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>