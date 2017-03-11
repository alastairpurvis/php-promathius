<?php /* Smarty version 2.6.0, created on 2009-05-02 03:03:53
         compiled from actions/trade/buy.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'commas', 'actions/trade/buy.tpl', 25, false),)), $this); ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/trade/trade.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="?<?php echo $this->_tpl_vars['action'];  echo $this->_tpl_vars['authstr']; ?>
" name="pvmb">
<table class="font" width="450" border=0>
<tr><th class="aleft"></th>
    <th class="aright">For Sale</th>
    <th class="aright">Cost</th>
    <th class="aright">Afford</th>
    <th class="aright">Buy</th>
<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['rowdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr><td style="font-size:11px"><b><i><?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['name']; ?>
</i></b></td>
    <td class="aright"><?php if (((is_array($_tmp=$this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['availiable'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)) == 0): ?>None<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['availiable'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp));  endif; ?></td>
    <td class="aright"><input type="hidden" name="buyprice[<?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['type']; ?>
]" value="<?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['cost']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['cost'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
    <td class="aright"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['canbuy'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
    <td class="aright"><input type="text" name="buy[<?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['type']; ?>
]" value="" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
	</tr>
<?php endfor; endif; ?>
<tr><td colspan="7" style="text-align:left; padding-top: 24px">* In order to prepare foreign troops for entry into our army, they will need to be properly trained and equiped with weapons that our culture is familiar with. As a result, there will be extra costs involved. These have been added onto the price automatically for you.</td></tr>
<tr><td colspan="7" style="text-align:right; padding-top: 2px"><input type="submit" name="do_buy" value="Purchase" class="mainoption"></td></tr>
</table>
</td>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

</form>