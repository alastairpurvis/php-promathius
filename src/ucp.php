<?php

define('IN_PHPBB', true);
define('PROMATHIUS', true);
$phpbb_root_path = './forum/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PROFILE);
init_userprefs($userdata);
//
// End session management
//

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
	$sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}

//
// Set default email variables
//
$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
$script_name = ( $script_name != '' ) ? $script_name . '/ucp.'.$phpEx : 'ucp.'.$phpEx;
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

$server_url = $server_protocol . $server_name . $server_port . $script_name;

// -----------------------
// Page specific functions
//
function gen_rand_string($hash)
{
	$rand_str = dss_rand();

	return ( $hash ) ? md5($rand_str) : substr($rand_str, 0, 8);
}
//
// End page specific functions
// ---------------------------

//
// Start of program proper
//

	if ($userdata['is_empire'] == 1)
	{
				$template->assign_block_vars('switch_is_empire', array());
	}

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ( isset($HTTP_GET_VARS['mode']) ) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
	$mode = htmlspecialchars($mode);

	if ( $mode == 'viewprofile' )
	{
		include($phpbb_root_path . 'includes/usercp_viewucp.'.$phpEx);
		exit;
	}
	else if ( $mode == 'editprofile' )
	{
		if ( !$userdata['session_logged_in'] && $mode == 'editprofile' )
		{
			redirect(append_sid("login.$phpEx?redirect=ucp.$phpEx&mode=editprofile", true));
		}
		include($phpbb_root_path . 'includes/usercp_edit_profile.'.$phpEx);

		exit;
	}
	else if ( $mode == 'editavatar' )
	{
		if ( !$userdata['session_logged_in'] && $mode == 'editavatar' )
		{
			redirect(append_sid("login.$phpEx?redirect=ucp.$phpEx&mode=editprofile", true));
		}
		include($phpbb_root_path . 'includes/usercp_editavatar.php');

		exit;
	}
	else if ( $mode == 'editprefs' )
	{
		if ( !$userdata['session_logged_in'] && $mode == 'editprefs' )
		{
			redirect(append_sid("login.$phpEx?redirect=ucp.$phpEx&mode=editprofile", true));
		}
		include($phpbb_root_path . 'includes/usercp_prefs.php');

		exit;
	}
		else if ( $mode == 'editaccount' )
	{
		if ( !$userdata['session_logged_in'] && $mode == 'editaccount' )
		{
			redirect(append_sid("login.$phpEx?redirect=ucp.$phpEx&mode=editprofile", true));
		}
		include($phpbb_root_path . 'includes/usercp_account.php');

		exit;
	}
		else if ( $mode == 'editsig' )
	{
		if ( !$userdata['session_logged_in'] && $mode == 'editsig' )
		{
			redirect(append_sid("login.$phpEx?redirect=ucp.$phpEx&mode=editprofile", true));
		}
		include($phpbb_root_path . 'includes/usercp_editsig.php');

		exit;
	}
	else if ($userdata['is_empire'] == 1)
	{
		if ( $mode == 'delempire' )
		{
			if ( !$userdata['session_logged_in'] && $mode == 'editaccount' )
			{
				redirect(append_sid("login.$phpEx?redirect=ucp.$phpEx&mode=editprofile", true));
			}
			include($phpbb_root_path . 'includes/usercp_delempire.php');
	
			exit;
		}
	}
	else if ( $mode == 'confirm' )
	{
		// Visual Confirmation
		if ( $userdata['session_logged_in'] )
		{
			exit;
		}

		include($phpbb_root_path . 'includes/usercp_confirm.'.$phpEx);
		exit;
	}
	else if ( $mode == 'sendpassword' )
	{
		include($phpbb_root_path . 'includes/usercp_sendpasswd.'.$phpEx);
		exit;
	}
	else if ( $mode == 'activate' )
	{
		include($phpbb_root_path . 'includes/usercp_activate.'.$phpEx);
		exit;
	}
	else if ( $mode == 'email' )
	{
		include($phpbb_root_path . 'includes/usercp_email.'.$phpEx);
		exit;
	}
}
if ($userdata['session_logged_in'])
{
		include($phpbb_root_path . 'includes/usercp_overview.'.$phpEx);
		exit;
}
redirect(append_sid("login.$phpEx", true));

?>