<?php /* Smarty version 2.6.0, created on 2009-05-29 15:46:33
         compiled from military.tpl */ ?>
<?php echo '<script language="JavaScript" type="text/javascript">';  if (isset($this->_sections['a'])) unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['atkdescr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>help<?php echo $this->_tpl_vars['atkdescr'][$this->_sections['a']['index']]['num']; ?>
 = "<?php echo $this->_tpl_vars['atkdescr'][$this->_sections['a']['index']]['name']; ?>
";<?php endfor; endif;  echo 'function validateTroops(attackType){var counter = 0;var attackArray = [];';  if (isset($this->_sections['f'])) unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['atknums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['f']['show'] = true;
$this->_sections['f']['max'] = $this->_sections['f']['loop'];
$this->_sections['f']['step'] = 1;
$this->_sections['f']['start'] = $this->_sections['f']['step'] > 0 ? 0 : $this->_sections['f']['loop']-1;
if ($this->_sections['f']['show']) {
    $this->_sections['f']['total'] = $this->_sections['f']['loop'];
    if ($this->_sections['f']['total'] == 0)
        $this->_sections['f']['show'] = false;
} else
    $this->_sections['f']['total'] = 0;
if ($this->_sections['f']['show']):

            for ($this->_sections['f']['index'] = $this->_sections['f']['start'], $this->_sections['f']['iteration'] = 1;
                 $this->_sections['f']['iteration'] <= $this->_sections['f']['total'];
                 $this->_sections['f']['index'] += $this->_sections['f']['step'], $this->_sections['f']['iteration']++):
$this->_sections['f']['rownum'] = $this->_sections['f']['iteration'];
$this->_sections['f']['index_prev'] = $this->_sections['f']['index'] - $this->_sections['f']['step'];
$this->_sections['f']['index_next'] = $this->_sections['f']['index'] + $this->_sections['f']['step'];
$this->_sections['f']['first']      = ($this->_sections['f']['iteration'] == 1);
$this->_sections['f']['last']       = ($this->_sections['f']['iteration'] == $this->_sections['f']['total']);
 if ($this->_sections['f']['index'] > 0): ?>if(attackType - 1 == <?php echo $this->_sections['f']['index']; ?>
)<?php echo '{';  if (isset($this->_sections['j'])) unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['atkdata'][$this->_sections['f']['index']]['ValidTypesArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>attackArray[<?php echo $this->_sections['j']['index']; ?>
] = '<?php echo $this->_tpl_vars['atkdata'][$this->_sections['f']['index']]['ValidTypesArr'][$this->_sections['j']['index']]; ?>
';<?php endfor; endif;  echo '}';  endif;  endfor; endif; ?>
<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['troops']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo 'for (i = 0; i <= attackArray.length - 1; i++){'; ?>
if ('<?php echo $this->_tpl_vars['troops'][$this->_sections['i']['index']]['type']; ?>
' != attackArray[i])<?php echo '{counter++;}}if (counter >= attackArray.length ){'; ?>
document.getElementById('unit<?php echo $this->_sections['i']['index']; ?>
td1').style.color = "gray";document.getElementById('unit<?php echo $this->_sections['i']['index']; ?>
td2').style.color = "gray";document.getElementById('unit<?php echo $this->_sections['i']['index']; ?>
input').style.display = "none";<?php echo '}else {'; ?>
document.getElementById('unit<?php echo $this->_sections['i']['index']; ?>
td1').style.color = "";document.getElementById('unit<?php echo $this->_sections['i']['index']; ?>
td2').style.color = "";document.getElementById('unit<?php echo $this->_sections['i']['index']; ?>
input').style.display = "";<?php echo '}counter = 0;';  endfor; endif;  echo '}function attackdescr(help) {document.getElementById("helpbox").value = eval("help" + help);}</script>'; ?>



<?php if ($this->_tpl_vars['err'] != ""): ?> <span class="error-font"><b><?php echo $this->_tpl_vars['err']; ?>
</b></span><br /><br /><br /><?php endif; ?>

<?php if ($this->_tpl_vars['showreport'] >= 1): ?>
      <div class="tabber" id="status">
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2>Results</h2>
            <h2>Results</h2>
      		<?php echo $this->_tpl_vars['attackreport']; ?>

      	</div>
        <div class="tabbertab" style="padding-bottom: 30px">
            <h2><?php echo $this->_tpl_vars['uera']['empireC']; ?>
 Status</h2>
          	<?php echo $this->_tpl_vars['turnoutput']; ?>

        </div>
      </div>
<?php endif; ?>


<form method="post" action="?military" name="atksel">
<table border=0 cellpadding=0 cellspacing=0><tr><td width=10%>&nbsp;<td>
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2><br />
<table class="inputtable" width=80%>
<tr><td class="acenter" colspan="3"><b>~ Select a target to attack ~</b><br /><br /></td></tr>
<tr>
	<td width=25%></td>
    <td colspan="1" align="center">
    <?php if ($this->_tpl_vars['notargets']): ?>
    Nothing to attack.
    <?php else: ?>
		<select name="target" id="target" class="dkbg">
        <?php if (isset($this->_sections['t'])) unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['drop']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?>
            <option value="<?php echo $this->_tpl_vars['drop'][$this->_sections['t']['index']]['num']; ?>
" class="m<?php echo $this->_tpl_vars['drop'][$this->_sections['t']['index']]['color']; ?>
"<?php echo $this->_tpl_vars['drop'][$this->_sections['t']['index']]['selected']; ?>
><?php echo $this->_tpl_vars['drop'][$this->_sections['t']['index']]['name'];  echo $this->_tpl_vars['drop'][$this->_sections['t']['index']]['online']; ?>

            </option>
        <?php endfor; endif; ?>
        </select>
    <?php endif; ?>
		<br />
    </td>
	<td width=25%></td>
</tr>
</table>
<br />

<?php if (! $this->_tpl_vars['noattacktypes']): ?>
<br />
<table class="inputtable" width=420>
<tr><td class="acenter" colspan=4><b>~ Create a strategy ~</b><br /><br /></td></tr>
	<tr><td colspan="3" class="acenter" valign=top><table cellspacing="0">
    <?php if (isset($this->_sections['a'])) unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['atktypes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
    <?php if ($this->_tpl_vars['atktypes'][$this->_sections['a']['index']]['name']): ?>
    <tr>
	<td>
    	<div class='radio' onClick="attackdescr('<?php echo $this->_tpl_vars['atktypes'][$this->_sections['a']['index']]['num']; ?>
'); validateTroops('<?php echo $this->_tpl_vars['atktypes'][$this->_sections['a']['index']]['num']; ?>
');">
        	<input class=radio type="radio" name='attacktype' value='<?php echo $this->_tpl_vars['atktypes'][$this->_sections['a']['index']]['num']; ?>
'>
            <table width=100% cellpadding=0 cellspacing=0>
            	<tr>
                	<td><?php echo $this->_tpl_vars['atktypes'][$this->_sections['a']['index']]['name']; ?>
</td></table></td></tr></div>
    <?php endif; ?>
    <?php endfor; endif; ?></table>
    <td align=right><textarea readonly="readonly" id="helpbox" rows="8" style="width: 270px;"  cols="7" tabindex="3" class="attackdescr" style="border: none; font-size: 10px"></textarea></td>
    </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
</tr>
</table>
<?php echo $this->_tpl_vars['End_Shadow']; ?>

<br />
<table cellspacing="0" cellpadding="0" width=520>
<tr>
<td align="center" class="shlarge" rowspan=2><br />
<?php endif; ?>
<table width=440 border=0>
<?php if (! $this->_tpl_vars['noattacktypes']): ?>
<tr><td class="acenter" colspan=3><b>~ Prepare an army ~</b><br /><br /></td></tr>
<?php endif; ?>
<tr><th class="aleft">Unit</th>
    <th class="aright">Owned</th>
    <th class="aright">Send</th></tr>
        
<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['troops']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <tr id="unit<?php echo $this->_sections['i']['index']; ?>
"><td id="unit<?php echo $this->_sections['i']['index']; ?>
td1" height=22><?php echo $this->_tpl_vars['troops'][$this->_sections['i']['index']]['name']; ?>
</td>
    <td class="aright" id="unit<?php echo $this->_sections['i']['index']; ?>
td2"><?php echo $this->_tpl_vars['troops'][$this->_sections['i']['index']]['owned']; ?>
</td>
    <td class="aright" id="unit<?php echo $this->_sections['i']['index']; ?>
input"><input type="text" name="<?php echo $this->_tpl_vars['troops'][$this->_sections['i']['index']]['sent']; ?>
" size="8" value="" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td></tr>
<?php endfor; endif; ?>

<tr><td colspan="3" style="text-align:right; padding-bottom:4px;padding-top:12px">

<table border=0 align=left width=100%>
	<tr><td width="13">
		<input  type="checkbox" class="cb" name="get_bld" value="1"<?php echo $this->_tpl_vars['checked']; ?>
></td><td width=58%> <?php echo $this->_tpl_vars['lang']['captbuilding']; ?>

        </td>
    	<td width="13" align=right>
    	<input type="checkbox" class="cb" name="sendall" value="1" <?php echo $this->_tpl_vars['chk_sendall']; ?>
></td><td style="padding: 0px"> <?php echo $this->_tpl_vars['lang']['sendall']; ?>
</td></tr></table></td></tr>
    <tr><td>
    	<table border=0 width=100%><tr><td width="13">
        	<input type="checkbox" class="cb" name="hide_turns" <?php echo $this->_tpl_vars['cnd']; ?>
></td>
            <td><?php echo $this->_tpl_vars['lang']['condturns']; ?>
</td></tr>
        </table>
        </td>
        <td colspan="3" style="text-align:right; padding-bottom:10px;">
        	<input type="submit" name="do_attack" class="mainoption" value="Begin Assualt"></td></tr>
    </table>
    <?php echo $this->_tpl_vars['End_Shadow']; ?>

     </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=<?php echo $this->_tpl_vars['action']; ?>
" title="<?php echo $this->_tpl_vars['lang']['helpbutton']; ?>
" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="<?php echo $this->_tpl_vars['lang']['helpbutton']; ?>
" /></a></td></tr></a></table></td>
  </tr>
</table>
</form>