<?
/////////////////////////////////////////////////////////////////
// LANGUAGE.PHP
// This file is a descriptor for all supported language strings and error messages
/////////////////////////////////////////////////////////////////
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

////////////////////////////////////////////
// General
////////////////////////////////////////////
	$config['er'][101]['empire']	=	'City'						;# The term used for 'empire', e.g. some like to say 'Tribe'
	$config['lang']['condturns']	=	'Stop on bankruptcy'					;
	$config['lang']['helpbutton']	=	'Help'						;
	$config['lang']['BCE']		=	'BC'							;#Acronym for years B.C.E.
	$config['lang']['CE']		=	'AD'							;
	$config['lang']['greatness']	=	'Greatness'						;# Term for greatness/whatever

////////////////////////////////////////////
// RESOURCES
////////////////////////////////////////////
	$config['nrunes']	=	'Scrolls'					;# 100 place: the era; 1 place: the race
	$config['wizards']	=	'Agents'						;# This allows for great flexibility, e.g. race-specific troop names
	$config['nfood']	=	'Food'						;# Set attribute/value pairs of eras & races
	$config['ncash']	=	'Gold'						;

////////////////////////////////////////////
// ATTACKING
////////////////////////////////////////////
	$config['lang']['takeland']	=	'Occupy Territory'	;
	$config['lang']['takegold']	=	'Sack Cities'		;
	$config['lang']['takefood']	=	'Pillage Farms'		;
	$config['lang']['sendall']	=	'Send Everything'	;
	$config['lang']['captbuilding']	=	'Capture Buildings'	;
	$config['lang']['target']	=	'Target:'	;

////////////////////////////////////////////
// MARKET
////////////////////////////////////////////
	$config['lang']['pvtmarket']	=	'Private Market';
	$config['lang']['pubmarket']	=	'Public Market'	;
	$config['lang']['sellgoods']	=	'Sell Goods'	;
	$config['lang']['buygoods']	=	'Buy Goods'	;

////////////////////////////////////////////
// Missions
////////////////////////////////////////////
	$config['error']['mission_target']	=	'You can not post a mission that has no target.';
	$config['error']['mission_targetnotemp']	=	'You can not post a mission that targets a non-existant empire.';
	$config['error']['mission_targetimp']	=	'This empire is an impossible target.';
	$config['error']['mission_limit']	=	'You can not have more than one mission targeting a single empire at one time. If you would like to add or change your previous mission, you can edit it on the missions index.';
	$config['error']['mission_nomore']	=	'You cannot post any more missions.';
	$config['error']['mission_ally']	=	'You cannot post a mission targetting an ally.';
	$config['error']['mission_notenough']	=	'It is obvious that you cannot provide a reward that large.';
	$config['error']['mission_targetclan']		=	'You may not target an empire within your clan.';
	$config['error']['mission_toomanytroops']	=	"It would be most unwise to reward more military power than you have.";
	$config['error']['mission_negamount']	=	'It is impossible to give a negative amount.';
	$config['error']['mission_notenoughtroops']	=	'You cannot provide that many troops.';
	$config['error']['mission_notenoughresources']	=	'You do not have the resources to give away a reward of that size.';
	$config['error']['mission_givenothing']	=	'You cannot be taxed if no deposit has been made.';
	$config['error']['mission_nocondition']	=	'A mission must have an objective.';
	$config['error']['mission_targetself']	=	'Though quite comical, a mission targetting your own empire is not permitted.';
	$config['error']['mission_conditionmet']	=	'The conditions of this mission have already been met.';
	$config['error']['mission_alreadycompleted']	=	'This mission has already been completed or is not yours.';
	$config['error']['mission_cannotadd']	=	'You can not add that much.';
	$config['lang']['mission_created1']	=	'You have successfully posted a mission targetting ';
	$config['lang']['mission_created2']	=	'<br /> and your deposit has been left.<b>';
$config['lang']['mission_edited1']	=	'You have edited your mission targetting ';
$config['lang']['mission_edited2']	=	'.';

?>