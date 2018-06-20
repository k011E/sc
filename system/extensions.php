<?php
$config = $db->query("SELECT * FROM `config` WHERE `id`=1")->fetch_assoc();
$admin_auth = 0;
if(isset($_COOKIE['password'])){
	$_COOKIE['password'] = $db->real_escape_string($_COOKIE['password']);
	if($config['password'] == $_COOKIE['password']){
		$admin_auth = 1;
	}
}

if(isset($_COOKIE['pwd']) && isset($_COOKIE['email'])){
	$_COOKIE['pwd'] = $db->real_escape_string($_COOKIE['pwd']);
	$_COOKIE['email'] = $db->real_escape_string($_COOKIE['email']);
	$query = $db->query("SELECT * FROM `workers` WHERE `email`='".$_COOKIE['email']."' AND `password`='".$_COOKIE['pwd']."'");
	if($query->num_rows != 0){
		$user = $query->fetch_assoc();
	}
}
?>