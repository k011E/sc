<?php
$title = 'Админ-панель';
include_once($_SERVER["DOCUMENT_ROOT"].'/style/head.php');
auth();
?>
<h1>Админ панель</h1>
<a href="/admin/exit">Выход</a>
<a href="/admin/services">Управление услугами</a>
<a href="/admin/workers">Управление сотрудниками</a>
<a href="/admin/orders">Управление заявками</a>
<?
include_once($_SERVER["DOCUMENT_ROOT"].'/style/foot.php');
?>