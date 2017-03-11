{* Include Profile tabs *}
{include file="actions/profile/profile.tab"}

		<form method="post" action="?profile&Tab=diplomacy&target={$target}" name="diploctrl">
			<table width=480 valign="top">
				<tr>
					<td style="vertical-align:top;width:40%;padding-left: 20px;padding-right: 12px">
						<table cellspacing="0" cellpadding="4" style="width:100%; vertical-align: top">
							<tr>
								<td>
								<table cellspacing="0" cellpadding="0" style="width:100%">
										<tr colspan=2 style="padding-top: 7px">
											<h1><b>{$enemy.empire|upper}</b></h1>
											
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
									{if !$alliance && !$trade_agreement && !$military_agreement}
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											{if $player_prohibit_diplomacy}
													Allow diplomatic relations
												</td>
												<td width="13" onclick='checkboxAllowDiplomacy()'>
													<input class="cb" type="checkbox" name="allow_diplomacy" unchecked></td>
									<script language="JavaScript" type="text/javascript">document.diploctrl.allow_diplomacy.checked = false;</script>
											{elseif $enemy_prohibit_diplomacy}
													This {$uera.empire} does not wish to do diplomacy with you.
											{else}
													Prohibit diplomatic relations
												</td>
											<td width="13" onclick='checkboxProhibitDiplomacy()'>
											<input class="cb" type="checkbox" name="prohibit_diplomacy" unchecked></td>
									<script language="JavaScript" type="text/javascript">document.diploctrl.prohibit_diplomacy.checked = false;</script>
											{/if}
										</td>
										</tr>
									{/if}
								<script language="JavaScript" type="text/javascript">{if $military_agreement}var milagree = 1;{else}var milagree = 0;{/if}</script>
									{if $alliance}
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Alliance
										</td>
										{literal}
										<td width="13" onclick="checkboxAlliance()">
										{/literal}
										<input class="cb" type="checkbox" name="end_alliance" unchecked></td>
										</td>
										</tr>
										{else}
									<tr><td>
								<div style="display:none"><input type="checkbox" name="end_alliance"></div>
								</td></tr>
									{/if}
									<script language="JavaScript" type="text/javascript">document.diploctrl.end_alliance.checked = false;</script>
									{if $trade_agreement}
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Trade Agreement
										</td>
										<td width="13" onclick="checkboxEndTrade()">
										<input class="cb" type="checkbox" name="end_trade" unchecked></td>
										</td>
										</tr>
									{else}
									<tr><td>
								<div style="display:none"><input type="checkbox" name="end_trade"></div>
								</td></tr>
									{/if}
								<script language="JavaScript" type="text/javascript">document.diploctrl.end_trade.checked = false;</script>
									{if $military_agreement}
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Military Agreement
										</td>
										<td width="13" onclick="checkboxEndMilitary()">
										<input class="cb" type="checkbox" name="end_military" unchecked></td>
										</td>
										</tr>
										{else}
									<tr><td>
								<div style="display:none"><input type="checkbox" name="end_military"></div>
								</td></tr>
									{/if}
									<script language="JavaScript" type="text/javascript">document.diploctrl.end_military.checked = false;</script>
									</table>
									{if !$enemy_prohibit_diplomacy}
									<div style="text-align:right; padding-top:15px" id="declare_bt">
									<input type="submit" name="set_diplomacy" value="Make Declaration" class="mainoption">
									</div>
									{/if}
									</form>
									{if !$player_prohibit_diplomacy && !$enemy_prohibit_diplomacy}
									<script language="JavaScript" type="text/javascript">initCurrencyDialog();</script>
									<div id="diplomacybox">
									<form method="post" action="?profile&tab=diplomacy&target={$target}" name="diplo">
									<br><br>
									<center><span class="headerlrge">~ Demands ~</span></center>
									<table width=100% cellspacing="0" cellpadding="0">
									{* Gold *}
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
									{* Trade Rights *}
									{if !$trade_agreement}
									<tr id="trade_rightsOpt">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Trade Rights</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="trade_rights" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{* Alliance *}
									{if !$alliance}
									<tr id="allianceOpt" onclick='checkboxAlliance()'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Alliance</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="alliance" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{* Military Rights *}
									{if !$military_agreement}
									<tr id="military_rightsOpt">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Military Rights</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="military_rights" {$cnd}></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									<tr>
									<td colspan="4" style="padding-top:20px; vertical-align: bottom">
										<center><span class="headerlrge">~ Offers ~</span></center>
									</td>
									</tr>
									{* Offer Gold *}
									<tr id="gofferchbox">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Give <span id="gold_offer_display">gold</span>&nbsp;&nbsp;&nbsp;<span id="edit_goffer"></span></td>
									<td align="right"><input type="text" name="gold_offer_real" size="7" maxlength="8" autocomplete="off" value=""></td>
									<td width="13" onclick="checkboxGoldOffer()">
									<script language="JavaScript" type="text/javascript">document.write('<input class="cb" type="checkbox" name="gold_offer1" unchecked></td>');</script>
									</td><td></td><td></td>
									</tr>
									{* End War*}
									{if $at_war}
									<tr onclick='checkboxEndWar()'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Ceasefire</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="end_war" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{if $alliance}
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break alliance</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="break_alliance" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{if $trade_agreement}
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break trade agreement</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="break_trade" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{if $military_agreement}
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break military agreement</td>
									<td width="13" colspan="2" align="right">
									<input class="cb" type="checkbox" name="break_military" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									</table>
									{/if}
									{if !$enemy_prohibit_diplomacy && !$player_prohibit_diplomacy}
									<div style="text-align:right; padding-top:20px">
									<input type="submit" name="do_diplomacy" value="Make Notification" class="mainoption">
									</div>
									{/if}
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

        {$End_Shadow}
		</form>
		
<script language="JavaScript" type="text/javascript">
{if !$player_prohibit_diplomacy && !$enemy_prohibit_diplomacy}
	document.diplo.gold_demand1.checked = false;
	document.diplo.gold_demand_real.value = '';
	document.diplo.gold_demand_real.style.display = 'none';
	document.gold_demand_form.gold_demand_dialog.value = '';
	document.diplo.gold_offer1.checked = false;
	document.diplo.gold_offer_real.value = '';
	document.diplo.gold_offer_real.style.display = 'none';
	document.gold_offer_form.gold_offer_dialog.value = '';
{/if}
	var currency = " " + "gold";
	var mony_prefix = "";
	var maxmoney = parseFloat({$maxmoney});
	var chkAlly = "alliance";
	var chkTradeR = "trade_rights";
	var chkMilR = "military_rights";
{if !$enemy_prohibit_diplomacy}{literal}
document.getElementById('declare_bt').style.display = 'none';
{/literal}{/if}{literal}
{/literal}{if $at_war}{literal}
if(!document.diplo.end_war.checked){disableCheckbox(chkAlly);disableCheckbox(chkTradeR);}
{/literal}{/if}{literal}
{/literal}{if !$alliance}{literal}
if(!document.diplo.alliance.checked){disableCheckbox(chkMilR);}
{/literal}{/if}
</script>