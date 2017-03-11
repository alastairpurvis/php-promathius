<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty gamefactor modifier plugin
 *
 * Type:     modifier<br />
 * Name:     gamefactor<br />
 * Purpose:  modify a number based on the game factor
 * @param string
 * @return string
 */
function smarty_modifier_gamefactor($str) {
	global $config;

	$num = str_replace(',', '', $str);
	$num = floor($num * $config['game_factor']);
	return commas($num);
}

?>
