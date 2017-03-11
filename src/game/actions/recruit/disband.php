<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path."/lib/pvtsellcron.php");
include($game_root_path."/lib/disband.php");

function printRow ($type, $num='')
{
	global $users, $uera, $costs, $cansell, $disp_array, $config, $unitdeficiency;
	if($type == 'troop')
	{
		$umt = $users[troop][$num];
		$type = $type.$num;
		$hasunit = $users["unit_".$config['troopindex'][$num+1]];
	} 
	else
		$umt = $users[$type];
	
	if(gamefactor($hasunit) > 0)	// Only show units that the player actually has
	{
		$disp_array[] = array(	name	=> ucwords($uera[$type]),
					amt	=> commas($umt),
					cost	=> commas($costs[$type]),
					cansell	=> commas($cansell[$type]),
					type	=> $type);
	}
	else
		$unitdeficiency++;
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
//getSellCosts("food");

foreach($config[troop] as $num => $mktcost) {
	printRow(troop, $num);
}
//printRow("food");
if($unitdeficiency >= $config['trooptotal'])
	$nothing = true;

$tpl->assign('nothing', $nothing);
$tpl->assign('message', $msg);
$tpl->assign('err', $msg_error1);
$tpl->assign('usera', $users[region]);
$tpl->assign('types', $disp_array);
// Load the game graphical user interface
$pagetype = 'military';
initGUI("");
$tpl->display('actions/recruit/disband.tpl');


?>
