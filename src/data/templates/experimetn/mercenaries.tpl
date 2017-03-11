{if $err != ""} <span class="error-font"><b>{$err}</b></span><br />
<br />
<br />
{/if}

{section name=m loop=$message}
    {if $message[m] != ""}
    	<span class="success-font">~&nbsp;{$message[m]}&nbsp;~</span><br />
	{/if}
{/section}
{if $message != ""}<br /><br />{/if}
<table class="invisible" cellspacing=0 cellpadding=0 width=93%><tr><td width=10%>&nbsp;</td><td class="acenter" style="vertical-align:top"><a href="?recruitment{$authstr}">Recruitment</a> | <b>Mercenaries</b> | <a href="?disband{$authstr}">Disband Troops</a> | <a href="?standards{$authstr}">Standards</a></td><td style="vertical-align:top" width=10% align=right><table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
<table width=420>
<tr><td style="text-align: left"></td>
    <td style="text-align: right"></td></tr>
</table>
<table cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<form method="post" action="?mercenaries{$authstr}" name="pvmb">
<table class="font" width="380" border=0>
<tr><th class="aleft">Type</th>
    <th class="aright">Availiable</th>
    <th class="aright">Cost</th>
    <th class="aright">Afford</th>
    <th class="aright">Hire</th>
</tr>

{section name=pvm loop=$types}
<tr><td style="font-size:9px">{$types[pvm].name}</td>
    <td class="aright" style="font-size:9px">{$types[pvm].mkt|gamefactor}</td>
    <td class="aright" style="font-size:9px">{$types[pvm].cost}</td>
    <td class="aright" style="font-size:9px">{$types[pvm].canbuy|gamefactor}</td>

    <td class="aright" style="font-size:9px"><input type="text" name="buy[{$types[pvm].type}]" size="4" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
</tr>
{/section}

<tr><td colspan="7" style="text-align:right; padding-top: 7pt"><input type="submit" name="do_buy" value="Hire Mercenaries" class="mainoption"></td></tr>
</table>
</td>
</form>
{$End_Shadow}
<br />

