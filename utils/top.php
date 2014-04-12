<?php
  ////////////////////////////////////////////////////////////
  // 2006-2007 (C) Кузнецов М.В., Симдянов И.В.
  // Объектно ориентированное программирование на PHP
  // IT-студия SoftTime (http://www.softtime.ru)
  ////////////////////////////////////////////////////////////
  // Выставляем уровень обработки ошибок 
  // (http://www.softtime.ru/info/articlephp.php?id_article=23)
  error_reporting(E_ALL & ~E_NOTICE);
  ////////////////////////////////////////////////////////////
  // Выставляем уровень обработки ошибок (http://www.softtime.ru/info/articlephp.php?id_article=23)
  Error_Reporting(E_ALL & ~E_NOTICE); 

  // Устанавливаем соединение с базой данных

  $namepage = "SoftTime Framework";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><?php echo $title; ?></title>
<link rel="StyleSheet" type="text/css" href="utils/counter.css">
</head>
<body leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" bottommargin="0" topmargin="0" >
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr valign="top">
    <td colspan="3">
    </td>
  </tr>
  <tr valign=top>

  <td class=main height=100%>
    <h1 class=namepage><?php echo $title ?>&nbsp;&nbsp;</h1>
    <?php echo $pageinfo ?><br><br>
