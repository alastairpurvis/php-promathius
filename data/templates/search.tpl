<form method="post" action="?search{$authstr}" name="do_search">
<table cellspacing="0" cellpadding="0" width=370>
<tr>
<td align="center" class="shlarge" rowspan=2 style="padding-left: 8px; padding-right: 8px">
<table class="inputtable" style="align:center" border=0>
<tr><td>
   <table class="inputtable" width=100%>
           <tr><td class="acenter" colspan=2><b>~ Search by ~</td></td>
        <tr><td class="aleft"><div class="radio selected"> 
  <input type="radio" name="search_type" checked="checked" value="string"><label>Empire Name</label>
</div> </td></td>
            <td style="vertical-align:top; text-align: left; width: 150px; padding: 0px"><input type="text" name="search_string" size="17"></td></tr>
        <tr><td class="aleft" style="vertical-align:top"><div class="radio"> 
  <input type="radio" name="search_type" value="clan" ><label>Clan</label>
</div> </td></td>
            <td style="vertical-align:top; text-align: left; width: 150px"><select name="search_clan" size="1" id="search_clan">
                <option value="0">Unallied Empires</option>
                	{section name=i loop=$clansel}
                    <option value="{$clansel[i].num}">{$clansel[i].name}</option>
				{/section}
            </select></td></tr>
                 <tr><td align=center colspan=3 style="padding-top: 12px"><br /><b>~ Criteria ~</td></td>
        </table>
<table class="inputtable">
    <table class="inputtable" width=100% border=0>
    <tr><td class="aleft" style="vertical-align:top; padding-top: 5px"><label>At Location:</label></td>
        <td colspan='2' style="vertical-align:top; text-align: left; width: 120px"><select name="search_era" id="search_era" size="1">
        <option value="">Any</option>
                	{section name=i loop=$locationsel}
                     <option value="{$locationsel[i].id}">{$locationsel[i].era}</option>
				{/section}  
            </select></td></tr>
                <tr><td class="aleft" style="vertical-align:top; padding-top: 5px"><label>Faction Type:</label></td>
        <td colspan=2><select name="search_race" id="search_race" size="1">
            <option value="" selected>Any</option>
                	{section name=i loop=$factsel}
                     <option value="{$factsel[i].id}">{$factsel[i].race}</option>
				{/section}  
            </select></td></tr>
        <tr><td class="aleft"><label>Maximum Greatness:</label></td>
        <td width=13><input type="checkbox" class="cb" name="search_nw_max" {$chk_search_max}></td><td style="text-align:left"><input type="text" name="search_max_nw" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" size="9" value="{$search_max}"></td></tr>
    <tr><td class="aleft"><label>Minimum Greatness:</label></td>
                <td width=13><input type="checkbox" class="cb" name="search_nw_min" {$chk_search_min}></td><td style="text-align:left"><input type="text" name="search_min_nw" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" size="9" value="{$search_min}"></td></tr>
    <tr><td class="acenter" colspan=2><br /><b>Order by:</b></td></tr><tr>
        <td colspan=2><div class="radio selected"> 
  <input type="radio" name="order_by" value="rank" checked="checked"><label>Greatness</label>
</div></td>
            <td>Exclude dead:</td>
        <td><input type="checkbox" class="cb" name="search_dead"></td></tr>
    <tr>
        <td colspan=2><div class="radio"> 
  <input type="radio" name="order_by" value="empire"><label>{$uera.empireC} Name</label>
</div></td>
    <td class="aleft"><label>Max Results:</label></td>
        <td colspan=1><input type="text" name="searchlimit" size="4" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');" value="{$search_limit}"></td></tr>
    <tr>
        <td colspan=2><div class="radio"> 
  <input type="radio" name="order_by" value="clan"><label>Clan</label>
</div></td></tr>
    </table></td>

<tr><td colspan="2" style="text-align:right; padding-bottom: 6px"><input type="submit" name="do_search" value="Begin Search" class="mainoption"></td></tr>
</table>
{$End_Shadow}
</form>