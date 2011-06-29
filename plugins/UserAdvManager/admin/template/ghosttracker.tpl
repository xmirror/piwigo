{combine_script id='jquery' path='themes/default/js/jquery.min.js'}
{combine_script id='jquery.cluetip' require='jquery' path='themes/default/js/plugins/jquery.cluetip.js'}
{combine_script id='jquery.tablesorter' require='jquery' path=$UAM_PATH|@cat:'admin/template/js/jquery.tablesorter.min.js'}
{combine_script id='jquery.tablesorter.pager' require='jquery' path=$UAM_PATH|@cat:'admin/template/js/jquery.tablesorter.pager.js'}

{combine_css path= $UAM_PATH|@cat:'admin/template/uam.css'}

<script type="text/javascript">
jQuery().ready(function()
{ldelim}
  jQuery('.cluetip').cluetip(
  {ldelim}
    width: 600,
    splitTitle: '|'
  {rdelim});
{rdelim});

$(document).ready(function() 
    {ldelim}
      $("#sorting")
      .tablesorter({ldelim}sortList:[[4,1]], headers: {ldelim} 0: {ldelim} sorter: false {rdelim}{rdelim}{rdelim})
      .tablesorterPager({ldelim}container: $("#pager"), positionFixed: false, size: 20, totalPages: 0{rdelim});
    {rdelim});
</script>

<div class="titrePage">
  <h2>{'UAM_Title_Tab'|@translate} {$UAM_VERSION}<br>{'UAM_SubTitle4'|@translate}</h2>
</div>

<form method="post" action="" class="general">
  <fieldset>
  	<legend>{'UAM_GT_Init'|@translate}</legend>
    <ul>
		  <li>
        <label>{'UAM_GhostTracker_Init'|@translate}</label><br><br>
      </li>
    </ul>
    <p><input class="submit" type="submit" value="{'UAM_GT_Reset'|@translate}" name="GhostTracker_Init" ></p>
  </fieldset>
  
  <fieldset>
    <legend class="cluetip" title="{'UAM_gtTitle'|translate}|{'UAM_gtTitle_d'|translate}">{'UAM_GhostTracker_Title'|@translate}</legend>
    {if count($users) > 0}
      <table id="sorting" class="table2" width="97%" summary="">
        <thead>
          <tr class="throw">
            <th>&nbsp;</th>
            <th>{'Username'|@translate}</th>
            <th>{'Profile'|@translate}</th>
            <th>{'Email address'|@translate}</th>
            <th>{'UAM_LastVisit_Date'|@translate}</th>
            <th>{'UAM_Reminder'|@translate}</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$users item=user name=users_loop}
            <tr class="{if $smarty.foreach.users_loop.index is odd}row1{else}row2{/if}">
              <td><input type="checkbox" name="selection[]" value="{$user.ID}" {$user.CHECKED} id="selection-{$user.ID}" ></td>
              <td><label for="selection-{$user.ID}">{$user.USERNAME}</label></td>
              <td style="text-align:center;"><a href="./admin.php?page=profile&amp;user_id={$user.ID}" title="{'Profile'|@translate}" onclick="window.open(this.href); return false;"><img src="{$UAM_PATH}admin/template/icon/edit_s.png"></a></td>
              <td>{$user.EMAIL}</td>
{if $user.REMINDER == l10n('UAM_Reminder_Sent_NOK')}
              <td style="color:orange;text-align:center;">{$user.LASTVISIT}</td>
              <td style="color:orange;text-align:center;">{$user.REMINDER}</td>
{else $user.REMINDER == l10n('UAM_Reminder_Sent_OK')}
              <td style="color:red;text-align:center;">{$user.LASTVISIT}</td>
              <td style="color:red;text-align:center;">{$user.REMINDER}</td>
{/if}
              {foreach from=$user.plugin_columns item=data}
                <td>{$data}</td>
              {/foreach}    			
            </tr>
          {/foreach}
        </tbody>
      </table>
<div id="pager" class="pager">
	<form>
		<img src="{$UAM_PATH}admin/template/icon/first.png" class="first">
		<img src="{$UAM_PATH}admin/template/icon/prev.png" class="prev">
		<input type="text" class="pagedisplay">
		<img src="{$UAM_PATH}admin/template/icon/next.png" class="next">
		<img src="{$UAM_PATH}admin/template/icon/last.png" class="last">
		<select class="pagesize">
			<option  value="10">10</option>
			<option selected="selected" value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
		</select>
	</form>
</div>
        <br>
<p>
  {'target'|@translate}
  <label><input type="radio" name="target" value="all" > {'all'|@translate}</label>
  <label><input type="radio" name="target" value="selection" checked="checked" > {'selection'|@translate}</label>
</p>

<p>
  <input class="submit" type="submit" value="{'UAM_Delete_selected'|@translate}" name="Del_Selected" >
  <input class="submit" type="submit" value="{'UAM_Reminder'|@translate}" name="Reminder_Email" >
</p>
  </fieldset>
		{else}
		<div>
			{'UAM_No_Ghosts'|@translate}
		</div>
		{/if}
</form>