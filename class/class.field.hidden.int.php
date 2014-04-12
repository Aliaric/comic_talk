<?php
  error_reporting(E_ALL & ~E_NOTICE);
/**
 * @file
 * Hidden field, integer only.
 */

  class field_hidden_int extends field_hidden
  {
    // Метод, проверяющий корректность переданных данных
    function check()
    {
      if($this->is_required)
      {
        // Поле обязательно к заполнению
        if(!preg_match("|^[\d]+$|",$this->value))
        {
          return "Скрытое поле должно быть целым числом";
        }
      }
      // Поле не обязательно к заполнению
      if(!preg_match("|^[\d]*$|",$this->value))
      {
        return "Скрытое поле должно быть целым числом";
      }

      return "";
    }
  }
?>