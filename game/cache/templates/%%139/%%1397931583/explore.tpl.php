<?php /* Smarty version 2.6.0, created on 2009-05-02 00:04:31
         compiled from actions/turnuse/explore.tpl */ ?>
<?php if ($this->_tpl_vars['err'] != ""): ?> 
	<span class="error-font"><?php echo $this->_tpl_vars['err']; ?>
</span>
	<br />
	<br />
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['message'] != ''): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "turnoutput.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
	<span class="success-font"><?php echo $this->_tpl_vars['message']; ?>
</span>
	</tr>
	</table>
	</div>
	</table>
	</div>
	<?php echo $this->_tpl_vars['End_Shadow']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/turnuse/turnuse.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="post" action="<?php echo $this->_tpl_vars['main']; ?>
?explore<?php echo $this->_tpl_vars['authstr']; ?>
">
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
          <td width=10%><input type="checkbox" class="cb" name="hide_turns"<?php echo $this->_tpl_vars['condense']; ?>
 tabindex="2"/></td>
          <td><?php echo $this->_tpl_vars['lang']['condturns']; ?>
</td>
          <td colspan="2"><input type="submit" onclick="closeTurnWindow()" value="Explore" class="mainoption" tabindex="3"/>
        </tr>
      </table>
<br />
<br />
* <?php echo $this->_tpl_vars['admessage']; ?>
<br />
<br><br>
</form>
<?php echo $this->_tpl_vars['End_Shadow']; ?>


