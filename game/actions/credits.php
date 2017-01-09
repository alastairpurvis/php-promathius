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

$tpl->display('credits.tpl');
?>
