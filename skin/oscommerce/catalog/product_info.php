<?php
/*
  $Id: product_info.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

  $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);
  $page = 'products';
      $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, p.large_products_image, p.ingredients, p.instructions, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

      $products_name = $product_info['products_name'];
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - ' . $products_name; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
<? include ('includes/headertags.php'); ?>
<script language="javascript" type="text/javascript" src="scripts/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
        <script> 
$(function() {
  $("#tabs").tabs("#panes > div").history();
});
</script> 
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
    <td width="100%" valign="top"  style="padding-left: 11px; padding-right: 39px; padding-top:1px;"><?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
  if ($product_check['total'] < 1) {
?>
      <tr>
        <td><?php new infoBox(array(array('text' => TEXT_PRODUCT_NOT_FOUND))); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td ><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, p.ingredients, p.instructions, p.large_products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
      $products_price = '<s>' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
    } else {
      $products_price = $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
    }

   // if (tep_not_null($product_info['products_model'])) {
   //   $products_name = $product_info['products_name'] . '<br><span class="smallText">[' . $product_info['products_model'] . ']</span>';
   // } else {
      $products_name = $product_info['products_name'];
  //  }
  
  
 $product_info_query3 = tep_db_query("select p.products_id, p.products_model, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
  if (!tep_db_num_rows($product_info_query3)) {
    tep_redirect(tep_href_link(FILENAME_REVIEWS));
  } else {
    $product_info2 = tep_db_fetch_array($product_info_query3);
  }


  $reviews_query_raw = "select r.reviews_id, rd.reviews_text as reviews_text, r.reviews_rating, r.date_added, r.customers_name, r.age, r.title, r.gender from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$product_info2['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' order by r.reviews_id desc";
  $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);

	$stars_query = tep_db_query($reviews_query_raw);
	while ($stars = tep_db_fetch_array($stars_query)) {
			$divisor += 1;
			$totalpoints += $stars['reviews_rating'];
	}
	if($totalpoints > 0) {
		$product_stars = $totalpoints / $divisor;
		$product_starsround = round($totalpoints / $divisor);
	}
	else
	{
		$product_stars = 0;
		$product_starsround = 0;
	}

  
  
        if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'categories.php');
  }
?>
          <tr>
            <Td>
            <table  border="0" width="100%" cellspacing="0" cellpadding="2" valign=top>
            <tr>
              <td align="center" class="smallText" rowspan=10 width=45% valign=top  style="padding-top:14px;">
<?php echo tep_image(DIR_WS_IMAGES . $product_info['large_products_image'], $product_info['products_name'], 'hspace="5" border="0" vspace="5"'); ?>
              </td>
          <td valign="top"  style="padding-top:14px;"><table valig=top width="100%" cellspacing="0" cellpadding="0" valign="top">
		  <td valign="top"><table valign=top border="0" width="100%" cellspacing="0" cellpadding="0"><Td><strong class="title"><?php echo $products_name; ?></strong><br></td><td align=right><img src="images/stars_<?echo $product_starsround?>_large.gif" /></td></table>
<?php
    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'");
    $reviews = tep_db_fetch_array($reviews_query);
   // if ($reviews['count'] > 0) {
?>
	  <!-- the tabs --> 
	  <br>
<ul class="tabs" id="tabs"> 
    <li><a id="t1" class="w1" href="#about">Introduction</a></li> 
    <li><a id="t2" class="w2" href="#specs">Specifications</a></li> 
    <li><a id="t3" class="w3" href="#reviews">Reviews (<? echo $reviews['count'] ?>)</a></li> 
</ul> 
<img src="images/tabbar_shadow.gif" />
 
</div></td></table></td>
      </tr>
      <tr>
        <td  style="padding-top:7px;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr valign="top">
        <td class="main" valign="top">
<?php
    if (tep_not_null($product_info['large_products_image'])) {
?>
<?php
    }
?>
<!-- tab "panes" --> 
<div class="panes" id="panes"> 
    <div style="vertical-align:top"><?php echo stripslashes($product_info['products_description']); ?></div> 
	<div style="vertical-align:top">
<b>Usage Instructions</b><Br></Br><?php echo stripslashes($product_info['instructions']); ?>	<br></br><b>Ingredients</b><Br></Br><?php echo stripslashes($product_info['ingredients']); ?>
		</div>
		<div style="vertical-align:top">
		<?php include('includes/product_reviewsinc.php');?>
				</div>
        </div>
<?php

    if (tep_not_null($product_info['products_url'])) {
?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    }

    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?></td>
      </tr>
<?php
    } else {
?>
<?php
    }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="price"><strong><?php echo $products_price; ?></strong></td>
                <script language ="JavaScript">

function SubmitForm()
{
document.cart_quantity.submit()
}

function ResetForm()
{
document.cart_quantity.reset()
}

</script>
                <td class="main" align="right"><?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . '<a style="cursor: pointer" onclick="SubmitForm()"><img src="images/addtocart.jpg" onmouseover="this.src=\'images/addtocart_o.jpg\'" alt="Add to cart" onmouseout="this.src=\'images/addtocart.jpg\'" /></a>' . '<noscript>' .tep_image_submit('addtocart.jpg', IMAGE_BUTTON_IN_CART) . '</noscript>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
    if ((USE_CACHE == 'true') && empty($SID)) {
    //  echo tep_cache_also_purchased(3600);
    } else {
   //   include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
  }
?>
        </td>
      </tr>
    </table></form></td></table>
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
