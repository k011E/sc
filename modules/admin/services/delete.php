<?php
$title = 'Удаление услуги';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `services` WHERE `id` = '".$_GET['id']."'");
if($query->num_rows == 0){
	die('Услуги не существует!');
}
$service = $query->fetch_assoc();
if(isset($_POST['yes'])){
	$db->query("DELETE FROM `services` WHERE `id`='".$_GET['id']."'");
	header('location:/admin/services');
}elseif(isset($_POST['no'])){
	header('location:/admin/services');
}
?>
<form action="" method="POST">
	Вы действительно хотите удалить услугу <b>"<?=output($service['name'])?>"</b>?<br>
	<input type="submit" name="yes" value="Да">
	<input type="submit" name="no" value="Нет">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>