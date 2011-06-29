<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@grum.fr
    website  : http://photos.grum.fr
    PWG user : http://forum.piwigo.org/profile.php?id=3706

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  Provided classes :
  * RGB
    public functions :
      __construct($R, $G, $B)
      set($R, $G, $B)
      setInt($value)
      get($floatValue=false)
      getHexString()
      getInt()
      getHSV()
      setHSV(HSV $hsv)
    private functions :
      setProperty($property, $value)

  * HSV
    public functions :
      __construct($H, $S, $V)
      set($H, $S, $V)
      get()
      getRGB()
      setRGB(RGB $rgb)
    private functions :
      setProperty($property, $value)

  * ColorStat
    public functions :
    static getFileColors($fileName, $colorTable, $quality=1)
    static RGBtoHSV(RGB $RGB)
    static HSVtoRGB(HSV $HSV)
    static IntToRGB($rgb)
    static getColorTable($huePrec=10, $prec=10, $returnedType='HSV')
    static getColorFromTable(HSV $hsvObject, $colorTable)

  --------------------------------------------------------------------------- */

if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

/**
 * if DEBUG_MODE is set to true, the getFileColors function save a jpg file of
 * the 'viewed' image :
 *  - resampled file
 *  - color from the color table
 *
 * use it only for debug, or if you are curious about what the function really
 * see
 */
define('DEBUG_MODE', false);



/**
 * The RGB class allows to read & write a RGB value
 */
class RGB {
  protected $RGB = Array('R' => 0, 'G' => 0, 'B' => 0);

  public function __construct($R=0, $G=0, $B=0)
  {
    $this->set($R, $G, $B);
  }

  /**
   * set the R,G and B values
   *
   * @param Byte $R : the red value, between [0..255]
   * @param Byte $G : the green value, between [0..255]
   * @param Byte $B : the blue value, between [0..255]
   * @return Array('R'=>$R, 'G'=>$G, 'B'=>$B)
   */
  public function set($R, $G, $B)
  {
    $this->setProperty('R', $R);
    $this->setProperty('G', $G);
    $this->setProperty('B', $B);
    return($this->get());
  }

  /**
   * set RGB values from an Integer (0xFFFFFF : white value)
   *
   * @param Integer $value : the RGB value
   * @return Array('R'=>$R, 'G'=>$G, 'B'=>$B)
   */
  public function setInt($value)
  {
    $tmp=ColorStat::IntToRGB($value);
    $tmp2=$tmp->get();
    $this->set($tmp2['R'], $tmp2['G'], $tmp2['B']);
    unset($tmp2);
    unset($tmp);
  }

  /**
   * returns the current RGB values as array
   *
   * @param Boolean $floatValue : if set to true, values are returned as float
   *                              values between [0..1] otherwise values are
   *                              returned as integer between [0..255]
   * @return Array('R'=>$R, 'G'=>$G, 'B'=>$B)
   */
  public function get($floatValue=false)
  {
    if($floatValue)
    {
      return(
        Array(
          'R' => $this->RGB['R']/255,
          'G' => $this->RGB['G']/255,
          'B' => $this->RGB['B']/255,
        )
      );
    }
    else
    {
      return($this->RGB);
    }
  }


  /**
   * returns the current RGB values as hex string  ('FFFFFF' : white)
   *
   * @return String
   */
  public function getHexString()
  {
    return(sprintf('%02x%02x%02x', $this->RGB['R'], $this->RGB['G'], $this->RGB['B']));
  }

  /**
   * returns the current RGB values as integer  (0xFFFFFF : white)
   *
   * @return Integer
   */
  public function getInt()
  {
    return(  $this->RGB['R']<<16 + $this->RGB['G']<<8 + $this->RGB['B']);
  }


  /**
   * returns the current RGB values as a HSV object
   *
   * @return HSV
   */
  public function getHSV()
  {
    return(ColorStat::RGBtoHSV($this));
  }

  /**
   * set the RGB values from a HSV ojbect
   *
   * @param HSV $hsv : a HSV object
   */
  public function setHSV(HSV $hsv)
  {
    $tmp=ColorStat::HSVtoRGB($hsv);
    $tmp2=$tmp->get();
    $this->set($tmp2['R'], $tmp2['G'], $tmp2['B']);
    unset($tmp2);
    unset($tmp);
  }

  /**
   * set the RGB property
   *
   * @param String $property : 'R', 'G', 'B'
   * @param Integer $value : value between [0..255]
   * @return Integer : value of the property
   */
  private function setProperty($property, $value)
  {
    if($property=='R' or $property=='G' or $property=='B')
    {
      if($value<0) $value=0;
      if($value>255) $value=255;

      $this->RGB[$property]=$value;
      return($this->RGB[$property]);
    }
  }
}


/**
 * The HSV class allows to read & write a HSV value
 */
class HSV {
  protected $HSV = Array('H' => 0, 'S' => 0, 'V' => 0);

  public function __construct($H=0, $S=0, $V=0)
  {
    $this->set($H, $S, $V);
  }

  /**
   * set the H, S and V values
   *
   * @param Integer $H : the hue value, between [0..360]
   * @param Byte $S    : the saturation value, between [0..100]
   * @param Byte $V    : the value value, between [0..100]
   * @return Array('H'=>$H, 'S'=>$S, 'V'=>$V)
   */
  public function set($H, $S, $V)
  {
    $this->setProperty('H', $H);
    $this->setProperty('S', $S);
    $this->setProperty('V', $V);
    return($this->get());
  }

  /**
   * returns the current HSV values as array
   *
   * @return Array('H'=>$H, 'S'=>$S, 'V'=>$V)
   */
  public function get()
  {
    return($this->HSV);
  }

  /**
   * returns the current HSV values as a RGB object
   *
   * @return RGB
   */
  public function getRGB()
  {
    return(ColorStat::HSVtoRGB($this));
  }



  /**
   * set the HSV values from a RGB ojbect
   *
   * @param RGB $rgb : a RGB object
   */
  public function setRGB(RGB $rgb)
  {
    $tmp=ColorStat::RGBtoHSV($rgb);
    $tmp2=$tmp->get();
    $this->set($tmp2['H'], $tmp2['S'], $tmp2['V']);
    unset($tmp2);
    unset($tmp);
  }

  /**
   * set the HSV property
   *
   * @param String $property : 'H', 'S', 'V'
   * @param Integer $value : value between [0..255]
   * @return Integer : value of the property
   */
  private function setProperty($property, $value)
  {
    if($property=='H')
    {
      $this->HSV['H']=$value%360;
      return($this->HSV['H']);
    }
    elseif($property=='S' or $property=='V')
    {
      if($value<0) $value=0;
      if($value>100) $value=100;

      $this->HSV[$property]=$value;
      return($this->HSV[$property]);
    }
    return(false);
  }
}




class ColorStat {
  static public $fileColorsStat = Array(
    'pixels' => 0,
    'analyzed' => 0,
    'time' => 0,
    'colors' =>0,
    'fileName' => "",
    'quality' => 0,
  );

  /**
   * returns colors of an image file
   *
   * return :
   *
   *
   *
   * @param String $fileName : the name of picture to scan
   * @param String $colorTable : the color table model
   * @param String $options : Array of options
   *                            'quality' : set the quality for analyze
   *                            'maxTime' : set the maximum time for analyze
   *                            'pps'     : pixel per second analyzed
   *                          if 'maxTime' and 'pps' are greater than zero, the
   *                          quality parameter is computed automatically
   * @return : -1 if file doesn't exist
   *           -2 if file is not a PNG, a JPEG or a GIF file
   *           -3 if a fatal error occurs
   *            array of HSV objects if everthing is Ok
   */
  static function getFileColors($fileName, $colorTable, $options=array())
  {
    $options=self::checkOptions($options);

    self::$fileColorsStat=Array(
      'pixels'   => 0,
      'analyzed' => 0,
      'time' => 0,
      'pps' =>0,
    );

    if(file_exists($fileName))
    {
      $time=microtime(true);

      try
      {
        if(preg_match('/.*\.gif$/i', $fileName))
        {
          $image = imagecreatefromgif($fileName);
        }
        elseif(preg_match('/.*\.(jpg|jpeg)$/i', $fileName))
        {
          $image = imagecreatefromjpeg($fileName);
        }
        elseif(preg_match('/.*\.png$/i', $fileName))
        {
          $image = imagecreatefrompng($fileName);
        }
        else
        {
          return(-2);
        }


        $imageWidth=imagesx($image);
        $imageHeight=imagesy($image);

        if($options['mode']=='numAnalyzed')
        {
          $quality=round(sqrt($imageWidth*$imageHeight/$options['numAnalyzed']), 0);
        }
        elseif($options['mode']=='maxTime')
        {
          $quality=round(sqrt($imageWidth*$imageHeight/($options['pps']*$options['maxTime'])), 0);
        }
        else
        {
          $quality=$options['quality'];
        }

        $imageWorkWidth=round($imageWidth/$quality,0);
        $imageWorkHeight=round($imageHeight/$quality,0);
        $imageWork=imagecreatetruecolor($imageWorkWidth,$imageWorkHeight);
        imagecopyresampled($imageWork, $image, 0, 0, 0, 0, $imageWorkWidth, $imageWorkHeight, $imageWidth, $imageHeight);
        //imagecopyresized($imageWork, $image, 0, 0, 0, 0, $imageWorkWidth, $imageWorkHeight, $imageWidth, $imageHeight);
        imagedestroy($image);

        $returned=Array();

        $i=0;
        for($px=0;$px<$imageWorkWidth;$px++)
        {
          for($py=0;$py<$imageWorkHeight;$py++)
          {
            $i++;
            $value=imagecolorat($imageWork, $px, $py);

            $rgb=self::IntToRGB($value);
            //echo sprintf("%06x", $value)." => ".$rgb->getHexString();


            //echo " ($i) ".$color->getHexString()."<br>";

            if(DEBUG_MODE)
            {
              $color=self::getColorFromTable($rgb->getHSV(), $colorTable);
              $newRGB=$color->get();
              $col=imagecolorallocate($imageWork, $newRGB['R'], $newRGB['G'], $newRGB['B']);
              imagesetpixel($imageWork, $px, $py, $col);
              imagecolordeallocate($imageWork, $col);
              $color=$color->getHexString();
              unset($newRGB);
            }
            else
            {
              $color=self::getColorFromTable($rgb->getHSV(), $colorTable)->getHexString();
            }


            if(array_key_exists($color, $returned))
            {
              $returned[$color]['num']++;
            }
            else
            {
              $returned[$color]=Array(
                'hsv' => $rgb->getHSV()->get(),
                'num' => 1,
                'pct' => 0,
              );
            }
            unset($rgb);
          }
        }


        if(DEBUG_MODE)
        {
          $fName="q".$quality."_c".$options['numColors']."_nb".count($returned)."_".$fileName.".png";
          imagepng($imageWork, $fName);
        }


        imagedestroy($imageWork);
        uasort($returned, Array('ColorStat', 'sortTones'));

        if($options['numColors']>0)
        {
          foreach($returned as $key=>$val)
          {
            $returnedColors[$key]=$val;
            $options['numColors']--;
            if($options['numColors']<=0) break;
          }
        }
        else
        {
          $returnedColors=$returned;
        }

        self::$fileColorsStat=Array(
          'pixels'   => $imageWidth*$imageHeight,
          'analyzed' => $i,
          'time'     => microtime(true)-$time,
          'colors'   => count($returned),
          'pps'      => $i/(microtime(true)-$time),
          'quality'  => $quality,
        );

        if(DEBUG_MODE)
        {
          self::$fileColorsStat['fileName']=$fName;
        }

        unset($returned);

        foreach($returnedColors as $key => $val)
        {
          $returnedColors[$key]['pct']=round(100*$val['num']/self::$fileColorsStat['analyzed'],2);
        }

        return($returnedColors);
      }
      catch (Exception $e)
      {
        echo "ERROR!<br>".print_r($e, true);
        return(-3);
      }

    }
    else
    {
      return(-1);
    }
  }

  /**
   *  Calculate the HSV value from a RGB value
   *
   * @param RGB $RGB : RGB object
   * @return HSV : new HSV object
   */
  static public function RGBtoHSV(RGB $RGB)
  {
    $rgbValues=$RGB->get(true);
    $max=self::max($rgbValues);
    $min=self::min($rgbValues);

    if($max['value']==$min['value'])
    {
      $H=0;
    }
    elseif($max['key']=='R')
    {
      $H=(60*($rgbValues['G']-$rgbValues['B'])/($max['value']-$min['value'])+360)%360;
    }
    elseif($max['key']=='G')
    {
      $H=(60*($rgbValues['B']-$rgbValues['R'])/($max['value']-$min['value'])+120);
    }
    elseif($max['key']=='B')
    {
      $H=(60*($rgbValues['R']-$rgbValues['G'])/($max['value']-$min['value'])+240);
    }

    $S=round(100*(($max['value']==0)?0:1-$min['value']/$max['value']),0);
    $V=round(100*$max['value'],0);

    return(new HSV($H, $S, $V));
  }

  /**
   *  Calculate the RGB value from a HSV value
   *
   * @param HSV $HSV : HSV object
   * @return RGB : new RGB object
   */
  static public function HSVtoRGB(HSV $HSV)
  {
    $hsvValues=$HSV->get();

    $h=abs($hsvValues['H']/60)%6;
    $f=$hsvValues['H']/60-$h;
    $l=round(2.55*$hsvValues['V']*(1-$hsvValues['S']/100),0);
    $m=round(2.55*$hsvValues['V']*(1-$f*$hsvValues['S']/100),0);
    $n=round(2.55*$hsvValues['V']*(1-(1-$f)*$hsvValues['S']/100),0);

    $v=round(2.55*$hsvValues['V'],0);

    switch($h)
    {
      case 0:
        return(new RGB($v, $n, $l));
        break;
      case 1:
        return(new RGB($m, $v, $l));
        break;
      case 2:
        return(new RGB($l, $v, $n));
        break;
      case 3:
        return(new RGB($l, $m, $v));
        break;
      case 4:
        return(new RGB($n, $l, $v));
        break;
      case 5:
        return(new RGB($v, $l, $m));
        break;
    }
  }

  /**
   *
   * @param Int $rgb : an integer &hRRGGBB
   * @return RGB : a RGB object
   */
  static public function IntToRGB($rgb)
  {
    return(new RGB(($rgb >> 16) & 0xFF, ($rgb >> 8) & 0xFF, $rgb & 0xFF, true));
  }

  /**
   * return a color table
   *  $table[h][s][v] => HSV object or string 'RRGGBB'
   *
   * @param Int $huePrec : degree of precision for hue [1..360]
   * @param Float $prec    : precision step for saturation & value [1..100]
   * @param String $returnedType : 'HSV'   => return a HSV object
   *                               'color' => return a color string 'RRGGBB'
   * @return Array : the color table
   */
  static public function getColorTable($huePrec=10, $prec=10, $returnedType='HSV')
  {
    $returned=Array();
    for($hue=0;$hue<360;$hue+=$huePrec)
    {
      $hueValues=Array();

      for($saturation=0;$saturation<=100;$saturation+=$prec)
      {
        $saturationValues=Array();

        for($value=0;$value<=100;$value+=$prec)
        {
          $hsv=new HSV($hue, $saturation, $value);
          if($returnedType=='HSV')
          {
            $saturationValues[$value]=$hsv;
          }
          else
          {
            $saturationValues[$value]=$hsv->getRGB()->getHexString();
          }
          unset($hsv);
        }

        $hueValues[$saturation]=$saturationValues;
        unset($saturationValues);
      }
      $returned[$hue]=$hueValues;
      unset($hueValues);
    }


    return($returned);
  }

  /**
   * @param Array : an array
   * @return Array : an array, giving the minimum value and the related key
   */
  static protected function min($values)
  {
    $minKey="";
    $minValue=0;
    foreach($values as $key => $val)
    {
      if($minKey=='' or $val<$minValue)
      {
        $minKey=$key;
        $minValue=$val;
      }
    }
    return(Array('key' => $minKey, 'value' => $minValue));
  }

  /**
   * reverted sort color
   *
   */
  static protected function sortTones($a, $b)
  {
    if($a['num'] == $b['num'])
    {
      return(0);
    }
    return ($a['num'] > $b['num']) ? -1 : 1;
  }

  /**
   * @param Array : an array
   * @return Array : an array, giving the maximum value and the related key
   */
  static protected function max($values)
  {
    $maxKey="";
    $maxValue=0;
    foreach($values as $key => $val)
    {
      if($maxKey=='' or $val>$maxValue)
      {
        $maxKey=$key;
        $maxValue=$val;
      }
    }
    return(Array('key' => $maxKey, 'value' => $maxValue));
  }

  /**
   * check the validity for getFileColors() options
   * if no parameters are given, return the default options values
   *
   * @param Array $options : an array with given options values
   * @return Array : an array with valid options values
   */
  static protected function checkOptions($options=Array())
  {
    if(!is_array($options))
    {
      $options=Array();
    }

    if(!array_key_exists('quality', $options)) $options['quality']=1;
    if(!array_key_exists('maxTime', $options)) $options['maxTime']=0.5;
    if(!array_key_exists('pps', $options)) $options['pps']=1;
    if(!array_key_exists('numAnalyzed', $options)) $options['numAnalyzed']=600;
    if(!array_key_exists('numColors', $options)) $options['numColors']=0;
    if(!array_key_exists('mode', $options)) $options['mode']='quality';

    if($options['quality']<=0) $options['quality']=1;
    if($options['quality']>20) $options['quality']=20;
    if($options['maxTime']<0) $options['maxTime']=0.5;
    if($options['pps']<0) $options['pps']=1;
    if($options['numAnalyzed']<0) $options['numAnalyzed']=600;
    if($options['numColors']<0) $options['numColors']=16;

    if($options['mode']!='quality' and
       $options['mode']!='numAnalyzed' and
       $options['mode']!='maxTime') $options['mode']='quality';

    return($options);
  }

  /**
   * for the given color, return the nearest color of the color table
   *
   * @param HSV $hsvObject    : the color, as HSV object
   * @param Array $colorTable : the colorTable
   * @param String $mode      : 'HSV' or 'RGB' to define the returned object
   * @return HSV or RGB       : the color
   */
  static public function getColorFromTable(HSV $hsvObject, $colorTable, $mode='RGB')
  {
    $hsv=$hsvObject->get();
//echo "*H:".$hsv['H']." ";
//echo "*S:".$hsv['S']." ";
//echo "*V:".$hsv['V']."<br>";

    $hue=360/count($colorTable);
    $hueNumber=round($hsv['H']/$hue,0);
    $step=100/(count($colorTable[0])-1);
//echo "*H_Step:$hue<br>";
//echo "*SV_Step:$step<br>";

    $hsv['S']=round((100/$step)*$hsv['S']/100,0)*$step;
    $hsv['V']=round((100/$step)*$hsv['V']/100,0)*$step;
    $hsv['H']=($hueNumber*$hue)%360;
//echo "*H:".$hsv['H']." ";
//echo "*S:".$hsv['S']." ";
//echo "*V:".$hsv['V']."<br>";

    if($mode=='RGB')
    {
      return($colorTable[$hsv['H']][$hsv['S']][$hsv['V']]->getRGB());
    }
    else
    {
      return($colorTable[$hsv['H']][$hsv['S']][$hsv['V']]);
    }
  }

}






?>
