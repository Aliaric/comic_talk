<?php
  error_reporting(E_ALL & ~E_NOTICE);
/**
 * @file
 * Hidden field, integer only.
 */

  class field_hidden_int extends field_hidden
  {
    // Method checks if data is correct.
    function check()
    {
      if($this->is_required)
      {
        // Required field
        if(!preg_match("|^[\d]+$|",$this->value))
        {
          return "Hidden field should be an integer.";
        }
      }
      // Non required field
      if(!preg_match("|^[\d]*$|",$this->value))
      {
        return "Hidden field should be an integer.";
      }

      return "";
    }
  }

