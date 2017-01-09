<?php /* Smarty version 2.6.0, created on 2009-09-04 14:07:59
         compiled from turnoutput.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'commas', 'turnoutput.tpl', 28, false),)), $this); ?>
<table cellspacing="0" cellpadding="0" width=510 style="margin-top: -65px;position: relative;padding-bottom:24px">
<tr>
<td id="turnthick" align="center" class="shlarge" rowspan=2 style="padding-top: 5px; padding-right: 3px; padding-left: 3px; ">
<div id="turnbox" style="height:290px; width: 510px; text-align:center;">
<table cellpadding=0 cellspacing=0 style="height:290px; width:510px; padding-top: 10px;" align=center><td style="text-align:center" align=center>
<script type="text/javascript">	var Turnbox=new animatedcollapse("turnbox", 600, false, false);openTurnWindow()</script>
<div style="width: 440px; text-align:LEFT; padding-bottom: 5px; margin-left: auto;margin-right: auto;"> <b><?php echo $this->_tpl_vars['turndata']['TurnsTaken']; ?>
 T</b></div>
	<div class="turnbase">
	<table cellpadding=0 cellspacing=0 align=center width=420>
				<tr>
				<td style="vertical-align:top">
				<table id="economy" style="opacity:0;-moz-opacity: 0;-khtml-opacity: 0;filter: alpha(opacity=0);" class=font>
				<tr>
				<th colspan="2" align=center><u>Economy</u></th></tr>
				<tr><th>Income</th>
					<td>$<?php echo ((is_array($_tmp=$this->_tpl_vars['turndata']['NetIncome'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td></tr>
				<tr><th>Expenses</th>
					<td>$<?php echo ((is_array($_tmp=$this->_tpl_vars['turndata']['NetExpenses'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td>
				<?php if ($this->_tpl_vars['turndata']['LoanPay']): ?>
				<tr><th>Loan Pay</th>
					<td>$<?php echo ((is_array($_tmp=$this->_tpl_vars['turndata']['LoanPay'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td></tr>
				<?php endif; ?>
				<tr><th>NET</th>
					<td><?php echo $this->_tpl_vars['turndata']['NetMoney']; ?>
</td></tr>
				</table></td>
				<td style="vertical-align:top">
				<table id="population" style="opacity:0;-moz-opacity: 0;-khtml-opacity: 0;filter: alpha(opacity=0);" class=font>
				<tr><th colspan="2" align=center><u>Growth</u></th></tr>
				<tr><th>Natives</th>
					<td><?php echo $this->_tpl_vars['turndata']['Births']; ?>
</td></tr>
				<tr><th>Settlers</th>
					<td><?php echo $this->_tpl_vars['turndata']['Settlers']; ?>
</td></tr>
				<tr><th>Emigrants</th>
					<td><?php echo $this->_tpl_vars['turndata']['Emigrants']; ?>
</td></tr>
				<tr><th>NET</th>
					<td><?php echo $this->_tpl_vars['turndata']['NetPopulation']; ?>
</td></tr>
								<tr><th>&nbsp;</th>
					<td>&nbsp;</tr>
				</table></td>
				<td style="vertical-align:top">
				<table id="agriculture" style="opacity:0;-moz-opacity: 0;-khtml-opacity: 0;filter: alpha(opacity=0);" class=font>
				<tr><th colspan="2" align=center><u>Agriculture</u></th></tr>
				<tr><th>Produced</th>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['turndata']['FoodPro'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td></tr>
				<tr><th>Consumed</th>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['turndata']['FoodCon'])) ? $this->_run_mod_handler('commas', true, $_tmp) : smarty_modifier_commas($_tmp)); ?>
</td></tr>
				<tr><th>NET</th>
					<td><?php echo $this->_tpl_vars['turndata']['NetFood']; ?>
</th></tr>
				</table></td></tr>
				<tr><td colspan="3" id="turnorder"><table align=center width=80%><td><B>Order </b>&nbsp;&nbsp;<?php echo $this->_tpl_vars['turndata']['NetOrder']; ?>
</td><td><b><?php echo $this->_tpl_vars['uera']['runes']; ?>
 </b>&nbsp;&nbsp;<?php echo $this->_tpl_vars['turndata']['NetRunes']; ?>
</td><?php if ($this->_tpl_vars['turndata']['NetMilitaryRaw'] < 0): ?><td><b>Military </b>&nbsp;&nbsp;<?php echo $this->_tpl_vars['turndata']['NetMilitary']; ?>
</td><?php endif; ?></table></tr>
								<tr><th colspan="3">
				&nbsp</th></tr>
				