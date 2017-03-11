<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path."/lib/spells.php");
include($game_root_path."/lib/magic.php");

function printMRow ($num) {
	global $spname, $sptype, $spcost, $spratio, $uera, $users, $lratio, $magicrows;
	$class = '';
	if($users['runes'] < $spcost[$num])
		$class = 'cbad';
//	if($sptype[$num] == 'd')
	//	if($lratio <= $spratio[$num])
		//	$class = 'cwarn';

	//	echo "<tr><td><div class='radio'><input class=radio type=\"radio\" name='mission_num' value='$num'><table width=100% cellpadding=0 cellspacing=0><tr><td>".$spname[$num].'</td><td class="aright"><span class='.$class.'>('.commas(gamefactor($spcost[$num])).' '.$uera['runes'].')'."</span></table></td></tr></div>";
		
			$magicrows[] = array(name	=> $spname[$num],
			cost	=>	(commas(gamefactor($spcost[$num]))), classn	=>	$class, num	=>	$num);
//	echo "<option value='$num' class='$class'";
//	if($num == $_POST['mission_num'])
//		echo ' checked';
//	echo '>';
//	echo $spname[$num].'  ('.commas(gamefactor($spcost[$num])).' '.$uera['runes'].')';
//	if($sptype[$num] == 'd')
//		echo '';
//	echo '</option>';
}
function printMRowFirst ($num) {
	global $spname, $sptype, $spcost, $spratio, $uera, $users, $lratio, $magicrowfirst;
	$class = '';
	if($users['runes'] < $spcost[$num])
		$class = 'cbad';
//	if($sptype[$num] == 'd')
	//	if($lratio <= $spratio[$num])
	//		$class = 'cbad';

	//	echo "<tr><td><div class=\"radio selected\"><input class=radio type=\"radio\" name='mission_num' value='$num' checked='checked'><table width=100% cellpadding=0 cellspacing=0><tr><td>".$spname[$num].'</td><td class="aright"><span class='.$class.'>('.commas(gamefactor($spcost[$num])).' '.$uera['runes'].')'."</span></table></td></tr></div>";
		
			$magicrowfirst[] = array(name	=> $spname[$num],
			cost	=>	(commas(gamefactor($spcost[$num]))), classn	=>	$class, num	=>	$num);
//	echo "<option value='$num' class='$class'";
//	if($num == $_POST['mission_num'])
//		echo ' checked';
//	echo '>';
//	echo $spname[$num].'  ('.commas(gamefactor($spcost[$num])).' '.$uera['runes'].')';
//	if($sptype[$num] == 'd')
//		echo '';
//	echo '</option>';
}

$spcounter = 1;
define('o', 'o');
define('d', 'd');

function addsp($name, $mana, $type, $ratio, $funcname, $newsnum) {
	global $users, $urace, $sptype, $spcost, $spratio, $spname, $spcounter, $missions, $spfuncs, $spnews, $spnumbyname;
	if(!$spcounter) $spcounter = 1;
	// this chunk sets the costs of missions
	// Global Spcounter was acting STRANGE...print("$name - " . $spcounter . " -- Counter<br />");
	// array was created so that it's easier to reference
	$manabase = ($users[land] * .1) + 100 + (getBuildings('runes', $users) * .2) * $urace[magic] * calcSizeBonus($users[networth]);
	// sptype is "o" for offense, "d" for defence
	$spname[$spcounter] = $name;
	$spnumbyname[$funcname] = $spcounter;	// easier for scripting
	$spcost[$spcounter] = ceil($manabase * $mana);
	$sptype[$spcounter] = $type;
	if($users['hero_war'] == 3)			// Hermes?
		$ratio *= 0.75;
	if($type == d)
		$spratio[$spcounter] = $ratio * $config['wpl'] / 100;
	else
		$spratio[$spcounter] = $ratio;
	$spfuncs[$spcounter] = $funcname;
	$spnews[$newsnum] = $spcounter;// Used in the news teller
	$missions = $spcounter;
	//print("$spname[$spcounter]  -- Name<br />");
	$spcounter += 1;
}

global $config, $users, $urace, $time;
if($urace['nospy'] < 1)
	addsp($config['missionspy'], 		$config['missionspycost'],	o, $config['missionspyratio'],	'missionspy',		201	);
if($urace['noblast'] < 1)
	addsp($config['missionblast'], 		$config['missionblastcost'],	o, $config['missionblastratio'],	'missionblast',		202	);
if($urace['noshield'] < 1)
	addsp($config['missionshield'], 	$config['missionshieldcost'],	d, $config['missionshieldratio'],		'missionshield',	0	);
if($urace['nostorm'] < 1)
	addsp($config['missionstorm'], 		$config['missionstormcost'],	o, $config['missionstormratio'],	'missionstorm',		204	);
if($urace['norunes'] < 1)
	addsp($config['missionrunes'],		$config['missionrunescost'],	o, $config['missionrunesratio'],	'missionrunes',		205	);
if($urace['nostruct'] < 1)
	addsp($config['missionstruct'],		$config['missionstructcost'],	o, $config['missionstructratio'],	'missionstruct',	206	);
if($urace['nofood'] < 1)
	addsp($config['missionfood'], 		$config['missionfoodcost'],	d, $config['missionfoodratio'],		'missionfood',		0	);
if($urace['nogold'] < 1)
	addsp($config['missiongold'], 		$config['missiongoldcost'],	d, $config['missiongoldratio'],		'missiongold',		0	);
if($urace['noexplore'] < 1)
	addsp($config['missioned'],		$config['missionedcost'],	d, $config['missionedratio'],		'missioned',		0	);
if($urace['noheal'] < 1)
	addsp($config['missionheal'],		$config['missionhealcost'],	d, $config['missionhealratio'],		'missionheal',		0	);
if($urace['nopeasant'] < 1)
	addsp($config['missionpeasant'],	$config['missionpeasantcost'],	d, $config['missionpeasantratio'],		'missionpeasant',	0	);
if($urace['noprod'] < 1)
	addsp($config['missionprod'],		$config['missionprodcost'],	d, $config['missionprodratio'],		'missionprod',		0	);
if($urace['nokill'] < 1)
	addsp($config['missionkill'],		$config['missionkillcost'],	d, $config['missionkillratio'],		'missionkill',		0	);
if($urace['nogate'] < 1)
{
	if ($users[gate] < $time)
		addsp($config['missiongate'],		$config['missiongatecost'],	d, $config['missiongateratio'],		'missiongate',		0	);
	if ($users[gate] > $time)
	{
		addsp($config['missiongatextend'],		$config['missiongatextendcost'],	d, $config['missiongatextendratio'],		'missiongate',		0	);	
	}
	if ($users[gate] > $time)
	{
	addsp($config['missionungate'],		$config['missionungatecost'],	d, $config['missionungateratio'],		'missionungate',	0	);
	}
}
if($urace['nofight'] < 1)
	addsp($config['missionfight'],		$config['missionfightcost'],	o, $config['missionfightratio'],		'missionfight',		211	);
if($urace['nosteal'] < 1)
	addsp($config['missionsteal'],		$config['missionstealcost'],	o, $config['missionstealratio'],	'missionsteal',		212	);
if($urace['norob'] < 1)
	addsp($config['missionrob'],		$config['missionrobcost'],	o, $config['missionrobratio'],	'missionrob',		213	);
if($urace['nomove'] < 1)
{
	addsp($config['missionadvance'],	$config['missionadvancecost'],	d, $config['missionadvanceratio'],		'missionadvance',	0	);
	addsp($config['missionback'],		$config['missionbackcost'],	d, $config['missionbackratio'],		'missionsouth',		0	);
}


if ($do_mission)
{	
	if ($mission_num == $spnumbyname['missionkill'] && (!$jsenabled && $php_block!="Yes")) {
		?>

Performing Seppuku will destroy ALL of your troops and population as well as a portion of your
<?=$uera[wizards]?>
. Do you still want to perform this mission?
<form method="post" action="?magic<?=$authstr?>">
  <input type="submit" name="php_block" value="Yes">
  <input type="submit" name="php_block" value="No">
  <input type="hidden" name="do_mission" value="yes">
  <input type="hidden" name="mission_num" value="<?=$mission_num?>">
  <input type="hidden" name="num_times" value="<?=$num_times?>">
  <input type="hidden" name="hide_turns" value="<?=$hide_turns?>">
</form>
<?
		endScript("");
	}
	if ($mission_num == 0)
	{
			doError("An operation must be specified.");
	}
	$ret = do_magic(
		$spfuncs[$mission_num],
		array(	times => $_POST['num_times'],
			target => $_POST['target'],
			)
		);
	echo $ret;

}
?>
