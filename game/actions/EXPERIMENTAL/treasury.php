<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
$clan = loadClan($users[clan]);

if($clan[members] == 1)
	endScript("You must have at least 2 people in your clan to use the Treasury.");

if(($uclan[tres_open] == 0) && ($uclan[founder] != $users[num]) && ($uclan[asst] != $users[num]))
	endScript("The treasury is closed.");

//is officer?
$officer = 0;
if($users[num] == $clan[founder] || $users[num] == $clan[asst] || $users[num] == $clan[fa1] || $users[num] == $clan[fa2]) {
	$officer = 1;
}

// Mods for how much food/cash/or runes

$cash_mod = 100; // net * what = limit;
$food_mod = 100/$config[food_sell]; // net * what = limit;
$rune_mod = $food_mod; // net * what = limit;

// Find the total net of clan.

$totalnet = sqlsafeeval("SELECT sum(networth) FROM $playerdb WHERE land>0 AND disabled != 2 AND clan=$users[clan];");

// Limits

$limit_food = $totalnet * $food_mod;
$limit_cash = $totalnet * $cash_mod;
$limit_rune = $totalnet * $rune_mod;

$show_limit_food = $limit_food;
$show_limit_cash = $limit_cash;
$show_limit_rune = $limit_rune;

if($limit_food < $clan[granary])
	$limit_food = $clan[granary];
if($limit_cash < $clan[treasury])
	$limit_cash = $clan[treasury];
if($limit_rune < $clan[loft])
	$limit_rune = $clan[loft];

$ucglimit = min($users[cash], $limit_cash-$clan[treasury]);
$ufglimit = min($users[food], $limit_food-$clan[granary]);
$urglimit = min($users[runes], $limit_rune-$clan[loft]);
$uctlimit = $clan[treasury];
$uftlimit = $clan[granary];
$urtlimit = $clan[loft];

if($tres_ch_open) {
	$tres = $clan['tres_open'];
	if($tres)
		$tres = 0;
	else
		$tres = 1;
	$clan['tres_open'] = $tres;
	saveClanData($clan, "tres_open");
}


if($do_transaction) {
	// Fix our Input(s)
//echo "Cash T: $cash_take";

	fixInputNum($food_take);
	fixInputNum($food_give);

	fixInputNum($rune_take);
	fixInputNum($rune_give);

	fixInputNum($cash_take);
	fixInputNum($cash_give);

	$food_take = invfactor($food_take);
	$food_give = invfactor($food_give);

	$rune_take = invfactor($rune_take);
	$rune_give = invfactor($rune_give);

	$cash_take = invfactor($cash_take);
	$cash_give = invfactor($cash_give);

//echo "Cash T: $cash_take";

	if(!empty($_POST['ctmax']))		$cash_take = $uctlimit;
	if(!empty($_POST['ftmax']))		$food_take = $uftlimit;
	if(!empty($_POST['rtmax']))		$rune_take = $urtlimit;
	if(!empty($_POST['cgmax']))		$cash_give = $ucglimit;
	if(!empty($_POST['fgmax']))		$food_give = $ufglimit;
	if(!empty($_POST['rgmax']))		$rune_give = $urglimit;


	if($cash_give - $cash_take == 0 &&
	   $food_give - $food_take == 0 &&
	   $rune_give - $rune_take == 0)
		endScript("You're not doing anything in that transaction!");


	// Negative number?
	if($cash_take < 0 || $cash_give < 0 || $rune_take < 0 || $rune_give < 0 || $food_take < 0 || $food_give < 0)
		endScript("You may not take or give a negative amount");

	// Giving too much?
	if($cash_give > $users[cash] || $rune_give > $users[runes] || $food_give > $users[food])
		endScript("You don't have enough to deposit");

	// Taking too much?
	if($cash_take > $clan[treasury] || $rune_take > $clan[loft] || $food_take > $clan[granary])
		endScript("You can't take that much.");

	// Give to user

	$users[food] += $food_take;
	$clan[granary] -= $food_take;

	$users[cash] += $cash_take;
	$clan[treasury] -= $cash_take;

	$users[runes] += $rune_take;
	$clan[loft] -= $rune_take;


	// Give to Clan

	$users[food] -= $food_give;
	$clan[granary] += $food_give;

	$users[cash] -= $cash_give;
	$clan[treasury] += $cash_give;

	$users[runes] -= $rune_give;
	$clan[loft] += $rune_give;


	// Safety checks... incase I've missed it somewhere else
	if($clan[loft] < 0 || $clan[treasury] < 0 || $clan[granary] < 0)
		endScript("You can't take that much.");

	if($users[runes] < 0 || $users[cash] < 0 || $users[food] < 0)
		endScript("You can't give that much.");


	// Over the limit?
	if($clan[granary] > $limit_food || $clan[treasury] > $limit_cash || $clan[loft] > $limit_rune)
		endScript("You can't give that much.");


	if($clan['tres_open'] == 0 && $officer == 0) {
		if($cash_take > 0 || $rune_take > 0 || $food_take > 0)
			endScript("Sorry, only the clan officers may take from the clan treasury at this time!");
	}


	// Save up data

	saveUserData($users, "food cash runes networth");
	saveClanData($clan, "granary loft treasury");

	// Output

	$transaction = "";

	if($cash_give > 0) $transaction .= "Gave \$" . commas(gamefactor($cash_give)) . ". \n<br />";
	if($cash_take > 0) $transaction .= "Took \$" . commas(gamefactor($cash_take)) . ". \n<br />";

	if($food_give > 0) $transaction .= "Gave " . commas(gamefactor($food_give)) . " food. \n<br />";
	if($food_take > 0) $transaction .= "Took " . commas(gamefactor($food_take)) . " food. \n<br />";

	if($rune_give > 0) $transaction .= "Gave " . commas(gamefactor($rune_give)) . " $uera[runes]. \n<br />";
	if($rune_take > 0) $transaction .= "Took " . commas(gamefactor($rune_take)) . " $uera[runes]. \n<br />";

	$clanmembers = mysql_safe_query("SELECT * FROM $playerdb WHERE num=$clan[founder] OR num=$clan[asst] OR num=$users[num];");
	while($member = mysql_fetch_array($clanmembers))
	{
		if($member[num] != $users[num] )
			addNews(501, array(clan1=>$users[clan], id1=>$member[num], id2=>$users[num],	food1=>($food_give-$food_take),
													cash1=>($cash_give-$cash_take),
													runes1=>($rune_give-$rune_take)));
				//News to members
		if($member[num] == $users[num] )
			addNews(502, array(clan1=>$users[clan], id1=>$users[num],			food1=>($food_give-$food_take),
													cash1=>($cash_give-$cash_take),
													runes1=>($rune_give-$rune_take)));
	
				//News to self
	}

	$tpl->assign("trans", $transaction);

	// Send to clan leader? Store in table?
}

$co = 'Open';
$nco = 'Closed';
if($clan['tres_open']) {
	$co = 'Closed';
	$nco = 'Open';
}

// Assign to template.

$tpl->assign('limit_food', commas($show_limit_food));
$tpl->assign('limit_rune', commas($show_limit_rune));
$tpl->assign('limit_cash', commas($show_limit_cash));

$tpl->assign('officer', $officer);
$tpl->assign('tres_open', $co);
$tpl->assign('nco', $nco);

$tpl->assign('curr_food', commas($clan[granary]));
$tpl->assign('curr_rune', commas($clan[loft]));
$tpl->assign('curr_cash', commas($clan[treasury]));
$tpl->assign('clan_name', $clan[name]);

if($transaction != "") $tpl->assign('trans', $transaction);

$tpl->display('treasury.tpl');

echo "";
include($game_root_path."/lib/tres-news.php");

endScript('');
?>
