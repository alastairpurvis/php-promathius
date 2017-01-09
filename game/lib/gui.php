<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
//////////////////////////////////////////
// General Table Shadow
//////////////////////////////////////////

$shadowdata = array();
$shadowdata['begin'] = '
			<table cellspacing="0" cellpadding="0">
			<tr>
			<td align="center" rowspan=2 width=100%>';

			
$shadowdata['end1'] = '
			</td>

			<tr>
			<td style="background: url('.$datadir.'images/gui/shadows/middle-right.png) left top no-repeat;height:100%; ">&nbsp;
				';
// We need to create two shadow projection templates
// 1) Without the smoother head (the help button carries the shadow top)
// 2) With the smoother head
$shadowdata['headopt1'] = "";
$shadowdata['headopt2'] = "<img src='".$datadir."images/gui/shadows/top-right.png' width=7 height=15 alt='' />";

$shadowdata['end2'] = '
			</td></tr>

			<tr>
			<td colspan=2>
			<table cellspacing="0" cellpadding="0" width=100%>
			<tr>
			<td style="text-align:left; vertical-align:top">
			<div>
			<img src="'.$datadir.'images/gui/shadows/bottom-left.png" width=11 height=8 alt="" /></div>
			</td>
			<td style="text-align:left; vertical-align:top" width=100%>
			<div style="background: url('.$datadir.'images/gui/shadows/bottom.png) left top repeat-x;" height=8 alt="" />&nbsp;<div></td>
			<td valign=top style="align: right; text-align:right; vertical-align:top">
			<div><img src="'.$datadir.'images/gui/shadows/bottom-right-lower.png" width=14 height=8 alt="" /></div>
			</td></tr>
			</table>

		</td>
		</tr>
		</table>';


//////////////////////////////////////////
// Empire Stats Shadow & Vine
//////////////////////////////////////////
$shadowvinedata = array();
$shadowvinedata['begin'] = '
<table cellspacing="0" cellpadding="0">
<tr>
<td align="center" rowspan=2>';


$shadowvinedata['end'] = '
<td class="stat-sh" valign="top">

<table cellspacing="0" cellpadding="0">
<tr>
<td style="align: left;vertical-align:top">
<img src="'.$datadir.'images/statshmid.gif" width="6" height="11" alt="" />
</td></tr>
</table></td></tr>

<tr>
<td class="stat-sh" style="align: left; vertical-align:bottom">
<table cellspacing="0" cellpadding="0">
<tr><td style="align: left; vertical-align:bottom">
<img src="'.$datadir.'images/statshbottom.gif" width="8" height="4" alt="" />
</td></tr>
</table>
</td></tr>

<tr>
<td colspan="2" class="stat-shx">

<table cellspacing="0" cellpadding="0" width=100%>
<tr>
<td style="text-align:left; vertical-align:top">
<img src="'.$datadir.'images/statshleft.gif" width="12" height="9" alt="" />
</td>
<td style="text-align:center; vertical-align:top">
<img src="'.$datadir.'images/gui/shadows/resbar/vine.gif" width="216" height="22" alt="" />
</td>
<td valign=top style="align: right; text-align:right; vertical-align:top">
<img src="'.$datadir.'images/statshright.gif" width="15" height="8" alt="" />
</td></tr>
</table>

</td>
</tr>
</table>';

//////////////////////////////////////////
// Tab Skins
//////////////////////////////////////////
$tabdata = array();
$tabdata['begin'] = "<table width=100% cellspacing=0 cellpadding=0>";
$tabdata['activetab'] = '<td class="ActiveTabItem">';
$tabdata['activetabend'] = "</td>";
$tabdata['tab'] = '<td valign="bottom" class="InactiveTabWidth"><div class="InactiveTabItem">';
$tabdata['tabend'] = "</div></td>";
$tabdata['activehelp'] = '<td align="right" valign="bottom"><table cellspacing=0 cellpadding=0><td valign="bottom" class="ActiveTabHelp"></table></td>';
$tabdata['help'] = '<td align="right" valign="bottom"><table cellspacing=0 cellpadding=0><td valign="bottom" class="InactiveTabHelp">';
$tabdata['helpend'] = "</table></td>";
$tabdata['placeholder'] = '<td align="right" valign="bottom"><table cellspacing=0 cellpadding=0><td valign="bottom">';
$tabdata['placeholderend'] = "</table></td>";
$tabdata['end'] = "</table>";


// Assign the graphical elements so that we can use them
if(!$forum){
$shadowdata['end'] = $shadowdata['end1'].$shadowdata['headopt2'].$shadowdata['end2'];
$shadowdata['endsmooth'] = $shadowdata['end1'].$shadowdata['headopt1'].$shadowdata['end2'];
$tpl->assign('Begin_Shadow', $shadowdata['begin']);
$tpl->assign('End_Shadow', $shadowdata['end']);
$tpl->assign('End_Shadow_NoHelp', $shadowdata['endsmooth']);
$tpl->assign('Begin_Shadow_Vine', $shadowvinedata['begin']);
$tpl->assign('End_Shadow_Vine', $shadowvinedata['end']);

$tpl->assign('BeginTabmenu', $tabdata['begin']);
$tpl->assign('oTabActive', $tabdata['activetab']);
$tpl->assign('cTabActive', $tabdata['activetabend']);
$tpl->assign('oTab', $tabdata['tab']);
$tpl->assign('cTab', $tabdata['tabend']);
$tpl->assign('oHelp', $tabdata['help']);
$tpl->assign('cHelp', $tabdata['helpend']);
$tpl->assign('oHelpActive', $tabdata['activehelp']);
$tpl->assign('cDummy', $tabdata['placeholderend']);
$tpl->assign('oDummy', $tabdata['placeholder']);
$tpl->assign('EndTabmenu', $tabdata['end']);
}
else{
    $template->assign_vars(array('Begin_Shadow' => $shadowdata['begin']));
    $template->assign_vars(array('End_Shadow' => $shadowdata['end1'].$shadowdata['headopt1'].$shadowdata['end2']));
}

?>