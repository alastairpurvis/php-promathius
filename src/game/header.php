<?
	if ( !defined('PROMATHIUS') )
		die("Hacking attempt");
		
	// Before loading any user data, update other empires that have been ruled for over 29 years to avoid cheating
	$model_time = sqlsafeeval("SELECT year FROM ".$config['prefixes'][1]."_server;") * $config['seasontime'] +
	    sqlsafeeval("SELECT value FROM ".$config['prefixes'][1]."_server;") - $config['ruletime'] * $config[
	    'seasontime'];
	
	$result = mysql_query("SELECT num FROM $playerdb WHERE ((startyear * '$config[seasontime]') + startday) < $model_time
		 AND land > 0 AND disabled != 1");
	
	for ($i = 0; $i < mysql_numrows($result); $i++)
	{
	    $id = mysql_result($result, $i, "num");
	    mysql_query("UPDATE $playerdb SET disabled=1, land=0, username = 'DEAD', name = 'DEADSPIRIT', death = 'time' WHERE num={$id}");
	    // If the user had missions targetting him, delete them, for he is dead
	    $s_num = sqlsafeeval("SELECT s_num FROM ".$config['prefixes'][1]."_bounties WHERE t_num='$id';");
	    $newbountynum = sqlsafeeval("SELECT num_bounties FROM ".$config['prefixes'][1]."_players WHERE num='$s_num';") - 1;
	    mysql_safe_query("UPDATE ".$config['prefixes'][1]."_players SET num_bounties = '$newbountynum'  WHERE num='$s_num';");
	    mysql_safe_query("DELETE FROM ".$config['prefixes'][1]."_bounties WHERE t_num='$id';");
	}

	require_once ($game_root_path."/funcs.php");
	$root = 0;
	$suid = 0;
	$admin = false;
	require_once ($game_root_path."/lib/authentication.php");
	require_once ($game_root_path."/lib/status.php");
	randomize();
	$basehref = $config[sitedir];
	
	// Update the game year e.g. 369 BC
	include $game_root_path.'/lib/years.php';
	$years_left = $config['ruletime'] - ($users['startyear'] + sqlsafeeval(
	    "SELECT year FROM ".$config['prefixes'][1]."_server;"));
	
	// FORMULA: (29 * 3) + (((-380 * 3) - 2) + ((-351 * 3) - 3))
	$days_left = (($config['ruletime'] * $config['seasontime'] + ((($users[
	    'startyear'] * $config['seasontime']) - $users['startday']) - ((sqlsafeeval(
	    "SELECT year FROM ".$config['prefixes'][1]."_server;") * $config['seasontime']) - sqlsafeeval(
	    "SELECT season FROM ".$config['prefixes'][1]."_server;")))));
	
	$years_remaining = round((($config['ruletime'] * $config['seasontime'] + ((($users
	    ['startyear'] * $config['seasontime']) - $users['startday']) - ((sqlsafeeval(
	    "SELECT year FROM ".$config['prefixes'][1]."_server;") * $config['seasontime']) - sqlsafeeval(
	    "SELECT season FROM ".$config['prefixes'][1]."_server;")))) / $config['seasontime']));
	
	$years_remaining_acc = (($config['ruletime'] * $config['seasontime'] + ((($users[
	    'startyear'] * $config['seasontime']) - $users['startday']) - ((sqlsafeeval(
	    "SELECT year FROM ".$config['prefixes'][1]."_server;") * $config['seasontime']) - sqlsafeeval(
	    "SELECT season FROM ".$config['prefixes'][1]."_server;")))) / $config['seasontime']);
	
	$current_year = sqlsafeeval("SELECT year FROM ".$config['prefixes'][1]."_server;");
	$current_seasonid = sqlsafeeval("SELECT season FROM ".$config['prefixes'][1]."_server;") - 1;
	$current_season = $config['seasonnames'][$current_seasonid];
	$actual_year = $current_year;

	if ($current_year < 0)
	{
	    $current_year = $current_year * -1;
	    $year_acronym = $config['lang']['BCE'];
	}
	else
	    $year_acronym = $config['lang']['CE'];
	$turnsleft = $config[protection] - $users[turnsused] + 1;
	
	// Create turn variables for he dynamic turn updater script
	$nextturnmin = $perminutes;
	$rawseconds = $perminutes*60 - floor($perminutes)*60;
	$nextturnseconds = $perminutes*60 - ((date("i")*60 + date("s") + $turnoffset) % ($perminutes*60));
	$nextturnmin = floor($nextturnseconds/60);
	$nextturnseconds = $nextturnseconds - $nextturnmin*60;
	$nextturnmin = floor($nextturnmin);
	$perminutefl = floor($perminutes);
	
	$tpl->assign('nextturnmin', $nextturnmin);
	$tpl->assign('nextturnseconds', $nextturnseconds);
	$tpl->assign('rawseconds', $rawseconds);
	$tpl->assign('perminutefl', $perminutefl);
	$tpl->assign('perminutes', $perminutes);
	$tpl->assign('perminutesplural', plural($perminutes,minutes,minute));
	$tpl->assign('turnsperplural', plural($turnsper,turns,turn));
	$tpl->assign('turnsplural', "turns");
	$tpl->assign('turnsper', $turnsper);
	$tpl->assign('maxturns', $config[maxturns]);
	///////////////////////////////////////////
	
	$tpl->assign('year', $current_year);
	$tpl->assign('season', $current_season);
	$tpl->assign('year_acronym', $year_acronym);
	$tpl->assign('years_left', $years_remaining);
	$tpl->assign('years_left_num', $years_remaining_acc);
	$tpl->assign('days_left', $days_left);
	
	// Include the current news headlines for the side menu
	include $game_root_path.'/lib/headlines.php';
	
	// Determine if the user is in a clan for the side menu
	$tpl->assign('inclan', $users[clan]);
	$tpl->assign('clantag', $uclan[tag]);
	$tpl->assign('clanname', $uclan[name]);
	
	// Determine if the user is a founder, assistant or diplomat for the management link on the side menu
	if (($uclan[founder] == $users[num]) || ($uclan[asst] == $users[num]))
	    $tpl->assign('clanmanager', 1);
	if (($uclan[fa1] == $users[num]) || ($uclan[fa2] == $users[num]))
	    $tpl->assign('clandiplomat', 1);
	if (($uclan[tres_open] == '0') && ($uclan[founder] != $users[num]) && ($uclan[
	    asst] != $users[num]))
	    $tpl->assign('closetreasury', 1);
	
	// Manage error messages
	$current_Error = sqlsafeeval("SELECT new_error FROM ".$config['prefixes'][1]."_players where num='$users[num]';");
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET old_error='$current_Error' WHERE username='$userdata[username]';");
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='' WHERE username='$userdata[username]';");
	$tpl->assign('err', $current_Error);
	
	// Determine whether or not the user wants to be seen online
	if ($userdata['user_allow_viewonline'] == 1)
	    mysql_safe_query("UPDATE $playerdb SET hide=1 WHERE num=$users[num];");
	else
	    mysql_safe_query("UPDATE $playerdb SET hide=0 WHERE num=$users[num];");

	
	$tpl->assign('authcode', $authcode);
	$tpl->assign('authstr', $authstr);
	$tpl->assign('sitedir', $config['sitedir']);
	$tpl->assign('unum', $users['num']);
	$tpl->assign('root', $root);
	
	$tpl->assign('gamename', $gamename);
	$datadir = "data/";
	$tpl->assign('dat', $datadir);
	$tpl->assign('gamename_full', $gamename_full);

	include ($game_root_path."/lib/compressor.php");
	$tpl->assign('scripts', $scripts_cache . '' . $scriptfile);
	$tpl->assign('styles', $styles_cache . '' . $stylefile);


	
	global $starttime;
	$starttime = getmicrotime();
		
	Header("Pragma: no-cache");
	Header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
	
	$i = 1;
	$userlist = mysql_safe_query("SELECT num FROM $playerdb WHERE disabled != 2 AND disabled != 3 AND land > 0 ORDER BY networth DESC;");
	while ($user = mysql_fetch_array($userlist))
	      mysql_safe_query("UPDATE $playerdb SET rank=" . $i++ . " WHERE num=$user[num];");
	
	$users[page] = 'game';
	saveUserData($users, "page");
	
	if ($admin)
	{
	    if (isset($_POST['do_updatenet']))
	    {
	        $userlist = mysql_safe_query("SELECT num FROM $playerdb;");
	        while ($user = mysql_fetch_array($userlist))
	        {
	            $users = loadUser($user[num]);
	            mysql_safe_query("UPDATE $playerdb SET networth=" . getGreatness($users) .
	                " WHERE num=$users[num];");
	        }
	    }
	    if (isset($_POST['do_setuser']))
	    {
	        if ($whichuser == "")
	            $su = 1;
	        else
	            $su = $whichuser;
	
	        loadSuid($su);
	        $superuser = loadUser($root);
	        makeAuthCode($root, $superuser[password], $su, SERVER, $usecookie, $superuser[
	            rsalt]);
	    }
	    $admin = 1;
	    $tpl->assign('adminpanel', 'true');
	}
	
	if ($users['basehref'] != '')
	    $basehref = $users['basehref'];
	$tpl->assign('basehref', $basehref);
	$tpl->assign('stylename', getstyle());
	set_incl_path(getTplDir());
	
	$cnd = '';
	if ($users['condense'])
	    $cnd = ' checked';
	

	$tpl->assign('condense', $cnd);
	$tpl->assign('main', $config['main']);
	$tpl->assign('uerastr', $uera);
	$tpl->assign('uracestr', $urace);
	$tpl->assign('troops', $config[troop]);
	$ctags = loadClanTags();
	
	$tpl->assign('servname', $config['servname']);
	$tpl->assign('empire', $users[empire]);
	$tpl->assign('num', $users[num]);
	$tpl->assign('username', $userdata[username]);
	$tpl->assign('news', $config['news']);
	$tpl->assign('gameversion', $config['version']);
	$tpl->assign('lang', $config['lang']);
	
	if ($users[industry] > 0)
	{
	    $hasbarracks = 1;
	    $tpl->assign('hasbarracks', 1);
	}
	if (getBuildings('runes', $users) > 0)
	{
	    $hasacademy = 1;
	    $tpl->assign('hasacademy', 1);
	}
	
	// Check for new PMs and update the navigation bar
	$phpbbuserdb = $config[forum_prefix]."_users";
	$no_newmessages = sqlsafeeval("SELECT user_new_privmsg FROM $phpbbuserdb WHERE empire_id='$users[empire_id]';");
	if ($no_newmessages > 1)
	    $tpl->assign('pm_status', '' . $no_newmessages . ' new messages');
	else
	{
	    if ($no_newmessages == 1)
	        $tpl->assign('pm_status', '' . $no_newmessages . ' new message');
	    else
	        $tpl->assign('pm_status', 'Private messages');
	}
	
	include ($game_root_path.'/lib/gui.php');
	
	// Load a random quote for the footer
	$file = file('data/ini/quotes.ini');
	$quotes = array();
	$authors = array();
	$count = 0;
	foreach($file as $k => $v)
		{
		if(preg_match("#^\r?\n$#", $v) == 0)
			{
			$count++;
			
			if($count % 2 == 1)
				{
				preg_match("#quote\:(.+)\r?\n?#i", $v, $matches);
				$quotes[] = trim($matches[1]);
				}
			else
				{
				preg_match("#author\:(.+)\r?\n?#i", $v, $matches);
				$authors[] = trim($matches[1]);
				}
			}
		}
	$rnd = array_rand($quotes);
	$rnd_quote = $quotes[$rnd];
	$rnd_author = $authors[$rnd];
	$tpl->assign('quote', $rnd_quote);
	$tpl->assign('author', $rnd_author);
	
	
	$online_limit = $time - $config['online_warn'] * 60;
	if ($users[newstime] > $online_limit)
	    $online_limit = $users[newstime];
	$id2 = sqlsafeeval("SELECT id2 FROM $newsdb WHERE ((code>200 AND code<300) OR (code>300 AND code<400)) AND time>$online_limit AND id1=$users[num] ORDER by time DESC LIMIT 0,1;");
	if ($id2)
	{
	    $onlined = true;
	    $name2 = '<a class=proflink href=?profile&target=' . $id2 . $authstr . '>' .
	        sqlsafeeval("SELECT empire FROM $playerdb WHERE num=$id2;") . '</a>';
	    $tpl->assign('onl_e', $name2);
	}
	else
	{
	    $onlined = false;
	}
	
	$tpl->assign('onlined', $onlined);
	doStatusBar(false);
	// Load all statistics
	
	if (($action != "delete"))
	{
	    switch ($users[disabled])
	    {
	        case 0:
	            if ($users[land] == 0)
	            {
	                if ($action == "messages" || $action == "scores" || $action == "sentmail" || $action ==
	                    "news")
	                    break;
	                $tpl->display('header.tpl');
	                $tpl->assign('msg_title', 'Your Empire has Fallen');
	                $users[idle] = $time;
	                $users[disabled] = 1;
	                if (!$suid)
	                    saveUserData($users, "idle disabled");
	                $deathmsg .=  'You arrive at your ' . $uera[empire] .
	                    ', only to find it is in ruins.<br />' . '';
	                $news = sqlsafeeval("SELECT id2 FROM $newsdb WHERE id1=$users[num] AND code=399;");
	                $enemy_empire = sqlsafeeval("SELECT empire FROM $playerdb WHERE num=$news;");
	                if ($news != '')
	                {
	                   $deathmsg .=  'As <b>' . $enemy_empire . '</b> delivered a final blow, your ' . $uera
	                        [empire] . ' collapsed.<br /><br />';
	
	                }
	                $deathmsg .=  'Perhaps in the next life we shall have better luck?<br /><br />';
	                //	printNews($users);
	                $deathmsg .=  "<a href='ucp.php?mode=delempire'>Exile and Leave</a></table>";
	                //$tpl->assign('quote', '');
					$tpl->assign('death_msg', $deathmsg);
	                $tpl->display('error_alt.tpl');
	                endScript("");
	            }
	            break;
	        case 1:
	            if ($users[land] == 0 && $users[death] != 'time' || $users[land] == 0 && $years_remaining_acc >
	                0 && $users[death] != 'time')
	            {
	                if ($action == "messages" || $action == "scores" || $action == "sentmail" || $action ==
	                    "news")
	                    break;
	                $tpl->display('header.tpl');
	                $tpl->assign('msg_title', 'Your Empire has Fallen');
	                $deathmsg .= '<b>Your ' . $uera[empire] . ' has been destroyed.</b><br />' .
	                    'There is nothing more to do here.<br /><br />';
	                //  printNews($users);
	                $deathmsg .= "<a href='ucp.php?mode=delempire'>Exile and Leave</a></table>";
					$tpl->assign('death_msg', $deathmsg);
						                $tpl->display('error_alt.tpl');
	                endScript("");
	
	            }
	            else
	                if ($years_remaining_acc <= 0 && $users[death] == 'time')
	                {
	                    if ($action == "messages" || $action == "scores" || $action == "sentmail" || $action ==
	                        "news")
	                        break;
	                    $tpl->display('header.tpl');
	                    $tpl->assign('msg_title', $users[empire]);

	                    $users[disabled] = 1;
	                    $users[idle] = $time;
	                    if (!$suid)
	                        saveUserData($users, "idle disabled");
	                    $deathmsg .= 'Congratulations, you have successfully ruled your ' . $uera[empire] .
	                        ' for ' . $config['ruletime'] . ' years!<br />' .
	                        "You and your people's legend shall live on in song and history for all time to come.<br /><br /><br />
							<a href='ucp.php?mode=delempire'>Continue to the afterlife</a>";
						$tpl->assign('death_msg', $deathmsg);
	                    $tpl->display('error_alt.tpl');
	                    endScript("");
	                }
	            break;
	        case 2:
	            break;
	        case 3:
	            $tpl->display('header.tpl');
	            TheStart;
	            if ($users[ismulti])
	                print "This account has been disabled due to usage of multiple accounts.<br />\n";
	            else
	                print "This account has been disabled due to cheating.<br />\n";
	            endScript("Please contact $config[adminemail] to explain your actions and possibly regain control of your account.");
	            break;
	        case 4:
	            $tpl->display('header.tpl');
	            TheStart;
	            endScript("Your account has been marked for deletion and will be erased shortly. Thanks for playing!");
	            break;
	    }
	    if ($root == $suid)
	    {
	        if ($users[hide])
	            $users[online] = 0;
	        else
	            $users[online] = 1;
	        $users[IP] = realip();
	        $users[idle] = $time;
	        saveUserData($users, "online IP idle", true);
	    }
	}
	
	if (in_array($action, $config['disabled_pages']))
	{
	    $tpl->display('header.tpl');
	    // Load the game graphical user interface
initGUI();
	    endScript("Sorry, that page is disabled.");
	}
	
	if (is_on_vacation($users))
	{
	    $msg = "This account is in vacation mode and cannot be played for another " .
	        vac_hours_left($users) . " hours.";
	
	    if (!in_array($GAME_ACTION, $config['vacation_pages']))
	    {
	        endScript($msg);
	    }
	    else
	    {
	        echo "$msg<br /><br />";
	    }
	}
	else
	{
	    $users[vacation] = 0;
	    saveUserData($users, "vacation");
	    $tpl->display('header.tpl');
	}
	
	if ($users[loggedin] == 0)
	    header("Location: welcome.php");

?>
