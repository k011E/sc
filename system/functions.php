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

function convDate($time){
	return date("d.m.o G:i", $time);
}
?>