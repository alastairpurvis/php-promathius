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
			endScript("All members have been removed from <b>$uclan[name]</b>.  The clan will be deleted shortly.");
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
			endScript("You have been removed from <b>$uclan[name]</b>.");
		}
	}

	if ($do_useforces)
	{
		$users[forces] = 11;
		saveUserData($users,"forces");
		print "You are now using your forces to help fellow clan members.<br />\n";
	}
	if ($do_notuseforces)
	{
		$users[forces] = 10;
		saveUserData($users,"forces");
		print "Your forces will be available for your use in 2 hours.<br />\n";
	}
	?>
<a href="?clan">Front Page</a> | <b>Memberlist</b><br /><br />


<?=$uclan[members]?> total members.<br /><br />
<table class="sortable" width=400>
<tr class="score"><th><?=$uera[empireC]?></th>
    <th>Greatness</th>
    <th>Sharing</th>
    <th>Time in Clan</th></tr>
<?
	$list = mysql_safe_query("SELECT empire,num,forces,rank,networth,allytime FROM $playerdb WHERE clan=$uclan[num];");
	while ($listclan = mysql_fetch_array($list)) {
                $hours = ($time - $listclan[allytime]) / 3600;
		$allytime = "";
                if ($hours > 24) {
                        $days = floor($hours / 24);
                        $allytime .= $days . " days, ";
                        $hours -= $days * 24;
                }
		$allytime .= round($hours, 0) . " hours";
?>
<tr><td class="acenter"><a class=proflink href=?profiles&num=<?=$listclan[num]?><?=$authstr?> title="Rank <?=$listclan[rank]?>"><?=$listclan[empire]?></a></td>
    <td class="aright"><?=round((floor($listclan[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff'])?></td>
    <td class="acenter"><span class=<?if ($listclan[forces]) print '"cgood">YES'; else print '"cbad">NO';?></span></td>
    <td class="aright"><?=$allytime?></td></tr>
<?
	}
?>
</table>

<?
}
?>
