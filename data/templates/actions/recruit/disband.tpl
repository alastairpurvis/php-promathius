
{if $err != ""} <span class="error-font"><b>{$err}</b></span><br />
<br />
<br />
{/if}

{section name=m loop=$message}
    {if $message[m] != ""}
    	<span class="success-font">~&nbsp;{$message[m]}&nbsp;~</span><br />
	{/if}
{/section}
{if $message != ""}<br /><br />{/if}

{* Include Recruitment tabs *}
{include file="actions/recruit/recruit.tab"}

<form method="post" action="?recruit&tab=disband" name="pvmb">

{if !$nothing} {* Is there something to disband? *}
  <table class="font" width="440" border=0>
  <tr><th class="aleft"></th>
      <th class="aright">Owned</th>
      <th class="aright">Value</th>
      <th class="aright">Disbandable</th>
      <th class="aright">Disband</th>
  </tr>

  {section name=pvm loop=$types}
  <tr><td style="font-size:11px"><b>{$types[pvm].name}</b></td>
      <td class="aright" style="font-size:9px">{$types[pvm].amt|gamefactor}</td>
      <td class="aright" style="font-size:9px">{$types[pvm].cost}</td>
      <td class="aright" style="font-size:9px">{$types[pvm].cansell|gamefactor}</td>

      <td class="aright" style="font-size:9px"><input type="text" name="sell[{$types[pvm].type}]" size="4" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
  </tr>
  {/section}

  <tr><td colspan="7" style="text-align:right; padding-top: 7pt"><input type="submit" name="do_sell" value="Disband" class="mainoption"></td></tr>
  </table>
  
{else} {* Nothing to disband? *}
    <table class="acenter" width="380" border=0>
    <tr>
    <td><b><br><br><br>There is nothing to disband.<br><br><br><br>
    </tr>
    </table>
{/if}
</form>
{$End_Shadow}
<br />