<?php

  error_reporting(E_ALL & ~E_NOTICE);
  require_once("config/config.php");
  $_GET['id_image'] = intval($_GET['id_image']);
  
  $query = "SELECT * FROM $tbl_paragraph_image
            WHERE hide = 'show' AND
                  id_image = $_GET[id_image]";
  $pos = mysql_query($query);
  if($pos)
  {
    if(mysql_num_rows($pos))
    {
      $position = mysql_fetch_array($pos);
    }
    else exit($query);
  }
  else exit(mysql_error());
?>
<html>
<head>
<title></title>
<meta http-equiv="imagetoolbar" content="no">
<style>
 table{font-size: 12px; font-family: Arial, Helvetica, sans-serif; background-color: #F3F3F3;}
</style>
</head>
<body marginheight="0" 
      marginwidth="0" 
      rightmargin="0" 
      bottommargin="0" 
      leftmargin="0" 
      topmargin="0">
<table height="100%" 
       cellpadding="0" 
       cellspacing="0" 
       width="100%" 
       border="1">
  <tr>
    <td height="100%" valign="middle" align="center">
      Please wait
      <div  style="position: absolute; top: 0px; left: 0px">
       <img src="<?= $position['big'];?>" border="0">
    </div>
    </td>
  </tr>
</table>    
<div style="position: absolute; z-index: 2; width: 100%; bottom: 5px" align="center">
<input class=button 
       type="submit" 
       value="Close"
       onclick="window.close();"></div>
</body>
</html>