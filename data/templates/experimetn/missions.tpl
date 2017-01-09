{if $editing == ""}
<span style="font-size: 10px"><b>Current missions</b>{if $left != 0} | <a href="?missioncreate{$authstr}">Create Mission</a>{/if}<br /><br />
{else}
<span style="font-size: 10px"><a href="?mission{$authstr}">Current missions</a>{if $left != 0}
 | <a href="?missioncreate{$authstr}">Create Mission</a>
 {/if}<br /><br />
{/if}

{if $bountyset != ""}
	<b>{$bountyset}</b>
	<br /><br />
{/if}

{* I decided against doing impure templates here *}


{if $editing == ""}
    <form method="post" action="{$main}?mission{$authstr}">
    {section name=num loop=$bounty}
    <table cellspacing="0" cellpadding="0" width=375>
<tr>
<td align="center" class="shlarge" rowspan=2>
<table border=0 width=340 style="padding-top: 5px">
<!--		<tr class="c{$bounty[num].color}"> -->
		<tr>
		<td colspan=4 class="acenter"><b>Mission Target: <a href=?profiles&amp;num={$bounty[num].t_num}{$authstr}>{$bounty[num].t_name}</a></td></tr>
		<td class="aleft" colspan=2><br /><b>~ Objective ~</b><br />
        {$bounty[num].land}{* PHP handles the "XXX land" so that if it no land, it won't do 'land not set land' *}
		{$bounty[num].rank}
		{$bounty[num].net}
        <td class="aright" colspan=2>
<br /><b>~ Reward ~</b><br />
		{if $bounty[num].cash}
			{$bounty[num].cash} gold pieces<br />
		{/if}
		{$bounty[num].rune}
		{$bounty[num].food}
		{section name=troopnum loop=$bounty[num].troops}
			{$bounty[num].troops[troopnum]}
		{/section}</tr><tr>
		<td colspan=2>{$bounty[num].editable}<td class="aright"><br />Posted {$bounty[num].time} by<br />{$bounty[num].s_name}</td>
		</tr>
		<tr><td colspan="5"></td></tr>
        	</table>
</td>
{$End_Shadow}
	{/section}

{if $bounty_total == 1}
<br />There are no missions at this time.
{/if}

	</form>


{if $view == ""}
	<a href="{$main}?mission&amp;view=true{$authstr}">View Current Bounties</a><br /><br /><br />
{/if}


{literal}
<script language="JavaScript">

function updateMsgNames() {
        msgnum = document.frmmsg.targ.value;
        nchanged = true
        for (i = 0; i < document.frmmsg.msg_dest.options.length; i++) {
                 if (document.frmmsg.msg_dest.options[i].value == msgnum) {
                        document.frmmsg.msg_dest.options[i].selected = true;
                        nchanged = false;
                }
        }
        if (nchanged) {
                document.frmmsg.do_set.disabled = true;
        } else {
                document.frmmsg.do_set.disabled = false;
        }
}
function updateMsgNums() {
        document.frmmsg.targ.value = document.frmmsg.msg_dest.value;
                document.frmmsg.do_set.disabled = false;
}

</script>
{/literal}

{/if}


{if $editing == "yes"}

    <form method="post" action="{$main}?mission{$authstr}">
    <table cellspacing="0" cellpadding="0" width=375>
<tr>
<td align="center" class="shlarge" rowspan=2>
<table border=0 width=340 style="padding-top: 5px">
<!--		<tr class="c{$bounty[num].color}"> -->
		<tr>
		<td colspan=4 class="acenter"><b>Mission Target: <a href=?profiles&amp;num={$edit_bounty.t_num}{$authstr}>{$edit_bounty.t_name}</a></td></tr>
		<td class="aleft" colspan=2><br /><b>~ Objective ~</b><br />
        {$edit_bounty.land}{* PHP handles the "XXX land" so that if it no land, it won't do 'land not set land' *}
		{$edit_bounty.rank}
		{$edit_bounty.net}
        <td class="aright" colspan=2>
<br /><b>~ Reward ~</b><br />
		{if $edit_bounty.cash}
			{$edit_bounty.cash} gold pieces<br />
		{/if}
		{$edit_bounty.rune}
		{$edit_bounty.food}
		{section name=troopnum loop=$edit_bounty.troops}
			{$edit_bounty.troops[troopnum]}
		{/section}
 </tr><tr>
		<td colspan=2><td class="aright"><br />Posted {$edit_bounty.time} by<br />{$edit_bounty.s_name}</td>
		</tr>
		<tr><td colspan="5"></td></tr>
        	</table>
</td>
{$End_Shadow}

	</form>


	<form method="post" action="{$main}?mission{$authstr}">
  <table cellspacing="0" cellpadding="0" width=290>
    <tr>
      <td align="center" class="shlarge" rowspan=2 style="padding-bottom: 6px"><table border=0 width=240 style="padding-top: 5px">
      <tr><td class="acenter" colspan=2><span class="gensmall"><b>~ Add Rewards ~</b></span></td></tr>
	 <th style="font-size:9px; text-align:left">{$cashname}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$cansend.cash})</th>
	    <td class="aright"> <input type="text" name="cash_give" size="9"></td>

	</tr>

	<tr>
	 <th style="font-size:9px; text-align:left">{$runesname}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$cansend.runes})</th>
	    <td class="aright"> <input type="text" name="rune_give" size="9"></td>

	</tr>

	<tr>
	 <th style="font-size:9px; text-align:left">{$foodname}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$cansend.food})</th>
	    <td class="aright"> <input type="text" name="food_give" size="9"></td>

	</tr>

	{section name=give2 loop=$givetroops}
	<tr>
	 <th style="font-size:9px; text-align:left"> {$givetroops[give2].name}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$givetroops[give2].cansend|gamefactor})</th>
	<td class="aright"> <input type="text" name="troop[{$givetroops[give2].id}]" size="9"></td>
	</tr>
	{/section}
        <tr><td colspan=2 class="acenter"><br /><br />
	<input type="hidden" name="bounty_id" value="{$bounty_id}">
        <input type="submit" name="do_add" class="mainoption" value="Add to Mission (Edit {$edit})"></td></tr>
        </table>
        </td>
        {$End_Shadow}


	</form>
{/if}
{if $editing != "yes"}
{if $bounty[num] > 0}
<br /><br /><br />
<form method="post" action="{$main}?mission{$authstr}">
<input type="submit" name="do_recalc" value="Re-calculate completed missions" class="mainoption">
</span>
{/if}{/if}