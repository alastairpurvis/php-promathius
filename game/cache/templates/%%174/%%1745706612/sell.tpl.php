<?php /* Smarty version 2.6.0, created on 2009-05-02 03:05:47
         compiled from actions/trade/sell.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'commas', 'actions/trade/sell.tpl', 26, false),)), $this); ?>
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
<?php if ($this->_tpl_vars['message2'] != ""):  echo $this->_tpl_vars['message2'];  endif; ?>
<?php if ($this->_tpl_vars['message'] != ""): ?><br /><br /><?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/trade/trade.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="?<?php echo $this->_tpl_vars['action']; ?>
&tab=<?php echo $this->_tpl_vars['tabsection']; ?>
" name="pvmb">
<table class="font" width="450" border=0>
<tr><th class="aleft"></th>
    <th class="aright"></th>
    <th class="aright">Can Sell</th>
    <th class="aright">Price</th>
    <th class="aright">Sell</th>
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
</b></i></td>
    <td class="aright"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['owned'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
    <td class="aright"><?php echo ((is_array($_tmp=$this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['basket'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
    <td class="aright"><input type="text" name="sellprice[<?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['type']; ?>
]" value="<?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['cost']; ?>
" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
    <td class="aright"><input type="text" name="sell[<?php echo $this->_tpl_vars['rowdata'][$this->_sections['i']['index']]['type']; ?>
]" value="" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
	</tr>
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['marketime'] > 0): ?>
<tr><td colspan="7" style="padding-top: 31px">* It will take <?php echo $this->_tpl_vars['marketime']; ?>
 <?php if ($this->_tpl_vars['marketime'] > 1): ?>hours<?php else: ?>hour<?php endif; ?> for goods to reach the market</td></tr>
<?php endif; ?>
<tr><td colspan="7" style="text-align:right; padding-top: 6px"><input type="submit" name="do_sell" value="Begin Shipping" class="mainoption"></td></tr>
</table>
</td>
<?php echo $this->_tpl_vars['End_Shadow']; ?>


<?php if ($this->_tpl_vars['goods']): ?>
	<br />
    <table cellspacing="0" cellpadding="0" width="510">
    <tr>
    <td align="center" class="shlarge" rowspan=2 style="padding-top:11px; padding-bottom:16px;">
    <table class="font" width="440">
    <tr><td colspan="5" style="padding-bottom: 11px"><center><b>~ Sale Basket ~</b></center></td></tr>
    <tr><th class="aleft" >Unit</th>
        <th class="aright">Quantity</th>
        <th class="aright">Price</th>
        <th align="center">Status</th>
        <th class="aright">Action</th></tr>
    <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['basket']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <tr><td style="padding-bottom: 8px"><?php echo $this->_tpl_vars['basket'][$this->_sections['i']['index']]['name']; ?>
</td>
        <td class="aright"><?php echo ((is_array($_tmp=$this->_tpl_vars['basket'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
        <td class="aright"><?php echo ((is_array($_tmp=$this->_tpl_vars['basket'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
        <td class="acenter">
            <?php if (( $this->_tpl_vars['basket'][$this->_sections['i']['index']]['timecondition'] < 0 )): ?>
                For Sale
            <?php else: ?>
                Shipping (<?php echo $this->_tpl_vars['basket'][$this->_sections['i']['index']]['greenwidth']; ?>
%)
            <?php endif; ?>
        <td class="aright"><?php if (( $this->_tpl_vars['basket'][$this->_sections['i']['index']]['timecondition'] < 0 )): ?><a href="?<?php echo $this->_tpl_vars['action']; ?>
&tab=<?php echo $this->_tpl_vars['tabsection']; ?>
&amp;do_removeunits=yes&amp;remove_id=<?php echo $this->_tpl_vars['basket'][$this->_sections['i']['index']]['id'];  echo $this->_tpl_vars['authstr']; ?>
">Remove</a><?php else: ?><a href="?<?php echo $this->_tpl_vars['action']; ?>
&tab=<?php echo $this->_tpl_vars['tabsection']; ?>
&amp;do_cancelShipment=yes&amp;cancel_id=<?php echo $this->_tpl_vars['basket'][$this->_sections['i']['index']]['id']; ?>
">Cancel</a><?php endif; ?></td>
        </tr>
    <?php endfor; endif; ?>   
    <?php if ($this->_tpl_vars['cancelcommission']): ?>
    	<tr><td colspan="7" style="padding-top: 26px">* A commission of <?php echo $this->_tpl_vars['cancelcommission']; ?>
% will be charged on all cancellations</td></tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['commission'] && $this->_tpl_vars['cancelcommission']): ?>
        <tr><td colspan="7"><?php else: ?><tr><td colspan="7" style="padding-top: 26px"><?php endif; ?>
    <?php if ($this->_tpl_vars['commission']): ?>
    	* Removals will be charged a commission of <?php echo $this->_tpl_vars['commission']; ?>
%</td></tr>
    <?php endif; ?>
        <tr><td colspan="4"></td></tr>
    </table>
    <?php echo $this->_tpl_vars['End_Shadow']; ?>

<?php endif; ?>