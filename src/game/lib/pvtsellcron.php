<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if($times = howmanytimes($users['bmper_last'], $perminutes)) {
//	$users[bmp] = explode("|", $users[bmper]);
$users[bmp] = $users[bmper];
	foreach($config[troop] as $num => $mktcost) {
		if($users[bmp][$num] > (100*(1+(getBuildings('income_total', $users)*$config['buildingoutput'])/$users[land])))
			$users[bmp][$num] = $users[bmp][$num] - $times*(100*(1+(getBuildings('income_total', $users)*$config['buildingoutput'])/$users[land]));
		if($users[bmp][$num] < (100*(1+(getBuildings('income_total', $users)*$config['buildingoutput'])/$users[land])))
			$users[bmp][$num] = 0;
	}
	$users[bmper] = $users[bmp];
	$users[bmper_last] = $time - $time%($perminutes*60);
	saveUserData($users, "bmper bmper_last");
}
?>
