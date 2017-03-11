<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
if($times = howmanytimes($users['msgcred_got'], 60)) {
	if($users['msgcred'] < 10)
		$users['msgcred'] += $times;
	if($users['msgcred'] > 10)
		$users['msgcred'] = 10;
	$users['msgcred_got'] = $time - $time%3600;
	saveUserData($users, "msgcred msgcred_got");
}
?>
