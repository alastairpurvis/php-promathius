<?php
/*
  $Id: contact_us.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ABOUT);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
    $name = tep_db_prepare_input($HTTP_POST_VARS['name']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email']);
    $enquiry = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);

    if (tep_validate_email($email_address)) {
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);

      tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
    } else {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_aBOUT));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?> id="top">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - Superb Supplements'; ?></title>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
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
    <td width="100%" valign="top"  style="padding-left: 45px; padding-top: 20px;padding-bottom:0px; padding-right:0px"><?php echo tep_draw_form('contact_us', tep_href_link(FILENAME_CONTACT_US, 'action=send')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0" style="padding-right: 130px; text-align:justify">
          <tr>
            <td><h1 style="font-size: 26px;">Essential Supplements</h1></td></tr>
            <tr>
            <td>                <p style="font-size: 15px; color: #6f6f6f;line-height:150%">
Skin Nutrition is a proponent of attacking aging from the outside-in with the best topicals and at the same time from the inside-out with the best, most powerful supplements. This synergistic approach will maximize the age-reversal process and our recommendations on the absolute 'must-haves' in supplements are:
</p></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" style="text-align:justify;">
<br>
<h2>Omega 3 Capsules.</h2> 
<p>
Omega 3 is the most important essential nutrient that our diet lacks and is almost impossible to obtain from most diets today. It also happens to be one of the most important supplements for anti-aging as it has a host of powerful anti-aging benefits.
<br><Br>
Not all Omega 3s are created equal however! Many of the commercial supplements on the market that you will see in most pharmacies, health stores, and even grocery stores are low quality forms of Omega 3 and specifically contain low levels of EPA and DHA, the essential fatty acids in Omega 3 responsible for most of its efficacies and anti-aging/health properties. The EPA and DHA content has a lot to do with the end price as the lower amounts of these essential fatty acids there are lower the cost is.
<br><Br>
Another issue in many of these commercial Omega 3s, specifically the ones derived from fish oil, which is the best type of Omega 3, is many of them are not molecularly distilled, which means they would contain mercury and PCBs, which are toxins. Molecular distillation purifies the Omega 3 of these toxins. It is important to remember that some of the commercial Omega 3s mentioned above can be molecularly distilled but still low in EPA and DHA.     
<br><Br>
Skin Nutrition's pharmaceutical-grade Omega-3 is the purest, most potent form of Omega 3 available, with the highest levels of EPA and DHA. It has undergone an advanced molecular distillation process that purifies it of mercury, PCBs and other toxins so prevalent in fish oil today.
<br><Br>
In addition to its powerful anti-aging benefits, which include reducing inflammation, improving cell health, and improving skin moisture retention, there is also now overwhelming clinical evidence that pharmaceutical grade Omega -3, and specifically EPA and DHA, can improve health by lowing triglycerides, improving heart and brain functioning, improving circulation, and help prevent diseases and ailments such as; cancer, diabetes, strokes, depression, arthritis, allergies, ADHD, Alzheimer's, skin disorders and Gout.
<br><Br>
The bottom line here is you get what you pay for with Skin Nutrition's Omega 3.  
<br><Br>
<div class="header" style="text-align:right; border-bottom: 1px solid #dbdbdb"><a href="#top">back to top</a></div>
</p>
<br>
<h2>Astaxanthin.</h2> 
<p>
Skin Nutrition's Astaxanthin, from Haematococcus pluvialis, is an algae grown in Hawaii that is the most potent anti-oxidant known and has the unique ability to span through the double layer of the cell membrane which allows it to protect skin cells better than any other anti-oxidant as it protects the cell both inside and out.
<br><Br>
Clinical research has shown Astaxanthin's properties include: protects all cells, reduces inflammation at cellular levels, prevents glycation, reverses glycation, stimulates fibroblast growth, inhibits pigmentation, inhibits melanin-generation, improves skin moisture levels, improves the elasticity of skin, anti- wrinkle activity, protects the skin from UVA and UVBs when taking it orally as well as when applied topically, anti-inflammatory action, anti-arteriosclerotic action, immune-activating action, and anti-stress action.  
<br><Br>
Skin Nutrition's Astaxanthin is an absolute must for any anti-aging regimen!  
</p>
<div class="header" style="text-align:right; border-bottom: 1px solid #dbdbdb"><a href="#top">back to top</a></div>
<br>
<h2>Omega 3 Shake.</h2>
<p>
Eating correctly is an important part of an effective anti-aging program and we all know that it is not necessarily easy to do for each meal we need throughout the day. Choosing a 'fast-food' option often means simple carbs, which spike blood sugar levels and in-turn create inflammation. Inflammation is something we want to avoid if we want to optimize our anti-aging progress as it plays havoc on our cells.
<br><br>
Skin Nutrition's Omega 3 shake is a great, easy option to ensure you do eat well and avoid inflammation.  The Skin Nutrition Omega 3 shake is a whole food meal supplement designed to optimally support cellular nutrition to promote beautiful skin, hair, and nails as well as a beautiful lean body. Most meal supplement shakes on the market are nothing more than 'junk food'. Skin Nutrition's Omega Shake is rich in Omega 3 essential fats, fiber, protein, vitamins & minerals, anti-oxidants, and skin enhancing ingredients. It is also contains whole grain complex carbohydrates for sustained energy, is low glycemic so it will not spike your blood sugar, and contains 100% natural flavors and no sugar or artificial sweeteners. Best of all, it's absolutely delicious!
</p>
<div class="header" style="text-align:right; border-bottom: 1px solid #dbdbdb"><a href="#top">back to top</a></div>
<BR><BR><BR><BR><BR>
</td>
        <td valign=top align=center>
        <img src="images/pxl-trans.gif" height=50 />
        <Br>
        <img src="images/omega3.jpg" width="300" height="340" />
                <Br>
         <img src="images/pxl-trans.gif" height=80 />
                 <Br>
        <img src="images/asta_large.jpg" width="175" height="250" />
                 <Br>
        <img src="images/omega3_shake.jpg" width="300" height="340" />
              </tr>
            </table></td>
          </tr>
        </table>
        </td>
      </tr>
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
