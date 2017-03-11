<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
$page="standards.tpl";
$tpl->assign('err', $current_Error);
if (isset($_POST['do_equip']) && $use_turns != 0){
	fixInputNum($use_turns);
	if ($use_turns > $users[turns])
    {
		doError("You don\'t have enough turns.");
	}
	takeTurns($use_turns, equipment);
	$users['equip_level'] += $use_turns;
	saveUserData($users, "equip_level");
}
for ($e = 0; $e <= $config['standards']['Equipment']['Levels']; $e++)
{
			$status = '0%';
			if($users['equip_level'] >= $config['standards']['EquipmentLevel'.$e]['TurnCost'])
			{
				$status = 'Complete';
			}
			else if($users['equip_level'] <= $config['standards']['EquipmentLevel'.($e-1)]['TurnCost'])
			{
				$status = '0%';
			}
			else
			{
				$status = round(floor(($users['equip_level'] / $config['standards']['EquipmentLevel'.$e]['TurnCost'])*100),1).'%';
			}
			$equip[] = array(dbonus	=> $config['standards']['EquipmentLevel'.$e]['DefenceBonus'],
							upkeep	=> $config['standards']['EquipmentLevel'.$e]['UpkeepPenalty'],
							status => $status);
//	echo $standards['EquipmentLevel'.$e]['DefenceBonus'];
}


//include($game_root_path."/lib/error_msg.php");
// Load the game graphical user interface
initGUI();
echo $turnoutput;
$tpl->assign('equip', $equip);
$tpl->display($page);

endScript('');
?>
