<div class="Online" style="float:right;text-align:center;margin-right:25px; margin-bottom:60px;">
{if $Whois.Total > 0 and !$Whois.Slideshow}
	{'Total hits:'|@translate} {if (is_admin())}<a href="./admin.php?page=plugin&amp;section=whois_online%2Fconfig.php&amp;tab=report" class="other">{$Whois.Total}</a>{else}{$Whois.Total}{/if}

	{if $Whois.Current_10mins > 0}
	<br />{if $Whois.Seen_url>''}<a href="{$Whois.Seen_url}" title="{'Your recently viewed pictures'|@translate}">{/if}
	{'Most recent 10 minutes hits:'|@translate}
	{if $Whois.Seen_url>''}</a>{/if}
	 {$Whois.Current_10mins}
	{/if}

	<br />
	{if $Whois.Review_url>''}<a href="{$Whois.Review_url}" title="{'Some of recently viewed pictures by other users'|@translate}">{/if}
	{'Current hour hits:'|@translate}
	{if $Whois.Review_url>''}</a>{/if}
	 {$Whois.Current_hour}

	{if $Whois.Yesterday > 0}
	<br />
	{'Yesterday hits:'|@translate} {$Whois.Yesterday}
	{/if}

	{if $Whois.Users_Last_day > 0}
	<br />
	{'Last 24h users:'|@translate} {$Whois.Users_Last_day}
	{/if}

	{if $Whois.Users_Last_hour > 0}
	<br />
	{'Last hour online users:'|@translate} {$Whois.Users_Last_hour}
	{/if}

	{if $Whois.Guests > 0}
	<br />
	{'Recent guest(s):'|@translate} {$Whois.Guests}
	{/if}

	{if count($Whois.Online) > 0}
	<br />
	{'Recent member(s):'|@translate} {','|@implode:$Whois.Online|@substr:0:70}{if (strlen(implode(',',$Whois.Online))>70)}...{/if}
	{/if}
	
{/if}
</div>