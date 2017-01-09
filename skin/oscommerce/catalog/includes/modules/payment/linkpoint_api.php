<?php
/**
 * 
 * @author    Jared De Blander <jared@iofast.com>
 * @author    James Ballenger <james@iofast.com>
 * @copyright (c) 2008
 * @version   $Rev: 67 $
 * @internal  $Id: linkpoint_api.php 67 2008-10-21 16:37:43Z jared0x90 $
 * @link      http://code.google.com/p/jared0x90-php/source/browse/trunk/osCommerce/catalog/includes/modules/payment/linkpoint_api.php
 *
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 * Copyright (c) 2003 osCommerce
 * Released under the GNU General Public License Version 3
 *
 *  ********* TEST CARDS *********
 * For testing purposes, you can use any of the card numbers listed below. The
 * test card numbers will not result in any charges to the card. Use these card
 * numbers with any expiration date in the future.
 *
 * - Visa Level 2 - 4275330012345675 (replies with a referral message)
 * - JCB - 3566007770003510
 * - Discover - 6011000993010978
 * - MasterCard - 5424180279791765
 * - Visa - 4005550000000019 or 4111111111111111
 * 
 *      It should be noted that 4005550000000019 does not reply with a referral message
 *      on a PREAUTH and in fact gets approved. Only when a SALE is ran does it return
 *      a referral. The other cards we have tested return the same preauth/sale messages
 *      and this one is unique in its behavior.
 * 
 * - MasterCard Level 2 - 5404980000008386
 * - Diners - 36555565010005
 * - Amex - 372700997251009
 *
 *
 * Extended by Jared De Blander and James Ballenger of www.iofast.com
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 *                       ***** PLEASE READ *****
 *               __                                            __
 *        ____  / /__  ____ _________     ________  ____ _____/ /
 *       / __ \/ / _ \/ __ `/ ___/ _ \   / ___/ _ \/ __ `/ __  / 
 *      / /_/ / /  __/ /_/ (__  )  __/  / /  /  __/ /_/ / /_/ /  
 *     / .___/_/\___/\__,_/____/\___/  /_/   \___/\__,_/\__,_/   
 *    /_/                                                        
 * 
 * Due to the popularity of this file and the number of requests we receive for
 * help we have added this short information section. Unfortunately we simply do 
 * not have the time to answer everyone and give one on one help as we both are
 * full time employees for iofast and are typically working well beyond normal 
 * working hours to get our own work done.
 * 
 * As most recently pointed out by "shellyky" on the osCommerce forum starting in 
 * version 1.2 we have forced email records of all CC authorizations/sales both
 * outbound and inbound data. If you'd like to disable this simply search this file
 * for the term mail( and comment out the lines. It is our preference to keep a
 * detailed record of transactions in our email (with the vitals removed) so that
 * we can quickly look up past transactions - gotta love GMail. 
 * 
 * If you would like to hire iofast to perform any kind of diagnostic, installation or 
 * code improvement work on this module or have other osCommerce or PHP related projects
 * you'd like for us to take a look at feel free to contact us at sales@iofast.com. You can 
 * find our rates and other services at:
 * 
 * http://www.iofast.com/iofast_services.php
 * 
 * Most of the errors we see are related to incorrect installation, improper use/ copying 
 * of files into the correct paths, port 1129 not being open (many hosting companies block this) 
 * or not reading the directions to realize that "Secure Credit Card Transaction" is how the text 
 * will appear in the payment module section of the oscommerce website.
 * 
 * The PEM file is also a file that people seem to corrupt or mess up pretty often. It's possible
 * people are uploaded in ASCII mode or it has invalid permissions for your web server to be 
 * able to access it. Either way try uploading it again and check which transfer mode your
 * FTP client is uploading this file in.
 * 
 * Trying to use the linkpoint module in debug or test mode does not currently work.
 * We plan to implement this in the future but at present all of our testing is performed with
 * the linkpoint provided test cards and/or real credit cards and small order totals (for final
 * validation).
 * 
 * Lastly here are some useful links to the linkpoint website should you be interested
 * in working on this module:
 * 
 * LinkPoint API Documentation:
 * 
 * http://www.linkpoint.com/support/sup_index.htm
 * 
 * To go to the API guide directly (This could change 10/21/2008):
 * 
 * http://www.linkpoint.com/product_solutions/internet/linkpointselectapi/LinkPointAPIv3_6.pdf
 * 
 * LinkPoint API Downloads:
 * 
 * http://www.linkpoint.com/viewcart/down_index.htm
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *   
 *
 * Version 1.3.4
 * Changes/Fixes
 * ----------------
 * 1. Increaed verbosity in output.
 * 2. Created new status messages for referral (states that there is a referral code)
 * 3. Created new status message for duplcate transaction, tells customer to wait 1 minute and try again
 * 4. Address, zip & cvv messages changed so that status OK means acceptec but not verified (such as an X code)
 *    Verified means Y (address and zip) or M (cvv and expiration)
 * 5. Adds status of card accepted or not accepted
 * 6. Checks if AVS info exists before attempting to verify against it.
 * 7. Addition of the PLEASE READ section. I suggest you go read it.
 * 
 * Version 1.3.3
 * Changes/Fixes
 * ----------------
 * 1. Forced tax to a $0.00 value to assist with level 2 compliance.
 *
 * Version 1.3.2
 * Changes/Fixes
 * ----------------
 * 1. Cleaned up the file a bit for posting to the SVN
 *
 * Version 1.3.1
 * Changes/Fixes
 * ----------------
 * 1. Removed some of the unset commands to prevent processing transactions in
 *    a class less than level 2.
 * 2. Now available on the Google Code SVN at the link above.
 *
 * Version 1.3
 * Changes/Fixes
 * ----------------
 * 1. Changed to a $1.00 pre-auth and a full amount sale to prevent customers from
 *    accruing excessive holds on their cards from preauths that the bank approved
 *    but we chose to fail based on invalid card info.
 *
 *  Version 1.2b Patch
 *  Changes/Fixes
 *  ----------------
 *  1. More filtering on XML data. A line like richmond � + &, Virginia 123455
 *     � + will work after filtering.  Linkpoint will fail transactions with �
 *     and & in the company name if these are not filtered.
 *
 *  Version 1.2a Patch
 *  Changes/Fixes
 *  ----------------
 *  1.  Changed SALE transaction to POSTAUTH. SALE / PREAUTH creates 2 sets of
 *      'charges' on a credit card even though the first charge (PREAUTH) is not
 *      actually completed. When speaking with LinkPoint initially they did not
 *      state that this methodology would create two seperate charges.
 *  2.  Mail outbound data w/ vital CC details removed to store owner for debugging.
 *  3.  RFC Time/Date stamp subject lines for inbound and outbound data emails
 *
 *  Version 1.2 Patch
 *  Changes/Fixes
 *  ----------------
 *  1.  Most of the bulk code changes occur around lines 289-355.
 *  2.  Preauth verifictaion is now FORCED and CHECKED before a SALE is processed. If preauth passes, sale will be automatically processed. The linkpoint panel will show your preauth and sale events.
 *  3.  If preauth fails detailed error descriptions are given to the user based on the AVS/CVV & Expiration return code from the preauth.
 *  4.  Name is still pulled from BILLING info and is therefore pointless to have a card holder name so the text box was removed.
 *  5.  Commented out line 254 to prevent linkpoint from sending unecessary automated receipts to customers
 *  6.  Commented out line 71 and 74-77. The JavaScript to handle card name is not needed as it was never used.
 *  7.  CVV code is actually used now. This code was never being passed.
 *  8.  Store owner email address receives an email containing the preauth response values. See line 302 to change this.
 *  9.  Added a spot for you to put a CVV helper popup. Feel free to use the images from iofast.com. See line 108.
 *  10. Filter & symbol in company name as it is not allowed by linkpoint. They claimed to be getting us a full list of disallowed symbols but never heard back from them.
 *  11. Cleaned up and properly formatted most of the code using tab spacing.
 **/
class linkpoint_api {
  var $code, $title, $description, $enabled, $cc_type, $transtype, $transmode, $zipcode, $states, $bstate, $sstate;
  // class constructor
  function linkpoint_api() {
    global $order;
    $this->code = 'linkpoint_api';
    $this->title = MODULE_PAYMENT_LINKPOINT_API_TEXT_TITLE;
    $this->description = MODULE_PAYMENT_LINKPOINT_API_TEXT_DESCRIPTION;
    $this->enabled = ((MODULE_PAYMENT_LINKPOINT_API_STATUS == 'True') ? true : false);
    $this->sort_order = MODULE_PAYMENT_LINKPOINT_API_SORT_ORDER;
    $this->states = $this->_state_list();
    if ((int)MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID;
    }
    if (is_object($order)) $this->update_status();
  }

  // class methods
  function filterLinkPoint($strToFilter){
    $strToFilter=str_replace("&", " and ", $strToFilter);
    $strToFilter=str_replace("�", "u", $strToFilter);

    return $strToFilter;
  }

  //in string check
  function in_string($haystack,$needle){
    if(stristr($haystack, $needle) === FALSE){
      return false;
    }else{
      return true;
    }
  }

  function update_status() {
    global $order;
    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_LINKPOINT_API_ZONE > 0) ) {
      $check_flag = false;
      $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_LINKPOINT_API_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
      while ($check = tep_db_fetch_array($check_query)) {
        if ($check['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
      }
      if ($check_flag == false) {
        $this->enabled = false;
      }
    }
  }

  function javascript_validation() {
    $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
    //            '    var cc_owner = document.checkout_payment.linkpoint_api_cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.linkpoint_api_cc_number.value;' . "\n" .
    //            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
    //            '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_OWNER . '";' . "\n" .
    //            '      error = 1;' . "\n" .
    //            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    if (cc_number == "" || cc_number.length < 3) {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CVV_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .                                             
            '    }' . "\n" .
            '  }' . "\n";

    return $js;
  }

  function selection() {
    global $order;

    for ($i=1; $i<13; $i++) {
      $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%m - %B',mktime(0,0,0,$i,1,2000)));
    }

    $today = getdate();
    for ($i=$today['year']; $i < $today['year']+10; $i++) {
      $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
    }
    $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => '<img src="'.DIR_WS_IMAGES.'cclogos.gif"><br><br>',
    //                                                 'field' => '<br><br><br>'.tep_draw_input_field('linkpoint_api_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                                 'field' => ''),
    array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('linkpoint_api_cc_number')),
    array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('linkpoint_api_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('linkpoint_api_cc_expires_year', $expires_year)),
    array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_CHECK_VALUE,
    //                                                 'field' => tep_draw_input_field('linkpoint_api_cc_cvm', '', 'size="4" maxlength="4"') . '&nbsp;&nbsp;(last 3 or 4 digits on back of credit card)<br>' . '&nbsp;&nbsp;</small>'),
                                                'field' => tep_draw_input_field('linkpoint_api_cc_cvm', '', 'size="4" maxlength="4"') . '<img src="spacer.gif" width="13" height="1"><a href="javascript:popupWindow(\''.DIR_WS_IMAGES.'cvv2.html\')" class="articleLink"><img src="'.DIR_WS_IMAGES.'cvv.gif" title="Visa/Mastercard" alt="Visa/Mastercard" align="top" border="0"><img src="spacer.gif" width="5" height="1" border="0"><img src="'.DIR_WS_IMAGES.'cvv-amex.gif" align="top" alt="American Express" title="American Express" border="0"><img src="spacer.gif" width="15" height="1" border="0">Where?</a>')));

    return $selection;
  }

  function pre_confirmation_check() {
    global $HTTP_POST_VARS;

    include(DIR_WS_CLASSES . 'cc_validation.php');

    $cc_validation = new cc_validation();
    $result = $cc_validation->validate($HTTP_POST_VARS['linkpoint_api_cc_number'], $HTTP_POST_VARS['linkpoint_api_cc_expires_month'], $HTTP_POST_VARS['linkpoint_api_cc_expires_year']);
    $error = '';
    switch ($result) {
      case -1:
        $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4), strlen($cc_validation->cc_number) );
        break;
      case -2:
      case -3:
      case -4:
        $error = TEXT_CCVAL_ERROR_INVALID_DATE;
        break;
      case false:
        $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
        break;
    }
    if ( ($result == false) || ($result < 1) ) {
      $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&linkpoint_api_cc_expires_month=' . $HTTP_POST_VARS['linkpoint_api_cc_expires_month'] . '&linkpoint_api_cc_expires_year=' . $HTTP_POST_VARS['linkpoint_api_cc_expires_year'] . '&linkpoint_api_cc_cvm=' . $HTTP_POST_VARS['linkpoint_api_cc_cvm'];
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
    }
    $this->cc_card_type = $cc_validation->cc_type;
    $this->cc_card_number = $cc_validation->cc_number;
    $this->cc_expiry_month = $cc_validation->cc_expiry_month;
    $this->cc_expiry_year = $cc_validation->cc_expiry_year;
    $this->cc_cvm = $HTTP_POST_VARS['linkpoint_api_cc_cvm'];
    $this->cc_nocvm = $HTTP_POST_VARS['linkpoint_api_cc_nocvm'];
  }

  function confirmation() {
    global $HTTP_POST_VARS, $order;
    $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $order->billing['firstname'] . ' ' . $order->billing['lastname']),
    array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
    array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['linkpoint_api_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['linkpoint_api_cc_expires_year'])))));
    return $confirmation;
  }

  function process_button() {
    global $HTTP_SERVER_VARS, $order, $customer_id;
    $sequence = rand(1, 1000);
    $process_button_string = tep_draw_hidden_field('cc_owner', $_POST['cc_owner']) .
    tep_draw_hidden_field('cc_expires', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
    tep_draw_hidden_field('cc_expires_month', $this->cc_expiry_month) .
    tep_draw_hidden_field('cc_expires_year', substr($this->cc_expiry_year, -2)) .
    tep_draw_hidden_field('cc_type', $this->cc_card_type) .
    tep_draw_hidden_field('cc_number', $this->cc_card_number) .
    tep_draw_hidden_field('userid', $customer_id) .
    tep_draw_hidden_field('cc_cvv', $this->cc_cvm);
    //                               tep_draw_hidden_field('cc_cvv', $_POST['cc_cvmvalue']);

    if ($order->billing['country']['iso_code_2'] == 'US') {
      $this->bstate = $this->states[strtoupper($order->billing['state'])];
      if ($this->bstate == '') {
        $this->bstate = $order->billing[state];
      }
      $process_button_string .= tep_draw_hidden_field('bstate', $this->bstate);
    } else {
      $process_button_string .= tep_draw_hidden_field('bstate', $order->billing[state]);
    }

    if ($order->delivery['country']['iso_code_2'] == 'US') {
      $this->sstate = $this->states[strtoupper($order->delivery['state'])];
      if ($this->sstate == '') {
        $this->sstate = $order->delivery[state];
      }
      $process_button_string .= tep_draw_hidden_field('sstate', $this->sstate);
    } else {
      $process_button_string .= tep_draw_hidden_field('sstate', $order->delivery[state]);
    }
    return $process_button_string;
  }

  function before_process() {
    global $_POST, $_SERVER, $order, $cart, $db, $lp_response_array, $lp_order_id, $lpOrderID;

    require(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/linkpoint_api/lphp.php');

    $order->info['cc_type'] = $_POST['cc_type'];
    $order->info['cc_owner'] = $_POST['cc_owner'];
    $order->info['cc_cvv'] = $_POST['cc_cvv'];

    $mylphp = new lphp;

    // Build Info to send to Gateway

    $myorder["host"]       = MODULE_PAYMENT_LINKPOINT_API_SERVER;
    $myorder["port"]       = "1129";
    $myorder["keyfile"]=(DIR_FS_CATALOG. DIR_WS_MODULES . 'payment/linkpoint_api/' . MODULE_PAYMENT_LINKPOINT_API_LOGIN . '.pem');
    $myorder["configfile"] = MODULE_PAYMENT_LINKPOINT_API_LOGIN;        // Store number

    $myorder["ordertype"]  = strtoupper(MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE);

    switch (MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE) {
      case "Live": $myorder["result"] = "LIVE"; break;
      case "Test": $myorder["result"] = "GOOD"; break;
      case "Decline": $myorder["result"] = "DECLINE"; break;
    }

    $myorder["transactionorigin"] = "ECI";           // For credit card retail txns, set to RETAIL, for Mail order/telephone order, set to MOTO, for e-commerce, leave out or set to ECI
    //  $myorder["oid"]               = "";  // Order ID number must be unique. If not set, gateway will assign one.
    $myorder["ponumber"]          = "1002";  // Needed for business credit cards
    $myorder["taxexempt"]         = "Y";  // Needed for business credit cards
    $myorder["terminaltype"]      = "UNSPECIFIED";    // Set terminaltype to POS for an electronic cash register or integrated POS system, STANDALONE for a point-of-sale credit card terminal, UNATTENDED for a self-service station, or UNSPECIFIED for e-commerce or other applications
    $myorder["ip"]                = $_SERVER['REMOTE_ADDR'];

    //  $myorder["subtotal"]    = $order->info['subtotal'];
    $myorder["tax"]         = '0.00'; //$order->info['tax'];
    //  $myorder["shipping"]    = $order->info['shipping_cost'];
    $grantotal = number_format($order->info['total'], 2);
    //in version 1.3 we are only going to pre-auth $1.00
    //$myorder["chargetotal"] = str_replace(",", "", $grantotal);
    $myorder["chargetotal"] = "1.00";

    // CARD INFO
    $myorder["cardnumber"]   = $_POST['cc_number'];
    $myorder["cardexpmonth"] = $_POST['cc_expires_month'];
    $myorder["cardexpyear"]  = $_POST['cc_expires_year'];
    if (empty($_POST['cc_cvv'])) {
      $myorder["cvmindicator"] = "not_provided";
    }
    else {
      $myorder["cvmindicator"] = "provided";
    }
    $myorder["cvmvalue"]  = $_POST['cc_cvv'];

    // BILLING INFO
    $myorder["userid"]   = $_POST['userid'];
    $myorder["name"]     = $this->filterLinkPoint($order->billing['firstname'] . ' ' . $order->billing['lastname']);
    $myorder["company"]  = $this->filterLinkPoint($order->billing['company']);
    $myorder["address1"] = $this->filterLinkPoint($order->billing['street_address']);
    $myorder["address2"] = $this->filterLinkPoint($order->billing['suburb']);
    $myorder["city"]     = $this->filterLinkPoint($order->billing['city']);
    $myorder["state"]    = $this->filterLinkPoint($_POST['bstate']);
    $myorder["country"]  = $this->filterLinkPoint($order->billing['country']['iso_code_2']);
    $myorder["phone"]    = $this->filterLinkPoint($order->customer['telephone']);
    //  $myorder["email"]    = $order->customer['email_address'];  //Prevents email address from being sent to linkpoint because they will use it to send an automated receipt to the customer that is uncessary based on the osCommerce system
    $myorder["addrnum"]  = $this->filterLinkPoint($order->billing['street_address']);   // Required for AVS. If not provided, transactions will downgrade.
    $myorder["zip"]      = $this->filterLinkPoint($order->billing['postcode']);  // Required for AVS. If not provided, transactions will downgrade.

    // SHIPPING INFO
    $myorder["sname"]     = $this->filterLinkPoint($order->delivery['firstname'] . ' ' . $order->delivery['lastname']);
    $myorder["saddress1"] = $this->filterLinkPoint($order->delivery['street_address']);
    $myorder["saddress2"] = $this->filterLinkPoint($order->delivery['suburb']);
    $myorder["scity"]     = $this->filterLinkPoint($order->delivery['city']);
    $myorder["sstate"]    = $this->filterLinkPoint($_POST['sstate']);
    $myorder["szip"]      = $this->filterLinkPoint($order->delivery['postcode']);
    $myorder["scountry"]  = $this->filterLinkPoint($order->delivery['country']['iso_code_2']);

    // description needs to be limited to 100 chars
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      $api = htmlentities($this->filterLinkPoint($order->products[$i]['name']), ENT_QUOTES, 'UTF-8');
      if (strlen($api) > '100') {
        $descrip = substr($api, 0, 100);
      } else {
        $descrip = $api;
      }
      $iprice = number_format($order->products[$i]['price'], 2);
      $items = array (
          'id'      => $order->products[$i]['id'],
          'description'   => $descrip,
          'quantity'    => $order->products[$i]['qty'],
          'price'   => str_replace(",", "", $iprice) 
      );
      $myorder["items"][$i] = $items;
    }

    // MISC
    //  $myorder["comments"] = "Repeat customer. Ship immediately.";
    $myorder["debugging"] = strtolower(MODULE_PAYMENT_LINKPOINT_API_DEBUG);  // for development only - not intended for production use

    //BACKUP TRANSACTION  BEGIN PREAUTH CODE!
    $realorder=$myorder;
    //added in 1.3 set the real order charge total to the full amount
    $myorder["ordertype"]  = "PREAUTH"; //make sure this is a preauth

    //BEGIN MAIL OUTBOUND DATA v1.3
    $debugoutputorder=$myorder;
    unset($debugoutputorder["cardnumber"]);
    unset($debugoutputorder["cvmvalue"]);
    unset($debugoutputorder["cardexpmonth"]);
    unset($debugoutputorder["cardexpyear"]);
    mail(STORE_OWNER_EMAIL_ADDRESS, "CC DEBUG OUTBOUND PREAUTH ".date('r'), print_r($debugoutputorder,true));
    //END MAIL OUTBOUND DATA v1.3


    // Send PREAUTH transaction.
    $result = $mylphp->curl_process($myorder);  // use curl methods
    //restore the grand total

    $lpOrderID="Auth: ".$result["r_ordernum"].", AVS: ".$result["r_avs"];

    //mail inbound data v1.3
    mail(STORE_OWNER_EMAIL_ADDRESS, "CC DEBUG INBOUND PREAUTH ".date('r'), print_r($result,true));

    //perform verification work
    if($result["r_avs"][1] == "N" || $result["r_avs"][3] == "N" || $result["r_avs"][3] == "S" || $result["r_approved"] != "APPROVED") {
      $myerrdisplay='';
      if($result["r_approved"] != "APPROVED") {
        $newerr=split(":",$result["r_error"]);

        //Check if their was a 4th colon delimited section present.
        if(isset($newerr[3])){
          //Make sure it has at least 4 characters
          if(strlen($newerr[3])>3){
            //what happened w/ Address
            if($newerr[3][0]=="N"){
              $myerrdisplay.='Address did not match. ';
            }elseif($newerr[3][0]=="Y"){
              $myerrdisplay.='Address Verified. ';
            }else{
              $myerrdisplay.='Address OK. ';
            }

            //what happened w/ Zip
            if($newerr[3][1]=="N"){
              $myerrdisplay.='Zip did not match. ';
            } elseif($newerr[3][1]=="Y"){
              $myerrdisplay.='Zip Verified. ';
            } else {
              $myerrdisplay.='Zip OK. ';
            }

            //what happened w/ CVV
            //1.3 - Added Test for r_avs=S to Change CVV verification to reject no CVV as well as incorrect CVV.  Module would previously accept good or no CVV and reject bad CVV.
            if($newerr[3][3]=="N"){
              $myerrdisplay.='CVV or Expiration did not match. ';
            }elseif($newerr[3][3]=="S"){
              $myerrdisplay.='CVV Not Provided. ';
            }elseif($newerr[3][3]=="Y"){
              $myerrdisplay.='CVV and Expiration Verified. ';
            }else{
              $myerrdisplay.='CVV and Expiration OK. ';
            }
          }
        }

        //what happened w/ Approval
        if(strstr($result['r_error'], 'R:Referral')){
          $myerrdisplay.='Card not approved, please contact your bank for detailed information or use another card.  This transaction has issued a referral code. ';
        } elseif(strstr($result['r_error'], 'Duplicate transaction')){
          $myerrdisplay.='Duplicate Transaction, please wait 1 minute and try again. ';
        } else {
          $myerrdisplay.='Card not approved, please contact your bank for detailed information or use another card. ';
        }
      }else{
        //what happened w/ Address
        if($result["r_avs"][0]=="N"){
          $myerrdisplay.='Address did not match. ';
        }elseif($result["r_avs"][0]=="Y"){
          $myerrdisplay.='Address Verified. ';
        }else{
          $myerrdisplay.='Address OK. ';
        }

        //what happened w/ Zip
        if($result["r_avs"][1]=="N"){
          $myerrdisplay.='Zip did not match. ';
        } elseif($result["r_avs"][1]=="Y") {
          $myerrdisplay.='Zip Verified. ';
        } else {
          $myerrdisplay.='Zip OK. ';
        }

        //what happened w/ CVV
        //1.3 - Added Test for r_avs=S to Change CVV verification to reject no CVV as well as incorrect CVV.  Module would previously accept good or no CVV and reject bad CVV.
        if($result["r_avs"][3]=="N") {
          $myerrdisplay.='CVV or Expiration did not match. ';
        } elseif($result["r_avs"][3]=="S") {
          $myerrdisplay.='CVV Not Provided. ';
        } elseif($result["r_avs"][3]=="Y") {
          $myerrdisplay.='CVV and Expiration Verified. ';
        } else {
          $myerrdisplay.='CVV and Expiration OK. ';
        }

        $myerrdisplay.='Card approved. ';
      }

      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=PREAUTHORIZATION FAILED - ' . urlencode($myerrdisplay. ' Please correct the listed problems and try again or contact us by phone to process this order.'), 'SSL', true, false));
    }


    //CHANGE FOR 1.3
    //build the real order
    $realorder["chargetotal"] = str_replace(",", "", $grantotal);
    $realorder["ordertype"] = "SALE";

    //BEGIN MAIL OUTBOUND DATA v1.3
    $debugoutputorder=$realorder;
    unset($debugoutputorder["cardnumber"]);
    unset($debugoutputorder["cvmvalue"]);
    unset($debugoutputorder["cardexpmonth"]);
    unset($debugoutputorder["cardexpyear"]);
    mail(STORE_OWNER_EMAIL_ADDRESS, "CC DEBUG OUTBOUND SALE ".date('r'), print_r($debugoutputorder,true));
    //END MAIL OUTBOUND DATA v1.3


    // Send the SALE transaction.
    $result = $mylphp->curl_process($realorder);  // use curl methods

    $lpOrderID.=", Sale: ".$result["r_ordernum"];

    //mail inbound data v1.3
    mail(STORE_OWNER_EMAIL_ADDRESS, "CC DEBUG INBOUND SALE ".date('r'), print_r($result,true));

    // - SGS-000001: D:Declined:P:
    //- SGS-005005: Duplicate transaction.
    //  Begin Transaction Status does not = APPROVED

    if ($myorder['debugging'] == 'true') {
      exit;
    }

    if ($result["r_approved"] != "APPROVED" && strstr($result['r_error'], 'D:Declined')) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . ' - ' . urlencode(MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_MESSAGE), 'SSL', true, false));
    }
    if ($result["r_approved"] != "APPROVED" && strstr($result['r_error'], 'R:Referral')) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . ' - ' . urlencode(MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_MESSAGE), 'SSL', true, false));
    }
    if ($result["r_approved"] != "APPROVED" && strstr($result['r_error'], 'Duplicate transaction')) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . ' - ' . urlencode(MODULE_PAYMENT_LINKPOINT_API_TEXT_DUPLICATE_MESSAGE), 'SSL', true, false));
    }
    if ($result["r_approved"] != "APPROVED" && strstr($result['r_error'], 'SGS')) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . ' - ' . urlencode($result["r_error"]), 'SSL', true, false));
    }
    if ($result["r_approved"] != "APPROVED" ) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . ' - ' . urlencode(MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR_MESSAGE), 'SSL', true, false));
    }
    //  End Transaction Status does not = APPROVED
  }

  function after_process() {
    return false;
  }

  function get_error() {
    global $_GET;
    $error = array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR,
      'error' => stripslashes(urldecode($_GET['error'])));
    return $error;
  }

  function check() {
    if (!isset($this->_check)) {
      $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_LINKPOINT_API_STATUS'");
      $this->_check = tep_db_num_rows($check_query);
    }
    return $this->_check;
  }

  function install() {
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Linkpoint API module', 'MODULE_PAYMENT_LINKPOINT_API_STATUS', 'True', 'Do you want to accept Linkpoint payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Store Number', 'MODULE_PAYMENT_LINKPOINT_API_LOGIN', '000001', 'The 6 or 7 digit store number for LinkPoint. For Yourpay accounts you must enter your 10 digit store number.', '6', '0', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('LinkPoint Transaction Mode', 'MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE', 'Live', '<strong>Live:</strong> Use for live transactions<br /><strong>Test:</strong> Use for test transactions', '6', '0', 'tep_cfg_select_option(array(\'Live\', \'Test\'), ', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Authorization Type', 'MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE', 'Preauth', 'Preauth will reserve the funds on the credit card. Sale will immediately charge the card.', '6', '0', 'tep_cfg_select_option(array(\'Preauth\', \'Sale\'), ', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('LinkPoint server', 'MODULE_PAYMENT_LINKPOINT_API_SERVER', 'secure.linkpt.net', 'LinkPoint secure server', '6', '0', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debugging', 'MODULE_PAYMENT_LINKPOINT_API_DEBUG', 'False', 'Only use for troubleshooting errors.', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_LINKPOINT_API_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_LINKPOINT_API_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
  }

  function remove() {
    tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
  }

  function keys() {
    return array( 'MODULE_PAYMENT_LINKPOINT_API_STATUS', 'MODULE_PAYMENT_LINKPOINT_API_LOGIN', 'MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE', 'MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE', 'MODULE_PAYMENT_LINKPOINT_API_SERVER', 'MODULE_PAYMENT_LINKPOINT_API_DEBUG', 'MODULE_PAYMENT_LINKPOINT_API_SORT_ORDER', 'MODULE_PAYMENT_LINKPOINT_API_ZONE', 'MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID');
  }

  function _state_list() {
    $list = array('ALABAMA' => 'AL',
        'ALASKA' => 'AK' ,
        'ARIZONA' => 'AZ' ,
        'ARKANSAS' => 'AR' ,
        'CALIFORNIA' => 'CA' ,
        'COLORADO' => 'CO' ,
        'CONNECTICUT' => 'CT' ,
        'DELAWARE' => 'DE' ,
        'DISTRICT OF COLUMBIA' => 'DC' ,
        'FLORIDA' => 'FL' ,
        'GEORGIA' => 'GA' ,
        'HAWAII' => 'HI' ,
        'IDAHO' => 'ID' ,
        'ILLINOIS' => 'IL' ,
        'INDIANA' => 'IN' ,
        'IOWA' => 'IA' ,
        'KANSAS' => 'KS' ,
        'KENTUCKY' => 'KY' ,
        'LOUISIANA' => 'LA' ,
        'MAINE' => 'ME' ,
        'MARYLAND' => 'MD' ,
        'MASSACHUSETTS' => 'MA' ,
        'MICHIGAN' => 'MI' ,
        'MINNESOTA' => 'MN' ,
        'MISSISSIPPI' => 'MS' ,
        'MISSOURI' => 'MO' ,
        'MONTANA' => 'MT' ,
        'NEBRASKA' => 'NE' ,
        'NEVADA' => 'NV' ,
        'NEW HAMPSHIRE' => 'NH' ,
        'NEW JERSEY' => 'NJ' ,
        'NEW MEXICO' => 'NM' ,
        'NEW YORK' => 'NY' ,
        'NORTH CAROLINA' => 'NC' ,
        'NORTH DAKOTA' => 'ND' ,
        'OHIO' => 'OH' ,
        'OKLAHOMA' => 'OK' ,
        'OREGON' => 'OR' ,
        'PENNSYLVANIA' => 'PA' ,
        'RHODE ISLAND' => 'RI' ,
        'SOUTH CAROLINA' => 'SC' ,
        'SOUTH DAKOTA' => 'SD' ,
        'TENNESSEE' => 'TN' ,
        'TEXAS' => 'TX' ,
        'UTAH' => 'UT' ,
        'VERMONT' => 'VT' ,
        'VIRGINIA' => 'VA' ,
        'WASHINGTON' => 'WA' ,
        'WEST VIRGINIA' => 'WV' ,
        'WISCONSIN' => 'WI' ,
        'WEST VIRGINIA' => 'WV' ,
        'WYOMING' => 'WY');
    return $list;
  }
}
?>
