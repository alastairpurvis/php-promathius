<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

if (!defined('SERVER')) {
	if (isset($_GET['srv'])) {
		$s = $_GET['srv'];
		define('SERVER', $s);
	} else if (isset($_GET['auth'])) {
		$au = explode("\n", @base64_decode($_GET['auth']));
		$s = $au[3];
		define('SERVER', $s);
	} else {
		define('SERVER', 1);
	} 
} 

if(empty($server))
	$server = SERVER;

if(file_exists("local/".$game_root_path."/config.php"))
	include("local/".$game_root_path."/config.php");
else
	include($game_root_path."/config.php");

if(empty($config['game_factor']))
	$config['game_factor'] = 1;

$dateformat = $config['dateformat'];
$tpldir = $config['tpldir'];

$maxtickets = $config['maxtickets'];
$tick_curjp = 0;
$tick_lastjp = 1;
$tick_lastnum = 2;
$tick_lastwin = 3;
$tick_jpgrow = 4;

$atknames = $config['atknames'];
$atkdescr = $config['atkdescriptions'];
$config['wpl'] = 100;
$config['dual_game'] = 0;
$config['main'] = '';
$mainurl = $config['mainurl'];
$config['chat_url'] = 'http://'.$config['chathost'].':'.$config['chatport'].'/';

$config['food'] = $config['food_sell'];


if(!isset($config['nolimit_mode']))
	$config['nolimit_mode'] = 0;
if(!isset($config['nolimit_table']))
	$config['nolimit_table'] = 0;

$nolimitdb = $config['nolimit_table'];

$gamename = $config['gamename_short'];
$gamename_full = $config['gamename_full'];

$signupsclosed = $config['signupsclosed'];
$lockdb = $config['lockdb'];
$lastweek = $config['lastweek'];

$turnsper = $config['turnsper'];
$perminutes = $config['perminutes'];
$turnoffset = $config['turnoffset'];

$dbhost = $config['dbhost'];
$dbuser = $config['dbuser'];
$dbpass = $config['dbpass'];
$dbname = $config['dbname'];
$version = $config['version'];

$servers = $config['servers'];
$prefixes = $config['prefixes'];

$config['servname'] = $servers[$server];
$prefix = $prefixes[$server];  
if($prefix == "")
	die(" ");

$time = time();
$datetime = date($dateformat);               

$racep = array('rname', 'offense', 'defence', 'bpt', 'costs', 'magic', 'ind', 'pci', 'expl', 'mkt', 'food', 'runes', 'farms', 'nomove', 'nogate', 'nokill', 'nospy', 'noheal', 'noprod', 'nogold', 'norunes', 'noblast', 'noshield', 'nostorm', 'nostruct', 'nofood', 'noexplore', 'nopeasant', 'nofight', 'norob', 'nosteal');
$erap = array('ename', 'peasants', 'nfood', 'ncash', 'nrunes', 'wizards', 'homes', 'shops', 'industry', 'barracks', 'labs', 'labs_single', 'nfarms', 'towers', 'empire');
foreach($config['troop'] as $num => $mktcost) {
	$racep[] = "troop$num";
	$racep[] = "troop$num".'alt';
	$erap[] = "o_troop$num";
	$erap[] = "d_troop$num";
}

$last_pair_global = array();
$etags = array();
$rtags = array();

for($r=1; $r<=$config['races']; $r++) {
	for($e=1; $e<=$config['eras']; $e++) {
		$num = 100*$e + $r;
		if(!isset($config['er'][$num]))
			$config['er'][$num] = array();

		for($i=0; $i<2; $i++) {
			if($i == 0) {
				$const = 'race';
				$id = $r;
				$iter = $racep;
			} else {
				$const = 'era';
				$id = $e;
				$iter = $erap;
			}

			foreach($iter as $attr) {
				if(!empty($config['er'][$num][$attr])) {
					$last_pair[$const][$id][$attr] = $config['er'][$num][$attr];
					$last_pair_global[$const][$attr] = $config['er'][$num][$attr];
				} else if(!empty($last_pair[$const][$id][$attr])) {
					$config['er'][$num][$attr] = $last_pair[$const][$id][$attr];
					$last_pair_global[$const][$attr] = $last_pair[$const][$id][$attr];
				} else if(!empty($last_pair_global[$const][$attr])) {
					$config['er'][$num][$attr] = $last_pair_global[$const][$attr];
					$last_pair[$const][$id][$attr] = $last_pair_global[$const][$attr];
				}
			}

			if($i == 0)
				$rtags[$r] = $config['er'][$num]['rname'];
			else
				$etags[$e] = $config['er'][$num]['ename'];
		}
	}
}

$styles = array();
$stylenames = array();
$adminstyles = array();
$templates = array();
$styleCount = 1;
$defaultTpl = $config['tpldir'];
$lang = array();
$lang = $config['lang'];

foreach($config['styles'] as $num => $data) {
	global $styles, $stylenames, $templates, $styleCount, $defaultTpl;
	$styleCount = $num;
	$styles[$styleCount] = $data['file'];
	$stylenames[$styleCount] = $data['name'];
	if($data['admin'] == 1)
		$adminstyles[$styleCount] = 1;
	if(!empty($data['dir']))
		$templates[$styleCount] = $data['dir'];
	else
		$templates[$styleCount] = $defaultTpl;
	$styleCount += 1;
}


//get-post-server (we choose to order our globals....)
foreach ($_GET as $var => $value) { $$var = $value; }
foreach ($_POST as $var => $value) { $$var = $value; }
foreach ($_SERVER as $var => $value) { $$var = $value; }


require_once($game_root_path.'/constants.php');


$tbl = array();
$tbl['bounty']		=	'bounties';
$tbl['clan']		=	'clan';
$tbl['clanmarket']	=	'clanmarket';
$tbl['era']		=	'eras';
$tbl['race']		=	'races';
$tbl['lottery']		=	'lottery';
$tbl['market']		=	'market';
$tbl['message']		=	'messages';
$tbl['news']		=	'news2';
$tbl['player']		=	'players';
$tbl['stock']		=	'stockmarket';
$tbl['aim']		=	'aim_notls';
$tbl['script']		=	'code';
$tbl['cron']		= 	'cron';

foreach($tbl as $var => $value) {
	$name = $var.'db';
	global $$name;
	$$name = $prefix.'_'.$value;
}

$cookie = array();
foreach($_COOKIE as $var => $value) {
	$len = strlen($prefix) + 1;
	if(substr($var, 0, $len) == $prefix.'_') {
		$name = substr($var, $len);
		$cookie[$name] = $value;
	}
}

$config['chatdomain'] = $_SERVER['SERVER_NAME'];
$config['chathost'] = $_SERVER['SERVER_NAME'];
?>
