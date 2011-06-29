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
 * The L10n class is used for tag translation, reading the .mo files
 *
 * There is one directory per language, the directories tree must respect this
 * structure
 *
 * --\ Locale                           => main directory for languages
 *     |
 *     +--\ en_UK                       => language
 *     |    |
 *     |    +--\ LC_MESSAGES
 *     |         |
 *     |         +--\ Tag.mo            => names & values translations
 *     |         +--\ TadDesc.mo        => descriptions translations
 *     |
 *     +--\ fr_FR
 *          |
 *          +--\ LC_MESSAGES
 *               |
 *               +--\ Tag.mo
 *               +--\ TadDesc.mo
 *
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * This class don't use the PHP gettext functions, but the php-gettext extension
 * ==> See files in External/php-gettext for more information about this project
 *
 *
 *
 * This class provides theses public functions :
 *  - (static) setLanguage
 *  - (static) getLanguage
 *  - (static) get
 *  - (static) getDesc
 *
 * -----------------------------------------------------------------------------
 */


require_once(JPEG_METADATA_DIR."External/php-gettext/gettext.inc");

/**
 * $supported_locales is a global variable need by the php-gettext package.
 * the array is automatically initialized with the setLanguage() function
 */
$supported_locales = array();

/**
 * assume a default language is set in any case...
 */
L10n::setLanguage();


class L10n
{
  const JMD_TAG = "Tag";
  const JMD_TAGDESC = "TagDesc";

  static private $language = "";

  /**
   * This function is used to set the locale language.
   * If no language is given, assume the default "en_UK" language
   *
   * If there is no translation file for the the given language, assume the
   * default "en_UK" language
   *
   * @param String $language : the language
   * @param String $charset  : charset encoding (UTF-8)
   * @return String : the defined language
   */
  static function setLanguage($language="en_UK", $charset="UTF-8")
  {
    global $supported_locales;

    /*
     * Scan the Locale directory.
     * Any directory with a sub directory "LC_MESSAGES" is considered as a
     * supported locale language
     */
    $directory=scandir(JPEG_METADATA_DIR."Locale");
    foreach($directory as $key => $file)
    {
      if(is_dir(JPEG_METADATA_DIR."Locale/".$file) and
         $file!='.' and
         $file!='..' and
         file_exists(JPEG_METADATA_DIR."Locale/".$file."/LC_MESSAGES/Tag.mo"))
         $supported_locales[]=$file;

    }

    /*
     * if the desired language doesn't exist, apply the en_UK locale
     * (assuming the en_UK exists and was not deleted)
     */
    if(!in_array($language, $supported_locales))
      self::$language='en_UK';
    else
      self::$language=$language;

    /*
     * set the locale
     */
    T_setlocale(LC_MESSAGES, self::$language);

    /*
     * set one domain "TAG" for tags name&values, and one domaine "TAGDESC" for
     * tags description
     */
    T_bindtextdomain(self::JMD_TAG, dirname(dirname(__FILE__))."/Locale");
    T_bindtextdomain(self::JMD_TAGDESC, dirname(dirname(__FILE__))."/Locale");

    /*
     * set the charsets
     */
    if($charset!="")
    {
      T_bind_textdomain_codeset(self::JMD_TAG, $charset);
      T_bind_textdomain_codeset(self::JMD_TAGDESC, $charset);
    }

    return(self::$language);
  }

  /**
   * returns the defined current language
   *
   * @return String
   */
  static function getLanguage()
  {
    return(self::$language);
  }

  /**
   * returns the translation in current language for the given key
   *
   * @return String
   */
  static function get($key)
  {
    T_textdomain(self::JMD_TAG);
    return(@T_dgettext(self::JMD_TAG, $key));
  }

  /**
   * returns the description in current language for the given tagName
   *
   * @return String
   */
  static function getDesc($tagName)
  {
    T_textdomain(self::JMD_TAGDESC);
    return(@T_dgettext(self::JMD_TAGDESC, $tagName));
  }

}


?>
