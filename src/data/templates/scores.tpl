<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td width=100%>
{$BeginTabmenu}
{if $listtype == 'Empire Rankings'}{$oTabActive}Rankings{$cTabActive}{else}{$oTab}<a class="guitab" href="?scores&amp;page=scores{$authstr}">Rankings</a>{$cTab}{/if}
{if $listtype == 'Graveyard'}{$oTabActive}Destroyed{$cTabActive}{else}{$oTab}<a class="guitab" href="?scores&amp;page=graveyard{$authstr}">Destroyed</a>{$cTab}{/if}
{if $listtype == 'Hall of Shame'}{$oTabActive}Abandoned{$cTabActive}{else}{$oTab}<a class="guitab" href="?scores&amp;page=abandon{$authstr}">Abandoned</a>{$cTab}{/if}
{$oHelp}<a class="guitab" href="?scores&tab=help}"></a>{$cHelp}
{$EndTabmenu}
</table>
<table cellspacing="0" cellpadding="0" width=520>
	<tr>
		<td align="center" class="shlarge" rowspan=2 style="padding-bottom:6px">
<div style="width:92%">
{if $sc1e != 1}
{** NEEDS updated key **}
{** <span class="mprotected">Protected</span>, <span class="mdead">Destroyed</span><br /><br /> **}
{/if}
</div>
{if $sc1e != 1}
<table border=0 cellspacing="0">
<tr class="score">
    {if $listtype != 'Hall of Shame' &&  $listtype != 'Graveyard'}
    <th onclick="location.href='?scores&amp;page={$link}&amp;sortby=8&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}'" style="width:5%" class="aright">
    <noscript><a href="?scores&amp;page={$link}&amp;sortby=8&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}">
    </noscript>Rank<noscript></a></noscript></th>{/if}
    
        <th onclick="?scores&amp;page={$link}&amp;sortby=5&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}'" style="width:5%">
        <noscript><a href="?scores&amp;page={$link}&amp;sortby=5&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}" title="Faction Type">
        </noscript>F<noscript></a></noscript></th>
        
    <th onclick="location.href='?scores&amp;page={$link}&amp;sortby=1&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}'" style="width:36%">
    <noscript><a href="?scores&amp;page={$link}&amp;sortby=1&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}">
    </noscript>{$empireC}<noscript></a></noscript></th>
    
    <th onclick="location.href='?scores&amp;page={$link}&amp;sortby=2&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}'" style="width:10%" class="aright">
    <noscript><a href="?scores&amp;page={$link}&amp;sortby=2&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}">
    </noscript>{if $listtype == 'Hall of Shame' ||  $listtype == 'Graveyard'}Top&nbsp;Greatness{else}Greatness{/if}<noscript></a></noscript></th>
    
    {if $listtype != 'Hall of Shame' &&  $listtype != 'Graveyard'}
    <th onclick="location.href='?scores&amp;page={$link}&amp;sortby=6&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}'" style="width:25%">
    <noscript><a href="?scores&amp;page={$link}&amp;sortby=6&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}">
    </noscript>Location<noscript></a></noscript></th>
    {/if}
    

        <th href="?scores&amp;page={$link}&amp;sortby=4&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}" style="width:10%">
        <noscript><a href="?scores&amp;page={$link}&amp;sortby=4&amp;view={$view-1}&amp;show={$show}&amp;restr={$restr}{$authstr}">
        </noscript>{if $listtype == 'Hall of Shame'}Abandoned{elseif $listtype == 'Graveyard'}Destroyed{else}Clan{/if}<noscript></a></noscript></th></tr>

{section name=i loop=$scores1}
<tr>
 {if $listtype != 'Hall of Shame' &&  $listtype != 'Graveyard'}
    <td align=center class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}" style="font-size: 18px; font-family: Papyrus;font-weight:bold">#{$scores1[i].online}{$scores1[i].rank}</td>{/if}
        <td align=center class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}"><img src="data/images/symbols/small/{$scores1[i].rcs}{$scores1[i].racel}{$scores1[i].rce}.png" title="{$scores1[i].rcs}{$scores1[i].race}{$scores1[i].rce}" width=20 height=18 /></td>
    <td style="padding-left:8px" class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}"><a class="proflink" href="?profile&amp;target={$scores1[i].num}{$authstr}"><b>{$scores1[i].empire}</b></a></td>
    
     {if $listtype != 'Hall of Shame' &&  $listtype != 'Graveyard'}
    <td style="padding-right:8px" align=right class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}" style="font-size: 10px"><b>{$scores1[i].greatness}<b/></td>
    {else}
    <td style="padding-right:8px; padding-bottom:10px; ; padding-top:10px" align=right class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}" style="font-size: 10px"><b>{$scores1[i].maxgreatness}<b/></td>
    {/if}
    {if $listtype != 'Hall of Shame' &&  $listtype != 'Graveyard'}
    <td align=center class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}" style="font-size: 9px">{$scores1[i].era}</td>
    {/if}

    <td align=center class="listrow{if %i.index% is even}1{else}2{/if}{$scores1[i].bg}edge">{if $listtype != 'Hall of Shame' &&  $listtype != 'Graveyard'}{$scores1[i].clan}{else}{$scores1[i].dates}{/if}</td></td>
{/section}
</table>
{else}
<p class="error-font">Nothing to list.</p><br />
{/if}
<div style="width:92%"><br />
<p align=right>
<br /><br /><b>{$active}</b> total {$empire}s.&nbsp;
<b>{$online}</b> {$empire}{if $online > 1}s{/if} online.<br />
<b>{$killed}</b> destroyed {$empire}s, and <b>{$abandoned}</b> abandoned {$empire}s.</p>
</div>
{$End_Shadow}
