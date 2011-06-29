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
 * Define the maker notes signatures for the EXIF "MakerNote" tag
 *
 * This class provides theses public functions :
 *  - (static) getMaker
 *
 * -----------------------------------------------------------------------------
 */

  define("MAKER_PENTAX", "Pentax");
  define("MAKER_NIKON", "Nikon");
  define("MAKER_CANON", "Canon");

  Class MakerNotesSignatures
  {
    /** Olympus signature */
    const OlympusHeader =  "OLYMP\x00\x01\x00";
    /** Olympus 2 signature */
    const Olympus2Header = "OLYMPUS\x00II\x03\x00";
    /** FujiFilm signature */
    const FujiFilmHeader = "FUJIFILM\x0c\x00\x00\x00";
    /** Nikon 2 signature */
    const Nikon2Header = "Nikon\x00\x01\x00";
    /** Nikon 3 signature */
    const Nikon3Header = "Nikon\x00\x02";
    /** Panasonic signature  */
    const PanasonicHeader = "Panasonic\x00\x00\x00";
    /** Pentax MM signature  */
    const PentaxHeader = "AOC\x00MM";
    /** Pentax II signature  */
    const Pentax2Header = "AOC\x00II";
    /** Sigma signature */
    const SigmaHeader = "SIGMA\x00\x00\x00\x01\x00";
    /** Sigma signature */
    const Sigma2Header = "FOVEON\x00\x00\x01\x00";
    /** Sony signature */
    const SonyHeader = "SONY DSC \x00\x00\x00";
    /** Canon signature => no signature in the maker note field ! */
    const CanonHeader = "";
    /** Unknown signature => no signature in the maker note field ! */
    const UnknownHeader = "";


    const OlympusHeaderSize   = 8;
    const Olympus2HeaderSize  = 12;
    const FujiFilmHeaderSize  = 12;
    const Nikon2HeaderSize    = 8;
    const Nikon3HeaderSize    = 7;
    const PanasonicHeaderSize = 12;
    const PentaxHeaderSize    = 6;
    const Pentax2HeaderSize   = 6;
    const SigmaHeaderSize     = 8;
    const Sigma2HeaderSize    = 8;
    const SonyHeaderSize      = 12;
    const CanonHeaderSize     = 0;
    const UnknownHeaderSize   = 0;


    static public function getMaker($datas)
    {
      if(strlen($datas) >= self::OlympusHeaderSize and substr_compare($datas, self::OlympusHeader, 0, self::OlympusHeaderSize)===0)
       { return(self::OlympusHeader); }
      elseif(strlen($datas) >= self::Olympus2HeaderSize and substr_compare($datas, self::Olympus2Header, 0, self::Olympus2HeaderSize)===0)
       { return(self::Olympus2Header); }
      elseif(strlen($datas) >= self::FujiFilmHeaderSize and substr_compare($datas, self::FujiFilmHeader, 0, self::FujiFilmHeaderSize)===0)
       { return(self::FujiFilmHeader); }
      elseif(strlen($datas) >= self::Nikon2HeaderSize and substr_compare($datas, self::Nikon2Header, 0, self::Nikon2HeaderSize)===0)
       { return(self::Nikon2Header); }
      elseif(strlen($datas) >= self::Nikon3HeaderSize and substr_compare($datas, self::Nikon3Header, 0, self::Nikon3HeaderSize)===0)
       { return(self::Nikon3Header); }
      elseif(strlen($datas) >= self::PanasonicHeaderSize and substr_compare($datas, self::PanasonicHeader, 0, self::PanasonicHeaderSize)===0)
       { return(self::PanasonicHeader); }
      elseif(strlen($datas) >= self::PentaxHeaderSize and substr_compare($datas, self::PentaxHeader, 0, self::PentaxHeaderSize)===0)
       { return(self::PentaxHeader); }
      elseif(strlen($datas) >= self::Pentax2HeaderSize and substr_compare($datas, self::Pentax2Header, 0, self::Pentax2HeaderSize)===0)
       { return(self::Pentax2Header); }
      elseif(strlen($datas) >= self::SigmaHeaderSize and substr_compare($datas, self::SigmaHeader, 0, self::SigmaHeaderSize)===0)
       { return(self::SigmaHeader); }
      elseif(strlen($datas) >= self::Sigma2HeaderSize and substr_compare($datas, self::Sigma2Header, 0, self::Sigma2HeaderSize)===0)
       { return(self::Sigma2Header); }
      elseif(strlen($datas) >= self::SonyHeaderSize and substr_compare($datas, self::SonyHeader, 0, self::SonyHeaderSize)===0)
       { return(self::SonyHeader); }
      else
       { return(self::UnknownHeader); }
    }

  }

  ?>
