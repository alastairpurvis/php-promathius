<?
////////////////////////////////////////////////////////////////////////////
// Use this file to add new banners on the frontpage
// Keep the width and height constant for bannner images (Width should be 972px and height 348px)
// Banner images are stored in the images/banners
////////////////////////////////////////////////////////////////////////////

?>


<!-- the slide navigation tabs --> 
<div class="slides"> 
    <a href="#"></a>
    <a href="#"></a>
    <a href="#"></a>
    <a href="#"></a>
    <a href="#"></a>
</div>

<!-- Banners --> 
<div class="images"> 
 
    <!-- 1.Nutrissentials --> 
    <div>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td alt="Nutrissentials." valign="top" style="background: url('images/banners/homepage_22.jpg') no-repeat; width: 972px; height: 348px; padding-left: 336px; padding-top:155px; padding-right: 230px">
			  <h2 style="font-size: 20px">100% Natural! &nbsp;100% Efficacious!</h2>
				<p style="font-size: 13px">
				A new naturally clean range of highly bioactive skin care products ("Nutri-cosmetics") that utilise proprietary, patent-pending, nano-encapsulated "super-food" derived ingredients and technologies, which are bio-compatible with our bodies, ensuring maximum utilization, efficacy and optimal skin benefits.
		</p>
			  <p>
			  <a href="<?echo tep_href_link(FILENAME_RANGES, 'cPath=22') ?>">
				<img alt="Learn More" src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" />
				</a>
			</p>
		</td>
			</tr>
		</table>
	</div> 
 
    <!-- 2.Cell CPR --> 
    <div>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td alt="Cell CPR." valign="top" style="background: url('images/banners/homepage_23.jpg') no-repeat; width: 972px; height: 348px; padding-left: 232px; padding-top:178px; padding-right:320px">
				<p style="font-size: 13px">Imagine a skin care product that is so intelligent it mimics our body's own biological process of making new cells unlocking the fountain of youth from within.</p>
			  <p><a href="<?echo tep_href_link(FILENAME_RANGES, 'cPath=25') ?>"><img alt="Learn More" src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a>
			</p>
			</td>
			</tr>
		</table>
	</div> 
 
    <!-- 3.Advanced peptide --> 
    <div>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" style="background: url('images/banners/homepage_21.jpg') no-repeat; width: 972px; height: 348px; padding-left: 235px; padding-top:168px; padding-right: 415px">
					  <h2 style="font-size: 20px">Advanced Peptide Therapy</h2>
				<p style="font-size: 13px">
				Proprietary biotechnologically-engineered peptides, in synergistic blends, used exclusively by Skin Nutrition, to deliver remarkable benefits to the skin.
		</p>
			  <p><a href="<?echo tep_href_link(FILENAME_RANGES, 'cPath=25') ?>"><img alt="Learn More" src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a>
			</p>
			</td>
			</tr>
		</table>
	</div>
	
    <!-- 4.Body's NBFs --> 
    <div>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" style="background: url('images/banners/homepage_24.jpg') no-repeat; width: 972px; height: 348px; padding-left: 272px; padding-top:148px; padding-right: 370px">
					  <h2 style="font-size: 20px">Meet your body's NBF's</h2>
				<p style="font-size: 13px">
				Skin Nutrition Body Beautiful is a range of technologically-advanced body care products that provide a synergistic holistic wellness program for the whole body.
		</p>
			  <p><a href="<?echo tep_href_link(FILENAME_RANGES, 'cPath=23') ?>"><img alt="Learn More" src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a>
			</p>
			</td>
			</tr>
		</table>
	</div> 
	
    <!-- 5.Supplements --> 
    <div>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" style="background: url('images/banners/homepage_25.jpg') no-repeat; width: 972px; height: 348px; padding-left: 584px; padding-top:148px; padding-right: 60px">
					  <h2 style="font-size: 20px">Skin Supplements</h2>
				<p style="font-size: 13px">
				Our unique range of skin supplements are designed to help fight the visible signs of aging at a cellular level. Looking good starts from the inside out.
		</p>
			  <p><a href="<?echo tep_href_link(FILENAME_RANGES, 'cPath=23') ?>"><img alt="Learn More" src="images/buttons/learnmore.jpg" onmouseover="this.src='images/buttons/learnmore_o.jpg';" onmouseout="this.src='images/buttons/learnmore.jpg';" border="0" /></a>
			</p>
			</td>
			</tr>
		</table>
	</div> 
	

</div> 



<script language="JavaScript">
$(function() {
	
	$("div.slides").tabs(".images > div", {
	
		effect: 'fade',
		fadeOutSpeed: "slow",
		rotate: true

	}).slideshow({autoplay: true, clickable: false, interval: 3000});
});
</script>