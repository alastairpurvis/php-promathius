{if $err != ""} <span class="error-font"><b>{$err}</b></span><br /><br /><br />{/if}

{if $showreport >= 1}
      <div class="tabber" id="status">
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2>Results</h2>
      		{$magicreport}
      	</div>
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2>{$uera.empireC} Status</h2>
          	{$turnoutput}
        </div>
      </div>
{/if}

<form method="post" action="?espionage&tab=hostile" name="missionsel">

{* Include Espionage tabs *}
{include file="actions/espionage/espionage.tab"}


    <table border=0 width="450"><tr><td style="text-align:center" colspan=2><table width=280 align=center cellpadding=2><tr><td class="acenter"><b>~ Select a spy operation ~</b><br /><br /></td></tr>

{section name=i loop=$optsfirst}
<tr>
	<td>
    	<div class="radio selected">
        	<input class=radio type="radio" name='mission_num' value='{$optsfirst[i].num}' checked='checked'>
            <table width=100% cellpadding=0 cellspacing=0>
            	<tr>
                	<td>{$optsfirst[i].name}</td><td class="aright"><span class={$optsfirst[i].classn}>({$optsfirst[i].cost} {$uera.runes})</span></table></td></tr></div>
{/section}
{section name=i loop=$opts}
<tr>
	<td>
    	<div class='radio'>
        	<input class=radio type="radio" name='mission_num' value='{$opts[i].num}'>
            <table width=100% cellpadding=0 cellspacing=0>
            	<tr>
                	<td>{$opts[i].name}</td><td class="aright"><span class={$opts[i].classn}>({$opts[i].cost} {$uera.runes})</span></table></td></tr></div>
{/section}

        </table><table class="font" width=260 align=center cellpadding="6">
<tr>
      <td style="text-align:center;padding-top: 26px; padding-bottom:2px"">
      <table align=center><td>Perform on?&nbsp;&nbsp;</td><td width=150> 
<select name="target" id="target" onClick="updatemissionNums()" class="dkbg">
	{section name=dropsel loop=$drop}
		<option value="{$drop[dropsel].num}" class="m{$drop[dropsel].color}"{if $prof_target == $drop[dropsel].num} selected {/if}>{$drop[dropsel].name}</option>
	{/section}
</select></td></table></td></tr></table>
<tr><td style="padding-top: 10px"><Table><tr><td width=13><input type="checkbox" class="cb" name="hide_turns" {$cnd}></td><td>{$lang.condturns}</td></tr></Table></td><td class="aright" ><input type="submit" name="do_mission" value="Perform" class="mainoption"></td></tr>
</table>
{$End_Shadow}
 </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=<?=$action?>" title="<?=$config[lang][helpbutton]?>" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="<?=$config[lang][helpbutton]?>" /></a></td></tr></a></table></td>
  </tr>
</table></form>