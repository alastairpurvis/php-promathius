<?php
/*
  $Id: shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ABOUT);
  $page = 'ranges';
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ABOUT));
  $ranges = true;
 $categories_queryx = tep_db_query("select c.categories_id, c.categories_image, cd.categories_name, cd.detail, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where cd.categories_id = '" . (int)$HTTP_GET_VARS['cPath'] . "' and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
    $cat_infox = tep_db_fetch_array($categories_queryx);
if(!$HTTP_GET_VARS['cPath'] || !$cat_infox['categories_name'] || $HTTP_GET_VARS['cPath'] == '26')
{
    $HTTP_GET_VARS['cPath'] = 21;
    $cPath_array['21'] = 21;
}
   $categories_query2 = tep_db_query("select c.categories_id, c.categories_image, cd.categories_name, cd.detail, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where cd.categories_id = '" . (int)$HTTP_GET_VARS['cPath'] . "' and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
    $cat_info = tep_db_fetch_array($categories_query2);
 $categories_query3 = tep_db_query("select c.categories_id, c.categories_image, cd.categories_name, cd.detail, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$HTTP_GET_VARS['cPath'] . "' and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");

    $cat_info2 = tep_db_fetch_array($categories_query3);
    
    $more_info_link .= tep_href_link(FILENAME_DEFAULT,  'cPath=' . $HTTP_GET_VARS['cPath']);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - ' . $cat_info['categories_name'] . ' Overview'; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
<script language="javascript" type="text/javascript" src="scripts/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
        <td valign="top" style="padding-left: 11px; padding-top:1px;">
        <Table cellspacing="0" cellpadding="0">
<? 

if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'categories.php');} 
?>
</td>
</tr>
    <tr>
    <td style="padding-top:3px">
<?
?>
            <div style="width: 761px; background-image: url('images/productbg.jpg'); background-repeat: no-repeat;">
        <table cellpadding="0" cellspacing="0" width="761" height="288">
            <tr>
                <td valign="top" width="247"><br /><br /><? echo tep_image(DIR_WS_IMAGES . $cat_info2['categories_image']); ?></td>
                <td valign="bottom" style="padding-right: 30px; padding-top: 14px;">
                <h1><span id="ctl00_ContentPlaceHolder1_RangeTitle"><? echo  $cat_info['categories_name']; if($cat_info['categories_name'] != 'Cell CPR'){?> Range<? } ?></span></h1>

                <p style="text-align:justify;">
                <span id="ctl00_ContentPlaceHolder1_RangeDescription"><? echo  $cat_info['detail'];?></span>
                </p>
                <p>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
<? if($cat_info['categories_name'] != 'Cell CPR'){?>
                        <a href="<? echo $more_info_link ?>"><img alt="See Range" src="images/buttons/seerange_o.jpg" onmouseover="this.src='images/buttons/seerange.jpg';" onmouseout="this.src='images/buttons/seerange_o.jpg';" border="0" /></a>
                       <? if($cat_info['categories_name'] == 'Nutrissentials')
                        { ?>
                        	<a href="<? ECHO tep_href_link(FILENAME_NUTRISSENTIALS);?>"><img alt="More Info" src="images/buttons/moreinfo.jpg" onmouseover="this.src='images/buttons/moreinfo_o.jpg';" onmouseout="this.src='images/buttons/moreinfo.jpg';" border="0" /></a>
                        <? } ?>
                        <? }else { ?>
                        <a href="<? ECHO tep_href_link(FILENAME_CELLCPR);?>"><img alt="More Info" src="images/buttons/moreinfo_grey.gif" onmouseover="this.src='images/buttons/moreinfo_blue.gif'" onmouseout="this.src='images/buttons/moreinfo_grey.gif';" border="0" /></a>
                        <a href="<? echo $more_info_link ?>"><img alt="Buy Online" src="images/buttons/buyonline_blue.gif" onmouseover="this.src='images/buttons/buyonline_grey.gif';" onmouseout="this.src='images/buttons/buyonline_blue.gif';" border="0" /></a>
                        <? } ?>
                        </td>
                        <td align="right"><img src="images/nottestedonanimals.gif" /></td>
                    </tr>
                </table>
                </p>
                </td>
            </tr>
        </table>
        </div>
        </table>
        </td>
    </tr>
</table>
</div>


<br><br><br>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
