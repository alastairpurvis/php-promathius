<table cellspacing="0" cellpadding="0" width=510 style="margin-top: -65px;position: relative;padding-bottom:24px">
<tr>
<td id="turnthick" align="center" class="shlarge" rowspan=2 style="padding-top: 5px; padding-right: 3px; padding-left: 3px; ">
<div id="turnbox" style="height:290px; width: 510px; text-align:center;">
<table cellpadding=0 cellspacing=0 style="height:290px; width:510px; padding-top: 10px;" align=center><td style="text-align:center" align=center>
<script type="text/javascript">	var Turnbox=new animatedcollapse("turnbox", 600, false, false);openTurnWindow()</script>
<div style="width: 440px; text-align:LEFT; padding-bottom: 5px; margin-left: auto;margin-right: auto;"> <b>{$turndata.TurnsTaken} T</b></div>
	<div class="turnbase">
	<table cellpadding=0 cellspacing=0 align=center width=420>
{*				<tr id="turnresult"><th colspan="3" align="center">
				<span style="font-size: 12px"><b>
				{if $turndata.Type == 'build'}Construction
				{elseif $turndata.Type == 'demolish'}Demolition complete
				{elseif $turndata.Type == 'land'}Exploration success
				{elseif $turndata.Type == 'recruit'}Training complete
				{/if}
				</b></span></th></tr>
				<tr><th colspan="3">
				&nbsp</th></tr>
				<tr><th colspan="3">
				&nbsp</th></tr> *}
				<tr>
				<td style="vertical-align:top">
				<table id="economy" style="opacity:0;-moz-opacity: 0;-khtml-opacity: 0;filter: alpha(opacity=0);" class=font>
				<tr>
				<th colspan="2" align=center><u>Economy</u></th></tr>
				<tr><th>Income</th>
					<td>${$turndata.NetIncome|commas}</td></tr>
				<tr><th>Expenses</th>
					<td>${$turndata.NetExpenses|commas}</td>
				{if $turndata.LoanPay}
				<tr><th>Loan Pay</th>
					<td>${$turndata.LoanPay|commas}</td></tr>
				{/if}
				<tr><th>NET</th>
					<td>{$turndata.NetMoney}</td></tr>
				</table></td>
				<td style="vertical-align:top">
				<table id="population" style="opacity:0;-moz-opacity: 0;-khtml-opacity: 0;filter: alpha(opacity=0);" class=font>
				<tr><th colspan="2" align=center><u>Growth</u></th></tr>
				<tr><th>Natives</th>
					<td>{$turndata.Births}</td></tr>
				<tr><th>Settlers</th>
					<td>{$turndata.Settlers}</td></tr>
				<tr><th>Emigrants</th>
					<td>{$turndata.Emigrants}</td></tr>
				<tr><th>NET</th>
					<td>{$turndata.NetPopulation}</td></tr>
				{*	<tr><th>{$uera.wizards}:</th>
							<td>{$turndata.NetWizards}</td></tr> *}
				<tr><th>&nbsp;</th>
					<td>&nbsp;</tr>
				</table></td>
				<td style="vertical-align:top">
				<table id="agriculture" style="opacity:0;-moz-opacity: 0;-khtml-opacity: 0;filter: alpha(opacity=0);" class=font>
				<tr><th colspan="2" align=center><u>Agriculture</u></th></tr>
				<tr><th>Produced</th>
					<td>{$turndata.FoodPro|commas}</td></tr>
				<tr><th>Consumed</th>
					<td>{$turndata.FoodCon|commas}</td></tr>
				<tr><th>NET</th>
					<td>{$turndata.NetFood}</th></tr>
				</table></td></tr>
				<tr><td colspan="3" id="turnorder"><table align=center width=80%><td><B>Order </b>&nbsp;&nbsp;{$turndata.NetOrder}</td><td><b>{$uera.runes} </b>&nbsp;&nbsp;{$turndata.NetRunes}</td>{if $turndata.NetMilitaryRaw < 0}<td><b>Military </b>&nbsp;&nbsp;{$turndata.NetMilitary}</td>{/if}</table></tr>
								<tr><th colspan="3">
				&nbsp</th></tr>
				{*<tr><td colspan="3" style="text-align:center">{$turndata.TaxMessage}</td></tr>
				<tr><td colspan="3" style="text-align:center">$indlackmsg</td></tr>
					<tr><td colspan="3" style="text-align: center"><br />$lackmessage</td></tr> *}