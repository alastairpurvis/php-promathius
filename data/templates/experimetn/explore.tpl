{if $err != ""} 
	<span class="error-font">{$err}</span>
	<br />
	<br />
	<br />
{/if}

{$turnoutput}

{if $message != ''}
	<span class="success-font"><div align=center>{$message}</div></span>
	<br />
	<br />
	<br />
	</div>
{/if}

<form method="post" action="{$main}?explore{$authstr}">
{$admessage}
<br />
<br />
<table border=0><tr><td width=10%><td>
<table cellspacing="0" cellpadding="0" class="turntable">
  <tr>
    <td class="turntable-left"></td>
    <td class="turntable"><table cellspacing="0" cellpadding="0" width=100%>
        <tr>
          <td colspan=4  class="turntable-item"><b>Explore for how many turns?</b></td>
        </tr>
        <tr>
          <td colspan=4  class="turntable-item"><input type="text" name="use_turns" size="5" value="" tabindex="1" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off"/>
            <input type="hidden" name="do_use" value="1"></td>
        </tr>
        <tr>
          <td width=10%><input type="checkbox" class="cb" name="hide_turns"{$condense} tabindex="2"/></td>
          <td>{$lang.condturns}</td>
          <td colspan="2"><input type="submit" onclick="closeTurnWindow()" value="Begin" class="mainoption" tabindex="3"/>
        </tr>
      </table>
    </td>
    <td class="turntable-right"></td>
  </tr>
</table>
</td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0">
	<tr>
	<td class="helpbutton">
	<a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" />
	</a></td></tr></a>
</table>
</td></td>
  </tr>
</table>
</form>