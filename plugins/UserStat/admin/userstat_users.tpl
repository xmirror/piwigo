
{literal}
<script type="text/javascript">

  function loadUser(userId)
  {
    $.get("{/literal}{$datas.ajaxUrl}{literal}",
      { ajaxfct: "userStat", userId: userId },
      function (data)
      {
        $("#userDetail").html(data);
      }
    );
  }

</script>

{/literal}


<div id="userList" style="margin-bottom:20px;">
{if isset($datas.users) and count($datas.users)}
<table class="table2 littlefont" >
  <tr class="throw">
    <td rowspan="2">{'us_userName'|@translate}</td>
    <td colspan="7">{'us_userRating'|@translate}</td>
    <td colspan="3">{'us_userComments'|@translate}</td>
  </tr>
  <tr class="throw">
    <td>{'us_userNbRates'|@translate}</td>
    <td>{'us_userMaxRate'|@translate}</td>
    <td>{'us_userMinRate'|@translate}</td>
    <td>{'us_userAvgRate'|@translate}</td>
    <td>{'us_userDevRate'|@translate}</td>
    <td>{'us_userLastDayR'|@translate}</td>
    <td>{'us_userDelayR'|@translate}</td>
    <td>{'us_userNbComments'|@translate}</td>
    <td>{'us_userLastDayC'|@translate}</td>
    <td>{'us_userDelayC'|@translate}</td>
  </tr>
  {foreach from=$datas.users key=name item=data}
      <tr class="StatTableRow" style="cursor:pointer;" onclick="loadUser({$data.id})">
        <td class="toLeft">{$data.name}</td>
        <td>{$data.nbRates}</td>
        <td>{$data.maxRate}</td>
        <td>{$data.minRate}</td>
        <td>{$data.avgRate}</td>
        <td>{$data.devRate}</td>
        <td>{$data.lastDayR}</td>
        <td>{$data.delayR}</td>
        <td>{$data.nbComments}</td>
        <td>{$data.lastDayC}</td>
        <td>{$data.delayC}</td>
      </tr>
  {/foreach}
</table>
{/if}
</div>

<div id="userDetail">
</div>

