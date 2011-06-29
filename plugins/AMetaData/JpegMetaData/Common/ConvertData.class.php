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
 * ConvertData class is used to convert data from a type into another type
 *
 * This class provides theses public functions :
 *  - (static) toUByte
 *  - (static) toSByte
 *  - (static) toUShort
 *  - (static) toSShort
 *  - (static) toULong
 *  - (static) toSLong
 *  - (static) toURational
 *  - (static) toSRational
 *  - (static) toExposureTime
 *  - (static) toFNumber
 *  - (static) toDateTime
 *  - (static) toFocalLength
 *  - (static) toEV
 *  - (static) toDistance
 *  - (static) toStrings
 *  - (static) toDMS
 *  - (static) toHexDump
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Const.class.php");

  class ConvertData
  {
    /**
     * Convert the given data into a single unsigned Byte (8bit)
     *
     * @param String $data : representing the unsigned Byte
     * @return UByte
     */
    static public function toUByte($data)
    {
      if(strlen($data)>=1)
        return(ord($data{0}));
      else
        return(0);
    }

    /**
     * Convert the given data into a single signed Byte (8bit)
     *
     * @param String $data : representing the signed Byte
     * @return SByte
     */
    static public function toSByte($data)
    {
      $unsigned = self::toUByte($data);
      if($unsigned>127)
        return($unsigned-256);
      else
        return($unsigned);
    }

    /**
     * Convert the given data into an unsigned Short integer (16bit)
     *
     * @param String $data       : representing the unsigned Short
     * @param String $endianType : the byte order
     * @return UShort
     */
    static public function toUShort($data, $endianType)
    {
      if(strlen($data)>=2)
      {
        if($endianType==BYTE_ORDER_LITTLE_ENDIAN)
          return(ord($data{0}) +
                 ord($data{1})*256);
        else
          return(ord($data{0})*256 +
                 ord($data{1}));
      }
      else
      {
        return(0);
      }
    }

    /**
     * Convert the given data into a signed Short integer (16bit)
     *
     * @param String $data       : representing the signed Short
     * @param String $endianType : the byte order
     * @return SShort
     */
    static public function toSShort($data, $endianType)
    {
      $unsigned = self::toUShort($data, $endianType);
      if($unsigned>32767)
        return($unsigned-65536);
      else
        return($unsigned);
    }

    /**
     * Convert the given data into an unsigned Long integer (32bit)
     *
     * @param String $data       : representing the unsigned Long
     * @param String $endianType : the byte order
     * @return ULong
     */
    static public function toULong($data, $endianType)
    {
      if(strlen($data)>=4)
      {
        if($endianType==BYTE_ORDER_LITTLE_ENDIAN)
          return(ord($data{0}) +
                 ord($data{1})*256 +
                 ord($data{2})*65536 +
                 ord($data{3})*16777216);
        else
          return(ord($data{0})*16777216 +
                 ord($data{1})*65536 +
                 ord($data{2})*256 +
                 ord($data{3}));
      }
      else
      {
        return(0);
      }
    }

    /**
     * Convert the given data into a signed Long integer (32bit)
     *
     * @param String $data       : representing the signed Long
     * @param String $endianType : the byte order
     * @return SLong
     */
    static public function toSLong($data, $endianType)
    {
      $unsigned = self::toULong($data, $endianType);
      if($unsigned>2147483647)
        return($unsigned-4294967296);
      else
        return($unsigned);
    }

    /**
     * Convert the given data into an array of unsigned Long (2x32bit)
     *
     * @param String $data       : representing the unsigned Rational
     * @param String $endianType : the byte order
     * @return URational
     */
    static public function toURational($data, $endianType)
    {
      if(strlen($data)>=8)
      {
        return(
          Array(
            self::toULong($data, $endianType),
            self::toULong(substr($data, 4), $endianType)
          )
        );
      }
      else
      {
        return(Array(0,0));
      }
    }

    /**
     * Convert the given data into an array of signed Long (2x32bit)
     *
     * @param String $data       : representing the signed Rational
     * @param String $endianType : the byte order
     * @return SRational
     */
    static public function toSRational($data, $endianType)
    {
      if(strlen($data)>=8)
      {
        return(
          Array(
            self::toSLong($data, $endianType),
            self::toSLong(substr($data, 4), $endianType)
          )
        );
      }
      else
      {
        return(Array(0,0));
      }
    }

    /**
     * Convert a floating value exprimed in seconds into a "photographic"
     * value
     *
     * example :
     *  1.5   => "1.5s"
     *  0.004 => "1/250s"     *
     *
     * @param Float $time : time to convert
     * @return String
     */
    static public function toExposureTime($time)
    {
      if($time>=1 or $time==0)
      {
        return($time."s");
      }
      else
      {
        return(sprintf("1/%ds", 1/$time));
      }
    }

    /**
     * Convert a floating value in a f/x.y string
     *
     * example :
     *  1.8 => "f/1.8"
     *  8   => "f/8.0"
     *
     * @param Float $fNumber : fnumber
     * @return String
     */
    static public function toFNumber($fNumber)
    {
      return(sprintf("f/%.1f", $fNumber));
    }

    /**
     * Convert a string Date/Time into a DateTime object
     *
     * Example of valid string :
     *  "2009:12:24 19:54"
     *  "2009:12:24 19:54\x00"
     *  "2009:12:24 19:54:38"
     *  "2009:12:24 19:54:38\x00"
     *  "2009-12-24 19:54"
     *  "2009-12-24T19:54"
     *  "2009-12-24 19:54:38"
     *  "2009-12-24T19:54:38"
     *  "2009-12-24 19:54Z"
     *  "2009-12-24T19:54Z"
     *  "2009-12-24 19:54:38Z"
     *  "2009-12-24T19:54:38Z"
     *  "2009-12-24 19:54+02:00"
     *  "2009-12-24T19:54+02:00"
     *  "2009-12-24 19:54:38+02:00"
     *  "2009-12-24T19:54:38+02:00"
     *  "20091224"
     *
     * returns null if date is not a valid date
     *
     * @param String $dateTime : date time in a valid format
     * @return String
     */
    static public function toDateTime($dateTime)
    {
      if(preg_match('/^('.
           '\d{4}:\d{2}:\d{2}\s\d{2}:\d{2}(:\d{2}){0,1}\x00{0,1}|'.
           '\d{4}-\d{2}-\d{2}(T|\s)\d{2}:\d{2}(:\d{2}){0,1}(Z|[+|-]\d{2}:\d{2}){0,1}|'.
           '\d{4}\d{2}\d{2}'.
           ')$/', $dateTime))
      {
        $returned=new DateTime($dateTime, new DateTimeZone("UTC"));
      }
      else
      {
        $returned=null;
      }
      return($returned);
    }

    /**
     * Convert a floating value in a focal length string
     *
     * Example:
     *  250 => "250.0mm"
     *
     * @param Float $focalLength : focal length in millimeters
     * @return String
     */
    static public function toFocalLength($focalLength)
    {
      return(sprintf("%.1f mm", $focalLength));
    }

    /**
     * Convert a floating value in an EV
     *
     * Example:
     *  0.7 => "0.7 EV"
     *
     * @param Float $ev : EV
     * @return String
     */
    static public function toEV($ev)
    {
      return(sprintf("%.1f EV", $ev));
    }

    /**
     * Convert a floating value associated with a unit
     *
     * Example :
     *  3.4 + "m" => "3.40 m"
     *
     * @param Float $distance : distance
     * @param String $unit    : unit
     * @return String
     */
    static public function toDistance($distance, $unit)
    {
      return(sprintf("%.2f ", $distance)).$unit;
    }

    /**
     * Convert a null terminated string into a string
     * or
     * Convert multiples null terminated string into an array of string
     *    ==> if strings are null (eq. "\x00") nothing is added to the array
     *
     * Example:
     *  "test" => "test"
     *  "test\x00" => "test"
     *  "test1\x00test2\x00" => Array("test1", "test2")
     *
     * @param String $strings
     * @return String or String[]
     */
    static public function toStrings($strings)
    {
      if(strpos($strings, chr(0))===false)
        return($strings);

      $occurs=preg_match_all('/(.*)\x00/U',$strings,$result);
      if($occurs==0)
      {
        return("");
      }
      else
      {
        $returned=Array();
        foreach($result[1] as $pop)
        {
          if($pop!="")
          {
            $returned[]=$pop;
          }
        }
        if(count($returned)==1)
        {
          return($returned[0]);
        }
        elseif(count($returned)==0)
        {
          return("");
        }
        else
        {
          return($returned);
        }
      }
    }

    /**
     * Convert 3 rationnals (EXIF GPS format) into a Degree, Minute, Second into
     * a formatted string   dd° mm' ss.cs"
     *
     * Example:
     *  48/1 + 1600/100 + 347/10 => "48° 16' 34.70""
     *
     * @param URational $degrees : degrees
     * @param URational $minutes : minutes
     * @param URational $seconds : seconds
     * @return String
     */
    static public function toDMS($degrees, $minutes, $seconds)
    {
      if($degrees[1]==0) $degrees[1]=1;
      if($minutes[1]==0) $minutes[1]=1;
      if($seconds[1]==0) $seconds[1]=1;

      $deg=$degrees[0]/$degrees[1];
      $min=($minutes[0]/$minutes[1])-((int)$deg-$deg)*60;
      $sec=($seconds[0]/$seconds[1])-((int)$min-$min)*60;

      $returned=sprintf("%d° %d' %.2f\"", $deg, $min, $sec);

      return($returned);
    }


    /**
     * Dump the given data into an hex string
     *
     * @param $data            : data to be dumped (the dump is function of the
     *                           data type)
     * @param UByte $type      : the type of data (uses the ByteType values)
     * @param UShort $maxItems : for arrays (or ASCII string), the number or
     *                           items (chars) to dump
     * @return String
     */
    static public function toHexDump($data, $type, $maxItems = 0)
    {
      $returned="";
      if(is_array($data))
      {
        if($maxItems==0)
        {
          $maxItems=count($data);
        }
        elseif($maxItems>count($data))
        {
          $maxItems=count($data);
        }
        else
        {
          $returned.="[returns only the first $maxItems of ".count($data)." values] ";
        }

        $tmp=Array();
        for($i=0;$i<$maxItems;$i++)
        {
          $tmp[]=self::toHexDump($data[$i], $type, $maxItems);
        }
        $returned.="[".implode(",", $tmp)."]";
      }
      else
      {
        switch($type)
        {
          case ByteType::UBYTE :
          case ByteType::SBYTE :
            $returned.=sprintf("0x%02x", $data);
            break;
          case ByteType::USHORT :
          case ByteType::SSHORT :
            $returned.=sprintf("0x%04x", $data);
            break;
          case ByteType::ULONG :
          case ByteType::SLONG :
            $returned.=sprintf("0x%08x", $data);
            break;
          case ByteType::URATIONAL :
          case ByteType::SRATIONAL :
            $returned.=sprintf("0x%08x", $data);
            break;
          case ByteType::FLOAT :
          case ByteType::DOUBLE :
          case ByteType::ASCII :
          case ByteType::UNDEFINED :
          default:
            if($maxItems==0)
            {
              $maxItems=strlen($data);
            }
            elseif($maxItems>strlen($data))
            {
              $maxItems=strlen($data);
            }
            else
            {
              $returned.="[returns only the first $maxItems of ".strlen($data)." bytes] ";
            }

            $tmp=array();
            for($i=0;$i<$maxItems;$i++)
            {
              $tmp[]=sprintf("%02x", ord($data{$i}));
            }
            $returned.=implode(" ", $tmp);
            break;
        }
      }
      return($returned);
    }


  }


?>
