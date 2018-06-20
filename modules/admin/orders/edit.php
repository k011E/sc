<?php
$title = 'Редактирование заявки';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
$_GET['id'] = abs(intval($_GET['id']));
$query = $db->query("SELECT * FROM `orders` WHERE `id`='".$_GET['id']."'");
if($query->num_rows == 0){
	die('Заявки не существует!');
}
$order = $query->fetch_assoc();
if(isset($_POST['ok'])){
	$_POST['service'] = abs(intval($_POST['service']));
	$_POST['worker'] = abs(intval($_POST['worker']));
	$_POST['client'] = input($_POST['client']);
	$_POST['phone'] = input($_POST['phone']);
	$_POST['defect'] = input($_POST['defect']);
	$_POST['comm'] = input($_POST['comm']);
	if(empty($_POST['service'])){
		echo 'Выберите услугу!';
	}elseif(empty($_POST['woker'])){
		echo 'Выберите исполнителя';
	}elseif(empty($_POST['client'])){
		echo 'Введите клиента';
	}elseif(empty($_POST['phone'])){
		echo 'Введите контактный номер телефона';
	}else{
		$db->query("UPDATE `orders` SET `service`='".$_POST['service']."', `worker`='".$_POST['worker']."', `client`='".$_POST['client']."', `phone`='".$_POST['phone']."', `defect`='".$_POST['defect']."', `comm`='".$_POST['comm']."' WHERE `id`='".$_GET['id']."'");
		$order = $db->query("SELECT * FROM `orders` WHERE `id`='".$_GET['id']."'")->fetch_assoc();
		echo 'Информация о заказе обновлена';
	}
}
?>
<h1>Редактирование заявки</h1>
<form action="" method="POST">
	Услуга:<br>
	<select name="service">
		<option disabled>Выберите услугу</option>
		<?
		$query = $db->query("SELECT * FROM `services`");
		while($service = $query->fetch_assoc()){
			?>
			<option value="<?=$service['id']?>" <?if($service['id']==$order['service']){?> selected <?}?>><?=output($service['name'])?></option>
			<?
		}
		?>
	</select><br>
	Исполнитель:<br>
	<select name="worker">
		<option disabled>Выберите исполнителя</option>
		<?
		$query = $db->query("SELECT * FROM `workers`");
		while ($worker = $query->fetch_assoc()) {
			?>
			<option value="<?=$worker['id']?>" <?if($worker['id']==$order['worker']){?> selected <?}?>><?=output($worker['name'])?> <?=output($worker['surname'])?></option>
			<?
		}
		?>
	</select><br>
	Клиент:<br>
	<input type="text" name="client" value="<?=output($order['client'])?>"><br>
	Контактный номер телефона:<br>
	<input type="text" name="phone" value="<?=output($order['phone'])?>"><br>
	Описание поломки:<br>
	<textarea name="defect"><?=output($order['defect'])?></textarea><br>
	Комментарий к заявке:<br>
	<textarea name="comm"><?=output($order['comm'])?></textarea><br>
	<input type="submit" name="ok" value="Сохранить">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>