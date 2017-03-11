<?php /* Smarty version 2.6.0, created on 2009-05-02 02:36:07
         compiled from actions/espionage/espionage.tab */ ?>
<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td>
<?php echo $this->_tpl_vars['BeginTabmenu']; ?>

<?php if ($this->_tpl_vars['tabsection'] == 'normal'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Normal<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?espionage">Normal</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'hostile'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Hostile<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?espionage&tab=hostile">Hostile</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'help'): ?>
	<?php echo $this->_tpl_vars['oHelpActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oHelp']; ?>
<a class="guitab" href="?espionage&tab=help"></a><?php echo $this->_tpl_vars['cHelp']; ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['EndTabmenu']; ?>

</table>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top: 14px; padding-right: 8px; padding-bottom:24px">