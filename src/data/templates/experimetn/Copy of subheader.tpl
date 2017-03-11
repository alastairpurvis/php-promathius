<table width="875" align=center cellpadding="0" cellspacing="0" class="content">
<tr>
  <td valign=top>
  {* BEGIN HEADER STATISTICS *}
  <table width="100%" cellspacing="0" cellpadding="0" border=0>
      <tr>
        <td width=65% style="padding-bottom:5px; padding-right:8px">
          	<span style="font-size:18px; font-family: Book Antiqua; COLOR: #c6c4c5; padding-left:9px">{$empire|upper}</span>
            {if $users.nojs_nag != 1}
            <noscript><br /><span style="padding-left:9px"><b>* You do not have Javascript enabled. <a href="?javascript">Disable this message</a></b></span><br /><span style="padding-left:9px"><b>&nbsp;&nbsp;&nbsp;Please re-enable or upgrade your browser for best viewng experience.</b></span></noscript>{/if}</td>
                    <td width=35% id="topstatstableright" style="padding-bottom:5px; padding-right:5px;" rowspan=1>{$season}, 
        	<span style="font-size:small; COLOR: #a7a7a7"><b>{$year}</b></span>&nbsp;
            <span style="font-size:tiny; COLOR: #a7a7a7">{$year_acronym}</b>
          <br />
          <span style="font-size: 9px; COLOR: #a7a7a7">
          {if $years_left_num >= 1}
                {if $years_left > 1}	({$years_left} years remaining)
                {else}	(1 year remaining)	{/if}
          {else}
                {if $days_left > 1}		({$days_left} days remaining)
                {elseif $days_left > 0}	(1 day remaining)
          {else} 
                <span class="cbad">(You have reached the afterlife)</span> {/if}
          {/if}
          </span> </td>
        <td id="topstatstable" style="padding-right: 12px; padding-bottom:5px; vertical-align:center" rowspan=1>
        	<img src="data/images/symbols/plain/{$uracestr.name}.png" alt="{$uracestr.name}" title="{$uracestr.name}" />
        </td></tr>
    </table>
	{* END HEADER STATISTICS *}
	
	{* BEGIN Empire status header*}
    <table cellspacing="0" cellpadding="0" width="100%" class="statheader">
      <tr>
        <td align="left" class="statheader-left" valign="bottom" width="39"><img id="hourglass" src="data/images/gui/menu/stat-hglassh.gif" /></td>
        <td align="left" width=265 style="padding-left:3px; font-size: 11px;padding-top: 24px;">
		<span id="turncnt">{$turns_new}
		{if $turnsleft > 0} &nbsp;&nbsp;&nbsp;&nbsp;(Protection: {$turnsleft}) {/if}</span>
        </td>
		<td style="padding-left:15px"></td>
        <td align="center" class="statheader-middle">
		<div style="height:38px">{$networth_new}</div><div>
			<span style="font-size: 8px;font-family: Verdana, Arial;">{$lang.greatness|upper}</span></div></td>
        <td align="right" width=100 style="padding-right:6px; font-size: 11px;padding-top:22px;">{$health_new}<span style="font-size: 9px"> %</span></td>
        <td class="statheader-right" width="54"></td>
      </tr>
    </table>
    {* END Empire status header *}


    <table align=left cellspacing="0" cellpadding="0" style="margin: 0px" width=100%>
    <tr>
      <td width="149" style="vertical-align: top; margin: 0px; padding-left: 0px" rowspan=3>

	{* BEGIN LEFT MENU *}
      <div id="leftmenu" class="leftmenu">
	  <div>
          <span>ACTIONS</span>
                {$MenuExplore}Explore{$MenuExploreEnd}
                {$MenuConstruct}Contruct{$MenuConstructEnd}
                {$MenuMilitary}Military{$MenuMilitaryEnd}
		  <p id="gap"></p>
            	{$MenuIncome}Income{$MenuIncomeEnd}
                {$MenuTrade}Trade{$MenuTradeEnd}
		  <p id="gap"></p>
                {$MenuEspionage}Espionage{$MenuEspionageEnd}
                  {if $adminpanel != 'true'}{if $turnsleft < 1}{$MenuWar}Attack{$MenuWarEnd} {/if}{/if}
		  <p id="gap"></p>

          </div>
      </div>
      {* END LEFT MENU *}


      <td height=0></td>
      <td rowspan="3" style="height:100%; vertical-align: top">
      <div id="rightmenu" class="sdmenu2">
      
      {* BEGIN RIGHT MENU *}
      	<div> 
          <span>News</span>
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
      {* END RIGHT MENU *}

        </td>
    </tr>
    <tr>
      <td style="padding-top:0px; vertical-align:top" height=320 align=center>
	  <table cellspacing="0" cellpadding=0>
        <tr>
          <td class="stat-bottom" height=6></td>
        </tr>
        <tr>
          <td align="center" class="maincontent">{*if !$guide*}
            {$Begin_Shadow_Vine}
            <script type="text/javascript">document.write('<table cellspacing="0" cellpadding=0 onclick="javascript:Statistics.toggle()" class="fade" style="cursor:pointer; width:100%">')</script>
            <noscript><table cellspacing="0" cellpadding=0></noscript>
              <tr align="center">
                <td class="statgrad">
                <table cellspacing="0" cellpadding=0 style="vertical-align:middle; height:100%; width:100%">
                	<tbody>
                        <td class="stats"><img src="data/images/gui/stats/land.png" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {$land_new}</td>
                          <td class="stats">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td class="stats"><img src="data/images/gui/stats/scroll.png" />{* {$runesname} *}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {$runes_new|gamefactor} </td>
                      </tbody>
                  </table></td>
            </table>
            <div id="statusbar" style="padding:0px; height: 210px; display: none">
            	<table cellspacing="0" cellpadding=8 class="statusbg">
                	<tr>
                    	<td align=center>
						<script type="text/javascript">var TimeMinutes = {$nextturnmin};var TimeSeconds = {$nextturnseconds};var TurnsAcquired = 0;var rawseconds = {$rawseconds};var perminutefl = {$perminutefl};var perminutes = {$perminutes}; var CurrentTurns = {$turns_new};var maxturns = {$maxturns}; var turnsform = "{$turnsperplural}"; var turnsplural = "{$turnsplural}";var turnsperx = {$turnsper};</script>
                <div class="tabber" id="status">
                 <div class="tabbertab">
                  <h2>General</h2>
                                 <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Rank</th>
                                        <td>#{$users.rank}</td></tr>
                                    <tr><th>Clan</th>
                                        <td>{$tags[0]}</td></tr>
                               {*          <tr><th>{$foodname}: *}
                               {*     	<td>{$food_new|gamefactor}</td> *}
                                    <tr><th>Population</th>
                                        <td>{$users.peasants}</td></tr>
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
                                    <tr><th style="padding-left: 25px">Tax Income</th>
                                        <td style="padding-left: 10px">{$taxincome}</td></tr>
                                    <tr><th>Expenses</th>
                                        <td>{$expenses}</td></tr>
                                    <tr><th style="padding-left: 25px">Army Upkeep</th>
                                        <td style="padding-left: 10px">{$troopcosts}</td></tr>
                                    <tr><th style="padding-left: 25px">Corruption</th>
                                        <td style="padding-left: 10px">{$corruption}</td></tr>
                                    <tr><th style="padding-left: 25px">Loan Payment</th>
                                        <td style="padding-left: 10px">{$loanpayment}</td></tr>
                                    <tr><th>NET</th>
                                        <td>{$netincome}</td></tr>
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                    <tr><th>Savings Balance</th>
                                        <td>{$users.savings}</td></tr>
                                    <tr><th>Loan Balance</th>
                                        <td>{$users.loan}</td></tr>
                                    </table>
                 </div>
                  <div class="tabbertab">
                  <h2>Public Order</h2>
                            <table cellpadding=0 class="tabberstatus">
                                    <tr><th>Positive Impacts</th>
                                        <td>60%</td></tr>
                                    <tr><th style="padding-left: 25px">Military Control</th>
                                        <td style="padding-left: 10px">30%</td></tr>
                                    <tr><th style="padding-left: 25px">Defenses</th>
                                        <td style="padding-left: 10px">4%</td></tr>
                                    <tr><th style="padding-left: 25px">Patriotism</th>
                                        <td style="padding-left: 10px">2%</td></tr>
                                    <tr><th>Negative Impacts</th>
                                        <td>40%</td></tr>
                                    <tr><th style="padding-left: 25px">Taxes</th>
                                        <td style="padding-left: 10px">19%</td></tr>
                                    <tr><th style="padding-left: 25px">Political Unrest</th>
                                        <td style="padding-left: 10px">5%</td></tr>
                                    <tr><th style="padding-left: 25px">Poverty</th>
                                        <td style="padding-left: 10px">10%</td></tr>
                                    <tr><th style="padding-left: 25px">Food Shortages</th>
                                        <td style="padding-left: 10px">2%</td></tr>
                                    <tr><th style="padding-left: 25px">Shame</th>
                                        <td style="padding-left: 10px">4%</td></tr>
                                    </table>
                 </div>   
            
                 <div class="tabbertab">
                  <h2>Military</h2>
                            <table cellpadding=0 class="tabberstatus">
                                {section name=have loop=$troopshave}
                                    <tr><th>{$troopshave[have].name}</th>
                                        <td>{$troopshave[have].have|gamefactor}</td></tr>
                                {/section}
                                    <tr><th>{$uera.wizards}</th>
                                        <td>{$users.wizards}</td>
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                    {*<tr><th>Offensive Points</th>
                                        <td>{$offpts}</td></tr>
                                    <tr><th>Defensive Points</th>
                                        <td>{$defpts}</td></tr>*}
                                    <tr><th>Offensive Actions</th>
                                        <td>{$users.offtotal} ({$off_percent}%)</td></tr>
                                    <tr><th>Defences</th>
                                        <td>{$users.deftotal} ({$def_percent}%)</td></tr>
                                                </table>
                 </div>
            
                 <div class="tabbertab">
                  <h2>Land</h2>
                              <table cellpadding=0 class="tabberstatus">
                                    <tr><th>{$uera.homes}</th>
                                        <td>{$users.homes}</td></tr>
                                    <tr><th>{$uera.shops}</th>
                                        <td>{$users.shops}</td></tr>
                                    <tr><th>{$uera.industry}</th>
                                        <td>{$users.industry}</td></tr>
                                    <tr><th>{$uera.barracks}</th>
                                        <td>{$users.barracks}</td></tr>
                                    <tr><th>{$uera.labs}</th>
                                        <td>{$users.labs}</td></tr>
                                    <tr><th>{$uera.farms}</th>
                                        <td>{$users.farms}</td></tr>
                                    <tr><th>{$uera.towers}</th>
                                        <td>{$users.towers}</td></tr>
                                    <tr><th>Unused Land</th>
                                        <td>{$users.freeland}</td></tr>
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
                                    <tr><td colspan="2">&nbsp;</td></tr>
                                     <tr><th>{$uera.runes} Production</th>
                                        <td>{$runeproduce}</td></tr>
                                     <tr><th>{$uera.wizards} Recruited Per Turn</th>
                                        <td>{$wizardrate}</td></tr>
                                </table>
                 </div>
            
            </div>

            	</table>
            </div>
			<script type="text/javascript">var Statistics=new animatedcollapse("statusbar", 400, true, false)</script>
            {$End_Shadow_Vine}
            <br />
            <center>
            <span style="font-size:x-large"></span> <br />
            {if $onlinedh == true} 
                <span class="cwarn">
                <b>You have been attacked by {$onl_e}. <br />
                We may be attacked again at any moment!</b></span>
                <br />
                <br />
            {/if} 
