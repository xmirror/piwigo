<div class="themeBox {$i.THEMEBOXCLASS}">
	<div class="themeName">{$i.CURRENT_THEME_NAME}</div>
	<div class="themeShot"><img src="{$i.SCREENSHOT_URL}" alt=""></div>
	<div class="themeActions">
      <div>

      <a href="javascript:void(0)" onclick="document.getElementById('light{$i.CURRENT_THEME_ID}').style.display='block';document.getElementById('fade').style.display='block'" title="{'Configuration'|@translate}">{'Configuration'|@translate}</a>
      
      </div>
    </div> <!-- themeActions -->
  </div>
<div id="light{$i.CURRENT_THEME_ID}" class="rhconfpanel">
	<fieldset class="randomHeader_fieldset" style="float:left;">
		
		<legend>{'rh_theme'|@translate} : {$i.CURRENT_THEME_NAME}</legend>
		
		<p>
		<label>
		  {'rh_headers_category'|@translate}<br>
		  <select class="categoryDropDown" name="{$i.CURRENT_THEME_ID}selected_cat">
			<option value="0">{'rh_inactif'|@translate}</option>
			{html_options options=$categories selected=$i.CATSELECTED}
		  </select>
		</label>
		</p>
		
		<p>
		<input type="checkbox" {$i.MODE_BACKGROUND} name="{$i.CURRENT_THEME_ID}mode_background">
		<label>{'rh_as_background'|@translate}</label>
		</p>
		
		<p>
		<input type="checkbox" {$i.ACTIVE_ON_PICTURE} name="{$i.CURRENT_THEME_ID}active_on_picture">
		<label>{'rh_on_picture'|@translate}</label>
		</p>
		
		<p>
		<label>{'rh_additional_css'|@translate} :<br></label>
		<i>#theHeader :</i><br>
		<input class="rh_input" type="text" name="{$i.CURRENT_THEME_ID}head_css" value="{$i.HEAD_CSS}"><br>
		<i>#RandomImage : {'rh_inactif_on_bg'|@translate}</i><br>
		<input class="rh_input"  type="text" name="{$i.CURRENT_THEME_ID}img_css" value="{$i.IMG_CSS}">
		</p>
		
		<p>
		<label>{'rh_concat'|@translate} :</label>
		<input type="checkbox" {$i.CONCAT_BEFORE} name="{$i.CURRENT_THEME_ID}concat_before"> {'rh_before'|@translate} &nbsp; <input type="checkbox" {$i.CONCAT_AFTER} name="{$i.CURRENT_THEME_ID}concat_after"> {'rh_after'|@translate}
		</p>
		
		<p>
		<input type="checkbox" {$i.ROOT_LINK} name="{$i.CURRENT_THEME_ID}root_link">
		<label>{'rh_root_link'|@translate}</label>
		</p>
		
	</fieldset>
	<div  style="float:right;">
		<a style="border:none;" href="javascript:void(0)" onclick="document.getElementById('light{$i.CURRENT_THEME_ID}').style.display='none';document.getElementById('fade').style.display='none'" title="{'Close this window'|@translate}">
		<img src="{$ROOT_URL}{$themeconf.admin_icon_dir}/exit.png" class="button" alt="exit"></a>
	</div>
	<br>
	<div style="text-align:center;clear:left;"><input class="submit" type="submit" value="{'rh_submit'|@translate}" name="submit" ></div>
		
</div>	
