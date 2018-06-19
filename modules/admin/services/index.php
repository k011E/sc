<?php
$title = 'Управление услугами';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<a href="/admin/services/add">Добавить услугу</a>
<table border="3" width="100%">
	<tr>
		<td>№</td>
		<td>Название</td>
		<td>Стоимость</td>
		<td>Действие</td>
	</tr>
	<?
	$query = $db->query("SELECT * FROM `services`");
	$i = 1;
	while($service = $query->fetch_assoc()){
		?>
		<tr>
			<td><?=$i?></td>
			<td><?=output($service['name'])?></td>
			<td><?=output($service['price'])?></td>
			<td><a href="/admin/services/delete/<?=$service['id']?>">Удалить</a> / <a href="/admin/services/edit/<?=$service['id']?>">Редактировать</a></td>
		</tr>
		<?
		$i++;
	}
	?>
</table>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>