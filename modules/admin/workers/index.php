<?php
$title = 'Управление сотрудниками';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<h1>Управление сотрудниками</h1>
<a href="/admin/workers/add">Добавить сотрудника</a>
<table border="3" width="100%">
	<tr>
		<td>№</td>
		<td>Имя</td>
		<td>Фамилия</td>
		<td>E-Mail</td>
		<td>Действие</td>
	</tr>
	<?
	$query = $db->query("SELECT * FROM `workers`");
	$i = 1;
	while ($worker = $query->fetch_assoc()) {
		?>
		<tr>
			<td><?=$i?></td>
			<td><?=output($worker['name'])?></td>
			<td><?=output($worker['surname'])?></td>
			<td><?=output($worker['email'])?></td>
			<td><a href="/admin/workers/delete/<?=$worker['id']?>">Удалить</a> / <a href="/admin/workers/edit/<?=$worker['id']?>">Редактировать</a></td>
		</tr>
		<?
		$i++;
	}
	?>
</table>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>