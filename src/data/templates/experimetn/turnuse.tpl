{if $special}
	{if $menustat == "farm"}
		<b>Agriculture</b>
		{else}
		<a href="?farm{$authstr}">Agriculture</a>
	{/if}&nbsp;|&nbsp;
	
	{if $hasbarracks == 1}
		{if $menustat == "recruit"}
			<b>Recruitment</b>
		{else}
			<a href="?recruit{$authstr}">Recruitment</a>
		{/if}&nbsp;|&nbsp;
	{/if}
	
	{if $hasacademy == 1}
		{if $menustat == "write"}
			<b>Literature</b>
		{else}
			<a href="?write{$authstr}">Literature</a>
		{/if}&nbsp;|&nbsp;
	{/if}
	
	{if $menustat == "trade"}
		<b>Trade</b>
	{else}
		<a href="?trade{$authstr}">Trade</a>
	{/if}
	<br />
	<br />
    
	{$turnoutput}
	{if $message != ''}
		<div align=center class="success-font">{$message}</div><br /><br /><br />
	{/if}
{/if}

{* Error messages *}
{if $err != ""}
	<span class="error-font">{$err}</span>
	<br />
	<br />
	<br />
{/if}

{* Results for healing *}
{if $heal_result != ''}
	{$turnoutput}
	<div align=center class="success-font">{$heal_result}</div><br /><br /><br />
	<br />
{/if}

<form method="post" action="{$main}?{$turntype}{$authstr}">
{$admessage}
<br />
<br />
<table border=0><tr><td width=10%><td>
<table cellspacing="0" cellpadding="0" class="turntable">
  <tr>
    <td class="turntable-left"></td>
    <td class="turntable"><table cellspacing="0" cellpadding="0" width=100%>
        <tr>
          <td colspan=4  class="turntable-item"><b>{$domessage}</b></td>
        </tr>
        <tr>
          <td colspan=4  class="turntable-item"><input type="text" name="use_turns" size="5" value="0" tabindex="1"/>
            <input type="hidden" name="do_use" value="1"></td>
        </tr>
        <tr>
          <td width=10%><input type="checkbox" class="cb" name="hide_turns"{$condense} tabindex="2"/></td>
          <td>{$lang.condturns}</td>
          <td colspan="2" style="text-align:left"><input type="submit" value="Begin" class="mainoption" tabindex="3"/>
        </tr>
      </table>
    </td>
    <td class="turntable-right"></td>
  </tr>
</table>
</td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
  </tr>
</table>
</form>