<?php /* Smarty version 2.6.0, created on 2009-05-29 15:54:30
         compiled from actions/profile/diplomacy.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'actions/profile/diplomacy.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/profile/profile.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<form method="post" action="?profile&Tab=diplomacy&target=<?php echo $this->_tpl_vars['target']; ?>
" name="diploctrl">
			<table width=480 valign="top">
				<tr>
					<td style="vertical-align:top;width:40%;padding-left: 20px;padding-right: 12px">
						<table cellspacing="0" cellpadding="4" style="width:100%; vertical-align: top">
							<tr>
								<td>
								<table cellspacing="0" cellpadding="0" style="width:100%">
										<tr colspan=2 style="padding-top: 7px">
											<h1><b><?php echo ((is_array($_tmp=$this->_tpl_vars['enemy']['empire'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</b></h1>
											
										</tr>
								</table>
							<td valign=top>
						<tr>
							<td style="vertical-align:bottom; padding-top:16px" valign="bottom" colspan=2>
							<table style="width:100%" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<table style="width:100%" cellspacing="0" cellpadding="0">
									<tr>
									<?php if (! $this->_tpl_vars['alliance'] && ! $this->_tpl_vars['trade_agreement'] && ! $this->_tpl_vars['military_agreement']): ?>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											<?php if ($this->_tpl_vars['player_prohibit_diplomacy']): ?>
													Allow diplomatic relations
												</td>
												<td width="13" onclick='checkboxAllowDiplomacy()'>
													<input class="cb" type="checkbox" name="allow_diplomacy" unchecked></td>
									<script language="JavaScript" type="text/javascript">document.diploctrl.allow_diplomacy.checked = false;</script>
											<?php elseif ($this->_tpl_vars['enemy_prohibit_diplomacy']): ?>
													This <?php echo $this->_tpl_vars['uera']['empire']; ?>
 does not wish to do diplomacy with you.
											<?php else: ?>
													Prohibit diplomatic relations
												</td>
											<td width="13" onclick='checkboxProhibitDiplomacy()'>
											<input class="cb" type="checkbox" name="prohibit_diplomacy" unchecked></td>
									<script language="JavaScript" type="text/javascript">document.diploctrl.prohibit_diplomacy.checked = false;</script>
											<?php endif; ?>
										</td>
										</tr>
									<?php endif; ?>
								<script language="JavaScript" type="text/javascript"><?php if ($this->_tpl_vars['military_agreement']): ?>var milagree = 1;<?php else: ?>var milagree = 0;<?php endif; ?></script>
									<?php if ($this->_tpl_vars['alliance']): ?>
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Alliance
										</td>
										<?php echo '
										<td width="13" onclick="checkboxAlliance()">
										'; ?>

										<input class="cb" type="checkbox" name="end_alliance" unchecked></td>
										</td>
										</tr>
										<?php else: ?>
									<tr><td>
								<div style="display:none"><input type="checkbox" name="end_alliance"></div>
								</td></tr>
									<?php endif; ?>
									<script language="JavaScript" type="text/javascript">document.diploctrl.end_alliance.checked = false;</script>
									<?php if ($this->_tpl_vars['trade_agreement']): ?>
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Trade Agreement
										</td>
										<td width="13" onclick="checkboxEndTrade()">
										<input class="cb" type="checkbox" name="end_trade" unchecked></td>
										</td>
										</tr>
									<?php else: ?>
									<tr><td>
								<div style="display:none"><input type="checkbox" name="end_trade"></div>
								</td></tr>
									<?php endif; ?>
								<script language="JavaScript" type="text/javascript">document.diploctrl.end_trade.checked = false;</script>
									<?php if ($this->_tpl_vars['military_agreement']): ?>
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Military Agreement
										</td>
										<td width="13" onclick="checkboxEndMilitary()">
										<input class="cb" type="checkbox" name="end_military" unchecked></td>
										</td>
										</tr>
										<?php else: ?>
									<tr><td>
								<div style="display:none"><input type="checkbox" name="end_military"></div>
								</td></tr>
									<?php endif; ?>
									<script language="JavaScript" type="text/javascript">document.diploctrl.end_military.checked = false;</script>
									</table>
									<?php if (! $this->_tpl_vars['enemy_prohibit_diplomacy']): ?>
									<div style="text-align:right; padding-top:15px" id="declare_bt">
									<input type="submit" name="set_diplomacy" value="Make Declaration" class="mainoption">
									</div>
									<?php endif; ?>
									</form>
									<?php if (! $this->_tpl_vars['player_prohibit_diplomacy'] && ! $this->_tpl_vars['enemy_prohibit_diplomacy']): ?>
									<script language="JavaScript" type="text/javascript">initCurrencyDialog();</script>
									<div id="diplomacybox">
									<form method="post" action="?profile&tab=diplomacy&target=<?php echo $this->_tpl_vars['target']; ?>
" name="diplo">
									<br><br>
									<center><span class="headerlrge">~ Demands ~</span></center>
									<table width=100% cellspacing="0" cellpadding="0">
																		<tr id="gdemandchbox">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
										Give <span id="gold_demand_display">gold</span>
										&nbsp;&nbsp;&nbsp;<span id="edit_gdemand"></span>
									</td>
									<td align="right">
										<input type="text" name="gold_demand_real" size="7" maxlength="8" autocomplete="off" value="">
									</td>
									<td width="13" align="right" onclick="checkboxGoldDemand()">
									<script language="JavaScript" type="text/javascript">document.write('<input class="cb" type="checkbox" name="gold_demand1" unchecked></td>');</script>
									</td><td></td><td></td>
									</tr>
																		<?php if (! $this->_tpl_vars['trade_agreement']): ?>
									<tr id="trade_rightsOpt">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Trade Rights</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="trade_rights" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
																		<?php if (! $this->_tpl_vars['alliance']): ?>
									<tr id="allianceOpt" onclick='checkboxAlliance()'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Alliance</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="alliance" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
																		<?php if (! $this->_tpl_vars['military_agreement']): ?>
									<tr id="military_rightsOpt">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Military Rights</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="military_rights" <?php echo $this->_tpl_vars['cnd']; ?>
></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
									<tr>
									<td colspan="4" style="padding-top:20px; vertical-align: bottom">
										<center><span class="headerlrge">~ Offers ~</span></center>
									</td>
									</tr>
																		<tr id="gofferchbox">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Give <span id="gold_offer_display">gold</span>&nbsp;&nbsp;&nbsp;<span id="edit_goffer"></span></td>
									<td align="right"><input type="text" name="gold_offer_real" size="7" maxlength="8" autocomplete="off" value=""></td>
									<td width="13" onclick="checkboxGoldOffer()">
									<script language="JavaScript" type="text/javascript">document.write('<input class="cb" type="checkbox" name="gold_offer1" unchecked></td>');</script>
									</td><td></td><td></td>
									</tr>
																		<?php if ($this->_tpl_vars['at_war']): ?>
									<tr onclick='checkboxEndWar()'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Ceasefire</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="end_war" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['alliance']): ?>
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break alliance</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="break_alliance" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['trade_agreement']): ?>
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break trade agreement</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="break_trade" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['military_agreement']): ?>
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break military agreement</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="break_military" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<?php endif; ?>
									</table>
									<?php endif; ?>
									<?php if (! $this->_tpl_vars['enemy_prohibit_diplomacy'] && ! $this->_tpl_vars['player_prohibit_diplomacy']): ?>
									<div style="text-align:right; padding-top:20px">
									<input type="submit" name="do_diplomacy" value="Make Notification" class="mainoption">
									</div>
									<?php endif; ?>
								</td>
							</tr>
							</table>
							</td>
						</tr>
					</table>
					</div>
				</td>
		</tr>
		</table>

        <?php echo $this->_tpl_vars['End_Shadow']; ?>

		</form>
		
<script language="JavaScript" type="text/javascript">
<?php if (! $this->_tpl_vars['player_prohibit_diplomacy'] && ! $this->_tpl_vars['enemy_prohibit_diplomacy']): ?>
	document.diplo.gold_demand1.checked = false;
	document.diplo.gold_demand_real.value = '';
	document.diplo.gold_demand_real.style.display = 'none';
	document.gold_demand_form.gold_demand_dialog.value = '';
	document.diplo.gold_offer1.checked = false;
	document.diplo.gold_offer_real.value = '';
	document.diplo.gold_offer_real.style.display = 'none';
	document.gold_offer_form.gold_offer_dialog.value = '';
<?php endif; ?>
	var currency = " " + "gold";
	var mony_prefix = "";
	var maxmoney = parseFloat(<?php echo $this->_tpl_vars['maxmoney']; ?>
);
	var chkAlly = "alliance";
	var chkTradeR = "trade_rights";
	var chkMilR = "military_rights";
<?php if (! $this->_tpl_vars['enemy_prohibit_diplomacy']):  echo '
document.getElementById(\'declare_bt\').style.display = \'none\';
';  endif;  echo '
';  if ($this->_tpl_vars['at_war']):  echo '
if(!document.diplo.end_war.checked){disableCheckbox(chkAlly);disableCheckbox(chkTradeR);}
';  endif;  echo '
';  if (! $this->_tpl_vars['alliance']):  echo '
if(!document.diplo.alliance.checked){disableCheckbox(chkMilR);}
';  endif; ?>
</script>