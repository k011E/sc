<?php
$db = new mysqli("localhost", "root", "", "practika");

if($db->connect_errno){
	die('Ошибка подключения к БД: '.$db->connect_error);
}
?>