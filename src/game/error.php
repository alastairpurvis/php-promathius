<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
include($game_root_path.'/header.php');
// Load the game graphical user interface
initGUI();
endScript('Sorry, that page does not exist.');
?>
