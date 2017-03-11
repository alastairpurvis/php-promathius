<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_textarea} function plugin
 *
 * Type:     function<br />
 * Name:     html_textarea<br />
 * @param Smarty
 * @return string
 */

$hacnt = 0;
$inijs = "<script language=\"Javascript1.2\"><!-- // load htmlarea
_editor_url = \"\";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split(\"MSIE\")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
 document.write('<scr' + 'ipt src=\"' +_editor_url+ 'editor.js\"');
 document.write(' language=\"Javascript1.2\"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
\/\/ --></script>";

function smarty_function_html_textarea($params, &$smarty)
{
	global $hacnt, $inijs;
	$hacnt++;
	$conts = '';
	$rows = '';
	$cols = '';
	$style = '';
	$html = '';
	$id = '';
	$name = '';

	if($hacnt == 1)
		$html .= $inijs."\n";

	if(isset($params['rows']))
		$rows = $params['rows'];
	if(isset($params['cols']))
		$cols = $params['cols'];
	if(isset($params['conts']))
		$conts = $params['conts'];
	if(isset($params['style']))
		$style = $params['style'];
	if(isset($params['id']))
		$id = $params['id'];
	if(isset($params['name']))
		$name = $params['name'];

	$html .= "<textarea id='$id' name='$name' rows='$rows' cols='$cols' class='$style' fieldname='ha$hacnt'>$conts</textarea>";
	$html .= "\n<script language='JavaScript1.2' defer>editor_generate('ha$hacnt');</script>";

	return $html;
}

?>
