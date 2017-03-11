{if $err != ""} <span class="error-font"><b>{$err}</b></span><br /><br /><br />
{/if}

<table border=0 cellpadding=0 cellspacing=0><tr><td width=10%>&nbsp;<td align=center>
<table cellspacing="0" cellpadding="0" width=380>
<tr>
<td align="center" class="shlarge" rowspan=2>
<form method="post" action="?aid{$authstr}" name="frmmsg">

{* Target *}
<br /><table class="inputtable" width=80%>
<tr><td class="acenter" colspan="3"><b>~ Select an {$uera.empire} to send aid to  ~</b><br /><br /></td></tr>
<tr>
	<td width=18%></td>
    <td colspan="1" align="center">
    {if $notargets}
    Nobody to send aid to.
    {else}
	<select name="msg_dest_num" id="msg_dest_num" tabindex='1'>
	{section name=dropsel loop=$drop}
		<option value="{$drop[dropsel].num}" class="m{$drop[dropsel].color}"{if $prof_target == $drop[dropsel].num} selected {/if}>{$drop[dropsel].name}</option>
	{/section}
        </select>
    {/if}
		<br />
    </td>
	<td width=18%></td>
</tr></table>
<br /><br />

{* Items to send *}
<table width=336>
<tr><td colspan=6 align=center style="padding-bottom: 12px; padding-top: 3px"><span style="font-size: 10px"><b></b></span></td></tr>
<tr><th colspan=2 class="aleft"></th>
    <th class="aright">Owned</th>
    <th class="aright">Can Send</th>
    <th class="aright">Send</th>
    {* List Troop Types *}
    {section name=i loop=$row}
        <tr><td colspan=2 style="font-size: 10px"><b><i>{$row[i].name}</td>
            <td class="aright">{$row[i].owned|gamefactor}</td>
            <td class="aright">{$row[i].canSend|gamefactor}</td>
            <td class="aright"><input type="text" name="send[{$row[i].type}]" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" value="{if $row[i].type == $sendtroop.handle}{$convoy_nocomma}{/if}"></td>
        </tr>
    {/section}
   {* List Resources* }
    {section name=i2 loop=$row2}
        <tr><td colspan=2  style="font-size: 10px"><b><i>{$row2[i2].name}</td>
            <td class="aright">{$row2[i2].owned|gamefactor}</td>
            <td class="aright">{$row2[i2].canSend|gamefactor}</td>
            <td class="aright"><input type="text" name="send[{$row2[i2].type}]" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" value="{if $row2[i2].type == $sendtroop.handle}{$convoy_nocomma}{/if}"></td>
        </tr>
    {/section}
<tr><td style="padding-top: 25px"><img src="{$dat}{$dat}images/spacer.gif" height="10" /></td></tr>
<tr><td colspan=6 class="aright">Sending aid requires 2 turns{if $convoy|gamefactor != 0} and at least {$convoy|gamefactor} {$sendtroop.name}{/if} *<br /></td></tr>
<tr><td colspan=6 style="padding-bottom: 12px"  class="aright">{$users.aidcred} shipments can be sent and an additional every hour *<br /></td></tr>
<tr>
<td colspan="3">
<table>
<tr>
<td width="13">
<input class="cb" type="checkbox" name="hide_turns" {$cnd}></td>
<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">{$lang.condturns}</td>
</td></tr>
</table>
<td colspan="3" style="text-align:right">
<input type="submit" name="do_sendaid" value="Send Aid" class="mainoption">
</td></tr><tr height=3><td></tr>
</table>
{$End_Shadow}
 </td>
 
 <td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
  </tr>
</table>
</form>
</span>
