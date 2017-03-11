<?php


// phpBB 2.x auto-generated config file
// Do not change anything in this file!

$dbms = 'mysql4';

$dbhost = $config['dbhost'];
$dbname = $config['dbname'];
$dbuser = $config['dbuser'];
$dbpasswd = $config['dbpass'];

$table_prefix = $config['forum_prefix'] . '_';

define('PHPBB_INSTALLED', true);

$link = @mysql_connect($dbhost, $dbuser, $dbpasswd);

if (!$link)
{
    die ("The database is currently unavailable. Please try again later.\n");
}

?>