{if $trans != ""}
	You have completed the transaction. Results:<br /> {$trans}
	<hr>
{/if}

<form method="post" action="{$main}?treasury{$authstr}">

<h2>{$clan_name} Shared Treasury <font size="1">({$nco})</font></h2>
<br /><table class="inputtable">
    <tr><td colspan="3">
    <table style="width:100%">
	<tr class="inputtable"><th colspan="3" style="text-align:center">Gold</th></tr>
	<tr><th>Maximum:</th><td colspan="2">{$limit_cash|gamefactor}</td></tr>
	<tr><th>Current:</th><td colspan="2">{$curr_cash|gamefactor}</td></tr>
    </table></td>
    <td colspan="3">
    <table style="width:100%">
	<tr class="inputtable"><th colspan="3" style="text-align:center">Food</th></tr>
	<tr><th>Maximum:</th><td colspan="2">{$limit_food|gamefactor}</td></tr>
	<tr><th>Current:</th><td colspan="2">{$curr_food|gamefactor}</td></tr>
    </table></td>
    <td colspan="3">
    <table style="width:100%">
	<tr class="inputtable"><th colspan="3" style="text-align:center">Scrolls</th></tr>
	<tr><th>Maximum:</th><td colspan="2">{$limit_rune|gamefactor}</td></tr>
	<tr><th>Current:</th><td colspan="2">{$curr_rune|gamefactor}</td></tr>
    </table></td></tr>

<tr>
<th>Withdraw</th>
    <td> <input type="text" name="cash_take" size="5"></td>
    <td> <input type="checkbox" name="ctmax" size="6" class=cb></td>
<th>Withdraw</th>
    <td> <input type="text" name="food_take" size="4"></td>
    <td> <input type="checkbox" name="ftmax" size="6" class=cb></td>
<th>Withdraw</th>
    <td> <input type="text" name="rune_take" size="4"></td>
    <td> <input type="checkbox" name="rtmax" size="6" class=cb></td>
</tr>


<tr>
<th>Deposit</th>
    <td> <input type="text" name="cash_give" size="5"></td>
    <td> <input type="checkbox" name="cgmax" size="6" class=cb></td>
<th>Deposit</th>
    <td> <input type="text" name="food_give" size="4"></td>
    <td> <input type="checkbox" name="fgmax" size="6" class=cb></td>
<th>Deposit</th>
    <td> <input type="text" name="rune_give" size="4"></td>
    <td> <input type="checkbox" name="rgmax" size="6" class=cb></td>
</tr>

</tr>
</table><br /><br />

<input type="submit" name="do_transaction" value="Complete Transaction" class="mainoption">

{if $officer == 1}
<br /><br />
<input type="submit" name="tres_ch_open" value="Make Treasury {$tres_open}" class="mainoption">
{/if}
</form>
