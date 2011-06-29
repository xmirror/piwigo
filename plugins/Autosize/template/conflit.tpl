{html_head}
<script type="text/javascript"> 
    var DEBUG_autosize = '{$DEBUG_autosize}';
    var theme = '{$theme}';
    var cl_version = '{$cl_version}';
    var cl_plugin = '{$name}';
    var Version_pwg='{$Version_pwg}';
{if $DEBUG_autosize == "true"}
    var cl_query = '{$autosize_parametres->query}';
    var cl_type = '{$autosize_parametres->type}';
    var cl_plugins=new Array();
     {if not empty($cl_plugins )}
       {foreach from=$cl_plugins item=cl_plug }
            value="{$cl_plug}";cl_plugins.push(value);           
        {/foreach}
     {/if}
{/if}
</script>
{/html_head} 