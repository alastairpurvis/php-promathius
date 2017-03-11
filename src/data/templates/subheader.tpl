<table width="984" align=center cellpadding="0" cellspacing="0" class="content">
<tr>
  <td valign=top>
  {* BEGIN HEADER STATISTICS *}
  <table width="100%" cellspacing="0" cellpadding="0"><tr>
    <td width=65% style="padding-bottom:6px; padding-right:9px">
		<span style="font-size:20px; font-family: Book Antiqua; COLOR: #c6c4c5; padding-left:10px">{$empire|upper}</span>
	</td>
         <td width=35% id="topstatstableright" style="padding-bottom:6px; padding-right:6px;" rowspan=1>
		 {$season}, <span style="font-size:small;  COLOR: #a7a7a7"><b>{$year}</b></span>&nbsp;
				<span style="font-size:small; COLOR: #a7a7a7">{$year_acronym}</b>
				
				<br />
				
				<span style="font-size: 10px; COLOR: #576b84">
				{if $years_left_num >= 1}
					{if $years_left > 1}	{$years_left} years remaining
					{else}	1 year remaining	{/if}
				{else}
					{if $days_left > 1}		{$days_left} days remaining
					{elseif $days_left > 0}	1 quarter remaining
				{else} 
					<span class="cbad">(You have reached the afterlife)</span> {/if}
				{/if}
				</span>
		</td>
        <td id="topstatstable" style="padding-right: 13px; padding-bottom:6px; vertical-align:center" rowspan=1>
        	<img src="data/images/symbols/plain/{$uracestr.name}.png" alt="{$uracestr.name}" title="{$uracestr.name}" />
        </td></tr>
    </table>
	{* END HEADER STATISTICS *}
	
	{* BEGIN Empire status header *}
	<table cellspacing="0" cellpadding="0" width="100%">
    <tr><td colspan=3>
	
	{*FLOATING Advanced Stat Bar Button GRAPHIC *}
	<div id="advstatbutton" onclick="Statistics.toggle();">
	</div>

	{*Advanced Stat Bar*} 
	<div id="advstat" style="display:none;height: 295px ">
		{include file="advancedstats.tpl"}
	</div>
	<script type="text/javascript">var Statistics=new animatedcollapse("advstat", 0, true, false);</script>
	
    <div class="statheader">
		{* Hourglass Icon *}
		<div class="hourglass">
		<img id="hourglass" src="data/images/gui/stats/hourglassh.png" />
			<div id="turncnt">{$turns_new}</div>
		</div>
		

		
		{* Greatness Tab*}
		<div class="statheader-middle">
			<div style="height:43px">{$networth_new}</div><div>
				<span style="font-size: 8px;font-family: Verdana, Arial;">{$lang.greatness|upper}</span>
			</div>
		</div>
		
		{* Gold *}
		<div class="cash">
			{if $cash_new|gamefactor == 0}Broke{else}{$cash_new|gamefactor}{/if}
		</div>
		
		{* Territory *}
		<div class="land">
			{$land_new} | {$land_free}
		</div>
		
		{* Scrolls *}
		<div class="runes">
			{$runes_new|gamefactor}
		</div>
		
		{*Public Order*}
		<div id=ordernew" class="order">
		<table cellpadding=0 callspacing=0>
			<td style="vertical-align:bottom; padding-bottom:9px">{$bla}{$health_new} % </td>
			<td>
				{if $health_new >= 50 && $oldhealth < 50 || $oldhealth >= 50 && $health_new < 50}<script type="text/javascript">opacity('orderbefore', 100, 0, 2800); opacity('orderafter', 0, 100, 2800);</script>{/if}
				{*After*} <img id=orderafter {if $health_new >= 50 && $oldhealth < 50}class="transparent"{else}class=""{/if} src="data/images/gui/stats/order-{if $health_new >= 50}happy{else}sad{/if}.png" />
				{*Before*} <div style="position:relative;margin-top:-53px;">
							<img id=orderbefore {if $health_new >= 50 && $oldhealth < 50}class=""{else}class="transparent"{/if} src="data/images/gui/stats/order-{if $oldhealth >= 50}happy{else}sad{/if}.png" />
				</div>
			</td>
		</table>
		</div>
    </div>
	</td></tr>
    {* END Empire status header *}
	
	{* BEGIN LEFT MENU *}
	<tr><td rowspan=2 style="vertical-align:top">
      <div id="leftmenu" class="leftmenu">
		<div>
          <span>NEWS</span>
		        {$MenuExplore}Explore{$MenuExploreEnd}
                {$MenuConstruct}Construct{$MenuConstructEnd}
                {$MenuMilitary}Recruit{$MenuMilitaryEnd}
		  <p id="gap"></p><p id="gap"></p><p id="gap"></p><p id="gap"></p><p id="gap"></p>
                {$MenuTrade}Trade{$MenuTradeEnd}
            	{$MenuIncome}Manage Income{$MenuIncomeEnd}
		  <p id="gap"></p>
          </div>
      </div>
	  </td>
      {* END LEFT MENU *}
	  
	  <td></td>
	  
      {* BEGIN RIGHT MENU *}
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
      {* END RIGHT MENU *}
	  <tr>
	  <td align=center width=100% style="vertical-align:top; padding-top:10px">