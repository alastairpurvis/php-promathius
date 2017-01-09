<?php
/*
  $Id: product_listing.php,v 1.44 2003/06/09 22:49:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
if(!$nocategories && $HTTP_GET_VARS['cPath'] != 26)
{
	  $page = 'products';
	  $ranges = false;

    include(DIR_WS_BOXES . 'categories.php');
}

if (PRODUCT_THUMBNAIL_VIEW == 'false') { 
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }

  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $lc_align = 'center';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_DETAIL;
        $lc_align = 'center';
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);
    }

    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="productListing-heading"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';



        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_align = '';
            $lc_text = '&nbsp;' . $listing['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            $lc_align = '';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
               $lc_text = '<a class="inactive" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . 
$HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a><br><span class="short">' . 
$listing['short_desc'] . '</span></b>';
                } else {
               $lc_text = '<a class="inactive" href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . 
$listing['products_id']) . '">' . $listing['products_name'] . '</a>' . ($listing['short_desc'] && (PRODUCT_SHORT_DESC == 'true') ? '<br><span class="short">' . $listing['short_desc'] . '</span>' : '');} 
           break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
						$price = (function_exists(display_short_price)) ? $currencies->display_short_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) : $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])); 
            if (tep_not_null($listing['specials_new_products_price'])) {
              $lc_text = '&nbsp;<s>' .  $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span style="font-weight:bold">' . $currencies->display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;';
            } else {
						   $lc_text = ($listing['products_price'] > 0 ? '&nbsp;' . $price . '&nbsp;' : '&nbsp;' . TEXT_POA); 
if (function_exists(tep_get_att_price)) $lc_text .= (tep_get_att_price($listing['products_id']) > 0 ? '+' : '&nbsp;') ; 
							
            }
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing['products_quantity'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing['products_weight'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_align = 'center';
            $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_details.gif', IMAGE_BUTTON_DETAILS) . '</a>&nbsp;';
           break;
        }
				
        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="productListing-data"',
                                               'text'  => $lc_text);
      }
    }

    new productListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                   'text' => TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }
 } else {  //thumbnail
  
  $row = 0;
  $col = 0;

	$border = '<table style="text-align:center" cellpadding="0" width="230" height="'.PRODUCT_LIST_HEIGHT.'"><tr><td style="padding-right: 35px; ">';
	$borderend = '</td></tr></table><br><br><br>';
	$info_box_contents = array();
	$listing_query = tep_db_query($listing_sql);
	while ($products = tep_db_fetch_array($listing_query)) {
   	if ($row == 0) { 
		$info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'width="33%" valign="top"',
                                           'text' =>  '&nbsp;'); $row ++;
		               }
		$image = $products['products_image']; 
		if (file_exists(DIR_WS_CLASSES . 'displayimages.php')) { 	// Additional Images Present
		$image_query = tep_db_query( "SELECT medium_images FROM " . TABLE_ADDITIONAL_IMAGES . " WHERE products_id = '".(int)$products['products_id']."'");
    $selected_image = tep_db_fetch_array($image_query);$image = $selected_image['medium_images']; }
		
		$button = (LISTING_BUTTON != 'none' ? (LISTING_BUTTON == 'buy now' ? '<br><a class="inactive" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products['products_id']) . '">' . tep_image_button('button_in_cart.gif', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;' : (LISTING_BUTTON == 'small buy now' ? '<br><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;' : '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . tep_image_button('button_details.gif', IMAGE_BUTTON_DETAILS) . '</a>&nbsp;' )) : '');
				 
		$price = (function_exists(display_short_price)) ? $currencies->display_short_price($products['products_price'], tep_get_tax_rate($products['products_tax_class_id'])) : $currencies->display_price($products['products_price'], tep_get_tax_rate($products['products_tax_class_id'])); 					  
		$show_price = '<div style="text-align: right; padding-top: 12px"><b><font size="'.PRODUCT_PRICE_SIZE.'">' . ($products['products_price'] > 0 ? $price : 'P.O.A') . '</font></b>';
    if (!PRODUCT_LIST_PRICE) $show_price = '';

    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'Width="33%" valign="top"',
                                           'text' => $border . '<div style="text-align:left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $image, $products['products_name'], PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_WIDTH) . '</a>' . '</div><br><div style="text-align:left; padding-top:  5px"><a style="font-size:12px; font-weight: bold; line-height:200%" class="inactive" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">'. (PRODUCT_LIST_NAME ? '' . $products['products_name'] . '' : '' ) . '</a></div><div style="color: #848484; text-align:justify">' . $products['products_short'] . ($products['short_desc'] && (PRODUCT_SHORT_DESC == 'true') ? $products['short_desc'] . '<br>' : '') . $show_price . $borderend . $button);
           if($products['products_name'] == 'Cell CPR')
           {
            $cellcpr = tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']);
              header("Location: " . $cellcpr);
           }


    $col ++;
    if ($col > PRODUCTS_PER_ROW-1) {
      $col = 0;
      $row ++;
    }
}  
		$col = 0;$row ++;$info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'width="33%" valign="top"',
                                           'text' =>  '&nbsp;');

   new contentBox($info_box_contents);
}	 
IF($HTTP_GET_VARS['cPath'] == 26)
ECHO '</TABLE>'
?>
