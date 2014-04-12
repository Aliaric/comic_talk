<?php
  error_reporting(E_ALL & ~E_NOTICE);
  /**
   * @file
   * Pager class. Sorts data by pages
   */
  abstract class pager
  {
    abstract function get_total();
    abstract function get_pnumber();
    abstract function get_page_link();
    abstract function get_parameters();
    
    // Links to other pages
    public function __toString()
    {
      $return_page = "";

      // Use $_GET param to send page number.
      $page = intval($_GET['page']);
      if(empty($page)) $page = 1;

      // Calculate number of pages
      $number = (int)($this->get_total()/$this->get_pnumber());
      if((float)($this->get_total()/$this->get_pnumber()) - $number != 0)
      {
        $number++;
      }
      // Check for "left" links
      if($page - $this->get_page_link() > 1)
      {
        $return_page .= "<a href=$_SERVER[PHP_SELF]".
              "?page=1{$this->get_parameters()}> 
              [1-{$this->get_pnumber()}]
              </a>&nbsp;&nbsp;...&nbsp;&nbsp;";
        // If ok...
        for($i = $page - $this->get_page_link(); $i<$page; $i++)
        {
          $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                 "?page=$i{$this->get_parameters()}>
                  [".(($i - 1)*$this->get_pnumber() + 1).
                  "-".$i*$this->get_pnumber()."]
                  </a>&nbsp;";
        }
      }
      else
      {
        // Not
        for($i = 1; $i<$page; $i++)
        {
          $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                 "?page=$i{$this->get_parameters()}> 
                 [".(($i - 1)*$this->get_pnumber() + 1).
                 "-".$i*$this->get_pnumber()."]
                  </a>&nbsp;";
        }
      }
      // Check for "right" links
      if($page + $this->get_page_link() < $number)
      {
        // Yes
        for($i = $page; $i<=$page + $this->get_page_link(); $i++)
        {
          if($page == $i)
            $return_page .= "&nbsp;[".
                (($i - 1) * $this->get_pnumber() + 1).
                 "-".$i*$this->get_pnumber()."]&nbsp;";
          else
            $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                 "?page=$i{$this->get_parameters()}> 
                 [".(($i - 1)*$this->get_pnumber() + 1).
                 "-".$i*$this->get_pnumber()."]
                 </a>&nbsp;";
        }
        $return_page .= "&nbsp;...&nbsp;&nbsp;".
             "<a href=$_SERVER[PHP_SELF]".
             "?page=$number{$this->get_parameters()}> 
             [".(($number - 1)*$this->get_pnumber() + 1).
             "-{$this->get_total()}]
             </a>&nbsp;";
      }
      else
      {
        // No
        for($i = $page; $i<=$number; $i++)
        {
          if($number == $i)
          {
            if($page == $i)
              $return_page .= "&nbsp;[".
                              (($i - 1)*$this->get_pnumber() + 1).
                              "-{$this->get_total()}]&nbsp;";
            else
              $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                   "?page=$i{$this->get_parameters()}>
                   [".(($i - 1)*$this->get_pnumber() + 1).
                   "-{$this->get_total()}]
                   </a>&nbsp;";
          }
          else
          {
            if($page == $i)
              $return_page .= "&nbsp;[".
                  (($i - 1)*$this->get_pnumber() + 1).
                   "-".$i*$this->get_pnumber()."]&nbsp;";
            else
              $return_page .= "&nbsp;<a href=$_SERVER[PHP_SELF]".
                   "?page=$i{$this->get_parameters()}> 
                   [".(($i - 1)*$this->get_pnumber() + 1).
                   "-".($i*$this->get_pnumber())."]
                   </a>&nbsp;";
          }
        }
      }
      return $return_page;
    }

    // Other view of page navigation
    public function print_page()
    {
      $return_page = "";

      // Use $_GET param to send page number.
      $page = intval($_GET['page']);
      if(empty($page)) $page = 1;

      // Calculate amount of pages
      $number = (int)($this->get_total()/$this->get_pnumber());
      if((float)($this->get_total()/$this->get_pnumber()) - $number != 0)
      {
        $number++;
      }

      // Link on first page
      $return_page .= "<a href='$_SERVER[PHP_SELF]?page=1{$this->get_parameters()}'>&lt;&lt;</a> ... ";
      // Output link "Back" if it is not firs page.
      if($page != 1) $return_page .= " <a href='$_SERVER[PHP_SELF]?page=".($page - 1)."{$this->get_parameters()}'>&lt;</a> ... "; 
      
      // Output previous elements
      if($page > $this->get_page_link() + 1) 
      { 
        for($i = $page - $this->get_page_link(); $i < $page; $i++) 
        { 
          $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a> "; 
        } 
      } 
      else 
      { 
        for($i = 1; $i < $page; $i++) 
        { 
          $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a> "; 
        } 
      } 
      // Output current element
      $return_page .= "$i "; 
      // Output next elements
      if($page + $this->get_page_link() < $number) 
      { 
        for($i = $page + 1; $i <= $page + $this->get_page_link(); $i++) 
        { 
          $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a> "; 
        } 
      } 
      else 
      { 
        for($i = $page + 1; $i <= $number; $i++) 
        { 
          $return_page .= "<a href='$_SERVER[PHP_SELF]?page=$i'>$i</a> "; 
        } 
      } 

      // Output link "Next" if it is not first page.
      if($page != $number) $return_page .= " ... <a href='$_SERVER[PHP_SELF]?page=".($page + 1)."{$this->get_parameters()}'>&gt;</a>"; 
      // Link on last page.
      $return_page .= " ... <a href='$_SERVER[PHP_SELF]?page=$number{$this->get_parameters()}'>&gt;&gt;</a>";
  
      return $return_page;
    }
  }

