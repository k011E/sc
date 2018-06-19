<?php
$title = 'Редактирование услуги';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `services` WHERE `id`=".$_GET['id']."");
if($query->num_rows == 0){
	die('Услуги не существует!');
}
$service = $query->fetch_assoc();
if(isset($_POST['ok'])){
	$_POST['name'] = input($_POST['name']);
	$_POST['price'] = abs(intval($_POST['price']));
	if(empty($_POST['name'])){
		echo 'Введите название!';
	}elseif(empty($_POST['price'])){
		echo 'Введите цену';
	}elseif($_POST['price'] < 0){
		echo 'Цена должна быть не меньше нуля!';
	}else{
		$db->query("UPDATE `services` SET `name`='".$_POST['name']."', `price`='".$_POST['price']."' WHERE `id`='".$_GET['id']."'");
		$service = $db->query("SELECT * FROM `services` WHERE `id`='".$_GET['id']."'")->fetch_assoc();
	}
}
?>
<form action="" method="POST">
	Название:<br>
	<input type="text" name="name" value="<?=output($service['name'])?>"><br>
	Цена:<br>
	<input type="number" name="price" value="<?=output($service['price'])?>"><br>
	<input type="submit" name="ok" value="Сохранить">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>