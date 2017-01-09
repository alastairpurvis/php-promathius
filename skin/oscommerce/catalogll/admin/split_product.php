<?php
/*
  $Id: split_product.php v1.1 2007/05/24 JanZ Exp $
  for upsxml.php, dimensions support (splitting a product in several items for shipping)
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  
  Copyright (c) 2007
  
  Released under the GNU General Public License 
*/

  require('includes/application_top.php');
	
	if(isset($_POST['submitbutton_x']) || isset($_POST['submitbutton_y'])) { // "save" button pressed
    if (isset($_POST['new_item']['insert'])) { // checkbox for new item checked
      	$insert_new_item_sql_data = array('id' => 'NULL',
			   'products_id' => (int)$_GET['pid'],
         'products_length' => round((float)$_POST['new_item']['length'], 2),
         'products_width' => round((float)$_POST['new_item']['width'], 2),
         'products_height' => round((float)$_POST['new_item']['height'], 2),
         'products_ready_to_ship' => (int)$_POST['new_item']['ready_to_ship'],
         'value_fraction' => round((float)$_POST['new_item']['value_fraction'], 2),
         'weight_fraction' => round((float)$_POST['new_item']['weight_fraction'], 2));
      tep_db_perform(TABLE_PRODUCTS_SPLIT, $insert_new_item_sql_data);
    } // end if (isset($_POST['new_item']['insert']
    if (isset($_POST['split_item']) && tep_not_null($_POST['split_item'])) {
       foreach($_POST['split_item'] as $id => $subarray) {
         if (isset($subarray['del'])) {
           tep_db_query("delete from " . TABLE_PRODUCTS_SPLIT . " where id = '" . (int)$id . "' and products_id = '" . (int)$_GET['pid'] . "'");
         } else {
            $sql_data_array = array(); // make sure other values are removed
            $sql_data_array = array('products_length' => round((float)$subarray['length'], 2),
            'products_width' => round((float)$subarray['width'], 2),
            'products_height' => round((float)$subarray['height'], 2),
            'products_ready_to_ship' => (int)$subarray['ready_to_ship'],
            'value_fraction' => round((float)$subarray['value_fraction'], 2),
            'weight_fraction' => round((float)$subarray['weight_fraction'], 2));

         tep_db_perform(TABLE_PRODUCTS_SPLIT, $sql_data_array, 'update', "id = '" . (int)$id . "' and products_id = '" . (int)$_GET['pid'] . "'");
         }
       } // end foreach($_POST['split_item'] as $id => $subarray)
    } // end if (isset($_POST['split_item']) && tep_not_null($_POST['split_item']))
    $messageStack->add(NUMBER_OF_SAVES . (isset($_POST['no_of_saves']) ? (int)$_POST['no_of_saves']+1 : 0), 'success'); 

	} // end if(isset($_POST['submitbutton_x']) || isset($_POST['submitbutton_y'])) 
	
if (!isset($_GET['pid'])) {
	  $messageStack->add(ERROR_NO_PRODUCT_ID, 'error');
  } elseif (isset($_GET['pid']) && !tep_not_null($_GET['pid'])) {
	  $messageStack->add(ERROR_NO_PRODUCT_ID, 'error');
  } else {
	  $product_id = (int)$_GET['pid'];
}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="JavaScript" type="text/javascript">
// trimWhitespace part of: Form Validation Functions  v1.1.6
// http://www.dithered.com/javascript/form_validation/index.html (2007/05/15: no longer functional )
// code by Chris Nott (chris@NOSPAMdithered.com - remove NOSPAM)
// Remove leading and trailing whitespace from a string

function trimWhitespace(string) {
	var newString  = '';
	var substring  = '';
	beginningFound = false;
	
	// copy characters over to a new string
	// retain whitespace characters if they are between other characters
	for (var i = 0; i < string.length; i++) {
		
		// copy non-whitespace characters
		if (string.charAt(i) != ' ' && string.charCodeAt(i) != 9) {
			
			// if the temporary string contains some whitespace characters, copy them first
			if (substring != '') {
				newString += substring;
				substring = '';
			}
			newString += string.charAt(i);
			if (beginningFound == false) beginningFound = true;
		}
		
		// hold whitespace characters in a temporary string if they follow a non-whitespace character
		else if (beginningFound == true) substring += string.charAt(i);
	}
	return newString;
}

function fractionCheck(fieldName, fieldValue) {

fieldValue = trimWhitespace(fieldValue);

if (isNaN(fieldValue) ) {
   alert(fieldValue + "<?php echo JS_ERROR_NOT_A_VALID_NUMBER; ?>");
   fieldName.focus();
   fieldName.select(); 
   return false;
}
else if (fieldValue=='') {
return true;
}
else if (fieldValue >= 1) {
   alert(fieldValue + "<?php echo JR_ERROR_FRACTION_LARGER_THAN_ONE; ?>");
   fieldName.focus();
   fieldName.select(); 
return false;
}
return true;
}
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<?php
  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }

	if (isset($product_id)) {
		  $split_product_query = tep_db_query("select ps.id, ps.products_id, p.products_price, p.products_weight as total_weight, ps.products_length, ps.products_width, ps.products_height, ps.products_ready_to_ship, ps.weight_fraction, ps.value_fraction, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_SPLIT . " ps where pd.products_id = ps.products_id and pd.products_id = p.products_id and p.products_id = '" . $product_id . "' and language_id = '" . $languages_id . "'");
       while ($_split_product = tep_db_fetch_array($split_product_query)) {
         $split_product[] = $_split_product;
       }

  $no_of_items = count($split_product);
  
  if ($no_of_items < 1) {
    $product_query = tep_db_query("select p.products_id, p.products_price, p.products_weight as total_weight, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and p.products_id = '" . $product_id . "' and language_id = '" . $languages_id . "'");
    $product = tep_db_fetch_array($product_query);
    $products_name = $product['products_name'];
    $products_price = $product['products_price'];
    $total_weight = $product['total_weight'];
  }  else {
    $products_name = $split_product[0]['products_name'];
    $products_price = $split_product[0]['products_price'];
    $total_weight = $split_product[0]['total_weight'];
  } // end if/else ($no_of_items < 1)
  $ready_to_ship_array = array(array('id' => '0', 'text' => 'no'),
                              array('id' => '1', 'text' => 'yes'));

?>
<div style="margin-top: 30px; margin-left: 20px;" id="product_details" name="product_details">
<?php 
  echo '<form name="split_products" action="' . tep_href_link(FILENAME_SPLIT_PRODUCT,'pid=' . $product_id, 'NONSSL') . '"  method="post">' ."\n";
  if (isset($_POST['no_of_saves'])) {
	  $noofsaves = (int)$_POST['no_of_saves']+1;
  } else {
    $noofsaves = '0';
	}
  echo tep_draw_hidden_field('no_of_saves', $noofsaves) . "\n";
  echo tep_draw_hidden_field('products_id', $product_id) . "\n";
?>
<p class="pageHeading" style="margin-bottom: 0px; padding: 2px;"><?php echo HEADING_TITLE; ?></p>
<table border="0" cellspacing="0" cellpadding="2">
   <tr class="attributes-even">
      <td valign="top"><?php echo TEXT_PRODUCTS_NAME; ?></td>
      <td><?php echo $products_name; ?></td>
   </tr>
   <tr class="attributes-odd">
      <td><?php echo TEXT_PRODUCTS_PRICE_NET; ?></td>
      <td><?php echo $products_price; ?></td>
   </tr>
   <tr class="attributes-even">
      <td><?php echo TEXT_PRODUCTS_WEIGHT; ?></td>
      <td><?php echo $total_weight; ?></td>
   </tr>
</table>
</div>
<div align="center" style="margin-top: 20px;" id="product_split" name="product_split">
<table border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="8"><?php echo tep_black_line(); ?></td>
  </tr>
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_INSERT; ?>&nbsp;</td>
    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_DELETE; ?>&nbsp;</td>
    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_READY_TO_SHIP; ?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_LENGTH; ?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_WIDTH; ?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_HEIGHT; ?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_WEIGHT_FRACTION; ?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_VALUE_FRACTION; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8"><?php echo tep_black_line(); ?></td>
  </tr>
<?php
	$rows = 0;
	for ($x = 0; $x < $no_of_items; $x++) {
		echo '  <tr class="' . (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd') . '">' . "\n";
    echo '    <td class="smallText">&#160;</td>' . "\n";
    echo '    <td class="smallText" align="center">' . tep_draw_checkbox_field('split_item[' . $split_product[$x]['id'] . '][del]')  . '</td>' . "\n";
		echo '    <td class="smallText" align="center">' . tep_draw_pull_down_menu('split_item['. $split_product[$x]['id'] .'][ready_to_ship]', $ready_to_ship_array, (($split_product[$x]['products_ready_to_ship'] == '0') ? '0' : '1')) . '</td>' . "\n";
		echo '    <td class="smallText"><input name="split_item[' . $split_product[$x]['id'] .'][length]" value="' . $split_product[$x]['products_length'] . '" size="8" /></td>' . "\n";
    echo '    <td class="smallText"><input name="split_item[' . $split_product[$x]['id'] .'][width]" value="' . $split_product[$x]['products_width'] . '" size="8" /></td>' . "\n";
    echo '    <td class="smallText"><input name="split_item[' . $split_product[$x]['id'] .'][height]" value="' . $split_product[$x]['products_height'] . '" size="8" /></td>' . "\n";
    echo '    <td class="smallText" align="center"><input name="split_item[' . $split_product[$x]['id'] .'][weight_fraction]" value="' . $split_product[$x]['weight_fraction'] . '" size="6" onblur="fractionCheck(this, this.value)" /></td>' . "\n";
    echo '    <td class="smallText" align="center"><input name="split_item[' . $split_product[$x]['id'] .'][value_fraction]" value="' . $split_product[$x]['value_fraction'] . '" size="6" onblur="fractionCheck(this, this.value)" /></td>' . "\n";
		$rows++;
		echo '  </tr>' . "\n";
	} // end for ($x = 0; $x < $no_of_items; $x++)
  // table row for adding a new item
		echo '  <tr class="' . (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd') . '">' . "\n";
    echo '    <td class="smallText" align="center">' . tep_draw_checkbox_field('new_item[insert]')  . '</td>' . "\n";
    echo '    <td class="smallText">&#160;</td>' . "\n";
		echo '    <td class="smallText" align="center">' . tep_draw_pull_down_menu('new_item[ready_to_ship]', $ready_to_ship_array, '0') . '</td>' . "\n";
		echo '    <td class="smallText"><input name="new_item[length]" value="" size="8" /></td>' . "\n";
    echo '    <td class="smallText"><input name="new_item[width]" value="" size="8" /></td>' . "\n";
    echo '    <td class="smallText"><input name="new_item[height]" value="" size="8" /></td>' . "\n";
    echo '    <td class="smallText" align="center"><input name="new_item[weight_fraction]" value="0.5" size="6" onblur="fractionCheck(this, this.value)" /></td>' . "\n";
    echo '    <td class="smallText" align="center"><input name="new_item[value_fraction]" value="0.5" size="6" onblur="fractionCheck(this, this.value)" /></td>' . "\n";
		echo '  </tr>' . "\n";
?>
</table>
<?php echo '<p style="margin-top: 20px;">' . tep_image_submit('button_save.gif', IMAGE_SAVE, 'name="submitbutton"') . '&#160;' . tep_image_button('button_cancel.gif', IMAGE_CANCEL, 'onclick=\'self.close()\'') .'</p>' . "\n";
?>
</form>
</div>
<?php
} // end if (isset($product_id))
  else {
echo '<div align="center" style="margin-top: 50px;">' . "\n" . '<form name="close">' . "\n" . tep_image_button('button_cancel.gif', IMAGE_CLOSE, 'onclick=\'self.close()\'') .'</form>' . "\n" . '</div>' . "\n";
}
?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>