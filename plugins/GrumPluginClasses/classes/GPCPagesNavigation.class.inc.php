<?php

/* -----------------------------------------------------------------------------
  class name     : GPCPagesNavigation
  class version  : 2.0.0
  plugin version : 3.0.0
  date           : 2010-03-30
  ------------------------------------------------------------------------------
  author: grum at piwigo.org
  << May the Little SpaceFrog be with you >>
  ------------------------------------------------------------------------------

  :: HISTORY

| release | date       |
| 2.0.0   | 2010/03/30 | * Update class & function names
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |

  ------------------------------------------------------------------------------

   this classes provides base functions to manage pages navigation

    - constructor GPCPagesNavigation()
    - (public) function setNbItems($nbitems)
    - (public) function getNbItems()
    - (public) function setNbItemsPerPage($nbitems)
    - (public) function getNbItemsPerPage()
    - (public) function getNbPages()
    - (public) function setCurrentPage($page)
    - (public) function getCurrentPage()
    - (public) function setBaseUrl($url)
    - (public) function getBaseUrl()
    - (public) function setOptions($var)
    - (public) function getOptions()
    - (public) function makeNavigation()
    - (private) function calcNbPages()
   ---------------------------------------------------------------------- */
class GPCPagesNavigation
{
  protected $nbitems;
  protected $nbitemsperpages;
  protected $nbpages;
  protected $currentpage;
  protected $baseurl;
  protected $pagevarurl;
  protected $options;

  public function __construct()
  {
    $this->nbitems=0;
    $this->nbitemsperpages=0;
    $this->nbpages=0;
    $this->currentpage=0;
    $this->baseurl='';
    $this->pagevarurl='';
    $this->options=array(
      'prev_next' => true,
      'first_last' => true,
      'display_all' => true,
      'number_displayed' => 2, //number of page displayed before and after current page
      'text_prev' => "&lt;",
      'text_first' => "&lt;&lt;",
      'text_next' => "&gt;",
      'text_last' => "&gt;&gt;",
    );
  }

  public function __destruct()
  {
    unset($this->nbitems);
    unset($this->nbitemsperpages);
    unset($this->nbpages);
    unset($this->currentpage);
    unset($this->baseurl);
    unset($this->pagevarurl);
    unset($this->options);
  }

  /*
    define value for total number of items
  */
  public function setNbItems($nbitems)
  {
    if($nbitems!=$this->nbitems)
    {
      $this->nbitems=$nbitems;
      $this->calcNbPages();
    }
    return($nbitems);
  }

  public function getNbItems()
  {
    return($nbitems);
  }

  /*
    define value for number of items displayed per pages
  */
  public function setNbItemsPerPage($nbitems)
  {
    if(($nbitems!=$this->nbitemsperpages)&&($nbitems>0))
    {
      $this->nbitemsperpages=$nbitems;
      $this->calcNbPages();
    }
    return($this->nbitemsperpages);
  }

  public function getNbItemsPerPage()
  {
    return($this->nbitemsperpages);
  }

  /*
    return numbers of pages
  */
  public function getNbPages()
  {
    return($this->nbpages);
  }

  /*
    define the current page number
  */
  public function setCurrentPage($page)
  {
    if(($page!=$this->currentpage)&&($page<=$this->nbpages)&&($page>0))
    {
      $this->currentpage=$page;
    }
    return($this->currentpage);
  }

  /*
    returns the current page number
  */
  public function getCurrentPage()
  {
    return($this->currentpage);
  }

  /*
    define the value for url
    ex: "http://mysite.com/admin.php?var1=xxx&var2=xxx"
  */
  public function setBaseUrl($url)
  {
    if($url!=$this->baseurl)
    {
      $this->baseurl=$url;
    }
    return($this->baseurl);
  }

  public function getBaseUrl()
  {
    return($this->baseurl);
  }

  /*
    define the value for variables's name
    ex: url = "http://mysite.com/admin.php?var1=xxx&var2=xxx"
        pagevar = "pagenumber"
    url made is "http://mysite.com/admin.php?var1=xxx&var2=xxx&pagenumber=xxx"
  */
  public function setPageVarUrl($var)
  {
    if($var!=$this->pagevarurl)
    {
      $this->pagevarurl=$var;
    }
    return($this->pagevarurl);
  }

  public function getPageVarUrl()
  {
    return($this->pagevarurl);
  }

  /*
    define the navigation bar options
  */
  public function setOptions($var)
  {
    if(is_array($var))
    {
      foreach($this->options as $key=>$val)
      {
        if(isset($var[$key]))
        {
          $this->options[$key]=$var[$key];
        }
      }
    }
    return($this->options);
  }

  public function getOptions()
  {
    return($this->options);
  }


  /*
    returns an html formatted string
  */
  public function makeNavigation($functionname='')
  {
    $text='';
    if(($this->options['display_all'])||($this->options['number_displayed']>=$this->nbpages))
    {
      for($i=1;$i<=$this->nbpages;$i++)
      {
        if($i!=$this->currentpage)
        {
          if($functionname=='')
          {
            $text.='<a href="'.$this->baseurl.'&'.$this->pagevarurl.'='.$i.'">'.$i.'</a>&nbsp;';
          }
          else
          {
            $text.='<a style="cursor:pointer;" onclick="'.$functionname.'('.$i.');">'.$i.'</a>&nbsp;';
          }
        }
        else
        {
          $text.=$i.'&nbsp;';
        }
      }
    }
    else
    {
      for($i=$this->currentpage-$this->options['number_displayed'];$i<=$this->currentpage+$this->options['number_displayed'];$i++)
      {
        if(($i>0)&&($i<=$this->nbpages))
        {
          if($i!=$this->currentpage)
          {
            if($functionname=='')
            {
              $text.='<a href="'.$this->baseurl.'&'.$this->pagevarurl.'='.$i.'">'.$i.'</a>&nbsp;';
            }
            else
            {
              $text.='<a style="cursor:pointer;" onclick="'.$functionname.'('.$i.');">'.$i.'</a>&nbsp;';
            }
          }
          else
          {
            $text.=$i.'&nbsp;';
          }
        }
      }
      if($this->currentpage-$this->options['number_displayed']>0)
      {
        $text='&nbsp;...&nbsp;'.$text;
      }
      if($this->currentpage+$this->options['number_displayed']<$this->nbpages)
      {
        $text.='&nbsp;...&nbsp;';
      }
    }

    if($this->options['prev_next'])
    {
      $prevp='';
      $nextp='';
      if($this->currentpage>1)
      {
        if($functionname=='')
        {
          $prevp='<a href="'.$this->baseurl.'&'.$this->pagevarurl.'='.($this->currentpage-1).'">&nbsp;'.$this->options['text_prev'].'&nbsp;</a>';
        }
        else
        {
          $prevp='<a style="cursor:pointer;" onclick="'.$functionname.'('.($this->currentpage-1).');">&nbsp;'.$this->options['text_prev'].'&nbsp;</a>';
        }
      }
      if($this->currentpage<$this->nbpages)
      {
        if($functionname=='')
        {
          $nextp='<a href="'.$this->baseurl.'&'.$this->pagevarurl.'='.($this->currentpage+1).'">&nbsp;'.$this->options['text_next'].'&nbsp;</a>';
        }
        else
        {
          $nextp='<a style="cursor:pointer;" onclick="'.$functionname.'('.($this->currentpage+1).');">&nbsp;'.$this->options['text_next'].'&nbsp;</a>';
        }
      }

      $text=$prevp.$text.$nextp;
    }

    if($this->options['first_last'])
    {
      $firstp='';
      $lastp='';
      if($this->currentpage>1)
      {
        if($functionname=='')
        {
          $firstp='<a href="'.$this->baseurl.'&'.$this->pagevarurl.'=1">&nbsp;'.$this->options['text_first'].'&nbsp;</a>';
        }
        else
        {
          $firstp='<a style="cursor:pointer;" onclick="'.$functionname.'(1);">&nbsp;'.$this->options['text_first'].'&nbsp;</a>';
        }
      }
      if($this->currentpage<$this->nbpages)
      {
        if($functionname=='')
        {
          $lastp='<a href="'.$this->baseurl.'&'.$this->pagevarurl.'='.$this->nbpages.'">&nbsp;'.$this->options['text_last'].'&nbsp;</a>';
        }
        else
        {
          $lastp='<a style="cursor:pointer;" onclick="'.$functionname.'('.$this->nbpages.');">&nbsp;'.$this->options['text_last'].'&nbsp;</a>';
        }
      }

      $text=$firstp.$text.$lastp;
    }

    return($text);
  }


  /*
    calculate the number of pages...
  */
  public function calcNbPages()
  {
    if($this->nbitemsperpages>0)
    {
      $this->nbpages=ceil($this->nbitems/$this->nbitemsperpages);
    }
  }

} //class

?>
