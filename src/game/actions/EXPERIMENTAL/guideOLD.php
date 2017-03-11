<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
require_once($game_root_path."/funcs.php");
$tpl->assign('guide', 1);

if(!defined("PROMATHIUS"))
	die(" ");

	include($game_root_path.'/header.php');
	// Load the game graphical user interface
initGUI();
	$attach = $authstr;

/*
        "view"          => 3,
        "info"          => 3,
        "links"         => 3,
        "edit"          => 2,
        "calendar"      => 2,
        "upload"        => 2,
        "view/SecretPage" => 1,
        "delete"        => 1,
        "control"       => 0,
        "admin"         => 0,
        "*"             => 2,   #- anything else require_onces this ring level
*/

$ewiki_ring = 3;
if($users[disabled] == 2)
	$ewiki_ring = 0;


switch($_GET['section']) {
	case '':	
	case 'login':	
	case 'guide':	
	case 'features':
		$section = 'Table of Contents';
		break;
	default:
		$section = $_GET['section'];
}

error_reporting(E_ALL);
$attach = str_replace('&amp;', '&', $attach);	/** Ewiki kludge **/
define("EWIKI_SCRIPT", "?guide$attach&section=");
require_once($game_root_path."/lib/ewiki.php");
$faf_old_action = $action;
$content = ewiki_page($section);
$action = $faf_old_action;



//echo '<table><td style="padding: 3px"><table class="forumline" width="100%" cellspacing="0" cellpadding="3" align="center">
//<thead>
//	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
//	<tr>
//		<td align="center" class="forumheader-mid">The Imperial Manuals</td>
//	</tr></table></caption>
//</thead><tbody>
//<td class="row1" rowspan=2 style="text-align: left; padding-left: 15px;  padding-right: 15px; font-size: 12px">';
//echo $content;
//echo '</table></table>';


endScript("Sorry, but the game guide is under construction.");
?>
