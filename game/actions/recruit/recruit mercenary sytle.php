<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

include($game_root_path."/lib/pvtbuycron.php");
include($game_root_path."/lib/pvtmarketbuy.php");

function printRow ($type, $num='')
{
	global $users, $uera, $costs, $canbuy, $disp_array;
	if($type == 'troop') {
		$umktmt = $users[pmkt][$num];
		$umt = $users[troop][$num];
		$type = $type.$num;
	}
	else {
		$umktmt = $users["pmkt_$type"];
		$umt = $users[$type];
	}
	$disp_array[] = array(	name	=> $uera[$type],
				amt	=> commas($umt),
				mkt	=> commas($umktmt),
				cost	=> commas($costs[$type]),
				canbuy	=> commas($canbuy[$type]),
				type	=> $type);
}

$msg = '';
$disp_array = array();

foreach($config[troop] as $num => $mktcost) {
	getBuyCosts('troop', $num);
}
//getBuyCosts("food");

if ($do_buy) {
	foreach($buy as $var => $value) {
		if(isset($max[$var]))
			$buy[$var] = 'max';
	}

	bazaarbuy($buy);
}

foreach($config[troop] as $num => $mktcost) {
	getBuyCosts(troop, $num);
}
//getBuyCosts("food");

foreach($config[troop] as $num => $mktcost) {
	printRow(troop, $num);
}
//printRow("food");

$tpl->assign('err', $msg_error1);
$tpl->assign('message', $msg);
$tpl->assign('usera', $users[region]);
$tpl->assign('types', $disp_array);

// Load the game graphical user interface
$pagetype = 'military';
initGUI("");
$tpl->display('actions/recruit/recruit.tpl'); 
?>
