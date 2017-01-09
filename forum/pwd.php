<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
<title>pwd</title>
</head>

<body>

<?php
define('IN_PHPBB', true);
define('PROMATHIUS', true);
if (!@include_once('extension.inc')) {
	die('Unable to open extension.inc.  Feeling helpful?  Send an email to the webmaster.');
}
$dir = dirname(__FILE__);
$absolute_path = 0;
$findme = '/';
$pos = strpos($dir, $findme);
if ($pos === 0) {
	$absolute_path++;
}
$findme = ':';
$pos = strpos($dir, $findme);
if ($pos === 1) {
	$absolute_path++;
}
if ($absolute_path) {
	$viewtopic_nix = $dir . "/viewtopic." . $phpEx;
	$viewtopic_win = $dir . "\viewtopic." . $phpEx;
	if (file_exists($viewtopic_nix)) {
		$dir = preg_replace('/\/$/', '', $dir);
		echo '<p>$phpbb_root_path found:</p><p>', $dir, '/<p><p>Please copy that path to your settings file.  Then you can remove this file (pwd.php), as it is no longer needed.';
	}
	else if (file_exists($viewtopic_win)) {
		$dir = preg_replace('/\\$/', '', $dir);
		echo '<p>$phpbb_root_path found:</p><p>', $dir, '\<p><p>Please copy that path to your settings file.  Then you can remove this file (pwd.php), as it is no longer needed.';
	}
	else {
		echo '<p>This file does not appear to be in the phpBB directory.  Please move it, and try again.</p>';
	}
}
else {
	echo '<p>A path has been found, but it is not absolute, and may be unreliable.  You will need to telnet to the server and issue the pwd command.</p>';
}
?>

</body>
</html>
