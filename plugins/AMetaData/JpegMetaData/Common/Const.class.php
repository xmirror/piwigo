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
 * Constants used by the JpegMetaData classes
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * Float and Double type are not implemented yet
 *
 * -----------------------------------------------------------------------------
 */

  /**
   * define the value for the LITTLE ENDIAN (Intel) byte order
   */
  define("BYTE_ORDER_LITTLE_ENDIAN", "II");

  /**
   * define the value for the BIG ENDIAN (Motorola) byte order
   */
  define("BYTE_ORDER_BIG_ENDIAN", "MM");


  /**
   * in IFDs entries, the data type is given by a byte
   * theses constants associate a human readable value
   */
  class ByteType
  {
    /**
     * unknown type
     */
    const UNKNOWN    = 0x00;
    /**
     * 8bit
     * Unsigned integer values from 0 to 255
     */
    const UBYTE      = 0x01;
    /**
     * ASCII String
     */
    const ASCII      = 0x02;
    /**
     * 16bit
     * Unsigned integer values from 0 to 65535
     */
    const USHORT     = 0x03;
    /**
     * 32bit
     * Unsigned integer values from 0 to 4294967295
     */
    const ULONG      = 0x04;
    /**
     * 2x32bit
     * Unsigned rational number consist of two unsigned 32-bit integers
     * denoting the enumerator and denominator.
     * Each integer have values from 0 and 4294967295
     */
    const URATIONAL  = 0x05;
    /**
     * 8bit
     * Signed integer values from -128 to 127
     */
    const SBYTE      = 0x06;
    /**
     * 8bit
     * Each component will be a byte with no associated interpretation
     */
    const UNDEFINED  = 0x07;
    /**
     * 16bit
     * Signed integer values from -32768 to 32767
     */
    const SSHORT     = 0x08;
    /**
     * 32bit
     * Signed integer values from -2147483648 to 2147483647
     */
    const SLONG      = 0x09;
    /**
     * 2x32bit
     * Signed rational number consist of two signed 32-bit integers
     * denoting the enumerator and denominator.
     * Each integer have values from -2147483648 to 2147483647
     */
    const SRATIONAL  = 0x0A;
    const FLOAT      = 0x0B;
    const DOUBLE     = 0x0C;

    /**
     * this array gives the byte size of each kind of data
     */
    public static $typeSizes =
    Array(
      self::UNKNOWN   => 0,
      self::UBYTE     => 1,
      self::ASCII     => 1,
      self::USHORT    => 2,
      self::ULONG     => 4,
      self::URATIONAL => 8,
      self::SBYTE     => 1,
      self::UNDEFINED => 1,
      self::SSHORT    => 2,
      self::SLONG     => 4,
      self::SRATIONAL => 8,
      self::FLOAT     => 0,
      self::DOUBLE    => 0
    );
  }

  class Schemas {
    const EXIF  = "exif";
    const IPTC  = "iptc";
    const XMP   = "xmp";
    const MAGIC = "magic";
    const COM   = "com";

    const EXIF_TIFF = "exif.tiff";
    const EXIF_EXIF = "exif.exif";
    const EXIF_GPS  = "exif.gps";
    const EXIF_MAKER  = "exif.maker";
  }

?>
