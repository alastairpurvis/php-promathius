<?php /* Smarty version 2.6.0, created on 2009-05-02 00:04:29
         compiled from actions/construct/construct.tab */ ?>
<table class="invisible" cellspacing=0 cellpadding=0 width=520 style='padding: 0px; margin: 0px;'><tr><td>
<?php echo $this->_tpl_vars['BeginTabmenu']; ?>

<?php if ($this->_tpl_vars['tabsection'] == 'construct'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Construct<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?construct">Construct</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'demolish'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Demolish<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?construct&tab=demolish">Demolish</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'help'): ?>
	<?php echo $this->_tpl_vars['oHelpActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oHelp']; ?>
<a class="guitab" href="?construct&tab=help"></a><?php echo $this->_tpl_vars['cHelp']; ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['EndTabmenu']; ?>

</table>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top: 10px; padding-right: 7px">