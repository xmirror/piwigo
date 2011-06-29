<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

/**
 * CF_Plugin class
 */
class CF_Plugin {
  protected $plugin_id;
  protected $plugin_title;
  protected $config;
  protected $debug=array();
  
  /* ************************ */
  /* ** Constructor        ** */
  /* ************************ */

  function CF_Plugin($plugin_id, $title=CF_TITLE) {
    $this->plugin_id = $plugin_id;
    $this->plugin_title = $title;
    $this->config = new CF_Config();
    $this->config->set_db_key(CF_CFG_DB_KEY);
    $this->config->load_config();
    $this->config->set_value(CF_CFG_COMMENT, CF_CFG_DB_COMMENT);
    CF_Log::add_debug($this->config, 'CF_Plugin');
  }
  
  /* ************************ */
  /* ** Trigger management ** */
  /* ************************ */
  
  function get_admin_plugin_menu_links($menu) {
    array_push(
        $menu,
        array(
            'NAME' => $this->get_title(),
            'URL'  => $this->get_plugin_admin_url()
        )
    );
    return $menu;
  }
  
  function loc_begin_index() {
    $this->display_message();
  }
  function loc_begin_page_header() {
    global $template;
    
    $template->set_prefilter('tail', 'contactForm_prefilter');

    if (!$this->check_allowed()) {
      return;
    }
    
    $cf_values = array(
        'TEXT'  => l10n('contact_form_link'),
        'URL'   => make_index_url(array('section' => CF_URL_PARAMETER)),
      );
    $template->assign('CF_FOOTER_VALUES', $cf_values);

    $template->assign('ContactFormLink', $this->get_html_contact_form_link());
  }
  
  function blockmanager_apply($aMenuRefArray) {
    if (!$this->check_menu_adding()) {
      return;
    }
    $menu = &$aMenuRefArray[0];
    $block_mbMenu = $menu->get_block('mbMenu');
    if (null == $block_mbMenu) {
      return;
    }
    // Include language advices
    load_language('plugin.lang', CF_PATH);
	load_language('lang', PHPWG_ROOT_PATH.'local/', array('no_fallback'=>true, 'local'=>true) ); 
    
    if (!isset($block_mbMenu->data[CF_MENUBAR_KEY])) {
      $contact_form_menu = array(
          'TITLE' => l10n('contact_form_title'),
          'NAME'  => l10n('contact_form'),
          'URL'   => make_index_url(array('section' => CF_URL_PARAMETER)),
        );
      $block_mbMenu->data[CF_MENUBAR_KEY] = $contact_form_menu;
    }
    
  }
  
  function loc_end_index() {
    if ('index' != script_basename()) {
      return;
    }
    if (!$this->check_allowed()) {
      return;
    }
    global $tokens;
    $form_requested = false;
    foreach($tokens as $token) {
      if ($token == CF_URL_PARAMETER) {
        $form_requested = true;
      }
    }
    if ($form_requested) {
      if (isset($_POST['cf_key'])) {
        $this->valid_form();
      } else {
        $this->display_form($this->create_infos_array());
      }
    }
  }

  function send_mail_content($mail_content) {
    remove_event_handler('send_mail_content',             
                          array(&$this, 'send_mail_content'));
    global $user,$conf_mail,$conf;
    if (!isset($conf_mail)) {
      $conf_mail = get_mail_configuration();
    }
    $keyargs_content_admin_info = array(
      get_l10n_args('Connected user: %s', $user['username']),
      get_l10n_args('IP: %s', $_SERVER['REMOTE_ADDR']),
      get_l10n_args('Browser: %s', $_SERVER['HTTP_USER_AGENT'])
    );
    $newline = "\n";
    $separator  = $newline;
    $separator .= str_repeat($this->config->get_value(CF_CFG_SEPARATOR),
                             $this->config->get_value(CF_CFG_SEPARATOR_LEN));
    $separator .= $newline;
    if ('text/html' == $conf_mail['default_email_format']) {
      $newline = "<br/>";
      $separator .= '<hr style="width: ';
      $separator .= $this->config->get_value(CF_CFG_SEPARATOR_LEN);
      $separator .= 'em; text-align: left;" />';
    }
    $footer  = $newline;
    $footer .= $separator;
    $footer .= l10n_args($keyargs_content_admin_info, $newline);
    $footer .= $separator;
    
    $mail_content = str_replace(CF_SEPARATOR_PATTERN, $footer, $mail_content);
    return $mail_content;
  }
  
  function loc_end_page_tail() {
    CF_Log::show_debug();
  }
  
  /* ************************ */
  /* ** Accessors          ** */
  /* ************************ */

  function get_config() {
    return $this->config;
  }

  function get_title() {
    // Include language advices
    load_language('plugin.lang', CF_PATH);
    
    return l10n($this->plugin_title);
  }
  
  /* ************************ */
  /* ** Private functions  ** */
  /* ************************ */
  
  protected function get_html_contact_form_link() {
    global $template;
    $cf_link = array(
        'TEXT'  => l10n('contact_form_link'),
        'URL'   => make_index_url(array('section' => CF_URL_PARAMETER)),
      );
    $template->set_filenames(array(
        'contact_form_link' => realpath(cf_get_template('cf_link.tpl')),
      ));
    $template->assign('CF_LINK', $cf_link);
    
    $link = $template->parse('contact_form_link', true);
    return $link;
  }
  
  protected function display_form($infos) {
    global $template,$user;
    trigger_action('display_contactform');
    $template->set_extent(realpath(cf_get_template('cf_index.tpl')), 'index');
    $template->set_filenames(array(
        'index'       => realpath(cf_get_template('cf_index.tpl')),
        'cf_title'    => realpath(cf_get_template('cf_title.tpl')),
        'cf_form'     => realpath(cf_get_template('cf_form.tpl')),
        'cf_messages' => realpath(cf_get_template('cf_messages.tpl')),
      ));
    
    $cf = array(
        'TITLE'     => 'contact_form_title',
        'NEED_NAME' => $this->config->get_value(CF_CFG_NAME_MANDATORY),
        'NEED_MAIL' => $this->config->get_value(CF_CFG_MAIL_MANDATORY),
        'F_ACTION'  => make_index_url(array('section' => CF_URL_PARAMETER)),
        'LOGGED'    => !is_a_guest(),
        'ID'        => $infos['cf_id'],
        'EMAIL'     => $infos['cf_from_mail'],
        'NAME'      => $infos['cf_from_name'],
        'SUBJECT'   => $infos['cf_subject'],
        'MESSAGE'   => $infos['cf_message'],
        'KEY'       => get_ephemeral_key(2, $infos['cf_id']),
      );
    if (!empty($infos['errors'])) {
      $template->assign('errors', $infos['errors']);
    }
    if (!empty($infos['infos'])) {
      $template->assign('infos', $infos['infos']);
    }
    $template->assign('CF', $cf);
    $template->assign_var_from_handle('CF_TITLE', 'cf_title');
    $template->assign_var_from_handle('CF_MESSAGES', 'cf_messages');
    $template->assign_var_from_handle('CF_FORM', 'cf_form');
  }

  protected function redirect($redirect_url, $infos) {
    global $template;
    $template->set_filenames(array(
        'cf_redirect' => realpath(cf_get_template('cf_redirect.tpl')),
        'cf_title'    => realpath(cf_get_template('cf_title.tpl')),
        'cf_messages' => realpath(cf_get_template('cf_messages.tpl')),
      ));
      
    $template->block_html_head( '',
              '<link rel="stylesheet" type="text/css" '.
              'href="' . CF_INCLUDE . 'contactform.css' . '">',
              $smarty, $repeat);
    $cf = array(
        'TITLE'     => 'contact_redirect_title',
        'CSS'       => '<link rel="stylesheet" type="text/css" '.
                       'href="' . CF_INCLUDE . 'contactform.css' . '">'
      );
              
    if (!empty($infos['infos'])) {
      $template->assign('infos', $infos['infos']);
    }
    $template->assign('CF', $cf);
    $template->assign_var_from_handle('CF_TITLE', 'cf_title');
    $template->assign_var_from_handle('CF_MESSAGES', 'cf_messages');
    $redirect_msg = $template->parse('cf_redirect', true);
    $redirect_delay = $this->config->get_value(CF_CFG_REDIRECT_DELAY);
//    redirect($redirect_url, $redirect_msg, $redirect_delay);
    redirect($redirect_url);
  }
  
  protected function display_message() {
    $infos = pwg_get_session_var('cf_infos');
    pwg_unset_session_var('cf_infos');
    if ( null == $infos or
        (empty($infos['infos']) and
         empty($infos['errors']))
        ) {
      return;
    }
    global $template;
    $template->set_filenames(array(
        'cf_index'    => realpath(cf_get_template('cf_messages_index.tpl')),
        'cf_title'    => realpath(cf_get_template('cf_title.tpl')),
        'cf_button'   => realpath(cf_get_template('cf_button.tpl')),
        'cf_messages' => realpath(cf_get_template('cf_messages.tpl')),
      ));
      
    $template->block_html_head( '',
              '<link rel="stylesheet" type="text/css" '.
              'href="' . CF_INCLUDE . 'contactform.css' . '">',
              $smarty, $repeat);
    $cf = array(
        'TITLE'     => 'contact_form_title',
      );
    if (!empty($infos['errors'])) {
      $template->assign('errors', $infos['errors']);
    }
    if (!empty($infos['infos'])) {
      $template->assign('infos', $infos['infos']);
    }
    $template->assign('CF', $cf);
    $template->assign_var_from_handle('CF_TITLE', 'cf_title');
    $template->assign_var_from_handle('CF_MESSAGES', 'cf_messages');
    $template->assign_var_from_handle('CF_BUTTON', 'cf_button');
    
    $begin = 'PLUGIN_INDEX_CONTENT_BEFORE';
    $old_begin = $template->get_template_vars($begin);
    $template->assign_var_from_handle($begin, 'cf_index');
    $template->concat($begin, $old_begin);
  }
  
  protected function valid_form() {
    if ($this->check_form_params($infos)) {
      global $template;
      if (!$this->send_message($infos)) {
        // Include language advices
        load_language('plugin.lang', CF_PATH);
        $this->display_form($infos);
      } else {
        pwg_set_session_var('cf_infos', array(
            'infos'  => $infos['infos'],
            'errors' => $infos['errors'],
          ));
        redirect(make_index_url());
        //$this->redirect(make_index_url(),$infos);
      }
    } else {
      $this->display_form($infos);
    }
  }
  
  protected function get_active_admin_emails() {
    //$cf_emails = $cf_config->get_value(CF_CFG_ADMIN_MAILS);
    $all_mails = $this->config->get_value(CF_CFG_ADMIN_MAILS);
    $active = array('WEBMASTER' => null, 'ADMINS' => array());
    foreach($all_mails as $email => $values) {
      if (1 == $values['ACTIVE']) {
        if (1 == $values['WEBMASTER']) {
          $active['WEBMASTER'] = $values['EMAILSTR'];
        } else {
          array_push($active['ADMINS'], $values['EMAILSTR']);
        }
      }
    }

    if (empty($all_mails)) {
      $webmaster_email = get_webmaster_mail_address();
      $active = array(
        'WEBMASTER' => $webmaster_email,
        'ADMINS' => cf_get_admins_emails($webmaster_email),
        );
    }
    
    return $active;
  }
  
  protected function send_message(&$infos) {
    //redirect(make_index_url());
//    include(PHPWG_ROOT_PATH . 'include/functions_mail.inc.php');

    $admin_mails = $this->get_active_admin_emails();
    if ( empty($admin_mails) or 
        (empty($admin_mails['WEBMASTER']) and 
         empty($admin_mails['ADMINS']))
        ) {
      // No admin mail...
      array_push( $infos['infos'], l10n('cf_no_mail'));
      return true;
    }
    
    global $conf,$user;
    cf_switch_to_default_lang();
    
    $from = format_email($infos['cf_from_name'], $infos['cf_from_mail']);
    $subject_prefix = $this->config->get_value(CF_CFG_SUBJECT_PREFIX);
    if (empty($subject_prefix)) {
      $subject_prefix  = '['.CF_DEFAULT_PREFIX.'] ';
    }
    $subject  = '['.$subject_prefix.'] ';
    $subject .= $infos['cf_subject'];
    $content  = "\n\n".$infos['cf_message']."\n";
    $content .= CF_SEPARATOR_PATTERN;
    $mail_args = array(
        'from' => $from,
        'Bcc' => $admin_mails['ADMINS'],
        'subject' => $subject,
        'content' => $content,
        'content_format' => 'text/plain',
      );
    add_event_handler('send_mail_content',             
                      array(&$this, 'send_mail_content'));

    $return = true;
    $return = @pwg_mail(
      $admin_mails['WEBMASTER'],
      $mail_args
    );

    cf_switch_back_to_user_lang();
    if (!$return) {
      array_push( $infos['errors'], l10n('cf_error_sending_mail'));
    } else {
      array_push( $infos['infos'], l10n('cf_sending_mail_successful'));
    }
    return $return;
  }
  
  protected function check_form_params(&$infos) {
    // Include language advices
    load_language('plugin.lang', CF_PATH);
    
    $infos = $this->create_infos_array(false);
    $return = '';
    $value = '';
    // Key
    if ($this->check_key()) {
      $infos['cf_id'] = trim( stripslashes($_POST['cf_id']));
    } else {
      $infos['cf_id'] = rand();
      array_push( $infos['errors'], l10n('cf_form_error'));
    }
    // From name
    if (isset($_POST['cf_from_name'])) {
      $value = trim( stripslashes($_POST['cf_from_name']) );
      if (strlen($value) > 0) {
        $infos['cf_from_name'] = $value;
      } else {
        array_push( $infos['errors'], l10n('cf_from_name_error'));
      }
    } else {
      array_push( $infos['errors'], l10n('cf_from_name_error'));
    }
    // From mail
    if (isset($_POST['cf_from_mail'])) {
      $value = trim( stripslashes($_POST['cf_from_mail']) );
      $return = cf_validate_mail_format($value);
      if (null == $return) {
        $infos['cf_from_mail'] = $value;
      } else {
        array_push( $infos['errors'], $return);
      }
    } else {
      array_push( $infos['errors'], l10n('cf_mail_format_error'));
    }
    // Subject
    if (isset($_POST['cf_subject'])) {
      $value = trim( stripslashes($_POST['cf_subject']) );
      if (strlen($value) > 0) {
        $infos['cf_subject'] = $value;
      } else {
        array_push( $infos['errors'], l10n('cf_subject_error'));
      }
    } else {
      array_push( $infos['errors'], l10n('cf_subject_error'));
    }
    // Message
    if (isset($_POST['cf_message'])) {
      $value = trim( stripslashes($_POST['cf_message']) );
      if (strlen($value) > 0) {
        $infos['cf_message'] = $value;
      } else {
        array_push( $infos['errors'], l10n('cf_message_error'));
      }
    } else {
      array_push( $infos['errors'], l10n('cf_message_error'));
    }

    $infos = trigger_event('check_contactform_params', $infos);

    return empty($infos['errors']);
  }
  
  protected function check_key() {
    global $conf;
    $key='';
    $id=0;
    if (isset($_POST['cf_key'])) {
      $key = trim( stripslashes($_POST['cf_key']));
    }
    if (isset($_POST['cf_id'])) {
      $id = trim( stripslashes($_POST['cf_id']));
    }

    if (!verify_ephemeral_key($key, $id)) {
      return false;
    }
    return true;
  }
  
  protected function create_infos_array($fill=true) {
    $infos = array(
        'cf_id'         => '',
        'cf_from_name'  => '',
        'cf_from_mail'  => '',
        'cf_subject'    => '',
        'cf_message'    => '',
        'errors'        => array(),
        'infos'         => array(),
      );
    if ($fill) {
      global $user;
      // Include language advices
      load_language('plugin.lang', CF_PATH);
      
      $infos['cf_id'] = rand();
      $infos['cf_from_name'] = is_a_guest()?'':$user['username'];
      $infos['cf_from_mail'] = $user['email'];

      $l10n_key = 'title_send_mail';
      $infos['cf_subject'] = l10n($l10n_key);
      if ($l10n_key == $infos['cf_subject']) {
        $infos['cf_subject'] = l10n('A comment on your site');
      }
    }
    return $infos;
  }
  protected function check_menu_adding() {
    return ($this->config->get_value(CF_CFG_MENU_LINK) and
            $this->check_allowed());
  }
  protected function check_allowed() {
    if (is_a_guest() and !$this->config->get_value(CF_CFG_ALLOW_GUEST)) {
      // Not allowed
      return false;
    }
    return true;
  }
  protected function get_plugin_admin_url() {
    return get_admin_plugin_menu_link(CF_PATH . 'config.php');
  }
}
?>