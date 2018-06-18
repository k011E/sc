<?php
$config = $db->query("SELECT * FROM `config` WHERE `id`=1")->fetch_assoc();
$admin_auth = 0;
if(isset($_COOKIE['password'])){
	$_COOKIE['password'] = $db->real_escape_string($_COOKIE['password']);
	if($config['password'] == $_COOKIE['password']){
		$admin_auth = 1;
	}
}
?>