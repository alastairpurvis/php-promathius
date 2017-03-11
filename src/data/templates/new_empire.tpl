<!-- BEGIN DefaultRegion -->
<input type="text" id="DefaultRegion_{DefaultRegion.ID}" value="{DefaultRegion.TAG}" style="display:none"/>		
<!-- END factionrow -->
<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
{ERROR_BOX}
<table width="100%" cellspacing="2" cellpadding="2" align="center">
	<tr><td></td>
	</tr>
</table>
{Begin_Shadow}
<table cellpadding="3" cellspacing="0" width="100%" align=center class="forumline">
<thead>
	<caption><table cellspacing="0" cellpadding="0" width="100%" class="forumheader">
	<tr>
		<td align="center" class="forumheader-mid">Establish Settlement</td>
	</tr></table></caption>
</thead>
	<tr class="factions">
			<td class="row1" width="100%" colspan="2" style="padding-top:4px; padding-bottom:6pt;padding-left:6px; padding-right:6px" align=center>
<table id="factionmain" border=0 cellspacing="0" cellpadding="0" width=100%>
<tr align=center>
<td style='padding-bottom: 6pt'>
<table width=100% border=0 cellspacing="0" cellpadding="0"><tr>{faction_unlockable_filler}<td align=center><span class="gensmall">Select a faction type by clicking on its symbol</span></td>{faction_unlockables}</tr></table></td>
</tr>
<tr>
<td colspan=2>
	<Table border=0 cellspacing="0" cellpadding="0" width=100%>
	<tr>
	<td valign=top>
		<table border=0 cellspacing="0" cellpadding="0" align=center height=350>
		<!-- BEGIN factionrow -->
		<script language='Javascript' type="text/javascript">setTimeout('changeFaction({DefaultFactionID},"{DefaultFaction}");document.getElementById("selectedregion").value = "";document.getElementById("username").value = "";', 0)</script>
    <tr><td align=center height=1><input type="text" id="{factionrow.NAME_LOW}" value="{factionrow.DESCRIPTION}" style="display:none"/>
	<img src="data/images/symbols/{factionrow.IMAGE}.png" name="img{factionrow.ID}" onClick="changeFaction({factionrow.ID},'{factionrow.NAME_LOW}')" onmousedown="iconDown(this.name)" onmouseover="iconOn(this.name)" alt="" onmouseout="iconOut(this.name)"></td></tr> 
		<!-- END factionrow -->
		<tr><td><br><Br><br><Br></td></tr>
		</table>
	</td>
	<td width="90%" colspan="2" align=left>
	  <div style="text-align:left;width:94%; height:350px;" id="factiondescription">
	  Faction goes here
	  </div>
	</td></tr>
	</table>
</td></tr>
<tr id="sregion" style="display:none"><td align=center><span class="gensmall">Select a region</span></td></tr></table></td>
</tr>
<!-- BEGIN factionregion -->
<tr id="{factionregion.ID}_main" style="display:none">
<td colspan=2 style="padding-left: 30px; padding-right: 20px">
	<Table border=0 cellspacing="2" cellpadding="2" width=100%>
	<tr>
		<td width=16% valign=top align=left class="regionselect" style="padding-top:3px; padding-left:8px">
				<table cellspacing="5" cellpadding="0">
			  <!-- BEGIN regionrow -->
			  <tr><td style="font-size: 12px;padding-top:2px; padding-bottom:2px"><input type="text" id="{factionregion.regionrow.TAG}" value="{factionregion.regionrow.DESCRIPTION}" style="display:none"/><a onclick="changeRegion('{factionregion.regionrow.TAG}','{factionregion.ID}')" style="cursor: pointer">{factionregion.regionrow.NAME}</a></td></tr>
			  <!-- END regionrow -->
			  <tr><td></td></tr>
				</table>
		</td>
		<td style="padding-top:6px; padding-bottom:6px;padding-left:20px; align: center" colspan="2" align=center>
			  <div style="text-align:left;width:100%; height:250px" id="{factionregion.ID}_regiondescription">
			  Region goes here
			  </div>
		</td>
		<td width=20% style="padding: 3px">
			<table border=0 cellspacing="0" cellpadding="0" align=center height=250>
				<tr>
					<td align=center><img src="data/images/symbols/{factionregion.IMAGE}.png" alt="">
					</td>
				</tr> 
				<tr>
					<td>{factionregion.DESCRIPTION}
					</td>
				</tr> 
			</table>
		</td>
	</tr>
	</table>
</td>
</tr>
    <!-- END factionregion -->
	<tr id="empirename" style="display:none"> 
		<td width="50%" style="padding-top:24px; padding-bottom:24px;padding-left:6px">
<table border=0 cellspacing="0" cellpadding="0">
<tr>
<td width=40% align=left style="padding-left: 25px;">
<span style="font-size:9px"><input type="text" id="selectedfaction" name="selectedfaction" size="25" value="{DefaultFactionID}" style="display:none"/><input type="text" id="selectedregion" name="selectedregion" size="25" value="{DEFAULT}" style="display:none"/>An empire name should be both original and simple, while being catchy enough to gain respect. A good empire name would usually follow a similar format to "The Elesian Empire" or "The Kingdom of Isama". It must NOT be the same as your username.</span></td>
</td>
</tr>
</table>
</td>
		<td style="padding-left:6px">
<table border=0 cellspacing="0" cellpadding="0">
<tr>
<td width=40% align=left>
<span class="gen"><b>Settlement Name: </b></span>{EM_ERROR}</td>
<td align=left>
<table cellspacing="0" cellpadding="0" width="214" align=left>
<tr>
<td align=left>
<script type="text/javascript">
<!-- /*<![CDATA[*/
function fixEmp(obj) {
var inputString = obj; // The input text field
var outputString = obj; // The output text field
var tmpStr, tmpChar, preString, postString, strlen;
tmpStr = inputString.value.toLowerCase();
stringLen = tmpStr.length;
if (stringLen > 0)
{
  for (i = 0; i < stringLen; i++)
  {
    if (i == 0)
	{
      tmpChar = tmpStr.substring(0,1).toUpperCase();
      postString = tmpStr.substring(1,stringLen);
      tmpStr = tmpChar + postString;
    }
    else
	{
      tmpChar = tmpStr.substring(i,i+1);
      if (tmpChar == " " && i < (stringLen-1))
	  {
      tmpChar = tmpStr.substring(i+1,i+2).toUpperCase();
      preString = tmpStr.substring(0,i+1);
      postString = tmpStr.substring(i+2,stringLen);
      tmpStr = preString + tmpChar + postString;
      }
    }
  }
}
outputString.value = tmpStr.replace(/[^a-zA-Z ']+/g,'');;
}
/*]]>*/
// -->
</script>
<input type="text" class="{STYLE_PBORDER_EM}" style="width:190px" id="username" name="username" size="26" maxlength="25" value="{USERNAME}" onkeyup="fixEmp(this)" onkeydown="fixEmp(this)" tabindex=1/>
</td>
<td align=left>
{IMG_CROSS_EM}
</td><tr></table>
</td>
</tr>
</table>
		</td>
	</tr>

	<tr> 
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input id="proceedtoregion" onclick="gotoRegionSelector()" type="button" value="Accept Faction" class="mainoption" tabindex=3/><input id="goback" onclick="goBacktoFaction()" type="button" value="Back" class="liteoption" style="display:none"/>&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value="Create Settlement" class="mainoption" style="display:none"/></td>
	</tr>
</tbody>
</table>
{End_Shadow}
</form>

