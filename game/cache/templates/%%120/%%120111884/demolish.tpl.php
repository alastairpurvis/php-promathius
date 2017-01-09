<?php /* Smarty version 2.6.0, created on 2009-05-16 23:39:44
         compiled from actions/construct/demolish.tpl */ ?>
<?php if ($this->_tpl_vars['err'] != ""): ?>
<span class="error-font"><b><?php echo $this->_tpl_vars['err']; ?>
</b></span><br /><br /><br />
<?php endif; ?>
<span style="font-size: 10px">
<?php if ($this->_tpl_vars['do_demolish'] != ""): ?>
<?php if (( $this->_tpl_vars['turns'] > 0 )): ?>
<span class="success-font">~ You demolished <?php echo $this->_tpl_vars['totaldestroyed']; ?>
 <?php if (( $this->_tpl_vars['totaldestroyed'] != 1 )): ?>structures<?php else: ?>structure<?php endif; ?>, making back <?php if ($this->_tpl_vars['totalsalvaged'] == 0): ?>nothing<?php else:  echo $this->_tpl_vars['totalsalvaged']; ?>
 gold<?php endif; ?> ~</span><br /><br /><br /></div>
<?php endif;  endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/construct/construct.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="?construct&tab=demolish" name="demolish">
<table border=0 width=465>
<tr><th colspan=2 class="aleft"></th>
    <th class="aright"></th>
    <th class="aright">Refund</th>
    <th class="aright">Destroyable</th>
    <th class="aright">Demolish</th></tr>

<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['demolish']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr><td colspan=2><span style="font-size: 10px"><B><?php echo $this->_tpl_vars['demolish'][$this->_sections['i']['index']]['name']; ?>
</b></span></td>
    <td class="aright"><?php echo $this->_tpl_vars['demolish'][$this->_sections['i']['index']]['userAmount']; ?>
</td>
    <td class="aright"><?php echo $this->_tpl_vars['demolish'][$this->_sections['i']['index']]['refund']; ?>
</td>
    <td class="aright"><?php echo $this->_tpl_vars['demolish'][$this->_sections['i']['index']]['canDestroy']; ?>
</td>
    <td class="aright"><input type="text" name="demolish[<?php echo $this->_tpl_vars['demolish'][$this->_sections['i']['index']]['type']; ?>
]" size="5" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td></tr>
<?php endfor; endif; ?>

<tr><td colspan=2><span style="font-size: 10px"><B><i>Empty Land</b></i></td>
    <td class="aright"><?php echo $this->_tpl_vars['freeland']; ?>
</td>
    <td class="aright"></td>
    <td class="aright"><?php echo $this->_tpl_vars['candestroy']; ?>
</td>
    <td class="aright"><input type="text" name="demolish[land]" size="5" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
    <td class="aright"></td>
    <td class="aright"></td></tr>
<tr><td colspan=6 align=right>
<Br><br><?php echo $this->_tpl_vars['destroyrate']; ?>
 structure<?php if ($this->_tpl_vars['destroyrate'] != 1): ?>s<?php endif; ?> demolishable per turn *<br />
</tr>
<tr><td width="13" style="vertical-align:middle ;padding-top: 15px; padding-bottom: 10px;"><input type="checkbox" class="cb" name="hide_turns"<?php echo $this->_tpl_vars['cnd']; ?>
></td><td>&nbsp;<?php echo $this->_tpl_vars['lang']['condturns']; ?>
</td><td colspan="5" style="text-align:right"><input type="submit" name="do_demolish" value="Demolish" class="mainoption" onclick="closeTurnWindow()"></td></tr>
</table>
</form>

<?php echo $this->_tpl_vars['End_Shadow']; ?>