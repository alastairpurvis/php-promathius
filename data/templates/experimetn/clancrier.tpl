{* Clan Select Box *}
<form method="post" action="?clancrier" name="selectform">
<select name="sclan" size="1" onChange="selectform.submit();">
{section name=i loop=$drop}
	<option value="{$drop[i].value}"{$selected}>
    	{* Tag: Clan Name *}
    	{if $drop[i].tag}{$drop[i].tag}:&nbsp;{/if}{$drop[i].name}
    </option>
{/section}
</select>
</form>

<br /><br /><b>~&nbsp;<span style="font-size:14px">{$clan.name}</span>&nbsp;~</b><br /><br />

{* Contacts & Crier News *}
<table style="width:90%" align="center" class="inputtable" style="font-size:10px">
	<tr>
    	<th width="25%" align=center>Clan Contacts</th>
        <th width="75%" align=center><b>News</b></th></tr>
	<tr>
        <td width="25%" style="text-align: left;">
            <nobr><b>Leader:</b>&nbsp;
            <a class=proflink href="?profile&target={$clan.founder}">{$founder}</a></nobr><br />
            {if $clan.asst}
                <nobr><b>Assistant:</b>&nbsp;
                <a class=proflink href="?profile&target={$clan.asst}">{$assistant}</a></nobr><br />
            {/if}
            {if $clan.fa1}
                <nobr><b>Primary Diplomat:</b>&nbsp;
                <a class=proflink href="?profile&target={$clan.fa1}">{$diplomat1}</a></nobr><br />
            {/if}
            {if $clan.fa2}
                <nobr><b>Secondary Diplomat:</b>&nbsp;
                <a class=proflink href="?profile&ntarget={$clan.fa2}">{$diplomat2}</a></nobr><br />
            {/if}
		</td>
		<td width="75%">
        	{$criernews}
        </td>
    </tr>
</table>
<br /><br /><br />

{* Clan Members *}
<b>&nbsp;<span style="font-size:11px">Full Member List</span>&nbsp;</b><br /><br />
<table class="sortable" style="width:90%">
    <tr class="score" style="font-size:9px;">
        <th style="width:5%" class="aright" style="font-size:9px">Rank</th>
        <th style="width:25%" style="font-size:9px">{$uera.empireC}</th>
        <th style="width:15%" class="aright" style="font-size:9px">{$lang.greatness}</th>
        <th style="width:18%" style="font-size:9px">Location</th>
        <th style="width:10%" style="font-size:9px">Clan</th>
    </tr>
    {* There is only partial template support here because the function is shared, sorry :( *}
    {$members}
</table>
<br /><br />

{* Key *}
<span class="mprotected" style="font-size: 10px">Protected/Vacation</span>, 
<span class="mdead" style="font-size: 10px">Dead</span>, 
<span class="mally" style="font-size: 10px">Ally</span>, 
<span class="mdisabled" style="font-size: 10px">Disabled</span>, 
<span class="madmin" style="font-size: 10px">Administrator</span>, 
<span class="mself" style="font-size: 10px">You</span>