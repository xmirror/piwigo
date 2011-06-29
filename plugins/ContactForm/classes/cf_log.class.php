<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

class CF_Log {
  const infos = 'infos';
  const errors = 'errors';
  const debug = 'debug';
  static $messages=array( CF_Log::infos   => array(),
                          CF_Log::errors  => array(),
                          CF_Log::debug   => array());
  
  static function show_debug() {
    if (!defined('CF_DEBUG_ACTIVE') or !CF_DEBUG_ACTIVE) {
      return;
    }
    
    global $template;
    $template->assign('contact_form_debug', CF_Log::$messages['debug']);
    $template->set_filenames(array(
        'contact_form_debug' => realpath(cf_get_template('cf_debug.tpl')),
      ));
    $debug_text = $template->parse('contact_form_debug', true);
    $template->assign('CF_DEBUG', $debug_text);
    return $debug_text;
  }

  static function add_debug($variable, $label=null, $append=true) {
    $value = print_r($variable, true);
    if (null == $label) {
      $label = 'CF_Debug';
    }
    if (array_key_exists($label, CF_Log::$messages['debug']) && $append) {
      array_push(CF_Log::$messages['debug'], $value);
    } else {
      CF_Log::$messages['debug'][$label] = array($value);
    }
  }

  static function reset_messages() {
    CF_Log::$messages = array(CF_Log::infos  => array(),
                              CF_Log::errors => array(),
                              CF_Log::debug  => array());
  }
  static function add_error($error) {
    CF_Log::add_message($error, CF_Log::errors);
  }
  static function add_message($message, $type=CF_Log::infos) {
    switch($type) {
      case CF_Log::infos:
      case CF_Log::errors:
        $prefix = '<span class="cf-log-' . $type . '">';
        $suffix = '</span>';
        array_push(CF_Log::$messages[$type], $prefix . $message . $suffix);
        break;
      case CF_Log::debug:
        CF_Log::add_debug($message);
        break;
      default:
        return;
    }
  }

  static function show_messages() {
    global $page;
    if (count(CF_Log::$messages[CF_Log::infos]) > 0) {
      $page['infos'] = array_merge($page['infos'],
                                   CF_Log::$messages[CF_Log::infos]);
    }
    if (count(CF_Log::$messages[CF_Log::errors]) > 0) {
      $page['errors'] = array_merge($page['errors'],
                                    CF_Log::$messages[CF_Log::errors]);
    }
    CF_Log::show_debug();
    CF_Log::reset_messages();
  }
    
    //<span class="cf-log-saved">
}
?>