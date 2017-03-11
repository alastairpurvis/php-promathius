<?php /* Smarty version 2.6.0, created on 2009-05-29 15:54:19
         compiled from actions/profile/profile.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'actions/profile/profile.tpl', 22, false),array('modifier', 'makeDate', 'actions/profile/profile.tpl', 92, false),)), $this); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "attackconfig.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 <tr id="turnaction"><td colspan="3" style="text-align: center"><br /><br />
	<span class="success-font"><?php echo $this->_tpl_vars['message']; ?>
</span>
	</tr>
	</table>
	</div>
	</table>
	</div>
	<?php echo $this->_tpl_vars['End_Shadow']; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "actions/profile/profile.tab", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<table width=480 valign="top">
				<tr>
					<td style="vertical-align:top;width:40%;padding-left: 20px;padding-right: 12px">
						<table cellspacing="0" cellpadding="4" style="width:100%; vertical-align: top">
							<tr>
								<td>
									<table cellspacing="0" cellpadding="0" style="width:100%;">
										<tr colspan=2 style="padding-top: 16px">
											<h1><b><?php echo ((is_array($_tmp=$this->_tpl_vars['enemy']['empire'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</b></h1>
											<?php if ($this->_tpl_vars['enemy']['land'] > 0):  if ($this->_tpl_vars['eturnsleft'] > 0): ?>Under Protection for <?php echo $this->_tpl_vars['eturnsleft']; ?>
 more turn<?php if ($this->_tpl_vars['eturnsleft'] > 1): ?>s<?php endif;  endif;  endif;  if ($this->_tpl_vars['enemy']['land'] == 0): ?>This settlement is no longer<?php endif; ?>
										</tr>
										<tr>
											<td style="padding-top: 19px"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=0 width=1 /></td>
											</td>
										</tr>
										<th>
													<?php if ($this->_tpl_vars['enemy']['land'] == 0): ?>
													(Former) Ruler 
													<?php else: ?>
													Ruler 
													<?php endif; ?>
										</th>
										<td>
													<a href="forum/profile.php?mode=viewprofile&u=<?php echo $this->_tpl_vars['enemy']['usernum']; ?>
"><?php echo $this->_tpl_vars['enemy']['igname']; ?>
</a></span>
												
										</td>
										<?php if ($this->_tpl_vars['enemy']['land'] != 0): ?>
										<tr>
											<th>Rank </th>
											<td class="aleft"><?php echo $this->_tpl_vars['enemy']['rank']; ?>
</td>
										</tr>
										<?php endif; ?>
										<tr>
											<td style="padding-top: 19px"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=0 width=1 /></td>
											</td>
										</tr>
																				<?php if ($this->_tpl_vars['enemy']['land'] != 0 && $this->_tpl_vars['enablepower'] == True): ?>
										<tr>
											<th>Power </th>
											<td class="aleft"><?php echo $this->_tpl_vars['power']; ?>
</td>
										</tr><?php endif; ?>
										
																				<?php if ($this->_tpl_vars['enemy']['land'] != 0 && $this->_tpl_vars['enablewealth'] == True): ?>
										<tr>
											<th>Wealth </th>
											<td class="aleft"><?php echo $this->_tpl_vars['wealth']; ?>
</td>
										</tr><?php endif; ?>
										
																				<?php if ($this->_tpl_vars['enemy']['land'] != 0): ?>
										<tr>
											<th>Territory </th>
											<td class="aleft"><?php echo $this->_tpl_vars['enemy_land_new']; ?>
 acres</td>
										</tr>
										<?php endif; ?>
										<?php if ($this->_tpl_vars['enemy']['land'] != 0): ?>
										<tr>
											<th>Public Order </th>
											<td class="aleft"><?php echo $this->_tpl_vars['enemy']['health']; ?>
 %</td>
										</tr>
										<?php endif; ?>
										<tr>
											<td class="aleft"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
										<tr>
											<td class="aleft"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
										<tr>
											<th>Established</th>
											<td class="aleft"><?php echo $this->_tpl_vars['enemy']['start_year']; ?>
 <?php echo $this->_tpl_vars['enemy']['year_acronym']; ?>
</td>
										</tr>
										<?php if ($this->_tpl_vars['enemy']['land'] == 0): ?>
										<tr>
											<th>Date of destruction</th>
											<td class="aleft"><?php echo ((is_array($_tmp=$this->_tpl_vars['enemy']['destructiondate'])) ? $this->_run_mod_handler('makeDate', true, $_tmp) : makeDate($_tmp)); ?>
</td>
										 </tr>
										<?php endif; ?>
										<tr>
											<th>Region</th>
											<td class="aleft"><?php echo $this->_tpl_vars['eera']['name']; ?>
</td>
										</tr>
										<tr>
											<td class="aleft"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
												<tr>
													<th>Victories </th>
													<td><?php echo $this->_tpl_vars['enemy']['offtotal']; ?>
</td>
												</tr>

												<tr>
													<th>Defeats </th>
													<td><?php echo $this->_tpl_vars['enemy']['deftotal']; ?>
</td>
												</tr>
											<td class="aleft"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=35 width=1 />
									</table>
								</td>
							<td valign=top>
								<table style="width:100%" cellspacing="0" cellpadding="0">
									<tr>
										<td class="aright">
											<table style="width:100%" cellspacing="0" cellpadding="0">
												<tr>
													<td style="padding-top:8px" class="acenter" colspan="2"><img src="data/images/symbols/profile/<?php echo $this->_tpl_vars['erace']['name']; ?>
.png" /></td>
												</tr>
												<tr>
													<td class="acenter" style="padding-top:4px" colspan="2"><?php echo $this->_tpl_vars['erace']['name']; ?>
</td>
												</tr>
										<tr>
											<td class="aleft"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=8 width=1 />
											</td>
										</tr>
												<tr>
													<td style="padding-top:8px" class="acenter" colspan="2"><div style="height:48px; font-size: 48px; font-family: Times New Roman"><?php echo $this->_tpl_vars['enemy']['networth']; ?>
</div><div>
			<span style="font-size: 10px;font-family: Verdana, Arial;"><?php if ($this->_tpl_vars['enemy']['land'] == 0): ?>Top <?php endif;  echo $this->_tpl_vars['lang']['greatness']; ?>
</span></div></td>
												</tr>
												<tr>
													<td class="aleft" style="padding-top:48px"><img src="<?php echo $this->_tpl_vars['dat']; ?>
images/spacer.gif" height=0 width=1 /></td>
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
								<?php if ($this->_tpl_vars['loggedin'] == true): ?>
								<?php if ($this->_tpl_vars['enemy']['land'] != 0): ?><span style="font-size: 10px"><?php if ($this->_tpl_vars['eturnsleft'] <= 0):  if ($this->_tpl_vars['turnsleft'] <= 0): ?><input type="button" class="mainoption" value="Attack" onclick="Turnbox.toggle();"> <?php endif;  endif;  endif; ?><a href="privmsg.php?mode=post&u=<?php echo $this->_tpl_vars['enemy']['usernum']; ?>
"><input type="button" class="mainoption" value="Send Message"></span>
								<?php endif; ?>
								</td>
							</tr>
							</table>
							</td>
						</tr>
					</table>
				</td>
		</tr>
		</table>
        <?php echo $this->_tpl_vars['End_Shadow']; ?>
