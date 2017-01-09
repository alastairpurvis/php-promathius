<?php

function smarty_function_war_drop($params, &$smarty)
{
  global $users, $prof_target, $playerdb;
  $html = "";
  $warquery = "SELECT num, empire, land, disabled, clan FROM $playerdb WHERE land>0 AND disabled != 3 ORDER BY num";
	$warquery_result = @dba_query($warquery);
    $html .= "<select name=\"msg_dest\" onClick=\"updateMsgNums()\" class=\"dkbg\"><option value=\"\" class=\"m\">None</option>";
	while ($wardrop = @dba_step($warquery_result)) {
					$color = "normal";
					if ($wardrop[num] == $users[num])
						$color = "self";
					elseif ($wardrop[land] == 0)
						$color = "dead";
					elseif ($wardrop[disabled] == 2)
						$color = "admin";
					elseif ($wardrop[disabled] == 3)
						$color = "disabled";
					elseif (($users[clan]) && ($wardrop[clan] == $users[clan]))
						$color = "ally";
    $html .= "<option value=\"$wardrop[num]\" class=\"m$color\" ";
    if($wardrop[num] == $prof_target) $html .= "selected ";
    $html .= ">$wardrop[num] - $wardrop[empire]</option>\n";
	}
   return $html . "</select>";
}

?>
