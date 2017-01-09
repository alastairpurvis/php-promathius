	{include file="attackconfig.tpl"}
	 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
	<span class="success-font">{$message}</span>
	</tr>
	</table>
	</div>
	</table>
	</div>
	{$End_Shadow}

{* Include Profile tabs *}
{include file="actions/profile/profile.tab"}

			<table width=480 valign="top">
				<tr>
					<td style="vertical-align:top;width:40%;padding-left: 20px;padding-right: 12px">
						<table cellspacing="0" cellpadding="4" style="width:100%; vertical-align: top">
							<tr>
								<td>
									<table cellspacing="0" cellpadding="0" style="width:100%;">
										<tr colspan=2 style="padding-top: 16px">
											<h1><b>{$enemy.empire|upper}</b></h1>
											{if $enemy.land > 0}{if $eturnsleft > 0}Under Protection for {$eturnsleft} more turn{if $eturnsleft > 1}s{/if}{/if}{/if}{if $enemy.land == 0}This settlement is no longer{/if}
										</tr>
										<tr>
											<td style="padding-top: 19px"><img src="{$dat}images/spacer.gif" height=0 width=1 /></td>
											</td>
										</tr>
										<th>
													{if $enemy.land == 0}
													(Former) Ruler 
													{else}
													Ruler 
													{/if}
										</th>
										<td>
													<a href="forum/profile.php?mode=viewprofile&u={$enemy.usernum}">{$enemy.igname}</a></span>
												
										</td>
										{if $enemy.land != 0}
										<tr>
											<th>Rank </th>
											<td class="aleft">{$enemy.rank}</td>
										</tr>
										{/if}
										<tr>
											<td style="padding-top: 19px"><img src="{$dat}images/spacer.gif" height=0 width=1 /></td>
											</td>
										</tr>
										{* Power *}
										{if $enemy.land != 0 && $enablepower == True}
										<tr>
											<th>Power </th>
											<td class="aleft">{$power}</td>
										</tr>{/if}
										
										{* Wealth *}
										{if $enemy.land != 0 && $enablewealth == True}
										<tr>
											<th>Wealth </th>
											<td class="aleft">{$wealth}</td>
										</tr>{/if}
										
										{* Territory *}
										{if $enemy.land != 0}
										<tr>
											<th>Territory </th>
											<td class="aleft">{$enemy_land_new} acres</td>
										</tr>
										{/if}
										{if $enemy.land != 0}
										<tr>
											<th>Public Order </th>
											<td class="aleft">{$enemy.health} %</td>
										</tr>
										{/if}
										<tr>
											<td class="aleft"><img src="{$dat}images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
										<tr>
											<td class="aleft"><img src="{$dat}images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
										<tr>
											<th>Established</th>
											<td class="aleft">{$enemy.start_year} {$enemy.year_acronym}</td>
										</tr>
										{if $enemy.land == 0}
										<tr>
											<th>Date of destruction</th>
											<td class="aleft">{$enemy.destructiondate|makeDate}</td>
										 </tr>
										{/if}
										<tr>
											<th>Region</th>
											<td class="aleft">{$eera.name}</td>
										</tr>
										<tr>
											<td class="aleft"><img src="{$dat}images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
												<tr>
													<th>Victories </th>
													<td>{$enemy.offtotal}</td>
												</tr>

												<tr>
													<th>Defeats </th>
													<td>{$enemy.deftotal}</td>
												</tr>
											<td class="aleft"><img src="{$dat}images/spacer.gif" height=35 width=1 />
									</table>
								</td>
							<td valign=top>
								<table style="width:100%" cellspacing="0" cellpadding="0">
									<tr>
										<td class="aright">
											<table style="width:100%" cellspacing="0" cellpadding="0">
												<tr>
													<td style="padding-top:8px" class="acenter" colspan="2"><img src="data/images/symbols/profile/{$erace.name}.png" /></td>
												</tr>
												<tr>
													<td class="acenter" style="padding-top:4px" colspan="2">{$erace.name}</td>
												</tr>
										<tr>
											<td class="aleft"><img src="{$dat}images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
												<tr>
													<td style="padding-top:8px" class="acenter" colspan="2"><div style="height:48px; font-size: 48px; font-family: Times New Roman">{$enemy.networth}</div><div>
			<span style="font-size: 10px;font-family: Verdana, Arial;">{if $enemy.land == 0}Top {/if}{$lang.greatness}</span></div></td>
												</tr>
												<tr>
													<td class="aleft" style="padding-top:48px"><img src="{$dat}images/spacer.gif" height=0 width=1 /></td>
												</tr>
											</table>
									</tr>
								</table>
						</tr>
						<tr>
							<td style="vertical-align:bottom; padding-top:20px" valign="bottom" colspan=2>
							<table style="width:100%" cellspacing="0" cellpadding="0">
							<tr>
								<td align=right>
								{if $loggedin==true}
								{if $enemy.land != 0}<span style="font-size: 10px">{if $eturnsleft <= 0}{if $turnsleft <= 0}<input type="button" class="mainoption" value="Attack" onclick="Turnbox.toggle();"> {/if}{/if}{/if}<a href="privmsg.php?mode=post&u={$enemy.usernum}"><input type="button" class="mainoption" value="Send Message"></span>
								{/if}
								</td>
							</tr>
							</table>
							</td>
						</tr>
					</table>
				</td>
		</tr>
		</table>
        {$End_Shadow}
