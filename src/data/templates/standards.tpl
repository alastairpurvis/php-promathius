{if $err != ""} <span class="error-font"><b>{$err}</b></span><br />
<br />
<br />
{/if}
	{if $message != ''}
		<div align=center class="success-font">{$message}</div><br /><br /><br /></div>
	{/if}
<table class="invisible" cellspacing=0 cellpadding=0 width=420  style='padding: 0px; margin: 0px'><tr><td width=80%>
{$BeginTabmenu}
{$oTab}<a class="guitab" href="?mercenaries">Recruit</a>{$cTab}
{$oTab}<a class="guitab" href="?disband">Disband</a>{$cTab}
{$oTabActive}Improve{$cTabActive}
{$EndTabmenu}
</td><table cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:8px; padding-bottom:8px;">
<form method="post" action="?{$action}{$authstr}" name="pvmb">
<table class="font" width="380" border=0>
<tr><td align=center colspan=2><b>~&nbsp;Equipment Standards&nbsp;~</b></td></tr>
{section name=i loop=$equip}
{if %i.index% > 0}
<tr><td style="font-size:10px"><b><i>{$equip[i].name}</b></i></td><td align=right>{$equip[i].status}</td></tr>
<tr><td style="padding-left: 18px">{$equip[i].dbonus}x defense bonus</td><td align=right></td></tr>
<tr><td style="padding-left: 18px">{$equip[i].upkeep}x army upkeep</td><td align=right></td></tr>
	</tr>
{/if}
{/section}
<tr><td colspan=2><table width=100%><td>Spend how many turns improving?</td><td align=right><input type="text" name="use_turns" value="" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td></table></tr>
<tr><td colspan=2 style="padding-bottom: 12px"><br />* Improving the standard of military equipment has the advantage of allowing you 
to field smaller armies that are more effective in <defensive> combat, reducing the population and food costs.</td></tr>
<tr>          <td><table><td width=10%><input type="checkbox" class="cb" name="hide_turns"{$condense} tabindex="2"/></td>
          <td>{$lang.condturns}</td></table></td><td colspan=2 align=right><input type="submit" name="do_equip" value="Improve Equipment" class="mainoption" onclick="closeTurnWindow();"></td></tr>

</table>
</td>
{$End_Shadow}
</form>
