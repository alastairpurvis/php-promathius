<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

if($users[clan] == 0)
	{
		// Load the game graphical user interface
initGUI();
		endScript("You are not in a clan!");
	}

define('CLAN', $users[clan]);
define('SCRIPT', 'clanmarketbuy');
define('SCRIPT2', 'clanmarketsell');

require_once($game_root_path.'/header.php');
include($game_root_path."/actions/pubmarketbuy.php");
?>
