<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
//require_once("funcs.php");
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();

if ($do_disablejs)
{
	$users['nojs_nag'] = 1;
	saveUserData($users,"nojs_nag");
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='The Javascript notifier was disabled.' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
}
if ($do_enablejs)
{
	$users['nojs_nag'] = 0;
	saveUserData($users,"nojs_nag");
	mysql_query("UPDATE ".$config['prefixes'][1]."_players SET new_error='The Javascript notifier was re-enabled.' WHERE num='$users[num]';");
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	header("Location: ?" . $action); 
	endScript();
}

$tpl->display('javascript.tpl');
?>
