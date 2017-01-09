<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');

if($users[clan] == 0)
	endScript("You are not in a clan!");

define('CLAN', $users[clan]);
define('SCRIPT', 'clanmarketbuy');
define('SCRIPT2', 'clanmarketsell');

include("pubmarketsell.php");
?>
