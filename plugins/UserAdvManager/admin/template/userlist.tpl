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
      .tablesorter(
      {ldelim}
          sortList:[[3,1]],
          // pass the headers argument and assing a object 
          headers:
          {ldelim} 
              // assign the fourth column (we start counting zero) 
              4:
              {ldelim} 
                  // disable it by setting the property sorter to false 
                  sorter: false 
              {rdelim}
          {rdelim} 
      {rdelim})
      .tablesorterPager({ldelim}container: $("#pager"), positionFixed: false, size: 20, totalPages: 0{rdelim});
    {rdelim} 
);
</script>

<div class="titrePage">
  <h2>{'UAM_Title_Tab'|@translate} {$UAM_VERSION}<br>{'UAM_SubTitle5'|@translate}</h2>
</div>

<form method="post" action="" class="general">
  <fieldset>
  	<legend class="cluetip" title="{'UAM_userlistTitle'|translate}|{'UAM_userlistTitle_d'|translate}">{'UAM_UserList_Title'|@translate}</legend>
    {if count($users) > 0}
      <table id="sorting" class="table2" width="97%" summary="">
  			<thead>
    			<tr class="throw">
      			<th>{'Username'|@translate}</th>
            <th>{'Profile'|@translate}</th>
      			<th>{'Email address'|@translate}</th>
            <th>{'UAM_LastVisit_Date'|@translate}</th>
            <th>{'UAM_Nb_Days'|@translate}</th>
    			</tr>
  			</thead>
        <tbody>
        {foreach from=$users item=user name=users_loop}
          <tr class="{if $smarty.foreach.users_loop.index is odd}row1{else}row2{/if}">
            <td><label for="selection-{$user.ID}">{$user.USERNAME}</label></td>
            <td style="text-align:center;"><a href="./admin.php?page=profile&amp;user_id={$user.ID}" title="{'Profile'|@translate}" onclick="window.open(this.href); return false;"><img src="{$UAM_PATH}admin/template/icon/edit_s.png"></a></td>
            <td>{$user.EMAIL}</td>
            <td style="text-align:center;">{$user.LASTVISIT}</td>
{if $user.DISPLAY == 'green'}
            <td style="color:lime;text-align:center;">{$user.DAYS}</td>
{elseif $user.DISPLAY == 'orange'}
            <td style="color:orange;text-align:center;">{$user.DAYS}</td>
{elseif $user.DISPLAY == 'red'}
            <td style="color:red;text-align:center;">{$user.DAYS}</td>
{else}
            <td style="text-align:center;">{$user.DAYS}</td>
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
  </fieldset>
		{else}
		<div>
			{'UAM_No_Userlist'|@translate}
		</div>
		{/if}
</form>