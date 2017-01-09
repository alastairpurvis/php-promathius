<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
$scores1 = array();
$scores2 = array();


$which = $_GET['page'];
switch($_GET['page']) {
	case 'graveyard':	$tpl->assign('listtype', 'Graveyard');
				$query = "land = 0 AND disabled !=2 AND disabled != 3 AND death != 'abandon'";
		break;
	case 'abandon':		$tpl->assign('listtype', 'Hall of Shame');
				$query = "death = 'abandon'";
		break;

	case 'scores':
	default:
		$which = 'scores';
		$tpl->assign('listtype', 'Empire Rankings');
		$query = 'land > 0 AND disabled !=2 AND disabled !=3';
		break;
}

$tpl->assign('link', $which);

if($_GET['page'] == 'graveyard' || $_GET['page'] == 'abandon')
	$sorter = 'max_greatness DESC';
else
	$sorter = 'rank ASC';

$ssort = 'rank ASC';
switch($_GET['sortby']) {
	case 1:		$ssort = 'empire ASC';			break;
	case 2:		$ssort = 'land DESC';			break;
	case 3:		$ssort = 'networth DESC';		break;
	case 4:		$ssort = 'clan ASC';			break;
	case 5:		$ssort = 'race ASC';			break;
	case 6:		$ssort = 'era ASC';			break;
	case 7:		$ssort = 'kills DESC';			break;
	case 8:		$ssort = 'rank';				break;
	default:	$ssort = $sorter;			break;
}


function printScoreLine (&$scores) {
	global $users, $enemy, $ctags, $rtags, $etags, $racedb, $eradb, $config, $authstr, $urace;
	$mclan = loadClan($users[clan]);
	$color = "normal";
	if ($enemy[num] == $users[num])
	{
		$color = "self";
		$bg = "self";
	}
	elseif ($enemy[land] == 0)
	{
		$bg = "dead";
	}
	elseif ($enemy[disabled] == 2)
	{
		$bg = "admin";
		$color = "admin";
	}
	elseif ($enemy[disabled] == 3)
		$color = "disabled";
	elseif (($enemy[turnsused] <= $config[protection]) || ($enemy[vacation] > $config[vacationdelay]))
	{
		$color = "protected";
		$bg = "protected";
	}
	elseif (($users[clan]) && ($enemy[clan] == $users[clan]))
		$color = "ally";

	$racecolor_s = '';
	$racecolor_e = '';

	$captdet = loadClan($enemy[clan]);

	$ccolor = "mnormal";
	if (($enemy[clan] == $mclan[ally1]) || ($enemy[clan] == $mclan[ally2]) || ($enemy[clan] == $mclan[ally3]) || ($enemy[clan] == $mclan[ally4]) || ($enemy[clan] == $mclan[ally5])) {
		$ccolor = "mally";
	} else if (($enemy[clan] == $mclan[war1]) || ($enemy[clan] == $mclan[war2]) || ($enemy[clan] == $mclan[war3]) || ($enemy[clan] == $mclan[war4]) || ($enemy[clan] == $mclan[war5])) {
		$ccolor = "mdead";
	}
	if($enemy[clan] != 0 && $users[clan] == $enemy[clan])
		$ccolor = "mally"; 

	$yip = $mclan[war1];
	$leader = "";
	if ($captdet[founder] == $enemy[num]) $leader = "*";

	$online = '';
	if($enemy[online])
		$online = '*';

	$clan = '';
	if($enemy[clan])
		$clan = "<a class='$ccolor' href='?clancrier&sclan=$enemy[clan]$authstr'>$leader".$ctags["$enemy[clan]"]."$leader</a>";

	
	$scores[] = array(	mcolor	=> "m$color",
				online	=> $online,
				empire	=> $enemy[empire],
				num	=> $enemy[num],
				rank	=> $enemy[rank],
				land	=> commas($enemy[land]),
				greatness=> round((floor($enemy[networth] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']),
				clan	=> $clan,
				rcs	=> $racecolor_s,
				race	=> $rtags["$enemy[race]"],
				racel	=> strtolower($rtags["$enemy[race]"]),
				rce	=> $racecolor_e,
				era	=> $etags["$enemy[region]"],
				kills	=> $enemy[kills],
				bg	=> $bg,
				maxgreatness => round((floor($enemy[max_greatness] * 10)) /($config['greatness_roundoff']  ^ 10), $config['greatness_roundoff']),
				dates =>	makeDate($enemy[destructiondate])
			  );
}

function evenOdd($num){
	global $tempnum, $tempnumround;
	$tempnum = $num/2;
	$tempnumround = round($tempnum,1);
	if($tempnum == $tempnumround)
		$num = 2;
	else
		$num = 1;
	return $num;
}

if (!isset($_GET['view']))
	$view = 1;
else
	$view = $_GET['view'];
if ($view <= 0) {
	$view = 1;
} 
if (!isset($restr))
	$restr = "false";

$tpl->assign('servname', $config['servname']);
$tpl->assign('view', $view);
$tpl->assign('restr', $restr);
$tpl->assign('datetime', $datetime);

$total = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE land > 0;");
$online = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE online=0 AND hide=1;");
$killed = sqlsafeeval("SELECT SUM(kills) FROM $playerdb;");
$dead = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE land=0;");
$disabled = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE disabled=3;");
$active = sqlsafeeval("SELECT COUNT(*) FROM $playerdb WHERE disabled=0 AND land>0");
$abandoned = $dead - $killed;
$abandoned = ($abandoned < 0) ? 0 : $abandoned;

$tpl->assign('total', $total);
$tpl->assign('online', $online);
$tpl->assign('killed', $killed);
$tpl->assign('abandoned', $abandoned);
$tpl->assign('disabled', $disabled);
$tpl->assign('active', $active);
$tpl->assign('empire', $uera['empire']);
$tpl->assign('empireC', $uera['empireC']);

$start = $users[rank] - (15 * $view);
if ($start < 10)
	$start = 10;
$end = 30;
$end *= $view;

if(isset($_GET['show']))
	$show = $_GET['show'];
else
	$show = '';
if ($show == 'all') {
	$start = 10;
	$end = 90000;
} 

if ($restr == "true")
	$clause = "turnsused > $config[protection] AND";
else
	$clause = "";


function getScores($start, $end, $array) {
	global $playerdb, $$array, $enemy, $ssort, $clause, $query;

	$limit = "$start,$end";
	$scores = mysql_safe_query("SELECT rank,empire,num,land,networth,clan,race,era,online,disabled,turnsused,vacation,kills, startyear, destructiondate, max_greatness FROM 
		$playerdb WHERE $clause $query ORDER BY $ssort LIMIT $limit;");

	if (@mysql_num_rows($scores) != 0) {
		while ($enemy = mysql_fetch_array($scores)) {
			printScoreLine($$array);
		}
	} 
}

//getScores(0, 10, 'scores1');
getScores(0, $end, 'scores1');

$tpl->assign('era', $users['region']);
$tpl->assign('scores1', $scores1);
$tpl->assign('scores1lower', $scoreslower);
$tpl->assign('scores2', $scores2);
$sc1e = 0; $sc2e = 0;
if(empty($scores1))
	$sc1e = 1;
if(empty($scores2))
	$sc2e = 1;
$tpl->assign('sc1e', $sc1e);
$tpl->assign('sc2e', $sc2e);
$tpl->assign('show', $show);
$tpl->display('scores.tpl'); ?>
