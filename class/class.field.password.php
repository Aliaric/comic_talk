<?php

  error_reporting(E_ALL & ~E_NOTICE);
/**
 * @file
 * Password field class.
 */

  class field_password extends field_text
  {
    function __construct($name, 
                   $caption, 
                   $is_required = false, 
                   $value = "",
                   $maxlength = 255,
                   $size = 41,
                   $parameters = "", 
                   $help = "",
                   $help_url = "")
    {
      // Calling constructor of field_text class
      parent::__construct($name, 
                   $caption, 
                   $is_required, 
                   $value,
                   $maxlength,
                   $size,
                   $parameters, 
                   $help,
                   $help_url);
       // Type is different.
       $this->type = "password";
    }
  }

