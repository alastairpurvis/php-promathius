 
<table width="100%" cellspacing="2" cellpadding="2" align="center">
  <tr> 
	<td align="left" valign="bottom"><span class="maintitle">{L_SEARCH_MATCHES}</span><br /></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" align="center">
  <tr> 
	<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>

{Begin_Shadow}
<table cellpadding="3" cellspacing="0" width="100%" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		
		<td align="center" class="forumheader-mid">{L_SEARCH_MATCHES}</td>
	</tr></table></caption>
</thead>
<tbody>
  <tr> 
	<th class="forum" width="150">{L_AUTHOR}</th>
	<th class="forum" width="100%">{L_MESSAGE}</th>
  </tr>
  <!-- BEGIN searchresults -->
  <tr> 
	<td class="row1" colspan="2"><span class="topictitle">{L_TOPIC}:&nbsp;<a href="{searchresults.U_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a></span></td>
  </tr>
  <tr> 
	<td width="150" align="center" valign="top" class="row1" rowspan="2"><span class="postername"><b>{searchresults.POSTER_NAME}</b></span><br />
	  <br />
	  <div align="left" class="posterprofile">
		{L_REPLIES}: {searchresults.TOPIC_REPLIES}<br />
		{L_VIEWS}: {searchresults.TOPIC_VIEWS}
	  </div>
	  <img src="../data/images/forums/spacer.gif" width="120" height="1" alt="" />
	</td>
	<td width="100%" valign="top" class="row1"><img src="{searchresults.MINI_POST_IMG}" width="12" height="9" alt="{searchresults.L_MINI_POST_ALT}" title="{searchresults.L_MINI_POST_ALT}" /><span class="postdetails">{L_FORUM}:&nbsp;<b><a href="{searchresults.U_FORUM}" class="postdetails">{searchresults.FORUM_NAME}</a></b>&nbsp; &nbsp;{L_POSTED}: {searchresults.POST_DATE}&nbsp; &nbsp;{L_SUBJECT}: <b><a href="{searchresults.U_POST}">{searchresults.POST_SUBJECT}</a></b></span></td>
  </tr>
  <tr>
	<td valign="top" class="row1"><span class="postbody">{searchresults.MESSAGE}</span></td>
  </tr>
  <tr>
	<td class="spaceRow" colspan="2"><img src="../data/images/forums/spacer.gif" width="1" height="2" alt="" /></td>
  </tr>
  <!-- END searchresults -->
 </tbody>
</table>
{End_Shadow}

<table width="100%" cellspacing="2" align="center" cellpadding="2">
  <tr> 
	<td align="left" valign="top"><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" align="center">
  <tr> 
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
