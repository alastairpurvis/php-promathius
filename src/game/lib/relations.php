<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

function getRelations()
{
	global $users, $enemy, $tpl, $trade_agreement, $enemy_prohibit_diplomacy, $player_prohibit_diplomacy,
	$alliance, $military_agreement, $at_war;
	
	// Check to see whether or not the player is banned by this user
	$enemy_prohibit_diplomacy = false;
	$prohibit_diplo_table = explode(",", $enemy[prohibit_diplomacy]);
	foreach($prohibit_diplo_table as $id1 => $enemies)
	{
		if($enemies == $users[num])
		{
			$enemy_prohibit_diplomacy = true;
		}
	}

	if($enemy_prohibit_diplomacy == true)
	{
		$tpl->assign("enemy_prohibit_diplomacy", true);
		// **************DEBUG
		//print("DEBUG: This empire does not wish to speak with you.<br>");
		// **************DEBUG
	}
	// **************DEBUG
	else
	{
		//print("DEBUG: This empire is happy to speak with you.<br>");
	}
	// **************DEBUG
	
	// Check to see whether or not the user was banned by the player
	$player_prohibit_diplomcy = false;
	$prohibit_diplo_table2 = explode(",", $users[prohibit_diplomacy]);
	foreach($prohibit_diplo_table2 as $id2 => $enemies)
	{
		if($enemies == $enemy[num])
		{
			$player_prohibit_diplomacy = true;
		}
	}

	if($player_prohibit_diplomacy == true)
	{
		$tpl->assign("player_prohibit_diplomacy", true);
		// **************DEBUG
		//print("DEBUG: You have rejected all diplomatic relations with this empire.<br>");
		// **************DEBUG
	}
	// **************DEBUG
	else
	{
		//print("DEBUG: You allow diplomatic relations with this empire.<br>");
	}
	// **************DEBUG

	// Check for trade agreements
	$trade_agreement = false;
	$trade_agreements_table = explode(",", $enemy[trade_agreements]);
	foreach($trade_agreements_table as $id3 => $agreements)
	{
		if($agreements == $users[num])
		{
			$trade_agreement = true;
		}
	}
	
	if($trade_agreement == true)
	{
		$tpl->assign("trade_agreement", true);
		// **************DEBUG
		//print("DEBUG: This empire has a trade agreement with you.<br>");
		// **************DEBUG
	}
	// **************DEBUG
	else
	{
		//print("DEBUG: This empire does not have a trade agreement with you.<br>");
	}
	// **************DEBUG
	
	// Check for alliances
	$alliance = false;
	$alliances_table = explode(",", $enemy[alliances]);
	foreach($alliances_table as $id4 => $alliances)
	{
		if($alliances == $users[num])
		{
			$alliance = true;
		}
	}
	
	if($alliance == true)
	{
		$tpl->assign("alliance", true);
		// **************DEBUG
		//print("DEBUG: This empire is an ally.<br>");
		// **************DEBUG
	}
	// **************DEBUG
	else
	{
		//print("DEBUG: This empire is not an ally.<br>");
	}
	// **************DEBUG

	// Check for military rights
	$military_rights = false;
	$military_rights_table = explode(",", $enemy[military_agreements]);
	foreach($military_rights_table as $id4 => $military_rights)
	{
		if($military_rights == $users[num])
		{
			$military_agreement = true;
		}
	}
	
	if($military_agreement == true)
	{
		$tpl->assign("military_agreement", true);
		// **************DEBUG
		//print("DEBUG: This empire is offering its military.<br>");
		// **************DEBUG
	}
	// **************DEBUG
	else
	{
		//print("DEBUG: This empire is not offering its military.<br>");
	}
	// **************DEBUG

	// Check for at war
	$at_war = false;
	$war_table = explode(",", $enemy[at_war]);
	foreach($war_table as $id5 => $at_wars)
	{
		if($at_wars == $users[num])
		{
			$at_war = true;
		}
	}
	
	if($at_war == true)
	{
		$tpl->assign("at_war", true);
		// **************DEBUG
		//print("DEBUG: This empire is at war with you.<br>");
		// **************DEBUG
	}
	// **************DEBUG
	else
	{
		//print("DEBUG: This empire is at peace with you.<br>");
	}
	// **************DEBUG
}
?>