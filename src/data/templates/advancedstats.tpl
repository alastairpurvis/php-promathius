 <table cellspacing="0" cellpadding=8 class="statusbg" id="statuscontent">
                	<tr>
                    	<td align=center>
						<script type="text/javascript">var TimeMinutes = {$nextturnmin};var TimeSeconds = {$nextturnseconds};var TurnsAcquired = 0;var rawseconds = {$rawseconds};var perminutefl = {$perminutefl};var perminutes = {$perminutes}; var CurrentTurns = {$turns_new};var maxturns = {$maxturns}; var turnsform = "{$turnsperplural}"; var turnsplural = "{$turnsplural}";var turnsperx = {$turnsper};</script>
                <div class="tabber" id="status">
                 <div class="tabbertab">
                  <h2>General</h2>
                                 <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Rank</th>
                                        <td>#{$users.rank}</td></tr>
                               {*          <tr><th>{$foodname}: *}
                               {*     	<td>{$food_new|gamefactor}</td> *}
                                    <tr><th>Population</th>
                                        <td>{$users.peasants}{$employment.perfect}</td></tr>
                                    {if $employment.workersneeded}
	                                  		<tr><th>Workers Needed</th>
		                                        <td>{$employment.workersneededpercent}% more</td></tr>
		                                {elseif $employment.unemployed}
                                    		<tr><th>Unemployment</th>
		                                        <td>{$employment.unemployedpercent}%</td></tr>
		                                {else}
                                    		<tr><th>Employment</th>
		                                        <td><b>Perfect</b></td></tr>
                                    {/if}
                                    <tr><th>Command</th>
                                        <td>{$experience}</td></tr>
                                    <tr><th>Espionage</th>
                                        <td>{$espionage}</td></tr>
                                                                <tr><td colspan="2">&nbsp;</td></tr>
                                    <tr><th>Conquered Empires</th>
                                        <td>{$users.kills}</td></tr>
                                    <tr><th>Turns Used:</th>
                                        <td>{$users.turnsused}</td></tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr><td colspan=2 align=center><span id="ttimer">{if $turns_new < $maxturns}Next {$turnsperplural} in {if $nextturnmin >= 1}{$nextturnmin} {$perminutesplural} and {/if}{$nextturnseconds} seconds{else}Maximum turns accumulated{/if}</span></td></tr>
                                                </table>
                 </div>        
                 <div class="tabbertab">
                  <h2>Finances</h2>
                            <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Income</th>
                                        <td>{$income}</td></tr>
                                    <tr><th style="padding-left: 25px">Trade</th>
                                        <td style="padding-left: 10px">{$tradeincome}</td></tr>
									{* Structure Income Total 
                                    <tr><th style="padding-left: 25px">Structures</th>
                                        <td style="padding-left: 10px">{$structureincometotal}</td></tr>
										*}
                                {section name=i loop=$structureincome}
                                      <tr><th style="padding-left: 25px">{$structureincome[i].name}</th>
                                        <td style="padding-left: 10px">{$structureincome[i].value}</td></tr>
								{/section}
                                    <tr><th style="padding-left: 25px">Tax Income</th>
                                        <td style="padding-left: 10px">{$taxincome}</td></tr>
                                    <tr><th>Expenses</th>
                                        <td>{$expenses}</td></tr>
                                    <tr><th style="padding-left: 25px">Army Upkeep</th>
                                        <td style="padding-left: 10px">{$troopcosts}</td></tr>
                                    <tr><th style="padding-left: 25px">Agent Salaries</th>
                                        <td style="padding-left: 10px">{$wizardcosts}</td></tr>
                                    <tr><th style="padding-left: 25px">Management</th>
                                        <td style="padding-left: 10px">{$landupkeep}</td></tr>
                                    <tr><th style="padding-left: 25px">Corruption</th>
                                        <td style="padding-left: 10px">{$corruption}</td></tr>
									{if $loanpayment}
                                    <tr><th style="padding-left: 25px">Loan Payment</th>
                                        <td style="padding-left: 10px">{$loanpayment}</td></tr>
									{/if}
                                    <tr><th>NET</th>
                                        <td>{$netincome}</td></tr>
                                    </table>
                 </div>
                  <div class="tabbertab">
                  <h2>Order</h2>
                            <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Positive Impacts</th>
                                        <td></td></tr>
                                {section name=id loop=$publicorderpositives}
                                      <tr><th style="padding-left: 25px">{$publicorderpositives[id].name}</th>
                                        <td style="padding-left: 10px">+{$publicorderpositives[id].value}%</td></tr>
                                {/section}
                                    <tr><th>Negative Impacts</th>
                                        <td></td></tr>
									{section name=id loop=$publicordernegatives}
										  <tr><th style="padding-left: 25px">{$publicordernegatives[id].name}</th>
											<td style="padding-left: 10px">-{$publicordernegatives[id].value}%</td></tr>
									{/section}
                                    </table>
                 </div>   
            
                 <div class="tabbertab">
                  <h2>Military</h2>
                            <table cellpadding=0 class="tabberstatus">
                                {section name=have loop=$troopshave}
                                  {if $troopshave[have].have > 0} {* Does the player have the unit? *}
                                      <tr><th>{$troopshave[have].name}</th>
                                        <td>{$troopshave[have].have}</td></tr>
                                  {/if}
                                {/section}
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                    <tr><th>{$uera.wizards}</th>
                                        <td>{$users.wizards}</td>
                                    {*<tr><th>Offensive Points</th>
                                        <td>{$offpts}</td></tr>
                                    <tr><th>Defensive Points</th>
                                        <td>{$defpts}</td></tr>*}
                                                </table>
                 </div>
            
                 <div class="tabbertab">
                  <h2>Land</h2>
                              <table cellpadding=0 class="tabberstatus">
                                {section name=have loop=$structures}
                                      <tr><th>{$structures[have].name}</th>
                                        <td>{$structuresworking[have].have} / {$structures[have].have}</td></tr>
                                {/section}
                                                </table>     
					</div>
             
                  <div class="tabbertab">
                  <h2>Production</h2>
                               <table cellpadding=0 class="tabberstatus">
                                    <tr><th>{$uera.food} Production</th>
                                        <td>{$foodpro}</td></tr>
                                    <tr><th>{$uera.food} Consumption</th>
                                        <td>{$foodcon}</td></tr>                                    
                                    <tr><th>Net</th>
                                        <td>{$foodnet}</td></tr>
                                    <tr><th>{$uera.food} Stored</th>
                                        <td>{$food}</td></tr>    
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                     <tr><th>{$uera.runes} Production</th>
                                        <td>{$runeproduce}</td></tr>
                                     <tr><th>{$uera.wizards} Recruited Per Turn</th>
                                        <td>{$wizardrate}</td></tr>
                                </table>
                 </div>
            
            </div>
</table>