<?php
/*
 * --:: JPEG MetaDatas ::-------------------------------------------------------
 *
 *  Author    : Grum
 *   email    : grum at piwigo.org
 *   website  : http://photos.grum.fr
 *
 *   << May the Little SpaceFrog be with you ! >>
 *
 * +-----------------------------------------------------------------------+
 * | JpegMetaData - a PHP based Jpeg Metadata manager                      |
 * +-----------------------------------------------------------------------+
 * | Copyright(C) 2010  Grum - http://www.grum.fr                          |
 * +-----------------------------------------------------------------------+
 * | This program is free software; you can redistribute it and/or modify  |
 * | it under the terms of the GNU General Public License as published by  |
 * | the Free Software Foundation                                          |
 * |                                                                       |
 * | This program is distributed in the hope that it will be useful, but   |
 * | WITHOUT ANY WARRANTY; without even the implied warranty of            |
 * | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
 * | General Public License for more details.                              |
 * |                                                                       |
 * | You should have received a copy of the GNU General Public License     |
 * | along with this program; if not, write to the Free Software           |
 * | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
 * | USA.                                                                  |
 * +-----------------------------------------------------------------------+
 *
 *
 * -----------------------------------------------------------------------------
 *
 * This DateTime class is used if the PHP version don't have built-in DateTime
 * class
 *
 * Only the needed methods are provided :
 *  - public function __construct($time, $timeZone=null)
 *  - public function format($fmt)
 *
 * -----------------------------------------------------------------------------
 */

  if(!class_exists('DateTime'))
  {
    Class DateTimeZone
    {
      private $timeZone='UTC';
      private $pushedTZ='UTC';

      public function __construct($value='UTC')
      {
        $this->set($value);
      }

      /**
       * return the time zone
       */
      public function get()
      {
        return($this->timeZone);
      }

      /**
       * set the time zone
       */
      public function set($timeZone)
      {
        if(is_string($timeZone))
        {
          $this->timeZone=$timeZone;
        }
      }

      /**
       * apply the time zone to the system
       */
      public function push()
      {
        if(function_exists('date_default_timezone_get'))
        {
          $this->pushed=date_default_timezone_get();
          date_default_timezone_set($this->timeZone);
        }
      }

      /**
       * restore the previous system time zone
       */
      public function pop()
      {
        if(function_exists('date_default_timezone_set'))
        {
          $this->pushed=date_default_timezone_set($this->pushed);
        }
      }
    }


    class DateTime
    {
      private $time=0;
      private $timeZone=null;

      public function __construct($time=null, DateTimeZone $timeZone=null)
      {
        if(is_string($time))
        {
          /*
           * try to parse the string ; assume the current date/time if provided
           * string can't be interpreted
           */
          $this->time=strtotime($time);
          if($this->time===false) $this->time=time();
        }
        elseif(is_numeric($time))
        {
          // a timestamp was given
          $this->time=$time;
        }
        else
        {
          // in all other case, assume it's equal to the current date/time
          $this->time=time();
        }
        $this->timeZone=$timeZone;
      }

      public function __destruct()
      {
      }

      /**
       * returns the date/time in the given time zone
       */
      public function format($fmt='c')
      {
        if(!is_null($this->timeZone)) $this->timeZone->push();
        $returned=date($fmt, $this->time);
        if(!is_null($this->timeZone)) $this->timeZone->pop();
        return($returned);
      }
    }
  }

?>
