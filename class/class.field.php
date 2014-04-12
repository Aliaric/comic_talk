<?php
  error_reporting(E_ALL & ~E_NOTICE);
/**
 * @file
 * Base field class which is root of other field classes.
 */
  abstract class field  {
    // Element name
    protected $name;
    // Element type
    protected $type;
    // Element title
    protected $caption;
    protected $value;
    protected $is_required;
    protected $parameters;
    protected $help;
    protected $help_url;

    public $css_class;
    public $css_style;

    function __construct($name, 
                   $type, 
                   $caption, 
                   $is_required = false, 
                   $value = "",
                   $parameters = "", 
                   $help = "",
                   $help_url = "")
    {
      $this->name        = $this->encodestring($name);
      $this->type        = $type;
      $this->caption     = $caption;
      $this->value       = $value;
      $this->is_required = $is_required;
      $this->parameters  = $parameters;
      $this->help        = $help;
      $this->help_url    = $help_url;
    }
    // Checking field data
    abstract function check();

    // Get element html
    abstract function get_html();


    public function __get($key)  {
      if(isset($this->$key)) return $this->$key;
      else 
      {
        throw new ExceptionMember($key, 
              "Variable ".__CLASS__."::$key does not exists");
      }
    }

    // Export from russian to translit. Deprecated.
    protected function encodestring($st)
    {
      $st=strtr($st,"абвгдеёзийклмнопрстуфхъыэ_",
      "abvgdeeziyklmnoprstufh'iei");
      $st=strtr($st,"АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ_",
      "ABVGDEEZIYKLMNOPRSTUFH'IEI");
      // Than "morechars".
      $st=strtr($st, 
                      array(
                          "ж"=>"zh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", 
                          "щ"=>"shch","ь"=>"", "ю"=>"yu", "я"=>"ya",
                          "Ж"=>"ZH", "Ц"=>"TS", "Ч"=>"CH", "Ш"=>"SH", 
                          "Щ"=>"SHCH","Ь"=>"", "Ю"=>"YU", "Я"=>"YA",
                          "ї"=>"i", "Ї"=>"Yi", "є"=>"ie", "Є"=>"Ye"
                          )
               );
      return $st;
    }
  }

