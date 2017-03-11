<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
if ($users[disabled] == 2)	// are they admin?
	endScript("Cannot join clans as an administrator.");

if ($users[clan])
	endScript("You are already in a clan.");

$memlimit = ceil(5 + (sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE land>0 AND disabled!=2 AND disabled!=3;")/20));

if ($do_joinopenclan) {
	if($signup_clan != 0) {
		$sclan = loadClan($signup_clan);
		if($sclan[open] == 0)
			endScript("That clan is closed.");
		if ($sclan[members] >= $memlimit)
			endScript("That clan is currently full. When more players join the game or clan members leave the clan, you may join.");

		$users[clan] = $signup_clan;
		$users[forces] = 0;
		$users[allytime] = $time;
		$sclan[members]++;
		saveClanData($sclan, "members");
		saveUserData($users, "clan forces allytime");
		addNews(112, array(id1=>$sclan[founder], clan1=>$sclan[num], id2=>$users[num]));
		endScript("</span><span class='success-font'>You have been accepted as a member of $sclan[name].");
        }
}
if ($do_joinclan) {
	$uclan = loadClan($join_num);
	$password = md5($join_pass);
	if ($password == $uclan[password]) {
		if ($uclan[members] >= $memlimit)
			endScript("That clan is currently full. When more players join the game or clan members leave the clan, you may join.");
		$users[clan] = $uclan[num];
		$users[forces] = 0;
		$users[allytime] = $time;
		saveUserData($users,"clan forces allytime");
		if($uclan[members] == -1) {
			$uclan[members]++;
			$uclan[founder] = $users[num];
		}
		$uclan[members]++;
		saveClanData($uclan,"members founder");
		addNews(112, array(id1=>$uclan[founder], clan1=>$uclan[num], id2=>$users[num]));
		endScript("</span><span class='success-font'>You have been accepted as a member of $uclan[name].");
	} else {
		endScript("Incorrect password.");
	}
}


$ccs = array();
$clanlist = mysql_safe_query("SELECT num,name,tag FROM $clandb WHERE members>0 ORDER BY num;");
$tpl->assign('numcs', mysql_num_rows($clanlist));
while ($clan = mysql_fetch_array($clanlist))
	$ccs[] = $clan;
$tpl->assign('ccs', $ccs);

$ocs = array();
$clanlist = mysql_safe_query("SELECT num,name,tag FROM $clandb WHERE open=1 AND members>0 ORDER BY num;");
$tpl->assign('numocs', mysql_num_rows($clanlist));
while ($clan = mysql_fetch_array($clanlist))
	$ocs[] = $clan;
$tpl->assign('ocs', $ocs);


$tpl->display('clanjoin.tpl');
?>
