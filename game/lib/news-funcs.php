<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
function printNews (&$user) {
	global $newsdb, $playerdb, $clandb, $users, $uera, $time, $authstr, $config, $atknames;

	if($user[newssort] == 0)
		$order = 'DESC';
	elseif($user[newssort] == 1)
		$order = 'ASC';
	else
		$order = 'DESC';

	$news = mysql_safe_query("SELECT * FROM $newsdb WHERE id1=$user[num] AND time>$user[newstime] ORDER BY time $order;");
	if (!@mysql_num_rows($news))
		return 0;

	echo '<table cellspacing=0 cellpadding=0 border=0 width=90%>';
	echo '<tr><td colspan=4 class=caption4>Empire News</td></tr><td><table border=0 cellspacing=0 cellpadding=0 width=100%>';

	while ($new = mysql_fetch_array($news)) {
		$time = $new[time];
		$id1 = $new[id1];
		$id2 = $new[id2];
		$id3 = $new[id3];

		if($id1 != "0") {
			$pl1 = mysql_fetch_array(mysql_safe_query("SELECT empire,race,era FROM $playerdb WHERE num=$id1;"));
			$name1 = $pl1['empire'].' <a class=proflink href=?profiles&num='.$id1.$authstr.'>(#'.$id1.')</a>';
			$era1 = loadRegion($pl1['era'], $pl1['race']);
		} else {
			$name1 = "An unknown $uera[empire]"; // anon bounty checking
			$id1 = "???";
		}
		
		if($id2 != "0") {
			$pl2 = mysql_fetch_array(mysql_safe_query("SELECT empire,race,era FROM $playerdb WHERE num=$id2;"));
			$name2 = ' <a class=proflink href=?profiles&num='.$id2.$authstr.'>'.$pl2['empire'].'</a>';
			$era2 = loadRegion($pl2['era'], $pl2['race']);
		} else {
			$name2 = "An unknown $uera[empire]"; // anon bounty checking
			$id2 = "???";
		}
		
		if($id3 != "0") {
			$pl3 = mysql_fetch_array(mysql_safe_query("SELECT empire,race,era FROM $playerdb WHERE num=$id3;"));
			$name3 = $pl3['empire'].' <a class=proflink href=?profiles&num='.$id3.$authstr.'>(#'.$id3.')</a>';
			$era3 = loadRegion($pl3['era'], $pl3['race']);
		} else {
			$name3 = "An unknown $uera[empire]"; // anon bounty checking
			$id3 = "???";
		}
		
		$clan1 = $new[clan1];
		$clan2 = $new[clan2];
		$clan3 = $new[clan3];
		if($clan1 != 0)		$clname1 = sqlsafeeval("SELECT name FROM $clandb WHERE num=$clan1;").' <a class=proflink href=?clancrier&sclan='.
						$clan1.$authstr.'>('.sqlsafeeval("SELECT tag FROM $clandb WHERE num=$clan1;").')</a>';
		else			$clname1 = "None";
		if($clan2 != 0)		$clname2 = sqlsafeeval("SELECT name FROM $clandb WHERE num=$clan2;").' <a class=proflink href=?clancrier&sclan='.
						$clan1.$authstr.'>('.sqlsafeeval("SELECT tag FROM $clandb WHERE num=$clan2;").')</a>';
		else			$clname2 = "None";
		if($clan3 != 0)		$clname3 = sqlsafeeval("SELECT name FROM $clandb WHERE num=$clan3;").' <a class=proflink href=?clancrier&sclan='.
						$clan1.$authstr.'>('.sqlsafeeval("SELECT tag FROM $clandb WHERE num=$clan3;").')</a>';
		else			$clname3 = "None";
		$shielded = $new[shielded]%10;
		$failed = 0;

		$troops1 = explode('|', $new[troops1]);
		$troops2 = explode('|', $new[troops2]);
		foreach($troops1 as $id => $key)
			$troops1[$id] = gamefactor($key);
		foreach($troops2 as $id => $key)
			$troops2[$id] = gamefactor($key);

		$factors = array('cash1', 'cash2', 'food1', 'food2', 'runes1', 'runes2', 'wizards1', 'wizards2');
		foreach($factors as $key)
			$new[$key] = gamefactor($new[$key]);

		$troops1sum = array_sum($troops1);
		$troops2sum = array_sum($troops2);

		if($shielded == -1)
			$failed = 1;

		echo '<tr style="vertical-align:top" class=tbCel1>';

		$hours = (time() - $new[time]) / 3600;
		if ($hours > 24) {
			$days = floor($hours / 24);
//			print $days . " days, ";
			$hours -= $days * 24;
		} 


//		echo '<td>'.$new[code].'</td>';		//debug
		switch ($new[code]) {
			case 100:
				echo '<td colspan="2" class="caption1">You sold:<br />';
				foreach($config[troop] as $num => $mktcost) {
					if($troops1[$num])
						echo '<li>'.commas($troops1[$num]).' '.$uera["troop$num"].'</li>';
				}

				if(!empty($new[food1]))
					echo '<li>'.commas($new[food1]).' '.$uera["food"].'</li>';
				if(!empty($new[runes1]))
					echo '<li>'.commas($new[runes1]).' '.$uera["runes"].'</li>';

				echo 'on the market for $'.commas($new[cash1]).'.<br />';
				echo 'The cash is available in your <a href="?funding'.$authstr.'">Savings</a> account.</span>';
				break;
			case 101:
				//raffle
				echo '<td colspan="2" class="caption1">You check your raffle ticket and find it is the winning number!<br />';
				$get = '';
				if(!empty($new[food1]))		$get = commas($new[food1]).' food';
				elseif(!empty($new[cash1]))	$get = '$'.commas($new[cash1]);
				echo 'You have won '.$get.'!</span>';
				break;
			case 102:
				echo '<td class="caption1" colspan=2><table style="padding: 0px" cellspacing=0 cellpadding=0><tr><td style="vertical-align:top">'.$name2.' has sent you '.commas($troops1[$config[aidtroop]]).' ';
				echo $era2["troop".$config[aidtroop]].' carrying: </span><td>';
				foreach($troops1 as $num => $amt) {
					if($amt && $num != $config[aidtroop]) {
						echo commas($amt).' '.$era2["troop$num"]."<br />\n";
					}
				}
				if($new[cash1])		echo ''.commas($new[cash1])." ".strtolower($uera[cash])."<br />\n";
				if($new[food1])		echo commas($new[food1]).' '.strtolower($uera[food])."<br />\n";
				if($new[runes1])	echo commas($new[runes1]).' '.strtolower($uera[runes])."<br />\n";
				echo '</table>';
				break;

			case 110:
				echo '<td colspan="2" class="caption1">You founded '.$clname1.'.</span>';
				break;
			case 111:
				echo '<td colspan="2" class="caption1">You disbanded '.$clname1.'.</span>';
				break;
			case 112:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' joined '.$clname1.'.</span>';
				break;
			case 113:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' left '.$clname1.'.</span>';
				break;
			case 114:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' removed you from '.$clname1.'.</span>';
				break;
			case 115:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' made you leader of '.$clname1.'.</span>';
				break;
			case 116:
				echo '<td colspan="2" class="caption1">You inherited leadership of '.$clname1.'.</span>';
				break;
			case 117:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' disbanded '.$clname1.'.</span>';
				break;
			case 118:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' made you an officer of '.$clname1.'.</span>';
				break;
			case 119:
				echo '<td colspan="2" class="caption1">'.$name2;
				echo ' removed you from your position in '.$clname1.'.</span>';
				break;

			case 201:
				echo '<td colspan="2" class="caption1">'.$uera[wizards];
				if($failed)	echo ' from '.$name2.' were caught and executed for an attempt to steal top secret information.';
				else		echo ' from another '.$uera[empire].' were caught attempting to steal top secret information.';
				echo '</span>';
				break;
			case 202:
				if($failed)		echo '<td colspan="2" class="caption1">'.$name2.' has been caught attempting to cause unrest within you empire';
				else			echo '<td colspan="2" class="caption1">'.($shielded?1:3).'% of the population has deserted due to apparent \'unhappiness\'.<br />Your '.strtolower($era2[wizards]).' have managed to trace the cause of this unrest to '.$name2.'';
				if($shielded == 1)	echo ',</span> though your '.strtolower($uera[wizards]).' prevented any serious problems';
				echo '.</span>';
				break;
			case 204:
				if($failed)		echo '<td colspan="2" class="caption1">'.$name2.' attempted to poison many of your '.strtolower($uera[food]).' stocks';
				else			echo '<td colspan="2" class="caption1">'.$uera[wizards].' from '.$name2.' were seen to have poisoned '.commas($new[food1]).' of our '.strtolower($uera[food]). ' stocks';
				if($shielded == 1)	echo ',</span> though your '.$uera[wizards].' prevented too much damage from occuring';
				echo '.</span>';
				break;
			case 205:
				if($failed)		echo '<td colspan="2" class="caption1">'.$name2.' attempted to burn one of our game/libraries containing a large portion of '.strtolower($uera[runes]);
				else			echo '<td colspan="2" class="caption1">'.$name2.' burned '.commas($new[runes1]).' of your ' .strtolower($uera[runes]);
				if($shielded == 1)	echo ',</span> though your '.$uera[wizards].' prevented too much damage';
				echo '!</span>';
				break;
			case 206:
				if($failed)		echo '<td colspan="2" class="caption1">'.$name2.' tried to burn your buildings';
				else			echo '<td colspan="2" class="caption1">'.$name2.' burned '.commas($new[land1]).' of your buildings';
				if($shielded == 1)	echo ',</span> though your '.$uera[wizards].' prevented too much damage';
				echo '!</span>';
				break;
			case 211:
				if($failed)
					echo '<td class="caption1">'.$name2.' assualted you with '.strtolower($era2[wizards]).'.</span><br />';
				else if($shielded == 0)	{
					echo '<td><span class="cbad">'.$name2.' defeated you with '.strtolower($era2[wizards]).'.</span>';
					echo '<td><span class="cbad">Your enemy captured '.commas($new[land1]).' acres and destroyed:<br />';
				}
				if($shielded == 1) {
					echo '<td>'.$name2.' lost a conflict with your '.strtolower($uera[wizards]).'.</span>';
					echo '<td>You lost<br />';
				}
				if(!$failed)
					echo commas($new[wizards1]).' '.strtolower($uera[wizards]).'</span><br />';
				if($new[wizards2] > 0)
					echo 'You managed to kill '.commas($new[wizards2]).' '.strtolower($era2[wizards]).'.';
				else
					echo 'They managed to escape without getting killed.';
				echo '</span>';
				break;
			case 212:
				if($failed)		echo '<td colspan="2" class="caption1">'.strtolower($uera[wizards]).' from '.$name2. ' were caught attempting to steal your money';
				else			echo '<td colspan="2" class="caption1">'.$name2.' stole '.commas($new[cash1]).' of your gold';
				if($shielded == 1)	echo ',</span> though your '.$uera[wizards].' stopped them before they could steal most of it';
				echo '.</span>';
				break;
			case 213:
				if($failed)		echo '<td colspan="2" class="caption1">'.$name2.'\'s '.strtolower($era2[wizards]).' have been caught attempting to smuggle out '.strtolower($uera['food']).' stocks';
				else			echo '<td colspan="2" class="caption1">'.$name2.'\'s '.strtolower($era2[wizards]).' have managed to smuggle out a large portion ('.commas($new[food1]).') of '.strtolower($uera['food']).' from our granaries';
				if($shielded == 1)	echo ',</span> though your '.$uera[wizards].' prevented any major crisis from occuring';
				echo '.</span>';
				break;

			case 300:
				echo '<td colspan="2" class="caption1">Your forces came to the aid of '.$name1.' in defence of '.$name2.'!';
				echo '</span>';
				break;
			case 302:
			case 303:
			case 304:
			case 305:
			case 303:
			case 306:
			case 307:
			case 308:
			case 309:
			case 310:
			case 311:
			case 312:
			case 313:
			case 314:
			case 315:
			case 316:
			case 317:
			case 318:
			case 319:
			case 320:
				$num = $new[code] - 300;
				$name = $atknames[$num];
				$failed = true;
				if($new[land1] > 0)	$failed = false;
				if($new[food1] > 0)	$failed = false;
				if($new[cash1] > 0)	$failed = false;

				if($failed) {
					echo '<td colspan="2" class="caption1"><table border=0 width=100%><tr><td colspan=2>'.$name2.' attacked you in a '.strtolower($name).'.</span></tr>';
					echo '<tr><td colspan="2">You held your defence and managed to win the battle.</td></tr>';
					if($troops1sum != 0)	echo '<Tr><td>Your losses:<br />';
					else			echo '<Tr><td>Nothing<br />';
				} else {
					echo '<td colspan="2" class="caption1"><table border=0 width=100%><tr><td colspan="2"><span>'.$name2.' attacked you in a '.strtolower($name).'.</span></tr>';
					echo '<Tr><td colspan="2">Your enemy ';
					switch($shielded) {
						case 1:	echo 'has occupied '.commas($new[land1]).' acres of our land';	break;
						case 2:	echo 'has stolen '.commas($new[cash1]).' '.strtolower($uera[cash]);		break;
				//		case 3:	echo sprintf(' pillaged our farms and has stolen  %s %s', commas($new[food1]), strtolower($uera[food]));	break;
						case 3:	echo 'pillaged our farms and has stolen '.commas($new[food1]).' '.strtolower($uera[food]);	break;
					}
				//	echo '.';
					if($troops1sum == 0)	echo '.';
					else			echo '.</td></tr><tr><td>Your losses:<br />';
				}

				if($troops1sum != 0) {
					foreach($config[troop] as $num => $mktcost) {
						if($troops1[$num])
							echo ''.commas($troops1[$num]).' '.$uera["troop$num"].'<br />';
					}
				}
				if($troops2sum != 0) {
					echo '</span><td class="aright">Enemy losses:<br />';
					foreach($config[troop] as $num => $mktcost) {
						if($troops2[$num])
							echo ''.commas($troops2[$num]).' '.$era2["troop$num"].'<br />';
					}
				}
				echo '</span></table>';
				break;
			case 399:
				echo '<td colspan="2" class="caption1"><span class="cbad">As '.$name2.' delivers their final blow, your '.$uera[empire].' collapses...</span>';
				break;

			case 401:
				echo '<td colspan="2" class="caption1">You created a mission targetting '.$name2.'.</span>';
				break;
			case 402:
				echo '<td colspan="2" class="caption1">'.$name2.' has created a mission targetting you!</span>';
				break;
			case 403:
				echo '<td colspan="2" class="caption1">'.$name2.' has completed a mission on you set by '.$name3.'.</span>';
				break;
			case 404:
				echo '<td colspan="2" class="caption1">You completed a mission targetting on '.$name2.' by '.$name3.'.</span>';
				break;
			case 405:
				echo '<td colspan="2" class="caption1">'.$name2.' has completed your mission targetting '.$name3.'.</span>';
				break;

			case 501:
				echo '<td colspan="2" class="caption1">'.$name2.':';
				if($new[cash1] != 0)
					echo '<li>'.($new[cash1]>0?'gave':'took').' $'.commas(abs($new[cash1])).' '.($new[cash1]>0?'to':'from').' the clan treasury.</li>';
				if($new[food1] != 0)
					echo '<li>'.($new[food1]>0?'gave':'took').' '.commas(abs($new[food1])).' food '.($new[food1]>0?'to':'from').' the clan granary.</li>';
				if($new[runes1] != 0)
					echo '<li>'.($new[runes1]>0?'gave':'took').' '.commas(abs($new[runes1])).' runes '.($new[runes1]>0?'to':'from').' the clan loft.</li>';
				if($new[cash1] == 0 && $new[food1] == 0 && $new[runes1] == 0)
					echo '<li>messed around with the treasury, but made no net change at all.</li>';
				echo '</span>';
				break;
			case 502:
				echo '<td colspan="2" class="caption1">You:<br />';
				if($new[cash1] != 0)
					echo '<li>'.($new[cash1]>0?'gave':'took').' $'.commas(abs($new[cash1])).' '.($new[cash1]>0?'to':'from').' the clan treasury.</li>';
				if($new[food1] != 0)
					echo '<li>'.($new[food1]>0?'gave':'took').' '.commas(abs($new[food1])).' food '.($new[food1]>0?'to':'from').' the clan granary.</li>';
				if($new[runes1] != 0)
					echo '<li>'.($new[runes1]>0?'gave':'took').' '.commas(abs($new[runes1])).' runes '.($new[runes1]>0?'to':'from').' the clan loft.</li>';
				if($new[cash1] == 0 && $new[food1] == 0 && $new[runes1] == 0)
					echo '<li>messed around with the treasury, but made no net change at all.</li>';
				echo '</span>';
				break;

			case 601:
				$wtime = sqlsafeeval("SELECT warset_time FROM $playerdb WHERE num=$id2;");
				$peace = round(($wtime - time()) / 3600);
				echo '<td colspan="2" class="caption1">'.$name2.' has declared war on you! Neutrality can be declared in '.$peace.' hours.</span>';
				break;
			case 602:
				echo '<td colspan="2" class="caption1">'.$name2.' has declared neutrality with you.</span>';
				break;
			case 603:
				$wtime = sqlsafeeval("SELECT warset_time FROM $playerdb WHERE num=$id1;");
				$peace = round(($wtime - time()) / 3600);
				echo '<td colspan="2" class="caption1">You have declared war on '.$name2.'! Neutrality can be declared in '.$peace.' hours.</span>';
				break;
			case 604:
				echo '<td colspan="2" class="caption1">You have declared neutrality with '.$name2.'.</span>';
				break;
			case 605:
				$ptime = sqlsafeeval("SELECT peaceset_time FROM $playerdb WHERE num=$id2;");
				$neut = round(($ptime - time()) / 3600);
				echo '<td colspan="2" class="caption1">'.$name2.' has declared peace with you! Neutrality can be declared in '.$neut.' hours.</span>';
				break;
			case 606:
				$ptime = sqlsafeeval("SELECT peaceset_time FROM $playerdb WHERE num=$id1;");
				$neut = round(($ptime - time()) / 3600);
				echo '<td colspan="2" class="caption1">You have declared peace with '.$name2.'! Neutrality can be declared in '.$neut.' hours.</span>';				
				break;		
		
		} 

		echo '<br /><br /><table width=100%><tr><td class=aleft>';
		echo round($hours, 1).' hours ago';
		echo '</td>';
		echo '<td><div align=right>'.$new[num].' Times</div></table><td></tr>';
	}

	echo '</table>';
	return 1;
} 

?>
