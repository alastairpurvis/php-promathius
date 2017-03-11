<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
require_once($game_root_path."/lib/libclan.php");
// Determine if the user is in a clan for the side menu

// Load the game graphical user interface
initGUI();
if ($users[disabled] == 2)	// are they admin?
	endScript("Cannot join clans as an admin!");

if ($users[clan])
{
	$uclan = loadClan($users[clan]);
	if ($do_removeself)
	{
		if ($users[allytime] > ($time - 3600*72))
			doError("You must wait at least 72 hours before disbanding a clan.");
		if ($uclan[founder] == $users[num])
		{
			$remuser = mysql_safe_query("SELECT num,clan,forces,allytime FROM $playerdb WHERE clan=$uclan[num] AND num!=$uclan[founder];");
			while ($enemy = mysql_fetch_array($remuser))
			{
				$enemy[clan] = $enemy[forces] = 0;
				saveUserData($enemy,"clan forces");
				addNews(117, array(id1=>$enemy[num], clan1=>$uclan[num], id2=>$uclan[founder]));
			}
			addNews(111, array(id1=>$users[num], clan1=>$uclan[num]));
			$uclan[members] = 0;
			saveClanData($uclan,"members");

			$founder = loadUser($uclan[founder]);
			$founder[clan] = 0;
			$founder[forces] = 0;
			saveUserData($founder, "clan forces");
			endScript("</span><span class='success-font'>All members have been removed from <b>$uclan[name]</b>.<br />  The clan will dissolve.");
		}
		else
		{
			$uclan[members]--;
                        // Remove from any positions of power.
                        $posarray = array('asst','fa1','fa2');
                        foreach($posarray as $pos) {
                        if ($uclan[$pos] == $users[num])
                        	$uclan[$pos] = 0;
                        }
			$users[clan] = 0;
			addNews(113, array(id1=>$uclan[founder], id2=>$users[clan]));
			saveUserData($users,"clan");
			saveClanData($uclan,"members asst fa1 fa2");
			endScript("</span><span class='success-font'>You have been removed from <b>$uclan[name]</b>.");
		}
	}
if ($current_Error != '') 
{ ?>
<span class="error-font"><b><?=$current_Error?></b></span><br /><br /><br />
<?php
} 
?>
<b>Front Page</b> | <a href="?clan_memberlist">Memberlist</a><br /><br />
	<h3>~ <?=$uclan[name]?> ~</h3><br />
    We currently have <?=$uclan[members]?> members.<br /><br />
	<?
	if ($uclan[url])
	{
?><a href="<?=$uclan[url]?>" target="_blank"><?
	}
	if ($uclan[pic])
	{
?><img src="<?=$uclan[pic]?>" style="border:0" alt="<?=$uclan[name]?>"><?
	}
	elseif ($uclan[url])
	{
?><?=$uclan[name]?>'s Home Page<?
	}
	if ($uclan[url])
	{
?></a><?
	}
?>
<br />
<table class="inputtable" style="width:80%; padding:0px" cellspacing=0>
<tr><td></td></tr>
<tr><td class=caption4>Clan News</td></tr>
<tr class="tbCel1"><td class="caption1" ><?=bbcode_parse($uclan[motd])?></td></tr>
<tr><td></td></tr>
</table><br />
<form method="post" action="?clan<?=$authstr?>">
<div>
<a href="?clanstats&amp;sort_type=avggreat<?=$authstr?>">Top Clans by Average Greatness</a><br />
<a href="?clanstats&amp;sort_type=members<?=$authstr?>">Top Clans by Membership</a><br />
<a href="?clanstats&amp;sort_type=totalgreat<?=$authstr?>">Top Clans by Total Greatness</a><br />
<br /><br />
<input type="submit" name="do_removeself" class=mainoption value="<?if ($users[num] == $uclan[founder]) print "Disband"; else print "Leave";?> Clan">
</div>
</form>
<?
}
else
{
	if ($do_createclan)
	{
	$create_founder=$users[num];
	mkclan()		;
		
	} 
$create_clan = '<table border=0 cellpadding=0 cellspacing=0><tr><td width=10%>&nbsp;<td>
<table cellspacing="0" cellpadding="0" width=310>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:5px;padding-bottom:15px">
<table>
<form action="?clan'.$authstr.'" method="post">
<tr><td class="aright">*Clan Name:</td>
    <td><input type="text" name="create_name" size="16" maxlength="32"></td></tr>
<tr><td class="aright">*Clan Tag:</td>
    <td><input type="text" name="create_tag" size="8" maxlength="5"></td></tr>
<tr><td class="aright">*Password:</td>
    <td><input type="password" name="create_pass" size="8" maxlength="16"></td></tr>
<tr><td class="aright">Website URL:</td>
    <td><input type="text" name="create_url" size="25"></td></tr>
<tr><td class="aright">Flag URL:</td>
    <td><input type="text" name="create_flag" size="25"></td></tr>
<tr><td colspan="2" class="acenter"><input type="submit" name="do_createclan" class="mainoption" value="Create Clan"><br /><br />
<i>Please remember to prefix all URLs with "http://".</i>
</td></tr>
</table>
</td>'. $shadowdata['end'] . ' </td><td style="vertical-align:top" width=10%>
<table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section=clan" title="'.$config[lang][helpbutton].'" tabindex="4"><img src="data/images/spacer.gif" height=100% alt="'.$config[lang][helpbutton].'"></img></a></td></tr></a></table></td>
  </tr></table>
</form>';
$clans = mysql_safe_query("SELECT num,tag,name FROM $clandb WHERE members<0;");
if(@mysql_num_rows($clans) == 0)
        $seg = '<td><b>No Dead Clans (yet)</b></td></tr>';
else {
        $seg = '<td><div style="width: 120px"><select name="join_num" id="join_num" size="1"><option value="0">Select</option>';
      
        while ($clan = mysql_fetch_array($clans)) {
                $seg .=  "<option value='$clan[num]'>$clan[tag] - $clan[name]</option>";
	}
        $seg .= '</select></div></td></tr>';
}   
$resurrect_clan = '<table cellspacing="0" cellpadding="0" width=280>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-top:5px;padding-bottom:15px">
<table>
<form action="?clanjoin'.$authstr.'" method="post">
<tr><th colspan="2" class="acenter" style="padding-bottom:5px">Resurrect Dead Clan</th></tr>
<tr><td class="aright" style="padding-top:5px" valign="top">Clan:</td>' . $seg . '<tr><td class="aright">Password:</td>
    <td><input type="password" name="join_pass" size="8"></td></tr>
<tr><td colspan="2" class="acenter"><input type="submit" name="do_joinclan" class="mainoption" value="Re-Form Clan"></td></tr>

</form>
</table>
</td>' . $shadowdata['end'];


?>
<div id="jscheck" style="display:none">
<script type="text/javascript">
showTabs();
</script>
<div class="TabView" id="ClanTabs">
<div class="Tabs">
  <a>Create Clan</a> | 
  <a>Resurrect Clan</a>
</div>
<br /><br />
<div class="Pages" style="width: 450px; height:234px">

  <div class="Page" style="padding-left:5px">
  <div class="Pad">
	<?=$create_clan?>

  </div>
  </div>
  <div class="Page">
  <div class="Pad">

	<?=$resurrect_clan?>
  </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
tabs_initialize('ClanTabs');
</script>
<noscript>
<?=$create_clan?><br />
<?=$resurrect_clan?>
</noscript>
<?
}
endScript("");
?>
