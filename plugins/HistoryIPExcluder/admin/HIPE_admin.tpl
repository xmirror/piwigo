<div class="titrePage">
  <h2>{$HIPE_NAME}{'HIPE_version'|@translate}{$HIPE_VERSION}</h2>
</div>

<p>{'HIPE_description'|@translate}</p>

<form method="post" action="" class="general">
  <fieldset>
    <legend>{'HIPE_admin_section1'|@translate}</legend>

    <br>

    <label>{'HIPE_admin_description1'|@translate}</label>
    
    <div style="text-align:center;">
      <textarea name="HIPE_IPs_Excluded" rows="10" cols="30" {$TAG_INPUT_ENABLED}>{$IPs_EXCLUDED}</textarea>
    </div>

    <fieldset>
    <legend>{'HIPE_IPBlacklist_title'|@translate}</legend>
      <ul>
		    <li><input type="checkbox" name="HIPE_chkb" {$HIPE_IPBlacklisted} value="1">&nbsp;{'HIPE_IPBlacklisted'|@translate}</li>
      </ul>
    </fieldset>
    
    <p><input type="submit" name="submit" value="{'submit'|@translate}" class="bouton" {$TAG_INPUT_ENABLED}> <input type="submit" name="CleanHist" value="{'HIPE_CleanHist'|@translate}" class="bouton" {$TAG_INPUT_ENABLED}></p>
  
  </fieldset>

  <fieldset>
    <legend>{'HIPE_admin_section2'|@translate}</legend>
  
      <p style="text-align:center;">
        <input type="submit" name="HIPE_IPByMember" value="{'HIPE_IPByMember'|@translate}" class="bouton" {$TAG_INPUT_ENABLED}>
        <input type="submit" name="HIPE_OnlyGuest" value="{'HIPE_OnlyGuest'|@translate}" class="bouton" {$TAG_INPUT_ENABLED}>
      </p>
  
      <p style="text-align:center;">
        <input type="submit" name="HIPE_MemberForIp" value="{'HIPE_MemberForIp'|@translate}" class="bouton" {$TAG_INPUT_ENABLED}>
		    <input type="text" name="HIPE_input" value="" size="20" style="text-align: center;" {$TAG_INPUT_ENABLED}>
        <input type="submit" name="HIPE_IPForMember" value="{'HIPE_IPForMember'|@translate}" class="bouton" {$TAG_INPUT_ENABLED}>
      </p>

    <fieldset>
      <legend>{'HIPE_admin_section3'|@translate}</legend>
	 
      <label>{$HIPE_DESCRIPTION2}</label>

      <p style="text-align:center;">
      <table>
      <!-- BEGIN resultat -->
      {foreach from=$resultat item=result}
        <tr style="color: red;">
          <td>{$result.HIPE_RESULTAT1}</td>
          <td>{$result.HIPE_RESULTAT2}</td>
          <td>{$result.HIPE_RESULTAT3}</td>
          <td>{$result.HIPE_RESULTAT4}</td>
          <td>{$result.HIPE_RESULTAT5}</td>
        </tr>
      {/foreach} 
      <!-- END resultat -->
      </table>

    </fieldset>
    
  </fieldset>

</form>