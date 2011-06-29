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
 * This file is used to prepare the .po file
 *
 * Method : the script parse all JpegMetaData/TagDefinition and select all the
 *          implemented tags
 *
 * Options :
 *  * file type : can make a .po file for translatable metadata values or can
 *                make a .po file for metadata description
 *  * compare   : can compare the generated .po file with an existing .po file
 *                only all new/deleted keys are listed
 *  * save      : can save the result in a .po file
 *
 * -----------------------------------------------------------------------------
 *
 *
 * -----------------------------------------------------------------------------
 */

 ini_set('error_reporting', E_ALL | E_STRICT);
 ini_set('display_errors', true);
 date_default_timezone_set('UTC');

  require_once("./../JpegMetaData.class.php");
  require_once(JPEG_METADATA_DIR."Readers/JpegReader.class.php");
  require_once(JPEG_METADATA_DIR."Common/XmlData.class.php");
  require_once(JPEG_METADATA_DIR."Common/L10n.class.php");

  require_once(JPEG_METADATA_DIR."TagDefinitions/IfdTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/PentaxTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/NikonTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/CanonTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/GpsTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/XmpTags.class.php");


  $hardCoded=Array(
    "Yes",
    "No",
    "Contrast",
    "Sharpness",
    "Saturation",
    "No extended bracketing",
    "Custom",
    "not yet implemented",
  );

  function cmp($a, $b)
  {
    if(strtolower($a['value']) == strtolower($b['value']))
    {
      if($a['value']==$b['value'])
      {
        return(0);
      }
      return(($a['value'] < $b['value'])?-1:1);
    }
    return((strtolower($a['value']) < strtolower($b['value']))?-1:1);
  }

  function loadPoFile($fileName)
  {
    $returnedKeys=Array();
    if(file_exists($fileName))
    {
      $fHandler=fopen($fileName, "r");
      if($fHandler)
      {
        $fileContent=fread($fHandler, filesize($fileName));
        fclose($fHandler);

        $pattern='/\s*msgid\s*"(.*)"\s*\n/im';
        $result=Array();

        preg_match_all($pattern, $fileContent, $result);

        $returnedKeys=array_flip($result[1]);
      }
    }
    return($returnedKeys);
  }

  function makePoValues($fileSaveName, $fileCompareName)
  {
    global $hardCoded;

    $tmpTagName=Array();
    $tmpValues=Array();

    $tagList=Array(
      new IfdTags(),
      new XmpTags(),
      new IptcTags(),
      new GpsTags(),
      new PentaxTags(),
      new CanonTags(),
      new NikonTags(),
      new MagicTags(),
    );

    foreach($tagList as $key => $tag)
    {

      foreach($tag->getTags() as $key => $val)
      {
        if(array_key_exists('tagName', $val))
          $name=$val['tagName'];
        else
          $name="";

        if(is_string($key))
          $tKey=$key;
        else
          $tKey=sprintf("0x%04x", $key);

        if($name!="")
          $tKey.=" ($name)";

        if($name!="")
        {
          $tmpTagName[]=Array('group' => "[Metadata name] ".$tag->getLabel()." / ".$tKey, 'value' => $name);
        }
        else
        {
          $tmpTagName[]=Array('group' => "[Metadata name] ".$tag->getLabel()." / ".$tKey, 'value' => $key);
        }


        if(array_key_exists('tagValues', $val) and $val['translatable'] and $val['implemented'])
        {
          foreach($val['tagValues'] as $key2 => $val2)
          {
            if(is_array($val2))
            {
              foreach($val2 as $val3)
              {
                $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val3);
              }
            }
            else
            {
              $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val2);
            }
          }
        }

        if(array_key_exists('tagValues.special', $val) and $val['translatable'])
        {
          foreach($val['tagValues.special'] as $key2 => $val2)
          {
            if(is_array($val2))
            {
              foreach($val2 as $val3)
              {
                $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val3);
              }
            }
            else
            {
              $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val2);
            }
          }
        }

        if(array_key_exists('tagValues.specialNames', $val) and $val['translatable'])
        {
          foreach($val['tagValues.specialNames'] as $key2 => $val2)
          {
            if(is_array($val2))
            {
              foreach($val2 as $val3)
              {
                $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val3);
              }
            }
            else
            {
              $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val2);
            }
          }
        }

        if(array_key_exists('tagValues.specialValues', $val) and $val['translatable'])
        {
          foreach($val['tagValues.specialValues'] as $key2 => $val2)
          {
            if(is_array($val2))
            {
              foreach($val2 as $val3)
              {
                $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val3);
              }
            }
            else
            {
              $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val2);
            }
          }
        }

        if(array_key_exists('tagValues.computed', $val) and $val['translatable'])
        {
          foreach($val['tagValues.computed'] as $key2 => $val2)
          {
            if(is_array($val2))
            {
              foreach($val2 as $val3)
              {
                $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val3);
              }
            }
            else
            {
              $tmpValues[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $val2);
            }
          }
        }

      }

    }

    $tmp=array_merge($tmpTagName, $tmpValues);
    foreach($hardCoded as $val)
    {
      $tmp[]=Array(
        'group' => "Hardcoded value",
        'value' => $val,
      );
    }
    usort($tmp, "cmp");


    $tmp2=array(
      array(
        'value' => $tmp[0]['value'],
        'group' => Array($tmp[0]['group']),
      )
    );
    $tmp2k=0;

    $nbCapitalization = 0;

    for($i=1;$i<count($tmp);$i++)
    {
      if($tmp[$i]['value']==$tmp2[$tmp2k]['value'])
      {
        $tmp2[$tmp2k]['group'][]=$tmp[$i]['group'];
      }
      else
      {
        $tmp2k++;
        $tmp2[$tmp2k]=array(
          'group' => Array( $tmp[$i]['group'] ),
          'value' => $tmp[$i]['value']
        );

        if($tmp2k>0)
          if(strtolower($tmp2[$tmp2k]['value'])==strtolower($tmp2[$tmp2k-1]['value']))
          {
            $tmp2[$tmp2k]['group'] = Array("**** PREVIOUS IS THE SAME, TAKE A LOOK ABOUT CAPITALIZATION ****", $tmp[$i]['group'] );
            $nbCapitalization++;
          }
      }
    }

    manageResult($tmp2, $fileSaveName, $fileCompareName, "");
  }


  function makePoDesc($fileSaveName, $fileCompareName)
  {
    $tmpTagName=Array();

    $tagList=Array(
      new IfdTags(),
      new XmpTags(),
      new IptcTags(),
      new GpsTags(),
      new PentaxTags(),
      new CanonTags(),
      new NikonTags(),
      new MagicTags(),
    );

    $poKeys=loadPoFile($fileCompareName);

    foreach($tagList as $key => $tag)
    {
      foreach($tag->getTags() as $key => $val)
      {
        if(array_key_exists('tagName', $val))
          $name=$val['tagName'];
        else
          $name="";

        if(is_string($key))
          $tKey=$key;
        else
          $tKey=sprintf("0x%04x", $key);

        if($name!="")
          $tKey.=" ($name)";

        if($name!="")
        {
          $tmpTagName[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $name);
        }
        else
        {
          $tmpTagName[]=Array('group' => $tag->getLabel()." / ".$tKey, 'value' => $key);
        }
      }
    }

    usort($tmpTagName, "cmp");

    $tmp2=array(
      array(
        'value' => $tmpTagName[0]['value'],
        'group' => Array($tmpTagName[0]['group']),
      )
    );
    $tmp2k=0;

    $nbCapitalization = 0;

    for($i=1;$i<count($tmpTagName);$i++)
    {
      if($tmpTagName[$i]['value']==$tmp2[$tmp2k]['value'])
      {
        $tmp2[$tmp2k]['group'][]=$tmpTagName[$i]['group'];
      }
      else
      {
        $tmp2k++;
        $tmp2[$tmp2k]=array(
          'group' => Array( $tmpTagName[$i]['group'] ),
          'value' => $tmpTagName[$i]['value']
        );

        if($tmp2k>0)
          if(strtolower($tmp2[$tmp2k]['value'])==strtolower($tmp2[$tmp2k-1]['value']))
          {
            $tmp2[$tmp2k]['group'] = Array("**** PREVIOUS IS THE SAME, TAKE A LOOK ABOUT CAPITALIZATION ****", $tmpTagName[$i]['group'] );
            $nbCapitalization++;
          }
      }
    }

    manageResult($tmp2, $fileSaveName, $fileCompareName, "There is no description available for this metadata");

  }

  function isAllowed($value)
  {
    $returned=true;

    if(preg_match('/^[\d]{1,5}x[\d]{1,5}$/i', $value) or
       preg_match('/^canon\s(ef|mp|ts)/i', $value) or
       preg_match('/^sigma$/i', $value) or
       preg_match('/^sigma\s(af|\d+|apo|dl|ex|uc|df)/i', $value) or
       preg_match('/^smc pentax/i', $value) or
       preg_match('/^pentax-f/i', $value) or
       preg_match('/^takumar/i', $value) or
       preg_match('/^smc pentax/i', $value) or
       preg_match('/^samsung\sd/i', $value) or
       preg_match('/^samsung\/schneider/i', $value) or
       preg_match('/^schneider\sd/i', $value) or
       preg_match('/^tamron\s(\d+|af|sp|xr)/i', $value) or
       preg_match('/^tokina\s/i', $value) or
       preg_match('/^cosina\s/i', $value) or
       preg_match('/^carl zeiss\s/i', $value) or
       preg_match('/^voigtlander ultron/i', $value) or
       preg_match('/^\{/i', $value) or
       preg_match('/^(4x|2x)$/i', $value) or
       preg_match('/^(x:|xmlns:)/i', $value) or
       ($value == "?")
     )
    {
      //echo "$value<br>";
      $returned=false;
    }
    //echo "$value : ".(($returned)?"Y":"N")."<br>";
    return($returned);
  }


  function manageResult($data, $fileSaveName, $fileCompareName, $default="")
  {
    $poKeys=loadPoFile($fileCompareName);

    $result="msgid \"\"
msgstr \"\"
\"Project-Id-Version: TagNames\\n\"
\"POT-Creation-Date: \\n\"
\"PO-Revision-Date: ".date('Y-m-d')."\\n\"
\"Last-Translator: grum <grum@piwigo.org>\\n\"
\"Language-Team: grum <grum@piwigo.org>\\n\"
\"MIME-Version: 1.0\\n\"
\"Content-Type: text/plain; charset=utf-8\\n\"
\"Content-Transfer-Encoding: 8bit\\n\"
\"X-Poedit-Language: en\\n\"
\"X-Poedit-Country: UK\\n\"
\"X-Poedit-SourceCharset: utf-8\\n\"

";

    $nb=0;
    foreach($data as $key => $val)
    {
      if(($fileCompareName=="" or
          ($fileCompareName!="" and !array_key_exists($val['value'], $poKeys))) and
          isAllowed($val['value']))
      {
        foreach($val['group'] as $group)
        {
          $result.="#. ".$group."\n";
        }
        if($default!="")
        {
          $result.="#, fuzzy\n";
        }
        $result.="msgid \"".$val['value']."\"\n";
        $result.="msgstr \"".$default."\"\n\n";
        $nb++;
      }
    }

    echo "Number of keys : $nb<br><hr>";
    echo nl2br($result);

    if($fileSaveName!="")
    {
      $fHandler=fopen($fileSaveName, "w");
      if($fHandler)
      {
        fwrite($fHandler, $result);
        fclose($fHandler);
      }
    }
  }

  function makeForm()
  {
    if(isset($_REQUEST['fFileType']))
    {
      $fileType=$_REQUEST['fFileType'];
    }
    else
    {
      $fileType='values';
    }

    if(isset($_REQUEST['fFileSaveName']))
    {
      $fileSaveName=$_REQUEST['fFileSaveName'];
    }
    else
    {
      $fileSaveName='';
      $_REQUEST['fFileSaveName']='';
    }

    if(isset($_REQUEST['fFileSave']))
    {
      $fileSave=$_REQUEST['fFileSave'];
    }
    else
    {
      $fileSave='';
      $_REQUEST['fFileSave']='';
    }

    if(isset($_REQUEST['fFileCompareName']))
    {
      $fileCompareName=$_REQUEST['fFileCompareName'];
    }
    else
    {
      $fileCompareName='';
      $_REQUEST['fFileCompareName']='';
    }

    if(isset($_REQUEST['fFileCompare']))
    {
      $fileCompare=$_REQUEST['fFileCompare'];
    }
    else
    {
      $fileCompare='';
      $_REQUEST['fFileCompare']='';
    }


    $checked['values']=($fileType=='values')?"checked":"";
    $checked['desc']=($fileType=='desc')?"checked":"";

    if($fileSave=='on')
    {
      $fileSave="checked";
    }

    if($fileCompare=='on')
    {
      $fileCompare="checked";
    }


    echo "
    <form>
      <fieldset>
        Generate <i>.po</i> file :<br>
        <label><input type='radio' name='fFileType' value='values' ".$checked['values'].">metadata values</label><br>
        <label><input type='radio' name='fFileType' value='desc' ".$checked['desc'].">metadata description</label><br>

        <br><br>

        <label><input type='checkbox' name='fFileCompare' ".$fileCompare.">Compare with an existing file</label><br>
        <label>File name :
          <input type='text' name='fFileCompareName' value='".$fileCompareName."'>
        </label>


        <br><br>

        <label><input type='checkbox' name='fFileSave' ".$fileSave.">Save result in a file</label><br>
        <label>File name :
          <input type='text' name='fFileSaveName' value='".$fileSaveName."'>
        </label>

        <br><br><input type='submit'>
      </fieldset>
    </form><br>";

  }

  makeForm();

  if(isset($_REQUEST['fFileType']))
  {
    switch($_REQUEST['fFileType'])
    {
      case "values":
        makePoValues(($_REQUEST['fFileSave']=='on')?$_REQUEST['fFileSaveName']:"", ($_REQUEST['fFileCompare']=='on')?$_REQUEST['fFileCompareName']:"");
        break;
      case "desc":
        makePoDesc(($_REQUEST['fFileSave']=='on')?$_REQUEST['fFileSaveName']:"", ($_REQUEST['fFileCompare']=='on')?$_REQUEST['fFileCompareName']:"");
        break;
    }
  }

?>
