{if $printmessage != ''}
<span class="success-font">{$printmessage}</span><br /><br />
{/if}
<b>Recruitment</b> | <a href="?mercenaries{$authstr}">Mercenaries</a> | <a href="?disband{$authstr}">Disband Troops</a> | <a href="?standards{$authstr}">Standards</a>
<br /><br />
<table cellspacing="0" cellpadding="0" width=280>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
	<form method="post" action="{$main}?recruitment{$authstr}">
	<table class="inputtable">
	{section name=ind loop=$troops}
	<tr><td>{$troops[ind]}</td>
	    <td class="aright"><input type="text" name="ind_troop{$numbers[ind]}" size="3" value="{$uind[ind]}">%</td></tr>
	{/section}
    <tr><td colspan="2" style="padding: 9px">* Ensure that the total amounts to 100.</td></tr>
	<tr><td colspan="2" align=center><input type="submit" class="mainoption" name="do_changeindustry" value="Update Recruitment"></td></tr>
	</table>
	</form>
    </td>
    {$End_Shadow}