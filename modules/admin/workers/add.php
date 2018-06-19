<?php
$title = 'Добавление сотрудника';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<h1>Добавление сотрудника</h1>
<?
if(isset($_POST['ok'])){
	$_POST['name'] = input($_POST['name']);
	$_POST['surname'] = input($_POST['surname']);
	$_POST['email'] = input($_POST['email']);
	if(empty($_POST['name'])){
		echo 'Введите имя';
	}elseif(empty($_POST['surname'])){
		echo 'Введите фамилию';
	}elseif($_POST['pwd'] != $_POST['cfrpwd']){
		echo 'Пароль и подтверждение не совпадают!';
	}elseif($db->query("SELECT `id` FROM `workers` WHERE `email`='".$_POST['email']."'")->num_rows != 0){
		echo 'Сотрудник с таким E-Mail уже зарегистрирован!';
	}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		echo 'Введите E-Mail корректно!';
	}else{
		$db->query("INSERT INTO `workers` SET `name`='".$_POST['name']."', `surname`='".$_POST['surname']."', `password`='".md5($_POST['pwd'])."', `email`='".$_POST['email']."'");
		echo 'Сотрудник успешно добавлен!';
	}
}
?>
<form action="" method="POST">
	Имя:<br>
	<input type="text" name="name"><br>
	Фамилия:<br>
	<input type="text" name="surname"><br>
	E-Mail:<br>
	<input type="email" name="email"><br>
	Пароль:<br>
	<input type="password" name="pwd"><br>
	Подтверждение пароля:<br>
	<input type="password" name="cfrpwd"><br>
	<input type="submit" name="ok" value="Добавить">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>