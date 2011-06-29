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
 * Used to stock some var we want to be accessed over all the metadata parsing
 * process
 *
 * Using a class prevent to declare "global" variables
 * Using a class allows to use methods rather than a direct access to the variable
 * calling a static function from an object is more understandable in the code
 * than affect a valu to an unknown global var
 *
 * This class provides theses public functions :
 *  - (static) setExifMaker
 *  - (static) getExifMaker
 *  - (static) setFocal
 *  - (static) setAperture
 *
 * -----------------------------------------------------------------------------
 */


  Class GlobalTags
  {
    static private $exifMaker = "";
    static private $exifFocal = "";
    static private $exifAperture = "";

    /**
     * this function is used by IFD Reader to store all information about maker
     * and camera model
     *
     * the stored value if used within a grep like "/canon/i" to determine the
     * maker note.
     * For more information about this tricks see the how the tag 0x927c is
     * managed in the function "processSpecialTag" of the file
     * IfdReader.class.php
     *
     * @param String $value : the maker or the camera model
     */
    static public function setExifMaker($value)
    {
      if(is_array($value))
      {
        foreach($value as $val)
        {
          self::$exifMaker.=$val." ";
        }
      }
      else
      {
        self::$exifMaker.=$value." ";
      }
      return(self::$exifMaker);
    }

    /**
     * this function is used by IFD Reader to store all information about maker
     * and camera model
     *
     * @return String
     */
    static public function getExifMaker()
    {
      return(self::$exifMaker);
    }


    /**
     * this function is used by IFD Reader to store information about the focal
     * used to shoot
     *
     * the stored value if used within the pentax reader, to know the lens used
     * with the camera (if lens Id returns more than one lens)
     *
     * For more information about this tricks see the how the tag 0x003f is
     * managed in the function "processSpecialTag" of the file
     * PentaxReader.class.php
     *
     * @param String $value : the focal
     */
    static public function setExifFocal($value)
    {
      self::$exifFocal=$value;
      return(self::$exifFocal);
    }

    /**
     * this function is used by Pentax Reader to know the focal value used to
     * shoot
     *
     * @return String
     */
    static public function getExifFocal()
    {
      return(self::$exifFocal);
    }


    /**
     * this function is used by IFD Reader to store information about the
     * aperture used to shoot
     *
     * the stored value if used within the pentax reader, to know the lens used
     * with the camera (if lens Id returns more than one lens)
     *
     * For more information about this tricks see the how the tag 0x003f is
     * managed in the function "processSpecialTag" of the file
     * PentaxReader.class.php
     *
     * @param String $value : the aperture
     */
    static public function setExifAperture($value)
    {
      self::$exifAperture=$value;
      return(self::$exifAperture);
    }

    /**
     * this function is used by Pentax Reader to know the aperture value used to
     * shoot
     *
     * @return String
     */
    static public function getExifAperture()
    {
      return(self::$exifAperture);
    }

  }

  ?>
