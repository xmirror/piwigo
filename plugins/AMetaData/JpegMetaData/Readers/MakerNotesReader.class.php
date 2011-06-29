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
 * The exif tag 0x927C "MakerNote" is a tag used by the camera maker to manage
 * their own data.
 *
 * In most of case, this tags gives an offset to an extra data block.
 * And in most of case, this data block is a sub-IFD block
 *
 * The MakerNotesReader is a generic class dedicated to read tags from the maker
 * note sub IFD structure
 *
 *
 * ======> See IfdReader.class.php to know more about an IFD structure <========
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * The MakerNotesReader class is derived from the IfdReader class.
 *
 * ========> See IfdReader.class.php to know more about common methods <========
 *
 *
 * Derived classes :
 *  - PentaxReader (for Pentax exif tags)
 *
 *
 * This class provides theses public functions :
 *  - getMaker
 *
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/ConvertData.class.php");
  require_once(JPEG_METADATA_DIR."Common/MakerNotesSignatures.class.php");
  require_once(JPEG_METADATA_DIR."Common/Tag.class.php");
  require_once(JPEG_METADATA_DIR."Readers/IfdReader.class.php");

  abstract class MakerNotesReader extends IfdReader
  {
    protected $maker = "UNKNOWN";

    function __destruct()
    {
      unset($this->maker);
      parent::__destruct();
    }

    /**
     * this function return the name of the camera maker
     *
     * @return String
     */
    public function getMaker()
    {
      return($this->maker);
    }

    protected function skipHeader($headerSize=0)
    {
      parent::skipHeader($headerSize);
    }

  }




?>
