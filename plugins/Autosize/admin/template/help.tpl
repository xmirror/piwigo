{html_head} {if PHPWG_VERSION < 2.2 }
 {include file=$AUTOSIZE_PATH_ABS|@cat:'admin/template/header_2_1.tpl'}
{else}
{include file= $AUTOSIZE_PATH_ABS|@cat:'admin/template/header_2_2.tpl'}
{/if}
{/html_head}
<form action="" method="post">
<textarea   class="resizable" name="texte" id="texte" cols="80" rows="5"  >
{$message}</textarea>
<input type="submit" id="valid" name="valid" value="valid" />
</form>
{$message}




