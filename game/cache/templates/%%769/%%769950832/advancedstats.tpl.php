<?php /* Smarty version 2.6.0, created on 2009-08-31 15:21:47
         compiled from advancedstats.tpl */ ?>
 <table cellspacing="0" cellpadding=8 class="statusbg" id="statuscontent">
                	<tr>
                    	<td align=center>
						<script type="text/javascript">var TimeMinutes = <?php echo $this->_tpl_vars['nextturnmin']; ?>
;var TimeSeconds = <?php echo $this->_tpl_vars['nextturnseconds']; ?>
;var TurnsAcquired = 0;var rawseconds = <?php echo $this->_tpl_vars['rawseconds']; ?>
;var perminutefl = <?php echo $this->_tpl_vars['perminutefl']; ?>
;var perminutes = <?php echo $this->_tpl_vars['perminutes']; ?>
; var CurrentTurns = <?php echo $this->_tpl_vars['turns_new']; ?>
;var maxturns = <?php echo $this->_tpl_vars['maxturns']; ?>
; var turnsform = "<?php echo $this->_tpl_vars['turnsperplural']; ?>
"; var turnsplural = "<?php echo $this->_tpl_vars['turnsplural']; ?>
";var turnsperx = <?php echo $this->_tpl_vars['turnsper']; ?>
;</script>
                <div class="tabber" id="status">
                 <div class="tabbertab">
                  <h2>General</h2>
                                 <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Rank</th>
                                        <td>#<?php echo $this->_tpl_vars['users']['rank']; ?>
</td></tr>
                                                                                                  <tr><th>Population</th>
                                        <td><?php echo $this->_tpl_vars['users']['peasants'];  echo $this->_tpl_vars['employment']['perfect']; ?>
</td></tr>
                                    <?php if ($this->_tpl_vars['employment']['workersneeded']): ?>
	                                  		<tr><th>Workers Needed</th>
		                                        <td><?php echo $this->_tpl_vars['employment']['workersneededpercent']; ?>
% more</td></tr>
		                                <?php elseif ($this->_tpl_vars['employment']['unemployed']): ?>
                                    		<tr><th>Unemployment</th>
		                                        <td><?php echo $this->_tpl_vars['employment']['unemployedpercent']; ?>
%</td></tr>
		                                <?php else: ?>
                                    		<tr><th>Employment</th>
		                                        <td><b>Perfect</b></td></tr>
                                    <?php endif; ?>
                                    <tr><th>Command</th>
                                        <td><?php echo $this->_tpl_vars['experience']; ?>
</td></tr>
                                    <tr><th>Espionage</th>
                                        <td><?php echo $this->_tpl_vars['espionage']; ?>
</td></tr>
                                                                <tr><td colspan="2">&nbsp;</td></tr>
                                    <tr><th>Conquered Empires</th>
                                        <td><?php echo $this->_tpl_vars['users']['kills']; ?>
</td></tr>
                                    <tr><th>Turns Used:</th>
                                        <td><?php echo $this->_tpl_vars['users']['turnsused']; ?>
</td></tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr><td colspan=2 align=center><span id="ttimer"><?php if ($this->_tpl_vars['turns_new'] < $this->_tpl_vars['maxturns']): ?>Next <?php echo $this->_tpl_vars['turnsperplural']; ?>
 in <?php if ($this->_tpl_vars['nextturnmin'] >= 1):  echo $this->_tpl_vars['nextturnmin']; ?>
 <?php echo $this->_tpl_vars['perminutesplural']; ?>
 and <?php endif;  echo $this->_tpl_vars['nextturnseconds']; ?>
 seconds<?php else: ?>Maximum turns accumulated<?php endif; ?></span></td></tr>
                                                </table>
                 </div>        
                 <div class="tabbertab">
                  <h2>Finances</h2>
                            <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Income</th>
                                        <td><?php echo $this->_tpl_vars['income']; ?>
</td></tr>
                                    <tr><th style="padding-left: 25px">Trade</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['tradeincome']; ?>
</td></tr>
									                                <?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['structureincome']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                                      <tr><th style="padding-left: 25px"><?php echo $this->_tpl_vars['structureincome'][$this->_sections['i']['index']]['name']; ?>
</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['structureincome'][$this->_sections['i']['index']]['value']; ?>
</td></tr>
								<?php endfor; endif; ?>
                                    <tr><th style="padding-left: 25px">Tax Income</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['taxincome']; ?>
</td></tr>
                                    <tr><th>Expenses</th>
                                        <td><?php echo $this->_tpl_vars['expenses']; ?>
</td></tr>
                                    <tr><th style="padding-left: 25px">Army Upkeep</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['troopcosts']; ?>
</td></tr>
                                    <tr><th style="padding-left: 25px">Agent Salaries</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['wizardcosts']; ?>
</td></tr>
                                    <tr><th style="padding-left: 25px">Management</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['landupkeep']; ?>
</td></tr>
                                    <tr><th style="padding-left: 25px">Corruption</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['corruption']; ?>
</td></tr>
									<?php if ($this->_tpl_vars['loanpayment']): ?>
                                    <tr><th style="padding-left: 25px">Loan Payment</th>
                                        <td style="padding-left: 10px"><?php echo $this->_tpl_vars['loanpayment']; ?>
</td></tr>
									<?php endif; ?>
                                    <tr><th>NET</th>
                                        <td><?php echo $this->_tpl_vars['netincome']; ?>
</td></tr>
                                    </table>
                 </div>
                  <div class="tabbertab">
                  <h2>Order</h2>
                            <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Positive Impacts</th>
                                        <td></td></tr>
                                <?php if (isset($this->_sections['id'])) unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['publicorderpositives']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
                                      <tr><th style="padding-left: 25px"><?php echo $this->_tpl_vars['publicorderpositives'][$this->_sections['id']['index']]['name']; ?>
</th>
                                        <td style="padding-left: 10px">+<?php echo $this->_tpl_vars['publicorderpositives'][$this->_sections['id']['index']]['value']; ?>
%</td></tr>
                                <?php endfor; endif; ?>
                                    <tr><th>Negative Impacts</th>
                                        <td></td></tr>
									<?php if (isset($this->_sections['id'])) unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['publicordernegatives']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
										  <tr><th style="padding-left: 25px"><?php echo $this->_tpl_vars['publicordernegatives'][$this->_sections['id']['index']]['name']; ?>
</th>
											<td style="padding-left: 10px">-<?php echo $this->_tpl_vars['publicordernegatives'][$this->_sections['id']['index']]['value']; ?>
%</td></tr>
									<?php endfor; endif; ?>
                                    </table>
                 </div>   
            
                 <div class="tabbertab">
                  <h2>Military</h2>
                            <table cellpadding=0 class="tabberstatus">
                                <?php if (isset($this->_sections['have'])) unset($this->_sections['have']);
$this->_sections['have']['name'] = 'have';
$this->_sections['have']['loop'] = is_array($_loop=$this->_tpl_vars['troopshave']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['have']['show'] = true;
$this->_sections['have']['max'] = $this->_sections['have']['loop'];
$this->_sections['have']['step'] = 1;
$this->_sections['have']['start'] = $this->_sections['have']['step'] > 0 ? 0 : $this->_sections['have']['loop']-1;
if ($this->_sections['have']['show']) {
    $this->_sections['have']['total'] = $this->_sections['have']['loop'];
    if ($this->_sections['have']['total'] == 0)
        $this->_sections['have']['show'] = false;
} else
    $this->_sections['have']['total'] = 0;
if ($this->_sections['have']['show']):

            for ($this->_sections['have']['index'] = $this->_sections['have']['start'], $this->_sections['have']['iteration'] = 1;
                 $this->_sections['have']['iteration'] <= $this->_sections['have']['total'];
                 $this->_sections['have']['index'] += $this->_sections['have']['step'], $this->_sections['have']['iteration']++):
$this->_sections['have']['rownum'] = $this->_sections['have']['iteration'];
$this->_sections['have']['index_prev'] = $this->_sections['have']['index'] - $this->_sections['have']['step'];
$this->_sections['have']['index_next'] = $this->_sections['have']['index'] + $this->_sections['have']['step'];
$this->_sections['have']['first']      = ($this->_sections['have']['iteration'] == 1);
$this->_sections['have']['last']       = ($this->_sections['have']['iteration'] == $this->_sections['have']['total']);
?>
                                  <?php if ($this->_tpl_vars['troopshave'][$this->_sections['have']['index']]['have'] > 0): ?>                                       <tr><th><?php echo $this->_tpl_vars['troopshave'][$this->_sections['have']['index']]['name']; ?>
</th>
                                        <td><?php echo $this->_tpl_vars['troopshave'][$this->_sections['have']['index']]['have']; ?>
</td></tr>
                                  <?php endif; ?>
                                <?php endfor; endif; ?>
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                    <tr><th><?php echo $this->_tpl_vars['uera']['wizards']; ?>
</th>
                                        <td><?php echo $this->_tpl_vars['users']['wizards']; ?>
</td>
                                                                                    </table>
                 </div>
            
                 <div class="tabbertab">
                  <h2>Land</h2>
                              <table cellpadding=0 class="tabberstatus">
                                <?php if (isset($this->_sections['have'])) unset($this->_sections['have']);
$this->_sections['have']['name'] = 'have';
$this->_sections['have']['loop'] = is_array($_loop=$this->_tpl_vars['structures']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['have']['show'] = true;
$this->_sections['have']['max'] = $this->_sections['have']['loop'];
$this->_sections['have']['step'] = 1;
$this->_sections['have']['start'] = $this->_sections['have']['step'] > 0 ? 0 : $this->_sections['have']['loop']-1;
if ($this->_sections['have']['show']) {
    $this->_sections['have']['total'] = $this->_sections['have']['loop'];
    if ($this->_sections['have']['total'] == 0)
        $this->_sections['have']['show'] = false;
} else
    $this->_sections['have']['total'] = 0;
if ($this->_sections['have']['show']):

            for ($this->_sections['have']['index'] = $this->_sections['have']['start'], $this->_sections['have']['iteration'] = 1;
                 $this->_sections['have']['iteration'] <= $this->_sections['have']['total'];
                 $this->_sections['have']['index'] += $this->_sections['have']['step'], $this->_sections['have']['iteration']++):
$this->_sections['have']['rownum'] = $this->_sections['have']['iteration'];
$this->_sections['have']['index_prev'] = $this->_sections['have']['index'] - $this->_sections['have']['step'];
$this->_sections['have']['index_next'] = $this->_sections['have']['index'] + $this->_sections['have']['step'];
$this->_sections['have']['first']      = ($this->_sections['have']['iteration'] == 1);
$this->_sections['have']['last']       = ($this->_sections['have']['iteration'] == $this->_sections['have']['total']);
?>
                                      <tr><th><?php echo $this->_tpl_vars['structures'][$this->_sections['have']['index']]['name']; ?>
</th>
                                        <td><?php echo $this->_tpl_vars['structuresworking'][$this->_sections['have']['index']]['have']; ?>
 / <?php echo $this->_tpl_vars['structures'][$this->_sections['have']['index']]['have']; ?>
</td></tr>
                                <?php endfor; endif; ?>
                                                </table>     
					</div>
             
                  <div class="tabbertab">
                  <h2>Production</h2>
                               <table cellpadding=0 class="tabberstatus">
                                    <tr><th><?php echo $this->_tpl_vars['uera']['food']; ?>
 Production</th>
                                        <td><?php echo $this->_tpl_vars['foodpro']; ?>
</td></tr>
                                    <tr><th><?php echo $this->_tpl_vars['uera']['food']; ?>
 Consumption</th>
                                        <td><?php echo $this->_tpl_vars['foodcon']; ?>
</td></tr>                                    
                                    <tr><th>Net</th>
                                        <td><?php echo $this->_tpl_vars['foodnet']; ?>
</td></tr>
                                    <tr><th><?php echo $this->_tpl_vars['uera']['food']; ?>
 Stored</th>
                                        <td><?php echo $this->_tpl_vars['food']; ?>
</td></tr>    
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                     <tr><th><?php echo $this->_tpl_vars['uera']['runes']; ?>
 Production</th>
                                        <td><?php echo $this->_tpl_vars['runeproduce']; ?>
</td></tr>
                                     <tr><th><?php echo $this->_tpl_vars['uera']['wizards']; ?>
 Recruited Per Turn</th>
                                        <td><?php echo $this->_tpl_vars['wizardrate']; ?>
</td></tr>
                                </table>
                 </div>
            
            </div>
</table>