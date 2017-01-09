<?php
/*
  $Id: shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_BA);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_BA));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE.' - Before & After'; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet2.css">
<script language="javascript" type="text/javascript" src="scripts/general.js"></script>
<? include ('includes/headertags.php'); ?>
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
        <td valign="top" width="581" style="padding: 23px 50px 30px 25px;">
        <h1>Testimonials</h1>

        <p>The before and after pictures and testimonials below were all based on a 6 week usage period.</p>
        <p>
        <table cellpadding="0" cellspacing="0" width="100%" id="beforeafter">
            <tr>
                <td valign="top" style="border-bottom: 4px solid #ebebeb;">
                <table cellpadding="8" cellspacing="0" bgcolor="#ebebeb">
                    <tr>
                        <td align="center"><a href="images/ba/lianne_before_l.jpg" rel="lightbox[0]" title="Lianne Before"><img src="images/ba/lianne_before_t.jpg" border="0" width="123" /></a></td>

                    </tr>
                    <tr>
                        <td align="center"><a href="images/ba/lianne_after_l.jpg" rel="lightbox[0]" title="Lianne After"><img src="images/ba/lianne_after_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                </table>
                </td>
                <td valign="top" style="border-bottom: 4px solid #ebebeb; padding-left: 20px;">
                <h2>Lianne</h2>

                <p>
                The opportunity to use Skin Nutrition has been a real privilege. Not only is the range of products extensive and sleekly packaged, it is also user-friendly and hygienic with the pump-action dispensing system. I enjoyed using all of the products and was particularly pleased with the Eye Reconditioning Serum. My normally sensitive eyes had no adverse reaction to it. I loved the Environmental Protection Serum and the Protective Daily Moisturizer with its inbuilt sun protection. I could apply the products in any order with the moisturizer last and it would all be absorbed into my skin. My skin also responded well to the Refining Soy Milk and Papaya mask, used once a week. After about two weeks of using Skin Nutrition I started receiving compliments like "What have you been doing? Your skin is glowing" and "You must have had a very relaxing holiday". It was only when we had our two-weekly photographs in the harsh glare of the studio lights that I could see the improvement for myself. The texture and tone of my skin was more refined and even, but best of all was the fact that my wrinkles had softened, particularly around the eyes and my frown 'furrow' between my eyebrows. I couldn't wait for each studio visit and feel confident that Skin Nutrition will continue to work its magic on me. Thank you Joanne and Richard for introducing me to your stunning products.
                </p>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br /><br /></td>
            </tr>
            <tr>

                <td valign="top" style="border-bottom: 4px solid #ebebeb;">
                <table cellpadding="8" cellspacing="0" bgcolor="#ebebeb">
                    <tr>
                        <td align="center"><a href="images/ba/janice_before_l.jpg" rel="lightbox[1]" title="Janice Before"><img src="images/ba/janice_before_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href="images/ba/janice_after_l.jpg" rel="lightbox[1]" title="Janice After"><img src="images/ba/janice_after_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                </table>

                </td>
                <td valign="top" style="border-bottom: 4px solid #ebebeb; padding-left: 20px;">
                <h2>Janice</h2>
                <p>
                I am very impressed with Skin Nutrition on every level. I had a very tired skin from working long late hours, and at times in my life have been guilty of too much coffee, as well as being a speed, synchronized and lifesaving swimmer at provincial levels for nearly 12 years at school-training 7 hours in the SA sun every weekend, and approximately 3hrs a day during the week- winter and summer in the pool, also exposing my skin to far too much chlorine. Although I always used waterproof sun protection, technology was not what it is today, and did often burn on my face badly, once so extremely my makeup up peeled off with the skin 2 weeks later.<br />
                From the age of 13 yrs, I have always cleansed, toned, moisturized and observed the golden rule of never going to bed with my make-up on, but my first photo shoot shows my skin has not reflected this care at all and was looking tired. I observed the Skin Care Programme Joanne from Skin Nutrition had advised me to follow rigidly, and was overjoyed with the visible improvement in my skin just two weeks later- particularly around the eyes. The 'sun spots' seemed to have faded too, and in my forth week close friends of mine were asking me if I was in love, as my skin was regaining its' youthful sparkle. No, there are no new men in my life, the only new denominator being following the programme Skin Nutrition set out for me.<br />
                I have been very impressed with the DMAE capsules and will continue taking them for the rest of my life, and love the accessibility of the basic products of cleanse, tone and moisturize. It truly is a skin care range that gives visible, speedy and effective results to be proud of, and they have my loyalty for life.
                </p>

                </td>
            </tr>
            <tr>
                <td colspan="2"><br /><br /></td>
            </tr>
            <tr>
                <td valign="top" style="border-bottom: 4px solid #ebebeb;">
                <table cellpadding="8" cellspacing="0" bgcolor="#ebebeb">
                    <tr>

                        <td align="center"><a href="images/ba/emma_before_l.jpg" rel="lightbox[2]" title="emma Before"><img src="images/ba/emma_before_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href="images/ba/emma_after_l.jpg" rel="lightbox[2]" title="emma After"><img src="images/ba/emma_after_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                </table>
                </td>
                <td valign="top" style="border-bottom: 4px solid #ebebeb; padding-left: 20px;">
                <h2>Emma</h2>

                <p>
                Being asked to appear on your website as a "Model" for Skin Nutrition was quite a daunting task for me.  However, after seeing the results after only two weeks, I knew I had nothing to worry about.  The product worked from day one, and was very clear as the weeks went by.<br />
                Especially amazing was how my "frown lines" had faded considerably, and the "red welts" in the corners of my eyes  were gone by the end of the trial. I put this down to the "wonderwork" of the Dynamic Wrinkle Reducer for my frown lines and the Eye Reconditioning Serum for my eyes.<br />
                The combination of the Cleansing Gel, which was light and non abrasive, a brilliant Toner Spritz and of course the various other products that were used in conjunction with these products, has really left my skin looking bright, glowing and refreshed.  I now have to share my creams with my husband, who has also found the product amazing and was told that he had "girly skin". I have tried many other products and because I have quite an oily skin, most have made me look shiny and more oily.<br />
                Skin Nutrition has found the right combination and I will continue using this product with confidence.
                </p>
                </td>
            </tr>

            <tr>
                <td colspan="2"><br /><br /></td>
            </tr>
            <tr>
                <td valign="top" style="border-bottom: 4px solid #ebebeb;">
                <table cellpadding="8" cellspacing="0" bgcolor="#ebebeb">
                    <tr>
                        <td align="center"><a href="images/ba/kim_before_l.jpg" rel="lightbox[3]" title="kim Before"><img src="images/ba/kim_before_t.jpg" border="0" width="123" /></a></td>
                    </tr>

                    <tr>
                        <td align="center"><a href="images/ba/kim_after_l.jpg" rel="lightbox[3]" title="kim After"><img src="images/ba/kim_after_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                </table>
                </td>
                <td valign="top" style="border-bottom: 4px solid #ebebeb; padding-left: 20px;">
                <h2>Kim</h2>
                <p>

                I have used the "basic" range of Skin Nutrition for quite a while now and when asked to move onto their Advanced Peptide Therapy Range, for the point of these trials, I was really excited.  It's not every day you get the chance to see a "miracle" in the mirror J  Needless to say, after a couple of weeks, my frown lines had softened (thanks to the Dynamic Wrinkle Reducer), and the redness around my cheeks had declined tremendously which I would thank the Complexion Brightening Serum.  My whole family live on the Cleansing Gel, Toner Spritz and Moisturizer, and all have beautiful skin!  I will continue to use these products to ensure those nasty lines never come back and to keep my skin looking youthful and soft.  Thanks Skin Nutrition for an amazing product! 
                </p>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br /><br /></td>
            </tr>
            <tr>
                <td valign="top" style="border-bottom: 4px solid #ebebeb;">

                <table cellpadding="8" cellspacing="0" bgcolor="#ebebeb">
                    <tr>
                        <td align="center"><a href="images/ba/natalie_before_l.jpg" rel="lightbox[4]" title="natalie Before"><img src="images/ba/natalie_before_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href="images/ba/natalie_after_l.jpg" rel="lightbox[4]" title="natalie After"><img src="images/ba/natalie_after_t.jpg" border="0" width="123" /></a></td>
                    </tr>
                </table>
                </td>

                <td valign="top" style="border-bottom: 4px solid #ebebeb; padding-left: 20px;">
                <h2>Natalie</h2>
                <p>
                I have been using Skin Nutrition for the past 6 weeks and have noticed a dramatic, remarkable difference in my skin. My wrinkles and fine lines have diminished, my skin feels brighter and my complexion has a radiant glow.  I love the Dynamic Wrinkle Reducer which has really reduced the frown lines I had and softened my skin dramatically.  Many people have remarked and commented on how youthful my skin looks - Skin Nutrition is my secret to looking youthful.  My pigmentation marks seem to have faded to a point where I no longer need to pack a trio of concealer, base and powder. I feel confident within myself and love the way my skin looks and feels.
                </p>
                </td>
            </tr>
        </table>
        </p>

        </td>
    </tr>
</table>
</div>




</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
