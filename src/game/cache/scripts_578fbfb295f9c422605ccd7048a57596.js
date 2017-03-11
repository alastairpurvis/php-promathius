<!--
var db=(document.body)?1:0;var scroll=(window.scrollTo)?1:0;function setCookie(name,value,expires,path,domain,secure){var curCookie=name+"="+escape(value)+
((expires)?"; expires="+expires.toGMTString():"")+
((path)?"; path="+path:"")+
((domain)?"; domain="+domain:"")+
((secure)?"; secure":"");document.cookie=curCookie;}
function getCookie(name){var dc=document.cookie;var prefix=name+"=";var begin=dc.indexOf("; "+prefix);if(begin==-1){begin=dc.indexOf(prefix);if(begin!=0)return null;}else{begin+=2;}
var end=document.cookie.indexOf(";",begin);if(end==-1)end=dc.length;return unescape(dc.substring(begin+prefix.length,end));}
function saveScroll(){if(!scroll)return;var now=new Date();now.setTime(now.getTime()+365*24*60*60*1000);var x=(db)?document.body.scrollLeft:pageXOffset;var y=(db)?document.body.scrollTop:pageYOffset;setCookie("xy",x+"_"+y,now);}
function loadScroll(){if(!scroll)return;var xy=getCookie("xy");if(!xy)return;var ar=xy.split("_");if(ar.length==2)scrollTo(parseInt(ar[0]),parseInt(ar[1]));}
var CC_isIE=document.all;var CC_isNE=document.getElementById&&!document.all;var CC_cbImage="data/images/gui/cb.png";var CC_cbHeight=13;var CC_cbWidth=13;var CC_coordHover=13;var CC_coordMdown=26;var CC_coordMrev=39;var CC_coordClick=52;var CC_coordHoverDown=65;function styleCheckBox(cn)
{if(!cn){window.alert("Please define a check box class name to style.");return false;}
if(!CC_cbImage||!CC_cbHeight||!CC_cbWidth)return false;if(!CC_coordHover||!CC_coordMdown||!CC_coordMrev||!CC_coordClick||!CC_coordHoverDown)return false;var cb=document.getElementsByTagName("INPUT");var cl=cb.length;for(var i=0;i<cl;i++){var ccb=cb[i];var ccn=ccb.className;var ccna=ccn.split(" ");var ccnal=ccna.length;var pf=false;ccb.id="CC_cb"+i;if(ccnal==1){if(ccn==cn)pf=true;}else{for(var j=0;j<ccnal;j++){if(ccna[j]==cn)pf=true;}}
if(pf){ccb.style.display="none";if(ccb.parentNode){var ncb=document.createElement("DIV");ncb.style.fontSize="0";ncb.style.cursor="pointer";ncb.style.width=CC_cbWidth+"px";ncb.style.height=CC_cbHeight+"px";ncb.style.background="url("+CC_cbImage+")";ncb.style.marginRight="2px";if(CC_isNE){ncb.style.display="-moz-inline-box";ncb.style.verticalAlign="11px";}else{}
if($("CC_cb"+i).checked){ncb.style.backgroundPosition="0 -"+CC_coordClick+"px";}
var ne=ccb.parentNode.insertBefore(ncb,ccb.nextSibling);ne.id="CC_checkbox"+i;var cid;var mi=false;$("CC_checkbox"+i).onmouseover=function(){cid=getRealId(this.id);if(!$("CC_cb"+cid).checked){this.style.backgroundPosition="0 -"+CC_coordHover+"px";}
else if($("CC_cb"+cid).checked){this.style.backgroundPosition="0 -"+CC_coordHoverDown+"px";}}
$("CC_checkbox"+i).onmouseout=function(){this.style.backgroundPosition=!$("CC_cb"+cid).checked?"top":"0 -"+CC_coordClick+"px";}
$("CC_checkbox"+i).onmousedown=function(){this.style.backgroundPosition=!$("CC_cb"+cid).checked?"0 -"+CC_coordMdown+"px":"0 -"+CC_coordMrev+"px";mi=true;}
$("CC_checkbox"+i).onmouseup=function(){if(mi){this.style.backgroundPosition=!$("CC_cb"+cid).checked?"0 -"+CC_coordClick+"px":"top";$("CC_cb"+cid).checked=!$("CC_cb"+cid).checked;}
mi=false;}}}}}
function getRealId(Id)
{return Id.replace(/[^\d]+/,"");}
function $(Id)
{if(document.getElementById){return document.getElementById(Id);}else if(document.all){return document.all[Id];}}
var Input={initialize:function(){if(document.getElementsByTagName("form")){var divs=document.getElementsByTagName("div");for(var int=0;int<divs.length;int++){if(divs[int].className.match("radio")){divs[int].onmousedown=Input.effect;divs[int].onmouseup=Input.handle;window.onmouseup=Input.clear;}}}},effect:function(){if(this.className=="checkbox"||this.className=="radio"){this.style.backgroundPosition="0 -26px";}else{this.style.backgroundPosition="0 -79px";}},handle:function(){selector=this.getElementsByTagName("input")[0];if(this.className=="checkbox"){selector.checked=true;this.className="checkbox selected";this.style.backgroundPosition="0 -52px";}else if(this.className=="checkbox selected"){selector.checked=false;this.className="checkbox";this.style.backgroundPosition="0 0";}else{selector.checked=true;this.className="radio selected";this.style.backgroundPosition="0 -52px";inputs=document.getElementsByTagName("input");for(int=0;int<inputs.length;int++){if(inputs[int].getAttribute("name")==selector.getAttribute("name")){if(inputs[int]!=selector){inputs[int].parentNode.className="radio";inputs[int].parentNode.style.backgroundPosition="0 0";}}}}},clear:function(){divs=document.getElementsByTagName("div");for(var int=0;int<divs.length;int++){if(divs[int].className=="checkbox"||divs[int].className=="radio"){divs[int].style.backgroundPosition="0 0";}else if(divs[int].className=="checkbox selected"||divs[int].className=="radio selected"){divs[int].style.backgroundPosition="0 -52px";}}}}
window.onload=Input.initialize;function selectReplacement(obj){obj.className+=' replaced';var ul=document.createElement('ul');ul.className='selectReplacement';var opts=obj.options;var selectedOpt=(!obj.selectedIndex)?0:obj.selectedIndex;for(var i=0;i<opts.length;i++){var li=document.createElement('li');var txt=document.createTextNode(opts[i].text);li.appendChild(txt);li.selIndex=i;li.selectID=obj.id;li.onclick=function(){selectMe(this);};if(i==selectedOpt){li.className='selected';li.onclick=function(){this.parentNode.className+=' selectOpen';this.onclick=function(){selectMe(this);};};}
if(window.attachEvent){li.onmouseover=function(){this.className+=' hover';};li.onmouseout=function(){this.className=this.className.replace(new RegExp(" hover\\b"),'');};}
ul.appendChild(li);}
obj.onfocus=function(){ul.className+=' selectFocused';};obj.onblur=function(){ul.className='selectReplacement';};obj.onchange=function(){var idx=this.selectedIndex;selectMe(ul.childNodes[idx]);};obj.onkeypress=obj.onchange;obj.parentNode.insertBefore(ul,obj);}
function selectMe(obj){var lis=obj.parentNode.getElementsByTagName('li');for(var i=0;i<lis.length;i++){if(lis[i]!=obj){lis[i].className='';lis[i].onclick=function(){selectMe(this);};}else{setVal(obj.selectID,obj.selIndex);obj.className='selected';obj.parentNode.className=obj.parentNode.className.replace(new RegExp(" selectOpen\\b"),'');obj.onclick=function(){obj.parentNode.className+=' selectOpen';this.onclick=function(){selectMe(this);};};}}}
function setVal(objID,val){var obj=document.getElementById(objID);obj.selectedIndex=val;}
function setForm(){var s=document.getElementsByTagName('select');for(var i=0;i<s.length;i++){selectReplacement(s[i]);}}
function loadScripts(){loadScroll();turntimer();Input.initialize();}
function prepareExit(){Turnbox.slideup();closeNoteBox();}
function unloadScripts(){if(typeof saveScroll=='function'){saveScroll();}}
function footer(){setForm();tabberAutomatic(tabberOptions);styleCheckBox("cb");leftMenu=new SlideMenu("leftmenu");leftMenu.init();rightMenu=new SlideMenu("rightmenu");rightMenu.init();clickbuttons();if(typeof buttonfaderenabled!="undefined")
buttonFader.init();}
function openTurnWindow(){Turnbox.toggle();setTimeout('opacity("economy", 0, 100, 800)',750);setTimeout('opacity("population", 0, 100, 800)',800);setTimeout('opacity("agriculture", 0, 100, 800)',900);setTimeout('opacity("turnorder", 0, 100, 800)',925);setTimeout('opacity("turnaction", 0, 100, 800)',950);setTimeout('opacity("turnresult", 0, 100, 300)',700);}
function openNoteBox(){Notebox.toggle();opacity("notebox",0,100,1000);}
function closeNoteBox(){opacity('notebox',100,0,100);Notebox.toggle();}
function clickbuttons(){var tabs=document.getElementsByClassName("InactiveTabItem");var helptab=document.getElementsByClassName("InactiveTabHelp");var mainoptions=document.getElementsByClassName("mainoption");writeClick(tabs);writeClick(helptab);writeClick(mainoptions);}
function writeClick(cclass){for(var i=0;i<cclass.length;i++)
{cclass[i].hideFocus=true;var defclass=cclass[i].className;cclass[i].onblur=function()
{this.className=defclass;return false;}
cclass[i].onmouseup=function()
{this.className=defclass;return false;}
cclass[i].onmousedown=function()
{this.className=defclass+' click';return true;}
cclass[i].onmouseout=function()
{this.className=defclass;return false;}}}
document.getElementsByClassName=function(cl){var retnode=[];var myclass=new RegExp('\\b'+cl+'\\b');var elem=this.getElementsByTagName('*');for(var i=0;i<elem.length;i++){var classes=elem[i].className;if(myclass.test(classes))retnode.push(elem[i]);}
return retnode;};function animatedcollapse(divId,animatetime,persistexpand,reset){this.divId=divId;this.divObj=document.getElementById(divId);this.divObj.style.overflow="hidden";this.timelength=animatetime;this.isExpanded=animatedcollapse.getCookie('promethius_'+divId);if(this.isExpanded=='yes'){this.divObj.style.display='';}
this.contentheight=parseInt(this.divObj.style.height);var thisobj=this;if(isNaN(this.contentheight)){animatedcollapse.dotask(window,function(){thisobj._getheight(persistexpand)},"load");if(!persistexpand||persistexpand&&this.isExpanded!="yes"){if(reset){this.divObj.style.visibility="hidden";}}}
else if(this.isExpanded!="yes"){this.divObj.style.height=0;}
if(persistexpand){animatedcollapse.dotask(window,function(){animatedcollapse.setCookie('promethius_'+thisobj.divId,thisobj.isExpanded)},"unload");}}
animatedcollapse.prototype._getheight=function(persistexpand,reset){this.contentheight=this.divObj.offsetHeight;if(!persistexpand||persistexpand&&this.isExpanded!="yes"){if(!reset){this.divObj.style.height=0;this.divObj.style.visibility="visible";this.divObj.style.height=this.contentheight+"px";}}
else
this.divObj.style.height=this.contentheight+"px";}
animatedcollapse.prototype._slideengine=function(direction){var elapsed=new Date().getTime()-this.startTime;var thisobj=this;if(elapsed<this.timelength){var distancepercent=(direction=="down")?animatedcollapse.curveincrement(elapsed/this.timelength):1-animatedcollapse.curveincrement(elapsed/this.timelength);this.divObj.style.height=distancepercent*this.contentheight+"px";this.runtimer=setTimeout(function(){thisobj._slideengine(direction)},10);}
else{this.divObj.style.height=(direction=="down")?this.contentheight+"px":0;this.isExpanded=(direction=="down")?"yes":"no";this.runtimer=null;}}
animatedcollapse.prototype.slidedown=function(){if(typeof this.runtimer=="undefined"||this.runtimer==null){if(isNaN(this.contentheight))
alert("Please wait until document has fully loaded then click again");else if(parseInt(this.divObj.style.height)==0){this.startTime=new Date().getTime();this._slideengine("down");this.divObj.style.display='';}}}
animatedcollapse.prototype.slideup=function(){if(typeof this.runtimer=="undefined"||this.runtimer==null){if(isNaN(this.contentheight))
alert("Please wait until document has fully loaded then click again");else if(parseInt(this.divObj.style.height)==this.contentheight){this.startTime=new Date().getTime();this._slideengine("up");}}}
animatedcollapse.prototype.toggle=function(){if(parseInt(this.divObj.style.height)==0){this.slidedown();}
else if(parseInt(this.divObj.style.height)==this.contentheight){this.slideup();}}
animatedcollapse.curveincrement=function(percent){return(1-Math.cos(percent*Math.PI))/2;}
animatedcollapse.dotask=function(target,functionref,tasktype){var tasktype=(window.addEventListener)?tasktype:"on"+tasktype;if(target.addEventListener)target.addEventListener(tasktype,functionref,false);else if(target.attachEvent)target.attachEvent(tasktype,functionref);}
animatedcollapse.getCookie=function(Name){var re=new RegExp(Name+"=[^;]+","i");if(document.cookie.match(re))
return document.cookie.match(re)[0].split("=")[1];return""}
animatedcollapse.setCookie=function(name,value,days){if(typeof days!="undefined"){var expireDate=new Date();var expstring=expireDate.setDate(expireDate.getDate()+days);document.cookie=name+"="+value+"; expires="+expireDate.toGMTString();}
else
document.cookie=name+"="+value;}
function updateAtkNames(){var msgnum=document.atksel.target.value;for(i=0;i<document.atksel.target_num.options.length;++i){if(document.atksel.target_num.options[i].value==msgnum)document.atksel.target_num.options[i].selected=true;}}
function updateAtkNums(){document.atksel.target.value=document.atksel.target_num.value;}
function updatemissionNames(){var msgnum=document.missionsel.target.value;for(i=0;i<document.missionsel.target_num.options.length;++i){if(document.missionsel.target_num.options[i].value==msgnum)document.missionsel.target_num.options[i].selected=true;}}
function updatemissionNums(){document.missionsel.target.value=document.missionsel.target_num.value;}
function updateAllNames(){updateAtkNames();updatemissionNames();}
var myMenu;window.onload=function(){updateAllNames;Input.initialize();}
function updateMsgNames(){msgnum=document.frmmsg.msg_dest_num.value;nchanged=true;for(i=0;i<document.frmmsg.msg_dest.options.length;i++){if(document.frmmsg.msg_dest.options[i].value==msgnum){document.frmmsg.msg_dest.options[i].selected=true;nchanged=false;}}}
function updateMsgNums(){document.frmmsg.msg_dest_num.value=document.frmmsg.msg_dest.value;}
function disableCheckbox(item){item2="document.diplo."+item;item2.checked=false;itemlayer2=item+'Opt';document.getElementById(itemlayer2).style.display="none";}
function toggleDiplomacyOption(it,item,itcheck){if(item.checked)
{vis="";}
else
{itcheck.checked=false;document.getElementById('CC_checkbox'+getRealId(itcheck.id)).style.backgroundPosition="left top";vis="none";}
document.getElementById(it).style.display=vis;}
function toggleDiplomacyOptionReverse(itx,itemx,itcheckx){if(!itemx.checked)
{vis="";}
else
{itcheckx.checked=false;document.getElementById('CC_checkbox'+getRealId(itcheckx.id)).style.backgroundPosition="left top";vis="none";}
document.getElementById(itx).style.display=vis;}
function initCurrencyDialog(){document.write('<form name="gold_demand_form" onsubmit="return validateGold()" action="#" ><div id="goldbox_demand" style="text-align:center;display:none"><br><br><b>How much gold do you demand?</b><br><br><input type="text" name="gold_demand_dialog" size="7" max="10" maxlength="8" autocomplete="off" value=""><br><br><input type="button" name="" value="Make Demand" class="mainoption" onclick="if(document.gold_demand_form.gold_demand_dialog.value > 0) {updateGoldDemand(currency, mony_prefix);document.getElementById('+"'diplomacybox'"+').style.display = '+"''"+';document.getElementById('+"'goldbox_demand'"+').style.display = '+"'none'"+';document.diplo.do_diplomacy.style.display = '+"''"+';}"><br></div></form>');document.write('<form name="gold_offer_form" onsubmit="return validateGold()" action="#" ><div id="goldbox_offer" style="text-align:center;display:none"><br><br><b>How much gold do you wish to offer?</b><br><br><input type="text" name="gold_offer_dialog" size="7" max="10" maxlength="8" autocomplete="off" value=""><br><br><input type="button" name="" value="Make Offer" class="mainoption" onclick="if(document.gold_offer_form.gold_offer_dialog.value > 0 && document.gold_offer_form.gold_offer_dialog.value < maxmoney){updateGoldOffer(currency, mony_prefix);document.getElementById('+"'diplomacybox'"+').style.display = '+"''"+';document.getElementById('+"'goldbox_offer'"+').style.display = '+"'none'"+';document.diplo.do_diplomacy.style.display = '+"''"+';}"><br></div></form>');}
function checkboxGoldDemand(){if(document.diplo.gold_demand1.checked)
{if(!document.diplo.gold_demand_real.value)
{document.getElementById('diplomacybox').style.display='none';document.diplo.do_diplomacy.style.display='none';document.getElementById('goldbox_demand').style.display='';disableGoldeOff(currency)}}
else
{document.diplo.gold_demand_real.value='';document.gold_demand_form.gold_demand_dialog.value='';updateGoldDemand(currency,mony_prefix);document.getElementById('gofferchbox').style.display='';}}
function checkboxGoldOffer(){if(document.diplo.gold_offer1.checked)
{if(!document.diplo.gold_offer_real.value)
{document.getElementById('diplomacybox').style.display='none';document.diplo.do_diplomacy.style.display='none';document.getElementById('goldbox_offer').style.display='';disableGoldeDem(currency)}}
else
{document.diplo.gold_offer_real.value='';document.gold_offer_form.gold_offer_dialog.value='';updateGoldOffer(currency,mony_prefix);document.getElementById('gdemandchbox').style.display='';}}
function checkboxEndWar(){toggleDiplomacyOption("allianceOpt",document.diplo.end_war,document.diplo.alliance);toggleDiplomacyOption("trade_rightsOpt",document.diplo.end_war,document.diplo.trade_rights);if(!document.diplo.end_war.checked)
{toggleDiplomacyOption("military_rightsOpt",document.diplo.end_war,document.diplo.military_rights);document.getElementById("military_rightsOpt").style.display="none";}}
function checkboxAllowDiplomacy(){if(document.diploctrl.allow_diplomacy.checked)
{document.getElementById('declare_bt').style.display='';document.getElementById('diplomacybox').style.display='none';}
if(!document.diploctrl.allow_diplomacy.checked)
{document.getElementById('declare_bt').style.display='none';document.getElementById('diplomacybox').style.display='';}}
function checkboxProhibitDiplomacy(){if(document.diploctrl.prohibit_diplomacy.checked)
{document.getElementById('declare_bt').style.display='';document.getElementById('diplomacybox').style.display='none';}
if(!document.diploctrl.prohibit_diplomacy.checked)
{document.getElementById('declare_bt').style.display='none';document.getElementById('diplomacybox').style.display='';}}
function checkboxEndMilitary(){if(document.diploctrl.end_military.checked)
{document.getElementById('declare_bt').style.display='';document.getElementById('diplomacybox').style.display='none';}
if(document.diploctrl.end_alliance.checked)
{document.diploctrl.end_military.checked=true;document.getElementById('CC_checkbox'+getRealId(document.diploctrl.end_military.id)).style.backgroundPosition="0 -"+CC_coordClick+"px";}
if(!document.diploctrl.end_alliance.checked&&!document.diploctrl.end_trade.checked&&!document.diploctrl.end_military.checked)
{document.getElementById('declare_bt').style.display='none';document.getElementById('diplomacybox').style.display='';}}
function checkboxEndTrade(){if(document.diploctrl.end_trade.checked)
{document.getElementById('declare_bt').style.display='';document.getElementById('diplomacybox').style.display='none';}
if(!document.diploctrl.end_alliance.checked&&!document.diploctrl.end_trade.checked&&!document.diploctrl.end_military.checked)
{document.getElementById('declare_bt').style.display='none';document.getElementById('diplomacybox').style.display='';}}
function checkboxAlliance(){if(document.diploctrl.end_alliance.checked)
{document.getElementById('declare_bt').style.display='';document.getElementById('diplomacybox').style.display='none';if(milagree)
{document.diploctrl.end_military.checked=true;document.getElementById('CC_checkbox'+getRealId(document.diploctrl.end_military.id)).style.backgroundPosition="0 -"+CC_coordClick+"px";}}
if(!document.diploctrl.end_trade.checked&&!document.diploctrl.end_alliance.checked&&!document.diploctrl.end_military.checked)
{document.getElementById('declare_bt').style.display='none';document.getElementById('diplomacybox').style.display='';}}
function validateGold(){return false;}
function disableGoldeOff(money){document.diplo.gold_offer1.checked=false;document.getElementById('CC_checkbox'+getRealId(document.diplo.gold_offer1.id)).style.backgroundPosition="left top";document.diplo.gold_offer_real.value='';document.gold_offer_form.gold_offer_dialog.value='';var updateredit=document.getElementById('edit_goffer');updateredit.innerHTML="";var updatero=document.getElementById('gold_offer_display');updatero.innerHTML=money;document.getElementById('gofferchbox').style.display='none';}
function disableGoldeDem(money){document.diplo.gold_demand1.checked=false;document.getElementById('CC_checkbox'+getRealId(document.diplo.gold_demand1.id)).style.backgroundPosition="left top";document.diplo.gold_demand_real.value='';document.gold_demand_form.gold_demand_dialog.value='';var updateredit=document.getElementById('edit_gdemand');updateredit.innerHTML="";var updaterd=document.getElementById('gold_demand_display');updaterd.innerHTML=money;document.getElementById('gdemandchbox').style.display='none';}
function updateGoldDemand(money,prefix){var updaterd=document.getElementById('gold_demand_display');theval='';if(document.gold_demand_form.gold_demand_dialog.value)
theval=parseFloat(document.gold_demand_form.gold_demand_dialog.value);updaterd.innerHTML=prefix+theval+money;var updateredit=document.getElementById('edit_gdemand');if(document.gold_demand_form.gold_demand_dialog.value){updateredit.innerHTML="<a style='cursor: pointer' onclick="+'"'+"if(document.diplo.gold_demand1.checked){document.getElementById('diplomacybox').style.display = 'none';document.getElementById('goldbox_demand').style.display = '';}"+'"'+">(edit)</a>";}
else
{updateredit.innerHTML="";}
document.diplo.gold_demand_real.value=theval;}
function updateGoldOffer(money,prefix){var updatero=document.getElementById('gold_offer_display');theval='';if(document.gold_offer_form.gold_offer_dialog.value)
theval=parseFloat(document.gold_offer_form.gold_offer_dialog.value);updatero.innerHTML=prefix+theval+money;var updateredit=document.getElementById('edit_goffer');if(document.gold_offer_form.gold_offer_dialog.value){updateredit.innerHTML="<a style='cursor: pointer' onclick="+'"'+"if(document.diplo.gold_offer1.checked){document.getElementById('diplomacybox').style.display = 'none';document.getElementById('goldbox_offer').style.display = '';}"+'"'+">(edit)</a>";}
else
{updateredit.innerHTML="";}
document.diplo.gold_offer_real.value=theval;}
function checkAll(check){var path=document.frmmsg;for(var i=0;i<path.elements.length;i++){e=path.elements[i];checkname="maxall";if(check==2)checkname="maxall2";if((e.name!=checkname)&&(e.type=="checkbox")&&(e.name!="hide_turns")){e.checked=path.maxall.checked;if(check==2)e.checked=path.maxall2.checked;}}}
function SlideMenu(id){if(!document.getElementById||!document.getElementsByTagName)
return false;this.menu=document.getElementById(id);this.submenus=this.menu.getElementsByTagName("div");this.remember=true;this.speed=3;this.oneSmOnly=false;}
SlideMenu.prototype.init=function(){var mainInstance=this;for(var i=0;i<this.submenus.length;i++)
this.submenus[i].getElementsByTagName("span")[0].onclick=function(){mainInstance.toggleMenu(this.parentNode);};var links=this.menu.getElementsByTagName("a");for(var i=0;i<links.length;i++){links[i].className=links[i].className;links[i].onblur=function()
{this.className='';return false;}
links[i].onmouseup=function()
{this.className=this;return false;}
links[i].onmousedown=function()
{this.className=this+' clickdown';return true;}
links[i].onmouseout=function()
{this.className=this;return false;}}
if(this.remember){var regex=new RegExp("promAthius_menu_"+encodeURIComponent(this.menu.id)+"=([01]+)");var match=regex.exec(document.cookie);if(match){var states=match[1].split("");for(var i=0;i<states.length;i++)
this.submenus[i].className=(states[i]==0?"collapsed":"");}}};SlideMenu.prototype.toggleMenu=function(submenu){if(submenu.className=="collapsed")
this.expandMenu(submenu);else
this.collapseMenu(submenu);};SlideMenu.prototype.expandMenu=function(submenu){var fullHeight=submenu.getElementsByTagName("span")[0].offsetHeight;var links=submenu.getElementsByTagName("a");for(var i=0;i<links.length;i++)
fullHeight+=links[i].offsetHeight;var moveBy=Math.round(this.speed*links.length);var mainInstance=this;var intId=setInterval(function(){var curHeight=submenu.offsetHeight;var newHeight=curHeight+moveBy;if(newHeight<fullHeight)
submenu.style.height=newHeight+"px";else{clearInterval(intId);submenu.style.height="";submenu.className="";mainInstance.memorize();}},30);this.collapseOthers(submenu);};SlideMenu.prototype.collapseMenu=function(submenu){var minHeight=submenu.getElementsByTagName("span")[0].offsetHeight;var moveBy=Math.round(this.speed*submenu.getElementsByTagName("a").length);var mainInstance=this;var intId=setInterval(function(){var curHeight=submenu.offsetHeight;var newHeight=curHeight-moveBy;if(newHeight>minHeight)
submenu.style.height=newHeight+"px";else{clearInterval(intId);submenu.style.height="";submenu.className="collapsed";mainInstance.memorize();}},30);};SlideMenu.prototype.collapseOthers=function(submenu){if(this.oneSmOnly){for(var i=0;i<this.submenus.length;i++)
if(this.submenus[i]!=submenu&&this.submenus[i].className!="collapsed")
this.collapseMenu(this.submenus[i]);}};SlideMenu.prototype.expandAll=function(){var oldOneSmOnly=this.oneSmOnly;this.oneSmOnly=false;for(var i=0;i<this.submenus.length;i++)
if(this.submenus[i].className=="collapsed")
this.expandMenu(this.submenus[i]);this.oneSmOnly=oldOneSmOnly;};SlideMenu.prototype.collapseAll=function(){for(var i=0;i<this.submenus.length;i++)
if(this.submenus[i].className!="collapsed")
this.collapseMenu(this.submenus[i]);};SlideMenu.prototype.memorize=function(){if(this.remember){var states=new Array();for(var i=0;i<this.submenus.length;i++)
states.push(this.submenus[i].className=="collapsed"?0:1);var d=new Date();d.setTime(d.getTime()+(30*24*60*60*1000));document.cookie="promathius_menu_"+encodeURIComponent(this.menu.id)+"="+states.join("")+"; expires="+d.toGMTString()+"; path=/";}};var tabberOptions={'cookie':"tabs_",'manualStartup':true,'onLoad':function(argsObj)
{var t=argsObj.tabber;var i;if(t.id){t.cookie='promathius_'+t.cookie+t.id;}
i=parseInt(getCookie(t.cookie));if(isNaN(i)){return;}
t.tabShow(i);},'onClick':function(argsObj)
{var c=argsObj.tabber.cookie;var i=argsObj.index;setCookie(c,i);}};function setCookie(name,value,expires,path,domain,secure){document.cookie=name+"="+escape(value)+
((expires)?"; expires="+expires.toGMTString():"")+
((path)?"; path="+path:"")+
((domain)?"; domain="+domain:"")+
((secure)?"; secure":"");}
function getCookie(name){var dc=document.cookie;var prefix=name+"=";var begin=dc.indexOf("; "+prefix);if(begin==-1){begin=dc.indexOf(prefix);if(begin!=0)return null;}else{begin+=2;}
var end=document.cookie.indexOf(";",begin);if(end==-1){end=dc.length;}
return unescape(dc.substring(begin+prefix.length,end));}
function deleteCookie(name,path,domain){if(getCookie(name)){document.cookie=name+"="+
((path)?"; path="+path:"")+
((domain)?"; domain="+domain:"")+"; expires=Thu, 01-Jan-70 00:00:01 GMT";}}
function tabberObj(argsObj)
{var arg;this.div=null;this.classMain="tabber";this.classMainLive="tabberlive";this.classTab="tabbertab";this.classTabDefault="tabbertabdefault";this.classNav="tabbernav";this.classTabHide="tabbertabhide";this.classNavActive="tabberactive";this.titleElements=['h2','h3','h4','h5','h6'];this.titleElementsStripHTML=true;this.removeTitle=true;this.addLinkId=false;this.linkIdFormat='<tabberid>nav<tabnumberone>';for(arg in argsObj){this[arg]=argsObj[arg];}
this.REclassMain=new RegExp('\\b'+this.classMain+'\\b','gi');this.REclassMainLive=new RegExp('\\b'+this.classMainLive+'\\b','gi');this.REclassTab=new RegExp('\\b'+this.classTab+'\\b','gi');this.REclassTabDefault=new RegExp('\\b'+this.classTabDefault+'\\b','gi');this.REclassTabHide=new RegExp('\\b'+this.classTabHide+'\\b','gi');this.tabs=new Array();if(this.div){this.init(this.div);this.div=null;}}
tabberObj.prototype.init=function(e)
{var
childNodes,i,i2,t,defaultTab=0,DOM_ul,DOM_li,DOM_a,aId,headingElement;if(!document.getElementsByTagName){return false;}
if(e.id){this.id=e.id;}
this.tabs.length=0;childNodes=e.childNodes;for(i=0;i<childNodes.length;i++){if(childNodes[i].className&&childNodes[i].className.match(this.REclassTab)){t=new Object();t.div=childNodes[i];this.tabs[this.tabs.length]=t;if(childNodes[i].className.match(this.REclassTabDefault)){defaultTab=this.tabs.length-1;}}}
DOM_ul=document.createElement("ul");DOM_ul.className=this.classNav;for(i=0;i<this.tabs.length;i++){t=this.tabs[i];t.headingText=t.div.title;if(this.removeTitle){t.div.title='';}
if(!t.headingText){for(i2=0;i2<this.titleElements.length;i2++){headingElement=t.div.getElementsByTagName(this.titleElements[i2])[0];if(headingElement){t.headingText=headingElement.innerHTML;if(this.titleElementsStripHTML){t.headingText.replace(/<br>/gi," ");t.headingText=t.headingText.replace(/<[^>]+>/g,"");}
break;}}}
if(!t.headingText){t.headingText=i+1;}
DOM_li=document.createElement("li");t.li=DOM_li;if(i!=0)
{DOM_b=document.createElement("span");DOM_b.appendChild(document.createTextNode(' | '));}
DOM_a=document.createElement("a");DOM_a.appendChild(document.createTextNode(t.headingText));DOM_a.href="";DOM_a.onclick=this.navClick;DOM_a.tabber=this;DOM_a.tabberIndex=i;if(this.addLinkId&&this.linkIdFormat){aId=this.linkIdFormat;aId=aId.replace(/<tabberid>/gi,this.id);aId=aId.replace(/<tabnumberzero>/gi,i);aId=aId.replace(/<tabnumberone>/gi,i+1);aId=aId.replace(/<tabtitle>/gi,t.headingText.replace(/[^a-zA-Z0-9\-]/gi,''));DOM_a.id=aId;}
if(i!=0)
{DOM_li.appendChild(DOM_b);}
DOM_li.appendChild(DOM_a);DOM_ul.appendChild(DOM_li);}
e.insertBefore(DOM_ul,e.firstChild);e.className=e.className.replace(this.REclassMain,this.classMainLive);this.tabShow(defaultTab);if(typeof this.onLoad=='function'){this.onLoad({tabber:this});}
return this;};tabberObj.prototype.navClick=function(event)
{var
rVal,a,self,tabberIndex,onClickArgs;a=this;if(!a.tabber){return false;}
self=a.tabber;tabberIndex=a.tabberIndex;a.blur();if(typeof self.onClick=='function'){onClickArgs={'tabber':self,'index':tabberIndex,'event':event};if(!event){onClickArgs.event=window.event;}
rVal=self.onClick(onClickArgs);if(rVal===false){return false;}}
self.tabShow(tabberIndex);return false;};tabberObj.prototype.tabHideAll=function()
{var i;for(i=0;i<this.tabs.length;i++){this.tabHide(i);}};tabberObj.prototype.tabHide=function(tabberIndex)
{var div;if(!this.tabs[tabberIndex]){return false;}
div=this.tabs[tabberIndex].div;if(!div.className.match(this.REclassTabHide)){div.className+=' '+this.classTabHide;}
this.navClearActive(tabberIndex);return this;};tabberObj.prototype.tabShow=function(tabberIndex)
{var div;if(!this.tabs[tabberIndex]){return false;}
this.tabHideAll();div=this.tabs[tabberIndex].div;div.className=div.className.replace(this.REclassTabHide,'');this.navSetActive(tabberIndex);if(typeof this.onTabDisplay=='function'){this.onTabDisplay({'tabber':this,'index':tabberIndex});}
return this;};tabberObj.prototype.navSetActive=function(tabberIndex)
{this.tabs[tabberIndex].li.className=this.classNavActive;return this;};tabberObj.prototype.navClearActive=function(tabberIndex)
{this.tabs[tabberIndex].li.className='';return this;};function tabberAutomatic(tabberArgs)
{var
tempObj,divs,i;if(!tabberArgs){tabberArgs={};}
tempObj=new tabberObj(tabberArgs);divs=document.getElementsByTagName("div");for(i=0;i<divs.length;i++){if(divs[i].className&&divs[i].className.match(tempObj.REclassMain)){tabberArgs.div=divs[i];divs[i].tabber=new tabberObj(tabberArgs);}}
return this;}
function tabberAutomaticOnLoad(tabberArgs)
{var oldOnLoad;if(!tabberArgs){tabberArgs={};}
oldOnLoad=window.onload;if(typeof window.onload!='function'){window.onload=function(){tabberAutomatic(tabberArgs);};}else{window.onload=function(){oldOnLoad();tabberAutomatic(tabberArgs);};}}
if(typeof tabberOptions=='undefined'){tabberAutomaticOnLoad();}else{if(!tabberOptions['manualStartup']){tabberAutomaticOnLoad(tabberOptions);}}
function tabview_aux(TabViewId,id)
{var TabView=document.getElementById(TabViewId);var Tabs=TabView.firstChild;while(Tabs.className!="Tabs")Tabs=Tabs.nextSibling;var Tab=Tabs.firstChild;var i=0;do
{if(Tab.tagName=="A")
{i++;Tab.href="javascript: tab('"+TabViewId+"', "+i+");";Tab.className=(i==id)?"Active":"";Tab.blur();}}
while(Tab=Tab.nextSibling);var Pages=TabView.firstChild;while(Pages.className!='Pages')Pages=Pages.nextSibling;var Page=Pages.firstChild;var i=0;do
{if(Page.className=='Page')
{i++;if(Pages.offsetHeight)Page.style.height=(Pages.offsetHeight-2)+"px";Page.style.overflow="auto";Page.style.display=(i==id)?'block':'none';}}
while(Page=Page.nextSibling);}
function tab(TabViewId,id){tabview_aux(TabViewId,id);}
function tabs_initialize(TabViewId){tabview_aux(TabViewId,1);}
function showTabs(){document.getElementById("jscheck").style.display="";}
var TurnsAcquired=0;function updateTurnCount(TurnsAcquired){if(document.all||document.getElementById){var newturns=CurrentTurns+TurnsAcquired;var testt=newturns;if(testt==maxturns){document.getElementById("turncnt").innerHTML=newturns;return true;}
else if(testt>maxturns){return true;}
else{document.getElementById("turncnt").innerHTML=newturns;return false;}}}
function calcTurns(){var exceededmax=updateTurnCount(TurnsAcquired);if(!exceededmax){if(TimeMinutes<1&&TimeSeconds<2)
{TurnsAcquired=TurnsAcquired+turnsperx;opacity('hourglass',100,0,800);updateTurnCount(TurnsAcquired);if(!updateTurnCount(TurnsAcquired)){if(perminutes<=1)
{TimeSeconds=perminutes*60;TimeMinutes=0;}
else
{TimeSeconds=rawseconds;TimeMinutes=perminutefl;}}}
else
{if(TimeSeconds<2)
{TimeMinutes=TimeMinutes-1;TimeSeconds=60;}
else
TimeSeconds=TimeSeconds-1;}
if(TimeMinutes==1)
var minutestr="minute";else
var minutestr="minutes";if(TimeMinutes>=1)
var counter=TimeMinutes+" "+minutestr+" and "+TimeSeconds+" seconds";else
var counter=TimeSeconds+" seconds";turnno="";if(turnsperx>1)
turnno=turnsperx+" ";thetext="Next "+turnno+turnsform+" in "+counter;}
else{thetext="Maximum "+turnsplural+" accumulated";document.getElementById("turncnt").innerHTML=maxturns;}
document.getElementById("ttimer").innerHTML=thetext;}
function turntimer(){if(document.all||document.getElementById){new calcTurns();setInterval("calcTurns()",1000);}}
var buttonfaderenabled=true;function opacity(id,opacStart,opacEnd,millisec){var speed=Math.round(millisec/100);var timer=0;if(opacStart>opacEnd){for(i=opacStart;i>=opacEnd;i--){setTimeout("changeOpac("+i+",'"+id+"')",(timer*speed));timer++;}}else if(opacStart<opacEnd){for(i=opacStart;i<=opacEnd;i++)
{setTimeout("changeOpac("+i+",'"+id+"')",(timer*speed));timer++;}}}
function changeOpac(opacity,id){var object=document.getElementById(id).style;object.opacity=(opacity/100);object.MozOpacity=(opacity/100);object.KhtmlOpacity=(opacity/100);object.filter="alpha(opacity="+opacity+")";}
var buttonFader={}
buttonFader.baseopacity=0.7
buttonFader.increment=0.04
document.write('<style type="text/css">\n')
document.write('.buttonFader{filter:progid:DXImageTransform.Microsoft.alpha(opacity='+buttonFader.baseopacity*100+'); -moz-opacity:'+buttonFader.baseopacity+'; opacity:'+buttonFader.baseopacity+';-khtml-opacity:'+buttonFader.baseopacity+';}\n')
document.write('</style>')
buttonFader.setopacity=function(obj,value){var targetobject=obj
if(targetobject&&targetobject.filters&&targetobject.filters[0]){if(typeof targetobject.filters[0].opacity=="number")
targetobject.filters[0].opacity=value*100
else
targetobject.style.filter="alpha(opacity="+value*100+")"}
else if(targetobject&&typeof targetobject.style.MozOpacity!="undefined")
targetobject.style.MozOpacity=value
else if(targetobject&&typeof targetobject.style.opacity!="undefined")
targetobject.style.opacity=value
targetobject.currentopacity=value}
buttonFader.fadeupdown=function(obj,direction){var targetobject=obj
var fadeamount=(direction=="fadeup")?this.increment:-this.increment
if(targetobject&&(direction=="fadeup"&&targetobject.currentopacity<1||direction=="fadedown"&&targetobject.currentopacity>this.baseopacity)){this.setopacity(obj,targetobject.currentopacity+fadeamount)
window["opacityfader"+obj._fadeorder]=setTimeout(function(){buttonFader.fadeupdown(obj,direction)},50)}}
buttonFader.clearTimer=function(obj){if(typeof window["opacityfader"+obj._fadeorder]!="undefined")
clearTimeout(window["opacityfader"+obj._fadeorder])}
buttonFader.isContained=function(m,e){var e=window.event||e
var c=e.relatedTarget||((e.type=="mouseover")?e.fromElement:e.toElement)
while(c&&c!=m)try{c=c.parentNode}catch(e){c=m}
if(c==m)
return true
else
return false}
buttonFader.fadeinterface=function(obj,e,direction){if(!this.isContained(obj,e)){buttonFader.clearTimer(obj)
buttonFader.fadeupdown(obj,direction)}}
buttonFader.collectElementbyClass=function(classname){var classnameRE=new RegExp("(^|\\s+)"+classname+"($|\\s+)","i")
var pieces=[]
var alltags=document.all?document.all:document.getElementsByTagName("*")
for(var i=0;i<alltags.length;i++){if(typeof alltags[i].className=="string"&&alltags[i].className.search(classnameRE)!=-1)
pieces[pieces.length]=alltags[i]}
return pieces}
buttonFader.init=function(){var targetobjects=this.collectElementbyClass("fade")
for(var i=0;i<targetobjects.length;i++){targetobjects[i]._fadeorder=i
this.setopacity(targetobjects[i],this.baseopacity)
targetobjects[i].onmouseover=function(e){buttonFader.fadeinterface(this,e,"fadeup")}
targetobjects[i].onmouseout=function(e){buttonFader.fadeinterface(this,e,"fadedown")}}}