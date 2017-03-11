<table class="invisible" cellspacing=0 cellpadding=0 width=400  style='padding: 0px; margin: 0px'><tr><td width=100%>
{$BeginTabmenu}
{$oTab}<a class="guitab" href="{$main}?profiles&num={$enemy.num}">Profile</a>{$cTab}
{$oTabActive}Diplomacy{$cTabActive}
{$EndTabmenu}
</table>
<table cellspacing="0" cellpadding="0" width=400>
	<tr>
		<td align="center" class="shlarge" rowspan=2 style="padding-top:8px;padding-bottom:6px">
			<table style="padding-left: 20px;padding-right: 12px" width=390 valign="top">
				<tr>
					<td style="vertical-align:top;width:40%">
						<table cellspacing="0" cellpadding="4" style="width:100%; vertical-align: top">
							<tr>
								<td>
								<table cellspacing="0" cellpadding="0" style="width:100%">
										<tr colspan=2 style="padding-top: 7px">
											<h1><b>{$enemy.empire}</b></h1>
											{if $enemy.land > 0}{if $eturnsleft > 0}Under Protection for {$eturnsleft} more turn{if $eturnsleft > 1}s{/if}{/if}{/if}
										</tr>
								</table>
							<td valign=top>
						<tr>
							<td style="vertical-align:bottom; padding-top:8px" valign="bottom" colspan=2>
							<table style="width:100%" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<table style="width:100%" cellspacing="0" cellpadding="0">
									<tr>
									{if !$alliance}
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											{if $player_prohibit_diplomacy}
													Allow diplomatic relations
												</td>
												<td width="13">
													<input class="cb" type="checkbox" name="allow_diplomacy" unchecked></td>
											{elseif $enemy_prohibit_diplomacy}
													This {$uera.empire} does not wish to do diplomacy with you.
											{else}
													Prohibit diplomatic relations
												</td>
											<td width="13">
											<input class="cb" type="checkbox" name="prohibit_diplomacy" unchecked></td>
											{/if}
										</td>
										</tr>
									{/if}
									{if $alliance}
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Alliance
										</td>
										<td width="13">
										<input class="cb" type="checkbox" name="end_alliance" unchecked></td>
										</td>
										</tr>
									{/if}
									{if $trade_agreement}
										<tr>
										<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">
											End Trade Agreement
										</td>
										<td width="13">
										<input class="cb" type="checkbox" name="end_trade" unchecked></td>
										</td>
										</tr>	
									{/if}
									</table>
									{if !$player_prohibit_diplomacy && !$enemy_prohibit_diplomacy}
									<form name="gold_demand_form" action="">
									<script language="JavaScript" type="text/javascript">
									{literal}
									document.write('<div id="goldbox_demand" style="text-align:center;display:none"><br><br><b>How much gold do you demand?</b><br><br><input type="text" name="gold_demand_dialog" size="7" max="10" maxlength="8" autocomplete="off" value=""><br><br><input type="button" name="" value="Make Demand" class="mainoption" onclick="if(document.gold_demand_form.gold_demand_dialog.value > 0){updateGoldDemand();document.getElementById(' + "'diplomacybox'" + ').style.display = ' + "''" + ';document.getElementById(' + "'goldbox_demand'" + ').style.display = ' + "'none'" + ';document.diplo.do_diplomacy.style.display = ' + "''" + ';}else{document.diplo.gold_demand1.checked.checked = false}"><br></div>');
									{/literal}
									</script>
									</form>
									<div id="diplomacybox">
									<form method="post" action="?diplomacy" name="diplo">
									<br><br>
									<center><span class="headerlrge">~ Demands ~</span></center>
									<table width=336 cellspacing="0" cellpadding="0">
									{* Trade Rights *}
									{if !$trade_agreement}
									<tr id="trade_rightsOpt">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Trade Rights</td>
									<td width="13">
									<input class="cb" type="checkbox" name="trade_rights" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{* Alliance *}
									{if !$alliance}
									<tr id="allianceOpt" onclick='toggleDiplomacyOption("military_rightsOpt",document.diplo.alliance,document.diplo.military_rights)'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Alliance</td>
									<td width="13">
									<input class="cb" type="checkbox" name="alliance" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{* Military Rights *}
									<tr id="military_rightsOpt">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Military Rights</td>
									<td width="13">
									<input class="cb" type="checkbox" name="military_rights" {$cnd}></td>
									</td><td></td><td></td>
									</tr>
									{* Gold *}
									<tr onclick="{literal}if(document.diplo.gold_demand1.checked){if( !document.diplo.gold_demand_real.value){document.getElementById('diplomacybox').style.display = 'none';document.diplo.do_diplomacy.style.display = 'none';document.getElementById('goldbox_demand').style.display = '';}}else{document.diplo.gold_demand_real.value = ''; document.gold_demand_form.gold_demand_dialog.value = '';updateGoldDemand()}{/literal}">
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Give <span id="gold_demand_display"></span> Gold &nbsp;&nbsp;&nbsp;<span id="edit_gdemand"></span></td>
									<td width="13">
									<input type="text" name="gold_demand_real" size="7" maxlength="8" autocomplete="off" value="" style="display:none">
									<input class="cb" type="checkbox" name="gold_demand1" unchecked></td>
									</td><td></td><td></td>
									</tr>
									<tr>
									<td colspan="3" style="padding-top:20px; vertical-align: bottom">
										<center><span class="headerlrge">~ Offers ~</span></center>
									</td>
									</tr>
									{* End War*}
									{if $at_war}
									<tr onclick='toggleDiplomacyOption("allianceOpt",document.diplo.end_war,document.diplo.alliance); toggleDiplomacyOption("trade_rightsOpt",document.diplo.end_war,document.diplo.trade_rights); {literal}if(!document.diplo.end_war.checked){toggleDiplomacyOption("military_rightsOpt",document.diplo.end_war,document.diplo.military_rights); document.getElementById("military_rightsOpt").style.display = "none";}{/literal}'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Ceasefire</td>
									<td width="13">
									<input class="cb" type="checkbox" name="end_war" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{if $alliance}
									<tr onclick='toggleDiplomacyOptionReverse("military_rightsOpt",document.diplo.break_alliance,document.diplo.military_rights);'>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break alliance</td>
									<td width="13">
									<input class="cb" type="checkbox" name="break_alliance" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									{if $trade_agreement}
									<tr>
									<td colspan="2" style="padding-bottom:4px; vertical-align: bottom">Threaten to break trade agreement</td>
									<td width="13">
									<input class="cb" type="checkbox" name="break_trade" unchecked></td>
									</td><td></td><td></td>
									</tr>
									{/if}
									</table>
									{/if}
									{if !$enemy_prohibit_diplomacy}
									<div style="text-align:right; padding-top:20px">
									<input type="submit" name="do_diplomacy" value="Make Proposition" class="mainoption">
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
			var DiplomacyBox=new animatedcollapse("diplomacybox", 200, false, true);
		{/if}
//updateGoldDemand();
document.diplo.gold_demand1.checked = false;
document.diplo.gold_demand_real.value = '';
document.gold_demand_form.gold_demand_dialog.value = '';

{literal}
		function updateGoldDemand(){
		var updaterd = document.getElementById('gold_demand_display');
		updaterd.innerHTML = document.gold_demand_form.gold_demand_dialog.value;
		var updateredit = document.getElementById('edit_gdemand');
		if(document.gold_demand_form.gold_demand_dialog.value){
		updateredit.innerHTML = "<a style='cursor: pointer' onclick=" + '"' + "if(document.diplo.gold_demand1.checked){document.getElementById('diplomacybox').style.display = 'none';document.getElementById('goldbox_demand').style.display = '';}" + '"' + ">(edit)</a>";
		}
		else
		{
		updateredit.innerHTML = "";
		}
		document.diplo.gold_demand_real.value = document.gold_demand_form.gold_demand_dialog.value;
		}
		//else{document.diplo.gold_demand_real.value = ''; document.diplo.gold_demand_dialog.value = '';updateGoldDemand()}
{/literal}{if $at_war}{literal}
if(!document.diplo.end_war.checked){disableCheckbox("military_rights");disableCheckbox("trade_rights");disableCheckbox("alliance");}
{/literal}{/if}{literal}
{/literal}{if $alliance}{literal}
if(document.diplo.break_alliance.checked){disableCheckbox("military_rights");}
{/literal}{/if}{literal}
{/literal}{if !$alliance}{literal}
if(!document.diplo.alliance.checked){disableCheckbox("military_rights");}
{/literal}{/if}{literal}

{/literal}
</script>