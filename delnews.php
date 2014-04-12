<?php

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
