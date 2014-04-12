<?php
  error_reporting(E_ALL & ~E_NOTICE);
/**
 * @file
 * Hidden field.
 */

  class field_hidden extends field
  {
    function __construct($name,
                   $id_required = false, 
                   $value = "")
    {
      parent::__construct($name, 
                   "hidden", 
                   "-", 
                   $id_required, 
                   $value,
                   $parameters, 
                   "",
                   "");
    }
    
    // Call of field name and tags.
    function get_html()
    {
      $tag = "<input type=\"".$this->type."\" 
                     name=\"".$this->name."\" 
                     value=\"".htmlspecialchars($this->value, ENT_QUOTES)."\">\n";
      return array("", $tag);
    }
    // Checkin data
    function check()
    {
      // Deprecated
      if (!get_magic_quotes_gpc())
      {
        $this->value = mysql_escape_string($this->value);
      }
      if($this->is_required)
      {
        if(empty($this->value)) return "Скрытое поле не заполнено";
      }

      return "";
    }
  }
