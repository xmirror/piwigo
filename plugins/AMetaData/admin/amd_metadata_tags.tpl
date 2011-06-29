
{literal}
<script type="text/javascript">

  function displayWait()
  {
    $('#iListTags').html("<br>{/literal}{'g003_loading'|@translate}{literal}<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>");
  }

  function loadKeywordsList()
  {
    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.tags.getKeywords" },
        success: function (msg)
          {
            $('#iListTags').html(msg);

            $("#iListTagsNb").html(
              "{/literal}{'g003_number_of_keywords'|@translate}{literal} "+$("#iListTags table tr").length
            );

            if($("#iListTags table tr").length==0)
            {
              $('#iApply').css('display', 'none');
            }
            else
            {
              $('#iApply').css('display', 'block');
            }
          }
      }
    );
  }

  function convertKeywordsList()
  {
    keywords=new Array();

    $('#iListTags input:checked').each(function (i,e)
     {
       re=/(\d+)$/i;
       num=$(e).attr('id').match(re);
       keywords.push($('#iTagValue'+num[1]).val());
     }
    );

    displayWait();

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.tags.convertKeywords", keywords:keywords },
        success: function (msg)
          {
            loadKeywordsList();
            if(msg=='ok')
            {
              alert("{/literal}{'g003_convert_ok'|@translate}{literal}");
            }
          }
      }
    );
  }

</script>
{/literal}

<h2>{'g003_tags'|@translate}</h2>

<div class='helps'>
  <p>{'g003_tags_page_help'|@translate}</p>
</div>

<table id='iHeaderListTags' class="littlefont">
  <tr>
    <th style="min-width:340px;">{'g003_keyword'|@translate}</th>
    <th style="width:120px;">{'g003_num_of_pictures'|@translate}</th>
    <th style="width:120px;">{'g003_tag_in_piwigo'|@translate}</th>
    <th style="width:120px;">{'g003_num_of_pictures_already_tagged'|@translate}</th>
    <th style="width:10px"></th>
  </tr>
</table>
<div id='iListTags' class="{$themeconf.name}">
</div>
<div id="iListTagsNb"></div>

<input type="button" value="{'g003_convert_keywords_and_apply'|@translate}" id='iApply' onclick='convertKeywordsList();' style='display:none;'>

<script type='text/javascript'>
  displayWait();
  loadKeywordsList();
</script>
