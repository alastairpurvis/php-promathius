<style>
{literal}
.hero TD {
	text-align: center;
}
{/literal}
</style>

<h1>Construct a Monument</h1>
<br />
<b>{$who}</b>
<br />

<form method="post" action="{$main}?monument{$authstr}">
<table class="inputtable hero">
<tr><td class="caption4" colspan="3" width=400>Construct a monument to a god</td></tr>
<tr><th>Gods of War</th><th>Gods of Peace</th><th>Special Gods</th></tr>
<tr>
    <td><input type="submit" name="warh1" class="mainoption" value="{$war1}"></td>
    <td><input type="submit" name="peaceh1" class="mainoption" value="{$peace1}"></td>
    <td><input type="submit" name="specialh1" class="mainoption" value="{$special1}"></td>
</tr>
<tr>
    <td><input type="submit" name="warh2" class="mainoption" value="{$war2}"></td>
    <td><input type="submit" name="peaceh2" class="mainoption" value="{$peace2}"></td>
    <td><input type="submit" name="specialh2" class="mainoption" value="{$special2}"></td>
</tr>
<tr>
    <td><input type="submit" name="warh3" class="mainoption" value="{$war3}"></td>
    <td><input type="submit" name="peaceh3" class="mainoption" value="{$peace3}"></td>
    <td><input type="submit" name="specialh3" class="mainoption" value="{$special3}"></td>
</tr>
</table>

<br /><br />

<table class="inputtable" width="400">
<tr><td class="caption4" colspan=3 width=400>God Bonuses</td></tr>
<tr><th colspan="2">Gods of War</th></tr>
<tr><th>{$war1}</th><td>{$ward1}</td></tr>
<tr><th>{$war2}</th><td>{$ward2}</td></tr>
<tr><th>{$war3}</th><td>{$ward3}</td></tr>

<tr><th colspan="2">Gods of Peace</th></tr>
<tr><th>{$peace1}</th><td>{$peaced1}</td></tr>
<tr><th>{$peace2}</th><td>{$peaced2}</td></tr>
<tr><th>{$peace3}</th><td>{$peaced3}</td></tr>

<tr><th colspan="2">Special Gods</th></tr>
<tr><th>{$special1}</th><td>{$speciald1}</td></tr>
<tr><th>{$special2}</th><td>{$speciald2}</td></tr>
<tr><th>{$special3}</th><td>{$speciald3}</td></tr>
</table>

<br /><br />

<table class="inputtable" width="400">
<tr><td colspan=3 width=400>Requirements</td></tr>
<tr><td>
You can construct a monument to one of the great gods to aid your {$uera.empire} any time you like. However, you can
have only one of each type of god, War God, Peace God, and Special. Also, a monument destroys about 40-50% of all your property, including
troops and land. That said, the contruction of a monument is well worth the cost of securing it.
The Gods do not take your property, not belonging to you, and they bestow
amazing powers and enhance the greatness of your {$uera.empire}. You can't gain a god's faith unless
you have demonstrated some prowess (see below), and you can't construct a monument until
you have used your first 1000 turns.<br />
<br />
<b>God Combinations:</b><br />
If you are strong on attacking, {$war1}-{$peace1}-{$special1} is a good choice.<br />
If you concentrate on food and wealth, {$war2}-{$peace1}/{$peace3}-{$special2} is worth it, depending on whether you are interested in food or wealth.<br />
If you really like {$uera.wizards}, we would suggest {$war3}-{$peace2}-{$special3}.<br />
Of course, mix and match according to your taste - that is the point!
<br />
</td></tr>
<tr><td>
<br />
Currently, getting a monument requires:
<ul>
{section name=i loop=$tr}
	<li><span class="{if $tr[i].ok == 1}cgood{else}cwarn{/if}"><b>{$tr[i].reqd}</b> {$tr[i].name}</span></li>
{/section}

</ul>
{if $req_okall == 1}
	<span class='cgood'>You <i>can</i> construct a monument at this time.</span>
{else}
	<span class='cwarn'>You <i>can't</i> construct a monument at this time.</span>
{/if}
</td></tr>
</table>
</form>

