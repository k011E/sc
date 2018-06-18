<?php
$title = 'Админ-панель';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<h1>Админ панель</h1>
<a href="/admin/exit">Выход</a>
<a href="/admin/services">Управление услугами</a>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>