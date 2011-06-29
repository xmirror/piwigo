<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

global $conf;

$service = &$arr[0];
$service->addMethod(
  'pwg.images.regenerateThumbnail',
  'ws_images_regenerateThumbnail',
  array(
    'image_id'  => array(),
    'maxwidth'  => array('default'=>$conf['upload_form_thumb_maxwidth']),
    'maxheight' => array('default'=>$conf['upload_form_thumb_maxheight']),
    'quality'   => array('default'=>$conf['upload_form_thumb_quality']),
    'square'    => array('default'=>@$conf['upload_form_thumb_square']),
  ),
  'Regenerate a thumbnail with given arguments.'
);

function ws_images_regenerateThumbnail($params, &$service)
{
  global $conf;

  if (!is_admin())
    return new PwgError(401, 'Access denied');

  $query='
SELECT id, path, tn_ext
FROM '.IMAGES_TABLE.'
WHERE id = '.(int)$params['image_id'].'
;';

  $image = pwg_db_fetch_assoc(pwg_query($query));
  if ($image == null)
    return new PwgError(404, "image_id not found");

  include_once(PHPWG_ROOT_PATH.'admin/include/functions_upload.inc.php');

  if ($params['square'] == 'true' or $params['square'] == 'false')
    $params['square'] = get_boolean($params['square']);
  if (!$params['square'])
    remove_event_handler('upload_thumbnail_resize', 'upload_square_resize', 40);

  if (!empty( $image['tn_ext'] ))
  {
    trigger_event(
      'upload_thumbnail_resize',
      false,
      $image['path'],
      get_thumbnail_path($image),
      $params['maxwidth'],
      $params['maxheight'],
      $params['quality'],
      true
      );

    return true;
  }
  return false;
}

?>