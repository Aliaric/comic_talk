<?php

  error_reporting(E_ALL & ~E_NOTICE);
  abstract class pager_abstract extends pager
  {
    // Directory name
    protected $dirname;
    // Amount elements on [age
    protected $pnumber;
    // Amount of links on left and right side.
    protected $page_link;
    // Params
    protected $parameters;
    public function __construct($dirname,
                                $pnumber = 10, 
                                $page_link = 3, 
                                $parameters = "")
    {
      $this->dirname    = trim($dirname, "/");
      $this->pnumber    = $pnumber;
      $this->page_link  = $page_link;
      $this->parameters = $parameters;
    }
    public function get_pnumber()
    {
      return $this->pnumber;
    }
    public function get_page_link()
    {

      return $this->page_link;
    }
    public function get_parameters()
    {
      return $this->parameters;
    }
  }
