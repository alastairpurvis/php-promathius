<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

include($game_root_path."/lib/marketcron.php");

$commission = 0;
$commissioncancel = 0;
if($users[networth] < 10000000)
{
	$commission = 1 - round(0.1 * $config['sellcommission'],3);
	$commissioncancel = 1 - round(0.1 * $config['cancelcommission'],3);
}
else if($users[networth] < 20000000)
{
	$commission = 1 - round(0.15 * $config['sellcommission'],3);
	$commissioncancel = 1 - round(0.15 * $config['cancelcommission'],3);
}
else if($users[networth] < 50000000)
{
	$commission = 1 - round(0.2 * $config['sellcommission'],3);
	$commissioncancel = 1 - round(0.2 * $config['cancelcommission'],3);
}
else if($users[networth] < 100000000)
{
	$commission = 1 - round(0.25 * $config['sellcommission'],3);
	$commissioncancel = 1 - round(0.25 * $config['cancelcommission'],3);
}
else
{
	$commission = 1 - round(0.3 * $config['sellcommission'],3);
	$commissioncancel = 1 - round(0.3 * $config['cancelcommission'],3);
}

include($game_root_path."/lib/pubmarketsell.php");

if ($lockdb)
	endScript("The Public market is currently disabled.");
if ($users[turnsused] <= $config[protection])
	endScript("Cannot trade on the public market while under protection.");

if(!defined('CLAN'))
	define('CLAN', 0);
if(!defined('SCRIPT'))
	define('SCRIPT', 'pubmarketbuy');
if(!defined('SCRIPT2'))
	define('SCRIPT2', 'pubmarketsell');

$trooplst = array();
foreach($config[troop] as $num => $mktcost)
	$trooplst[] = "troop$num";
$trooplst[] = 'food';


foreach($config[troop] as $num => $mktcost)
	getCosts("troop$num", $num);
getCosts(food);

foreach($config[troop] as $num => $mktcost)
	calcBasket('troop',0.9, $num, 0);
calcBasket(food,0.100, 0, 0);

ob_start();

if ($do_sell)
{
	foreach($config[troop] as $num => $mktcost)
		sellUnits('troop', $num);
	sellUnits('food');
	saveUserData($users,"networth troops food");
}

if ($do_removeunits)
	removeUnits($remove_id);

if ($do_cancelShipment)
	cancelShipment($cancel_id);

ob_end_clean();

foreach($config[troop] as $num => $mktcost)
	printRow(troop, $num);
printRow(food);
$goods = sqlsafeeval("SELECT COUNT(*) FROM $marketdb WHERE seller = '$users[num]' AND clan=".CLAN.";");

foreach($config[troop] as $num => $mktcost)
	calcBasket('troop',0.9, $num, 1);
calcBasket(food,0.100, 0, 1);

$commissionperc = 100 - ($commission*100);
$commissioncancperc = 100 - ($commissioncancel*100);
// Load the game graphical user interface

initGUI("");
$tpl->assign('message2',$msg2);
$tpl->assign('commission',$commissionperc);
$tpl->assign('cancelcommission',$commissioncancperc);
$tpl->assign('goods',$goods);
$tpl->assign('marketime',$config[market]);
$tpl->assign('err',$msg_error1);
$tpl->assign('message',$msg);
$tpl->assign('basket', $basketdata);
$tpl->assign('rowdata', $rowdata);
$tpl->assign('script2', SCRIPT2);
$tpl->assign('clan', CLAN);
$tpl->assign('uclan', $uclan);
$tpl->display("actions/trade/sell.tpl");
?>

