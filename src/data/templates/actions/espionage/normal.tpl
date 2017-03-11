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


{* Include Espionage tabs *}
{include file="actions/espionage/espionage.tab"}

<form name="magic_form" method="post" action="?espionage">
<table class="font" width=450 cellpadding="0" border=0>
<tr><td colspan="3" style="text-align:center"><table width=280 cellpadding=2 align=center><tr><td class="acenter"><b>~ Select a spy operation ~</b><br /><br /></td></tr>

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

        </table></td></tr>
<tr><td style="text-align:center; padding-top: 23px; padding-bottom:12px" colspan=3>How many times&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="num_times" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" value="1" length="3" size="3"></td></tr>
<input type="hidden" name="jsenabled" value="">
<tr><td width=13 style="padding:0px"><input type="checkbox" class="cb" name="hide_turns" {$cnd}></td><td width=99999>&nbsp;{$lang.condturns}</td><td style="text-align:right"><input type="submit" name="do_mission" value="Perform" class="mainoption"></td></tr>

</table>
</td>
{$End_Shadow}
 </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
  </tr>
</table>
	</span></form>