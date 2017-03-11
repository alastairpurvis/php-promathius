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

{* Include Recruitment tabs *}
{include file="recruit.tab"}

<table cellspacing="0" cellpadding="0" width=420>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<form method="post" action="?mercenaries{$authstr}" name="pvmb">
<table class="font" width="380" border=0>
<tr><th class="aleft"></th>
    <th class="aright"></th>
    <th class="aright"></th>
    <th class="aright"></th>
    <th class="aright">Recruit</th>
</tr>

{section name=pvm loop=$types}
<tr><td style="font-size:10px"><b><i>{$types[pvm].name}</b></i></td>
    <td class="aright" style="font-size:9px">{$types[pvm].cost}</td>
    <td class="aright" style="font-size:9px">50</td>
    <td class="aright" style="font-size:9px">1 turn</td>

    <td class="aright" style="font-size:9px"><input type="text" name="buy[{$types[pvm].type}]" size="4" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
</tr>
{/section}

<tr><td colspan="7" style="text-align:right; padding-top: 7pt"><input type="submit" name="do_buy" value="&nbsp;Recruit&nbsp;" class="mainoption"></td></tr>
</table>
</td>
</form>
{$End_Shadow}
<br />

