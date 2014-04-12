<?php
  error_reporting(E_ALL & ~E_NOTICE);
/**
 * @file
 * Hidden field, integer only.
 */

  class field_hidden_int extends field_hidden
  {
    // �����, ����������� ������������ ���������� ������
    function check()
    {
      if($this->is_required)
      {
        // ���� ����������� � ����������
        if(!preg_match("|^[\d]+$|",$this->value))
        {
          return "������� ���� ������ ���� ����� ������";
        }
      }
      // ���� �� ����������� � ����������
      if(!preg_match("|^[\d]*$|",$this->value))
      {
        return "������� ���� ������ ���� ����� ������";
      }

      return "";
    }
  }
?>