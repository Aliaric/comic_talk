<?php

  error_reporting(E_ALL & ~E_NOTICE);

  require_once("config/config.php");
  require_once("config/class.config.dmn.php");
  require_once("utils/utils.print_page.php");


if(!$_SESSION['login_data'] xor $_POST['exit'] == 1) {

  unset ($_SESSION['login_data']);
  echo "404";
  exit;
}
  // Page title and help info
  $title = 'Administration page';
  $pageinfo = '<p class=help>Here you can overview and remove comments.</p>';

  // Template for top page
  require_once("utils/top.php");

$exit = new field_hidden_int("exit",
  "",
  true,
  $_REQUEST['page']);

try
{
  $form = new form(array(
      "page" => $exit),
    "Log off",
    "field"
  );
}
catch(ExceptionObject $exc)
{
  // todo write exception
}

$form->print_form();
  try
  {
    // Amount of links
    $page_link = 3;
    // Amount of item numbers
    $pnumber = 10;
    // Call for data
    $obj = new pager_mysql($tbl_comments,
                           "",
                           "ORDER BY putdate DESC",
                           $pnumber,
                           $page_link);

  
    // Get current page data.
    $news = $obj->get_page();
    // Print
    if(!empty($news))
    {
      ?>
      <table width="100%" 
             class="table" 
             border="0" 
             cellpadding="0" 
             cellspacing="0">      
        <tr class="header" align="center">
          <td width=200>Date</td>
          <td width=60%>Comment</td>
          <td width=40>Special</td>
          <td>Actions</td>
        </tr>
      <?php

  error_reporting(E_ALL & ~E_NOTICE);
      for($i = 0; $i < count($news); $i++)
      {
        // Control links
        $colorrow = "";
        $url = "?id_news={$news[$i][id_comment]}";
        if($news[$i]['hide'] == 'show')
        {
          $showhide = "<a href=hide.php$url 
                          title='Скрыть новость в блоке новостей'>
                       Скрыть</a>";
        }
        else
        {
          $showhide = "<a href=show.php$url 
                          title='View comment'>
                       View comment</a>";
          $colorrow = "class='hiddenrow'";
        }
        $url_pict = "no";
        
        $news_url="";
        if (!empty($news[$i]['url']))
        {
          if(!preg_match("|^http://|i",$news[$i]['url']))
          {
            $news[$i]['url'] = "http://{$news[$i][url]}";
          }
          $news_url = "<br><b>Ссылка:</b> 
                       <a href='{$news[$i][url]}'>{$news[$i][urltext]}</a>";
          if(empty($news[$i]['urltext']))
          {
            $news_url = "<br><b>Ссылка:</b> 
                         <a href='{$news[$i][url]}'>{$news[$i][url]}</a>";
          }
        }


        list($date, $time) = explode(" ", $news[$i]['putdate']);
        list($year, $month, $day) = explode("-", $date);
        $news[$i]['putdate'] = "$day.$month.$year $time";

        // Print comment
        echo "<tr $colorrow >
                <td><p align=center>{$news[$i][putdate]}</td>
                <td>
                  <a title='Check comment'
                     href=''>" .$news[$i]['name']."</a><br>
                  ".nl2br(print_page($news[$i]['body']))."</td>
                <td align=center>$url_pict</td>
                <td align=center>$showhide<br>
                   <a href=# onClick=\"delete_news('delnews.php$url');\" 
                      title='Remove comment'>Remove</a><br>
                   <a href=editnews.php$url 
                      title='Edit comment'>Edit</a></td>
              </tr>";
      }
      echo "</table><br>";
    }
  
    // Print links
    echo $obj;
  }
  catch(ExceptionMySQL $exc)
  {
    // require("utils/exception_mysql.php");
  }




  // Bottom page template
  require_once("utils/bottom.php");
?>
<script language="JavaScript">
  function delete_news(url)
  {
    if(confirm("Are you sure you want to remove comment?"))
    {
      console.log(url);
      location.href=url;
    }
    return false;
  }
</script>
