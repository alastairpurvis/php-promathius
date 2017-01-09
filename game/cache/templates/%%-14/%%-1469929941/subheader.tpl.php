<?php /* Smarty version 2.6.0, created on 2009-09-25 01:12:10
         compiled from subheader.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'subheader.tpl', 7, false),array('modifier', 'gamefactor', 'subheader.tpl', 65, false),)), $this); ?>
<table width="984" align=center cellpadding="0" cellspacing="0" class="content">
<tr>
  <td valign=top>
    <table width="100%" cellspacing="0" cellpadding="0"><tr>
    <td width=65% style="padding-bottom:6px; padding-right:9px">
		<span style="font-size:20px; font-family: Book Antiqua; COLOR: #c6c4c5; padding-left:10px"><?php echo ((is_array($_tmp=$this->_tpl_vars['empire'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
	</td>
         <td width=35% id="topstatstableright" style="padding-bottom:6px; padding-right:6px;" rowspan=1>
		 <?php echo $this->_tpl_vars['season']; ?>
, <span style="font-size:small;  COLOR: #a7a7a7"><b><?php echo $this->_tpl_vars['year']; ?>
</b></span>&nbsp;
				<span style="font-size:small; COLOR: #a7a7a7"><?php echo $this->_tpl_vars['year_acronym']; ?>
</b>
				
				<br />
				
				<span style="font-size: 10px; COLOR: #576b84">
				<?php if ($this->_tpl_vars['years_left_num'] >= 1): ?>
					<?php if ($this->_tpl_vars['years_left'] > 1): ?>	<?php echo $this->_tpl_vars['years_left']; ?>
 years remaining
					<?php else: ?>	1 year remaining	<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['days_left'] > 1): ?>		<?php echo $this->_tpl_vars['days_left']; ?>
 days remaining
					<?php elseif ($this->_tpl_vars['days_left'] > 0): ?>	1 quarter remaining
				<?php else: ?> 
					<span class="cbad">(You have reached the afterlife)</span> <?php endif; ?>
				<?php endif; ?>
				</span>
		</td>
        <td id="topstatstable" style="padding-right: 13px; padding-bottom:6px; vertical-align:center" rowspan=1>
        	<img src="data/images/symbols/plain/<?php echo $this->_tpl_vars['uracestr']['name']; ?>
.png" alt="<?php echo $this->_tpl_vars['uracestr']['name']; ?>
" title="<?php echo $this->_tpl_vars['uracestr']['name']; ?>
" />
        </td></tr>
    </table>
		
		<table cellspacing="0" cellpadding="0" width="100%">
    <tr><td colspan=3>
	
		<div id="advstatbutton" onclick="Statistics.toggle();">
	</div>

	 
	<div id="advstat" style="display:none;height: 295px ">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "advancedstats.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<script type="text/javascript">var Statistics=new animatedcollapse("advstat", 0, true, false);</script>
	
    <div class="statheader">
				<div class="hourglass">
		<img id="hourglass" src="data/images/gui/stats/hourglassh.png" />
			<div id="turncnt"><?php echo $this->_tpl_vars['turns_new']; ?>
</div>
		</div>
		

		
				<div class="statheader-middle">
			<div style="height:43px"><?php echo $this->_tpl_vars['networth_new']; ?>
</div><div>
				<span style="font-size: 8px;font-family: Verdana, Arial;"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['greatness'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</span>
			</div>
		</div>
		
				<div class="cash">
			<?php if (((is_array($_tmp=$this->_tpl_vars['cash_new'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)) == 0): ?>Broke<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['cash_new'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp));  endif; ?>
		</div>
		
				<div class="land">
			<?php echo $this->_tpl_vars['land_new']; ?>
 | <?php echo $this->_tpl_vars['land_free']; ?>

		</div>
		
				<div class="runes">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['runes_new'])) ? $this->_run_mod_handler('gamefactor', true, $_tmp) : smarty_modifier_gamefactor($_tmp)); ?>

		</div>
		
				<div id=ordernew" class="order">
		<table cellpadding=0 callspacing=0>
			<td style="vertical-align:bottom; padding-bottom:9px"><?php echo $this->_tpl_vars['bla'];  echo $this->_tpl_vars['health_new']; ?>
 % </td>
			<td>
				<?php if ($this->_tpl_vars['health_new'] >= 50 && $this->_tpl_vars['oldhealth'] < 50 || $this->_tpl_vars['oldhealth'] >= 50 && $this->_tpl_vars['health_new'] < 50): ?><script type="text/javascript">opacity('orderbefore', 100, 0, 2800); opacity('orderafter', 0, 100, 2800);</script><?php endif; ?>
				 <img id=orderafter <?php if ($this->_tpl_vars['health_new'] >= 50 && $this->_tpl_vars['oldhealth'] < 50): ?>class="transparent"<?php else: ?>class=""<?php endif; ?> src="data/images/gui/stats/order-<?php if ($this->_tpl_vars['health_new'] >= 50): ?>happy<?php else: ?>sad<?php endif; ?>.png" />
				 <div style="position:relative;margin-top:-53px;">
							<img id=orderbefore <?php if ($this->_tpl_vars['health_new'] >= 50 && $this->_tpl_vars['oldhealth'] < 50): ?>class=""<?php else: ?>class="transparent"<?php endif; ?> src="data/images/gui/stats/order-<?php if ($this->_tpl_vars['oldhealth'] >= 50): ?>happy<?php else: ?>sad<?php endif; ?>.png" />
				</div>
			</td>
		</table>
		</div>
    </div>
	</td></tr>
    	
		<tr><td rowspan=2 style="vertical-align:top">
      <div id="leftmenu" class="leftmenu">
		<div>
          <span>NEWS</span>
		        <?php echo $this->_tpl_vars['MenuExplore']; ?>
Explore<?php echo $this->_tpl_vars['MenuExploreEnd']; ?>

                <?php echo $this->_tpl_vars['MenuConstruct']; ?>
Construct<?php echo $this->_tpl_vars['MenuConstructEnd']; ?>

                <?php echo $this->_tpl_vars['MenuMilitary']; ?>
Recruit<?php echo $this->_tpl_vars['MenuMilitaryEnd']; ?>

		  <p id="gap"></p><p id="gap"></p><p id="gap"></p><p id="gap"></p><p id="gap"></p>
                <?php echo $this->_tpl_vars['MenuTrade']; ?>
Trade<?php echo $this->_tpl_vars['MenuTradeEnd']; ?>

            	<?php echo $this->_tpl_vars['MenuIncome']; ?>
Manage Income<?php echo $this->_tpl_vars['MenuIncomeEnd']; ?>

		  <p id="gap"></p>
          </div>
      </div>
	  </td>
      	  
	  <td></td>
	  
      	<td rowspan=2 style="vertical-align:top">
      <div id="rightmenu" class="sdmenu2">
      	<div> 
          <span></span>
           		<a href="?main">You were attacked!</a>
           		<a href="?main">Population increases</a>
           		<a href="?main">An impressed populace</a>
           		<a href="?main">You offer was accepted</a>
            	<a href="?main">Destroyed</a>
            	<a href="?main">Olympic games</a>
            	<a href="?main">&nbsp;</a>
            	<a href="?main">&nbsp;</a>
            	<a href="?main"> View Unread | View All</a>
          </div>
        </div>
	  </td></tr>
      	  <tr>
	  <td align=center width=100% style="vertical-align:top; padding-top:10px">