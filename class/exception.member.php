<?php

  error_reporting(E_ALL & ~E_NOTICE);
  // Non existing member call
  class ExceptionMember extends Exception
  {
    // Name
    protected $key;

    public function __construct($key, $message)
    {
      $this->key = $key;

      parent::__construct($message);
    }

    public function getKey()
    {
      return $this->key;
    }
  }
?>
