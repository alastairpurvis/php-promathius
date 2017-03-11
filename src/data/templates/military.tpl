{* The Javascript below is responsible for the strategic descriptions and the troop input boxes
   when a radio box is selected *}
{literal}<script language="JavaScript" type="text/javascript">{/literal}{section name=a loop=$atkdescr}help{$atkdescr[a].num} = "{$atkdescr[a].name}";{/section}{literal}function validateTroops(attackType){var counter = 0;var attackArray = [];{/literal}{section name=f loop=$atknums}{if %f.index% > 0}if(attackType - 1 == {%f.index%}){literal}{{/literal}{section name=j loop=$atkdata[f].ValidTypesArr}attackArray[{%j.index%}] = '{$atkdata[f].ValidTypesArr[j]}';{/section}{literal}}{/literal}{/if}{/section}
{section name=i loop=$troops}{literal}for (i = 0; i <= attackArray.length - 1; i++){{/literal}if ('{$troops[i].type}' != attackArray[i]){literal}{counter++;}}if (counter >= attackArray.length ){{/literal}document.getElementById('unit{%i.index%}td1').style.color = "gray";document.getElementById('unit{%i.index%}td2').style.color = "gray";document.getElementById('unit{%i.index%}input').style.display = "none";{literal}}else {{/literal}document.getElementById('unit{%i.index%}td1').style.color = "";document.getElementById('unit{%i.index%}td2').style.color = "";document.getElementById('unit{%i.index%}input').style.display = "";{literal}}counter = 0;{/literal}{/section}{literal}}function attackdescr(help) {document.getElementById("helpbox").value = eval("help" + help);}</script>{/literal}


{if $err != ""} <span class="error-font"><b>{$err}</b></span><br /><br /><br />{/if}

{* Attack Report *}
{if $showreport >= 1}
      <div class="tabber" id="status">
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2>Results</h2>
            <h2>Results</h2>
      		{$attackreport}
      	</div>
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2>{$uera.empireC} Status</h2>
          	{$turnoutput}
        </div>
      </div>
{/if}


{* Target *}
<form method="post" action="?military" name="atksel">
<table border=0 cellpadding=0 cellspacing=0><tr><td width=10%>&nbsp;<td>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2><br />
<table class="inputtable" width=80%>
<tr><td class="acenter" colspan="3"><b>~ Select a target to attack ~</b><br /><br /></td></tr>
<tr>
	<td width=25%></td>
    <td colspan="1" align="center">
    {if $notargets}
    Nothing to attack.
    {else}
		<select name="target" id="target" class="dkbg">
        {section name=t loop=$drop}
            <option value="{$drop[t].num}" class="m{$drop[t].color}"{$drop[t].selected}>{$drop[t].name}{$drop[t].online}
            </option>
        {/section}
        </select>
    {/if}
		<br />
    </td>
	<td width=25%></td>
</tr>
</table>
<br />

{* Attack Type & What For *}
{if !$noattacktypes}
<br />
<table class="inputtable" width=420>
<tr><td class="acenter" colspan=4><b>~ Create a strategy ~</b><br /><br /></td></tr>
	<tr><td colspan="3" class="acenter" valign=top><table cellspacing="0">
    {section name=a loop=$atktypes}
    {if $atktypes[a].name}
    <tr>
	<td>
    	<div class='radio' onClick="attackdescr('{$atktypes[a].num}'); validateTroops('{$atktypes[a].num}');">
        	<input class=radio type="radio" name='attacktype' value='{$atktypes[a].num}'>
            <table width=100% cellpadding=0 cellspacing=0>
            	<tr>
                	<td>{$atktypes[a].name}</td></table></td></tr></div>
    {/if}
    {/section}</table>
    <td align=right><textarea readonly="readonly" id="helpbox" rows="8" style="width: 270px;"  cols="7" tabindex="3" class="attackdescr" style="border: none; font-size: 10px"></textarea></td>
    </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
</tr>
</table>
{$End_Shadow}
<br />
{* Main Options *}
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2><br />
{/if}
<table width=440 border=0>
{if !$noattacktypes}
<tr><td class="acenter" colspan=3><b>~ Prepare an army ~</b><br /><br /></td></tr>
{/if}
<tr><th class="aleft">Unit</th>
    <th class="aright">Owned</th>
    <th class="aright">Send</th></tr>
        
{section name=i loop=$troops}
{* The Javascript will handle the dynamic formatting of unusable units *}
    <tr id="unit{%i.index%}"><td id="unit{%i.index%}td1" height=22>{$troops[i].name}</td>
    <td class="aright" id="unit{%i.index%}td2">{$troops[i].owned}</td>
    <td class="aright" id="unit{%i.index%}input"><input type="text" name="{$troops[i].sent}" size="8" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td></tr>
{/section}

<tr><td colspan="3" style="text-align:right; padding-bottom:4px;padding-top:12px">

<table border=0 align=left width=100%>
	<tr><td width="13">
		<input  type="checkbox" class="cb" name="get_bld" value="1"{$checked}></td><td width=58%> {$lang.captbuilding}
        </td>
    	<td width="13" align=right>
    	<input type="checkbox" class="cb" name="sendall" value="1" {$chk_sendall}></td><td style="padding: 0px"> {$lang.sendall}</td></tr></table></td></tr>
    <tr><td>
    	<table border=0 width=100%><tr><td width="13">
        	<input type="checkbox" class="cb" name="hide_turns" {$cnd}></td>
            <td>{$lang.condturns}</td></tr>
        </table>
        </td>
        <td colspan="3" style="text-align:right; padding-bottom:10px;">
        	<input type="submit" name="do_attack" class="mainoption" value="Begin Assualt"></td></tr>
    </table>
    {$End_Shadow}
     </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
  </tr>
</table>
</form>