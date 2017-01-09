
<form action="{S_MODCP_ACTION}" method="post">
  <table width="100%" cellspacing="2" cellpadding="2" align="center">
	<tr> 
	  <td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
  </table>
  <table width="100%" cellpadding="4" cellspacing="0" class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		
		<td align="center" class="forumheader-mid">{MESSAGE_TITLE}</td>
	</tr></table></caption>
</thead>
<tbody>
	<tr> 
	  <td class="row1"> 
		<table width="100%" cellspacing="0" cellpadding="1">
		  <tr> 
			<td>&nbsp;</td>
		  </tr>
		  <tr> 
			<td align="center"><span class="gen">{L_MOVE_TO_FORUM} &nbsp; {S_FORUM_SELECT}<br /><br />
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td><span class="cbstyled"><input type="checkbox" name="move_leave_shadow" checked="checked" /></span></td>
					<td><span class="gen">&nbsp;{L_LEAVESHADOW}</span></td>
				</tr>
				</table>
			  <br />
			  {MESSAGE_TEXT}</span><br />
			  <br />
			  {S_HIDDEN_FIELDS} 
			  <input class="mainoption" type="submit" name="confirm" value="{L_YES}" />
			  &nbsp;&nbsp; 
			  <input class="liteoption" type="submit" name="cancel" value="{L_NO}" />
			</td>
		  </tr>
		  <tr> 
			<td>&nbsp;</td>
		  </tr>
		</table>
	  </td>
	</tr>
	</tbody>
  </table>
</form>
