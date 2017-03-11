
{if $err != ""} <span class="error-font"><b>{$err}</b></span><br />
<br />
<br />
{/if}

{* Action Messages *}
{if $do_borrow != "" && $borrow != 0}
	<div id="notebox" style="height: 55px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 500, false, false);openNoteBox()</script>
	~ You have taken out a loan of {$borrow|gamefactor} gold. ~
	<br />
    <span style="font-size: 10px; font-weight: normal">0.5% of the loan will be paid off each turn.</span><br />
    <br />
    <br /></div>
{/if}
{if $do_repay != "" && $repay != 0}
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
    ~&nbsp;Thank you for your {$repay|gamefactor} gold payment!&nbsp;~<br />
    <br />
    <br />
	</div>
{/if}

{if $do_deposit != "" && $deposit != 0}
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
    ~&nbsp;You have deposited {$deposit|gamefactor} gold into your savings account.&nbsp;~<br />
    <br />
    <br />
	</div>
{/if}

{if $do_withdraw!= "" && $withdraw != 0}
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
    ~&nbsp;You have withdrawn {$withdraw|gamefactor} gold from your savings.&nbsp;~<br />
    <br />
    <br />
	</div>
{/if}

<form method="post" action="?income&tab=treasury">

{* Include Income tabs *}
{include file="actions/income/income.tab"}
<table align=center>
 <tr>
   <td>
	<table width=240>
        <tr class=inputtable>
          <td colspan="2" style="text-align:center; padding-bottom: 8px"><b>~ Savings ~</b></td>
        </tr>
        <tr>
          <td>Interest Rate:</td>
          <td>{$savrate}%</td>
        </tr>
        <tr>
          <td>Maximum:</td>
          <td>{$maxsave|gamefactor}</td>
        </tr>
		{if $savings|gamefactor != 0}
            <tr>
              <td>Current:</td>
              <td>{if $savings|gamefactor != 0}<span class="cgood">{/if}{$savings|gamefactor}{if $savings|gamefactor != 0}</span>{/if}</td>
            </tr>
		{/if}
      <tr><td>&nbsp;</td></tr>
      <td><input type="text" name="deposit" size="9" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      <td><input type="submit" name="do_deposit" value="&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="mainoption" onclick="closeNoteBox()"></td></tr>
      <tr><td><input type="text" name="withdraw" size="9" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      <td><input type="submit" name="do_withdraw" value="Withdraw" class="mainoption" onclick="closeNoteBox()"></td>
	</table></td></tr>
	<tr>
   <td><table width=160>
        <tr class="inputtable">
          <td colspan="2" style="text-align:center;padding-bottom: 8px"><b>~ Loan ~</b></th>
        </tr>
        <tr>
          <td>Interest Rate:</td>
          <td>{$loanrate}%</td>
        </tr>
        <tr>
          <td>Maximum:</td>
          <td>{$maxloan|gamefactor}</td>
        </tr>
{if $loan|gamefactor != 0}
        <tr>
          <td>Current:</td>
          <td>{if $loan|gamefactor != 0}<span class="cbad">{/if}{$loan|gamefactor}{if $loan|gamefactor != 0}</span>{/if}</td>
        </tr>
{/if}
      <tr><td>&nbsp;</td></tr>
      <td><input type="text" name="borrow" size="9" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      <td><input type="submit" name="do_borrow" value="  Borrow " class="mainoption" onclick="closeNoteBox()"></td></tr>
      <tr><td><input type="text" name="repay" size="9" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      <td><input type="submit" name="do_repay" value="&nbsp;&nbsp;Repay&nbsp;" class="mainoption" onclick="closeNoteBox()"></td>
      </table></td>
  </tr>
</table><br />
<br />
<span class="font">* Interest is calculated per turn (52 turns = 1 APR year)<br />
{if $protectnotice} <b>(Savings is NOT calculated during protection)</b><br />
</span> {/if} {$End_Shadow}

 </form>
