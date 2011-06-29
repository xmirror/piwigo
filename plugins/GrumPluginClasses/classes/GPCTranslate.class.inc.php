<?php

/* -----------------------------------------------------------------------------
  class name     : GPCTranslate
  class version  : 2.1.1
  plugin version : 3.4.0
  date           : 2011-01-28
  ------------------------------------------------------------------------------
  author: grum at piwigo.org
  << May the Little SpaceFrog be with you >>
  ------------------------------------------------------------------------------

  ------------------------------------------------------------------------------

  :: HISTORY

| release | date       |
| 2.1.0   | 2010/03/31 | * update class & functions names
|         |            |
| 2.1.1   | 2011/01/09 | * fixbug on js loading
|         |            |
|         |            | * use GPCCore::addUI function (the class is kept for
|         |            |   compatibility with older plugins)
|         |            |
|         |            |

  ------------------------------------------------------------------------------
   class call API in HTML header, and provide a .js file manage API call
        >>  http://code.google.com/apis/ajaxlanguage/

    - constructor
   ---------------------------------------------------------------------- */
class GPCTranslate
{
  public function __construct()
  {
    GPCCore::addUI('googleTranslate');
  }
} //class

?>
