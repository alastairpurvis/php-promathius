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

{* Include Trade tabs *}
{include file="actions/trade/trade.tab"}

<form method="post" action="?{$action}&tab={$tabsection}" name="pvmb">
<table class="font" width="450" border=0>
<tr><th class="aleft"></th>
    <th class="aright"></th>
    <th class="aright">Can Sell</th>
    <th class="aright">Price</th>
    <th class="aright">Sell</th>
{section name=i loop=$rowdata}
<tr><td style="font-size:11px"><b><i>{$rowdata[i].name}</b></i></td>
    <td class="aright">{$rowdata[i].owned|commas}</td>
    <td class="aright">{$rowdata[i].basket|commas}</td>
    <td class="aright"><input type="text" name="sellprice[{$rowdata[i].type}]" value="{$rowdata[i].cost}" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
    <td class="aright"><input type="text" name="sell[{$rowdata[i].type}]" value="" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
	</tr>
{/section}
{if $marketime > 0}
<tr><td colspan="7" style="padding-top: 31px">* It will take {$marketime} {if $marketime > 1}hours{else}hour{/if} for goods to reach the market</td></tr>
{/if}
<tr><td colspan="7" style="text-align:right; padding-top: 6px"><input type="submit" name="do_sell" value="Begin Shipping" class="mainoption"></td></tr>
</table>
</td>
{$End_Shadow}

{if $goods}
	<br />
    <table cellspacing="0" cellpadding="0" width="510">
    <tr>
    <td align="center" class="shlarge" rowspan=2 style="padding-top:11px; padding-bottom:16px;">
    <table class="font" width="440">
    <tr><td colspan="5" style="padding-bottom: 11px"><center><b>~ Sale Basket ~</b></center></td></tr>
    <tr><th class="aleft" >Unit</th>
        <th class="aright">Quantity</th>
        <th class="aright">Price</th>
        <th align="center">Status</th>
        <th class="aright">Action</th></tr>
    {section name=i loop=$basket}
    <tr><td style="padding-bottom: 8px">{$basket[i].name}</td>
        <td class="aright">{$basket[i].amount|commas}</td>
        <td class="aright">{$basket[i].price|commas}</td>
        <td class="acenter">
            {if ($basket[i].timecondition < 0)}
                For Sale
            {else}
                Shipping ({$basket[i].greenwidth}%)
            {/if}
        <td class="aright">{if ($basket[i].timecondition < 0)}<a href="?{$action}&tab={$tabsection}&amp;do_removeunits=yes&amp;remove_id={$basket[i].id}{$authstr}">Remove</a>{else}<a href="?{$action}&tab={$tabsection}&amp;do_cancelShipment=yes&amp;cancel_id={$basket[i].id}">Cancel</a>{/if}</td>
        </tr>
    {/section}   
    {if $cancelcommission}
    	<tr><td colspan="7" style="padding-top: 26px">* A commission of {$cancelcommission}% will be charged on all cancellations</td></tr>
    {/if}
    {if $commission && $cancelcommission}
        <tr><td colspan="7">{else}<tr><td colspan="7" style="padding-top: 26px">{/if}
    {if $commission}
    	* Removals will be charged a commission of {$commission}%</td></tr>
    {/if}
        <tr><td colspan="4"></td></tr>
    </table>
    {$End_Shadow}
{/if}