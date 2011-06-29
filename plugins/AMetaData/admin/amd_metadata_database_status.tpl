<h2>{'g003_status_of_database'|@translate}</h2>

{if $datas.warning2!=''}
<div class="warnings">
<p style="font-size: 120%;">{'g003_database_is_not_up_to_date'|@translate}</p>
{$datas.warning2}
</div>
{/if}


{if $amdConfig.amd_DisplayWarningsMessageStatus=='y'}
<div class="warnings">
<p style="font-size: 120%;">{'g003_databaseInformation'|@translate}</p>
{$datas.warning1}
</div>
{/if}

<fieldset>
<legend>{'g003_informations'|@translate}</legend>
<table class='mdInfo'>
 <tbody><tr>

   <td width="50%">
    {$datas.nfoMetadata.nfoSizeAndRows}
    <ul>
     {if !in_array('magic', $amdConfig.amd_FillDataBaseExcludeFilters)}
     <li><span class="mdInfo">Magic</span>{$datas.nfoMetadata.magic}</li>
     {/if}
     {if !(in_array('exif', $amdConfig.amd_FillDataBaseExcludeFilters) and
           in_array('exif.maker', $amdConfig.amd_FillDataBaseExcludeFilters))}
     <li><span class="mdInfo">Exif</span>{$datas.nfoMetadata.exif}</li>
     {/if}
     {if !in_array('iptc', $amdConfig.amd_FillDataBaseExcludeFilters)}
     <li><span class="mdInfo">IPTC</span>{$datas.nfoMetadata.iptc}</li>
     {/if}
     {if !in_array('xmp', $amdConfig.amd_FillDataBaseExcludeFilters)}
     <li><span class="mdInfo">XMP</span>{$datas.nfoMetadata.xmp}</li>
     {/if}
     {if !in_array('com', $amdConfig.amd_FillDataBaseExcludeFilters)}
     <li><span class="mdInfo">COM</span>{$datas.nfoMetadata.com}</li>
     {/if}
     <li><span class="mdInfo">{'g003_personnal'|@translate}</span>{$datas.nfoMetadata.userDefined}</li>
    </ul>
   </td>

   <td>
    <ul>
     <li>{$datas.nfoMetadata.numOfPictures}</li>
     <li>{$datas.nfoMetadata.numOfNotAnalyzedPictures}</li>
     <li>{$datas.nfoMetadata.numOfPicturesWithoutTag}</li>
    </ul>
   </td>
 </tr>
</tbody></table>
</fieldset>




