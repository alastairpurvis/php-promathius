<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();

$clans = array();
$diplomats = array('founder', 'asst', 'fa1', 'fa2');
$clanlist = mysql_safe_query("SELECT num,name,tag,founder,fa1,fa2,asst FROM $clandb WHERE members>0 ORDER BY tag;");
while ($clan = mysql_fetch_array($clanlist)) {
	foreach($diplomats as $pos) {
		if($clan[$pos]) {
			$num = $clan[$pos];
			$dipl = mysql_fetch_array(mysql_safe_query("SELECT num,empire FROM $playerdb WHERE num=$num"));
			$clan[$pos] = "<a class=proflink href=?profiles&num=$num$authstr>".$dipl['empire'];
		} else {
			$clan[$pos] = "none";
		}
	}

	$clans[] = $clan;
}

$tpl->assign('clans', $clans);
$tpl->display('contacts.tpl');
?>
