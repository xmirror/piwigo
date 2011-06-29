<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

/**
 * CF_Config class
 */
class CF_Config {
  static $default_config = array();
  
  protected $config_values;
  protected $db_key = null;
  protected $db_comment = null;
  
  /* ************************ */
  /* ** Constructor        ** */
  /* ************************ */

  function CF_Config() {
  }
  
  /* ************************ */
  /* ** Accessors          ** */
  /* ************************ */
  
  function get_value($key) {
      if (isset($this->config_values[$key])) {
          return $this->config_values[$key];
      }
      return null;
  }

  function set_value($key, $value) {
      $this->config_values[$key] = $value;
  }

  function set_db_key($key) {
    $this->db_key = $key;
  }
  
  /* ************************ */
  /* ** Loading methods    ** */
  /* ************************ */
  
  function load_config() {
    if (null != $this->db_key) {
      $query = '
          SELECT value
          FROM '.CONFIG_TABLE.'
          WHERE param = \''. $this->db_key .'\'
          ;';
      $result = pwg_query($query);
      if($result) {
        $row = mysql_fetch_row($result);
        if(is_string($row[0])) {
          $this->config_values = unserialize($row[0]);
        }
      }
    }
    $this->load_default_config();
  }
  
  protected function load_default_config() {
    foreach (CF_Config::$default_config as $key => $value) {
      if (!isset($this->config_values[$key])) {
        $this->config_values[$key] = $value;
      }
    }
  }
  
  /* ************************ */
  /* ** Saving  methods    ** */
  /* ************************ */

  function save_config() {
    if (null == $this->db_key) {
      return false;
    }

    unset($this->config_values['config_lang']);
    
    if (!isset($this->config_values[CF_CFG_COMMENT])) {
      $this->set_value(CF_CFG_COMMENT, CF_CFG_DB_COMMENT);
    }
    $db_comment = sprintf($this->config_values[CF_CFG_COMMENT],
                          $this->db_key);
    $query = '
        REPLACE INTO '.CONFIG_TABLE.'
        VALUES(
          \''. $this->db_key .'\',
          \''.serialize($this->config_values).'\',
          \''. $db_comment . '\')
        ;';
    $result = pwg_query($query);
    if($result) {
      return true;
    } else {
      return false;
    }
  }
  
  /* ************************ */
  /* ** Maintain  methods  ** */
  /* ************************ */
  
  static function install($plugin_id) {
    $config = new CF_Config();
    $config->set_db_key($plugin_id);
    $config->load_config();
    $default_config = CF_Config::$default_config;
    if (isset($default_config[CF_CFG_COMMENT])) {
      // Override comment
      $config->set_value(CF_CFG_COMMENT, $default_config[CF_CFG_COMMENT]);
    }
    $result = $config->save_config();
    return $result;
  }

  static function uninstall($plugin_id) {
    $query = '
        DELETE FROM '.CONFIG_TABLE.'
        WHERE param = \'' . $plugin_id . '\'
        ;';
    $result = pwg_query($query);
    if($result) {
      return true;
    } else {
      return false;
    }
  }  
}
?>