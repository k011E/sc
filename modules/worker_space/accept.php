<?php
$title = 'Подтверждение выполнения заявки';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
authWorker();
?>
<h1>Подтверждение выполнения заявки</h1>
<?
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `orders` WHERE `id`='".$_GET['id']."'");
if($query->num_rows == 0){
	die('Заявки не существует!');
}
$order = $query->fetch_assoc();
if($order['worker'] != $user['id']){
	die('Подтверждать выполнения заявки может только сотрудник, закреплённый за заявкой');
}

if(isset($_POST['no'])){
	header('location:/worker_space');
}elseif(isset($_POST['yes'])){
	$db->query("UPDATE `orders` SET `status`=1 WHERE `id`='".$_GET['id']."'");
	header('location:/worker_space');
}
?>
<form action="" method="POST">
	Вы действительно хотите подтвердить выполнения заявки от <b><?=convDate($order['time'])?></b> клиента <b><?=output($order['client'])?></b>?<br>
	<input type="submit" name="yes" value="Да">
	<input type="submit" name="no" value="Нет">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>