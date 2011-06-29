{$statTabsheet}

<div id="iDisplayHelpExif" style='display:none;' class='helpBody'>
<h2>{'g003_metadata'|@translate}&nbsp;{$data.title_exif}</h2>
{$data.sheetContent_exif}
</div>

<div id="iDisplayHelpIptc" style='display:none;' class='helpBody'>
<h2>{'g003_metadata'|@translate}&nbsp;{$data.title_iptc}</h2>
{$data.sheetContent_iptc}
</div>

<div id="iDisplayHelpXmp" style='display:none;' class='helpBody'>
<h2>{'g003_metadata'|@translate}&nbsp;{$data.title_xmp}</h2>
{$data.sheetContent_xmp}
</div>

<div id="iDisplayHelpMagic" style='display:none;' class='helpBody'>
<h2>{'g003_metadata'|@translate}&nbsp;{$data.title_magic}</h2>
{$data.sheetContent_magic}
</div>

{literal}
<script type="text/javascript">

  function displayHelp(tabsheet)
  {
    switch(tabsheet)
    {
      case 'exif':
        $('#iDisplayHelpExif').css('display', 'block');
        $('#iDisplayHelpIptc').css('display', 'none');
        $('#iDisplayHelpXmp').css('display', 'none');
        $('#iDisplayHelpMagic').css('display', 'none');
        break;
      case 'iptc':
        $('#iDisplayHelpExif').css('display', 'none');
        $('#iDisplayHelpIptc').css('display', 'block');
        $('#iDisplayHelpXmp').css('display', 'none');
        $('#iDisplayHelpMagic').css('display', 'none');
        break;
      case 'xmp':
        $('#iDisplayHelpExif').css('display', 'none');
        $('#iDisplayHelpIptc').css('display', 'none');
        $('#iDisplayHelpXmp').css('display', 'block');
        $('#iDisplayHelpMagic').css('display', 'none');
        break;
      case 'magic':
        $('#iDisplayHelpExif').css('display', 'none');
        $('#iDisplayHelpIptc').css('display', 'none');
        $('#iDisplayHelpXmp').css('display', 'none');
        $('#iDisplayHelpMagic').css('display', 'block');
        break;
    }
  }

  displayHelp('exif');
</script>
{/literal}
