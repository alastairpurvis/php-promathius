{if !$crier}
	{if $events == 0}	No events.	{/if}
	{if $events == 1}	1 event.
	{else}			{$events} events.
	{/if}<br /><br />
{else}<br />{/if}

<table cellspacing="0" cellpadding="0" width=380>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:6px; padding-bottom:8px;">
<table class="inputtable" style="width:90%">
{if $crier}<tr><td colspan="5" align=center><b>~ Recent Battles ~</b><br /><br /></td></tr>{/if}

<tr>
	<td align=center><b>Attacker</b></td>
	<td align=center><b>Defender</b></td>
</tr>

{section name=i loop=$news}
	<tr>
		<td width=50%>{$news[i].name2}</td>
		<td class="aright">{$news[i].name1}</td>
	</tr>
    <tr><td width=50%>{$news[i].times} attacks</td>
		<td align=right>{$news[i].date}</td></tr>
       <tr><td colspan="2" class="acenter">{$news[i].name}{$news[i].whatfor}<br />{$news[i].outcome}</td></tr>
	<tr>	<td colspan="2"><br /></td>
	</tr>

{/section}
</table>
{$End_Shadow}

<table class="inputtable" style="width:90%">
<td>
{if !$crier}
<form method="post" action="?news{$authstr}">
<table class="inputtable" width=90%>
<tr><th class="aleft">Search by:</th>
	<td>
        <div class="radio" style="float: left "> 
  <input type="radio" name="search_by" value="Attacker"><label>Attacker &nbsp;</label>
</div>
        <div class="radio" style="float: left "> 
  <input type="radio" name="search_by" value="Defender"><label>Defender &nbsp;</label>
</div>
        <div class="radio selected" style="float: left "> 
  <input type="radio"  name="search_by" value="Either" checked><label>Doesn't matter</label>
</div>
	</td>
</tr><tr>
	<th class="aleft">
		<div class="radio selected"> 
  <input type="radio" name="search_type" value="num" checked><label>Number</label>
</div>
	</th>
	<td class="aleft">
		<input type="text" name="search_num" size="5">
	</td></tr>

	<th class="aleft"><div class="radio"> 
  <input type="radio" name="search_type" value="clan"><label>Clan</label>
</div></th>
	<td><select name="search_clan" size="1">
		<option value="0" selected>None - Unallied Empires</option>
		{section name=j loop=$liveclans}
			<option value="{$clan[j].num}">{$clan[j].tag} - {$clan[j].name}</option>
		{/section}
	        <option value="-1">---Dead Clans:---</option>
		{section name=j loop=$deadclans}
			<option value="{$clan[j].num}">{$clan[j].tag} - {$clan[j].name}</option>
		{/section}
	</select></td>
</tr>
    <tr>
	<th class="aleft">
		<label>Items:&nbsp;
	</th>
    <td><input type="text" name="search_limit" size="6" value="{$newslimit}"></label></td>
</tr><tr><tr>
	<td colspan="2" class="acenter">
		<input type="submit" name="do_search" value="Search News" class="mainoption">
	</td>
</tr>
</table>
{/if}
<br />
