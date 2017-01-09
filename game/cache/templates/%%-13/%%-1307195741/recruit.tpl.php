<?php /* Smarty version 2.6.0, created on 2009-07-19 21:49:17
         compiled from actions/recruit/recruit.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'commas', 'actions/recruit/recruit.tpl', 10, false),)), $this); ?>
<?php if ($this->_tpl_vars['err'] != ""): ?> <span class="error-font"><b><?php echo $this->_tpl_vars['err']; ?>
</b></span><br />
<br />
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['totalrecruit'] > 0): ?>
<?php if ($this->_tpl_vars['do_recruit'] != ""): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "turnoutput.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
<span class="success-font">~ Recruited <?php echo ((is_array($_tmp=$this->_tpl_vars['totalrecruit'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
 <?php echo $this->_tpl_vars['lastrecruited']; ?>
, costing <?php echo $this->_tpl_vars['totalspent']; ?>
 gold ~</span>
</tr>
</table>
</div>
</table>
</div>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

<?php endif; ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/recruit/recruit.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="?recruit" name="recruit">
<table class="font" width="440" border=0 cellpadding=2>
<tr><th class="aleft"></th>
    <th class="aright"></th>
    <th class="aright">Cost</th>
    <th class="aright">Recruitable</th>
    <th class="aright">Recruit</th>
</tr>

<?php if (isset($this->_sections['inf'])) unset($this->_sections['inf']);
$this->_sections['inf']['name'] = 'inf';
$this->_sections['inf']['loop'] = is_array($_loop=$this->_tpl_vars['types']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['inf']['show'] = true;
$this->_sections['inf']['max'] = $this->_sections['inf']['loop'];
$this->_sections['inf']['step'] = 1;
$this->_sections['inf']['start'] = $this->_sections['inf']['step'] > 0 ? 0 : $this->_sections['inf']['loop']-1;
if ($this->_sections['inf']['show']) {
    $this->_sections['inf']['total'] = $this->_sections['inf']['loop'];
    if ($this->_sections['inf']['total'] == 0)
        $this->_sections['inf']['show'] = false;
} else
    $this->_sections['inf']['total'] = 0;
if ($this->_sections['inf']['show']):

            for ($this->_sections['inf']['index'] = $this->_sections['inf']['start'], $this->_sections['inf']['iteration'] = 1;
                 $this->_sections['inf']['iteration'] <= $this->_sections['inf']['total'];
                 $this->_sections['inf']['index'] += $this->_sections['inf']['step'], $this->_sections['inf']['iteration']++):
$this->_sections['inf']['rownum'] = $this->_sections['inf']['iteration'];
$this->_sections['inf']['index_prev'] = $this->_sections['inf']['index'] - $this->_sections['inf']['step'];
$this->_sections['inf']['index_next'] = $this->_sections['inf']['index'] + $this->_sections['inf']['step'];
$this->_sections['inf']['first']      = ($this->_sections['inf']['iteration'] == 1);
$this->_sections['inf']['last']       = ($this->_sections['inf']['iteration'] == $this->_sections['inf']['total']);
?>
<tr <?php if (! $this->_tpl_vars['types'][$this->_sections['inf']['index']]['canTrain']): ?>style="color:gray"<?php endif; ?>>
	<td><b><?php if ($this->_tpl_vars['types'][$this->_sections['inf']['index']]['canTrain']): ?><A href="?recruit&tab=help&section=<?php echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['name']; ?>
"><?php endif;  echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['name']; ?>
</a></b></td>
    <td class="aright"><?php echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['trainrate']; ?>
</td>
    <td class="aright"><?php echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['cost']; ?>
</td>
    <td class="aright"><?php if ($this->_tpl_vars['types'][$this->_sections['inf']['index']]['canTrain']):  echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['canTrain'];  else: ?>None<?php endif; ?></td>

    <td class="aright" style="font-size:9px"><input type="text" name="recruit[<?php echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['id']; ?>
]" <?php if (! $this->_tpl_vars['types'][$this->_sections['inf']['index']]['canTrain']): ?>disabled=true style="opacity:0"<?php endif; ?> size="4" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
</tr>
<tr <?php if (! $this->_tpl_vars['types'][$this->_sections['inf']['index']]['canTrain']): ?>style="color:gray"<?php endif; ?>>
	 <td colspan=5><?php echo $this->_tpl_vars['types'][$this->_sections['inf']['index']]['description']; ?>
</td>
</tr>
<?php endfor; endif; ?>

<tr><td colspan="7" style="text-align:right; padding-top: 12pt"><input type="submit" name="do_buy" value="&nbsp;Recruit&nbsp;" class="mainoption"></td></tr>
</table>
</td>
</form>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

<br />
