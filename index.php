<?php

  error_reporting(E_ALL & ~E_NOTICE);

  // Add DB config.
  require_once("config/config.php");
  require_once("utils/utils.print_page.php");
  // Forms config.
  require_once("config/class.config.dmn.php");

  // Add mini framework.
  //  require_once("config/class.config.php");
  // Top page template.
  require_once ("templates/top.php");

  $title = "Comments";
  $keywords = "comments";

  if(empty($_POST)) {
    $_REQUEST['hide'] = true;
  }

  $body = new field_textarea("body", "", true, $_POST['body']);
  $page = new field_hidden_int("page", "", true, $_REQUEST['page']);

  try {
    $form = new form(array(
        "body" => $body,
        "page" => $page
      ),
      "Send",
      "field");
  }
  catch(ExceptionObject $exc) {
    // todo catch exception
  }


  $date = date('Y-m-d H:i:s');
  // Catching form...
  if(!empty($_POST)) {
    try {
      // FIXME
      //$error = $form->check();
      $error = null;

      if(empty($error)) {
        // SQL insert query for comment.
        $query = "INSERT INTO $tbl_comments
                    VALUES (NULL,
                            '{$characters[array_rand($characters)]}',
                            '{$form->fields[body]->value}',
                            '{$date}'
                            )";
        $core = Core::getInstance();
        $stmt = $core->dbh->prepare($query);
        $stmt->execute();
        // Redirect back.
        header("Location: index.php");
        exit();
      }
    }
    catch(ExceptionMySQL $exc) {
      $a = 123;
      // todo catch MYSQL exception
    }
  }
  // Show form error.
  if(!empty($error))
  {
    foreach($error as $err)
    {
      echo "<span style=\"color:red\">$err</span><br>";
    }
  }
  // Show form.
  $form->print_form();



/** Show comments */

if(empty($_GET['id_news'])) {
  // Simple sql injection check
  $_GET['page'] = intval($_GET['page']);

  // Number of comments
  $pnumber = 10;

  $page_link = 3;
  // Call object of page navigation.
  $obj = new pager_mysql($tbl_comments,
    "",
    "ORDER BY putdate DESC",
    $pnumber,
    $page_link);




  // Get content of current page.
  $comments = $obj->get_page();
  // Если имеется хотя бы одна запись - выводим
  if(!empty($comments))
  {
    echo '<div>';

    // Deprecated code
    error_reporting(E_ALL & ~E_NOTICE);
    $patt = array("[b]", "[/b]", "[i]", "[/i]");
    $repl = array("", "", "", "");
    $pattern_url = "|\[url[^\]]*\]|";
    $pattern_b_url = "|\[/url[^\]]*\]|";
    for($i = 0; $i < count($comments); $i++)
    {
      if(strlen($comments[$i]['body']) > 100)
      {
        $comments[$i]['body'] = substr($comments[$i]['body'], 0, 100)."...";
        $comments[$i]['body'] = str_replace($patt, $repl, $comments[$i]['body']);
        $comments[$i]['body'] = preg_replace($pattern_url, "", $comments[$i]['body']);
        $comments[$i]['body'] = preg_replace($pattern_b_url, "", $comments[$i]['body']);
      }
      // Print comment data.
      echo '<div class="container"><a href="" class="icon-link"><img src="/files/' . $comments[$i]['name'] . '.png" class="icon"></a><span class="name">' .
        print_page($comments[$i]['name']) . '</span><span class="date">' . $comments[$i]['putdate'] .
        '</span><span class="body">' . $comments[$i]['body'] . "</span></div>";
    }
    echo "</div>";
    echo "<div class=rightpanel_txt>";
    echo $obj;
    echo "</div>";
  }
}
  // Bottom page template.
  require_once("utils/bottom.php");

