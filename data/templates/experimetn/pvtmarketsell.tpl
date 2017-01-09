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

<table class="invisible" cellspacing=0 cellpadding=0 border=0 width=93%><tr><td width=10%>&nbsp;</td><td class="acenter" style="vertical-align:top">
<span style="font-size: 10px"><b>{$lang.pvtmarket}</b>{if $turnsleft < 1} | <a href="?pubmarketsell{$authstr}">{$lang.pubmarket}</a>{/if}</span></td><td style="vertical-align:top" width=10% align=right><table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
<table width="420" border=0>
<tr><td style="text-align: left"><a href="?pvtmarketbuy{$authstr}">{$lang.buygoods}</a></td>
    <td style="text-align: right"><b>{$lang.sellgoods}</b></td></tr>
</table>
<table cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<form method="post" action="?pvtmarketsell{$authstr}" name="pvmb">
<table class="font" width="380" style="padding-top:6pt; padding-bottom:6pt" border=0>
<tr><th class="aleft">Unit</th>
    <th class="aright">Owned</th>
    <th class="aright">Value</th>
    <th class="aright">Can Sell</th>
    <th class="aright">Sell</th>
</tr>

{section name=pvm loop=$types}
<tr><td style="font-size:9px">{$types[pvm].name}</td>
    <td class="aright" style="font-size:9px">{$types[pvm].amt|gamefactor}</td>
    <td class="aright" style="font-size:9px">{$types[pvm].cost}</td>
    <td class="aright" style="font-size:9px">{$types[pvm].cansell|gamefactor}</td>
    <td class="aright" style="font-size:9px"><input type="text" name="sell[{$types[pvm].type}]" size="4" value=""></td>
</tr>
{/section}

<tr><td colspan="7" style="text-align:right; padding-top: 7pt"><input type="submit" name="do_sell" value="Sell Goods" class="mainoption"></td></tr>
</table>
</td>
</form>
{$End_Shadow}