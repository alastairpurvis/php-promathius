<?
	// This file transfers the user into the game
	define("PROMATHIUS", true);
	ob_start("ob_gzhandler");
	
	// These three must be included from our own code, so as to make the rest work
	include ("../server-config.php");// This below file manually tries to see if local/config.php exists
	require_once ("../server-env.php");// This makes 'local' work
	
	// From here on they can all be local
	include ('../ip.php');

	include('../includes/smarty/Smarty.class.php');
	global $tpl;
	$tpl = new Smarty;
	$tpl->caching = false;
	$tpl->compile_dir = '../cache/templates/';
	
	include("../includes/login_func.php");

	ob_end_flush();
?>
