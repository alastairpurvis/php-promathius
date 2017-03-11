
<table width="100%" cellspacing="2" cellpadding="2" align="center">
	<tr>
		<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
</table>

<table class="forumline" width="100%" cellspacing="0" cellpadding="3" align="center">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">{L_FAQ_TITLE}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr>
		<td class="row1">
			<!-- BEGIN faq_block_link -->
			<span class="gen"><b>{faq_block_link.BLOCK_TITLE}</b></span><br />
			<!-- BEGIN faq_row_link -->
			<span class="gen"><a href="{faq_block_link.faq_row_link.U_FAQ_LINK}" class="postlink">{faq_block_link.faq_row_link.FAQ_LINK}</a></span><br />
			<!-- END faq_row_link -->
			<br />
			<!-- END faq_block_link -->
		</td>
	</tr>
</tbody>
</table>

<br class="spacer" />

<!-- BEGIN faq_block -->
<table class="forumline" width="100%" cellspacing="0" cellpadding="3" align="center">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">{faq_block.BLOCK_TITLE}</td>
	</tr></table></caption>
</thead>
	<!-- BEGIN faq_row -->  
	<tr> 
		<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody"><a name="{faq_block.faq_row.U_FAQ_ID}"></a><b>{faq_block.faq_row.FAQ_QUESTION}</b></span><br /><span class="postbody">{faq_block.faq_row.FAQ_ANSWER}<br /><a class="postlink" href="#top">{L_BACK_TO_TOP}</a></span></td>
	</tr>
	<tr>
		<td class="spaceRow" height="1"><img src="../data/images/forums/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END faq_row -->
</tbody>
</table>

<br class="spacer" />
<!-- END faq_block -->

<table width="100%" cellspacing="2" align="center">
	<tr>
		<td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><br />{JUMPBOX}</td> 
	</tr>
</table>
