<?php
$title = 'Панель сотрудника';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
authWorker();
?>
<h1>Панель сотрудника</h1>
<h2>Добро пожаловать, <?=output($user['name'])?> <?=output($user['surname'])?></h2>
<h3>Текущие дата и время: <?=convDate(time())?></h3>
<table width="100%" border="3">
	<tr>
		<td>ID</td>
		<td>Дата приёма</td>
		<td>Дата сдачи</td>
		<td>Услуга</td>
		<td>Описание неисправности</td>
		<td>Комментарий</td>
		<td>Действие</td>
	</tr>
	<?
	$query = $db->query("SELECT * FROM `orders` WHERE `worker`='".$user['id']."' ORDER BY `status`");
	while ($order = $query->fetch_assoc()) {
		$service = $db->query("SELECT * FROM `services` WHERE `id`='".$order['service']."'")->fetch_assoc();
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
			<td><?=output($order['defect'])?></td>
			<td><?=output($order['comm'])?></td>
			<td><center><a href="/worker_space/accept/<?=$order['id']?>"><button>Выполнено</button></a></center></td>
		</tr>
		<?
	}
	?>
</table>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>