{if $err != ""} <span class="error-font"><b>{$err}</b></span><br />
<br />
<br />
{/if}

{section name=m loop=$message}
    {if $message[m] != ""}
    	<span class="success-font">~&nbsp;{$message[m]}&nbsp;~</span><br />
	{/if}
{/section}
{if $message2 != ""}{$message2}{/if}
{if $message != ""}<br /><br />{/if}

{if ($clan == 0)}
<table class="invisible" cellspacing=0 cellpadding=0 border=0 width=93%><tr><td width=10%>&nbsp;</td><td class="acenter" style="vertical-align:top"><b>~ Public Market ~</b></td><td style="vertical-align:top" width=10% align=right>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=pubmarketsell" title="{$lang.helpbutton}" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="{$lang.helpbutton}"></img></a></td></tr></a></table></td>
{else}
<b>~ {$uclan.name} Market ~</b></span>
{/if}
<table width=420>
{if ($clan == 0)}
<tr><td style="text-align: left"><a href="?pubmarketbuy{$authstr}">{$lang.buygoods}</a></td>
{else}
<tr><td style="text-align: left"><a href="?clanmarketbuy{$authstr}">{$lang.buygoods}</a></td>
{/if}
<td style="text-align: right"><b>{$lang.sellgoods}</b></td></tr>
</table>

<table cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<form method="post" action="?{$action}{$authstr}" name="pvmb">
<table class="font" width="380" border=0>
<tr><th class="aleft">Unit</th>
    <th class="aright">Owned</th>
    <th class="aright">Can Sell</th>
    <th class="aright">Price</th>
    <th class="aright">Sell</th>
{section name=i loop=$rowdata}
<tr><td style="font-size:9px">{$rowdata[i].name}</td>
    <td class="aright" style="font-size:9px">{$rowdata[i].owned|commas}</td>
    <td class="aright" style="font-size:9px">{$rowdata[i].basket|commas}</td>
    <td class="aright" style="font-size:9px"><input type="text" name="sellprice[{$rowdata[i].type}]" value="{$rowdata[i].cost}" size="4"></td>
    <td class="aright" style="font-size:9px"><input type="text" name="sell[{$rowdata[i].type}]" value="" size="4"></td>
	</tr>
{/section}
{if $marketime > 0}
<tr><td colspan="7" style="padding-top: 15px">* It will take {$marketime} {if $marketime > 1}hours{else}hour{/if} for goods to reach the market</td></tr>
{/if}
<tr><td colspan="7" style="text-align:right; padding-top: 5px"><input type="submit" name="do_sell" value="Sell Goods" class="mainoption"></td></tr>
</table>
</td>
{$End_Shadow}

{if $goods}
	<br />
    <table cellspacing="0" cellpadding="0" width=420>
    <tr>
    <td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
    <table class="font" width="380">
    <tr><td colspan="5" style="padding-bottom: 10px"><center><b>~ Sale Basket ~</b></center></td></tr>
    <tr><th class="aleft" >Unit</th>
        <th class="aright">Quantity</th>
        <th class="aright">Price</th>
        <th align="center">Status</th>
        <th class="aright">Action</th></tr>
    {section name=i loop=$basket}
    <tr><td style="font-size:9px; padding-bottom: 7px">{$basket[i].name}</td>
        <td class="aright" style="font-size:9px">{$basket[i].amount|commas}</td>
        <td class="aright" style="font-size:9px">{$basket[i].price|commas}</td>
        <td class="acenter" style="font-size:9px">
            {if ($basket[i].timecondition < 0)}
                For Sale
            {else}
                Shipping ({$basket[i].greenwidth}%)
            {/if}
        <td class="aright" style="font-size:9px">{if ($basket[i].timecondition < 0)}<a href="?{$action}&amp;do_removeunits=yes&amp;remove_id={$basket[i].id}{$authstr}">Remove</a>{else}<a href="?{$action}&amp;do_cancelShipment=yes&amp;cancel_id={$basket[i].id}">Cancel</a>{/if}</td>
        </tr>
    {/section}   
    {if $cancelcommission}
    	<tr><td colspan="7" style="padding-top: 24px">* A commission of {$cancelcommission}% will be charged on all cancellations</td></tr>
    {/if}
    {if $commission && $cancelcommission}
        <tr><td colspan="7">{else}<tr><td colspan="7" style="padding-top: 24px">{/if}
    {if $commission}
    	* Removals will be charged a commission of {$commission}%</td></tr>
    {/if}
        <tr><td colspan="4"></td></tr>
    </table>
    {$End_Shadow}
{/if}