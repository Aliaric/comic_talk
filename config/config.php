<?php

  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  // DB host
  $dblocation = "127.0.0.1";
  // DB name.
  $port = '3306';
  $dbname = "script";
  // DB User.
  $dbuser = "admin5QBLGGB";
  // DB pass.
  $dbpasswd = "1Ck9Gc_32j-h";

  // Databases we operate.
  $tbl_accounts = 'system_accounts';
  $tbl_comments = 'system_comments';


  // Chatting characters.
  $characters = array('boo', 'goomba', 'goonie', 'mushroom', 'mario', 'flower_retro', 'shyguy', 'flower');

class Core
{
  public $dbh; // handle of the db connexion
  private static $instance;

  private function __construct()
  {
    // building data source name from config
    $dsn = 'mysql:host=' . Config::read('db.host') .
      ';dbname='    . Config::read('db.basename') .
      ';port='      . Config::read('db.port') .
      ';connect_timeout=15';
    // getting DB user from config
    $user = Config::read('db.user');
    // getting DB password from config
    $password = Config::read('db.password');

    $this->dbh = new PDO($dsn, $user, $password);
  }

  public static function getInstance()
  {
    if (!isset(self::$instance))
    {
      $object = __CLASS__;
      self::$instance = new $object;
    }
    return self::$instance;
  }

}

class Config
{
  static $confArray;

  public static function read($name)
  {
    return self::$confArray[$name];
  }

  public static function write($name, $value)
  {
    self::$confArray[$name] = $value;
  }

}

Config::write('db.host', $dblocation);
Config::write('db.port', $port);
Config::write('db.basename', $dbname);
Config::write('db.user', $dbuser);
Config::write('db.password', $dbpasswd);


