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

{if ($clan == 0)}
<table class="invisible" cellspacing=0 cellpadding=0 border=0 width=93%><tr><td width=10%>&nbsp;</td><td class="acenter" style="vertical-align:top"><b>~ Public Market ~</b></td><td style="vertical-align:top" width=10% align=right>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="{$lang.helpbutton}"></img></a></td></tr></a></table></td>
{else}
    <b>~ {$uclan.name} Market ~</b>
    {/if}
    <table width=420><tr>
    	<td><b>{$lang.buygoods}</b></td>
        {if ($clan == 0)}
        <td style="text-align: right"><a href="?pubmarketsell{$authstr}">{$lang.sellgoods}</a></td>
        {else}
        <td style="text-align: right"><a href="?clanmarketsell{$authstr}">{$lang.sellgoods}</a></td>
        {/if}
        </tr>
    </table>

<table cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<form method="post" action="?{$action}{$authstr}" name="pvmb">
<table class="font" width="380" border=0>
<tr><th class="aleft">Unit</th>
    <th class="aright">Owned</th>
    <th class="aright">For Sale</th>
    <th class="aright">Cost</th>
    <th class="aright">Afford</th>
    <th class="aright">Buy</th>
{section name=i loop=$rowdata}
<tr><td style="font-size:9px">{$rowdata[i].name}</td>
    <td class="aright" style="font-size:9px">{$rowdata[i].owned|commas}</td>
    <td class="aright" style="font-size:9px">{$rowdata[i].availiable|commas}</td>
    <td class="aright"><input type="hidden" name="buyprice[{$rowdata[i].type}]" value="{$rowdata[i].cost}">{$rowdata[i].cost|commas}</td>
    <td class="aright" style="font-size:9px">{$rowdata[i].canbuy|commas}</td>
    <td class="aright" style="font-size:9px"><input type="text" name="buy[{$rowdata[i].type}]" value="" size="4"></td>
	</tr>
{/section}
<tr><td colspan="7" style="text-align:left; padding-top: 17px">* In order to prepare foreign troops for entry into our army, they will need to be properly trained and equiped with weapons that our culture is familiar with. As a result, there will be extra costs involved. These have been added onto the price automatically for you.</td></tr>
<tr><td colspan="7" style="text-align:right; padding-top: 2px"><input type="submit" name="do_buy" value="Purchase Goods" class="mainoption"></td></tr>
</table>
</td>
{$End_Shadow}
</form>