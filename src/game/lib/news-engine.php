<?php
////////////////////////////////////////////////
// NEWS-ENGINE.PHP
////////////////////////////////////////////////
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$maxnews = 7;

$faction = loadRace($users['race'], $users['region']);
$faction = $faction['name'];
$region = loadRegion($users['region'], $users['race']);
$region = $region['id'];
$regionname = $region['name'];
$culture = loadCulture($users['race'], $users['region']);
$wealth = gamefactor($users['cash']);
$power = determinePower($users['troop']);
$power = $power['value'];
$powerstring = $power['string'];

$number = 1;

// Load & Execute the news conditions script
$file_conditions = file_get_contents("data/includes/news.conditions.inc");
ob_start();
eval($file_conditions);
$output = ob_get_contents();
ob_end_clean();
echo $output;

foreach($news as $num => $id)
{
	$scriptedtype = getNewsType($id);
	switch ($id){
		case 201:
			// Init variables
			$attacker = $news[bla];
			
			addEvent('Attacked');
			break;
		// For scripted items
		case 999;
			addItem($scriptedtype);
	}
	$number++;
	if($number > $maxnews)
	{
		break;
	}
}

// Send the basic TPL data
$tpl->assign('NewsItems', $titleR);
$tpl->assign('NewsItemPages', $pagesR);

// Functions
function newsItem($type)
{
	global $date;

	injectNews($type, $date);
	echo "Added news item: ".$type;
}

function addItem($type)
{
	global $titleR, $number;

	simplifyVars(true, null);
	
	include("data/includes/news.scripted.inc");
	
	$titleR[$number] = $title;
}

function addEvent($type)
{
	global $titleR, $number;

	simplifyVars(false, $type);
	
	include("data/includes/news.events.inc");

	$titleR[$number] = $title;
}

function simplifyVars($scripted, $type)
{
	global $faction, $culture, $year, $worth, $age, $order, $wealth, $power, $region;

	// Define user variables
	define("Faction", $faction, true);	
	define("Region", $region, true);	
	define("Culture", $culture, true);
	define("Wealth", $wealth, true);
	define("Power", $power, true);
	define("Worth", $worth, true);
	define("Age", $age, true);
	define("Order", $age, true);

	// Define universal variables
	define("Year", $year, true);
	define("TopRankWorth", $toprankworth, true);
	define("TopRankPower", $toprankpower, true);
	define("TopRankWealth", $toprankwealth, true);
	define("LastTopRankWorth", $lasttoprankworth, true);
	define("LastTopRankPower", $lasttoprankpower, true);
	define("LastTopRankWealth", $lasttoprankwealth, true);
	define("NewEmpiresList", $newemplist, true);
	define("NewClanList", $newclanlist, true);

	if(!$scripted)
	{
		if($type == 'Attacked')
		{
			global $attacker, $attacks, $attackerfaction, $attackerculture, $attackerworth, $attackerwealth, $attackerpower, $attackerage, $attackerorder, $attacklossesplayer, $attacklossesattacker;

			define("Attacker", $attacker, true);
			define("Number", $attacks, true);
			define("Losses", $attacklossesplayer, true);
			define("AttackerLosses", $attacklossesattacker, true);
			define("AttackerFaction", $attackerfaction, true);
			define("AttackerCulture", $attackerculture, true);
			define("AttackerWorth", $attackerworth, true);
			define("AttackerWealth", $attackerwealth, true);
			define("AttackerPower", $attackerpower, true);
			define("AttackerAge", $attackerage, true);
			define("AttackerOrder", $attackerorder, true);
		}
		elseif($type == 'Aid')
		{
			global $aidsender, $aidcontent;

			define("Sender", $aidsender, true);
			define("Contents", $aidcontent, true);
		}
	}
}
function injectNews($date)
{

}

?>