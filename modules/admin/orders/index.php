<?php
$title = 'Заявки';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<h1>Управление заявками</h1>
<a href="/admin/orders/add">Добавить заявку</a>
<table width="100%" border="3">
	<tr>
		<td>ID</td>
		<td>Дата приёма</td>
		<td>Срок сдачи</td>
		<td>Услуга</td>
		<td>Исполнитель</td>
		<td>Клиент</td>
		<td>Номер телефона</td>
		<td>Описание неисправности</td>
		<td>Комментарий</td>
		<td>Действие</td>
	</tr>
	<?
	$query = $db->query("SELECT * FROM `orders` ORDER BY `id` DESC ");
	while($order = $query->fetch_assoc()){
		$service = $db->query("SELECT `name` FROM `services` WHERE `id`='".$order['service']."'")->fetch_assoc();
		$worker = $db->query("SELECT * FROM `workers` WHERE `id`='".$order['worker']."'")->fetch_assoc();
		if($order['status'] == 0){
			$color = '#eabfbf';
		}elseif($order['status'] == 1){
			$color = '#f1d2a8';
		}else{
			$color = '#d5eabf';
		}
		?>
		<tr bgcolor="<?=$color?>">
			<td><?=$order['id']?></td>
			<td><?=convDate($order['time'])?></td>
			<td><?=convDate($order['ttime'])?></td>
			<td><?=output($service['name'])?></td>
			<td><?=output($worker['name'])?> <?=output($worker['surname'])?></td>
			<td><?=output($order['client'])?></td>
			<td><?=output($order['phone'])?></td>
			<td><?=output($order['defect'])?></td>
			<td><?=output($order['comm'])?></td>
			<td><?if($order['status']!=2){?><a href="/admin/orders/close/<?=$order['id']?>">Закрыть</a> /<?}?> <a href="/admin/orders/delete/<?=$order['id']?>">Удалить</a> / <a href="/admin/orders/edit/<?=$order['id']?>">Редактировать</a></td>
		</tr>
		<?
	}
	?>
</table>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>