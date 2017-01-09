<?php
/*
  $Id: ups_boxes_used.php,v 1.0 2007/11/12 JanZ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $search_id_array[] = array('id' => 'ubuID', 'text' => TEXT_SHIPMENT_ID);
  $search_id_array[] = array( 'id' => 'cID', 'text' => TEXT_CUSTOMER_ID);
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'deleteconfirm':
        $ubuID = tep_db_prepare_input($_GET['ubuID']);
        
        tep_db_query("delete from " . TABLE_UPS_BOXES_USED . " where id = '" . (int)$ubuID . "'");

        tep_redirect(tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action'))));
        break;
      case 'deleteconfirmbatch':
      if(isset($_POST['batch_id'])) {
        foreach($_POST['batch_id'] as $key => $id) {
          if ((int)$id != 0) {
            $id_array[] = $id;
          }
        }
          if (count($id_array) > 0) {
            tep_db_query("delete from " . TABLE_UPS_BOXES_USED . " where id in (" . implode(',', $id_array) . ")");
          }
      } 
        tep_redirect(tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action'))));
        break;
    }
  }

  if (($action == 'details') && isset($_GET['ubuID'])) {
    $ubuID = tep_db_prepare_input($_GET['ubuID']);

    $entry_query = tep_db_query("select id from " . TABLE_UPS_BOXES_USED . " where id = '" . (int)$ubuID . "'");
    $entry_exists = true;
    if (!tep_db_num_rows($entry_query)) {
      $entry_exists = false;
      $messageStack->add(sprintf(ERROR_ENTRY_DOES_NOT_EXIST, $ubuID), 'error');
    }
  }
// from drop-down menu/input field in top right corner  
  if (($action == 'details') && isset($_GET['chooseID'])) {
    // default action: shipment id (id in table ups_boxes_used)
    if ($_GET['chooseID'] == 'ubuID') {
      $ubuID = tep_db_prepare_input($_GET['inputID']);
      if ((int)$ubuID == 0) {
        unset($action);
// proceed with default listing
      } else {
        $entry_query = tep_db_query("select id from " . TABLE_UPS_BOXES_USED . " where id = '" . (int)$ubuID . "'");
        $entry_exists = true;
        if (!tep_db_num_rows($entry_query)) {
          $entry_exists = false;
          $messageStack->add(sprintf(ERROR_ENTRY_DOES_NOT_EXIST, $ubuID), 'error');
        }
      }
    } elseif ($_GET['chooseID'] == 'cID') {
        $cID = tep_db_prepare_input($_GET['inputID']);
        $cID = (int)$cID;
// proceed with showing entries from this particular customer in the column listing
        unset ($action);       
        if ((int)$cID == 0) {
        unset($cID);
// proceed with default listing
       }
    }
  }
  if (isset($_GET['cID']) && tep_not_null($_GET['cID'])) {
        $cID = tep_db_prepare_input($_GET['cID']);
        $cID = (int)$cID;
  }

  include(DIR_WS_CLASSES . 'ups_boxes_shipped.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="JavaScript" type="text/javascript">
function flagCheckboxes(element) {
  var elementForm = element.form;
  var i = 0;

  for (i = 0; i < elementForm.length; i++) {
    if (elementForm[i].type == 'checkbox') {
      elementForm[i].checked = element.checked;
    }
  }
}

function rowUBUOverEffect(object) {
  if (object.className == 'dataTableRow') object.className = 'ubuTableRowOver';
}

function rowUBUOutEffect(object) {
  if (object.className == 'ubuTableRowOver') object.className = 'dataTableRow';
}
</script>
<style type="text/css">
.ubuTableRowOver { background-color: #FFFFFF; }
</style>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (($action == 'details') && ($entry_exists == true)) {
    $boxes_shipped = new ups_boxes_shipped($ubuID);
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('action', 'chooseID', 'inputID', 'cID', 'ubuID')) . (isset($ubuID) ? 'ubuID=' . $ubuID . '': '') . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2"><?php echo tep_draw_separator(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_CUSTOMER; ?></b></td>
                <td class="main"><?php echo $boxes_shipped->customer['name']; ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo ENTRY_TELEPHONE_NUMBER; ?></b></td>
                <td class="main"><?php echo $boxes_shipped->customer['telephone']; ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                <td class="main"><?php echo '<a href="mailto:' . $boxes_shipped->customer['email_address'] . '"><u>' . $boxes_shipped->customer['email_address'] . '</u></a>'; ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_DATE; ?></b></td>
                <td class="main"><?php echo $boxes_shipped->info['date']; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><br><b><?php echo TABLE_HEADING_BOXES_PACKED; ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td style="font-size: 10px;"><pre><?php print_r($boxes_shipped->boxes); ?></pre></td>
      </tr>
      <tr>
        <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('action', 'chooseID', 'inputID', 'cID', 'ubuID')) . (isset($ubuID) ? 'ubuID=' . $ubuID . '': '') . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo tep_draw_form('shipments', FILENAME_UPS_BOXES_USED, '', 'get'); ?>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_pull_down_menu('chooseID', $search_id_array) . ' ' . tep_draw_input_field('inputID', '', 'size="12"') . tep_draw_hidden_field('action', 'details'); ?></td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><?php echo tep_draw_form('batch' , FILENAME_UPS_BOXES_USED, 'action=batch_delete' . (isset($_GET['page']) ? '&page=' . (int)$_GET['page'] . '': ''),'post'); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CUSTOMER_ID; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SHIPMENT_ID; ?></td>
                <td class="dataTableHeadingContent" align="center"><input type="checkbox" name="batchFlag" id="batchFlag" onclick="flagCheckboxes(this);" /></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    if (isset($cID)) {
      // from drop down menu in top right corner
      $shipments_query_raw = "select c.customers_id, customers_firstname, customers_lastname, customers_email_address, customers_telephone, ubu.id, ubu.date from " . TABLE_CUSTOMERS . " c, " . TABLE_UPS_BOXES_USED . " ubu where c.customers_id = ubu.customers_id and c.customers_id = '" . $cID . "'";
      // BOF when going back from details after having used input field in top richt corner
    } elseif (isset($_GET['chooseID']) && isset($_GET['inputID'])) {
      if ($_GET['chooseID'] == 'ubuID') {
        $ubuID = (int)$_GET['inputID'];
        $shipments_query_raw = "select c.customers_id, customers_firstname, customers_lastname, customers_email_address, customers_telephone, ubu.id, ubu.date from " . TABLE_UPS_BOXES_USED . " ubu, " . TABLE_CUSTOMERS . " c where c.customers_id = ubu.customers_id and ubu.id = '" . $ubuID . "'";
      } elseif ($_GET['chooseID'] == 'cID'&& isset($_GET['inputID']) && (int)$_GET['inputID'] != 0) {
        $cID = (int)$_GET['inputID'];
        $shipments_query_raw = "select c.customers_id, customers_firstname, customers_lastname, customers_email_address, customers_telephone, ubu.id, ubu.date from " . TABLE_CUSTOMERS . " c, " . TABLE_UPS_BOXES_USED . " ubu where c.customers_id = ubu.customers_id and c.customers_id = '" . $cID . "'";
      } else { // default query again
        $shipments_query_raw = "select c.customers_id, customers_firstname, customers_lastname, customers_email_address, customers_telephone, ubu.id, ubu.date from " . TABLE_UPS_BOXES_USED . " ubu, " . TABLE_CUSTOMERS . " c where c.customers_id = ubu.customers_id order by id DESC";
      }
      // EOF when going back from details after having used input field in top right corner
    } else {
      $shipments_query_raw = "select c.customers_id, customers_firstname, customers_lastname, customers_email_address, customers_telephone, ubu.id, ubu.date from " . TABLE_UPS_BOXES_USED . " ubu, " . TABLE_CUSTOMERS . " c where c.customers_id = ubu.customers_id order by id DESC";
    }
    $shipments_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $shipments_query_raw, $shipments_query_numrows);
    $shipments_query = tep_db_query($shipments_query_raw);
    while ($shipments = tep_db_fetch_array($shipments_query)) {
    if ((!isset($_GET['ubuID']) || (isset($_GET['ubuID']) && ($_GET['ubuID'] == $shipments['id']))) && !isset($ubuInfo)) {
        $ubuInfo = new objectInfo($shipments);
        $shipment_object = new ups_boxes_shipped((int)$_GET['ubuID']);
      }
      if (isset($ubuInfo) && is_object($ubuInfo) && ($shipments['id'] == $ubuInfo->id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowUBUOverEffect(this)" onmouseout="rowUBUOutEffect(this)">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowUBUOverEffect(this)" onmouseout="rowUBUOutEffect(this)">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID' , 'inputID', 'cID')) . 'ubuID=' . $shipments['id'] . '&action=details' . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $shipments['customers_firstname'] . ' ' . $shipments['customers_lastname']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $shipments['customers_id']; ?></td>
                <td class="dataTableContent" align="center"><?php echo tep_datetime_short($shipments['date']); ?></td>
                <td class="dataTableContent" align="center"><?php echo $shipments['id']; ?></td>
                <td class="dataTableContent" align="center"><input type="checkbox" name="batch[]" value="<?php echo $shipments['id']; ?>" id="batch<?php echo $shipments['id']; ?>" /></td>
                <td class="dataTableContent" align="right"><?php if (isset($ubuInfo) && is_object($ubuInfo) && ($shipments['id'] == $ubuInfo->id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $shipments['id'] . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="4" align="right"><?php echo tep_image_submit('trash.png', IMAGE_BATCH_DELETE); ?></td>
                <td align="center"><input type="checkbox" name="batchFlag" id="batchFlag" onclick="flagCheckboxes(this);" /></td>
                <td>&#160;</td>
              </tr></form>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $shipments_split->display_count($shipments_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_SHIPMENTS); ?></td>
                    <td class="smallText" align="right"><?php echo $shipments_split->display_links($shipments_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'ubuID', 'action', 'chooseID', 'inputID', 'cID')) . (isset($cID) ? '&cID=' . $cID . '': '')); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SHIPPING_ENTRY . '</b>');

      $contents = array('form' => tep_draw_form('shipments', FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $ubuInfo->id . '&action=deleteconfirm'. (isset($cID) ? '&cID=' . $cID . '': '')));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br><br><b>' . ENTRY_CUSTOMER . '&#160;' .  $shipment_object->customer['name'] . '<br>' . TEXT_SHIPMENT_ID . '&#160;:&#160;' . $ubuInfo->id . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $ubuInfo->id . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
      case 'batch_delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SHIPPING_ENTRIES . '</b>');

      $contents = array('form' => tep_draw_form('shipments', FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $ubuInfo->id . '&action=deleteconfirmbatch'. (isset($cID) ? '&cID=' . $cID . '': '')));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO_BATCH_DELETE . '<br><br>');
      if (isset($_POST['batch'])) {
        $batch_list = '<table border="0" cellpadding="2">'."\n";
          foreach($_POST['batch'] as $key => $batch_id) {
            $batch_list .= '<tr>'."\n".'<td class="infoBoxContent">';
            $batch_list .= '<b>' . $batch_id . '</b></td>'."\n".'<td>';
            $batch_list .= '<input type="checkbox" name="batch_id[]" value="' . $batch_id . '" checked="checked" />';
            $batch_list .= '</td>'."\n".'</tr>'."\n".'';
          }
        $batch_list .= '</table>'."\n";
      $contents[] = array('align' => 'center', 'text' => $batch_list);
      }
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $ubuInfo->id . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($ubuInfo) && is_object($ubuInfo)) {
        $heading[] = array('text' => '<b>[' . $ubuInfo->id . ']&nbsp;&nbsp;' . tep_datetime_short($ubuInfo->date) . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $ubuInfo->id . '&action=details' . (isset($cID) ? '&cID=' . $cID . '': '')) . '">' . tep_image_button('button_details.gif', IMAGE_DETAILS) . '</a> <a href="' . tep_href_link(FILENAME_UPS_BOXES_USED, tep_get_all_get_params(array('ubuID', 'action', 'chooseID', 'inputID', 'cID')) . 'ubuID=' . $ubuInfo->id . '&action=delete' . (isset($cID) ? '&cID=' . $cID . '': '')) .'">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_NUMBER_OF_BOXES . ' '  . $shipment_object->info['num_of_boxes']);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
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
