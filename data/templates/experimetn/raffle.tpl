Buying a raffle ticket is a good way to make extra {$uera.food_lc} or cash for our {$uera.empire}.<br />
When we buy a raffle ticket, the amount goes into the jackpot, which will be given out to someone at the drawing.<br />
Raffle drawings are held every day at noon, server time.<br />
Gold tickets cost {$cashcost|gamefactor} and {$uera.food_lc} tickets cost {$foodcost|gamefactor} {$uera.food_lc}. They are valid for one drawing.<br /><br />
Current Cash Jackpot: ${$cashpot|gamefactor}<br />
Current {$uera.nfood} Jackpot: {$foodpot|gamefactor} {$uera.food_lc}<br /><br />
{if $numcasht == 0}	No	{else}	{$numcasht}	{/if} cash tickets have been bought for the next drawing.<br />
{if $numfoodt == 0}	No	{else}	{$numfoodt}	{/if} {$uera.food_lc} tickets have been bought for the next drawing.<br />
<br />

The last gold ticket was {$last_cashn}, which {$last_cashe} had, winning a total of {$last_cashw|gamefactor} gold!<br />
The last {$uera.food_lc} ticket was {$last_foodn}, which {$last_foode} had, winning a total of {$last_foodw|gamefactor} {$uera.food_lc}!<br />
<br />

{if count($cash_ticks) != 0}
	You have the following gold tickets:
	{section name=ct loop=$cash_ticks}
		#{$cash_ticks[ct].ticket}
	{/section}
{else}
	You currently have no gold tickets.
{/if}

{if $ucash < $cashcost}
	You don't have enough for a gold ticket. <br />
{elseif $numuct < $maxtickets}
	<form method="post" action="?raffle{$authstr}">
	<input type="hidden" name="do_ticket" value="1"> 
	<div><input type="submit" name="lbcash" class="mainoption" value="Buy a gold ticket"></div>
	</form>
{/if}

<br />

{if count($food_ticks) != 0}
	You have the following {$uera.food_lc} tickets:
	{section name=ct loop=$food_ticks}
		#{$food_ticks[ct].ticket}
	{/section}
{else}
	You currently have no {$uera.food_lc} tickets.
{/if}

{if $ufood < $foodcost}
	You don't have enough for a {$uera.food_lc} ticket. <br />
{elseif $numuct < $maxtickets}
	<form method="post" action="?raffle{$authstr}">
	<input type="hidden" name="do_ticket" value="1"> 
	<div><input type="submit" name="lbfood" class="mainoption" value="Buy a {$uera.food_lc} ticket"></div>
	</form>
{/if}


