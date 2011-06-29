<?php

/* -----------------------------------------------------------------------------
  class name: GPCPublicIntegration
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
| 2.1.0   | 2010/10/28 | * Add the pageIsSection() function
|         |            |
|         |            |
|         |            |
|         |            |
  ------------------------------------------------------------------------------

  this class provides base functions to manage an integration into main index
  page

  - constructor GPCPublicIntegration($section)
  - (public) function initEvents()
  - (public) function setCallbackPageFunction($value)
  - (public) function pageIsSection()
  - (private) function initSection()
  - (private) function callPage()

  use initEvents() function to initialize needed triggers for updating menubar

  the "callback_page_function" is called everytime a specific page is displayed

----------------------------------------------------------------------------- */

class GPCPublicIntegration
{
  var $section;         //section applied to the page viewed
  var $callback_page_function;        //called function to display page

  public function __construct($section)
  {
    $this->section=$section;
    $this->callback_page_function='';
  }

  public function __destruct()
  {
    unset($this->section);
    unset($this->callback_page_function);
  }

  /**
   * initialize events to manage menu & page integration
   */
  public function initEvents()
  {
    add_event_handler('loc_end_section_init', array(&$this, 'initSection'));
    add_event_handler('loc_end_index', array(&$this, 'callPage'));
  }

  public function setCallbackPageFunction($value)
  {
    $this->callback_page_function=$value;
  }

  /**
   * initialize section in piwigo
   */
  public function initSection()
  {
    global $tokens, $page;

    if ($tokens[0] == $this->section)
    { $page['section'] = $this->section; }
  }

  /**
   * loads the section page
   */
  public function callPage()
  {
    global $page, $user;

    if($page['section'] == $this->section)
    {
      @call_user_func($this->callback_page_function);
    }
  }

  /**
   * return true if current page is the section
   */
  public function pageIsSection()
  {
    return($_SERVER['QUERY_STRING']=='/'.$this->section);
  }

} //class GPCPublicIntegration


?>
