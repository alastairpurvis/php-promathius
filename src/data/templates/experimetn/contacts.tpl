<table class="menus" style="width:90%">
<tr>
    <th style="text-align: center; font-size: 10px">Name</th>
    <th style="text-align: center; font-size: 10px">Founder</th>
    <th style="text-align: center; font-size: 10px">Assistant</th>
    <th style="text-align: center; font-size: 10px">Diplomat I</th>
    <th style="text-align: center; font-size: 10px">Diplomat II</th>
</tr>

{section name=con loop=$clans}
<tr style="font-size: 9px">
    <td><a href="?clancrier&sclan={$clans[con].num}{$authstr}">{$clans[con].name}</a></td>
    <td>{$clans[con].founder}</td>
    <td>{$clans[con].asst}</td>
    <td>{$clans[con].fa1}</td>
    <td>{$clans[con].fa2}</td>
</tr>
{/section}

</table>
