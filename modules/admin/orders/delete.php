<?php
$title = 'Удаление заявки';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `orders` WHERE `id`='".$_GET['id']."'");
if($query->num_rows == 0){
	die('Заявки не существует!');
}
$order = $query->fetch_assoc();
if(isset($_POST['yes'])){
	$db->query("DELETE FROM `orders` WHERE `id`='".$_GET['id']."'");
	header('location:/admin/orders');
}elseif(isset($_POST['no'])){
	header('location:/admin/orders');
}
?>
<h1>Удаление заявки</h1>
<form action="" method="POST">
	Вы действительно хотите удалить заявку от <?=convDate($order['time'])?> клиента <?=output($order['client'])?><br>
	<input type="submit" name="yes" value="Да">
	<input type="submit" name="no" value="Нет">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>