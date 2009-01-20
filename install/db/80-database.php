<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2009 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery Team    http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+

if (!defined('PHPWG_ROOT_PATH'))
{
  die('Hacking attempt!');
}

/* $list_files generated by this sh
#!/bin/sh

final_src=trunk-r3105

LIST_SOURCES="\
phpwebgallery-1.0.0 \
phpwebgallery-1.1.0 \
phpwebgallery-1.2.1 \
phpwebgallery-1.3.0 \
phpwebgallery-1.3.1 \
phpwebgallery-1.3.2 \
phpwebgallery-1.3.3 \
phpwebgallery-1.3.4 \
phpwebgallery-1.4.0 \
phpwebgallery-1.4.1 \
phpwebgallery-1.5.0 \
phpwebgallery-1.5.1 \
phpwebgallery-1.5.2 \
phpwebgallery-1.6.0RC1 \
phpwebgallery-1.6.0RC2 \
phpwebgallery-1.6.0 \
phpwebgallery-1.6.1 \
phpwebgallery-1.6.2 \
phpwebgallery-1.7.0RC1 \
phpwebgallery-1.7.0RC2 \
phpwebgallery-1.7.0 \
phpwebgallery-1.7.1 \
phpwebgallery-1.7.2 \
phpwebgallery-1.7.3 \
phpwebgallery-2.0.0RC1 \
phpwebgallery-2.0.0RC2 \
phpwebgallery-2.0.0RC3 \
phpwebgallery-2.0.0RC4 \
$final_src \
"

set $LIST_SOURCES
LastSrc=$1
shift

dir_all=`pwd`
dir_final_src=$dir_all/$Src/$final_src

for Src in $@
do
  dir_current=$dir_all/$Src
  cd $LastSrc
  echo "// Comparison between $Src and $LastSrc"
  for f in `find *`
  do
    current_file_or_dir=$dir_current/$f
    final_file_or_dir=$dir_final_src/$f
    # if not exists on current src
    [ ! -f  $current_file_or_dir ] && [ ! -d  $current_file_or_dir ] && \
    # if not exists on final src
    [ ! -f  $final_file_or_dir ] && [ ! -d  $final_file_or_dir ] && \
    # Display file or dir to delete
      echo "'$f',"
  done
  cd -
  LastSrc=$Src;
done

*/

$list_files = array(
// Comparison between phpwebgallery-1.1.0 and phpwebgallery-1.0.0
'admin_phpwebgallery',
'admin_phpwebgallery/admin.php',
'admin_phpwebgallery/ajout.php',
'admin_phpwebgallery/configuration.php',
'admin_phpwebgallery/creationBD.php',
'admin_phpwebgallery/historique.php',
'admin_phpwebgallery/index.htm',
'admin_phpwebgallery/install_step1.php',
'admin_phpwebgallery/install_step2.php',
'admin_phpwebgallery/isadmin.php',
'admin_phpwebgallery/liste_users.php',
'admin_phpwebgallery/manuel.php',
'admin_phpwebgallery/miseajour.php',
'admin_phpwebgallery/perm.php',
'commenter.php',
'debut_tableau.inc',
'fin_tableau.inc',
'help_phpwebgallery',
'help_phpwebgallery/admin.png',
'help_phpwebgallery/config_step2.png',
'help_phpwebgallery/index.htm',
'images_phpwebgallery',
'images_phpwebgallery/bleu_01.gif',
'images_phpwebgallery/bleu_02.gif',
'images_phpwebgallery/bleu_03.gif',
'images_phpwebgallery/bleu_04.gif',
'images_phpwebgallery/bleu_05.gif',
'images_phpwebgallery/bleu_06.gif',
'images_phpwebgallery/bleu_07.gif',
'images_phpwebgallery/bleu_08.gif',
'images_phpwebgallery/bleu_09.gif',
'images_phpwebgallery/commentaire.gif',
'images_phpwebgallery/espace.gif',
'images_phpwebgallery/gris_01.gif',
'images_phpwebgallery/gris_02.gif',
'images_phpwebgallery/gris_03.gif',
'images_phpwebgallery/gris_04.gif',
'images_phpwebgallery/gris_05.gif',
'images_phpwebgallery/gris_06.gif',
'images_phpwebgallery/gris_07.gif',
'images_phpwebgallery/gris_08.gif',
'images_phpwebgallery/gris_09.gif',
'images_phpwebgallery/index.htm',
'images_phpwebgallery/info.gif',
'images_phpwebgallery/lost.gif',
'images_phpwebgallery/lost2.gif',
'images_phpwebgallery/moins.gif',
'images_phpwebgallery/new_2.gif',
'images_phpwebgallery/new_rouge.gif',
'images_phpwebgallery/perm.gif',
'images_phpwebgallery/php_sqreuil_artistes.gif',
'images_phpwebgallery/plus.gif',
'images_phpwebgallery/prev.gif',
'images_phpwebgallery/puce.gif',
'images_phpwebgallery/puce_noire.gif',
'images_phpwebgallery/register.gif',
'images_phpwebgallery/register2.gif',
'images_phpwebgallery/supprimer.gif',
'images_phpwebgallery/vert_01.gif',
'images_phpwebgallery/vert_02.gif',
'images_phpwebgallery/vert_03.gif',
'images_phpwebgallery/vert_04.gif',
'images_phpwebgallery/vert_05.gif',
'images_phpwebgallery/vert_06.gif',
'images_phpwebgallery/vert_07.gif',
'images_phpwebgallery/vert_08.gif',
'images_phpwebgallery/vert_09.gif',
'images_phpwebgallery/violet_01.gif',
'images_phpwebgallery/violet_02.gif',
'images_phpwebgallery/violet_03.gif',
'images_phpwebgallery/violet_04.gif',
'images_phpwebgallery/violet_05.gif',
'images_phpwebgallery/violet_06.gif',
'images_phpwebgallery/violet_07.gif',
'images_phpwebgallery/violet_08.gif',
'images_phpwebgallery/violet_09.gif',
'include_phpwebgallery',
'include_phpwebgallery/config.php',
'include_phpwebgallery/index.htm',
'include_phpwebgallery/mysql.inc.php',
'index.htm',
// Comparison between phpwebgallery-1.2.1 and phpwebgallery-1.1.0
'admin/isadmin.php',
'images/commentaire.gif',
'images/lost.gif',
'images/prev.gif',
'images/register.gif',
'include/config.php',
'template/agjimmy/blue',
'template/agjimmy/blue/01.gif',
'template/agjimmy/blue/02.gif',
'template/agjimmy/blue/03.gif',
'template/agjimmy/blue/04.gif',
'template/agjimmy/blue/05.gif',
'template/agjimmy/blue/06.gif',
'template/agjimmy/blue/07.gif',
'template/agjimmy/blue/08.gif',
'template/agjimmy/blue/09.gif',
'template/agjimmy/blue/collapsed.gif',
'template/agjimmy/blue/commentaire.gif',
'template/agjimmy/blue/conf.php',
'template/agjimmy/blue/expanded.gif',
'template/agjimmy/blue/lost.gif',
'template/agjimmy/blue/new_long.gif',
'template/agjimmy/blue/new_short.gif',
'template/agjimmy/blue/prev.gif',
'template/agjimmy/blue/register.gif',
'template/eexell/coldblue/commentaire.gif',
'template/eexell/coldblue/prev.gif',
'template/neon',
'template/neon/black',
'template/neon/black/01.gif',
'template/neon/black/02.gif',
'template/neon/black/03.gif',
'template/neon/black/04.gif',
'template/neon/black/05.gif',
'template/neon/black/06.gif',
'template/neon/black/07.gif',
'template/neon/black/08.gif',
'template/neon/black/09.gif',
'template/neon/black/collapsed.gif',
'template/neon/black/commentaire.gif',
'template/neon/black/conf.php',
'template/neon/black/expanded.gif',
'template/neon/black/lost.gif',
'template/neon/black/new_long.gif',
'template/neon/black/new_short.gif',
'template/neon/black/prev.gif',
'template/neon/black/register.gif',
'template/rounded/blue',
'template/rounded/blue/01.gif',
'template/rounded/blue/02.gif',
'template/rounded/blue/03.gif',
'template/rounded/blue/04.gif',
'template/rounded/blue/05.gif',
'template/rounded/blue/06.gif',
'template/rounded/blue/07.gif',
'template/rounded/blue/08.gif',
'template/rounded/blue/09.gif',
'template/rounded/blue/collapsed.gif',
'template/rounded/blue/commentaire.gif',
'template/rounded/blue/conf.php',
'template/rounded/blue/expanded.gif',
'template/rounded/blue/lost.gif',
'template/rounded/blue/new_long.gif',
'template/rounded/blue/new_short.gif',
'template/rounded/blue/prev.gif',
'template/rounded/blue/register.gif',
'template/rounded/darkgray/commentaire.gif',
'template/rounded/darkgray/prev.gif',
'template/rounded/gray',
'template/rounded/gray/01.gif',
'template/rounded/gray/02.gif',
'template/rounded/gray/03.gif',
'template/rounded/gray/04.gif',
'template/rounded/gray/05.gif',
'template/rounded/gray/06.gif',
'template/rounded/gray/07.gif',
'template/rounded/gray/08.gif',
'template/rounded/gray/09.gif',
'template/rounded/gray/collapsed.gif',
'template/rounded/gray/commentaire.gif',
'template/rounded/gray/conf.php',
'template/rounded/gray/expanded.gif',
'template/rounded/gray/lost.gif',
'template/rounded/gray/new_long.gif',
'template/rounded/gray/new_short.gif',
'template/rounded/gray/prev.gif',
'template/rounded/gray/register.gif',
// Comparison between phpwebgallery-1.3.0 and phpwebgallery-1.2.1
'a_propos.php',
'admin/ajout.php',
'admin/cat.php',
'admin/edit_cat.php',
'admin/historique.php',
'admin/images/arrow_up.gif',
'admin/images/moins.gif',
'admin/images/plus.gif',
'admin/images/puce.gif',
'admin/liste_users.php',
'admin/manuel.php',
'admin/miseajour.php',
'admin/perm.php',
'diapo.php',
'images',
'images/php_sqreuil_artistes.gif',
'include/functions.php',
'include/index.htm',
'include/style.php',
'language/czech.php',
'language/danish.php',
'language/italiano.php',
'language/nederlands.php',
'personnaliser.php',
'photo.php',
'template/agjimmy',
'template/agjimmy/lightred',
'template/agjimmy/lightred/01.gif',
'template/agjimmy/lightred/02.gif',
'template/agjimmy/lightred/03.gif',
'template/agjimmy/lightred/04.gif',
'template/agjimmy/lightred/05.gif',
'template/agjimmy/lightred/06.gif',
'template/agjimmy/lightred/07.gif',
'template/agjimmy/lightred/08.gif',
'template/agjimmy/lightred/09.gif',
'template/agjimmy/lightred/collapsed.gif',
'template/agjimmy/lightred/commentaire.gif',
'template/agjimmy/lightred/conf.php',
'template/agjimmy/lightred/delete.gif',
'template/agjimmy/lightred/del_favorite.gif',
'template/agjimmy/lightred/expanded.gif',
'template/agjimmy/lightred/favorite.gif',
'template/agjimmy/lightred/lost.gif',
'template/agjimmy/lightred/new_long.gif',
'template/agjimmy/lightred/new_short.gif',
'template/agjimmy/lightred/register.gif',
'template/eexell',
'template/eexell/coldblue',
'template/eexell/coldblue/01.gif',
'template/eexell/coldblue/02.gif',
'template/eexell/coldblue/03.gif',
'template/eexell/coldblue/04.gif',
'template/eexell/coldblue/05.gif',
'template/eexell/coldblue/06.gif',
'template/eexell/coldblue/07.gif',
'template/eexell/coldblue/08.gif',
'template/eexell/coldblue/09.gif',
'template/eexell/coldblue/collapsed.gif',
'template/eexell/coldblue/conf.php',
'template/eexell/coldblue/delete.gif',
'template/eexell/coldblue/del_favorite.gif',
'template/eexell/coldblue/expanded.gif',
'template/eexell/coldblue/favorite.gif',
'template/eexell/coldblue/lost.gif',
'template/eexell/coldblue/new_long.gif',
'template/eexell/coldblue/new_short.gif',
'template/eexell/coldblue/register.gif',
'template/erya',
'template/erya/blue',
'template/erya/blue/01.gif',
'template/erya/blue/02.gif',
'template/erya/blue/03.gif',
'template/erya/blue/04.gif',
'template/erya/blue/05.gif',
'template/erya/blue/06.gif',
'template/erya/blue/07.gif',
'template/erya/blue/08.gif',
'template/erya/blue/09.gif',
'template/erya/blue/collapsed.gif',
'template/erya/blue/conf.php',
'template/erya/blue/delete.gif',
'template/erya/blue/del_favorite.gif',
'template/erya/blue/expanded.gif',
'template/erya/blue/favorite.gif',
'template/erya/blue/lost.gif',
'template/erya/blue/new_long.gif',
'template/erya/blue/new_short.gif',
'template/erya/blue/register.gif',
'template/melodie',
'template/melodie/blue',
'template/melodie/blue/01.gif',
'template/melodie/blue/02.gif',
'template/melodie/blue/03.gif',
'template/melodie/blue/04.gif',
'template/melodie/blue/05.gif',
'template/melodie/blue/06.gif',
'template/melodie/blue/07.gif',
'template/melodie/blue/08.gif',
'template/melodie/blue/09.gif',
'template/melodie/blue/collapsed.gif',
'template/melodie/blue/conf.php',
'template/melodie/blue/delete.gif',
'template/melodie/blue/del_favorite.gif',
'template/melodie/blue/expanded.gif',
'template/melodie/blue/favorite.gif',
'template/melodie/blue/lost.gif',
'template/melodie/blue/new_long.gif',
'template/melodie/blue/new_short.gif',
'template/melodie/blue/register.gif',
'template/rounded',
'template/rounded/darkgray',
'template/rounded/darkgray/01.gif',
'template/rounded/darkgray/02.gif',
'template/rounded/darkgray/03.gif',
'template/rounded/darkgray/04.gif',
'template/rounded/darkgray/05.gif',
'template/rounded/darkgray/06.gif',
'template/rounded/darkgray/07.gif',
'template/rounded/darkgray/08.gif',
'template/rounded/darkgray/09.gif',
'template/rounded/darkgray/collapsed.gif',
'template/rounded/darkgray/conf.php',
'template/rounded/darkgray/delete.gif',
'template/rounded/darkgray/del_favorite.gif',
'template/rounded/darkgray/expanded.gif',
'template/rounded/darkgray/favorite.gif',
'template/rounded/darkgray/lost.gif',
'template/rounded/darkgray/new_long.gif',
'template/rounded/darkgray/new_short.gif',
'template/rounded/darkgray/register.gif',
'template/square',
'template/square/light',
'template/square/light/01.gif',
'template/square/light/02.gif',
'template/square/light/03.gif',
'template/square/light/04.gif',
'template/square/light/05.gif',
'template/square/light/06.gif',
'template/square/light/07.gif',
'template/square/light/08.gif',
'template/square/light/09.gif',
'template/square/light/collapsed.gif',
'template/square/light/conf.php',
'template/square/light/delete.gif',
'template/square/light/del_favorite.gif',
'template/square/light/expanded.gif',
'template/square/light/favorite.gif',
'template/square/light/lost.gif',
'template/square/light/new_long.gif',
'template/square/light/new_short.gif',
'template/square/light/register.gif',
// Comparison between phpwebgallery-1.3.1 and phpwebgallery-1.3.0
'template/default/style.inc.php',
'template/default/theme/conf.php',
// Comparison between phpwebgallery-1.3.2 and phpwebgallery-1.3.1
// Comparison between phpwebgallery-1.3.3 and phpwebgallery-1.3.2
// Comparison between phpwebgallery-1.3.4 and phpwebgallery-1.3.3
// Comparison between phpwebgallery-1.4.0 and phpwebgallery-1.3.4
'admin/admin.php',
'admin/create_listing_file.php',
'admin/images/admin.png',
'admin/install.php',
'admin/phpwebgallery_structure.sql',
'admin/user_modify.php',
'include/init.inc.php',
'include/vtemplate.class.php',
'language/catala.php',
'language/czech.php',
'language/deutsch.php',
'language/dutch.php',
'language/english.php',
'language/francais.php',
'language/japanese.php',
'language/magyar.php',
'language/norsk.php',
'language/portuguese-br.php',
'language/russian.php',
'language/spanish.php',
'language/svenska.php',
'readme.txt',
'template/default/about.vtp',
'template/default/admin/admin.vtp',
'template/default/admin/cat_list.vtp',
'template/default/admin/cat_modify.vtp',
'template/default/admin/comments.vtp',
'template/default/admin/configuration.vtp',
'template/default/admin/group_list.vtp',
'template/default/admin/group_perm.vtp',
'template/default/admin/help.vtp',
'template/default/admin/infos_image.vtp',
'template/default/admin/install.vtp',
'template/default/admin/picture_modify.vtp',
'template/default/admin/stats.vtp',
'template/default/admin/thumbnail.vtp',
'template/default/admin/update.vtp',
'template/default/admin/user_list.vtp',
'template/default/admin/user_modify.vtp',
'template/default/admin/user_perm.vtp',
'template/default/admin/waiting.vtp',
'template/default/category.vtp',
'template/default/comments.vtp',
'template/default/default-admin.css',
'template/default/footer.htm',
'template/default/footer.vtp',
'template/default/header.htm',
'template/default/header.vtp',
'template/default/htmlfunctions.inc.php',
'template/default/identification.vtp',
'template/default/picture.vtp',
'template/default/profile.vtp',
'template/default/register.vtp',
'template/default/search.vtp',
'template/default/theme/01.gif',
'template/default/theme/02.gif',
'template/default/theme/03.gif',
'template/default/theme/04.gif',
'template/default/theme/05.gif',
'template/default/theme/06.gif',
'template/default/theme/07.gif',
'template/default/theme/08.gif',
'template/default/theme/09.gif',
'template/default/theme/collapsed.gif',
'template/default/theme/expanded.gif',
'template/default/theme/new_long.gif',
'template/default/theme/new_short.gif',
'template/default/upload.vtp',
// Comparison between phpwebgallery-1.4.1 and phpwebgallery-1.4.0
// Comparison between phpwebgallery-1.5.0 and phpwebgallery-1.4.1
'admin/admin_phpinfo.php',
'admin/infos_images.php',
'admin/search.php',
'include/config.inc.php',
'install/dbscheme.txt',
'install/upgrade_1.3.2.php',
'install/upgrade_1.3.3.php',
'install/upgrade_1.3.4.php',
'language/en_UK.iso-8859-1/faq.lang.php',
'language/fr_FR.iso-8859-1/faq.lang.php',
'template/default',
'template/default/about.tpl',
'template/default/admin',
'template/default/admin/cat_list.tpl',
'template/default/admin/cat_modify.tpl',
'template/default/admin/cat_options.tpl',
'template/default/admin/cat_perm.vtp',
'template/default/admin/configuration.tpl',
'template/default/admin/group_list.tpl',
'template/default/admin/group_perm.tpl',
'template/default/admin/help.tpl',
'template/default/admin/images',
'template/default/admin/images/arrow_down.gif',
'template/default/admin/images/arrow_first.gif',
'template/default/admin/images/arrow_last.gif',
'template/default/admin/images/arrow_select.gif',
'template/default/admin/images/arrow_up.gif',
'template/default/admin/images/collapsed.gif',
'template/default/admin/images/delete.gif',
'template/default/admin/images/expanded.gif',
'template/default/admin/images/icon_folder.gif',
'template/default/admin/images/icon_folder_link.gif',
'template/default/admin/images/icon_folder_lock.gif',
'template/default/admin/images/icon_subfolder.gif',
'template/default/admin/images/moins.gif',
'template/default/admin/images/plus.gif',
'template/default/admin/images/puce.gif',
'template/default/admin/images/stat_left.gif',
'template/default/admin/images/stat_middle.gif',
'template/default/admin/images/stat_right.gif',
'template/default/admin/infos_images.tpl',
'template/default/admin/picture_modify.tpl',
'template/default/admin/remote_site.tpl',
'template/default/admin/search_username.tpl',
'template/default/admin/stats.tpl',
'template/default/admin/thumbnail.tpl',
'template/default/admin/update.tpl',
'template/default/admin/user_perm.tpl',
'template/default/admin/waiting.tpl',
'template/default/admin.tpl',
'template/default/category.tpl',
'template/default/comments.tpl',
'template/default/default.css',
'template/default/footer.tpl',
'template/default/header.tpl',
'template/default/identification.tpl',
'template/default/images',
'template/default/images/logo.jpg',
'template/default/images/php_sqreuil_artistes.gif',
'template/default/install.tpl',
'template/default/mimetypes',
'template/default/mimetypes/avi.png',
'template/default/mimetypes/mp3.png',
'template/default/mimetypes/mpg.png',
'template/default/mimetypes/ogg.png',
'template/default/mimetypes/zip.png',
'template/default/picture.tpl',
'template/default/profile.tpl',
'template/default/redirect.tpl',
'template/default/register.tpl',
'template/default/search.tpl',
'template/default/theme',
'template/default/theme/button_bg.gif',
'template/default/theme/categories.gif',
'template/default/theme/delete.gif',
'template/default/theme/del_favorite.gif',
'template/default/theme/download.gif',
'template/default/theme/eCard.gif',
'template/default/theme/favorite.gif',
'template/default/theme/left-arrow.gif',
'template/default/theme/lost.gif',
'template/default/theme/metadata.gif',
'template/default/theme/properties.gif',
'template/default/theme/recent.gif',
'template/default/theme/register.gif',
'template/default/theme/right-arrow.gif',
'template/default/theme/slideshow.gif',
'template/default/theme/tableh1_bg.gif',
'template/default/upgrade.tpl',
'template/default/upload.tpl',
// Comparison between phpwebgallery-1.5.1 and phpwebgallery-1.5.0
'include/.cvsignore',
// Comparison between phpwebgallery-1.5.2 and phpwebgallery-1.5.1
// Comparison between phpwebgallery-1.6.0RC1 and phpwebgallery-1.5.2
'admin/include/isadmin.inc.php',
'admin/remote_site.php',
'admin/update.php',
'include/category_calendar.inc.php',
'install/upgrade_1.4.1.php',
'template/yoga/admin/images',
'template/yoga/admin/images/errors.png',
'template/yoga/admin/images/infos.png',
'template/yoga/admin/remote_site.tpl',
'template/yoga/admin/update.tpl',
'template/yoga/category.tpl',
'template/yoga/mimetypes',
'template/yoga/mimetypes/avi.png',
'template/yoga/mimetypes/mp3.png',
'template/yoga/mimetypes/mpg.png',
'template/yoga/mimetypes/ogg.png',
'template/yoga/mimetypes/zip.png',
'template/yoga/theme/caddie_add.png',
'template/yoga/theme/category_children.png',
'template/yoga/theme/category_delete.png',
'template/yoga/theme/category_edit.png',
'template/yoga/theme/category_elements.png',
'template/yoga/theme/category_jump-to.png',
'template/yoga/theme/category_permissions.png',
'template/yoga/theme/category_representant_random.png',
'template/yoga/theme/delete.png',
'template/yoga/theme/del_favorite.png',
'template/yoga/theme/exit.png',
'template/yoga/theme/favorite.png',
'template/yoga/theme/help.png',
'template/yoga/theme/home.png',
'template/yoga/theme/left.png',
'template/yoga/theme/lost_password.png',
'template/yoga/theme/metadata.png',
'template/yoga/theme/permissions.png',
'template/yoga/theme/preferences.png',
'template/yoga/theme/recent.png',
'template/yoga/theme/register.png',
'template/yoga/theme/representative.png',
'template/yoga/theme/right.png',
'template/yoga/theme/save.png',
'template/yoga/theme/slideshow.png',
'template/yoga/theme/sync_metadata.png',
'template/yoga/theme/up.png',
'template/yoga-dark',
'template/yoga-dark/about.tpl',
'template/yoga-dark/admin',
'template/yoga-dark/admin/cat_list.tpl',
'template/yoga-dark/admin/cat_modify.tpl',
'template/yoga-dark/admin/cat_move.tpl',
'template/yoga-dark/admin/cat_options.tpl',
'template/yoga-dark/admin/cat_perm.tpl',
'template/yoga-dark/admin/comments.tpl',
'template/yoga-dark/admin/configuration.tpl',
'template/yoga-dark/admin/double_select.tpl',
'template/yoga-dark/admin/element_set_global.tpl',
'template/yoga-dark/admin/element_set_unit.tpl',
'template/yoga-dark/admin/group_list.tpl',
'template/yoga-dark/admin/group_perm.tpl',
'template/yoga-dark/admin/images',
'template/yoga-dark/admin/images/errors.png',
'template/yoga-dark/admin/images/infos.png',
'template/yoga-dark/admin/intro.tpl',
'template/yoga-dark/admin/maintenance.tpl',
'template/yoga-dark/admin/picture_modify.tpl',
'template/yoga-dark/admin/remote_site.tpl',
'template/yoga-dark/admin/stats.tpl',
'template/yoga-dark/admin/thumbnail.tpl',
'template/yoga-dark/admin/update.tpl',
'template/yoga-dark/admin/user_list.tpl',
'template/yoga-dark/admin/user_perm.tpl',
'template/yoga-dark/admin/waiting.tpl',
'template/yoga-dark/admin.tpl',
'template/yoga-dark/category.tpl',
'template/yoga-dark/comments.tpl',
'template/yoga-dark/content.css',
'template/yoga-dark/dclear.css',
'template/yoga-dark/default-colors.css',
'template/yoga-dark/default-layout.css',
'template/yoga-dark/fix-khtml.css',
'template/yoga-dark/footer.tpl',
'template/yoga-dark/header.tpl',
'template/yoga-dark/identification.tpl',
'template/yoga-dark/image.css',
'template/yoga-dark/install.tpl',
'template/yoga-dark/menubar.css',
'template/yoga-dark/mimetypes',
'template/yoga-dark/mimetypes/avi.png',
'template/yoga-dark/mimetypes/mp3.png',
'template/yoga-dark/mimetypes/mpg.png',
'template/yoga-dark/mimetypes/ogg.png',
'template/yoga-dark/mimetypes/zip.png',
'template/yoga-dark/notification.tpl',
'template/yoga-dark/password.tpl',
'template/yoga-dark/picture.tpl',
'template/yoga-dark/popuphelp.css',
'template/yoga-dark/popuphelp.tpl',
'template/yoga-dark/print.css',
'template/yoga-dark/profile.tpl',
'template/yoga-dark/redirect.tpl',
'template/yoga-dark/register.tpl',
'template/yoga-dark/search.tpl',
'template/yoga-dark/theme',
'template/yoga-dark/theme/button_bg.gif',
'template/yoga-dark/theme/caddie_add.png',
'template/yoga-dark/theme/category_children.png',
'template/yoga-dark/theme/category_delete.png',
'template/yoga-dark/theme/category_edit.png',
'template/yoga-dark/theme/category_elements.png',
'template/yoga-dark/theme/category_jump-to.png',
'template/yoga-dark/theme/category_permissions.png',
'template/yoga-dark/theme/category_representant_random.png',
'template/yoga-dark/theme/delete.png',
'template/yoga-dark/theme/del_favorite.png',
'template/yoga-dark/theme/exit.png',
'template/yoga-dark/theme/favorite.png',
'template/yoga-dark/theme/help.png',
'template/yoga-dark/theme/home.png',
'template/yoga-dark/theme/left.png',
'template/yoga-dark/theme/lost_password.png',
'template/yoga-dark/theme/metadata.png',
'template/yoga-dark/theme/permissions.png',
'template/yoga-dark/theme/preferences.png',
'template/yoga-dark/theme/recent.png',
'template/yoga-dark/theme/register.png',
'template/yoga-dark/theme/representative.png',
'template/yoga-dark/theme/right.png',
'template/yoga-dark/theme/save.png',
'template/yoga-dark/theme/slideshow.png',
'template/yoga-dark/theme/sync_metadata.png',
'template/yoga-dark/theme/tableh1_bg.gif',
'template/yoga-dark/theme/tableh2_bg.gif',
'template/yoga-dark/theme/up.png',
'template/yoga-dark/upgrade.tpl',
'template/yoga-dark/upload.tpl',
// Comparison between phpwebgallery-1.6.0RC2 and phpwebgallery-1.6.0RC1
// Comparison between phpwebgallery-1.6.0 and phpwebgallery-1.6.0RC2
'template/yoga/dclear.css',
'template/yoga/image.css',
// Comparison between phpwebgallery-1.6.1 and phpwebgallery-1.6.0
'admin/images/index.htm',
'admin/include/index.htm',
'admin/index.htm',
'galleries/index.htm',
'language/index.htm',
// Comparison between phpwebgallery-1.6.2 and phpwebgallery-1.6.1
// Comparison between phpwebgallery-1.7.0RC1 and phpwebgallery-1.6.2
'admin/images/daily_stats.img.php',
'admin/images/global_stats.img.php',
'admin/images/monthly_stats.img.php',
'admin/images/phpBarGraph.php',
'include/category_recent_cats.inc.php',
'include/category_subcats.inc.php',
'include/pngfix.js',
'include/scripts.js',
'install/db/22.1-database.php',
'install/db/22.2-database.php',
'install/db/22.3-database.php',
'install/db/22.5-database.php',
'install/db/22.6-database.php',
'install/db/22.7-database.php',
'install/db/22.8-database.php',
'install/db/22.9-database.php',
'language/en_UK.iso-8859-1/help/remote_site.html',
'language/fr_FR.iso-8859-1/help/remote_site.html',
'template/yoga/upgrade.tpl',
// Comparison between phpwebgallery-1.7.0RC2 and phpwebgallery-1.7.0RC1
'admin/waiting.php',
'template/yoga/admin/waiting.tpl',
// Comparison between phpwebgallery-1.7.0 and phpwebgallery-1.7.0RC2
// Comparison between phpwebgallery-1.7.1 and phpwebgallery-1.7.0
// Comparison between phpwebgallery-1.7.2 and phpwebgallery-1.7.1
'include/functions_group.inc.php',
'template/yoga/thumbnails-fix-ie5-ie6.css',
// Comparison between phpwebgallery-1.7.3 and phpwebgallery-1.7.2
// Comparison between phpwebgallery-2.0.0RC1 and phpwebgallery-1.7.3
'admin/include/functions_check_integrity.inc.php',
'admin/include/functions_tabsheet.inc.php',
'admin/plugins.php',
'admin/ws_checker.php',
'include/template.php',
'install/phpwebgallery_structure.sql',
'language/en_UK.iso-8859-1',
'language/en_UK.iso-8859-1/about.html',
'language/en_UK.iso-8859-1/admin.lang.php',
'language/en_UK.iso-8859-1/common.lang.php',
'language/en_UK.iso-8859-1/help',
'language/en_UK.iso-8859-1/help/advanced_feature.html',
'language/en_UK.iso-8859-1/help/cat_modify.html',
'language/en_UK.iso-8859-1/help/cat_move.html',
'language/en_UK.iso-8859-1/help/cat_options.html',
'language/en_UK.iso-8859-1/help/cat_perm.html',
'language/en_UK.iso-8859-1/help/configuration.html',
'language/en_UK.iso-8859-1/help/group_list.html',
'language/en_UK.iso-8859-1/help/history.html',
'language/en_UK.iso-8859-1/help/index.php',
'language/en_UK.iso-8859-1/help/maintenance.html',
'language/en_UK.iso-8859-1/help/notification_by_mail.html',
'language/en_UK.iso-8859-1/help/permalinks.html',
'language/en_UK.iso-8859-1/help/search.html',
'language/en_UK.iso-8859-1/help/site_manager.html',
'language/en_UK.iso-8859-1/help/synchronize.html',
'language/en_UK.iso-8859-1/help/thumbnail.html',
'language/en_UK.iso-8859-1/help/user_list.html',
'language/en_UK.iso-8859-1/help/web_service.html',
'language/en_UK.iso-8859-1/help.html',
'language/en_UK.iso-8859-1/index.php',
'language/en_UK.iso-8859-1/install.lang.php',
'language/en_UK.iso-8859-1/iso.txt',
'language/fr_FR.iso-8859-1',
'language/fr_FR.iso-8859-1/about.html',
'language/fr_FR.iso-8859-1/admin.lang.php',
'language/fr_FR.iso-8859-1/common.lang.php',
'language/fr_FR.iso-8859-1/help',
'language/fr_FR.iso-8859-1/help/advanced_feature.html',
'language/fr_FR.iso-8859-1/help/cat_modify.html',
'language/fr_FR.iso-8859-1/help/cat_move.html',
'language/fr_FR.iso-8859-1/help/cat_options.html',
'language/fr_FR.iso-8859-1/help/cat_perm.html',
'language/fr_FR.iso-8859-1/help/configuration.html',
'language/fr_FR.iso-8859-1/help/group_list.html',
'language/fr_FR.iso-8859-1/help/history.html',
'language/fr_FR.iso-8859-1/help/index.php',
'language/fr_FR.iso-8859-1/help/maintenance.html',
'language/fr_FR.iso-8859-1/help/notification_by_mail.html',
'language/fr_FR.iso-8859-1/help/permalinks.html',
'language/fr_FR.iso-8859-1/help/search.html',
'language/fr_FR.iso-8859-1/help/site_manager.html',
'language/fr_FR.iso-8859-1/help/synchronize.html',
'language/fr_FR.iso-8859-1/help/thumbnail.html',
'language/fr_FR.iso-8859-1/help/user_list.html',
'language/fr_FR.iso-8859-1/help/web_service.html',
'language/fr_FR.iso-8859-1/help.html',
'language/fr_FR.iso-8859-1/index.php',
'language/fr_FR.iso-8859-1/install.lang.php',
'language/fr_FR.iso-8859-1/iso.txt',
'plugins/add_index/language/en_UK.iso-8859-1',
'plugins/add_index/language/en_UK.iso-8859-1/help',
'plugins/add_index/language/en_UK.iso-8859-1/help/advanced_feature.html',
'plugins/add_index/language/en_UK.iso-8859-1/help/index.php',
'plugins/add_index/language/en_UK.iso-8859-1/help/site_manager.html',
'plugins/add_index/language/en_UK.iso-8859-1/index.php',
'plugins/add_index/language/en_UK.iso-8859-1/plugin.lang.php',
'plugins/add_index/language/fr_FR.iso-8859-1',
'plugins/add_index/language/fr_FR.iso-8859-1/help',
'plugins/add_index/language/fr_FR.iso-8859-1/help/advanced_feature.html',
'plugins/add_index/language/fr_FR.iso-8859-1/help/index.php',
'plugins/add_index/language/fr_FR.iso-8859-1/help/site_manager.html',
'plugins/add_index/language/fr_FR.iso-8859-1/index.php',
'plugins/add_index/language/fr_FR.iso-8859-1/plugin.lang.php',
'plugins/admin_advices/en_UK.iso-8859-1',
'plugins/admin_advices/en_UK.iso-8859-1/index.php',
'plugins/admin_advices/en_UK.iso-8859-1/lang.adv.php',
'plugins/admin_advices/fr_FR.iso-8859-1',
'plugins/admin_advices/fr_FR.iso-8859-1/index.php',
'plugins/admin_advices/fr_FR.iso-8859-1/lang.adv.php',
'plugins/hello_world',
'plugins/hello_world/index.php',
'plugins/hello_world/main.inc.php',
'template/yoga/admin',
'template/yoga/admin/advanced_feature.tpl',
'template/yoga/admin/cat_list.tpl',
'template/yoga/admin/cat_modify.tpl',
'template/yoga/admin/cat_move.tpl',
'template/yoga/admin/cat_options.tpl',
'template/yoga/admin/cat_perm.tpl',
'template/yoga/admin/check_integrity.tpl',
'template/yoga/admin/comments.tpl',
'template/yoga/admin/configuration.tpl',
'template/yoga/admin/default-layout.css',
'template/yoga/admin/double_select.tpl',
'template/yoga/admin/element_set_global.tpl',
'template/yoga/admin/element_set_unit.tpl',
'template/yoga/admin/group_list.tpl',
'template/yoga/admin/group_perm.tpl',
'template/yoga/admin/history.tpl',
'template/yoga/admin/index.php',
'template/yoga/admin/intro.tpl',
'template/yoga/admin/maintenance.tpl',
'template/yoga/admin/notification_by_mail.tpl',
'template/yoga/admin/permalinks.tpl',
'template/yoga/admin/picture_modify.tpl',
'template/yoga/admin/plugin.tpl',
'template/yoga/admin/plugins.tpl',
'template/yoga/admin/profile.tpl',
'template/yoga/admin/rating.tpl',
'template/yoga/admin/site_manager.tpl',
'template/yoga/admin/site_update.tpl',
'template/yoga/admin/stats.tpl',
'template/yoga/admin/tabsheet.tpl',
'template/yoga/admin/tags.tpl',
'template/yoga/admin/thumbnail.tpl',
'template/yoga/admin/upload.tpl',
'template/yoga/admin/user_list.tpl',
'template/yoga/admin/user_perm.tpl',
'template/yoga/admin/ws_checker.tpl',
'template/yoga/admin.tpl',
'template/yoga/icon/category_delete.png',
'template/yoga/icon/category_elements.png',
'template/yoga/icon/category_jump-to.png',
'template/yoga/icon/category_permissions.png',
'template/yoga/icon/check.png',
'template/yoga/icon/edit_s.png',
'template/yoga/icon/page_end.png',
'template/yoga/icon/page_top.png',
'template/yoga/icon/permissions.png',
'template/yoga/icon/slideshow.png',
'template/yoga/icon/star_e.gif',
'template/yoga/icon/star_f.gif',
'template/yoga/icon/sync_metadata.png',
'template/yoga/icon/toggle_is_default_group.png',
'template/yoga/icon/uncheck.png',
'template/yoga/icon/virt_category.png',
'template/yoga/popuphelp.css',
'template-common/layout.css',
// Comparison between phpwebgallery-2.0.0RC2 and phpwebgallery-2.0.0RC1
'language/en_UK/help/web_service.html',
'language/es_ES/help/web_service.html',
'language/fr_FR/help/web_service.html',
'language/it_IT/help/web_service.html',
'language/nl_NL/help/web_service.html',
'template/yoga/mail/text/html/admin',
'template/yoga/mail/text/html/admin/cat_group_info.tpl',
'template/yoga/mail/text/html/admin/index.php',
'template/yoga/mail/text/html/admin/notification_by_mail.tpl',
'template/yoga/mail/text/plain/admin',
'template/yoga/mail/text/plain/admin/cat_group_info.tpl',
'template/yoga/mail/text/plain/admin/index.php',
'template/yoga/mail/text/plain/admin/notification_by_mail.tpl',
'template-common/lib/plugins/jquery.growfield.js',
'template-common/lib/plugins/jquery.growfield.packed.js',
// Comparison between phpwebgallery-2.0.0RC3 and phpwebgallery-2.0.0RC2
'admin/template/goto/icon/del_favorite.png',
'admin/template/goto/theme/roma/datepicker.css',
// Comparison between phpwebgallery-2.0.0RC4 and phpwebgallery-2.0.0RC3
'template/yoga/install.tpl',
'template/yoga/upgrade.tpl',
// Comparison between trunk-r3105 and phpwebgallery-2.0.0RC4
'admin/template/goto/theme/roma/images/bottom-left-bg.png',
'admin/template/goto/theme/roma/images/top-left-bg.png',
'include/mysql.inc.php',
'template-common/lib/ui/ui.accordion.packed.js',
'template-common/lib/ui/ui.core.packed.js',
'template-common/lib/ui/ui.datepicker.css',
'template-common/lib/ui/ui.datepicker.packed.js',
'template-common/lib/ui/ui.dialog.packed.js',
'template-common/lib/ui/ui.draggable.packed.js',
'template-common/lib/ui/ui.droppable.packed.js',
'template-common/lib/ui/ui.resizable.packed.js',
'template-common/lib/ui/ui.selectable.packed.js',
'template-common/lib/ui/ui.slider.packed.js',
'template-common/lib/ui/ui.sortable.packed.js',
'template-common/lib/ui/ui.tabs.packed.js',
);

$list_exlude_files = array(
'include/mysql.inc.php',
);


$upgrade_description = 'Delete old and not used files';

// +-----------------------------------------------------------------------+
// |                            Upgrade content                            |
// +-----------------------------------------------------------------------+
// remove exclude files
$files=array_diff($list_files, $list_exlude_files);
// inverse sort in order to remove corretly directory
rsort($files);

foreach ($files as $file)
{
  if (is_file($file))
  {
    echo 'Delete file '.$file."\n";
    if (! unlink($file))
    {
      echo 'Error on delete file '.$file."\n";
    }
  }
  elseif (is_dir($file))
  {
    echo 'Delete directory '.$file."\n";
    if (! rmdir($file))
    {
      echo 'Error on directory file '.$file."\n";
    }
  }
}

echo
"\n"
.'"'.$upgrade_description.'"'.' ended'
."\n"
;

?>
