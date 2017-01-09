<?
	// Page Generation Header
	$time = microtime();
	$time = explode(" ", $time);
	$time = $time[1] + $time[0];
	$start = $time;

	define("PROMATHIUS", true);
	ob_start("ob_gzhandler");
	
	$game_root_path = "game";
	$data_root_path = "data";
	
	// These three must be included from our own code, so as to make the rest work
	include ($game_root_path."/server-config.php");// This below file manually tries to see if local/config.php exists
	require_once ($game_root_path."/server-env.php");// This makes 'local' work
	
	// From here on they can all be local
	include ($game_root_path.'/ip.php');
	include ($game_root_path.'/includes/smarty/Smarty.class.php');
	
	global $tpl;
	$tpl = new Smarty;
	$tpl->caching = false;
	$tpl->compile_dir = './'.$game_root_path.'/cache/templates/';

	// Trim whitespace
 	$tpl->load_filter('output','trimwhitespace'); 
	
	global $action;
	$uri = urldecode($_SERVER['REQUEST_URI']);
	$action = substr($uri, strpos($uri, '?') + 1);
	$p = strpos($action, '&');
	if ($p > 0)
	    $action = substr($action, 0, $p);
	
	$action = preg_replace("/[^a-z0-9_]/", "", strtolower($action));
	
	if (!stristr($config[sitedir], $_SERVER['HTTP_HOST']))
	{
	    Header("Location: $config[sitedir]");
	    exit;
	}
	
	if ($config['pconnect'])
	    $link = @mysql_pconnect($dbhost, $dbuser, $dbpass);
	else
	    $link = @mysql_connect($dbhost, $dbuser, $dbpass);
	
	if (!$link)
	{
	    print "The database is currently unavailable. Please try again later.\n";
	    exit;
	}
	
	if(mysql_select_db($dbname))
	{
		mysql_select_db($dbname);
	}
	else
	{
		die("The server is experiencing technical difficulties. Please try again later.\n");
	}
	
	require_once ($game_root_path."/sql-setup.php");
	
	if ($action == "game")
	    $action = "main";
	if (empty($action))
	    $action = "main";
	
	// Find the name of this server based on the extension
	$currentServer = $_SERVER["SCRIPT_NAME"]; 
    $parts = Explode('/', $currentFile); 
    $currentServer = $parts[count($parts) - 1]; 
	if($currentServer = 'index.php')
	{
		$currentServer = "";
	}
	
	// Determine the page content
	$file = $game_root_path."/actions/" . $action . ".php";
	$request_url = $mainurl . $uri;
	$sitedir = $config['sitedir'];
	if ($sitedir == $request_url || $sitedir . "index.php" == $request_url)
	{
	    $file = $game_root_path."/actions/main.php";
	}
	elseif (!is_file($file) || $file == 'home.php')
	{
	    $action = isset($_POST['the_action']) ? $_POST['the_action'] : '';
	    $file2 = $action . '.php';
	    if (!is_file($file2))
	        $file = $game_root_path."/error.php";
	    else
	        $file = $file2;
	}
	$action = substr($file, 13, -4);
	$GAME_ACTION = $action;
	$tpl->assign('action', $action);
	
	require_once ($game_root_path."/funcs.php");
	include ($game_root_path."/lib/ranks.php");
	include ($game_root_path."/lib/raffle.php");
	include ($game_root_path."/lib/maintenance.php");

	include ($file);

	endScript();
	ob_end_flush();
?>
