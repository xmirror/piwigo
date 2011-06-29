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
 * The IptcTags is the definition of the IPTC tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The IptcTags class is derived from the KnownTags class.
 *
 * ======> See KnownTags.class.php to know more about the tag definitions <=====
 *
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");

  /**
   * Define the tags for IPTC metadata
   */
  class IptcTags extends KnownTags
  {
    protected $label = "IPTC tags";
    protected $tags = Array(
      0x0100 => Array( //1:00
        'tagName'      => "Model Version",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0105 => Array( // 1:05
        'tagName'      => "Destination",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0114 => Array( //1:20
        'tagName'      => "File Format",
        'implemented'  => true,
        'translatable' => true,
        'tagValues.special'    => Array(
          0x0000 => "No ObjectData",
          0x0001 => "IPTC-NAA Digital Newsphoto Parameter Record",
          0x0002 => "IPTC7901 Recommended Message Format",
          0x0003 => "Tagged Image File Format (Adobe/Aldus Image data)",
          0x0004 => "Illustrator (Adobe Graphics data)",
          0x0005 => "AppleSingle (Apple Computer Inc)",
          0x0006 => "NAA 89-3 (ANPA 1312)",
          0x0007 => "MacBinary II",
          0x0008 => "IPTC Unstructured Character Oriented File Format (UCOFF)",
          0x0009 => "United Press International ANPA 1312 variant",
          0x000A => "United Press International Down-Load Message",
          0x000B => "JPEG File Interchange (JFIF)",
          0x000C => "Photo-CD Image-Pac (Eastman Kodak)",
          0x000D => "Microsoft Bit Mapped Graphics File [*.BMP]",
          0x000E => "Digital Audio File [*.WAV] (Microsoft & Creative Labs)",
          0x000F => "Audio plus Moving Video [*.AVI] (Microsoft)",
          0x0010 => "PC DOS/Windows Executable Files [*.COM][*.EXE]",
          0x0011 => "Compressed Binary File [*.ZIP] (PKWare Inc)",
          0x0012 => "Audio Interchange File Format AIFF (Apple Computer Inc)",
          0x0013 => "RIFF Wave (Microsoft Corporation)",
          0x0014 => "Freehand (Macromedia/Aldus)",
          0x0015 => "Hypertext Markup Language 'HTML' (The Internet Society)",
          0x0016 => "MPEG 2 Audio Layer 2 (Musicom), ISO/IEC",
          0x0017 => "MPEG 2 Audio Layer 3, ISO/IEC",
          0x0018 => "Portable Document File (*.PDF) Adobe",
          0x0019 => "News Industry Text Format (NITF)",
          0x001A => "Tape Archive (*.TAR)",
          0x001B => "Tidningarnas Telegrambyrå NITF version (TTNITF DTD)",
          0x001C => "Ritzaus Bureau NITF version (RBNITF DTD)",
          0x001D => "Corel Draw [*.CDR]",
        ),
        'repeatable' => false,
      ),

      0x0116 => Array(
        'tagName'      => "File Format Version",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x011E => Array( //1:30
        'tagName'      => "Service Identifier",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),


      0x0128 => Array( // 1:40
        'tagName'      => "Envelope Number",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0132 => Array( // 1:50
        'tagName'      => "Product I.D.",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x013C => Array(
        'tagName'      => "Envelope Priority",
        'implemented'  => true,
        'translatable' => true,
        'repeatable' => false,
        'tagValues'    => Array(
           '0' => 'none',
           '1' => 'high+++',
           '2' => 'high++',
           '3' => 'high+',
           '4' => 'high',
           '5' => 'normal',
           '6' => 'low',
           '7' => 'low+',
           '8' => 'low++',
           '9' => 'none',
        ),      ),

      0x0146 => Array( // 1:70
        'tagName'      => "Date Sent",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0150 => Array( // 1:80
        'tagName'      => "Time Sent",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x015A => Array(
        'tagName'      => "Coded Character Set",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0164 => Array(
        'tagName'      => "UNO",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0178 => Array(
        'tagName'      => "ARM Identifier",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x017A => Array(
        'tagName'      => "ARM Version",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0200 => Array( //2:00
        'tagName'      => "Record Version",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0203 => Array( // 2:03
        'tagName'      => "Object Type Reference",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0204 => Array( //2:04
        'tagName'      => "Object Attribute Reference",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0205 => Array( // 2:05
        'tagName'      => "Object Name",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0207 => Array( // 2:07
        'tagName'      => "Edit Status",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0208 => Array(
        'tagName'      => "Editorial Update",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x020A => Array(
        'tagName'      => "Urgency",
        'implemented'  => true,
        'translatable' => true,
        'repeatable' => false,
        'tagValues'    => Array(
           '0' => 'none',
           '1' => 'high+++',
           '2' => 'high++',
           '3' => 'high+',
           '4' => 'high',
           '5' => 'normal',
           '6' => 'low',
           '7' => 'low+',
           '8' => 'low++',
           '9' => 'none',
        ),
      ),

      0x020C => Array( //2:12
        'tagName'      => "Subject Reference",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x020C00 => Array( //2:12:00 --> fake code, not in IPTC Spec.
        'tagName'      => "Subject Reference[IPR]",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),
      0x020C01 => Array( //2:12:01 --> fake code, not in IPTC Spec.
        'tagName'      => "Subject Reference[Number]",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),
      0x020C02 => Array( //2:12:02 --> fake code, not in IPTC Spec.
        'tagName'      => "Subject Reference[Name]",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),
      0x020C03 => Array( //2:12:03 --> fake code, not in IPTC Spec.
        'tagName'      => "Subject Reference[Matter Name]",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),
      0x020C04 => Array( //2:12:04 --> fake code, not in IPTC Spec.
        'tagName'      => "Subject Reference[Detail Name]",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),


      0x020F => Array( //2:15
        'tagName'      => "Category",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0214 => Array( // 2:20
        'tagName'      => "Supplemental Category",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0216 => Array( //2:22
        'tagName'      => "Fixture Identifier",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0219 => Array( //2:25
        'tagName'      => "Keywords",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x021A => Array( //2:26
        'tagName'      => "Content Location Code",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x021B => Array( //2:27
        'tagName'      => "Content Location Name",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x021E => Array( //2:30
        'tagName'      => "Release Date",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0223 => Array( // 2:35
        'tagName'      => "Release Time",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0225 => Array( // 2:37
        'tagName'      => "Expiration Date",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0226 => Array( // 2:38
        'tagName'      => "Expiration Time",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0228 => Array(  //2:40
        'tagName'      => "Special Instructions",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x022A => Array(
        'tagName'      => "Action Advised",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x022D => Array(
        'tagName'      => "Reference Service",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x022F => Array(
        'tagName'      => "Reference Date",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0232 => Array(
        'tagName'      => "Reference number",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0237 => Array( //2:55
        'tagName'      => "Date Created",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x023C => Array( //2:60
        'tagName'      => "Time Created",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x023E => Array( //2:62
        'tagName'      => "Digital Creation Date",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x023F => Array( //2:63
        'tagName'      => "Digital Creation Time",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0241 => Array( //2:65
        'tagName'      => "Originating Program",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0246 => Array( //2:70
        'tagName'      => "Program Version",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x024B => Array(
        'tagName'      => "Object Cycle",
        'implemented'  => true,
        'translatable' => true,
        'repeatable' => false,
        'tagValues'    => Array(
          'a' => "morning",
          'p' => "evening",
          'b' => "both"
        )
      ),

      0x0250 => Array( //2:80
        'tagName'      => "By-line",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0255 => Array( //2:85
        'tagName'      => "By-line Title",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x025A => Array( //2:90
        'tagName'      => "City",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x025C => Array( //2:92
        'tagName'      => "Sublocation",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x025F => Array( //2:95
        'tagName'      => "Province/State",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0264 => Array( // 2:100
        'tagName'      => "Country/Primary Location Code",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0265 => Array( // 2:101
        'tagName'      => "Country/Primary Location Name",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0267 => Array( // 2:103
        'tagName'      => "Original Transmission Reference",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0269 => Array( // 2:105
        'tagName'      => "Headline",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x026E => Array( //2:110
        'tagName'      => "Credit",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0273 => Array( //2:115
        'tagName'      => "Source",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0274 => Array( //2:116
        'tagName'      => "Copyright Notice",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0276 => Array( //2:118
        'tagName'      => "Contact",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x0278 => Array( // 2:120
        'tagName'      => "Caption/Abstract",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x027A => Array( // 2:122
        'tagName'      => "Writer/Editor",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x027D => Array(
        'tagName'      => "Rasterized Caption",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0282 => Array(
        'tagName'      => "Image Type",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
        'tagValues.special' => Array(
         0 => Array(
          '0' => "no object data",
          '1' => "single component",
          '2' => "multiple component",
          '3' => "multiple component",
          '4' => "multiple component",
          '9' => "supplemental objects",
         ),
         1 => Array(
          'W' => "Monochrome",
          'Y' => "Yellow component",
          'M' => "Magenta component",
          'C' => "Cyan component",
          'K' => "Black component",
          'R' => "Red component",
          'G' => "Green component",
          'B' => "Blue component",
          'T' => "Text only",
          'F' => "Full colour composite, frame sequential",
          'L' => "Full colour composite, line sequential",
          'P' => "Full colour composite, pixel sequential",
          'S' => "Full colour composite, special interleaving",
         )
        )
      ),

      0x0283 => Array(
        'tagName'      => "Image Orientation",
        'implemented'  => true,
        'translatable' => true,
        'repeatable' => false,
        'tagValues'    => Array(
          'P' => "portrait",
          'L' => "Landscape",
          'S' => "square",
        )
      ),

      0x0287 => Array( // 2:150
        'tagName'      => "Language Identifier",
        'implemented'  => true,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0296 => Array(
        'tagName'      => "Audio Type",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0297 => Array(
        'tagName'      => "Audion Sampling Rate",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0298 => Array(
        'tagName'      => "Audio Sampling Resolution",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0299 => Array(
        'tagName'      => "Audio Duration",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),


      0x029A => Array(
        'tagName'      => "Audion Outcue",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x02C8 => Array(
        'tagName'      => "ObjectData Preview File Format",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x02C9 => Array(
        'tagName'      => "ObjectData Preview File Format Version",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x02CA => Array(
        'tagName'      => "ObjectData Preview Data",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x070A => Array(
        'tagName'      => "Size Mode",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x0714 => Array(
        'tagName'      => "Max Subfile Size",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x075A => Array(
        'tagName'      => "ObjectData Size Announced",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x075F => Array(
        'tagName'      => "Maximum ObjectData Size",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),

      0x080A => Array(
        'tagName'      => "Subfile",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => true,
      ),

      0x090A => Array(
        'tagName'      => "Confirmed ObjectData Size",
        'implemented'  => false,
        'translatable' => false,
        'repeatable' => false,
      ),
    );


    static function iprLabel($IprCode)
    {
      switch($IprCode)
      {
        case 'AFP':  $returned="Agence France Presse"; break;
        case 'AP':   $returned=" Associated Press"; break;
        case 'APD':  $returned="Associated Press"; break;
        case 'APE':  $returned="Associated Press"; break;
        case 'APF':  $returned="Associated Press"; break;
        case 'APS':  $returned="Associated Press"; break;
        case 'BN':   $returned=" Canadian Press"; break;
        case 'CP':   $returned=" Canadian Press"; break;
        case 'CTK':  $returned="Czech News Agency"; break;
        case 'dpa':  $returned="Deutsche Presse-Agentur GmbH"; break;
        case 'HNA':  $returned="Croatian News Agency"; break;
        case 'IPTC': $returned="International Press Telecommunications Council"; break;
        case 'MTI':  $returned="Magyar Távirati Iroda / Hungarian News Agency"; break;
        case 'PC':   $returned=" Canadian Press"; break;
        case 'PN':   $returned=" Canadian Press"; break;
        case 'REUTERS': $returned="Reuters"; break;
        case 'STA':  $returned="Slovenska Tiskovna Agencija"; break;
        case 'TT':   $returned=" Tidningarnas Telegrambyrå"; break;
        case 'UP':   $returned=" United Press International"; break;
        case 'UPI':  $returned="United Press International"; break;
        default:
          $returned=$IprCode;
          break;
      }
      return($returned);
    }


    static function subjectCodeLabel($subjectCode)
    {
      switch($subjectCode)
      {
        case '01000000': $returned="arts, culture and entertainment"; break;
        case '01001000': $returned="archaeology"; break;
        case '01002000': $returned="architecture"; break;
        case '01003000': $returned="bullfighting"; break;
        case '01004000': $returned="festive event (including carnival)"; break;
        case '01005000': $returned="cinema"; break;
        case '01005001': $returned="film festival"; break;
        case '01006000': $returned="dance"; break;
        case '01007000': $returned="fashion"; break;
        case '01007001': $returned="jewelry"; break;
        case '01008000': $returned="language"; break;
        case '01009000': $returned="library and museum"; break;
        case '01010000': $returned="literature"; break;
        case '01010001': $returned="fiction"; break;
        case '01010002': $returned="poetry"; break;
        case '01011000': $returned="music"; break;
        case '01011001': $returned="classical music"; break;
        case '01011002': $returned="folk music"; break;
        case '01011003': $returned="jazz music"; break;
        case '01011004': $returned="popular music"; break;
        case '01011005': $returned="country music"; break;
        case '01011006': $returned="rock and roll music"; break;
        case '01011007': $returned="hip-hop"; break;
        case '01012000': $returned="painting"; break;
        case '01013000': $returned="photography"; break;
        case '01014000': $returned="radio"; break;
        case '01015000': $returned="sculpture"; break;
        case '01015001': $returned="plastic art"; break;
        case '01016000': $returned="television"; break;
        case '01016001': $returned="soap opera"; break;
        case '01017000': $returned="theatre"; break;
        case '01017001': $returned="music theatre"; break;
        case '01018000': $returned="monument and heritage site"; break;
        case '01018001': $returned="institution-DEPRECATED"; break;
        case '01019000': $returned="customs and tradition"; break;
        case '01020000': $returned="arts (general)"; break;
        case '01021000': $returned="entertainment (general)"; break;
        case '01021001': $returned="entertainment award"; break;
        case '01022000': $returned="culture (general)"; break;
        case '01022001': $returned="cultural development"; break;
        case '01023000': $returned="nightclub"; break;
        case '01024000': $returned="cartoon"; break;
        case '01025000': $returned="animation"; break;
        case '01026000': $returned="mass media"; break;
        case '01026001': $returned="periodicals"; break;
        case '01026002': $returned="news media"; break;
        case '01026003': $returned="newspapers"; break;
        case '01026004': $returned="reviews"; break;
        case '01027000': $returned="internet"; break;
        case '01028000': $returned="history"; break;
        case '02000000': $returned="crime, law and justice"; break;
        case '02001000': $returned="crime"; break;
        case '02001001': $returned="homicide"; break;
        case '02001002': $returned="computer crime"; break;
        case '02001003': $returned="theft"; break;
        case '02001004': $returned="drug trafficking"; break;
        case '02001005': $returned="sexual assault"; break;
        case '02001006': $returned="assault (general)"; break;
        case '02001007': $returned="kidnapping"; break;
        case '02001008': $returned="arson"; break;
        case '02001009': $returned="gang activity"; break;
        case '02001010': $returned="terrorism"; break;
        case '02002000': $returned="judiciary (system of justice)"; break;
        case '02002001': $returned="lawyer"; break;
        case '02002002': $returned="judge"; break;
        case '02002003': $returned="court administration"; break;
        case '02003000': $returned="police"; break;
        case '02003001': $returned="law enforcement"; break;
        case '02003002': $returned="investigation"; break;
        case '02003003': $returned="arrest"; break;
        case '02004000': $returned="punishment"; break;
        case '02004001': $returned="fine"; break;
        case '02004002': $returned="execution"; break;
        case '02005000': $returned="prison"; break;
        case '02006000': $returned="laws"; break;
        case '02006001': $returned="criminal"; break;
        case '02006002': $returned="civil"; break;
        case '02007000': $returned="justice and rights"; break;
        case '02007001': $returned="civil rights"; break;
        case '02008000': $returned="trials"; break;
        case '02008001': $returned="litigation"; break;
        case '02008002': $returned="arbitration"; break;
        case '02008003': $returned="court preliminary"; break;
        case '02009000': $returned="prosecution"; break;
        case '02009001': $returned="defendant"; break;
        case '02009002': $returned="witness"; break;
        case '02010000': $returned="organized crime"; break;
        case '02011000': $returned="international law"; break;
        case '02011001': $returned="international court or tribunal"; break;
        case '02011002': $returned="extradition"; break;
        case '02012000': $returned="corporate crime"; break;
        case '02012001': $returned="fraud"; break;
        case '02012002': $returned="embezzlement"; break;
        case '02012003': $returned="restraint of trade"; break;
        case '02012004': $returned="breach of contract"; break;
        case '02012005': $returned="anti-trust crime"; break;
        case '02012006': $returned="corruption"; break;
        case '02012007': $returned="bribery"; break;
        case '02013000': $returned="war crime"; break;
        case '02014000': $returned="inquest"; break;
        case '02015000': $returned="inquiry"; break;
        case '02016000': $returned="tribunal"; break;
        case '03000000': $returned="disaster and accident"; break;
        case '03001000': $returned="drought"; break;
        case '03002000': $returned="earthquake"; break;
        case '03003000': $returned="famine"; break;
        case '03004000': $returned="fire"; break;
        case '03005000': $returned="flood"; break;
        case '03006000': $returned="industrial accident"; break;
        case '03006001': $returned="structural failures"; break;
        case '03007000': $returned="meteorological disaster"; break;
        case '03007001': $returned="windstorms"; break;
        case '03008000': $returned="nuclear accident"; break;
        case '03009000': $returned="pollution"; break;
        case '03010000': $returned="transport accident"; break;
        case '03010001': $returned="road accident"; break;
        case '03010002': $returned="railway accident"; break;
        case '03010003': $returned="air and space accident"; break;
        case '03010004': $returned="maritime accident"; break;
        case '03011000': $returned="volcanic eruption"; break;
        case '03012000': $returned="relief and aid organisation"; break;
        case '03013000': $returned="accident (general)"; break;
        case '03014000': $returned="emergency incident"; break;
        case '03014001': $returned="explosion"; break;
        case '03015000': $returned="disaster (general)"; break;
        case '03015001': $returned="natural disasters"; break;
        case '03015002': $returned="avalanche/landslide"; break;
        case '03016000': $returned="emergency planning"; break;
        case '03017000': $returned="rescue"; break;
        case '04000000': $returned="economy, business and finance"; break;
        case '04001000': $returned="agriculture"; break;
        case '04001001': $returned="arable farming"; break;
        case '04001002': $returned="fishing industry"; break;
        case '04001003': $returned="forestry and timber"; break;
        case '04001004': $returned="livestock farming"; break;
        case '04001005': $returned="viniculture"; break;
        case '04001006': $returned="aquaculture"; break;
        case '04002000': $returned="chemicals"; break;
        case '04002001': $returned="biotechnology"; break;
        case '04002002': $returned="fertiliser"; break;
        case '04002003': $returned="health and beauty product"; break;
        case '04002004': $returned="inorganic chemical"; break;
        case '04002005': $returned="organic chemical"; break;
        case '04002006': $returned="pharmaceutical"; break;
        case '04002007': $returned="synthetic and plastic"; break;
        case '04003000': $returned="computing and information technology"; break;
        case '04003001': $returned="hardware"; break;
        case '04003002': $returned="networking"; break;
        case '04003003': $returned="satellite technology"; break;
        case '04003004': $returned="semiconductors and active components"; break;
        case '04003005': $returned="software"; break;
        case '04003006': $returned="telecommunication equipment"; break;
        case '04003007': $returned="telecommunication service"; break;
        case '04003008': $returned="security"; break;
        case '04003009': $returned="wireless technology"; break;
        case '04004000': $returned="construction and property"; break;
        case '04004001': $returned="heavy construction"; break;
        case '04004002': $returned="house building"; break;
        case '04004003': $returned="real estate"; break;
        case '04004004': $returned="farms"; break;
        case '04004005': $returned="land price"; break;
        case '04004006': $returned="renovation"; break;
        case '04004007': $returned="design and engineering"; break;
        case '04005000': $returned="energy and resource"; break;
        case '04005001': $returned="alternative energy"; break;
        case '04005002': $returned="coal"; break;
        case '04005003': $returned="oil and gas - downstream activities"; break;
        case '04005004': $returned="oil and gas - upstream activities"; break;
        case '04005005': $returned="nuclear power"; break;
        case '04005006': $returned="electricity production and distribution"; break;
        case '04005007': $returned="waste management and pollution control"; break;
        case '04005008': $returned="water supply"; break;
        case '04005009': $returned="natural resources (general)"; break;
        case '04005010': $returned="energy (general)"; break;
        case '04005011': $returned="natural gas"; break;
        case '04005012': $returned="petrol"; break;
        case '04005013': $returned="diesel fuel"; break;
        case '04005014': $returned="kerosene/paraffin"; break;
        case '04006000': $returned="financial and business service"; break;
        case '04006001': $returned="accountancy and auditing"; break;
        case '04006002': $returned="banking"; break;
        case '04006003': $returned="consultancy service"; break;
        case '04006004': $returned="employment agency"; break;
        case '04006005': $returned="healthcare provider"; break;
        case '04006006': $returned="insurance"; break;
        case '04006007': $returned="legal service"; break;
        case '04006008': $returned="market research"; break;
        case '04006009': $returned="stock broking"; break;
        case '04006010': $returned="personal investing"; break;
        case '04006011': $returned="market trend"; break;
        case '04006012': $returned="shipping service"; break;
        case '04006013': $returned="personal service"; break;
        case '04006014': $returned="janitorial service"; break;
        case '04006015': $returned="funeral parlour and crematorium"; break;
        case '04006016': $returned="rental service"; break;
        case '04006017': $returned="wedding service"; break;
        case '04006018': $returned="personal finance"; break;
        case '04006019': $returned="personal income"; break;
        case '04006020': $returned="auction service"; break;
        case '04006021': $returned="printing/promotional service"; break;
        case '04006022': $returned="investment service"; break;
        case '04007000': $returned="consumer goods"; break;
        case '04007001': $returned="clothing"; break;
        case '04007002': $returned="department store"; break;
        case '04007003': $returned="food"; break;
        case '04007004': $returned="mail order"; break;
        case '04007005': $returned="retail"; break;
        case '04007006': $returned="speciality store"; break;
        case '04007007': $returned="wholesale"; break;
        case '04007008': $returned="beverage"; break;
        case '04007009': $returned="electronic commerce"; break;
        case '04007010': $returned="luxury good"; break;
        case '04007011': $returned="non-durable good"; break;
        case '04007012': $returned="toy"; break;
        case '04008000': $returned="macro economics"; break;
        case '04008001': $returned="central bank"; break;
        case '04008002': $returned="consumer issue"; break;
        case '04008003': $returned="debt market"; break;
        case '04008004': $returned="economic indicator"; break;
        case '04008005': $returned="emerging market"; break;
        case '04008006': $returned="foreign exchange market"; break;
        case '04008007': $returned="government aid"; break;
        case '04008008': $returned="government debt"; break;
        case '04008009': $returned="interest rate"; break;
        case '04008010': $returned="international economic institution"; break;
        case '04008011': $returned="international (foreign) trade"; break;
        case '04008012': $returned="loan market"; break;
        case '04008013': $returned="economic organization"; break;
        case '04008014': $returned="consumer confidence"; break;
        case '04008015': $returned="trade dispute"; break;
        case '04008016': $returned="inflation and deflation"; break;
        case '04008017': $returned="prices"; break;
        case '04008018': $returned="currency values"; break;
        case '04008019': $returned="budgets and budgeting"; break;
        case '04008020': $returned="credit and debt"; break;
        case '04008021': $returned="loans"; break;
        case '04008022': $returned="mortgages"; break;
        case '04008023': $returned="financial markets"; break;
        case '04008024': $returned="commodity markets"; break;
        case '04008025': $returned="investments"; break;
        case '04008026': $returned="stocks"; break;
        case '04008027': $returned="bonds"; break;
        case '04008028': $returned="mutual funds"; break;
        case '04008029': $returned="derivative securities"; break;
        case '04008030': $returned="imports"; break;
        case '04008031': $returned="exports"; break;
        case '04008032': $returned="trade agreements"; break;
        case '04008033': $returned="trade policy"; break;
        case '04008034': $returned="business enterprises"; break;
        case '04008035': $returned="tariff"; break;
        case '04008036': $returned="trade balance"; break;
        case '04009000': $returned="market and exchange"; break;
        case '04009001': $returned="energy"; break;
        case '04009002': $returned="metal"; break;
        case '04009003': $returned="securities"; break;
        case '04009004': $returned="soft commodity"; break;
        case '04010000': $returned="media"; break;
        case '04010001': $returned="advertising"; break;
        case '04010002': $returned="book"; break;
        case '04010003': $returned="cinema industry"; break;
        case '04010004': $returned="news agency"; break;
        case '04010005': $returned="newspaper and magazine"; break;
        case '04010006': $returned="online"; break;
        case '04010007': $returned="public relation"; break;
        case '04010008': $returned="radio industry"; break;
        case '04010009': $returned="satellite and cable service"; break;
        case '04010010': $returned="television industry"; break;
        case '04010011': $returned="music industry"; break;
        case '04011000': $returned="manufacturing and engineering"; break;
        case '04011001': $returned="aerospace"; break;
        case '04011002': $returned="automotive equipment"; break;
        case '04011003': $returned="defence equipment"; break;
        case '04011004': $returned="electrical appliance"; break;
        case '04011005': $returned="heavy engineering"; break;
        case '04011006': $returned="industrial component"; break;
        case '04011007': $returned="instrument engineering"; break;
        case '04011008': $returned="shipbuilding"; break;
        case '04011009': $returned="machine manufacturing"; break;
        case '04012000': $returned="metal and mineral"; break;
        case '04012001': $returned="building material"; break;
        case '04012002': $returned="gold and precious material"; break;
        case '04012003': $returned="iron and steel"; break;
        case '04012004': $returned="non ferrous metal"; break;
        case '04012005': $returned="mining"; break;
        case '04013000': $returned="process industry"; break;
        case '04013001': $returned="distiller and brewer"; break;
        case '04013002': $returned="food"; break;
        case '04013003': $returned="furnishings and furniture"; break;
        case '04013004': $returned="paper and packaging product"; break;
        case '04013005': $returned="rubber product"; break;
        case '04013006': $returned="soft drinks"; break;
        case '04013007': $returned="textile and clothing"; break;
        case '04013008': $returned="tobacco"; break;
        case '04014000': $returned="tourism and leisure"; break;
        case '04014001': $returned="casino and gambling"; break;
        case '04014002': $returned="hotel and accommodation"; break;
        case '04014003': $returned="recreational and sporting goods"; break;
        case '04014004': $returned="restaurant and catering"; break;
        case '04014005': $returned="tour operator"; break;
        case '04015000': $returned="transport"; break;
        case '04015001': $returned="air transport"; break;
        case '04015002': $returned="railway"; break;
        case '04015003': $returned="road transport"; break;
        case '04015004': $returned="waterway and maritime transport"; break;
        case '04016000': $returned="company information"; break;
        case '04016001': $returned="accounting and audit"; break;
        case '04016002': $returned="annual and special corporate meeting"; break;
        case '04016003': $returned="annual report"; break;
        case '04016004': $returned="antitrust issue"; break;
        case '04016005': $returned="merger, acquisition and takeover"; break;
        case '04016006': $returned="analysts' comment"; break;
        case '04016007': $returned="bankruptcy"; break;
        case '04016008': $returned="board of directors (appointment and change)"; break;
        case '04016009': $returned="buyback"; break;
        case '04016010': $returned="C.E.O. interview"; break;
        case '04016011': $returned="corporate officer"; break;
        case '04016012': $returned="corporate profile"; break;
        case '04016013': $returned="contract"; break;
        case '04016014': $returned="defence contract"; break;
        case '04016015': $returned="dividend announcement"; break;
        case '04016016': $returned="earnings forecast"; break;
        case '04016017': $returned="financially distressed company"; break;
        case '04016018': $returned="earnings"; break;
        case '04016019': $returned="financing and stock offering"; break;
        case '04016020': $returned="government contract"; break;
        case '04016021': $returned="global expansion"; break;
        case '04016022': $returned="insider trading"; break;
        case '04016023': $returned="joint venture"; break;
        case '04016024': $returned="leveraged buyout"; break;
        case '04016025': $returned="layoffs and downsizing"; break;
        case '04016026': $returned="licensing agreement"; break;
        case '04016027': $returned="litigation and regulation"; break;
        case '04016028': $returned="management change"; break;
        case '04016029': $returned="marketing"; break;
        case '04016030': $returned="new product"; break;
        case '04016031': $returned="patent, copyright and trademark"; break;
        case '04016032': $returned="plant closing"; break;
        case '04016033': $returned="plant opening"; break;
        case '04016034': $returned="privatisation"; break;
        case '04016035': $returned="proxy filing"; break;
        case '04016036': $returned="rating"; break;
        case '04016037': $returned="research and development"; break;
        case '04016038': $returned="quarterly or semiannual financial statement"; break;
        case '04016039': $returned="restructuring and recapitalisation"; break;
        case '04016040': $returned="spin-off"; break;
        case '04016041': $returned="stock activity"; break;
        case '04016042': $returned="industrial production"; break;
        case '04016043': $returned="productivity"; break;
        case '04016044': $returned="inventories"; break;
        case '04016045': $returned="sales"; break;
        case '04016046': $returned="corporations"; break;
        case '04016047': $returned="shareholders"; break;
        case '04016048': $returned="corporate performance"; break;
        case '04016049': $returned="losses"; break;
        case '04016050': $returned="credit ratings"; break;
        case '04016051': $returned="stock splits"; break;
        case '04016052': $returned="stock options"; break;
        case '04016053': $returned="recalls (products)"; break;
        case '04016054': $returned="globalization"; break;
        case '04016055': $returned="consumers"; break;
        case '04016056': $returned="purchase"; break;
        case '04016057': $returned="new service"; break;
        case '04017000': $returned="economy (general)"; break;
        case '04017001': $returned="economic policy"; break;
        case '04018000': $returned="business (general)"; break;
        case '04018001': $returned="institution"; break;
        case '04019000': $returned="finance (general)"; break;
        case '04019001': $returned="money and monetary policy"; break;
        case '05000000': $returned="education"; break;
        case '05001000': $returned="adult education"; break;
        case '05002000': $returned="further education"; break;
        case '05003000': $returned="parent organisation"; break;
        case '05004000': $returned="preschool"; break;
        case '05005000': $returned="school"; break;
        case '05005001': $returned="elementary schools"; break;
        case '05005002': $returned="middle schools"; break;
        case '05005003': $returned="high schools"; break;
        case '05006000': $returned="teachers union"; break;
        case '05007000': $returned="university"; break;
        case '05008000': $returned="upbringing"; break;
        case '05009000': $returned="entrance examination"; break;
        case '05010000': $returned="teaching and learning"; break;
        case '05010001': $returned="students"; break;
        case '05010002': $returned="teachers"; break;
        case '05010003': $returned="curriculum"; break;
        case '05010004': $returned="test/examination"; break;
        case '05011000': $returned="religious education"; break;
        case '05011001': $returned="parochial school"; break;
        case '05011002': $returned="seminary"; break;
        case '05011003': $returned="yeshiva"; break;
        case '05011004': $returned="madrasa"; break;
        case '06000000': $returned="environmental issue"; break;
        case '06001000': $returned="renewable energy"; break;
        case '06002000': $returned="conservation"; break;
        case '06002001': $returned="endangered species"; break;
        case '06002002': $returned="ecosystem"; break;
        case '06003000': $returned="energy saving"; break;
        case '06004000': $returned="environmental politics"; break;
        case '06005000': $returned="environmental pollution"; break;
        case '06005001': $returned="air pollution"; break;
        case '06005002': $returned="water pollution"; break;
        case '06006000': $returned="natural resources"; break;
        case '06006001': $returned="land resources"; break;
        case '06006002': $returned="parks"; break;
        case '06006003': $returned="forests"; break;
        case '06006004': $returned="wetlands"; break;
        case '06006005': $returned="mountains"; break;
        case '06006006': $returned="rivers"; break;
        case '06006007': $returned="oceans"; break;
        case '06006008': $returned="wildlife"; break;
        case '06006009': $returned="energy resources"; break;
        case '06007000': $returned="nature"; break;
        case '06007001': $returned="invasive species"; break;
        case '06008000': $returned="population"; break;
        case '06009000': $returned="waste"; break;
        case '06010000': $returned="water"; break;
        case '06011000': $returned="global warming"; break;
        case '06012000': $returned="hazardous materials"; break;
        case '06013000': $returned="environmental cleanup"; break;
        case '07000000': $returned="health"; break;
        case '07001000': $returned="disease"; break;
        case '07001001': $returned="communicable diseases"; break;
        case '07001002': $returned="virus diseases"; break;
        case '07001003': $returned="AIDS"; break;
        case '07001004': $returned="cancer"; break;
        case '07001005': $returned="heart disease"; break;
        case '07001006': $returned="alzheimer's disease"; break;
        case '07001007': $returned="animal diseases"; break;
        case '07001008': $returned="plant diseases"; break;
        case '07001009': $returned="retrovirus"; break;
        case '07002000': $returned="epidemic and plague"; break;
        case '07003000': $returned="health treatment"; break;
        case '07003001': $returned="prescription drugs"; break;
        case '07003002': $returned="dietary supplements"; break;
        case '07003003': $returned="diet"; break;
        case '07003004': $returned="medical procedure/test"; break;
        case '07003005': $returned="therapy"; break;
        case '07004000': $returned="health organisations"; break;
        case '07005000': $returned="medical research"; break;
        case '07006000': $returned="medical staff"; break;
        case '07006001': $returned="primary care physician"; break;
        case '07006002': $returned="health-workers union"; break;
        case '07007000': $returned="medicine"; break;
        case '07007001': $returned="herbal"; break;
        case '07007002': $returned="holistic"; break;
        case '07007003': $returned="western"; break;
        case '07007004': $returned="traditional Chinese"; break;
        case '07008000': $returned="preventative medicine"; break;
        case '07008001': $returned="vaccines"; break;
        case '07009000': $returned="injury"; break;
        case '07010000': $returned="hospital and clinic"; break;
        case '07011000': $returned="government health care"; break;
        case '07011001': $returned="medicare"; break;
        case '07011002': $returned="medicaid"; break;
        case '07012000': $returned="private health care"; break;
        case '07013000': $returned="healthcare policy"; break;
        case '07013001': $returned="food safety"; break;
        case '07014000': $returned="medical specialisation"; break;
        case '07014001': $returned="geriatric"; break;
        case '07014002': $returned="pediatrics"; break;
        case '07014003': $returned="reproduction"; break;
        case '07014004': $returned="genetics"; break;
        case '07014005': $returned="obstetrics/gynecology"; break;
        case '07015000': $returned="medical service"; break;
        case '07016000': $returned="physical fitness"; break;
        case '07017000': $returned="illness"; break;
        case '07017001': $returned="mental illness"; break;
        case '07017002': $returned="eating disorder"; break;
        case '07017003': $returned="obesity"; break;
        case '07018000': $returned="medical conditions"; break;
        case '07019000': $returned="patient"; break;
        case '08000000': $returned="human interest"; break;
        case '08001000': $returned="animal"; break;
        case '08002000': $returned="curiosity"; break;
        case '08003000': $returned="people"; break;
        case '08003001': $returned="advice"; break;
        case '08003002': $returned="celebrity"; break;
        case '08003003': $returned="accomplishment"; break;
        case '08003004': $returned="human mishap"; break;
        case '08003005': $returned="fortune-telling"; break;
        case '08004000': $returned="mystery"; break;
        case '08005000': $returned="society"; break;
        case '08005001': $returned="ceremony"; break;
        case '08005002': $returned="death"; break;
        case '08005003': $returned="funeral"; break;
        case '08005004': $returned="estate bestowal"; break;
        case '08005005': $returned="memorial"; break;
        case '08006000': $returned="award and prize"; break;
        case '08006001': $returned="record"; break;
        case '08007000': $returned="imperial and royal matters"; break;
        case '08008000': $returned="plant"; break;
        case '09000000': $returned="labour"; break;
        case '09001000': $returned="apprentices"; break;
        case '09002000': $returned="collective contract"; break;
        case '09002001': $returned="contract issue-wages"; break;
        case '09002002': $returned="contract issue-healthcare"; break;
        case '09002003': $returned="contract issue-work rules"; break;
        case '09003000': $returned="employment"; break;
        case '09003001': $returned="labor market"; break;
        case '09003002': $returned="job layoffs"; break;
        case '09003003': $returned="child labor"; break;
        case '09003004': $returned="occupations"; break;
        case '09004000': $returned="labour dispute"; break;
        case '09005000': $returned="labour legislation"; break;
        case '09006000': $returned="retirement"; break;
        case '09007000': $returned="retraining"; break;
        case '09008000': $returned="strike"; break;
        case '09009000': $returned="unemployment"; break;
        case '09010000': $returned="unions"; break;
        case '09011000': $returned="wage and pension"; break;
        case '09011001': $returned="employee benefits"; break;
        case '09011002': $returned="social security"; break;
        case '09012000': $returned="work relations"; break;
        case '09013000': $returned="health and safety at work"; break;
        case '09014000': $returned="advanced training"; break;
        case '09015000': $returned="employer"; break;
        case '09016000': $returned="employee"; break;
        case '10000000': $returned="lifestyle and leisure"; break;
        case '10001000': $returned="game"; break;
        case '10001001': $returned="Go"; break;
        case '10001002': $returned="chess"; break;
        case '10001003': $returned="bridge"; break;
        case '10001004': $returned="shogi"; break;
        case '10002000': $returned="gaming and lottery"; break;
        case '10003000': $returned="gastronomy"; break;
        case '10003001': $returned="organic foods"; break;
        case '10004000': $returned="hobby"; break;
        case '10004001': $returned="DIY"; break;
        case '10004002': $returned="shopping"; break;
        case '10004003': $returned="gardening"; break;
        case '10005000': $returned="holiday or vacation"; break;
        case '10006000': $returned="tourism"; break;
        case '10007000': $returned="travel and commuting"; break;
        case '10007001': $returned="traffic"; break;
        case '10008000': $returned="club and association"; break;
        case '10009000': $returned="lifestyle (house and home)"; break;
        case '10010000': $returned="leisure (general)"; break;
        case '10011000': $returned="public holiday"; break;
        case '10012000': $returned="hunting"; break;
        case '10013000': $returned="fishing"; break;
        case '10014000': $returned="auto trends"; break;
        case '10015000': $returned="adventure"; break;
        case '10016000': $returned="beauty"; break;
        case '10017000': $returned="consumer issue"; break;
        case '10018000': $returned="wedding"; break;
        case '11000000': $returned="politics"; break;
        case '11001000': $returned="defence"; break;
        case '11001001': $returned="veterans affairs"; break;
        case '11001002': $returned="national security"; break;
        case '11001003': $returned="security measures"; break;
        case '11001004': $returned="armed Forces"; break;
        case '11001005': $returned="military equipment"; break;
        case '11001006': $returned="firearms"; break;
        case '11001007': $returned="biological and chemical weapons"; break;
        case '11001008': $returned="missile systems"; break;
        case '11001009': $returned="nuclear weapons"; break;
        case '11002000': $returned="diplomacy"; break;
        case '11002001': $returned="summit"; break;
        case '11002002': $returned="international relations"; break;
        case '11002003': $returned="peace negotiations"; break;
        case '11002004': $returned="alliances"; break;
        case '11003000': $returned="election"; break;
        case '11003001': $returned="political candidates"; break;
        case '11003002': $returned="political campaigns"; break;
        case '11003003': $returned="campaign finance"; break;
        case '11003004': $returned="national elections"; break;
        case '11003005': $returned="regional elections"; break;
        case '11003006': $returned="local elections"; break;
        case '11003007': $returned="voting"; break;
        case '11003008': $returned="poll"; break;
        case '11003009': $returned="european elections"; break;
        case '11003010': $returned="primary"; break;
        case '11004000': $returned="espionage and intelligence"; break;
        case '11005000': $returned="foreign aid"; break;
        case '11005001': $returned="economic sanction"; break;
        case '11006000': $returned="government"; break;
        case '11006001': $returned="civil and public service"; break;
        case '11006002': $returned="safety of citizens"; break;
        case '11006003': $returned="think tank"; break;
        case '11006004': $returned="national government"; break;
        case '11006005': $returned="executive (government)"; break;
        case '11006006': $returned="heads of state"; break;
        case '11006007': $returned="government departments"; break;
        case '11006008': $returned="public officials"; break;
        case '11006009': $returned="ministers (government)"; break;
        case '11006010': $returned="public employees"; break;
        case '11006011': $returned="privatisation"; break;
        case '11006012': $returned="nationalisation"; break;
        case '11006013': $returned="impeachment"; break;
        case '11007000': $returned="human rights"; break;
        case '11008000': $returned="local authority"; break;
        case '11009000': $returned="parliament"; break;
        case '11009001': $returned="upper house"; break;
        case '11009002': $returned="lower house"; break;
        case '11010000': $returned="parties and movements"; break;
        case '11010001': $returned="non government organizations (NGO)"; break;
        case '11011000': $returned="refugee"; break;
        case '11012000': $returned="regional authority"; break;
        case '11013000': $returned="state budget and tax"; break;
        case '11013001': $returned="public finance"; break;
        case '11014000': $returned="treaty and international organisation-DEPRECATED"; break;
        case '11014001': $returned="international relations-DEPRECATED"; break;
        case '11014002': $returned="peace negotiations-DEPRECATED"; break;
        case '11014003': $returned="alliances-DEPRECATED"; break;
        case '11015000': $returned="constitution"; break;
        case '11016000': $returned="interior policy"; break;
        case '11016001': $returned="data protection"; break;
        case '11016002': $returned="housing and urban planning"; break;
        case '11016003': $returned="pension and welfare"; break;
        case '11016004': $returned="personal weapon control"; break;
        case '11016005': $returned="indigenous people"; break;
        case '11016006': $returned="personal data collection"; break;
        case '11016007': $returned="planning inquiries"; break;
        case '11017000': $returned="migration"; break;
        case '11018000': $returned="citizens initiative and recall"; break;
        case '11019000': $returned="referenda"; break;
        case '11020000': $returned="nuclear policy"; break;
        case '11021000': $returned="lobbying"; break;
        case '11022000': $returned="regulatory policy and organisation"; break;
        case '11023000': $returned="censorship"; break;
        case '11024000': $returned="politics (general)"; break;
        case '11024001': $returned="political systems"; break;
        case '11024002': $returned="democracy"; break;
        case '11024003': $returned="political development"; break;
        case '11025000': $returned="freedom of the press"; break;
        case '11026000': $returned="freedom of religion"; break;
        case '11027000': $returned="treaty"; break;
        case '11028000': $returned="international organisation"; break;
        case '12000000': $returned="religion and belief"; break;
        case '12001000': $returned="cult and sect"; break;
        case '12002000': $returned="belief (faith)"; break;
        case '12002001': $returned="unificationism"; break;
        case '12002002': $returned="scientology"; break;
        case '12003000': $returned="freemasonry"; break;
        case '12004000': $returned="religion-DEPRECATED"; break;
        case '12004001': $returned="christianity-DEPRECATED"; break;
        case '12004002': $returned="islam-DEPRECATED"; break;
        case '12004003': $returned="judaism-DEPRECATED"; break;
        case '12004004': $returned="buddhism-DEPRECATED"; break;
        case '12004005': $returned="hinduism-DEPRECATED"; break;
        case '12005000': $returned="church (organisation)-DEPRECATED"; break;
        case '12005001': $returned="religious facilities-DEPRECATED"; break;
        case '12006000': $returned="values"; break;
        case '12006001': $returned="ethics"; break;
        case '12006002': $returned="corrupt practices"; break;
        case '12007000': $returned="church and state relations"; break;
        case '12008000': $returned="philosophy"; break;
        case '12009000': $returned="christianity"; break;
        case '12009001': $returned="protestant"; break;
        case '12009002': $returned="lutheran"; break;
        case '12009003': $returned="reformed"; break;
        case '12009004': $returned="anglican"; break;
        case '12009005': $returned="methodist"; break;
        case '12009006': $returned="baptist"; break;
        case '12009007': $returned="mennonite"; break;
        case '12009009': $returned="mormon"; break;
        case '12009010': $returned="roman catholic"; break;
        case '12009011': $returned="old catholic"; break;
        case '12009012': $returned="orthodoxy"; break;
        case '12009013': $returned="salvation army"; break;
        case '12010000': $returned="islam"; break;
        case '12011000': $returned="judaism"; break;
        case '12012000': $returned="buddhism"; break;
        case '12013000': $returned="hinduism"; break;
        case '12014000': $returned="religious festival or holiday"; break;
        case '12014001': $returned="christmas"; break;
        case '12014002': $returned="easter"; break;
        case '12014003': $returned="pentecost"; break;
        case '12014004': $returned="ramadan"; break;
        case '12014005': $returned="yom kippur"; break;
        case '12015000': $returned="religious leader"; break;
        case '12015001': $returned="pope"; break;
        case '12016000': $returned="nature religion"; break;
        case '12017000': $returned="taoism"; break;
        case '12018000': $returned="shintoism"; break;
        case '12019000': $returned="sikhism"; break;
        case '12020000': $returned="jainism"; break;
        case '12021000': $returned="parsasm"; break;
        case '12022000': $returned="confucianism"; break;
        case '12023000': $returned="religious text"; break;
        case '12023001': $returned="bible"; break;
        case '12023002': $returned="qur'an"; break;
        case '12023003': $returned="torah"; break;
        case '12024000': $returned="interreligious dialogue"; break;
        case '12025000': $returned="religious event"; break;
        case '12025001': $returned="catholic convention"; break;
        case '12025002': $returned="protestant convention"; break;
        case '12025004': $returned="ritual"; break;
        case '12026000': $returned="concordat"; break;
        case '12027000': $returned="ecumenism"; break;
        case '13000000': $returned="science and technology"; break;
        case '13001000': $returned="applied science"; break;
        case '13001001': $returned="physics"; break;
        case '13001002': $returned="chemistry"; break;
        case '13001003': $returned="cosmology"; break;
        case '13001004': $returned="particle physics"; break;
        case '13002000': $returned="engineering"; break;
        case '13002001': $returned="material science"; break;
        case '13003000': $returned="human science"; break;
        case '13003001': $returned="social sciences"; break;
        case '13003002': $returned="history"; break;
        case '13003003': $returned="psychology"; break;
        case '13003004': $returned="sociology"; break;
        case '13003005': $returned="anthropology"; break;
        case '13004000': $returned="natural science"; break;
        case '13004001': $returned="geology"; break;
        case '13004002': $returned="paleontology"; break;
        case '13004003': $returned="geography"; break;
        case '13004004': $returned="botany"; break;
        case '13004005': $returned="zoology"; break;
        case '13004006': $returned="physiology"; break;
        case '13004007': $returned="astronomy"; break;
        case '13004008': $returned="biology"; break;
        case '13005000': $returned="philosophical science"; break;
        case '13006000': $returned="research"; break;
        case '13006001': $returned="survey"; break;
        case '13007000': $returned="scientific exploration"; break;
        case '13008000': $returned="space programme"; break;
        case '13009000': $returned="science (general)"; break;
        case '13010000': $returned="technology (general)"; break;
        case '13010001': $returned="rocketry"; break;
        case '13010002': $returned="laser"; break;
        case '13011000': $returned="standards"; break;
        case '13012000': $returned="animal science"; break;
        case '13013000': $returned="micro science"; break;
        case '13014000': $returned="marine science"; break;
        case '13015000': $returned="weather science"; break;
        case '13016000': $returned="electronics"; break;
        case '13017000': $returned="identification technology"; break;
        case '13018000': $returned="mathematics"; break;
        case '13019000': $returned="biotechnology"; break;
        case '13020000': $returned="agricultural research and technology"; break;
        case '13021000': $returned="nanotechnology"; break;
        case '13022000': $returned="IT/computer sciences"; break;
        case '13023000': $returned="scientific institutions"; break;
        case '14000000': $returned="social issue"; break;
        case '14001000': $returned="addiction"; break;
        case '14002000': $returned="charity"; break;
        case '14003000': $returned="demographics"; break;
        case '14003001': $returned="population and census"; break;
        case '14003002': $returned="immigration"; break;
        case '14003003': $returned="illegal immigrants"; break;
        case '14003004': $returned="emigrants"; break;
        case '14004000': $returned="disabled"; break;
        case '14005000': $returned="euthanasia (also includes assisted suicide)"; break;
        case '14005001': $returned="suicide"; break;
        case '14006000': $returned="family"; break;
        case '14006001': $returned="parent and child"; break;
        case '14006002': $returned="adoption"; break;
        case '14006003': $returned="marriage"; break;
        case '14006004': $returned="divorce"; break;
        case '14006005': $returned="sex"; break;
        case '14006006': $returned="courtship"; break;
        case '14007000': $returned="family planning"; break;
        case '14008000': $returned="health insurance"; break;
        case '14009000': $returned="homelessness"; break;
        case '14010000': $returned="minority group"; break;
        case '14010001': $returned="gays and lesbians"; break;
        case '14010002': $returned="national or ethnic minority"; break;
        case '14011000': $returned="pornography"; break;
        case '14012000': $returned="poverty"; break;
        case '14013000': $returned="prostitution"; break;
        case '14014000': $returned="racism"; break;
        case '14015000': $returned="welfare"; break;
        case '14016000': $returned="abortion"; break;
        case '14017000': $returned="missing person"; break;
        case '14017001': $returned="missing due to hostilities"; break;
        case '14018000': $returned="long term care"; break;
        case '14019000': $returned="juvenile delinquency"; break;
        case '14020000': $returned="nuclear radiation victims"; break;
        case '14021000': $returned="slavery"; break;
        case '14022000': $returned="abusive behaviour"; break;
        case '14023000': $returned="death and dying"; break;
        case '14024000': $returned="people"; break;
        case '14024001': $returned="children"; break;
        case '14024002': $returned="infants"; break;
        case '14024003': $returned="teen-agers"; break;
        case '14024004': $returned="adults"; break;
        case '14024005': $returned="senior citizens"; break;
        case '14025000': $returned="social issues (general)"; break;
        case '14025001': $returned="social conditions"; break;
        case '14025002': $returned="social problems"; break;
        case '14025003': $returned="discrimination"; break;
        case '14025004': $returned="social services"; break;
        case '14025005': $returned="death penalty policies"; break;
        case '14026000': $returned="ordnance clearance"; break;
        case '14027000': $returned="reconstruction"; break;
        case '15000000': $returned="sport"; break;
        case '15001000': $returned="aero and aviation sport"; break;
        case '15001001': $returned="parachuting"; break;
        case '15001002': $returned="sky diving"; break;
        case '15002000': $returned="alpine skiing"; break;
        case '15002001': $returned="downhill"; break;
        case '15002002': $returned="giant slalom"; break;
        case '15002003': $returned="super G"; break;
        case '15002004': $returned="slalom"; break;
        case '15002005': $returned="combined"; break;
        case '15003000': $returned="American football"; break;
        case '15003001': $returned=" (US) National Football League (NFL) (North American) "; break;
        case '15003002': $returned="CFL"; break;
        case '15003003': $returned="AFL-DEPRECATED"; break;
        case '15004000': $returned="archery"; break;
        case '15004001': $returned="FITA / Outdoor target archery"; break;
        case '15004002': $returned="crossbow shooting"; break;
        case '15005000': $returned="athletics, track and field"; break;
        case '15005001': $returned="100 m"; break;
        case '15005002': $returned="200 m"; break;
        case '15005003': $returned="400 m"; break;
        case '15005004': $returned="800 m"; break;
        case '15005005': $returned="1000 m"; break;
        case '15005006': $returned="1500 m"; break;
        case '15005007': $returned="mile"; break;
        case '15005008': $returned="2000 m"; break;
        case '15005009': $returned="3000 m"; break;
        case '15005010': $returned="5000 m"; break;
        case '15005011': $returned="10,000 m"; break;
        case '15005012': $returned="20 km"; break;
        case '15005013': $returned="one hour"; break;
        case '15005014': $returned="25000"; break;
        case '15005015': $returned="30000"; break;
        case '15005016': $returned="110 m hurdles"; break;
        case '15005017': $returned="400 m hurdles"; break;
        case '15005018': $returned="3000 m steeplechase"; break;
        case '15005019': $returned="high jump"; break;
        case '15005020': $returned="pole vault"; break;
        case '15005021': $returned="long jump"; break;
        case '15005022': $returned="triple jump"; break;
        case '15005023': $returned="shot put"; break;
        case '15005024': $returned="discus throw"; break;
        case '15005025': $returned="hammer throw"; break;
        case '15005026': $returned="javelin throw"; break;
        case '15005027': $returned="decathlon"; break;
        case '15005028': $returned="4x100 m"; break;
        case '15005029': $returned="4x200 m"; break;
        case '15005030': $returned="4x400 m"; break;
        case '15005031': $returned="4x800 m"; break;
        case '15005032': $returned="4x1500 m"; break;
        case '15005033': $returned="walk 1 h"; break;
        case '15005034': $returned="walk 2 h"; break;
        case '15005035': $returned="10 km walk"; break;
        case '15005036': $returned="15 km walk"; break;
        case '15005037': $returned="20 km walk"; break;
        case '15005038': $returned="30 km walk"; break;
        case '15005039': $returned="50 km walk"; break;
        case '15005040': $returned="100 m hurdles"; break;
        case '15005041': $returned="5 km walk"; break;
        case '15005042': $returned="heptathlon"; break;
        case '15005043': $returned="1500 m walk"; break;
        case '15005044': $returned="2000 m walk"; break;
        case '15005045': $returned="3000 m walk"; break;
        case '15005046': $returned="50 m"; break;
        case '15005047': $returned="50 m hurdles"; break;
        case '15005048': $returned="50 yards"; break;
        case '15005049': $returned="50 yard hurdles"; break;
        case '15005050': $returned="60 m"; break;
        case '15005051': $returned="60 m hurdles"; break;
        case '15005052': $returned="60 yards"; break;
        case '15005053': $returned="60 yard hurdles"; break;
        case '15005054': $returned="100 yards"; break;
        case '15005055': $returned="100 yard hurdles"; break;
        case '15005056': $returned="300 m"; break;
        case '15005057': $returned="300 yards"; break;
        case '15005058': $returned="440 yards"; break;
        case '15005059': $returned="500 m"; break;
        case '15005060': $returned="500 yards"; break;
        case '15005061': $returned="600 m"; break;
        case '15005062': $returned="600 yards"; break;
        case '15005063': $returned="880 yards"; break;
        case '15005064': $returned="1000 yards"; break;
        case '15005065': $returned="2 miles"; break;
        case '15005066': $returned="3 miles"; break;
        case '15005067': $returned="6 miles"; break;
        case '15005068': $returned="4x1 mile"; break;
        case '15005069': $returned="pentathlon"; break;
        case '15006000': $returned="badminton"; break;
        case '15007000': $returned="baseball"; break;
        case '15007001': $returned=" Major League Baseball (North American Professional) - American League "; break;
        case '15007002': $returned=" Major League Baseball (North American Professional) - National League "; break;
        case '15007003': $returned=" Major League Baseball (North American Professional) - Special (e.g. All-Star, World Series) "; break;
        case '15007004': $returned="rubberball baseball"; break;
        case '15007005': $returned="Major League Baseball Playoffs"; break;
        case '15007006': $returned="World Series"; break;
        case '15008000': $returned="basketball"; break;
        case '15008001': $returned=" National Basketball Association (North American Professional) "; break;
        case '15008002': $returned="professional - Women general"; break;
        case '15008003': $returned="Swiss netball"; break;
        case '15008004': $returned="German netball"; break;
        case '15008005': $returned="Dutch netball"; break;
        case '15009000': $returned="biathlon"; break;
        case '15009001': $returned="7.5 km"; break;
        case '15009002': $returned="10 km"; break;
        case '15009003': $returned="15 km"; break;
        case '15009004': $returned="20 km"; break;
        case '15009005': $returned="4x7.5 km relay"; break;
        case '15009006': $returned="12.5 km pursuit"; break;
        case '15010000': $returned="billiards, snooker and pool"; break;
        case '15010001': $returned="8 ball"; break;
        case '15010002': $returned="9 ball"; break;
        case '15010003': $returned="14.1"; break;
        case '15010004': $returned="continuous-DEPRECATED"; break;
        case '15010005': $returned="other-DEPRECATED"; break;
        case '15010006': $returned="snooker"; break;
        case '15011000': $returned="bobsleigh"; break;
        case '15011001': $returned="two-man sled"; break;
        case '15011002': $returned="four-man sled"; break;
        case '15012000': $returned="bowling"; break;
        case '15013000': $returned="bowls and petanque"; break;
        case '15014000': $returned="boxing"; break;
        case '15014001': $returned="super-heavyweight"; break;
        case '15014002': $returned="heavyweight"; break;
        case '15014003': $returned="cruiserweight"; break;
        case '15014004': $returned="light-heavyweight"; break;
        case '15014005': $returned="super-middleweight"; break;
        case '15014006': $returned="middleweight"; break;
        case '15014007': $returned="light-middleweight"; break;
        case '15014008': $returned="welterweight"; break;
        case '15014009': $returned="light-welterweight"; break;
        case '15014010': $returned="lightweight"; break;
        case '15014011': $returned="super-featherweight"; break;
        case '15014012': $returned="featherweight"; break;
        case '15014013': $returned="super-bantamweight"; break;
        case '15014014': $returned="bantamweight"; break;
        case '15014015': $returned="super-flyweight"; break;
        case '15014016': $returned="flyweight"; break;
        case '15014017': $returned="light flyweight"; break;
        case '15014018': $returned="straw"; break;
        case '15014019': $returned="IBF"; break;
        case '15014020': $returned="WBA"; break;
        case '15014021': $returned="WBC"; break;
        case '15014022': $returned="WBO"; break;
        case '15014023': $returned="French boxing"; break;
        case '15014024': $returned="Thai boxing"; break;
        case '15015000': $returned="canoeing and kayaking"; break;
        case '15015001': $returned="Slalom"; break;
        case '15015002': $returned="200 m"; break;
        case '15015003': $returned="500 m"; break;
        case '15015004': $returned="1000 m"; break;
        case '15015005': $returned="K1"; break;
        case '15015006': $returned="K2"; break;
        case '15015007': $returned="K4"; break;
        case '15015008': $returned="C1"; break;
        case '15015009': $returned="C2"; break;
        case '15015010': $returned="C4"; break;
        case '15015011': $returned="canoe sailing"; break;
        case '15015012': $returned="pontoniering"; break;
        case '15016000': $returned="climbing"; break;
        case '15016001': $returned="mountaineering"; break;
        case '15016002': $returned="sport climbing"; break;
        case '15017000': $returned="cricket"; break;
        case '15018000': $returned="curling"; break;
        case '15018001': $returned="icestock sport"; break;
        case '15019000': $returned="cycling"; break;
        case '15019001': $returned="track"; break;
        case '15019002': $returned="pursuit"; break;
        case '15019003': $returned="Olympic sprint"; break;
        case '15019004': $returned="sprint"; break;
        case '15019005': $returned="Keirin"; break;
        case '15019006': $returned="points race"; break;
        case '15019007': $returned="Madison race"; break;
        case '15019008': $returned="500 m time trial"; break;
        case '15019009': $returned="1 km time trial"; break;
        case '15019010': $returned="one hour"; break;
        case '15019011': $returned="road race"; break;
        case '15019012': $returned="road time trial"; break;
        case '15019013': $returned="staging race"; break;
        case '15019014': $returned="cyclo-cross"; break;
        case '15019015': $returned="Vtt"; break;
        case '15019016': $returned="Vtt-cross"; break;
        case '15019017': $returned="Vtt-downhill"; break;
        case '15019018': $returned="bi-crossing"; break;
        case '15019019': $returned="trial"; break;
        case '15019020': $returned="artistic cycling"; break;
        case '15019021': $returned="cycle ball"; break;
        case '15020000': $returned="dancing"; break;
        case '15021000': $returned="diving"; break;
        case '15021001': $returned="10 m platform"; break;
        case '15021002': $returned="10 m platform synchronised"; break;
        case '15021003': $returned="3 m springboard"; break;
        case '15021004': $returned="3 m springboard synchronised"; break;
        case '15021005': $returned="subaquatics"; break;
        case '15021006': $returned="scuba diving"; break;
        case '15022000': $returned="equestrian"; break;
        case '15022001': $returned="three-day event"; break;
        case '15022002': $returned="dressage"; break;
        case '15022003': $returned="jumping"; break;
        case '15022004': $returned="cross country"; break;
        case '15023000': $returned="fencing"; break;
        case '15023001': $returned="epee"; break;
        case '15023002': $returned="foil"; break;
        case '15023003': $returned="sabre"; break;
        case '15024000': $returned="field Hockey"; break;
        case '15024001': $returned="roll hockey"; break;
        case '15025000': $returned="figure Skating"; break;
        case '15025001': $returned="singles"; break;
        case '15025002': $returned="pairs"; break;
        case '15025003': $returned="ice dance"; break;
        case '15026000': $returned="freestyle Skiing"; break;
        case '15026001': $returned="moguls"; break;
        case '15026002': $returned="aerials"; break;
        case '15026003': $returned="artistic skiing"; break;
        case '15027000': $returned="golf"; break;
        case '15028000': $returned="gymnastics"; break;
        case '15028001': $returned="floor exercise"; break;
        case '15028002': $returned="vault"; break;
        case '15028003': $returned="pommel horse"; break;
        case '15028004': $returned="uneven bars"; break;
        case '15028005': $returned="parallel bars"; break;
        case '15028006': $returned="horizontal bar"; break;
        case '15028007': $returned="rings"; break;
        case '15028008': $returned="beam"; break;
        case '15028009': $returned="rhythmic"; break;
        case '15028010': $returned="clubs"; break;
        case '15028011': $returned="hoop"; break;
        case '15028012': $returned="ribbon"; break;
        case '15028013': $returned="rope"; break;
        case '15028014': $returned="ball"; break;
        case '15028015': $returned="trampoline"; break;
        case '15029000': $returned="handball (team)"; break;
        case '15030000': $returned="horse racing, harness racing"; break;
        case '15030001': $returned="flat racing"; break;
        case '15030002': $returned="steeple chase"; break;
        case '15030003': $returned="trotting"; break;
        case '15030004': $returned="cross country"; break;
        case '15031000': $returned="ice hockey"; break;
        case '15031001': $returned="National Hockey League (North American)"; break;
        case '15031002': $returned="sledge hockey"; break;
        case '15032000': $returned="Jai Alai (Pelota)"; break;
        case '15032001': $returned="fronton"; break;
        case '15032002': $returned="jai-alai"; break;
        case '15032003': $returned="left wall"; break;
        case '15032004': $returned="trinquet"; break;
        case '15032005': $returned="rebot"; break;
        case '15032006': $returned="chistera ancha"; break;
        case '15032007': $returned="chistera corta"; break;
        case '15032008': $returned="bare hand"; break;
        case '15032009': $returned="pala-ancha"; break;
        case '15032010': $returned="pala-corta"; break;
        case '15032011': $returned="pasaka"; break;
        case '15032012': $returned="xare"; break;
        case '15033000': $returned="judo"; break;
        case '15033001': $returned="heavyweight"; break;
        case '15033002': $returned="half-heavyweight"; break;
        case '15033003': $returned="middleweight"; break;
        case '15033004': $returned="half-middleweight"; break;
        case '15033005': $returned="half-lightweight"; break;
        case '15033006': $returned="lightweight"; break;
        case '15033007': $returned="extra lightweight"; break;
        case '15034000': $returned="karate"; break;
        case '15034001': $returned="sparring"; break;
        case '15034002': $returned="formal exercise-DEPRECATED"; break;
        case '15035000': $returned="lacrosse"; break;
        case '15036000': $returned="luge"; break;
        case '15036001': $returned="singles"; break;
        case '15036002': $returned="doubles"; break;
        case '15037000': $returned="marathon"; break;
        case '15038000': $returned="modern pentathlon"; break;
        case '15038001': $returned="running"; break;
        case '15038002': $returned="shooting"; break;
        case '15038003': $returned="swimming"; break;
        case '15038004': $returned="fencing"; break;
        case '15038005': $returned="showjumping"; break;
        case '15039000': $returned="motor racing"; break;
        case '15039001': $returned="Formula One"; break;
        case '15039002': $returned="F3000"; break;
        case '15039003': $returned="endurance"; break;
        case '15039004': $returned="Indy"; break;
        case '15039005': $returned="CART"; break;
        case '15039006': $returned="NHRA"; break;
        case '15039007': $returned="NASCAR"; break;
        case '15039008': $returned="TRUCKI"; break;
        case '15040000': $returned="motor rallying"; break;
        case '15040001': $returned="rallying"; break;
        case '15040002': $returned="pursuit"; break;
        case '15040003': $returned="rallycross"; break;
        case '15041000': $returned="motorcycling"; break;
        case '15041001': $returned="speed-Grand-Prix"; break;
        case '15041002': $returned="enduro"; break;
        case '15041003': $returned="grass-track"; break;
        case '15041004': $returned="moto-ball"; break;
        case '15041005': $returned="moto-cross"; break;
        case '15041006': $returned="rallying"; break;
        case '15041007': $returned="trial"; break;
        case '15041008': $returned="endurance"; break;
        case '15041009': $returned="superbike"; break;
        case '15041010': $returned="125 cm3"; break;
        case '15041011': $returned="250 cm3"; break;
        case '15041012': $returned="500 cm3"; break;
        case '15041013': $returned="side-cars"; break;
        case '15041014': $returned="motoGP"; break;
        case '15042000': $returned="netball"; break;
        case '15043000': $returned="nordic skiing"; break;
        case '15043001': $returned="cross-country"; break;
        case '15043002': $returned="5 km classical time"; break;
        case '15043003': $returned="10 km classical style"; break;
        case '15043004': $returned="10 km pursuit free style"; break;
        case '15043005': $returned="15 km classical style"; break;
        case '15043006': $returned="15 km pursuit free style"; break;
        case '15043007': $returned="10 km + 15 km combined"; break;
        case '15043008': $returned="30 km classical style"; break;
        case '15043009': $returned="30km free style"; break;
        case '15043010': $returned="50 km free style"; break;
        case '15043011': $returned="4x5 km relay"; break;
        case '15043012': $returned="4x10 km relay"; break;
        case '15043013': $returned="nordic combined"; break;
        case '15043014': $returned="raid"; break;
        case '15043015': $returned="5 km pursuit free style"; break;
        case '15043016': $returned="1.5 km sprint free"; break;
        case '15043017': $returned="50 km classic style"; break;
        case '15044000': $returned="orienteering"; break;
        case '15044001': $returned="ski orienteering"; break;
        case '15045000': $returned="polo"; break;
        case '15046000': $returned="power boating"; break;
        case '15046001': $returned="F1"; break;
        case '15046002': $returned="F2"; break;
        case '15047000': $returned="rowing"; break;
        case '15047001': $returned="single sculls"; break;
        case '15047002': $returned="double sculls"; break;
        case '15047003': $returned="quadruple sculls"; break;
        case '15047004': $returned="coxless pair"; break;
        case '15047005': $returned="coxless four"; break;
        case '15047006': $returned="eight"; break;
        case '15047007': $returned="lightweight"; break;
        case '15048000': $returned="rugby league"; break;
        case '15049000': $returned="rugby union"; break;
        case '15049001': $returned="rugby 7"; break;
        case '15050000': $returned="sailing"; break;
        case '15050001': $returned="Tornado"; break;
        case '15050002': $returned="soling"; break;
        case '15050003': $returned="49er"; break;
        case '15050004': $returned="Europe"; break;
        case '15050005': $returned="Laser"; break;
        case '15050006': $returned="470"; break;
        case '15050007': $returned="Finn"; break;
        case '15050008': $returned="Star"; break;
        case '15050009': $returned="flying dutchmann"; break;
        case '15050010': $returned="505"; break;
        case '15050011': $returned="staging race"; break;
        case '15050012': $returned="around the world"; break;
        case '15050013': $returned="monohull"; break;
        case '15050014': $returned="multihulls"; break;
        case '15050015': $returned="yngling"; break;
        case '15050016': $returned="mistral"; break;
        case '15051000': $returned="shooting"; break;
        case '15051001': $returned="10 m air rifle"; break;
        case '15051002': $returned="10 m air pistol"; break;
        case '15051003': $returned="10 m running target"; break;
        case '15051004': $returned="25 m rapid fire pistol"; break;
        case '15051005': $returned="25 m sport pistol"; break;
        case '15051006': $returned="50 m free pistol"; break;
        case '15051007': $returned="50 m free rifle prone"; break;
        case '15051008': $returned="50 m free rifle 3x40"; break;
        case '15051009': $returned="50 m sport rifle 3x20"; break;
        case '15051010': $returned="trap"; break;
        case '15051011': $returned="double trap"; break;
        case '15051012': $returned="skeet"; break;
        case '15052000': $returned="ski jumping"; break;
        case '15052001': $returned="K90 jump"; break;
        case '15052002': $returned="K120 jump"; break;
        case '15052003': $returned="K180 (flying jump)"; break;
        case '15053000': $returned="snow boarding"; break;
        case '15053001': $returned="giant slalom"; break;
        case '15053002': $returned="half-pipe"; break;
        case '15054000': $returned="soccer"; break;
        case '15055000': $returned="softball"; break;
        case '15056000': $returned="speed skating"; break;
        case '15056001': $returned="500 m"; break;
        case '15056002': $returned="1000 m"; break;
        case '15056003': $returned="1500 m"; break;
        case '15056004': $returned="3000 m"; break;
        case '15056005': $returned="5000 m"; break;
        case '15056006': $returned="10000 m"; break;
        case '15056007': $returned="Short-track"; break;
        case '15056008': $returned="st 500 m"; break;
        case '15056009': $returned="st 1000m"; break;
        case '15056010': $returned="st 1500m"; break;
        case '15056011': $returned="st 3000m"; break;
        case '15056012': $returned="st 3000m relay"; break;
        case '15056013': $returned="st 5000m"; break;
        case '15056014': $returned="st 5000m relay"; break;
        case '15057000': $returned="speedway"; break;
        case '15058000': $returned="sports organisations"; break;
        case '15058001': $returned="IOC"; break;
        case '15058002': $returned="international federation"; break;
        case '15058003': $returned="continental federation"; break;
        case '15058004': $returned="national federation"; break;
        case '15058005': $returned="GAISF"; break;
        case '15059000': $returned="squash"; break;
        case '15060000': $returned="sumo wrestling"; break;
        case '15061000': $returned="surfing"; break;
        case '15062000': $returned="swimming"; break;
        case '15062001': $returned="50 m freestyle"; break;
        case '15062002': $returned="100 m freestyle"; break;
        case '15062003': $returned="200 m freestyle"; break;
        case '15062004': $returned="400 m freestyle"; break;
        case '15062005': $returned="800 m freestyle"; break;
        case '15062006': $returned="1500 m freestyle"; break;
        case '15062007': $returned="relay 4x50 m freestyle"; break;
        case '15062008': $returned="relay 4x100 m freestyle"; break;
        case '15062009': $returned="relay 4x200 m freestyle"; break;
        case '15062010': $returned="50 m backstroke"; break;
        case '15062011': $returned="100 m backstroke"; break;
        case '15062012': $returned="200 m backstroke"; break;
        case '15062013': $returned="50 m breaststroke"; break;
        case '15062014': $returned="100 m breaststroke"; break;
        case '15062015': $returned="200 m breaststroke"; break;
        case '15062016': $returned="50 m butterfly"; break;
        case '15062017': $returned="100 m butterfly"; break;
        case '15062018': $returned="200 m butterfly"; break;
        case '15062019': $returned="100 m medley"; break;
        case '15062020': $returned="200 m medley"; break;
        case '15062021': $returned="400 m medley"; break;
        case '15062022': $returned="relay 4x50 m medlay"; break;
        case '15062023': $returned="relay4x100 m medley"; break;
        case '15062024': $returned="short course"; break;
        case '15062025': $returned="synchronised technical routine"; break;
        case '15062026': $returned="synchronised free routine"; break;
        case '15063000': $returned="table tennis"; break;
        case '15064000': $returned="Taekwon-Do"; break;
        case '15064001': $returned="under 49 kg"; break;
        case '15064002': $returned="under 58 kg"; break;
        case '15064003': $returned="49-57 kg"; break;
        case '15064004': $returned="58-68 kg"; break;
        case '15064005': $returned="57-67 kg"; break;
        case '15064006': $returned="68-80 kg"; break;
        case '15064007': $returned="over 67 kg"; break;
        case '15064008': $returned="over 80 kg"; break;
        case '15065000': $returned="tennis"; break;
        case '15065001': $returned="soft tennis"; break;
        case '15066000': $returned="triathlon"; break;
        case '15066001': $returned="triathlon swimming"; break;
        case '15066002': $returned="triathlon cycling"; break;
        case '15066003': $returned="triathlon run"; break;
        case '15067000': $returned="volleyball"; break;
        case '15067001': $returned="beach volleyball"; break;
        case '15068000': $returned="water polo"; break;
        case '15069000': $returned="water skiing"; break;
        case '15069001': $returned="slalom"; break;
        case '15069002': $returned="trick"; break;
        case '15069003': $returned="jump"; break;
        case '15069004': $returned="combined"; break;
        case '15070000': $returned="weightlifting"; break;
        case '15070001': $returned="snatch"; break;
        case '15070002': $returned="clean and jerk"; break;
        case '15070003': $returned="48 kg"; break;
        case '15070004': $returned="53 kg"; break;
        case '15070005': $returned="63 kg"; break;
        case '15070006': $returned="75 kg"; break;
        case '15070007': $returned="over 75 kg"; break;
        case '15070008': $returned="56 kg"; break;
        case '15070009': $returned="62 kg"; break;
        case '15070010': $returned="69 kg"; break;
        case '15070011': $returned="77 kg"; break;
        case '15070012': $returned="85 kg"; break;
        case '15070013': $returned="94 kg"; break;
        case '15070014': $returned="105 kg"; break;
        case '15070015': $returned="over 105 kg"; break;
        case '15070016': $returned="powerlifting"; break;
        case '15071000': $returned="windsurfing"; break;
        case '15071001': $returned="ocean"; break;
        case '15071002': $returned="lake"; break;
        case '15071003': $returned="river"; break;
        case '15071004': $returned="land"; break;
        case '15072000': $returned="wrestling"; break;
        case '15072001': $returned="freestyle"; break;
        case '15072002': $returned="greco-roman"; break;
        case '15072003': $returned="over 130 kg"; break;
        case '15072004': $returned="130 kg"; break;
        case '15072005': $returned="97 kg"; break;
        case '15072006': $returned="85 kg"; break;
        case '15072007': $returned="76 kg"; break;
        case '15072008': $returned="69 kg"; break;
        case '15072009': $returned="63 kg"; break;
        case '15072010': $returned="58 kg"; break;
        case '15072011': $returned="54 kg"; break;
        case '15072012': $returned="Swiss wrestling"; break;
        case '15073000': $returned="sports event"; break;
        case '15073001': $returned="Summer Olympics"; break;
        case '15073002': $returned="Winter Olympics"; break;
        case '15073003': $returned="Summer universiade"; break;
        case '15073004': $returned="Winter Universiade"; break;
        case '15073005': $returned="Commonwealth Games"; break;
        case '15073006': $returned="Winter Goodwill Games"; break;
        case '15073007': $returned="Summer Asian Games"; break;
        case '15073008': $returned="Winter Asian Games"; break;
        case '15073009': $returned="Panamerican Games"; break;
        case '15073010': $returned="African Games"; break;
        case '15073011': $returned="Mediterranean Games"; break;
        case '15073012': $returned="SouthEast Asiatic Games"; break;
        case '15073013': $returned="PanPacific Games"; break;
        case '15073014': $returned="SouthPacific Games"; break;
        case '15073015': $returned="PanArabic Games"; break;
        case '15073016': $returned="Summer Goodwill Games"; break;
        case '15073017': $returned="World games"; break;
        case '15073018': $returned="World Cup"; break;
        case '15073019': $returned="intercontinental cup"; break;
        case '15073020': $returned="continental cup"; break;
        case '15073021': $returned="international cup"; break;
        case '15073022': $returned="National Cup"; break;
        case '15073023': $returned="interregional cup"; break;
        case '15073024': $returned="regional cup"; break;
        case '15073025': $returned="league cup"; break;
        case '15073026': $returned="world championship"; break;
        case '15073027': $returned="intercontinental championship"; break;
        case '15073028': $returned="continental championship 1st level"; break;
        case '15073029': $returned="continental championship 2nd level"; break;
        case '15073030': $returned="continental championship 3rd level"; break;
        case '15073031': $returned="national championship 1st level"; break;
        case '15073032': $returned="national championship 2nd level"; break;
        case '15073033': $returned="national championship3rdlevel"; break;
        case '15073034': $returned="national championship 4th level"; break;
        case '15073035': $returned="regional championship"; break;
        case '15073036': $returned="Grand Prix"; break;
        case '15073037': $returned="intercontinental tournament"; break;
        case '15073038': $returned="continental tournament"; break;
        case '15073039': $returned="international tournament"; break;
        case '15073040': $returned="national tournament"; break;
        case '15073041': $returned="inter-nations competition"; break;
        case '15073042': $returned="inter-clubs competition"; break;
        case '15073043': $returned="friendly competition"; break;
        case '15073044': $returned="all-stars competition"; break;
        case '15073045': $returned="exhibition"; break;
        case '15073046': $returned="Super Bowl"; break;
        case '15073047': $returned="paralympic games"; break;
        case '15074000': $returned="rodeo"; break;
        case '15074001': $returned="barrel racing"; break;
        case '15074002': $returned="calf roping"; break;
        case '15074003': $returned="bull riding"; break;
        case '15074004': $returned="bulldogging"; break;
        case '15074005': $returned="saddle bronc"; break;
        case '15074006': $returned="bareback"; break;
        case '15074007': $returned="goat roping"; break;
        case '15075000': $returned="mini golf sport"; break;
        case '15076000': $returned="bandy"; break;
        case '15077000': $returned="flying disc"; break;
        case '15077001': $returned="ultimate"; break;
        case '15077002': $returned="guts"; break;
        case '15077003': $returned="overall"; break;
        case '15077004': $returned="distance"; break;
        case '15077005': $returned="discathon"; break;
        case '15077006': $returned="DDC"; break;
        case '15077007': $returned="SCF"; break;
        case '15077008': $returned="freestyle"; break;
        case '15077009': $returned="accuracy"; break;
        case '15077010': $returned="disc golf"; break;
        case '15078000': $returned="floorball"; break;
        case '15079000': $returned="casting"; break;
        case '15080000': $returned="tug-of-war"; break;
        case '15081000': $returned="croquette"; break;
        case '15082000': $returned="dog racing"; break;
        case '15082001': $returned="sled"; break;
        case '15082002': $returned="oval track"; break;
        case '15083000': $returned="skeleton"; break;
        case '15084000': $returned="Australian rules football"; break;
        case '15085000': $returned="Canadian football"; break;
        case '15086000': $returned="duathlon"; break;
        case '15087000': $returned="hornuss"; break;
        case '15088000': $returned="fist ball"; break;
        case '15089000': $returned="inline skating"; break;
        case '15090000': $returned="grass ski"; break;
        case '15091000': $returned="snowbiking"; break;
        case '15092000': $returned="twirling"; break;
        case '15093000': $returned="kendo"; break;
        case '15094000': $returned="jukendo"; break;
        case '15095000': $returned="naginata"; break;
        case '15096000': $returned="kyudo"; break;
        case '15097000': $returned="kabaddi"; break;
        case '15098000': $returned="sepak takraw"; break;
        case '15099000': $returned="wushu"; break;
        case '15100000': $returned="darts"; break;
        case '15101000': $returned="bodybuilding"; break;
        case '15102000': $returned="sports disciplinary action"; break;
        case '15103000': $returned="sports awards"; break;
        case '16000000': $returned="unrest, conflicts and war"; break;
        case '16001000': $returned="act of terror"; break;
        case '16002000': $returned="armed conflict"; break;
        case '16003000': $returned="civil unrest"; break;
        case '16003001': $returned="revolutions"; break;
        case '16003002': $returned="rebellions"; break;
        case '16003003': $returned="political dissent"; break;
        case '16003004': $returned="religious conflict"; break;
        case '16003005': $returned="social conflict"; break;
        case '16004000': $returned="coup d'etat"; break;
        case '16005000': $returned="guerrilla activity"; break;
        case '16005001': $returned="bioterrorism"; break;
        case '16005002': $returned="bombings"; break;
        case '16006000': $returned="massacre"; break;
        case '16006001': $returned="genocide"; break;
        case '16007000': $returned="riots"; break;
        case '16008000': $returned="demonstration"; break;
        case '16009000': $returned="war"; break;
        case '16009001': $returned="civil war"; break;
        case '16009002': $returned="international military intervention"; break;
        case '16009003': $returned="prisoners and detainees"; break;
        case '16010000': $returned="conflict (general)"; break;
        case '16010001': $returned="peacekeeping force"; break;
        case '16011000': $returned="crisis"; break;
        case '16012000': $returned="weaponry"; break;
        case '17000000': $returned="weather"; break;
        case '17001000': $returned="forecast"; break;
        case '17002000': $returned="global change"; break;
        case '17003000': $returned="report"; break;
        case '17003001': $returned="weather news"; break;
        case '17004000': $returned="statistic"; break;
        case '17005000': $returned="warning"; break;
        default:
          $returned="unknown subject code";
          break;
      }
      return($returned);
    }

    static function attributesLabel($attributeCode)
    {
      if(is_string($attributeCode))
      {
        @$attributeCode=(int)$attributeCode;
      }

      switch($attributeCode)
      {
        case 001: $returned="Current"; break;
        case 002: $returned="Analysis"; break;
        case 003: $returned="Archive material"; break;
        case 004: $returned="Background"; break;
        case 005: $returned="Feature"; break;
        case 006: $returned="Forecast"; break;
        case 007: $returned="History"; break;
        case 008: $returned="Obituary"; break;
        case 009: $returned="Opinion"; break;
        case 010: $returned="Polls & Surveys"; break;
        case 011: $returned="Profile"; break;
        case 012: $returned="Results Listings & Tables"; break;
        case 013: $returned="Side bar & Supporting information"; break;
        case 014: $returned="Summary"; break;
        case 015: $returned="Transcript & Verbatim"; break;
        case 016: $returned="Interview"; break;
        case 017: $returned="From the Scene"; break;
        case 018: $returned="Retrospective"; break;
        case 019: $returned="Statistics"; break;
        case 020: $returned="Update"; break;
        case 021: $returned="Wrap-up"; break;
        case 022: $returned="Press Release"; break;
        default:
          $returned="unknown code ".$attributeCode;
          break;
      }
      return($returned);
    }

    function __destruct()
    {
      parent::__destruct();
    }
  }

?>
