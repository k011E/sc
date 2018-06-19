<?php
$title = 'Удаление сотрудника';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `workers` WHERE `id`='".$_GET['id']."'");
if($query->num_rows == 0){
	die('Сотрудника не существует!');
}
$worker = $query->fetch_assoc();
if(isset($_POST['yes'])){
	$db->query("DELETE FROM `workers` WHERE `id`='".$_GET['id']."'");
	header('location:/admin/workers');
}elseif(isset($_POST['no'])){
	header('location:/admin/workers');
}
?>
<h1>Удаление сотрудника</h1>
<form action="" method="POST">
	Вы действительно хотите удалить сотрудника <b>"<?=output($worker['name'])?> <?=output($worker['surname'])?>"</b><br>
	<input type="submit" name="yes" value="Да">
	<input type="submit" name="no" value="Нет">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>