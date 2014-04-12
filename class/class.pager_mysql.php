<?php

  error_reporting(E_ALL & ~E_NOTICE);
  class pager_mysql extends pager
  {
    protected $tablename;
    protected $where;
    protected $order;
    private $pnumber;

    private $page_link;
    private $parameters;
    public function __construct($tablename,
                                $where = "",
                                $order = "",
                                $pnumber = 10, 
                                $page_link = 3, 
                                $parameters = "")
    {
      $this->tablename  = $tablename;
      $this->where      = $where;
      $this->order      = $order;
      $this->pnumber    = $pnumber;
      $this->page_link  = $page_link;
      $this->parameters = $parameters;
    }
    public function get_total()
    {

      $query = "SELECT COUNT(*) FROM {$this->tablename} {$this->where} {$this->order}";

      $core = Core::getInstance();
      $stmt = $core->dbh->prepare($query);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

      if(!$stmt->execute())
      {
        throw new ExceptionMySQL(mysql_error(), 
                                 $query,
                                 "Error in sql query");
      }
      if ($stmt->execute()) {
        $query = $stmt->fetchColumn();
        return $query;
      }
      else {
        return false;
      }
    }
    public function get_pnumber()
    {
      // Amount of position on page.
      return $this->pnumber;
    }
    public function get_page_link()
    {
      // Amount of links on left and right
      return $this->page_link;
    }
    public function get_parameters()
    {
      // Additional link params
      return $this->parameters;
    }
    // Get page data.
    public function get_page()
    {
      // Current page
      $page = intval($_GET['page']);
      if(empty($page)) $page = 1;
      // Total amount of items
      $total = $this->get_total();
      // Calculate amount of pages
      $number = (int)($total/$this->get_pnumber());
      if((float)($total/$this->get_pnumber()) - $number != 0) $number++;
      // Check page number
      if($page <= 0 || $page > $number) return 0;
      // Извлекаем позиции текущей страницы
      $arr = array();

      $first = ($page - 1)*$this->get_pnumber();
      // Get data SQL query
      $query = "SELECT * FROM {$this->tablename} {$this->where} {$this->order} LIMIT $first, {$this->get_pnumber()}";

      $core = Core::getInstance();
      $stmt = $core->dbh->prepare($query);

      if ($stmt->execute()) {
        $arr = $stmt->fetchAll();
      }
      return $arr;
    }
  }
