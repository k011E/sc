<?php
$title = 'Редактирование сотрудника';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `workers` WHERE `id`='".$_GET['id']."'");
if($query->num_rows == 0){
	die('Сотрудника не существует!');
}
$worker = $query->fetch_assoc();
if(isset($_POST['ok'])){
	$_POST['name'] = input($_POST['name']);
	$_POST['surname'] = input($_POST['surname']);
	$_POST['email'] = input($_POST['email']);
	if(empty($_POST['name'])){
		echo 'Введите имя';
	}elseif(empty($_POST['surname'])){
		echo 'Введите фамилию';
	}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		echo 'Введите E-Mail корректно!';
	}else{
		$db->query("UPDATE `workers` SET `name`='".$_POST['name']."', `surname`='".$_POST['surname']."', `email`='".$_POST['email']."' WHERE `id`='".$_GET['id']."'");
		if(!empty($_POST['password'])){
			if($_POST['password'] != $_POST['confirm_password']){
				echo 'Пароль и его подтверждение не совпадают';
			}else{
				$db->query("UPDATE `workers` SET `password`='".md5($_POST['password'])."' WHERE `id`='".$_GET['id']."'");
			}
		}
		echo 'Сотрудник отредактирован';
		$worker = $db->query("SELECT * FROM `workers` WHERE `id`='".$_GET['id']."'")->fetch_assoc();
	}
}
?>
<h1>Редактирование сотрудника</h1>
<form action="" method="POST">
	Имя:<br>
	<input type="text" name="name" value="<?=output($worker['name'])?>"><br>
	Фамилия:<br>
	<input type="text" name="surname" value="<?=output($worker['surname'])?>"><br>
	E-Mail:<br>
	<input type="email" name="email" value="<?=output($worker['email'])?>"><br>
	Пароль:<br>
	<input type="password" name="password"><br>
	Подтвердение пароля:<br>
	<input type="password" name="confirm_password"><br>
	<input type="submit" name="ok" value="Сохранить">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>