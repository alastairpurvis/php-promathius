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

{* Include Trade tabs *}
{include file="actions/trade/trade.tab"}

<form method="post" action="?{$action}{$authstr}" name="pvmb">
<table class="font" width="450" border=0>
<tr><th class="aleft"></th>
    <th class="aright">For Sale</th>
    <th class="aright">Cost</th>
    <th class="aright">Afford</th>
    <th class="aright">Buy</th>
{section name=i loop=$rowdata}
<tr><td style="font-size:11px"><b><i>{$rowdata[i].name}</i></b></td>
    <td class="aright">{if $rowdata[i].availiable|commas == 0}None{else}{$rowdata[i].availiable|commas}{/if}</td>
    <td class="aright"><input type="hidden" name="buyprice[{$rowdata[i].type}]" value="{$rowdata[i].cost}">{$rowdata[i].cost|commas}</td>
    <td class="aright">{$rowdata[i].canbuy|commas}</td>
    <td class="aright"><input type="text" name="buy[{$rowdata[i].type}]" value="" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
	</tr>
{/section}
<tr><td colspan="7" style="text-align:left; padding-top: 24px">* In order to prepare foreign troops for entry into our army, they will need to be properly trained and equiped with weapons that our culture is familiar with. As a result, there will be extra costs involved. These have been added onto the price automatically for you.</td></tr>
<tr><td colspan="7" style="text-align:right; padding-top: 2px"><input type="submit" name="do_buy" value="Purchase" class="mainoption"></td></tr>
</table>
</td>
{$End_Shadow}
</form>