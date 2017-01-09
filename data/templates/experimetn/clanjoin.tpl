Joining a clan could possibly offer some protection.<br /><br />
<form method="post" action="?clanjoin{$authstr}">

{* Open Clans *}
<table border=0 cellpadding=0 cellspacing=0><tr><td width=10%>&nbsp;<td align=center>
<table cellspacing="0" cellpadding="0" width=320>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:1px;padding-bottom:16px">
<table>
<tr><th colspan="2" class="acenter">~ Open Clans ~</th></tr>
{if $numocs == 0}
        <td colspan="2" style="padding:7px">No open Clans</td></tr>
{else}
<tr><td class="aright">Clan:</td>
	<td><select name="signup_clan" id="signup_clan" size="1">
		<option value="0">No Clan Selected</option>
	{section name=list loop=$ocs}
	        <option value="{$ocs[list].num}">{$ocs[list].tag} - {$ocs[list].name}</option>
	{/section}
	</select></td></tr>
{/if}

<tr><td colspan="2" class="acenter"><input type="submit" 
name="do_joinopenclan" value="Join Clan" class="mainoption"></td></tr>
</table>{$End_Shadow} </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
  </tr>
</table>

{* Private Clans *}
<table cellspacing="0" cellpadding="0" width=320>
<tr>
<td align="center" class="shlarge" rowspan=2>
<table>
<tr><th colspan="2" class="acenter" style="padding-bottom: 6px">~ Private Clans ~</th></tr>
<tr><td class="aright" valign="top" style="padding-top: 5px">Clan:</td>

{if $numcs == 0}
        <td colspan="2"><b>No Clans</b></td></tr>
{else}
	<td><div style="width: 120px"><select name="join_num" id="join_num" size="1">
	{section name=list loop=$ccs}
		<option value="{$ccs[list].num}">{$ccs[list].tag} - {$ccs[list].name}</option>
	{/section}
	</select></div></td></tr>
{/if}

<tr><td class="aright">Password:</td>
    <td><input type="password" name="join_pass" size="8"></td></tr>
<tr><td colspan="2" class="acenter"><input type="submit" class="mainoption" name="do_joinclan" value="Join Clan"></td></tr>
<tr><td><br /></td></tr></table>{$End_Shadow}
</form>
<br /><br />
<a href="?clanstats&amp;sort_type=avggreat">Top Clans by Average Greatness</a><br />
<a href="?clanstats&amp;sort_type=totalgreat">Top Clans by Total Greatness</a><br />
<a href="?clanstats&amp;sort_type=members">Top Clans by Membership</a><br />
