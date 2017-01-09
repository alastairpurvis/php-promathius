<?
	// Check that the script is not being accessed directly
	if ( !defined('PROMATHIUS') )
	{
		die("Hacking attempt");
	}
	$abs_data_path = "data";
	$abs_game_path = "game";

	// Compress Script Files
	$script_dir = $abs_data_path."/scripts/compile/";
	$scripts_cache = $abs_game_path."/cache";
	
	require_once($game_root_path.'/includes/compressor.php');

	$compressJS = new Minify(TYPE_JS);
	$scriptlist = parse_ini_file($data_root_path."/scripts/list.ini");
	
	foreach ($scriptlist as $num => $name)
	{
		$compressJS->addFile(array(
			$script_dir.$name,
		));
	}
	
	$scriptfile = $compressJS->combine(0);
	
	// Compress CSS
	$style_dir = $abs_data_path."/styles/compile";
	$styles_cache = $abs_game_path."/cache";
	
	$compressCSS = new Minify(TYPE_CSS);
	$stylelist = parse_ini_file($data_root_path."/styles/list.ini");
	
	foreach ($stylelist as $num => $name)
	{
		$compressCSS->addFile(array(
			$style_dir.'/'.$name,
		));
	}
	
	$stylefile = $compressCSS->combine(1);
?>