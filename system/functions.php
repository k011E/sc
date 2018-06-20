<?php
function input($string){
	global $db;
	return $db->real_escape_string(trim($string));
}

function output($string){
	return htmlspecialchars($string);
}

function auth(){
	global $admin_auth;
	if($admin_auth != 1){
		header('location:/admin/auth');
	}
}

function authWorker(){
	global $user;
	if(!isset($user['id'])){
		header('location:/worker_space/auth');
	}
}

function convDate($time){
	date_default_timezone_set('Europe/Saratov');
	return date("d.m.o G:i", $time);
}
?>