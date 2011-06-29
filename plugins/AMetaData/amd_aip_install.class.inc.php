<?php
/*
 * -----------------------------------------------------------------------------
 * Plugin Name: Advanced MetaData
 * -----------------------------------------------------------------------------
 * Author     : Grum
 *   email    : grum@piwigo.org
 *   website  : http://photos.grum.fr
 *   PWG user : http://forum.piwigo.org/profile.php?id=3706
 *
 *   << May the Little SpaceFrog be with you ! >>
 *
 * -----------------------------------------------------------------------------
 *
 * See main.inc.php for release information
 *
 * AIPInstall class => install process page when the plugin is used for the
 *                     first time
 *
 * -----------------------------------------------------------------------------
 */


if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include_once('amd_root.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTables.class.inc.php');
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

class AMD_AIPInstall extends AMD_root
{
  protected $tabsheet;

  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);
    $this->loadConfig();
    $this->initEvents();

    $this->tabsheet = new tabsheet();
    $this->tabsheet->add('install',
                          l10n('g003_install'),
                          $this->getAdminLink()."&amp;f_tabsheet=install");
  }

  public function __destruct()
  {
    unset($this->tabsheet);
    parent::__destruct();
  }

  /*
    initialize events call for the plugin
  */
  public function initEvents()
  {
    parent::initEvents();
    add_event_handler('loc_end_page_header', array(&$this->css, 'applyCSS'));
  }

  /*
    display administration page
  */
  public function manage()
  {
    global $template;

    $this->checkRequest();
    $this->returnAjaxContent();

    $template->set_filename('plugin_admin_content', dirname($this->getFileLocation())."/admin/amd_admin.tpl");

    $this->tabsheet->select($_REQUEST['f_tabsheet']);
    $this->tabsheet->assign();
    $selected_tab=$this->tabsheet->get_selected();
    $template->assign($this->tabsheet->get_titlename(), "[".$selected_tab['caption']."]");

    $this->displayInstallPage();

    $pluginInfo=array(
      'AMD_VERSION' => "<i>".$this->getPluginName()."</i> ".l10n('g003_version').AMD_VERSION,
      'AMD_PAGE' => $_REQUEST['f_tabsheet'],
      'PATH' => AMD_PATH
    );

    $template->assign('plugin', $pluginInfo);

    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }



  /**
   * check the $_REQUEST values and set default values
   *
   */
  protected function checkRequest()
  {
    $_REQUEST['f_tabsheet']='install';

    if(!isset($_REQUEST['ajaxfct'])) return(false);

    /*
     * check admin.install.chooseInterface values
     */
    if($_REQUEST['ajaxfct']=="admin.install.chooseInterface")
    {
       if(!isset($_REQUEST['interfaceMode'])) $_REQUEST['interfaceMode']='';

       if(!($_REQUEST['interfaceMode']=="basic" or
            $_REQUEST['interfaceMode']=="advanced")) $_REQUEST['ajaxfct']='';
    }
  }



  /**
   * return ajax content
   */
  protected function returnAjaxContent()
  {
    global $ajax, $template;

    if(isset($_REQUEST['ajaxfct']))
    {
      //$this->debug("AJAXFCT:".$_REQUEST['ajaxfct']);
      $result="<p class='errors'>An error has occured</p>";
      switch($_REQUEST['ajaxfct'])
      {
        case 'admin.install.chooseInterface':
          $result=$this->ajax_amd_admin_installChooseInterface($_REQUEST['interfaceMode']);
          break;
      }
      GPCAjax::returnResult($result);
    }
  }



  /**
   * display config page
   */
  protected function displayInstallPage()
  {
    global $template, $lang;


    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/amd_install_page.tpl');


    $help=Array(
      'g003_basic_mode_help' => GPCCore::BBtoHTML($lang['g003_basic_mode_help']),
      'g003_advanced_mode_help' => GPCCore::BBtoHTML($lang['g003_advanced_mode_help'])
    );


    $template->assign('help', $help);
    $template->assign('urlRequest', $this->getAdminLink());

    $template->assign_var_from_handle('AMD_BODY_PAGE', 'body_page');
  } //displayInstallPage



  /**
   * prepare the tables for the basic interface mode
   */
  protected function initializeDatabaseForBasicInterface()
  {
    $basicMeta=array(
      'magic.Author.Artist',
      'magic.Author.Comment',
      'magic.Author.Copyright',
      'magic.Author.ImageTitle',
      'magic.Author.Keywords',
      'magic.GPS.Altitude',
      'magic.GPS.Latitude',
      'magic.GPS.LatitudeNum',
      'magic.GPS.Localization',
      'magic.GPS.Longitude',
      'magic.GPS.LongitudeNum',
      'magic.Image.Dimension',
      'magic.Image.Height',
      'magic.Image.Width',
      'magic.Processing.OriginalFileName',
      'magic.Processing.PostProcessingDateTime',
      'magic.Processing.PostProcessingSoftware',
      'magic.Processing.Software',
      'magic.ShotInfo.DateTime',
      'magic.ShotInfo.Flash.RedEyeMode',
      'iptc.By-line',
      'iptc.By-line Title',
      'iptc.Caption/Abstract',
      'iptc.Category',
      'iptc.City',
      'iptc.Contact',
      'iptc.Content Location Code',
      'iptc.Content Location Name',
      'iptc.Copyright Notice',
      'iptc.Country/Primary Location Code',
      'iptc.Country/Primary Location Name',
      'iptc.Credit',
      'iptc.Date Created',
      'iptc.Date Sent',
      'iptc.Destination',
      'iptc.Digital Creation Date',
      'iptc.Digital Creation Time',
      'iptc.Edit Status',
      'iptc.Envelope Number',
      'iptc.Envelope Priority',
      'iptc.Expiration Date',
      'iptc.Expiration Time',
      'iptc.Fixture Identifier',
      'iptc.Headline',
      'iptc.Image Orientation',
      'iptc.Keywords',
      'iptc.Language Identifier',
      'iptc.Object Attribute Reference',
      'iptc.Object Cycle',
      'iptc.Object Name',
      'iptc.Object Type Reference',
      'iptc.Original Transmission Reference',
      'iptc.Originating Program',
      'iptc.Product I.D.',
      'iptc.Program Version',
      'iptc.Province/State',
      'iptc.Release Date',
      'iptc.Release Time',
      'iptc.Service Identifier',
      'iptc.Source',
      'iptc.Special Instructions',
      'iptc.Subject Reference',
      'iptc.Subject Reference[Detail Name]',
      'iptc.Subject Reference[IPR]',
      'iptc.Subject Reference[Matter Name]',
      'iptc.Subject Reference[Name]',
      'iptc.Subject Reference[Number]',
      'iptc.Sublocation',
      'iptc.Supplemental Category',
      'iptc.Time Created',
      'iptc.Time Sent',
      'iptc.Urgency',
      'iptc.Writer/Editor',
      'xmp.Iptc4xmpCore:CiAdrCity',
      'xmp.Iptc4xmpCore:CiAdrCtry',
      'xmp.Iptc4xmpCore:CiAdrExtadr',
      'xmp.Iptc4xmpCore:CiAdrPcode',
      'xmp.Iptc4xmpCore:CiEmailWork',
      'xmp.Iptc4xmpCore:CiTelWork',
      'xmp.Iptc4xmpCore:CiUrlWork',
      'xmp.Iptc4xmpCore:CountryCode',
      'xmp.Iptc4xmpCore:IntellectualGenre',
      'xmp.Iptc4xmpCore:Location',
      'xmp.Iptc4xmpCore:Scene',
      'xmp.aux:Firmware',
      'xmp.aux:Lens',
      'xmp.crs:Balance',
      'xmp.crs:CameraProfile',
      'xmp.crs:ColorNoiseReduction',
      'xmp.crs:Exposure',
      'xmp.crs:HasCrop',
      'xmp.crs:HasSettings',
      'xmp.crs:RawFileName',
      'xmp.crs:WhiteBalance',
      'xmp.dc:CreatorTool',
      'xmp.dc:Type',
      'xmp.dc:contributor',
      'xmp.dc:coverage',
      'xmp.dc:creator',
      'xmp.dc:description',
      'xmp.dc:format',
      'xmp.dc:identifier',
      'xmp.dc:language',
      'xmp.dc:publisher',
      'xmp.dc:relation',
      'xmp.dc:rights',
      'xmp.dc:source',
      'xmp.dc:subject',
      'xmp.dc:title',
      'xmp.photoshop:AuthorsPosition',
      'xmp.photoshop:CaptionWriter',
      'xmp.photoshop:Category',
      'xmp.photoshop:City',
      'xmp.photoshop:Country',
      'xmp.photoshop:Credit',
      'xmp.photoshop:DateCreated',
      'xmp.photoshop:Headline',
      'xmp.photoshop:ICCProfile',
      'xmp.photoshop:Instructions',
      'xmp.photoshop:Source',
      'xmp.photoshop:State',
      'xmp.photoshop:SupplementalCategories',
      'xmp.photoshop:TransmissionReference',
      'xmp.photoshop:Urgency',
      'xmp.tiff:Artist',
      'xmp.tiff:Copyright',
      'xmp.tiff:DateTime',
      'xmp.tiff:ImageDescription',
      'xmp.tiff:Software',
      'xmp.xmp:Advisory',
      'xmp.xmp:BaseURL',
      'xmp.xmp:CreateDate',
      'xmp.xmp:CreatorTool',
      'xmp.xmp:Identifier',
      'xmp.xmp:Label',
      'xmp.xmp:MetadataDate',
      'xmp.xmp:ModifyDate',
      'xmp.xmp:Nickname',
      'xmp.xmp:Rating',
      'xmp.xmpRights:Certificate',
      'xmp.xmpRights:Marked',
      'xmp.xmpRights:Owner',
      'xmp.xmpRights:UsageTerms',
      'xmp.xmpRights:WebStatement'
    );

    $sql="";
    foreach($basicMeta as $key=>$val)
    {
      $basicMeta[$key]="('$val', 0, -1)";
    }
    $sql="INSERT INTO `".$this->tables['selected_tags']."` VALUES ".implode(',', $basicMeta);
    pwg_query($sql);
  }

  /**
   * prepare the tables for the advanced interface mode
   */
  protected function initializeDatabaseForAdvancedInterface()
  {
    global $user;

    $listToAnalyze=Array(Array(), Array());
    /*
     * select 25 pictures into the caddie
     */
    $sql="SELECT ti.id, ti.path, ti.has_high
          FROM ".CADDIE_TABLE." tc
            LEFT JOIN ".IMAGES_TABLE." ti ON ti.id = tc.element_id
          WHERE tc.user_id = ".$user['id']."
            AND ti.id IS NOT NULL
          ORDER BY RAND() LIMIT 25;";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $listToAnalyze[0][]=$row;
        $listToAnalyze[1][]=$row['id'];
      }
    }
    /*
     * if caddie is empty, of is have less than 25 pictures, select other
     * pictures from the gallery
     */
    if(count($listToAnalyze[0])<25)
    {
      if(count($listToAnalyze[0])>0)
      {
        $excludeList="WHERE ti.id NOT IN(".implode(",", $listToAnalyze[1]).") ";
      }
      else
      {
        $excludeList="";
      }
      $sql="SELECT ti.id, ti.path, ti.has_high
            FROM ".IMAGES_TABLE." ti ".$excludeList."
            ORDER BY RAND() LIMIT ".(25-count($listToAnalyze[0])).";";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $listToAnalyze[0][]=$row;
        }
      }
    }

    /*
     * analyze the 25 selected pictures
     */
    if(count($listToAnalyze[0])>0)
    {
      // $path = path of piwigo's on the server filesystem
      $path=dirname(dirname(dirname(__FILE__)));

      foreach($listToAnalyze[0] as $val)
      {
        if($val['has_high']==='true' and $this->config['amd_UseMetaFromHD']=='y')
        {
          $this->analyzeImageFile($path."/".dirname($val['path'])."/pwg_high/".basename($val['path']), $val['id']);
        }
        else
        {
          $this->analyzeImageFile($path."/".$val['path'], $val['id']);
        }
      }
      $this->makeStatsConsolidation();
    }
  }



  /*
   *  ---------------------------------------------------------------------------
   * AJAX FUNCTIONS
   * ---------------------------------------------------------------------------
   */

  /**
   * set choice for plugin interface mode (basic/advanced)
   * @param String $interfaceMode : mode for the interface 'basic' or 'advanced'
   * @return String : ok or ko
   */
  protected function ajax_amd_admin_installChooseInterface($interfaceMode)
  {
    switch($interfaceMode)
    {
      case 'basic':
        $this->config['amd_FillDataBaseContinuously']='n';
        $this->initializeDatabaseForBasicInterface();
        break;
      case 'advanced':
        $this->initializeDatabaseForAdvancedInterface();
        break;
    }

    $this->config['newInstall']='n';
    $this->config['amd_InterfaceMode']=$interfaceMode;
    $this->saveConfig();

    return('ok');
  }

} //class


?>
