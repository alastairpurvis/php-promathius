<?php /* Smarty version 2.6.0, created on 2009-07-19 21:49:08
         compiled from actions/construct/construct.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'commas', 'actions/construct/construct.tpl', 9, false),)), $this); ?>
<?php if ($this->_tpl_vars['err'] != ""): ?>
<span class="error-font"><?php echo $this->_tpl_vars['err']; ?>
</span><br /><br /><br />
<?php endif; ?>
<span style="font-size: 10px"><center>
<?php if ($this->_tpl_vars['do_build']): ?>
<?php if ($this->_tpl_vars['totalbuilt']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "turnoutput.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
<span class="success-font">~ Built <?php echo ((is_array($_tmp=$this->_tpl_vars['totalbuilt'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
 <?php echo $this->_tpl_vars['lastbuilt']; ?>
, costing <?php if ($this->_tpl_vars['totalspent'] == 0): ?>nothing<?php else:  echo $this->_tpl_vars['totalspent']; ?>
 gold<?php endif; ?> ~</span>
</tr>
</table>
</div>
</table>
</div>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

<?php endif; ?>
<?php endif; ?>
</center></span></b>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/construct/construct.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form 1 = past
<form method="post" action="?construct" name="build">
<table border=0 width=465>
<tr><th colspan=2 class="aright"></th>
    <th class="aright"></th>
    <th class="aright"></th>
    <th class="aright">Cost</th>
    <th class="aright">Buildable</th></tr>

    	<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['build']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr valign=bottom <?php if (! $this->_tpl_vars['build'][$this->_sections['i']['index']]['canBuild']): ?>style="color:gray"<?php endif; ?>>
		<td colspan=1></td>
		<td colspan=2><b><?php if ($this->_tpl_vars['build'][$this->_sections['i']['index']]['canBuild']): ?><A href="?construct&tab=help&section=<?php echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['gid']; ?>
"><?php endif;  echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['namesingular']; ?>
</a></td>
	    <td class="aright"><?php echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['buildrate']; ?>
</td>
	    <td class="aright"><?php echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['cost']; ?>
</td>
	    <td class="aright"><?php if ($this->_tpl_vars['build'][$this->_sections['i']['index']]['canBuild']):  echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['canBuild'];  else: ?>None<?php endif; ?></td>
	    <td class="aright"><input type="text" name="build[<?php echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['type']; ?>
]" size="5" value="" <?php if (! $this->_tpl_vars['build'][$this->_sections['i']['index']]['canBuild']): ?>disabled=true style="opacity:0"<?php endif; ?>></td>
</tr>
<tr <?php if (! $this->_tpl_vars['build'][$this->_sections['i']['index']]['canBuild']): ?>style="color:gray"<?php endif; ?>><td colspan=1>&nbsp;&nbsp;&nbsp;</td><td colspan=6 style="padding-top: 5px; padding-bottom: 8px"><span style="font-size: 11px"><?php echo $this->_tpl_vars['build'][$this->_sections['i']['index']]['description']; ?>
</span></td></tr>
	<?php endfor; endif; ?>

<tr><td colspan=3></tr> 
<tr><td colspan=3></tr> 
 <tr style="vertical-align: middle"><td colspan="7" style="text-align:right; padding-bottom:10px;; padding-top: 12pt"><input type="submit" class="mainoption" name="do_build" value="Contruct" ></td></tr>
 </table>
 </form>
</td>
<?php echo $this->_tpl_vars['End_Shadow']; ?>
