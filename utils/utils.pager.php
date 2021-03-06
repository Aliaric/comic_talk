<?php
  error_reporting(E_ALL & ~E_NOTICE);

  function pager($page, $total, $pnumber, $page_link, $parameters)
  {
    // Calculate amount of pages
    $number = (int)($total/$pnumber);
    if((float)($total/$pnumber) - $number != 0) $number++;
    // Check on left links
    if($page - $page_link > 1)
    {
      echo "<a href=$_SERVER[PHP_SELF]?page=1{$parameters}> <nobr>[1-$pnumber]</nobr></a>&nbsp;<em class=currentpage><nobr>&nbsp;...&nbsp;</nobr> </em>&nbsp;";
      // Have one
      for($i = $page - $page_link; $i<$page; $i++)
      {
          echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$parameters}> <nobr>[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]</nobr></a>&nbsp;";
      }
    }
    else
    {
      // Have no
      for($i = 1; $i<$page; $i++)
      {
          echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$parameters}> <nobr>[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]</nobr></a>&nbsp;";
      }
    }
    // Check on right links
    if($page + $page_link < $number)
    {
      // Have one
      for($i = $page; $i<=$page + $page_link; $i++)
      {
        if($page == $i)
          echo "<em class=currentpage><nobr>&nbsp;[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]&nbsp;</nobr> </em>";
        else
          echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$parameters}> <nobr>[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]</nobr></a>&nbsp;";
      }
      echo "<em class=currentpage><nobr>&nbsp;...&nbsp;</nobr> </em>&nbsp;<a href=$_SERVER[PHP_SELF]?page=$number{$parameters}> <nobr>[".(($number - 1)*$pnumber + 1)."-$total]</nobr></a>&nbsp;";
    }
    else
    {
      // Have no
      for($i = $page; $i<=$number; $i++)
      {
        if($number == $i)
        {
          if($page == $i)
            echo "<em class=currentpage><nobr>&nbsp;[".(($i - 1)*$pnumber + 1)."-$total]&nbsp;</nobr></em>";
          else
            echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$parameters}>[".(($i - 1)*$pnumber + 1)."-$total]</a>&nbsp;";
        }
        else
        {
          if($page == $i)
            echo "<em class=currentpage><nobr>&nbsp;[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]&nbsp;</nobr> </em>";
          else
            echo "&nbsp;<a href=$_SERVER[PHP_SELF]?page=$i{$parameters}> <nobr>[".(($i - 1)*$pnumber + 1)."-".$i*$pnumber."]</nobr></a>&nbsp;";
        }
      }
    }
    //echo "<br><br>";
  }

