<h1>{$servname} Stock Manipulator</h1>
<br />

{if $trans != ''}
	<hr>
	{$trans}
	<hr>
	<br />
{/if}

<table class="inputtable stocks" width="50" cellSpacing="0" bordercolor="#000000">
<tr>
<td></td>
{section name=names loop=$stocknames}
	<th width="25">{$stocknames[names].symbol}</th>
{/section}
</tr><tr>
<td><p align='right'><img src="images/scale.jpg" height="360" width="36"></p></td>
{section name=index loop=$stocknames}
	<td>
	<img src="images/redfade.gif" width="32" height="{$stocknames[index].bprice}" /><img src="{$dat}spacer.gif" height="0" width="0" /><br />
	<img src="images/greenfade.gif" width="32" height="{$stocknames[index].price}" /><br />
	</td>
{/section}
</tr><tr>

<td class="stbl">Boost:</td>
{section name=price loop=$stocknames}
	<td class="stbl">
	<a href="?stockpanel{$authstr}&amp;change={$stocknames[price].id}&amp;boost=1">/\</a>
	</td>
{/section}
</tr><tr>

<td class="stbl">Reduce:</td>
{section name=price loop=$stocknames}
	<td class="stbl">
	<a href="?stockpanel{$authstr}&amp;change={$stocknames[price].id}&amp;reduce=1">\/</a>
	</td>
{/section}
</tr><tr>

<td class="stbl">Change:</td>
{section name=price loop=$stocknames}
	<td class="stbl">
	{$stocknames[price].boost|cnum}
	</td>
{/section}
</tr><tr>

<td class="stbl">Price:</td>
{section name=price loop=$stocknames}
	<td class="stbl">
	${$stocknames[price].lprice}
	</td>
{/section}
</tr><tr>

<td class="stbl">Yesterday:</td>
{section name=price loop=$stocknames}
	<td class="stbl">
	${$stocknames[price].lprice-$stocknames[price].days_1|cnum}
	</td>
{/section}
</tr><tr>

<td class="stbl"><nobr>2 days ago:</nobr></td>
{section name=price loop=$stocknames}
	<td class="stbl">
	${$stocknames[price].days_1-$stocknames[price].days_2|cnum}
	</td>
{/section}
</tr>

<td class="stbl"><nobr>3 days ago:</nobr></td>
{section name=price loop=$stocknames}
	<td class="stbl">
	${$stocknames[price].days_2-$stocknames[price].days_3|cnum}
	</td>
{/section}
</tr>

</table>

