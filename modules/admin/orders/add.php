<?php
$title = 'Добавление заявки';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<h1>Добавление заявки</h1>
<?
if(isset($_POST['ok'])){
	$_POST['service'] = abs(intval($_POST['service']));
	$_POST['worker'] = abs(intval($_POST['worker']));
	$_POST['client'] = input($_POST['client']);
	$_POST['phone'] = input($_POST['phone']);
	$_POST['defect'] = input($_POST['defect']);
	$_POST['comm'] = input($_POST['comm']);
	$time = time() + abs(intval($_POST['time'])) * 60 * 60 * 24;
	if(empty($_POST['service'])){
		echo 'Выберите услугу!';
	}elseif(empty($_POST['worker'])){
		echo 'Выберите исполнителя заявки';
	}elseif(empty($_POST['client'])){
		echo 'Заполните поле "Клиент"';
	}elseif(empty($_POST['phone'])){
		echo 'Заполните поле "Контактный номер телефона"';
	}else{
		$db->query("INSERT INTO `orders` SET `time`='".time()."', `service`='".$_POST['service']."', `worker`='".$_POST['worker']."', `client`='".$_POST['client']."', `phone`='".$_POST['phone']."', `defect`='".$_POST['defect']."', `comm`='".$_POST['comm']."', `ttime`='".$time."'");
		header('location:/admin/orders');
	}
}
?>
<form action="" method="POST">
	Услуга:<br>
	<select name="service">
		<option disabled selected>Выберите услугу</option>
		<?
		$query = $db->query("SELECT * FROM `services`");
		while($service = $query->fetch_assoc()){
			?>
			<option value="<?=$service['id']?>"><?=output($service['name'])?></option>
			<?
		}
		?>
	</select><br>
	Исполнитель:<br>
	<select name="worker">
		<option disabled selected>Выберите исполнителя</option>
		<?
		$query = $db->query("SELECT * FROM `workers`");
		while($worker = $query->fetch_assoc()){
			?>
			<option value="<?=$worker['id']?>"><?=output($worker['name'])?> <?=output($worker['surname'])?></option>
			<?
		}
		?>
	</select><br>
	Клиент:<br>
	<input type="text" name="client"><br>
	Контактный номер телефона:<br>
	<input type="text" name="phone"><br>
	Описание поломки:<br>
	<textarea name="defect"></textarea><br>
	Комментарий к заявке:<br>
	<textarea name="comm"></textarea><br>
	Время исполнения:<br>
	<input type="number" name="time"> дн.<br>
	<input type="submit" name="ok" value="Добавить">
</form>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>