{if $err != ""} 
	<span class="error-font">{$err}</span>
	<br />
	<br />
	<br />
{/if}

{if $message != ''}
	{include file="turnoutput.tpl"}
	 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
	<span class="success-font">{$message}</span>
	</tr>
	</table>
	</div>
	</table>
	</div>
	{$End_Shadow}
{/if}

{* Include Exploration tabs *}
{include file="actions/turnuse/turnuse.tab"}
<form method="post" action="{$main}?explore{$authstr}">
<br>
<table cellspacing="0" cellpadding="0" width=80%>
        <tr>
          <td colspan=4  class="turntable-item"><b>Explore for how many turns?</b></td>
        </tr>
        <tr>
          <td colspan=4  class="turntable-item"><input type="text" name="use_turns" size="5" value="" tabindex="1" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off"/>
            <input type="hidden" name="do_use" value="1"></td>
        </tr>
		<tr><td colspan=3 style="padding-top:12px"></td></tr>
        <tr>
          <td width=10%><input type="checkbox" class="cb" name="hide_turns"{$condense} tabindex="2"/></td>
          <td>{$lang.condturns}</td>
          <td colspan="2"><input type="submit" onclick="closeTurnWindow()" value="Explore" class="mainoption" tabindex="3"/>
        </tr>
      </table>
<br />
<br />
* {$admessage}<br />
<br><br>
</form>
{$End_Shadow}


