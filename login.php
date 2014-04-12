<?php

error_reporting(E_ALL & ~E_NOTICE);

require_once("config/config.php");
require_once("config/class.config.dmn.php");

require_once("config/class.config.php");


require_once ("templates/top_login.php");

if(empty($_POST))
{

  $_REQUEST['hide'] = true;
}

$login = new field_text("login",
  "Login",
  true,
  $_POST['login']);
$password = new field_password("password",
                                "Password",
                                true,
                                $_POST['password']);

$page    = new field_hidden_int("page",
  "",
  true,
  $_REQUEST['page']);

try
{
  $form = new form(array(
      "login" => $login,
      "password" => $password,
      "page" => $page
    ),
    "Submit",
    "field");
}
catch(ExceptionObject $exc)
{
  require("dmn/utils/exception_object.php");
}

if(!empty($_POST))
{


  $query = "SELECT * FROM $tbl_accounts WHERE name = :login AND pass = :password";

  try {
    $core = Core::getInstance();
    $stmt = $core->dbh->prepare($query);
    $stmt->bindParam(':login', $_POST['login']);
    $stmt->bindParam(':password', $_POST['password']);

    if($stmt->execute()) {
      $_SESSION['login_data'] = $stmt->fetch(PDO::FETCH_ASSOC);
      header("Location: admin.php");
    }

  }
  catch(ExceptionMySQL $exc)
  {
    require("dmn/utils/exception_mysql.php");
  }
}

$form->print_form();


require_once ("templates/bottom_login.php");

