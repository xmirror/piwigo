<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
check_status(ACCESS_ADMINISTRATOR);

function regenerate_prefilter($content, $smarty)
{
  return str_replace('{$thumbnail.TN_SRC}', '{$thumbnail.TN_SRC}?rand='.md5(uniqid(rand(), true)), $content);
}

global $template, $conf, $page, $pwg_loaded_plugins, $user;

// User cache must not be updated during ajax requests
if (!isset($user['need_update']) or !$user['need_update'])
  getuserdata($user['id'], true);

load_language('plugin.lang', REGENERATE_THUMBNAILS_PATH);
include_once(PHPWG_ROOT_PATH.'admin/include/functions_upload.inc.php');
prepare_upload_configuration();
$upload_form_config = get_upload_form_config();

$template->set_filename('regenerateThumbnails', realpath(REGENERATE_THUMBNAILS_PATH.'element_set_global_action.tpl'));

if (isset($_POST['submit']) and $_POST['selectAction'] == 'regenerateThumbnails')
{
  if ($_POST['regenerateThumbnailsSuccess'] != '0')
    array_push($page['infos'], sprintf(l10n('%s thumbnails have been regenerated'), $_POST['regenerateThumbnailsSuccess']));

  if ($_POST['regenerateThumbnailsError'] != '0')
    array_push($page['warnings'], sprintf(l10n('%s thumbnails can not be regenerated'), $_POST['regenerateThumbnailsError']));

  // Update configuration
  $fields = array('thumb_maxwidth', 'thumb_maxheight', 'thumb_quality');
  foreach ($fields as $field)
  {
    if (!isset($upload_form_config[$field]))
    {
      continue;
    }
    $value = null;
    if (!empty($_POST[$field]))
    {
      $value = $_POST[$field];
    }

    $min = $upload_form_config[$field]['min'];
    $max = $upload_form_config[$field]['max'];
    $pattern = $upload_form_config[$field]['pattern'];

    if (preg_match($pattern, $value) and $value >= $min and $value <= $max)
    {
      $conf['upload_form_'.$field] = $value;
       $updates[] = array(
        'param' => 'upload_form_'.$field,
        'value' => $value
        );
    }
    else
    {
      array_push(
        $page['errors'],
        sprintf(
          $upload_form_config[$field]['error_message'],
          $min,
          $max
          )
        );
    }
    $form_values[$field] = $value;
  }
  if (count($page['errors']) == 0)
  {
    mass_updates(
      CONFIG_TABLE,
      array(
        'primary' => array('param'),
        'update' => array('value')
        ),
      $updates
      );
  }

  if (isset($pwg_loaded_plugins['square_thumbnails']))
  {
    $conf['upload_form_thumb_square'] = isset($_POST['square']);
    conf_update_param('upload_form_thumb_square', $conf['upload_form_thumb_square']);
  }

  $template->delete_compiled_templates();
}

foreach ($upload_form_config as $param_shortname => $param)
{
  $param_name = 'upload_form_'.$param_shortname;
  $form_values[$param_shortname] = $conf[$param_name];
}

if (isset($pwg_loaded_plugins['square_thumbnails']))
{
  load_language('plugin.lang', SQUARE_THUMB_PATH);
  $template->assign(array('SQUARE' => @$conf['upload_form_thumb_square']));
}

$redirect_url = get_root_url().'admin.php?page='.$_GET['page'];
if ($_GET['page'] == 'plugin')
  $redirect_url .= '-regenerateThumbnails';

$template->assign(array(
  'upload_form_settings' => $form_values,
  'all_elements' => $page['cat_elements_id'],
  'redirect_url' => $redirect_url,
  )
);

$template->append('element_set_global_plugins_actions', array(
  'ID' => 'regenerateThumbnails',
  'NAME' => l10n('Regenerate Thumbnails'),
  'CONTENT' => $template->parse('regenerateThumbnails', true),
  )
);

$template->set_prefilter('batch_manager_global', 'regenerate_prefilter');

?>