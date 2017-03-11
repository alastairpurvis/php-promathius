	{$turnoutput}
	{if $message != ''}
		<div align=center class="success-font">{$message}</div><br /><br /><br />
	{/if}

{* Error messages *}
{if $err != ""}
	<span class="error-font">{$err}</span>
	<br />
	<br />
	<br />
{/if}

<form method="post" action="{$main}?{$turntype}{$authstr}">
For each turn you spend, you can gain roughly <b>{$admessage}</b> acres of territory<br /> or produce 25% more of a resource than usual.
<br />
<br />
<table border=0><tr><td width=10%><td>
<table cellspacing="0" cellpadding="0" width=280>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:0px;padding-bottom:13px; padding-left:22px;padding-right:22px">
        <table cellspacing="0" cellpadding="0" width=100%>
            <tr>
              <td colspan=4  class="turntable-item"><b>Spend turns doing what?</td>
            </tr>
            <tr>
              <td colspan=4  class="turntable-item" align="center" style="padding-bottom: 8px; padding-top: 8px; vertical-align:top">
              <table width=100% cellspacing="1">
                  <td valign="top">
                      <div style="width: 120px">
                          <select name="task" id="task" onClick="updateMsgNums()" class="dkbg" tabindex="1"/>
                                <option value="1" {$selected.1}>Exploring</option>
                                <option value="2" {$selected.2}>Farming</option>
                                {if $hasbarracks}
                                <option value="3" {$selected.3}>Recruiting</option>
                                {/if}
                                 <option value="4" {$selected.4}>Trading</option>
                                 {if $hasacademy}
                                <option value="5" {$selected.5}>Writing</option>
                                {/if}
                            </select>
                        </div>
                    </td>
                    <td valign="top">
                        <input type="text" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" autocomplete="off" name="use_turns" size="5" value="" tabindex="2"/> turns
                    </td>
                </table>
                <input type="hidden" name="do_use" value="1">
                </td>
            </tr>
            <tr>
              <td width=10%><input type="checkbox" class="cb" name="hide_turns"{$condense} tabindex="2"/></td>
              <td>{$lang.condturns}</td>
              <td colspan="2" style="text-align:right; padding-right: 7px"><input type="submit" value="Begin" class="mainoption" tabindex="3"/>
            </tr>
          </table>
{$End_Shadow}
</td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}"/></a></td></tr></a></table></td>
  </tr>
</table>
</form>