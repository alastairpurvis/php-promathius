<?
function smarty_modifier_commas($str) {
	return number_format($str, 0, ".", ",");
}
?>
