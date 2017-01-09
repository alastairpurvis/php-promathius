<table style="width:75%">
<tr><td style="vertical-align:top;width:33%">
        <table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Statistics</th></tr>
        <tr><th>Turns Used:</th>
            <td>{$users.turnsused}</td></tr>
        <tr><th>Rank:</th>
            <td>#{$users.rank}</td></tr>
        <tr><th>Networth:</th>
            <td>{$users.networth}</td></tr>
        <tr><th>Experience:</th>
            <td>{$experience}</td></tr>
        <tr><th>Gold:</th>
            <td>{$users.cash}</td></tr>
        <tr><th>Food:</th>
            <td>{$users.food|gamefactor}</td></tr>
        <tr><th>Population:</th>
            <td>{$users.peasants}</td></tr>
        <tr><th>Race:</th>
            <td>{$urace.name}</td></tr>
        <tr><th>Era:</th>
            <td>{$uera.name}</td></tr>
        </table>
    </td>
    </tr>
<tr>
    <td style="vertical-align:top;width:33%">
        <table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Military</th></tr>
	{section name=have loop=$troopshave}
        <tr><th>{$troopshave[have].name}:</th>
            <td>{$troopshave[have].have|gamefactor}</td></tr>
	{/section}
        <tr><th>{$uera.wizards}:</th>
            <td>{$users.wizards}</td>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><th>Offensive Points:</th>
            <td>{$offpts}</td></tr>
        <tr><th>Defensive Points:</th>
            <td>{$defpts}</td></tr>
        <tr><th>Experience:</th>
            <td>{$experience}</td></tr>
        </table>
    </td>
    </tr>
<tr>
    <td style="vertical-align:top;width:33%">
        <table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Relations</th></tr>
        <tr><th>Member of Clan:</th>
            <td>{$tags[0]}</td></tr>
        <tr><th>Allies:</th>
            <td><nobr>{$tags[1]}, {$tags[2]}, {$tags[3]}, {$tags[7]}, {$tags[8]}</nobr></td></tr>
        <tr><th>War:</th>
            <td><nobr>{$tags[4]}, {$tags[5]}, {$tags[6]}, {$tags[9]}, {$tags[10]}</nobr></td></tr>
	<tr><th>Private War Declaration:</th>
            <td>{$warset}</td>
	<tr><th>Private Peace Treaty:</th>
            <td>{$peaceset}</td>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><th>Offensive Actions:</th>
            <td>{$users.offtotal} ({$off_percent}%)</td></tr>
        <tr><th>Defences:</th>
            <td>{$users.deftotal} ({$def_percent}%)</td></tr>
        <tr><th>Kills:</th>
            <td>{$users.kills}</td></tr>
        </table>
    </td>
    </tr>
<tr>
<td style="vertical-align:top;width:33%">
        <table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Land Division</th></tr>
        <tr><th>{$uera.shops}:</th>
            <td>{$users.shops}</td></tr>
        <tr><th>{$uera.homes}:</th>
            <td>{$users.homes}</td></tr>
        <tr><th>{$uera.industry}:</th>
            <td>{$users.industry}</td></tr>
        <tr><th>{$uera.barracks}:</th>
            <td>{$users.barracks}</td></tr>
        <tr><th>{$uera.labs}:</th>
            <td>{$users.labs}</td></tr>
        <tr><th>{$uera.farms}:</th>
            <td>{$users.farms}</td></tr>
        <tr><th>{$uera.towers}:</th>
            <td>{$users.towers}</td></tr>
        <tr><th>Unused Land:</th>
            <td>{$users.freeland}</td></tr>
        </table>
    </td></tr>
<tr>
    <td style="vertical-align:top;width:33%">
        <table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Finances</th></tr>
        <tr><th>Est. Income:</th>
            <td>{$income}</td></tr>
        <tr><th>Est. Expenses:</th>
            <td>{$expenses}</td></tr>
        <tr><th>Net:</th>
            <td>{$netincome}</td></tr>
        <tr><th>Loan Payment:</th>
            <td>{$loanpayment}</td></tr>
        <tr><th>Taxable Income:</th>
            <td>{$ti}</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><th>Savings Balance:</th>
            <td>{$users.savings} ({$savrate}%)</td></tr>
        <tr><th>Loan Balance:</th>
            <td>{$users.loan} ({$loanrate}%)</td></tr>
        </table>
    </td>
    </tr>
<tr>
    <td style="vertical-align:top;width:33%">
        <table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Agriculture</th></tr>
        <tr><th>Est. Production:</th>
            <td>{$foodpro}</td></tr>
        <tr><th>Est. Consumption:</th>
            <td>{$foodcon}</td></tr>
        <tr><th>Net:</th>
            <td>{$foodnet}</td></tr>
        </table>
    </td>
</tr>
{if $showstocks}
<tr>
    <td colspan="1" style="vertical-align:top; width:33%"></td>
    <td colspan="1" style="vertical-align:top; width:33%">
	<table style="width:100%">
        <tr><th colspan="2" class="era{$users.era}" style="text-align:center">Stocks</th></tr>
        {section name=stock_id loop=$stocks}
        	<tr>
        		<td style="text-align:left"><b>{$stocks[stock_id].name}</b> (${$stocks[stock_id].price}):</td>
        		<td style="text-align:right">${$stocks[stock_id].total_worth|gamefactor}</td>
        	</tr>
       	{/section}
	</table>
    </td>
    <td colspan="1" style="vertical-align:top; width:33%"></td>
</tr>
{/if}
</table>
