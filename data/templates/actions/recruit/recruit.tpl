{if $err != ""} <span class="error-font"><b>{$err}</b></span><br />
<br />
<br />
{/if}

{if $totalrecruit > 0}
{if $do_recruit != ""}
{include file="turnoutput.tpl"}
 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
<span class="success-font">~ Recruited {$totalrecruit|commas} {$lastrecruited}, costing {$totalspent} gold ~</span>
</tr>
</table>
</div>
</table>
</div>
{$End_Shadow}
{/if}
{/if}

{* Include Recruitment tabs *}
{include file="actions/recruit/recruit.tab"}

<form method="post" action="?recruit" name="recruit">
<table class="font" width="440" border=0 cellpadding=2>
<tr><th class="aleft"></th>
    <th class="aright"></th>
    <th class="aright">Cost</th>
    <th class="aright">Recruitable</th>
    <th class="aright">Recruit</th>
</tr>

{section name=inf loop=$types}
<tr {if !$types[inf].canTrain}style="color:gray"{/if}>
	<td><b>{if $types[inf].canTrain}<A href="?recruit&tab=help&section={$types[inf].name}">{/if}{$types[inf].name}</a></b></td>
    <td class="aright">{$types[inf].trainrate}</td>
    <td class="aright">{$types[inf].cost}</td>
    <td class="aright">{if $types[inf].canTrain}{$types[inf].canTrain}{else}None{/if}</td>

    <td class="aright" style="font-size:9px"><input type="text" name="recruit[{$types[inf].id}]" {if !$types[inf].canTrain}disabled=true style="opacity:0"{/if} size="4" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
</tr>
<tr {if !$types[inf].canTrain}style="color:gray"{/if}>
	 <td colspan=5>{$types[inf].description}</td>
</tr>
{/section}

<tr><td colspan="7" style="text-align:right; padding-top: 12pt"><input type="submit" name="do_buy" value="&nbsp;Recruit&nbsp;" class="mainoption"></td></tr>
</table>
</td>
</form>
{$End_Shadow}
<br />

