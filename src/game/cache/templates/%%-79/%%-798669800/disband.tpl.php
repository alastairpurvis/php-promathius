<?php /* Smarty version 2.6.0, created on 2009-05-02 02:36:01
         compiled from actions/recruit/disband.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'gamefactor', 'actions/recruit/disband.tpl', 30, false),)), $this); ?>

<?php if ($this->_tpl_vars['err'] != ""): ?> <span class="error-font"><b><?php echo $this->_tpl_vars['err']; ?>
</b></span><br />
<br />
<br />
<?php endif; ?>

<?php if (isset($this->_sections['m'])) unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['message']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
    <?php if ($this->_tpl_vars['message'][$this->_sections['m']['index']] != ""): ?>
    	<span class="success-font">~&nbsp;<?php echo $this->_tpl_vars['message'][$this->_sections['m']['index']]; ?>
&nbsp;~</span><br />
	<?php endif; ?>
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['message'] != ""): ?><br /><br /><?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/recruit/recruit.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="?recruit&tab=disband" name="pvmb">

<?php if (! $this->_tpl_vars['nothing']): ?>   <table class="font" width="440" border=0>
  <tr><th class="aleft"></th>
      <th class="aright">Owned</th>
      <th class="aright">Value</th>
      <th class="aright">Disbandable</th>
      <th class="aright">Disband</th>
  </tr>

  <?php if (isset($this->_sections['pvm'])) unset($this->_sections['pvm']);
$this->_sections['pvm']['name'] = 'pvm';
$this->_sections['pvm']['loop'] = is_array($_loop=$this->_tpl_vars['types']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pvm']['show'] = true;
$this->_sections['pvm']['max'] = $this->_sections['pvm']['loop'];
$this->_sections['pvm']['step'] = 1;
$this->_sections['pvm']['start'] = $this->_sections['pvm']['step'] > 0 ? 0 : $this->_sections['pvm']['loop']-1;
if ($this->_sections['pvm']['show']) {
    $this->_sections['pvm']['total'] = $this->_sections['pvm']['loop'];
    if ($this->_sections['pvm']['total'] == 0)
        $this->_sections['pvm']['show'] = false;
} else
    $this->_sections['pvm']['total'] = 0;
if ($this->_sections['pvm']['show']):

            for ($this->_sections['pvm']['index'] = $this->_sections['pvm']['start'], $this->_sections['pvm']['iteration'] = 1;
                 $this->_sections['pvm']['iteration'] <= $this->_sections['pvm']['total'];
                 $this->_sections['pvm']['index'] += $this->_sections['pvm']['step'], $this->_sections['pvm']['iteration']++):
$this->_sections['pvm']['rownum'] = $this->_sections['pvm']['iteration'];
$this->_sections['pvm']['index_prev'] = $this->_sections['pvm']['index'] - $this->_sections['pvm']['step'];
$this->_sections['pvm']['index_next'] = $this->_sections['pvm']['index'] + $this->_sections['pvm']['step'];
$this->_sections['pvm']['first']      = ($this->_sections['pvm']['iteration'] == 1);
$this->_sections['pvm']['last']       = ($this->_sections['pvm']['iteration'] == $this->_sections['pvm']['total']);
?>
  <tr><td style="font-size:11px"><b><?php echo $this->_tpl_vars['types'][$this->_sections['pvm']['index']]['name']; ?>
</b></td>
      <td class="aright" style="font-size:9px"><?php echo ((is_array($_tmp=$this->_tpl_vars['types'][$this->_sections['pvm']['index']]['amt'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
</td>
      <td class="aright" style="font-size:9px"><?php echo $this->_tpl_vars['types'][$this->_sections['pvm']['index']]['cost']; ?>
</td>
      <td class="aright" style="font-size:9px"><?php echo ((is_array($_tmp=$this->_tpl_vars['types'][$this->_sections['pvm']['index']]['cansell'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>
</td>

      <td class="aright" style="font-size:9px"><input type="text" name="sell[<?php echo $this->_tpl_vars['types'][$this->_sections['pvm']['index']]['type']; ?>
]" size="4" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
  </tr>
  <?php endfor; endif; ?>

  <tr><td colspan="7" style="text-align:right; padding-top: 7pt"><input type="submit" name="do_sell" value="Disband" class="mainoption"></td></tr>
  </table>
  
<?php else: ?>     <table class="acenter" width="380" border=0>
    <tr>
    <td><b><br><br><br>There is nothing to disband.<br><br><br><br>
    </tr>
    </table>
<?php endif; ?>
</form>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

<br />