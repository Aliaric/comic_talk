<?php

  error_reporting(E_ALL & ~E_NOTICE);

  require_once((dirname(__FILE__)) . "/../class/class.field.php");
  require_once((dirname(__FILE__)) . "/../class/class.field.text.php");

  require_once((dirname(__FILE__)) . "/../class/class.field.password.php");
  require_once((dirname(__FILE__)) . "/../class/class.field.textarea.php");
  require_once((dirname(__FILE__)) . "/../class/class.field.hidden.php");
  require_once((dirname(__FILE__)) . "/../class/class.field.hidden.int.php");

  require_once((dirname(__FILE__)) . "/../class/class.field.title.php");

  require_once((dirname(__FILE__)) . "/../class/class.forms.php");

  require_once((dirname(__FILE__)) . "/../class/exception.member.php");
  require_once((dirname(__FILE__)) . "/../class/exception.mysql.php");
  require_once((dirname(__FILE__)) . "/../class/exception.object.php");

  require_once((dirname(__FILE__)) . "/../class/class.pager.php");
  require_once((dirname(__FILE__)) . "/../class/class.pager_abstract.php");

  require_once((dirname(__FILE__)) . "/../class/class.pager_mysql.php");
