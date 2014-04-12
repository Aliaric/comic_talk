<?php
////////////////////////////////////////////////////////////
// 2006-2007 (C) Кузнецов М.В., Симдянов И.В.
// Объектно ориентированное программирование на PHP
// IT-студия SoftTime (http://www.softtime.ru)
////////////////////////////////////////////////////////////
// Выставляем уровень обработки ошибок
// (http://www.softtime.ru/info/articlephp.php?id_article=23)
error_reporting(E_ALL & ~E_NOTICE);

// DB connection
require_once("/config/config.php");

// Classes
require_once("/config/class.config.dmn.php");

// Simple SLQ injection check
$_GET['id_news'] = intval($_GET['id_news']);


// Create remove slq query and execute it.
$query = "DELETE FROM $tbl_comments
              WHERE id_comment=$_GET[id_news]
              LIMIT 1";

$core = Core::getInstance();
$stmt = $core->dbh->prepare($query);
$stmt->execute();
if($stmt->execute())
{
  header("Location: admin.php");
}
else {
  echo 'Fail';
}
