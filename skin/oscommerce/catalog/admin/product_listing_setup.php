<?php
  // product_listing_setup.php V1.5 for product_listing.php V1.7
 
  require('includes/application_top.php');
	$message=true;//set to false to stop checking messages
	// make directory
	$action = (isset($HTTP_GET_VARS['confirm']) ? $HTTP_GET_VARS['confirm'] : '');
	
	$chk_query = tep_db_query("select configuration_group_id from configuration_group where configuration_group_title = 'Product Listing'");
 
  $config_id=tep_db_fetch_array($chk_query); 
  $cfg_group_id = $config_id['configuration_group_id'];
	// check istall done already
	$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_title = 'Product Listing Style'");
	if (!tep_db_num_rows($check_query)) { 
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style', 'PRODUCT_THUMBNAIL_VIEW', 'thumbnails', 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.', '" . $cfg_group_id . "', 15, NULL, now(), NULL, 'tep_cfg_select_option(array(''list'', ''list in blocks'', ''thumbnails'', ''thumbnails in grid'', ''manufacturer'', ''manufacturer in blocks''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Short Description', 'PRODUCT_SHORT_DESC', 'false', 'Display Product Short Description In Listing', '" . $cfg_group_id . "', 16, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Buy Now / Details Button', 'LISTING_BUTTON', 'buy now', 'Display a &lsquo;Buy Now&rsquo;, &lsquo;Details&rsquo; Button or Both', '" . $cfg_group_id . "', 22, NULL, now(), NULL, 'tep_cfg_select_option(array(''none'', ''buy now'', ''small buy now'', ''details'', ''buy now & details''),')");	
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Manufacturers Description', 'MANU_DESCRIPTION', 'false', 'Display Manufacturers Description In Listing', '" . $cfg_group_id . "', 16, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Headings', 'LISTING_HEADINGS', 'true', 'Show Listing Column Headings (false prevents user sorting listing).', '" . $cfg_group_id . "', 23, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style Switch', 'LISTING_SWITCH', 'true', 'Provide the user the option to switch listing style.', '" . $cfg_group_id . "', 24, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");	

$sql_data_array = array('configuration_title' => 'Product Listing Price Size','configuration_key' => 'PRODUCT_PRICE_SIZE',
								'configuration_value' => 3,	'configuration_description' => 'Product Listing Price Font Size.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
$sql_data_array = array('configuration_title' => 'Product Listing Image Width','configuration_key' => 'PRODUCT_IMAGE_WIDTH',
								'configuration_value' => 140,	'configuration_description' => 'Product Listing Image Width.',
								'sort_order' => '17','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);		
$sql_data_array = array('configuration_title' => 'Product Listing Box Width','configuration_key' => 'PRODUCT_LIST_WIDTH',
								'configuration_value' => 200,	'configuration_description' => 'Individual Product Listing Box Width.',
								'sort_order' => '18','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);		
$sql_data_array = array('configuration_title' => 'Product Listing Box Height','configuration_key' => 'PRODUCT_LIST_HEIGHT',
								'configuration_value' => 180,	'configuration_description' => 'Individual Product Listing Box Height.',
								'sort_order' => '19','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);		
$sql_data_array = array('configuration_title' => 'Product Listing Per Row','configuration_key' => 'PRODUCTS_PER_ROW',
								'configuration_value' => 2,	'configuration_description' => 'Number Of Products To List Per Row.',
								'sort_order' => '21','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
	tep_db_query("ALTER TABLE ".TABLE_MANUFACTURERS_INFO." ADD `manufacturers_description` varchar(64) NULL"); 
	$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);					
	
} else { $to = 'Product Listing Setup.\nCheck 1 Done,\nInstall Found' ; print "<script>alert('$to');</script>"; 
$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_title = 'Product Listing Buy Now / Details Button'");
	if (!tep_db_num_rows($check_query)) { 
	tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'LISTING_BUTTON'");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Buy Now / Details Button', 'LISTING_BUTTON', 'buy now', 'Display a &lsquo;Buy Now&rsquo;, &lsquo;Details&rsquo; Button or Both', '" . $cfg_group_id . "', 22, NULL, now(), NULL, 'tep_cfg_select_option(array(''none'', ''buy now'', ''small buy now'', ''details'', ''buy now & details''),')");	
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'PRODUCT_THUMBNAIL_VIEW'");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style', 'PRODUCT_THUMBNAIL_VIEW', 'thumbnails', 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.', '" . $cfg_group_id . "', 15, NULL, now(), NULL, 'tep_cfg_select_option(array(''list'', ''list in blocks'', ''thumbnails'', ''thumbnails in grid'', ''manufacturer'', ''manufacturer in blocks''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Manufacturers Description', 'MANU_DESCRIPTION', 'false', 'Display Manufacturers Description In Listing', '" . $cfg_group_id . "', 16, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Headings', 'LISTING_HEADINGS', 'true', 'Show Listing Column Headings (false prevents user sorting listing).', '" . $cfg_group_id . "', 23, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style Switch', 'LISTING_SWITCH', 'true', 'Provide the user the option to switch listing style.', '" . $cfg_group_id . "', 24, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");	
tep_db_query("ALTER TABLE ".TABLE_MANUFACTURERS_INFO." ADD `manufacturers_description` varchar(64) NULL"); 
$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	

$error = 3;

} else { $to = 'Check 2 Done,\n v0 to V1 Update Found' ; if($message) print "<script>alert('$to');</script>"; 

$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'LISTING_HEADINGS'");
	if (!tep_db_num_rows($check_query)) { 
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'PRODUCT_THUMBNAIL_VIEW'");
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'LISTING_BUTTON'");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Buy Now / Details Button', 'LISTING_BUTTON', 'buy now', 'Display a &lsquo;Buy Now&rsquo;, &lsquo;Details&rsquo; Button or Both', '" . $cfg_group_id . "', 22, NULL, now(), NULL, 'tep_cfg_select_option(array(''none'', ''buy now'', ''small buy now'', ''details'', ''buy now & details''),')");	
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style', 'PRODUCT_THUMBNAIL_VIEW', 'thumbnails', 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.', '" . $cfg_group_id . "', 15, NULL, now(), NULL, 'tep_cfg_select_option(array(''list'', ''list in blocks'', ''thumbnails'', ''thumbnails in grid'', ''manufacturer'', ''manufacturer in blocks''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Manufacturers Description', 'MANU_DESCRIPTION', 'false', 'Display Manufacturers Description In Listing', '" . $cfg_group_id . "', 16, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Headings', 'LISTING_HEADINGS', 'true', 'Show Listing Column Headings (false prevents user sorting listing).', '" . $cfg_group_id . "', 23, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style Switch', 'LISTING_SWITCH', 'true', 'Provide the user the option to switch listing style.', '" . $cfg_group_id . "', 24, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");	
tep_db_query("ALTER TABLE ".TABLE_MANUFACTURERS_INFO." ADD `manufacturers_description` varchar(64) NULL"); 
$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
$error = 4; 

} else { $to = 'Check 3 Done,\n v1 to V1.1 Update Found' ; if($message) print "<script>alert('$to');</script>"; 

$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_description = 'Display a &lsquo;Buy Now&rsquo;, &lsquo;Details&rsquo; Button or Both'");
	if (!tep_db_num_rows($check_query)) { 
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'LISTING_BUTTON'");
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Buy Now / Details Button', 'LISTING_BUTTON', 'buy now', 'Display a &lsquo;Buy Now&rsquo;, &lsquo;Details&rsquo; Button or Both', '" . $cfg_group_id . "', 22, NULL, now(), NULL, 'tep_cfg_select_option(array(''none'', ''buy now'', ''small buy now'', ''details'', ''buy now & details''),')");	
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style Switch', 'LISTING_SWITCH', 'true', 'Provide the user the option to switch listing style.', '" . $cfg_group_id . "', 24, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");	
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'PRODUCT_THUMBNAIL_VIEW'");	
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style', 'PRODUCT_THUMBNAIL_VIEW', 'thumbnails', 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.', '" . $cfg_group_id . "', 15, NULL, now(), NULL, 'tep_cfg_select_option(array(''list'', ''list in blocks'', ''thumbnails'', ''thumbnails in grid'', ''manufacturer'', ''manufacturer in blocks''),')");
$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
$error = 5; 
} else { $to = 'Check 4 Done,\n v1.1 to V1.2 Update Found' ; if($message) print "<script>alert('$to');</script>";

$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'LISTING_SWITCH'");
	if (!tep_db_num_rows($check_query)) { 
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style Switch', 'LISTING_SWITCH', 'true', 'Provide the user the option to switch listing style.', '" . $cfg_group_id . "', 24, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");	
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'PRODUCT_THUMBNAIL_VIEW'");	
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style', 'PRODUCT_THUMBNAIL_VIEW', 'thumbnails', 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.', '" . $cfg_group_id . "', 15, NULL, now(), NULL, 'tep_cfg_select_option(array(''list'', ''list in blocks'', ''thumbnails'', ''thumbnails in grid'', ''manufacturer'', ''manufacturer in blocks''),')");
$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
$error = 6; 
} else { $to = 'Check 5 Done,\n v1.2 to V1.3 Update Found' ; if($message) print "<script>alert('$to');</script>";

$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_description = 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.'");
	if (!tep_db_num_rows($check_query)) { 
tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key = 'PRODUCT_THUMBNAIL_VIEW'");	
tep_db_query("INSERT INTO ".TABLE_CONFIGURATION." (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Product Listing Style', 'PRODUCT_THUMBNAIL_VIEW', 'thumbnails', 'Product Listing As Thumbnails, Product List or Manufacturer List. Straight or block list.', '" . $cfg_group_id . "', 15, NULL, now(), NULL, 'tep_cfg_select_option(array(''list'', ''list in blocks'', ''thumbnails'', ''thumbnails in grid'', ''manufacturer'', ''manufacturer in blocks''),')");
$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
$error = 7; 
} else { $to = 'Check 6 Done,\n v1.3 to V1.4 Update Found' ; if($message) print "<script>alert('$to');</script>";

$check_query=tep_db_query("SELECT * FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'PRODUCT_IMAGE_VSPACE'");
	if (!tep_db_num_rows($check_query)) { 
	$sql_data_array = array('configuration_title' => 'Product Listing Image Vertical Space','configuration_key' => 'PRODUCT_IMAGE_VSPACE',
								'configuration_value' => 100,	'configuration_description' => 'Image Vertical Space, set to height of largest image in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
 $sql_data_array = array('configuration_title' => 'Product Listing Name Vertical Space','configuration_key' => 'PRODUCT_NAME_VSPACE',
								'configuration_value' => 25,	'configuration_description' => 'Name Vertical Space, sets vertical space for name + description in thumbnail.',
								'sort_order' => '20','use_function' => NULL,'set_function' => NULL,
								'configuration_group_id' => $cfg_group_id,
								'date_added' => 'now()');
	tep_db_perform(TABLE_CONFIGURATION, $sql_data_array);	
$error = 8; 
} else { $to = 'Check 7 Done,\n v1.4 to V1.7 Update Found' ; if($message) print "<script>alert('$to');</script>";
$error = 2;} 

} } } } } }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Auto Backup Setup</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo 'Enhanced Product Listing Setup'; ?></td>
          </tr>
          <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"> 
<?php
  if ($error) { echo ($error == 2 ? 'Enhanced Product Listing configuration appears to be set up already. Aborted Operation.' : ($error == 3 ? 'Added Buy Now button option (v0 to v1.3)' : ($error == 4 ? 'Added Manufacturer List options (v1 to v1.3)' : ($error == 5 ? 'Added Buy Now / Details Button Option (v1.1 to v1.3)' : ($error == 6 ? 'Added Style Switch Option (v1.2 to v1.3)' : ($error == 7 ? 'Added Extra Listing Options (v1.3 to v1.4)' : ($error == 8 ? 'Added Extra Thumbnail Options (v1.4 to v1.7)' : 'Sorry, there was a problem encountered during setup!')))))));
 				 } else {
   						 echo 'Enhanced Product Listing has been configured successfully.';
 							 }
?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
			<tr>
        <td class="main"> 

        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
