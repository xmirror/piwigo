</ul>
<ul class="categoryActions">
<li class="theme_menuf">
	<div>
		<ul>
			<li>
				<a rel="nofollow" href="#">
					<img class="theme_flag" src="{$theme_switch.Active.img}" alt="{$theme_switch.Active.alt}" title="{$theme_switch.Active.alt}"/>
				</a>
				<!--[if lte IE 6]>
					<a rel="nofollow" href="#">
						<img class="theme_flag" src="{$theme_switch.Active.img}" alt="{$theme_switch.Active.alt}" title="{$theme_switch.Active.alt}"/>
						<table>
							<tr>
								<td>
				<![endif]-->
									<ul class="theme_flag-pan">
									{foreach from=$theme_switch.flags key=code item=flag name=f}
										<li>
											<a rel="nofollow" href="{$SCRIPT_NAME}{$flag.url}">
												<img class="theme_flags" src="{$flag.img}" alt="{$flag.alt}" title="{$flag.alt}"/>
											</a>
										</li>
									{/foreach}
									</ul>
				<!--[if lte IE 6]>
								</td>
							</tr>
						</table>
					</a>
				<![endif]-->
			</li>
		</ul>
	</div>
</li>
{html_head}
{if $themeconf.name =='Sylvia'}
<link rel="stylesheet" type="text/css" href="{$ROOT_URL}{$THEME_SWITCH_PATH|@cat:'theme_switch.css'}"> 
{else}
<link rel="stylesheet" type="text/css" href="{$ROOT_URL}{$THEME_SWITCH_PATH|@cat:'theme_switch-default.css'}"> 
{/if}
{if Componant_exists($theme_SWITCH_PATH, 'theme_switch-local.css')}
<link rel="stylesheet" type="text/css" href="{$ROOT_URL}{$THEME_SWITCH_PATH|@cat:'theme_switch-local.css'}"> 
{/if}
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="{$ROOT_URL}{$THEME_SWITCH_PATH|@cat:'theme_switch-ie6.css'}"> 
<![endif]-->
{/html_head}