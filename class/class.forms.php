<?php

  error_reporting(E_ALL & ~E_NOTICE);
  /**
   * @file
   * Form class.
   */

  class form
  {
    public $fields;
    protected $button_name;

    protected $css_td_class;
    protected $css_td_style;
    protected $css_fld_class;
    protected $css_fld_style;

    public function __construct($flds,
                         $button_name, 
                         $css_td_class = "", 
                         $css_td_style = "",
                         $css_fld_class = "",
                         $css_fld_style = "")
    {
      $this->fields       = $flds;
      $this->button_name  = $button_name;

      $this->css_td_class = $css_td_class;
      $this->css_td_style = $css_td_style;
      $this->css_fld_class = $css_fld_class;
      $this->css_fld_style = $css_fld_style;

      // Checking if elements of array $flds are extending class "field".
      foreach($flds as $key => $obj)
      {
        if(!is_subclass_of($obj, "field"))
        {
          throw new ExceptionObject($key, 
                "\"$key\" it is not an element.");
        }
      }
    }

    // Form output.
    public function print_form()
    {
      $enctype = "";
      if(!empty($this->fields))
      {
        foreach($this->fields as $obj)
        {

          if(!empty($this->css_fld_class))
          {
            $obj->css_class = $this->css_fld_class;
          }
          if(!empty($this->css_fld_class))
          {
            $obj->css_style = $this->css_fld_style;
          }
          if($obj->type == "file")
          {
            $enctype = "enctype='multipart/form-data'";
          }
        }
      }
      if(!empty($this->css_td_style))
      {
        $style = "style=\"".$this->css_td_style."\"";
      }
      else $style = "";
      if(!empty($this->css_td_class))
      {
        $class = "class=\"".$this->css_td_class."\"";
      }
      else $class = "";
      
      // Print html form.
      echo "<form name=form $enctype method=post>";
      echo "<table>";
      if(!empty($this->fields))
      {
        foreach($this->fields as $obj)
        {
          list($caption, $tag, $help, $alternative) = $obj->get_html();
          if(is_array($tag)) $tag = implode("<br>",$tag);
          switch($obj->type)
          {
            case "hidden":
              // Скрытое поле
              echo $tag;
              break;
            case "paragraph":
            case "title":
              echo "<tr>
                      <td $style $class colspan=2 valign=top>$tag</td>
                    </tr>\n";
              break;

            default:
              echo "<tr>
                      <td>&nbsp;</td>
                      <td $style $class valign=top>$tag</td>
                    </tr>\n";
              if(!empty($help))
              {
                echo "<tr>
                        <td>&nbsp;</td>
                        <td $style $class valign=top>$help</td>
                      </tr>";
              }
              break;
          }
        }
      }

      // Output confirm button
      echo "<tr>
              <td $style $class></td>
              <td $style $class>
                <input class=button 
                       type=submit 
                       value=\"".htmlspecialchars($this->button_name, ENT_QUOTES)."\">
              </td>
            </tr>\n";
      echo "</table>";
      echo "</form>";
    }

    // Deprecated
    public function __toString()
    {
      $this->print_form();
    }

    // Check form data
    public function check()
    {
      $arr = array();
      if(!empty($this->fields))
      {
        foreach($this->fields as $obj)
        {
          $str = $obj->check();
          if(!empty($str)) $arr[] = $str;
        }
      }
      return $arr;
    }
  }
