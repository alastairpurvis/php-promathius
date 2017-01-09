<?php
include("game/lib/marketcron.php");

// Load the game graphical user interface
initGUI("");
if ($lockdb)
	endScript("Public market currently disabled!");

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
	$users["troop$num"] = $users[troop][$num];

function buyUnits ($type) {
	global $playerdb, $marketdb, $users, $uera, $buy, $buyprice, $datetime, $time, $max, $config, $msg_error1, $msg;
	$amount = $buy[$type];
	$price = $buyprice[$type];
	fixInputNum($price);
	fixInputNum($amount);

	$amount = invfactor($amount);

	sqlQuotes($type);
	fixInputNum($price);
	$market = mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE type='$type' AND seller!=$users[num] AND price<=$price AND time<=$time AND clan=".CLAN." 
		ORDER BY price ASC, time ASC LIMIT 1;"));
	if (!$market[amount])
		return;
	if(isset($max[$type]))
		$amount = floor($users[cash] / ($market[price]));
	if ($amount > $market[amount])
		$amount = $market[amount];

	if ($amount == 0) // did I specify a value?
		return;
	if ($amount < 0)
		$msg_error1 = "Cannot purchase a negative amount of $uera[$type].";
	elseif ($amount * $price > $users[cash])
		$msg_error1 = "You don't have enough money to buy that many $uera[$type].";
	else {
		$enemy = loadUser($market[seller]);
		$spent = $amount * $price;
		$sales = round($spent * .95);
		$users[cash] -= $spent;
		$enemy[savings] += $sales;
		$users[$type] += $amount;
		fixInputNum($amount);
		@mysql_safe_query("UPDATE $marketdb SET amount=(amount-$amount) WHERE id=$market[id] AND clan=".CLAN.";");
		@mysql_safe_query("DELETE FROM $marketdb WHERE amount=0;");
		
		if($type != 'food' && $type != 'runes')
		{
			if(gamefactor($amount) == 1)
				$itemname = $uera[$type.'alt'];
			else
				$itemname = $uera[$type];
		}
		else
			$itemname = strtolower($uera[$type]);
		$msg[] = commas(gamefactor($amount)) . " $itemname purchased from the market for " . commas(gamefactor($spent)) . " gold";
		if($type == 'food') {
			addNews(100, array(id1=>$enemy[num], id2=>$users[num], food1=>$amount, cash1=>$sales));
		} else if($type == 'runes') {
			addNews(100, array(id1=>$enemy[num], id2=>$users[num], runes1=>$amount, cash1=>$sales));
		} else {
			$troopsell = '';
			foreach($config[troop] as $num => $mktcost) {
				if($type == "troop$num")
					$troopsell .= $amount.'|';
				else
					$troopsell .= '0|';
			}
			$troopsell = substr($troopsell, 0, -1);
			addNews(100, array(id1=>$enemy[num], id2=>$users[num], troops1=>$troopsell, cash1=>$sales));
		} 
		saveUserData($enemy, "networth savings");
	} 
} 

function getCosts ($type)
{
	global $marketdb, $users, $costs, $avail, $canbuy, $time;
	sqlQuotes($type);
	$market = mysql_fetch_array(mysql_safe_query("SELECT * FROM $marketdb WHERE type='$type' AND seller!=$users[num] AND time<=$time AND clan=".CLAN." 
		ORDER BY price ASC, time ASC LIMIT 1;"));
	if ($market[id]) {
		$costs[$type] = $market[price]*1.05;
		$avail[$type] = $market[amount];
		$canbuy[$type] = floor($users[cash] / $market[price]);
		if ($canbuy[$type] > $market[amount])
			$canbuy[$type] = $market[amount];
	} else $costs[$type] = $avail[$type] = $canbuy[$type] = 0;
} 

function printRow ($type)
{
	global $users, $uera, $costs, $avail, $canbuy, $rowdata;
					$rowdata[] = array(name	=> ucwords($uera[$type]), 
						type => $type, 
						owned => gamefactor($users[$type]), 
						availiable => gamefactor($avail[$type]), 
						cost => $costs[$type],
						canbuy => gamefactor($canbuy[$type]));
} 

if ($users[turnsused] <= $config[protection])
	endScript("Cannot trade on the public market while under protection!");

foreach($trooplst as $num => $entry)
	getCosts($trooplst[$num]);

if ($do_buy) {
	foreach($trooplst as $num => $entry)
		buyUnits($trooplst[$num]);
	foreach($config[troop] as $num => $mktcost)
		$users[troop][$num] = $users["troop$num"];
	saveUserData($users, "networth cash troops food runes");
} 
foreach($trooplst as $num => $entry)
	getCosts($trooplst[$num]);

foreach($trooplst as $num => $entry)
	printRow($entry);

$tpl->assign('goods',$goods);
$tpl->assign('marketime',$config[market]);
$tpl->assign('err', $msg_error1);
$tpl->assign('message',$msg);
$tpl->assign('basket', $basketdata);
$tpl->assign('rowdata', $rowdata);
$tpl->assign('script2', SCRIPT2);
$tpl->assign('clan', CLAN);
$tpl->assign('uclan', $uclan);
$tpl->display("actions/trade/buy.tpl");

?>
