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
 * This file is used to test the capabilities of the JpegMetaData classes
 *
 * -----------------------------------------------------------------------------
 *
 *
 * -----------------------------------------------------------------------------
 */

 ini_set('error_reporting', E_ALL | E_STRICT);
 ini_set('display_errors', true);

  require_once("./../JpegMetaData.class.php");
  require_once(JPEG_METADATA_DIR."Readers/JpegReader.class.php");
  require_once(JPEG_METADATA_DIR."Common/XmlData.class.php");
  require_once(JPEG_METADATA_DIR."Common/L10n.class.php");

  require_once(JPEG_METADATA_DIR."TagDefinitions/IfdTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/PentaxTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/GpsTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/XmpTags.class.php");


  /*
   * functions
   *
   */

  function dump_xml($xml)
  {
    $returned="";

    $color=Array(
     0 => "000000",
     1 => "ff0000",
     2 => "0000ff",
     3 => "008000",
     4 => "800000",
     5 => "000080",
     6 => "008080",
     7 => "808000",
     8 => "800080",
     9 => "808080",
     10 => "6080F0",
     11 => "F06080",
     12 => "80F060",
     13 => "8080FF",
     14 => "80FF80",
     15 => "FF8080" );

    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, $xml, $values, $tags);
    xml_parser_free($parser);

    foreach($values as $key => $val)
    {
      switch($val['type'])
      {
        case "open":
          $returned.="<span style='color:#".$color[$val['level']]."'>(".$val['level'].")".str_repeat("&nbsp;", 3*$val['level'])."".$val['tag']."</span>";
          if(array_key_exists("attributes", $val))
            foreach($val['attributes'] as $key2 => $val2)
            {
              $returned.="<br><span style='color:#".$color[$val['level']]."'>".str_repeat("&nbsp;", 5+3*$val['level'])."<i>[".$key2."] ".$val2."</i></span>";
            }
          break;
        case "close":
          $returned.="<span style='color:#".$color[$val['level']]."'>(".$val['level'].")".str_repeat("&nbsp;", 3*$val['level'])."/".$val['tag']."</span>";
          if(array_key_exists("attributes", $val))
            foreach($val['attributes'] as $key2 => $val2)
            {
              $returned.="<br><span style='color:#".$color[$val['level']]."'>".str_repeat("&nbsp;", 5+3*$val['level'])."<i>[".$key2."] ".$val2."</i></span>";
            }
          break;
        case "complete":
          $returned.="<span style='color:#".$color[$val['level']]."'>(".$val['level'].")".str_repeat("&nbsp;", 3*$val['level'])."/".$val['tag']."</span>";
          if(array_key_exists("attributes", $val))
            foreach($val['attributes'] as $key2 => $val2)
            {
              $returned.="<br><span style='color:#".$color[$val['level']]."'>".str_repeat("&nbsp;", 5+3*$val['level'])."<i>[".$key2."] ".$val2."</i></span>";
            }
          break;
      }
      if(array_key_exists('value', $val))
       $returned.=" <span style='color:#ff00ff;'>".$val['value']."</span>";
      $returned.="<br>";

    }

    return($returned);
  }


  function dump_ifd($key2, $val2)
  {
    $returned=sprintf("IFD %02d: ", $key2).$val2->toString()."<br>";

    foreach($val2->getTags() as $key3 => $val3)
    {
      if($val3 instanceof Tag)
      {
        $tmpTag=$val3;
      }
      else
      {
        $tmpTag=$val3->getTag();
      }

      $returned.=dump_tag($key3, $tmpTag, "<span style='color:#804080;'>".sprintf("[%02d] ", $key3).$val3->toString()."</span><br>");

      if($tmpTag->getLabel() instanceof IfdReader)
      {
        $returned.="<div style='padding:1px;margin-bottom:2px;margin-right:4px;margin-left:25px;border:1px dotted #6060FF;'>";
        $returned.=dump_ifd($key3, $tmpTag->getLabel());
        $returned.="</div>";
      }
    }
    return($returned);
  }


  function dump_xmp($key2, $val2)
  {
    if(is_string($val2->getValue()))
      $extra=$val2->getValue();
    elseif(is_array($val2->getValue()))
      $extra=print_r($val2->getValue(), true);
    else
      $extra=ConvertData::toHexDump($val2->getValue(), ByteType::ASCII);

    $extra="<br><span style='color:#000000;'>".$extra."</span><br>";

    $returned="<div style='color:#000000;margin-left:12px;border-bottom:1px solid #808080;";
    if(!$val2->isKnown())
    {
      $returned.="background:#ffd0d0;'>";
    }
    elseif(!$val2->isImplemented())
    {
      $returned.="background:#ffffd0;'>";
    }
    else
    {
      $returned.="background:#d0ffd0;'>";
      $extra="";
    }

    $returned.="<span style='color:#804080;'>".$val2->toString().$extra."</span></div>";

    return($returned);
  }


  function dump_tag($key3, $val3, $extra)
  {
    $returned="<div style='color:#000000;margin-left:12px;border-bottom:1px solid #808080;";
    if(!$val3->isKnown())
    {
      $returned.="background:#ffd0d0;'>".$extra;
    }
    elseif(!$val3->isImplemented())
    {
      $returned.="background:#ffffd0;'>".$extra;
    }
    else
    {
      $returned.="background:#d0ffd0;'>";
    }

    $returned.=str_replace(" ", "&nbsp;", "     ").$val3->toString("small")."<br></div>";

    return($returned);
  }

  L10n::setLanguage("fr_FR");


  $page="<html><header><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></header><body>";


  $page.="<hr>-- Images --<br>";

  /*
   * display a list of jpeg files in the current directory
   */
  $directory = scandir(dirname(__FILE__));

  foreach($directory as $key => $file)
  {
    if(preg_match("/.*\.(jpg|jpeg)/i",$file))
      $page.="[<a href='?file=".$file."'>$file</a>]&nbsp; ";
  }


  $page.="<hr>-- Resultat --<br>";


  if(isset($_GET["file"]))
  {
    $file=$_GET["file"];
  }
  else
  {
    $page.="no filename ?<br/></body></html>";
    die($page);
  }

  $page.="<span style='font-family:monospace;'>";

  $jpeg = new JpegReader($file, Array('filter' => JpegMetaData::TAGFILTER_ALL, 'xmp' => false, 'maker' => false, 'iptc' => false, 'exif' => false));

  $page2="JpegReader extraction<br>";
  $page2.="fileName=".$jpeg->getFileName()."<br>";
  $page2.="isValid=".($jpeg->isValid()?"Y":"N")."<br>";
  $page2.="isLoaded=".($jpeg->isLoaded()?"Y":"N")."<br>";
  $page2.="NbMarkers=".$jpeg->countAppMarkerSegments()."<br>";

  foreach($jpeg->getAppMarkerSegments() as $key => $val)
  {
    $page2.="<div style='border:1px solid #000000;padding:4px;margin:1px;'>";
    $page2.=sprintf("[%02d] ", $key).$val->toString()."<br>";
    if($val->dataLoaded())
    {
      $page2.="<div style='color:#0000ff;font-weight:bold;margin-left:20px;'>";
      $data=$val->getData();
      if($data instanceof TiffReader)
      {
        $page2.=$data->toString()."<br>";

        foreach($data->getIFDs() as $key2 => $val2)
        {
          $page2.="<div style='color:#0000ff;font-weight:normal;margin-left:12px;'>";
          $page2.=dump_ifd($key2, $val2);
          $page2.="</div>";
        }
      }
      elseif($data instanceof XmpReader)
      {
        $page2.=htmlentities($data->toString())."<br>";
        $page2.=dump_xml($data->toString())."<br>";

        foreach($data->getTags() as $key2 => $val2)
        {
          $page2.="<div style='color:#0000ff;font-weight:normal;margin-left:12px;'>";
          $page2.=dump_xmp($key2, $val2);
          $page2.="</div>";
        }
      }
      elseif($data instanceof IptcReader)
      {
        $data->optimizeDateTime();
        foreach($data->getTags() as $key2 => $val2)
        {
          $page2.="<div style='color:#0000ff;font-weight:normal;margin-left:12px;'>";
          $page2.=dump_tag($key2, $val2, "");
          $page2.="</div>";
        }
      }
      elseif($data instanceof ComReader)
      {
        foreach($data->getTags() as $key2 => $val2)
        {
          $page2.="<div style='color:#0000ff;font-weight:normal;margin-left:12px;'>";
          $page2.=dump_tag($key2, $val2, "");
          $page2.="</div>";
        }
      }
      elseif(is_array($data))
      {
        $page2.=print_r($val->getData(), true)."<br>";
      }
      else
      {
       $page2.=htmlentities($val->getData())."<br>";
      }
      $page2.="</div>";
    }
    $page2.="</div>";
  }
  $page2.="</span><hr>";
  unset($jpeg);

  $page2.="<div style='font-family:monospace;'>JpegMetaData - tag from test file<br>";
  $page2.="<table style='border:1px solid #000000;width:100%;'>";
  $page2.="<tr style='border-bottom:1x solid #000000;'><th>Schema</th><th>Key</th><th>Name</th><th>Value</th><th>Computed Value</th></tr>";


  $time=microtime(true);
  $jpegmd = new JpegMetaData($file,
                              Array(
                                'filter' => JpegMetaData::TAGFILTER_IMPLEMENTED,
                                'xmp' => true,
                                'maker' => true,
                                'iptc' => true,
                                'magic' => true,
                                'exif' => true,
                                'optimizeIptcDateTime' => true
                              )
                            );
  $time2=microtime(true);

  $i=0;
  foreach($jpegmd->getTags() as $key => $val)
  {
    $txt=$val->getLabel();
    $value=$val->getValue();

    if($val->isTranslatable())
      $style="color:#0000ff";
    else
      $style="color:#000000";

    if(is_string($txt) and $val->isTranslatable())
      $txt=L10n::get($txt);
    if($txt instanceof DateTime)
      $txt=$txt->format("Y-m-d H:i:s");
    if(is_array($txt))
      $txt=print_r($txt, true);
    if(is_array($value))
      $value=print_r($value, true);
    $page2.="<tr><td>".$val->getSchema()."</td><td>".$key."</td><td>".L10n::get($val->getName())."</td><td>".$value."</td><td style='$style'>".$txt."</td></tr>";
    $i++;
  }
  $page2.="</table>Total tags: $i</div><hr>";

  $i=0;
  $j=0;
  $page2.="<div style='font-family:monospace;'>JpegMetaData - known tags<br>";
  $page2.="<table style='border:1px solid #000000;width:100%;'>";
  $page2.="<tr style='border-bottom:1x solid #000000;'><th>Key</th><th>Name</th><th>Implemented</th></tr>";
  foreach(JpegMetaData::getTagList(
                                    Array(
                                      'filter' => JpegMetaData::TAGFILTER_ALL,
                                      'xmp' => true,
                                      'maker' => true,
                                      'iptc' => true,
                                      'magic' => true,
                                      'exif' => true,
                                    )
                                  ) as $key => $val)
  {
    $val['implemented']?$i++:$j++;
    $page2.="<tr><td>".$key."</td><td>".L10n::get($val['name'])."</td><td>".($val['implemented']?"yes":"no")."</td></tr>";
  }
  $page2.="</table>Total tags ; implemented: $i - not implemented: $j</span><hr>";

  unset($jpegmd);

  $memory=memory_get_usage();
  $jpegmd = new JpegMetaData($file, Array(
    'filter' => JpegMetaData::TAGFILTER_IMPLEMENTED,
    'optimizeIptcDateTime' => true)
  );
  unset($jpegmd);
  $memory2=memory_get_usage();

  $page.="parsing time : ".($time2-$time)."<br>";
  $page.="memory on start : ".$memory."<br>";
  $page.="memory on end : ".$memory2." (memory leak ? = ".($memory2-$memory).")<br>";

  $page.=$page2;
  $page.="<br/></body></html>";

  echo $page;
  unset($page2);
  unset($page);
?>
