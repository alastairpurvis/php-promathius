<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if($times = howmanytimes($users['pvmarket_last'], $perminutes)) {
	echo "<!--";
	echo "$times\n";
	$users[bmp] = explode("|", $users[pvmarket]);
	foreach($config[troop] as $num => $mktcost) {
		if($users[bmp][$num] < (250*($users[land]+(2*($users[barracks]*$config['buildingoutput'])))))
			$users[bmp][$num] = round(($users[bmp][$num] + $times*((4000/$mktcost)*($users[land]+($users[barracks]*$config['buildingoutput'])))));
	}
	$users[pmkt] = $users[bmp];

	$users[pmkt_food] += $times*50*($users[land] + ($users[farms]*$config['buildingoutput']));
	if($users[pmkt_food] > 2000*($users[land] + ($users[farms]*$config['buildingoutput'])))
		$users[pmkt_food] = 2000*($users[land] + ($users[farms]*$config['buildingoutput']));

	$users[pvmarket_last] = $time - $time%($perminutes*60);
	print_r($users[pmkt]);
	echo "-->";
	saveUserData($users, "pvmarket pvmarket_last pmkt_food");
}
?>
