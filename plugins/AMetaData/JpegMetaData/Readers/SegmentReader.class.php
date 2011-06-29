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
 * The SegmentReader is a generic class providing methods to manage datas
 * segments
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * This class is not declared as an abstract class, but it's not recommanded to
 * create object with it.
 *
 *
 * Derived classes :
 *  - TiffReader        (for Tiff data block)
 *
 * This class provides theses public functions :
 *  - getIsValid
 *  - getIsLoaded
 *
 * -----------------------------------------------------------------------------
 */

  class SegmentReader
  {
    protected $data = null;
    protected $isValid = false;
    protected $isLoaded = false;

    /**
     * The constructor need the segment's datas
     *
     * @param Data $data : a Data object
     */
    function __construct(Data $data)
    {
      $this->data = $data;
      $this->data->seek();
    }

    function __destruct()
    {
      unset($this->data);
      unset($this->isValid);
      unset($this->isLoaded);
    }

    /**
     * return true if the segment is valid
     *
     * @return Boolean
     */
    public function getIsValid()
    {
      return($this->isValid);
    }

    /**
     * return true if the segment is loaded
     *
     * @return Boolean
     */
    public function getIsLoaded()
    {
      return($this->isLoaded);
    }

    public function toString()
    {
      $returned="";
      return($returned);
    }

  }


?>
