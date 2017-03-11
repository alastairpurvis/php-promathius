<table class="inputtable">
<tr><th colspan="5">Clan Rankings - By {$sortd} ({$minm} Member Minimum)</th></tr>
<tr><th>Clan Name</th>
    <th>Tag</th>
    <th><a href="?clanstats&amp;sort_type=members{$authstr}">Members</a></th>
    <th><a href="?clanstats&amp;sort_type=avggreat{$authstr}">Average {$lang.greatness}</a></th>
    <th><a href="?clanstats&amp;sort_type=totalgreat{$authstr}">Total {$lang.greatness}</a></th></tr>

{section name=ran loop=$clans}
<tr class="acenter">
    <td>{$clans[ran].name}</td>
    <td><a href="?clancrier&sclan={$clans[ran].num}{$authstr}">{$clans[ran].tag}</a></td>
    <td>{$clans[ran].members}</td>
    <td>${$clans[ran].avggreat}</td>
    <td>${$clans[ran].totalgreat}</td></tr>
{/section}
</table>
<br />
{$notmade} clans don't have enough members to make this list.<br />
{$indeps} of all {$empire_name}s are independent.<br />
