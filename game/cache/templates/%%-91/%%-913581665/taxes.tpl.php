<?php /* Smarty version 2.6.0, created on 2009-05-02 03:03:55
         compiled from actions/income/taxes.tpl */ ?>
<?php if ($this->_tpl_vars['err'] != ""): ?> <span class="error-font"><?php echo $this->_tpl_vars['err']; ?>
</span><br /><br /><br /><?php endif; ?>
<?php if ($this->_tpl_vars['printmessage'] != ''): ?>
	<div id="notebox" style="height: 45px">
	<script type="text/javascript">var Notebox=new animatedcollapse("notebox", 400, false, false);openNoteBox()</script>
	~&nbsp;<?php echo $this->_tpl_vars['printmessage']; ?>
&nbsp;~
	<br />
<br />
<br />
</div>
<?php endif; ?> 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/income/income.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="?income">
<br>
<table cellspacing="0" cellpadding="0" style="padding:0px; width: 145px; ">
        <tr>
          <td colspan=4 style="text-align:center; padding:6px"><span style="font-size: 11px"><b>Set the rate of tax</b></span></td>
        </tr>
        <tr>
          <td colspan=4  style="text-align:center; padding:6px; padding-left: 21px"><input type="text" name="new_tax" size="7" value="<?php echo $this->_tpl_vars['tax']; ?>
" autocomplete="off"  maxlength="2" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" tabindex="1"/>&nbsp;&nbsp;%</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:center; padding-top: 9px"><input type="submit" name="do_changetax" value="Set Tax Rate" class="mainoption" tabindex="2" onclick="closeNoteBox()"/></form>
        </tr>
      </table>
<br>
<span style="font-size: 10px">* Your tax rate will play a large role in determining<br /> the income of your empire and the loyalty of your citizens.</span><br />
<br />
<?php echo $this->_tpl_vars['End_Shadow']; ?>

</form>