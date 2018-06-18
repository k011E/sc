<?php
$title = 'Добавление услуги';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
if(isset($_POST['ok'])){
	$_POST['name'] = input($_POST['name']);
	$_POST['summ'] = abs(intval($_POST['summ']));
	if(empty($_POST['name'])){
		echo 'Введите название услуги';
	}elseif(empty($_POST['summ'])){
		echo 'Введите стоимость услуги';
	}elseif($_POST['summ'] < 0){
		echo 'Стоимость услуги должно быть не менее нуля!';
	}else{
		$db->query("INSERT INTO `services` SET `name`='".$_POST['name']."', `price`='".$_POST['summ']."'");
		echo 'Услуга добавлена!';
	}
}
?>
<form action="" method="POST">
	Название:<br>
	<input type="text" name="name"><br>
	Цена:<br>
	<input type="number" name="summ"><br>
	<input type="submit" name="ok" value="Добавить">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>