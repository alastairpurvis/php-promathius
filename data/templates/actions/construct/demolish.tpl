{if $err != ""}
<span class="error-font"><b>{$err}</b></span><br /><br /><br />
{/if}
<span style="font-size: 10px">
{if $do_demolish != ""}
{if ($turns > 0)}
<span class="success-font">~ You demolished {$totaldestroyed} {if ($totaldestroyed != 1)}structures{else}structure{/if}, making back {if $totalsalvaged == 0}nothing{else}{$totalsalvaged} gold{/if} ~</span><br /><br /><br /></div>
{/if}{/if}

{* Include Construction tabs *}
{include file="actions/construct/construct.tab"}

<form method="post" action="?construct&tab=demolish" name="demolish">
<table border=0 width=465>
<tr><th colspan=2 class="aleft"></th>
    <th class="aright"></th>
    <th class="aright">Refund</th>
    <th class="aright">Destroyable</th>
    <th class="aright">Demolish</th></tr>

{* Printing row stuffs *}
{section name=i loop=$demolish}
<tr><td colspan=2><span style="font-size: 10px"><B>{$demolish[i].name}</b></span></td>
    <td class="aright">{$demolish[i].userAmount}</td>
    <td class="aright">{$demolish[i].refund}</td>
    <td class="aright">{$demolish[i].canDestroy}</td>
    <td class="aright"><input type="text" name="demolish[{$demolish[i].type}]" size="5" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td></tr>
{/section}
{* Footer *}

<tr><td colspan=2><span style="font-size: 10px"><B><i>Empty Land</b></i></td>
    <td class="aright">{$freeland}</td>
    <td class="aright"></td>
    <td class="aright">{$candestroy}</td>
    <td class="aright"><input type="text" name="demolish[land]" size="5" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
    <td class="aright"></td>
    <td class="aright"></td></tr>
<tr><td colspan=6 align=right>
<Br><br>{$destroyrate} structure{if $destroyrate != 1}s{/if} demolishable per turn *<br />
</tr>
<tr><td width="13" style="vertical-align:middle ;padding-top: 15px; padding-bottom: 10px;"><input type="checkbox" class="cb" name="hide_turns"{$cnd}></td><td>&nbsp;{$lang.condturns}</td><td colspan="5" style="text-align:right"><input type="submit" name="do_demolish" value="Demolish" class="mainoption" onclick="closeTurnWindow()"></td></tr>
</table>
</form>

{$End_Shadow}