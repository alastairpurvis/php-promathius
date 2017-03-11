<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

require_once($game_root_path."/header.php");
initGUI();

include('game/lib/news-engine.php');
?>