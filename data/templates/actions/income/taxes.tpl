{if $err != ""} <span class="error-font">{$err}</span><br /><br /><br />{/if}
{if $printmessage != ''}
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
	~&nbsp;{$printmessage}&nbsp;~
	<br />
<br />
<br />
</div>
{/if} 

{* Include Income tabs *}
{include file="actions/income/income.tab"}

<form method="post" action="?income">
<br>
<table cellspacing="0" cellpadding="0" style="padding:0px; width: 145px; ">
        <tr>
          <td colspan=4 style="text-align:center; padding:6px"><span style="font-size: 11px"><b>Set the rate of tax</b></span></td>
        </tr>
        <tr>
          <td colspan=4  style="text-align:center; padding:6px; padding-left: 21px"><input type="text" name="new_tax" size="7" value="{$tax}" autocomplete="off"  maxlength="2" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" tabindex="1"/>&nbsp;&nbsp;%</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:center; padding-top: 9px"><input type="submit" name="do_changetax" value="Set Tax Rate" class="mainoption" tabindex="2" onclick="closeNoteBox()"/></form>
        </tr>
      </table>
<br>
<span style="font-size: 10px">* Your tax rate will play a large role in determining<br /> the income of your empire and the loyalty of your citizens.</span><br />
<br />
{$End_Shadow}
</form>
