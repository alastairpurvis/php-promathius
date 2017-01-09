<?php /* Smarty version 2.6.0, created on 2009-05-29 17:29:33
         compiled from actions/espionage/hostile.tpl */ ?>
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

<form method="post" action="?espionage&tab=hostile" name="missionsel">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/espionage/espionage.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


    <table border=0 width="450"><tr><td style="text-align:center" colspan=2><table width=280 align=center cellpadding=2><tr><td class="acenter"><b>~ Select a spy operation ~</b><br /><br /></td></tr>

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

        </table><table class="font" width=260 align=center cellpadding="6">
<tr>
      <td style="text-align:center;padding-top: 26px; padding-bottom:2px"">
      <table align=center><td>Perform on?&nbsp;&nbsp;</td><td width=150> 
<select name="target" id="target" onClick="updatemissionNums()" class="dkbg">
	<?php if (isset($this->_sections['dropsel'])) unset($this->_sections['dropsel']);
$this->_sections['dropsel']['name'] = 'dropsel';
$this->_sections['dropsel']['loop'] = is_array($_loop=$this->_tpl_vars['drop']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['dropsel']['show'] = true;
$this->_sections['dropsel']['max'] = $this->_sections['dropsel']['loop'];
$this->_sections['dropsel']['step'] = 1;
$this->_sections['dropsel']['start'] = $this->_sections['dropsel']['step'] > 0 ? 0 : $this->_sections['dropsel']['loop']-1;
if ($this->_sections['dropsel']['show']) {
    $this->_sections['dropsel']['total'] = $this->_sections['dropsel']['loop'];
    if ($this->_sections['dropsel']['total'] == 0)
        $this->_sections['dropsel']['show'] = false;
} else
    $this->_sections['dropsel']['total'] = 0;
if ($this->_sections['dropsel']['show']):

            for ($this->_sections['dropsel']['index'] = $this->_sections['dropsel']['start'], $this->_sections['dropsel']['iteration'] = 1;
                 $this->_sections['dropsel']['iteration'] <= $this->_sections['dropsel']['total'];
                 $this->_sections['dropsel']['index'] += $this->_sections['dropsel']['step'], $this->_sections['dropsel']['iteration']++):
$this->_sections['dropsel']['rownum'] = $this->_sections['dropsel']['iteration'];
$this->_sections['dropsel']['index_prev'] = $this->_sections['dropsel']['index'] - $this->_sections['dropsel']['step'];
$this->_sections['dropsel']['index_next'] = $this->_sections['dropsel']['index'] + $this->_sections['dropsel']['step'];
$this->_sections['dropsel']['first']      = ($this->_sections['dropsel']['iteration'] == 1);
$this->_sections['dropsel']['last']       = ($this->_sections['dropsel']['iteration'] == $this->_sections['dropsel']['total']);
?>
		<option value="<?php echo $this->_tpl_vars['drop'][$this->_sections['dropsel']['index']]['num']; ?>
" class="m<?php echo $this->_tpl_vars['drop'][$this->_sections['dropsel']['index']]['color']; ?>
"<?php if ($this->_tpl_vars['prof_target'] == $this->_tpl_vars['drop'][$this->_sections['dropsel']['index']]['num']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['drop'][$this->_sections['dropsel']['index']]['name']; ?>
</option>
	<?php endfor; endif; ?>
</select></td></table></td></tr></table>
<tr><td style="padding-top: 10px"><Table><tr><td width=13><input type="checkbox" class="cb" name="hide_turns" <?php echo $this->_tpl_vars['cnd']; ?>
></td><td><?php echo $this->_tpl_vars['lang']['condturns']; ?>
</td></tr></Table></td><td class="aright" ><input type="submit" name="do_mission" value="Perform" class="mainoption"></td></tr>
</table>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

 </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=<?php echo '<?='; ?>
$action<?php echo '?>'; ?>
" title="<?php echo '<?='; ?>
$config[lang][helpbutton]<?php echo '?>'; ?>
" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="<?php echo '<?='; ?>
$config[lang][helpbutton]<?php echo '?>'; ?>
" /></a></td></tr></a></table></td>
  </tr>
</table></form>