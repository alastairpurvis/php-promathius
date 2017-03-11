<?php /* Smarty version 2.6.0, created on 2009-05-29 15:46:30
         compiled from actions/recruit/recruit.tab */ ?>
<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td>
<?php echo $this->_tpl_vars['BeginTabmenu']; ?>

<?php if ($this->_tpl_vars['tabsection'] == 'recruit'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Recruit<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?recruit">Recruit</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'disband'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Disband<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?recruit&tab=disband">Disband</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'help'): ?>
	<?php echo $this->_tpl_vars['oHelpActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oHelp']; ?>
<a class="guitab" href="?recruit&tab=help"></a><?php echo $this->_tpl_vars['cHelp']; ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['EndTabmenu']; ?>

</table>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top: 12px; padding-right: 7px; padding-bottom:12px">