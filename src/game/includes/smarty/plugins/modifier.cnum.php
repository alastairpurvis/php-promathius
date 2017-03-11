<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br />
 * Name:     nl2br<br />
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to <<br />>
 * Input:<br />
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|nl2br}
 * @link http://smarty.php.net/manual/en/language.modifier.nl2br.php
 *          nl2br (Smarty online manual)
 * @version  1.0
 * @author	 Monte Ohrt <monte@ispi.net>
 * @param string
 * @return string
 */
function smarty_modifier_cnum($string)
{
	$amt = $string;
        $pos = "+";
        $neg = "-";
        if ($nosign)
                $neg = $pos = "";
	$str = "<span class=";
        if ($amt < 0)
		$str .= '"cbad">'.$neg.$prefix;
        elseif ($amt > 0)  
                $str .= '"cgood">'.$pos.$prefix;
        else    $str .= '"cneutral">';
        $str .= commas(abs($amt));
	$str .= "</span>";
	return $str;
}

/* vim: set expandtab: */

?>
