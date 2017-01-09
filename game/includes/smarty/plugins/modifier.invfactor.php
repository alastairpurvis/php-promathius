<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty invfactor modifier plugin
 *
 * Type:     modifier<br />
 * Name:     invfactor<br />
 * Purpose:  modify a number based on the game factor's inverse
 * @param string
 * @return string
 */
function smarty_modifier_invfactor($str) {
	global $config;

	$num = str_replace(',', '', $str);
	$num = round($num / $config['game_factor']);
	return commas($num);
}

?>
