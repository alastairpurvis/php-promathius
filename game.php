<?
	define("PROMATHIUS", true);
	ob_start("ob_gzhandler");
	
	$game_root_path = "game";
	$data_root_path = "data";
	
	// These three must be included from our own code, so as to make the rest work
	include ($game_root_path."/server-config.php");// This below file manually tries to see if local/config.php exists
	require_once ($game_root_path."/server-env.php");// This makes 'local' work
	
	// From here on they can all be local
	include ($game_root_path.'/ip.php');

	include('game/includes/smarty/Smarty.class.php');
	global $tpl;
	$tpl = new Smarty;
	$tpl->caching = false;
	$tpl->compile_dir = './game/cache/templates/';
	
	include("game/includes/login_func.php");

	ob_end_flush();
?>
