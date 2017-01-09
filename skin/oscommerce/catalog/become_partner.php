<?php
/*
  $Id: become_partner.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
    $name = tep_db_prepare_input($HTTP_POST_VARS['name']);
    $cname = tep_db_prepare_input($HTTP_POST_VARS['cname']);
    $type = tep_db_prepare_input($HTTP_POST_VARS['type']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email']);
    $web_address = tep_db_prepare_input($HTTP_POST_VARS['web']);
    $address = tep_db_prepare_input($HTTP_POST_VARS['address']);
    $number = tep_db_prepare_input($HTTP_POST_VARS['number']);
    $address = tep_db_prepare_input($HTTP_POST_VARS['address']);
    $enquiry1 = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);

    $enquiryxx = "<h2>Skin Nutrition Partner Request Form</h2>" . 
                  "Company name: $cname<br>Type of business:$type<br>Contact person:$name<br>Website:$web_address<br><br>Physical Address:$address<br>Contact number: $number<br>Contact email: $email_address" .
                  "<br><br>About us:<br>$enquiry1";
    if (tep_validate_email($email_address)) {
      tep_mail(STORE_OWNER, "richard@skinnutrition.com", "Skin Nutrition Partner Request", $enquiryxx, $name, $email_address);

      tep_redirect(tep_href_link(FILENAME_BECOME_PARTNER, 'action=success'));
    } else {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - Become Partner'; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
<? include ('includes/headertags.php'); ?>
<script language="javascript" type="text/javascript" src="scripts/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"  style="padding-left: 40px; padding-top: 23px;padding-bottom:0px; padding-right:140px"><?php echo tep_draw_form('become_partner', tep_href_link(FILENAME_BECOME_PARTNER, 'action=send')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1>Become a Partner</h1><br></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('contact') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('contact'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
      <tr>
        <td class="main" align="center"><?php echo "Your request has been successfully sent. You will hear back from us shortly."; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10" height="200"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" style="font-size: 13px; line-height: 150%">
Skin Nutrition is a revolutionary skin care brand leading the way in bio-active skin care, specializing in anti-aging, age reversal, and skin rejuvenation. Skin Nutrition is absolutely committed to the development of skin care products that deliver maximum efficacy and results, and it is through this achievement that Skin Nutrition has become the exciting, fast-growing skin care brand it is. With demand pouring in from all over the world, we are very eager to develop new partnerships to share the Skin Nutrition success story. 
<br><br>If you have interest in stocking Skin Nutrition we would love to hear from you. Please tell us a bit about you and your business below:  
<br><br><br>
</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
           <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10', '50'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="5">
              <tr>
                <td class="main">Company name:</td>
                <td class="main"><?php echo tep_draw_input_field('cname'); ?></td>
              </tr>
              <tr>
                <td class="main">Type of business:</td>
                <td class="main"><?php echo tep_draw_input_field('type'); ?></td>
              </tr>
              <tr>
                <td class="main">Contact Person:</td>
                <td class="main"><?php echo tep_draw_input_field('name'); ?></td>
              </tr>
              <tr>
                <td class="main">Contact Number:</td>
                <td class="main"><?php echo tep_draw_input_field('number'); ?></td>
              </tr>
              <tr>
                <td class="main">Website:</td>
                <td class="main"><?php echo tep_draw_input_field('web'); ?></td>
              </tr>
              <tr>
                <td class="main">Physical Address:</td>
                <td class="main"><?php echo tep_draw_input_field('address'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_EMAIL; ?></td>
                <td class="main"><?php echo tep_draw_input_field('email'); ?></td>
              </tr>
              <tr>
                <td class="main" VALIGN=TOP>About you:</td>
                <td><?php echo tep_draw_textarea_field('enquiry', 'soft', 80, 10); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10', '50'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></form></td>
<!-- body_text_eof //-->
</td>
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
