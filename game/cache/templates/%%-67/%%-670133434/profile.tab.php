<?php /* Smarty version 2.6.0, created on 2009-05-02 14:45:48
         compiled from actions/profile/profile.tab */ ?>
<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td>
<?php echo $this->_tpl_vars['BeginTabmenu']; ?>

<?php if ($this->_tpl_vars['tabsection'] == 'profile'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Profile<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?profile&target=<?php echo $this->_tpl_vars['enemy']['num']; ?>
">Profile</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'diplomacy'): ?>
	<?php echo $this->_tpl_vars['oTabActive']; ?>
Diplomacy<?php echo $this->_tpl_vars['cTabActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?profile&tab=diplomacy&target=<?php echo $this->_tpl_vars['enemy']['num']; ?>
">Diplomacy</a><?php echo $this->_tpl_vars['cTab']; ?>

<?php endif; ?>
	
<?php if ($this->_tpl_vars['tabsection'] == 'help'): ?>
	<?php echo $this->_tpl_vars['oHelpActive']; ?>

<?php else: ?>
	<?php echo $this->_tpl_vars['oHelp']; ?>
<a class="guitab" href="?profile&tab=help&target=<?php echo $this->_tpl_vars['enemy']['num']; ?>
"></a><?php echo $this->_tpl_vars['cHelp']; ?>

<?php endif; ?>
<?php echo $this->_tpl_vars['EndTabmenu']; ?>

</table>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:16px;padding-bottom:6px">