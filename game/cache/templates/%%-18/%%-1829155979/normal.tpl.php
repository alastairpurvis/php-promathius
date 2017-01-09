<?php /* Smarty version 2.6.0, created on 2009-05-29 17:29:30
         compiled from actions/espionage/normal.tpl */ ?>
<?php if ($this->_tpl_vars['err'] != ""): ?> <span class="error-font"><b><?php echo $this->_tpl_vars['err']; ?>
</b></span><br /><br /><br /><?php endif; ?>

<?php if ($this->_tpl_vars['showreport'] >= 1): ?>
      <div class="tabber" id="status">
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2>Results</h2>
      		<?php echo $this->_tpl_vars['magicreport']; ?>

      	</div>
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2><?php echo $this->_tpl_vars['uera']['empireC']; ?>
 Status</h2>
          	<?php echo $this->_tpl_vars['turnoutput']; ?>

        </div>
      </div>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/espionage/espionage.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="magic_form" method="post" action="?espionage">
<table class="font" width=450 cellpadding="0" border=0>
<tr><td colspan="3" style="text-align:center"><table width=280 cellpadding=2 align=center><tr><td class="acenter"><b>~ Select a spy operation ~</b><br /><br /></td></tr>

<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['optsfirst']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<tr>
	<td>
    	<div class="radio selected">
        	<input class=radio type="radio" name='mission_num' value='<?php echo $this->_tpl_vars['optsfirst'][$this->_sections['i']['index']]['num']; ?>
' checked='checked'>
            <table width=100% cellpadding=0 cellspacing=0>
            	<tr>
                	<td><?php echo $this->_tpl_vars['optsfirst'][$this->_sections['i']['index']]['name']; ?>
</td><td class="aright"><span class=<?php echo $this->_tpl_vars['optsfirst'][$this->_sections['i']['index']]['classn']; ?>
>(<?php echo $this->_tpl_vars['optsfirst'][$this->_sections['i']['index']]['cost']; ?>
 <?php echo $this->_tpl_vars['uera']['runes']; ?>
)</span></table></td></tr></div>
<?php endfor; endif; ?>
<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['opts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<tr>
	<td>
    	<div class='radio'>
        	<input class=radio type="radio" name='mission_num' value='<?php echo $this->_tpl_vars['opts'][$this->_sections['i']['index']]['num']; ?>
'>
            <table width=100% cellpadding=0 cellspacing=0>
            	<tr>
                	<td><?php echo $this->_tpl_vars['opts'][$this->_sections['i']['index']]['name']; ?>
</td><td class="aright"><span class=<?php echo $this->_tpl_vars['opts'][$this->_sections['i']['index']]['classn']; ?>
>(<?php echo $this->_tpl_vars['opts'][$this->_sections['i']['index']]['cost']; ?>
 <?php echo $this->_tpl_vars['uera']['runes']; ?>
)</span></table></td></tr></div>
<?php endfor; endif; ?>

        </table></td></tr>
<tr><td style="text-align:center; padding-top: 23px; padding-bottom:12px" colspan=3>How many times&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="num_times" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" value="1" length="3" size="3"></td></tr>
<input type="hidden" name="jsenabled" value="">
<tr><td width=13 style="padding:0px"><input type="checkbox" class="cb" name="hide_turns" <?php echo $this->_tpl_vars['cnd']; ?>
></td><td width=99999>&nbsp;<?php echo $this->_tpl_vars['lang']['condturns']; ?>
</td><td style="text-align:right"><input type="submit" name="do_mission" value="Perform" class="mainoption"></td></tr>

</table>
</td>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

 </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=<?php echo $this->_tpl_vars['action']; ?>
" title="<?php echo $this->_tpl_vars['lang']['helpbutton']; ?>
" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="<?php echo $this->_tpl_vars['lang']['helpbutton']; ?>
" /></a></td></tr></a></table></td>
  </tr>
</table>
	</span></form>