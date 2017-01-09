<?php /* Smarty version 2.6.0, created on 2009-05-02 14:45:44
         compiled from scores.tpl */ ?>
<table class="invisible" cellspacing=0 cellpadding=0 width=520  style='padding: 0px; margin: 0px'><tr><td width=100%>
<?php echo $this->_tpl_vars['BeginTabmenu']; ?>

<?php if ($this->_tpl_vars['listtype'] == 'Empire Rankings'):  echo $this->_tpl_vars['oTabActive']; ?>
Rankings<?php echo $this->_tpl_vars['cTabActive'];  else:  echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?scores&amp;page=scores<?php echo $this->_tpl_vars['authstr']; ?>
">Rankings</a><?php echo $this->_tpl_vars['cTab'];  endif; ?>
<?php if ($this->_tpl_vars['listtype'] == 'Graveyard'):  echo $this->_tpl_vars['oTabActive']; ?>
Destroyed<?php echo $this->_tpl_vars['cTabActive'];  else:  echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?scores&amp;page=graveyard<?php echo $this->_tpl_vars['authstr']; ?>
">Destroyed</a><?php echo $this->_tpl_vars['cTab'];  endif; ?>
<?php if ($this->_tpl_vars['listtype'] == 'Hall of Shame'):  echo $this->_tpl_vars['oTabActive']; ?>
Abandoned<?php echo $this->_tpl_vars['cTabActive'];  else:  echo $this->_tpl_vars['oTab']; ?>
<a class="guitab" href="?scores&amp;page=abandon<?php echo $this->_tpl_vars['authstr']; ?>
">Abandoned</a><?php echo $this->_tpl_vars['cTab'];  endif; ?>
<?php echo $this->_tpl_vars['oHelp']; ?>
<a class="guitab" href="?scores&tab=help}"></a><?php echo $this->_tpl_vars['cHelp']; ?>

<?php echo $this->_tpl_vars['EndTabmenu']; ?>

</table>
<table cellspacing="0" cellpadding="0" width=520>
	<tr>
		<td align="center" class="shlarge" rowspan=2 style="padding-bottom:6px">
<div style="width:92%">
<?php if ($this->_tpl_vars['sc1e'] != 1): ?>
<?php endif; ?>
</div>
<?php if ($this->_tpl_vars['sc1e'] != 1): ?>
<table border=0 cellspacing="0">
<tr class="score">
    <?php if ($this->_tpl_vars['listtype'] != 'Hall of Shame' && $this->_tpl_vars['listtype'] != 'Graveyard'): ?>
    <th onclick="location.href='?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=8&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
'" style="width:5%" class="aright">
    <noscript><a href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=8&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
">
    </noscript>Rank<noscript></a></noscript></th><?php endif; ?>
    
        <th onclick="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=5&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
'" style="width:5%">
        <noscript><a href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=5&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
" title="Faction Type">
        </noscript>F<noscript></a></noscript></th>
        
    <th onclick="location.href='?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=1&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
'" style="width:36%">
    <noscript><a href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=1&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
">
    </noscript><?php echo $this->_tpl_vars['empireC']; ?>
<noscript></a></noscript></th>
    
    <th onclick="location.href='?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=2&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
'" style="width:10%" class="aright">
    <noscript><a href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=2&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
">
    </noscript><?php if ($this->_tpl_vars['listtype'] == 'Hall of Shame' || $this->_tpl_vars['listtype'] == 'Graveyard'): ?>Top&nbsp;Greatness<?php else: ?>Greatness<?php endif; ?><noscript></a></noscript></th>
    
    <?php if ($this->_tpl_vars['listtype'] != 'Hall of Shame' && $this->_tpl_vars['listtype'] != 'Graveyard'): ?>
    <th onclick="location.href='?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=6&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
'" style="width:25%">
    <noscript><a href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=6&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
">
    </noscript>Location<noscript></a></noscript></th>
    <?php endif; ?>
    

        <th href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=4&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
" style="width:10%">
        <noscript><a href="?scores&amp;page=<?php echo $this->_tpl_vars['link']; ?>
&amp;sortby=4&amp;view=<?php echo $this->_tpl_vars['view']-1; ?>
&amp;show=<?php echo $this->_tpl_vars['show']; ?>
&amp;restr=<?php echo $this->_tpl_vars['restr'];  echo $this->_tpl_vars['authstr']; ?>
">
        </noscript><?php if ($this->_tpl_vars['listtype'] == 'Hall of Shame'): ?>Abandoned<?php elseif ($this->_tpl_vars['listtype'] == 'Graveyard'): ?>Destroyed<?php else: ?>Clan<?php endif; ?><noscript></a></noscript></th></tr>

<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['scores1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr>
 <?php if ($this->_tpl_vars['listtype'] != 'Hall of Shame' && $this->_tpl_vars['listtype'] != 'Graveyard'): ?>
    <td align=center class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
" style="font-size: 18px; font-family: Papyrus;font-weight:bold">#<?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['online'];  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['rank']; ?>
</td><?php endif; ?>
        <td align=center class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
"><img src="data/images/symbols/small/<?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['rcs'];  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['racel'];  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['rce']; ?>
.png" title="<?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['rcs'];  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['race'];  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['rce']; ?>
" width=20 height=18 /></td>
    <td style="padding-left:8px" class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
"><a class="proflink" href="?profile&amp;target=<?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['num'];  echo $this->_tpl_vars['authstr']; ?>
"><b><?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['empire']; ?>
</b></a></td>
    
     <?php if ($this->_tpl_vars['listtype'] != 'Hall of Shame' && $this->_tpl_vars['listtype'] != 'Graveyard'): ?>
    <td style="padding-right:8px" align=right class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
" style="font-size: 10px"><b><?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['greatness']; ?>
<b/></td>
    <?php else: ?>
    <td style="padding-right:8px; padding-bottom:10px; ; padding-top:10px" align=right class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
" style="font-size: 10px"><b><?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['maxgreatness']; ?>
<b/></td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['listtype'] != 'Hall of Shame' && $this->_tpl_vars['listtype'] != 'Graveyard'): ?>
    <td align=center class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
" style="font-size: 9px"><?php echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['era']; ?>
</td>
    <?php endif; ?>

    <td align=center class="listrow<?php if (!($this->_sections['i']['index'] % 2)): ?>1<?php else: ?>2<?php endif;  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['bg']; ?>
edge"><?php if ($this->_tpl_vars['listtype'] != 'Hall of Shame' && $this->_tpl_vars['listtype'] != 'Graveyard'):  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['clan'];  else:  echo $this->_tpl_vars['scores1'][$this->_sections['i']['index']]['dates'];  endif; ?></td></td>
<?php endfor; endif; ?>
</table>
<?php else: ?>
<p class="error-font">Nothing to list.</p><br />
<?php endif; ?>
<div style="width:92%"><br />
<p align=right>
<br /><br /><b><?php echo $this->_tpl_vars['active']; ?>
</b> total <?php echo $this->_tpl_vars['empire']; ?>
s.&nbsp;
<b><?php echo $this->_tpl_vars['online']; ?>
</b> <?php echo $this->_tpl_vars['empire'];  if ($this->_tpl_vars['online'] > 1): ?>s<?php endif; ?> online.<br />
<b><?php echo $this->_tpl_vars['killed']; ?>
</b> destroyed <?php echo $this->_tpl_vars['empire']; ?>
s, and <b><?php echo $this->_tpl_vars['abandoned']; ?>
</b> abandoned <?php echo $this->_tpl_vars['empire']; ?>
s.</p>
</div>
<?php echo $this->_tpl_vars['End_Shadow']; ?>
