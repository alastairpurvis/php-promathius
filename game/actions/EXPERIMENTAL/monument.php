<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();

if($users[turnsused] < 1000)
	endScript("You must have used at least 1000 turns to erect a monument.");

function killUnits ($type, $minpc, $maxpc, $rolls, $num=0) {
        global $users;
        $losspct = 0;
        $min = round(1000000 * $minpc);
        $max = round(1000000 * $maxpc);
        for ($i = 0; $i < $rolls; $i++)
                $losspct += mt_rand($min,$max);
        $losspct /= 1000000;
	if($type == 'troop') {
	        $loss = round($users[troop][$num] * $losspct);
	        $users[troop][$num] -= $loss;
	} else {
	        $loss = round($users[$type] * $losspct);
	        $users[$type] -= $loss;
	}
        return $loss;
}

$reqland = 10000;
$req = array();
$req_ok = array();
$reqnames = array();
$tr = array();
foreach($config[troop] as $num => $mktcost) {
	$req[$num] = round((500/$config[troop][0])*100*$config[troop][0]*$users[land]/$mktcost);
	$req_ok[$num] = 0;
	if($users[troop][$num] >= $req[$num])
		$req_ok[$num] = 1;
	$reqnames[$num] = $uera["troop$num"];
	$tr[] = array('name' => $uera["troop$num"], 'ok' => $req_ok[$num], 'reqd' => commas($req[$num]));
}
$req[wizards] = round($users[land]*10*($config[wpl]/100));
$req[land] = 10000;
$req[health] = 75;
$req[turns] = $config[initturns];
$reqnames[wizards] = $uera[wizards];
$reqnames[land] = 'acres';
$reqnames[health] = 'health';
$reqnames[turns] = 'turns';

foreach($req as $stuff => $reqd) {
	if(is_integer($stuff))
		continue;
	$req_ok[$stuff] = 0;
	if($users[$stuff] >= $reqd)
		$req_ok[$stuff] = 1;
	$tr[] = array('name' => $reqnames[$stuff], 'ok' => $req_ok[$stuff], 'reqd' => commas($reqd));
}

$req_okall = 1;
foreach($req_ok as $stuff => $okd) {
	if($okd == 0) {
		$req_okall = 0;
		break;
	}
}

if($warh1 || $warh2 || $warh3 || $peaceh1 || $peaceh2 || $peaceh3 || $specialh1 || $specialh2 || $specialh3) {
	if($req_okall == 0)
		endScript("You don't meet the require_oncements for contructing a monument.");

                $users[health] -= 50;
                $users[turns] -= $config[initturns];
                print "The earth shakes. Great rifts appear in the ground, and fires break out. Suddenly, you hear a noise behind you. Out of the new ruins of your tent steps a shadowy figure. Before you have time to do anything, the figure takes out his sword, and offers it to you, hilt first. \"I am at your service, Sire\".<br />";
		foreach($config[troop] as $num => $mktcost) {
			print commas(killUnits(troop,0.40,0.5,1,$num)).' '.$uera["troop$num"].', ';
		}
                print	commas(killUnits(peasants,0.4,0.50,1))." $uera[peasants], and ".
                        commas(killUnits(wizards,0.4,0.5,1))." $uera[wizards] died in the quake.<br />\n";
                $buildloss = 0;
                $buildloss += killUnits(homes,0.4,0.5,2);
                $buildloss += killUnits(shops,0.4,0.5,2);
                $buildloss += killUnits(industry,0.4,0.5,2);
                $buildloss += killUnits(barracks,0.4,0.5,2);
                $buildloss += killUnits(labs,0.4,0.5,2);
                $buildloss += killUnits(farms,0.4,0.5,2);
                $buildloss += killUnits(towers,0.4,0.5,2);
                $users[freeland] += $buildloss;
                $size = calcSizeBonus($users[networth]);
                print commas($buildloss)." structures, ".
                        commas(killUnits(food,0.1,0.2,3))." $uera[food], ".
                        commas(killUnits(runes,0.1,0.2,3))." $uera[runes], and \$".
                        commas(killUnits(cash,0.1,0.2,3))." were lost during the chaos.<br />\n";

     if($warh1)		$users[hero_war] = 1;
else if($warh2)		$users[hero_war] = 2;
else if($warh3)		$users[hero_war] = 3;

else if($peaceh1)	$users[hero_peace] = 1;
else if($peaceh2)	$users[hero_peace] = 2;
else if($peaceh3)	$users[hero_peace] = 3;

else if($specialh1)	$users[hero_special] = 1;
else if($specialh2)	$users[hero_special] = 2;
else if($specialh3)	$users[hero_special] = 3;

else
	endScript("The hero failed to arrive. Please report this to the administrators as a bug.");

saveUserData($users,"networth troops wizards homes shops industry barracks labs farms towers freeland food runes cash turns health hero_war hero_peace hero_special");

}

$warh[1] = "Zeus";			// 25% better attack
$warh[2] = "Odepus";			// 25% better defence
$warh[3] = "Hades";			// better at leader missions

$peaceh[1] = "Dionysius";			// good grain
$peaceh[2] = "Athena";		// good loyalty
$peaceh[3] = "Hercules";			// You can store more workers

$specialh[1] = "Herodotus";			// 2 times better healing
$specialh[2] = "Aristotle";		// The more attacks you have, the better your offenive power
$specialh[3] = "Plato";		// 3% losses are only 1% losses for you

$wardesc[1] = "Matthias the Warrior. With him, victory is more certain.<br />Specifically, 25% more certain.";
$wardesc[2] = "The Lady Cregga is a fearful warrior. With her, your defence is stronger.<br />Specifically, 25% stronger.";
$wardesc[3] = "Mactalon, Laird of the Skies. With him, you are better at missions.<br />Specifically, you need a 25% lower ratio to succeed.";

$peacedesc[1] = "Grumm the Molecook. With him, your fields will yield plentiful crops.<br />Specifically, 50% more plentiful.";
$peacedesc[2] = "Methuselah the Scholar. With him, you will collect more $uera[runes].<br />Specifically, 50% more $uera[runes].";
$peacedesc[3] = "Bella of Brockhall. With her, more people will flock to your suburbs.<br />Specifically, 5 times as many.";

$specialdesc[1] = "Brome the Healer. With him, your health shall always be good.<br />Specifically, you will heal 2 points per turn.";
$specialdesc[2] = "Martin the Warrior, the Avenging Spirit. With him, the more you are attacked, the better shall be your offense.<br />Specifically, (recent_attacks / 20)% better.";
$specialdesc[3] = "Major Perigord of the Long Patrol. With him, less troops and workers will desert you in trouble.<br />Specifially, your losses will be 1% instead of 3%.";

$warname; $peacename; $specialname; $count = 0;

foreach($warh as $num => $name) {
	$tpl->assign("war$num", $name);
	$tpl->assign("ward$num", $wardesc[$num]);
}
foreach($peaceh as $num => $name) {
	$tpl->assign("peace$num", $name);
	$tpl->assign("peaced$num", $peacedesc[$num]);
}
foreach($specialh as $num => $name) {
	$tpl->assign("special$num", $name);
	$tpl->assign("speciald$num", $specialdesc[$num]);
}

$tpl->assign('health', 75);
$tpl->assign('reqland', commas($reqland));
foreach($config[troop] as $num => $mktcost)
	$req["troop$num"] = gamefactor($req["troop$num"]);
$req['wizards'] = gamefactor($req['wizards']);
$req['food'] = gamefactor($req['runes']);
$req['cash'] = gamefactor($req['cash']);
$req['food'] = gamefactor($req['food']);
foreach($req as $stuff => $reqd) {
	$req[$stuff] = commas($reqd);
}
$req[health] = $req[health].'%';
$tpl->assign('tr', $tr);
$tpl->assign('req_okall', $req_okall);
$tpl->assign('initturns', $config['initturns']);

$who = 'The following Gods have your favour: <br />';
if($users['hero_war']) {
	$who .= $warh[$users['hero_war']]."<br />";
}
if($users['hero_peace']) {
	$who .= $trans.$peaceh[$users['hero_peace']]."<br />";
}
if($users['hero_special']) {
	$who .= $trans2.$specialh[$users['hero_special']]."<br />";
}

$who .= '<br />';
$tpl->assign('who', $who);
$tpl->assign('uera', $uera);

$tpl->display('monument.tpl');
endScript("");
?>
