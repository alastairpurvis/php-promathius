<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
include($game_root_path."/lib/pvtsellcron.php");
include($game_root_path."/lib/pvtmarketsell.php");

function printRow ($type, $num='')
{
	global $users, $uera, $costs, $cansell, $disp_array;
	if($type == 'troop') {
		$umt = $users[troop][$num];
		$type = $type.$num;
	} else
		$umt = $users[$type];

	$disp_array[] = array(	name	=> $uera[$type],
				amt	=> commas($umt),
				cost	=> commas($costs[$type]),
				cansell	=> commas($cansell[$type]),
				type	=> $type);
}


$msg = '';
$disp_array = array();

if ($do_sell) {
	foreach($sell as $var => $value) {
		if(isset($max[$var]))
			$sell[$var] = 'max';
	}

	bazaarsell($sell);
}

foreach($config[troop] as $num => $mktcost) {
	getSellCosts(troop, $num);
}
getSellCosts("food");

foreach($config[troop] as $num => $mktcost) {
	printRow(troop, $num);
}
printRow("food");

$tpl->assign('message', $msg);
$tpl->assign('err', $msg_error1);
$tpl->assign('usera', $users[region]);
$tpl->assign('types', $disp_array);
// Load the game graphical user interface
initGUI("");
$tpl->display('pvtmarketsell.tpl');

?>
