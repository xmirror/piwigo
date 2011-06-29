<?php

/* -----------------------------------------------------------------------------
  class name     : GPCAjax
  class version  : 3.0.0
  plugin version : 3.0.0
  date           : 2010-03-30
  ------------------------------------------------------------------------------
  author: grum at piwigo.org
  << May the Little SpaceFrog be with you >>
  ------------------------------------------------------------------------------

  :: HISTORY

| release | date       |
| 3.0.0   | 2010/03/30 | * Update class & function names
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |

  ------------------------------------------------------------------------------
    no constructor, only static function are provided
    - static function return_result($str)
   ---------------------------------------------------------------------- */



class GPCAjax
{
  static public function returnResult($str)
  {
    //$chars=get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
    $chars['<']='<';
    $chars['>']='>';
    $chars['&']='&';
    exit(strtr($str, $chars));
  }
} //class

?>
