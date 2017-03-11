<?php /* Smarty version 2.6.0, created on 2009-07-18 12:19:49
         compiled from actions/income/treasury.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'gamefactor', 'actions/income/treasury.tpl', 11, false),)), $this); ?>

<?php if ($this->_tpl_vars['err'] != ""): ?> <span class="error-font"><b><?php echo $this->_tpl_vars['err']; ?>
</b></span><br />
<br />
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['do_borrow'] != "" && $this->_tpl_vars['borrow'] != 0): ?>
	<div id="notebox" style="height: 55px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 500, false, false);openNoteBox()</script>
	~ You have taken out a loan of <?php echo ((is_array($_tmp=$this->_tpl_vars['borrow'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
 gold. ~
	<br />
    <span style="font-size: 10px; font-weight: normal">0.5% of the loan will be paid off each turn.</span><br />
    <br />
    <br /></div>
<?php endif; ?>
<?php if ($this->_tpl_vars['do_repay'] != "" && $this->_tpl_vars['repay'] != 0): ?>
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
    ~&nbsp;Thank you for your <?php echo ((is_array($_tmp=$this->_tpl_vars['repay'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
 gold payment!&nbsp;~<br />
    <br />
    <br />
	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['do_deposit'] != "" && $this->_tpl_vars['deposit'] != 0): ?>
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
    ~&nbsp;You have deposited <?php echo ((is_array($_tmp=$this->_tpl_vars['deposit'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
 gold into your savings account.&nbsp;~<br />
    <br />
    <br />
	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['do_withdraw'] != "" && $this->_tpl_vars['withdraw'] != 0): ?>
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
    ~&nbsp;You have withdrawn <?php echo ((is_array($_tmp=$this->_tpl_vars['withdraw'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
 gold from your savings.&nbsp;~<br />
    <br />
    <br />
	</div>
<?php endif; ?>

<form method="post" action="?income&tab=treasury">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/income/income.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table align=center>
 <tr>
   <td>
	<table width=240>
        <tr class=inputtable>
          <td colspan="2" style="text-align:center; padding-bottom: 8px"><b>~ Savings ~</b></td>
        </tr>
        <tr>
          <td>Interest Rate:</td>
          <td><?php echo $this->_tpl_vars['savrate']; ?>
%</td>
        </tr>
        <tr>
          <td>Maximum:</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['maxsave'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
</td>
        </tr>
		<?php if (((is_array($_tmp=$this->_tpl_vars['savings'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) != 0): ?>
            <tr>
              <td>Current:</td>
              <td><?php if (((is_array($_tmp=$this->_tpl_vars['savings'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) != 0): ?><span class="cgood"><?php endif;  echo ((is_array($_tmp=$this->_tpl_vars['savings'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp));  if (((is_array($_tmp=$this->_tpl_vars['savings'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) != 0): ?></span><?php endif; ?></td>
            </tr>
		<?php endif; ?>
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
          <td><?php echo $this->_tpl_vars['loanrate']; ?>
%</td>
        </tr>
        <tr>
          <td>Maximum:</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['maxloan'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
</td>
        </tr>
<?php if (((is_array($_tmp=$this->_tpl_vars['loan'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) != 0): ?>
        <tr>
          <td>Current:</td>
          <td><?php if (((is_array($_tmp=$this->_tpl_vars['loan'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) != 0): ?><span class="cbad"><?php endif;  echo ((is_array($_tmp=$this->_tpl_vars['loan'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp));  if (((is_array($_tmp=$this->_tpl_vars['loan'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) != 0): ?></span><?php endif; ?></td>
        </tr>
<?php endif; ?>
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
<?php if ($this->_tpl_vars['protectnotice']): ?> <b>(Savings is NOT calculated during protection)</b><br />
</span> <?php endif; ?> <?php echo $this->_tpl_vars['End_Shadow']; ?>


 </form>