{if $err != ""}
<span class="error-font"><b>{$err}</b></span><br /><br /><br />
{/if}
{if $bountyset != ""}
	<b>{$bountyset}</b>
<br />
<br />
{/if}
<span style="font-size: 10px"><a href="?mission{$authstr}">Current missions</a>{if $left != 0} | <b>Create Mission</b>{/if}<br />
<br />
{if $left == 0}
{/if}
{if $left != 0}
You can have {$max} mission{if $max > 1}s{/if} at a single time. You have {if $left == 0}no posts{/if}{if $left > 1}{$left} posts{/if}{if $left == 1}1 post{/if} left.<br />
 Leave a condition blank if you would not like to include it.<br />
<br />

{* I decided against doing impure templates here *}


{if $editing == ""}

{if $view == ""} <a href="{$main}?mission&amp;view=true{$authstr}">View Current Missions</a><br />
<br />
<br />
{/if}


{literal}
<script language="JavaScript">

function updateMsgNames() {
        msgnum = document.frmmsg.targ.value;
        nchanged = true
        for (i = 0; i < document.frmmsg.msg_dest.options.length; i++) {
                 if (document.frmmsg.msg_dest.options[i].value == msgnum) {
                        document.frmmsg.msg_dest.options[i].selected = true;
                        nchanged = false;
                }
        }
        if (nchanged) {
                document.frmmsg.do_set.disabled = true;
        } else {
                document.frmmsg.do_set.disabled = false;
        }
}
function updateMsgNums() {
        document.frmmsg.targ.value = document.frmmsg.msg_dest.value;
                document.frmmsg.do_set.disabled = false;
}

</script>
{/literal}
    <form method="post" name="frmmsg" action="{$main}?missioncreate{$authstr}">
 
<table width='63%'><tr><td width='50%' style='vertical-align:top; padding-top: 5px'>Set mission target:&nbsp;</td><td>
          <select name="targ" id="targ" onClick="updateMsgNums()" class="dkbg" style="font-size:11px">
            
        {section name=dropsel loop=$drop}
                
            <option value="{$drop[dropsel].num}" class="m{$drop[dropsel].color}"{if $set==1}{if $prof_target == $drop[dropsel].num} selected {/if}{/if}>{$drop[dropsel].empire}</option>
            
        {/section}

          </select></td></tr></table>
          <br />
<table border=0 cellpadding=0 cellspacing=0>
<tr>
  <td width=10%>&nbsp;</td>
  <td>
  <table cellspacing="0" cellpadding="0" width=290>
    <tr>
    
    <td align="center" class="shlarge" rowspan=2 style="padding-bottom: 12px">
   
    <table border=0 width=240 style="padding-top: 5px">
      <tr>
      <tr><td class="acenter" colspan=2><span class="gensmall"><b>~ Objective ~</b></span></td></tr>
      <tr>
        <th style="font-size:9px; text-align:left" width=100%>Land to</th>
        <td class="aright"><input type="text" name="land_drop" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      </tr>
      <tr>
        <th style="font-size:9px; text-align:left">Reduce Rank to</th>
        <td class="aright"><input type="text" name="rank_drop" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      </tr>
      <tr>
        <th style="font-size:9px; text-align:left">{$lang.greatness} to</th>
        <td class="aright"><input type="text" name="net_drop" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
      </tr>
      <th style="font-size:9px; text-align:left">Post Anonymously</th>
        <td><input type="checkbox" class=cb name="anon" value="1"></td>
      </tr>
    </table>
    </td>
    
    {$End_Shadow}
    </td>
    <td style="vertical-align:top" width=10%><table cellspacing="0" cellpadding="0"><tr><td class="helpbutton"><a href="?guide&section={$action}" title="{$lang.helpbutton}" tabindex="4"><img src="{$dat}images/spacer.gif" width=100% height=100% alt="{$lang.helpbutton}" /></a></td></tr></a></table></td>
    </tr>
    
  </table>
  <table cellspacing="0" cellpadding="0" width=290>
    <tr>
      <td align="center" class="shlarge" rowspan=2 style="padding-bottom: 6px"><table border=0 width=240 style="padding-top: 5px">
      <tr><td class="acenter" colspan=2><span class="gensmall"><b>~ Reward ~</b></span></td></tr>
          <th style="font-size:9px; text-align:left">{$cashname}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$cansend.cash})</th>
            <td class="aright"><input type="text" name="cash_give" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
          </tr>
          <th style="font-size:9px; text-align:left">{$runesname}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$cansend.runes})</th>
            <td class="aright"><input type="text" name="rune_give" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
          </tr>
          <th style="font-size:9px; text-align:left">{$foodname}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$cansend.food})</th>
            <td class="aright"><input type="text" name="food_give" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
          </tr>
          {section name=give loop=$givetroops}
          <tr>
            <th style="font-size:9px;text-align:left">{$givetroops[give].name}&nbsp;&nbsp;&nbsp;&nbsp;(Max: {$givetroops[give].cansend|gamefactor})</th>
            <td class="aright"><input type="text" name="troop[{$givetroops[give].id}]" size="7" autocomplete="off" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g, '');"></td>
          </tr>
          {/section}
          <tr>
          <td colspan=2 style="padding-top: 8px; padding-bottom: 2px">* A fee of {$percent}% will be charged.<br />
* Anonymous posts are charged {$percent*2}%.<br/></td></tr>
          <tr>
            <td colspan=2 class="acenter"><br /><input type="submit" name="do_set" value="Create Mission" class="mainoption">
        </table>
        </td>
        {$End_Shadow}
  </form>
  {/if} </span> 
  {/if}