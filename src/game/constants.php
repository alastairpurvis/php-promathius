<?
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
<<<CONSTANTS
#!/bin/sh
# Script to extract current list of game constants suitable for inclusion into constants.php
unalias grep 2>/dev/null


# 1. Fetch predefined constants directly from constants.php
grep PREDEFINED constants.php | grep -v constants.php

echo		# Blank

# 2. Fetch SQL constants     - filter out bogus entries                                             - trim            - sort - filter out duplicates and print define line                     - change " to '
cat sql-setup.php | grep '`' | grep -v mysql_query | grep -v INSERT | grep -v PRIMARY | grep -v KEY | sed -e 's/`//g' | sort | awk '{if(i != $1) {print "define(\""$1"\", \""$1"\");"}; i=$1}' | sed -e "s/\"/\'/g"

echo		# Blank

# 3. Fetch config constants             - remove the fluff                      - sort - extract the line, filter out duplicates and print define line                     - change " to '
cat config.php | grep -v array | grep = | sed -e "s/\$config\['//" -e "s/'\]//" | sort | awk -F'([ \t]*|\\\[)' '{if(i != $2) {print "define(\""$2"\", \""$2"\");"}; i=$2}' | sed -e "s/\"/\'/g"

echo

# 4. Fetch common POST fields, and remove the fluff                                                 - sort - filter out duplicates and print define line                    - change " to '
grep -r "\$do" *.php | sed -e "s/^\(.*\)\(\(\$[a-zA-Z_]*\)\)\(.*\)$/\2/" -e "s/\\\$//" | grep "do_" | sort | awk '{if(i != $1) {print "$"$1" = \$_POST[\""$1"\"];"}; i=$1}' | sed -e "s/\"/\'/g"


CONSTANTS;

define('basehref', 'basehref');			# PREDEFINED
define('ind', 'ind');				# PREDEFINED
define('pmkt', 'pmkt');				# PREDEFINED
define('wpl', 'wpl');				# PREDEFINED
define('pci', 'pci');				# PREDEFINED
define('costs', 'costs');			# PREDEFINED

define('activity', 'activity');
define('aidcred_got', 'aidcred_got');
define('aidcred', 'aidcred');
define('aim', 'aim');
define('all_1', 'all_1');
define('ally1', 'ally1');
define('ally2', 'ally2');
define('ally3', 'ally3');
define('ally4', 'ally4');
define('ally5', 'ally5');
define('allytime', 'allytime');
define('amount', 'amount');
define('amt', 'amt');
define('anon', 'anon');
define('asst', 'asst');
define('atkforstruct', 'atkforstruct');
define('attacks', 'attacks');
define('banip', 'banip');
define('barracks', 'barracks');
define('bender', 'bender');
define('bmper_last', 'bmper_last');
define('bmper', 'bmper');
define('boost', 'boost');
define('cash1', 'cash1');
define('cash', 'cash');
define('check', 'check');
define('clan1', 'clan1');
define('clan2', 'clan2');
define('clan3', 'clan3');
define('clan', 'clan');
define('code', 'code');
define('condense', 'condense');
define('criernews', 'criernews');
define('cron_last', 'cron_last');
define('days1', 'days1');
define('days2', 'days2');
define('days3', 'days3');
define('defsucc', 'defsucc');
define('deftotal', 'deftotal');
define('deleted', 'deleted');
define('dest', 'dest');
define('disabled', 'disabled');
define('edits', 'edits');
define('email', 'email');
define('empire', 'empire');
define('era', 'era');
define('fa1', 'fa1');
define('fa2', 'fa2');
define('farms', 'farms');
define('filled', 'filled');
define('folder', 'folder');
define('folders', 'folders');
define('food1', 'food1');
define('food', 'food');
define('forces', 'forces');
define('forum_desc', 'forum_desc');
define('forum_icon', 'forum_icon');
define('forum_id', 'forum_id');
define('forum_name', 'forum_name');
define('forum_order', 'forum_order');
define('founder', 'founder');
define('free', 'free');
define('freeland', 'freeland');
define('gate', 'gate');
define('granary', 'granary');
define('health', 'health');
define('heroes_used', 'heroes_used');
define('hero_peace', 'hero_peace');
define('hero_special', 'hero_special');
define('hero_war', 'hero_war');
define('hide', 'hide');
define('homes', 'homes');
define('hour_last', 'hour_last');
define('id1', 'id1');
define('id2', 'id2');
define('id3', 'id3');
define('id', 'id');
define('idle', 'idle');
define('igname', 'igname');
define('industry', 'industry');
define('IP', 'IP');
define('ismulti', 'ismulti');
define('jtyp', 'jtyp');
define('killed', 'killed');
define('kills', 'kills');
define('labs', 'labs');
define('land1', 'land1');
define('land2', 'land2');
define('land', 'land');
define('language', 'language');
define('l_attack', 'l_attack');
define('loan', 'loan');
define('loft', 'loft');
define('loggedin', 'loggedin');
define('members', 'members');
define('menu_lite', 'menu_lite');
define('motd', 'motd');
define('msgcred_got', 'msgcred_got');
define('msgcred', 'msgcred');
define('msg', 'msg');
define('msgtime', 'msgtime');
define('msn', 'msn');
define('name', 'name');
define('net', 'net');
define('networth', 'networth');
define('newssort', 'newssort');
define('newstime', 'newstime');
define('notes', 'notes');
define('num_bounties', 'num_bounties');
define('num', 'num');
define('offsucc', 'offsucc');
define('offtotal', 'offtotal');
define('online', 'online');
define('open', 'open');
define('password', 'password');
define('peaceset', 'peaceset');
define('peaceset_time', 'peaceset_time');
define('peasants', 'peasants');
define('pic', 'pic');
define('pmkt_food', 'pmkt_food');
define('poster_id', 'poster_id');
define('poster_ip', 'poster_ip');
define('poster_name', 'poster_name');
define('post_id', 'post_id');
define('posts_count', 'posts_count');
define('post_status', 'post_status');
define('post_text', 'post_text');
define('post_time', 'post_time');
define('price', 'price');
define('production', 'production');
define('profile', 'profile');
define('pvmarket_last', 'pvmarket_last');
define('pvmarket', 'pvmarket');
define('race', 'race');
define('rank', 'rank');
define('readd', 'readd');
define('replied', 'replied');
define('rune', 'rune');
define('runes1', 'runes1');
define('runes', 'runes');
define('savings', 'savings');
define('seller', 'seller');
define('shielded', 'shielded');
define('shield', 'shield');
define('shops', 'shops');
define('signedup', 'signedup');
define('s_name', 's_name');
define('s_num', 's_num');
define('src', 'src');
define('std_bld', 'std_bld');
define('sticky', 'sticky');
define('stocks', 'stocks');
define('style', 'style');
define('symbol', 'symbol');
define('tag', 'tag');
define('tax', 'tax');
define('ticket', 'ticket');
define('time', 'time');
define('title', 'title');
define('t_name', 't_name');
define('t_num', 't_num');
define('topic_id', 'topic_id');
define('topic_last_post_id', 'topic_last_post_id');
define('topic_poster', 'topic_poster');
define('topic_poster_name', 'topic_poster_name');
define('topics_count', 'topics_count');
define('topic_status', 'topic_status');
define('topic_time', 'topic_time');
define('topic_title', 'topic_title');
define('topic_views', 'topic_views');
define('towers', 'towers');
define('treasury', 'treasury');
define('tres_open', 'tres_open');
define('troops1', 'troops1');
define('troops2', 'troops2');
define('troops', 'troops');
define('troop', 'troop');
define('turns', 'turns');
define('turns_last', 'turns_last');
define('turnsstored', 'turnsstored');
define('turnsused', 'turnsused');
define('type', 'type');
define('url', 'url');
define('user_custom1', 'user_custom1');
define('user_custom2', 'user_custom2');
define('user_custom3', 'user_custom3');
define('user_email', 'user_email');
define('user_from', 'user_from');
define('user_icq', 'user_icq');
define('user_id', 'user_id');
define('user_interest', 'user_interest');
define('username', 'username');
define('user_newpasswd', 'user_newpasswd');
define('user_newpwdkey', 'user_newpwdkey');
define('user_occ', 'user_occ');
define('user_password', 'user_password');
define('user_regdate', 'user_regdate');
define('user_sorttopics', 'user_sorttopics');
define('user_viewemail', 'user_viewemail');
define('user_website', 'user_website');
define('vacation', 'vacation');
define('validated', 'validated');
define('vote', 'vote');
define('war1', 'war1');
define('war2', 'war2');
define('war3', 'war3');
define('war4', 'war4');
define('war5', 'war5');
define('warset', 'warset');
define('warset_time', 'warset_time');
define('wizards1', 'wizards1');
define('wizards2', 'wizards2');
define('wizards', 'wizards');

define('adminemail', 'adminemail');
define('aidtroop', 'aidtroop');
define('atknames', 'atknames');
define('bmperc', 'bmperc');
define('buildings', 'buildings');
define('chathost', 'chathost');
define('chatport', 'chatport');
define('$config', '$config');
define('dateformat', 'dateformat');
define('dbhost', 'dbhost');
define('dbname', 'dbname');
define('dbpass', 'dbpass');
define('dbuser', 'dbuser');
define('default_era', 'default_era');
define('disabled_pages', 'disabled_pages');
define('duels_mode', 'duels_mode');
define('er', 'er');
define('eras', 'eras');
define('food', 'food');
define('force_atkland', 'force_atkland');
define('force_atktype', 'force_atktype');
define('forum_news', 'forum_news');
define('forums', 'forums');
define('gamename_full', 'gamename_full');
define('gamename_short', 'gamename_short');
define('home', 'home');
define('indc', 'indc');
define('initturns', 'initturns');
define('jackpot', 'jackpot');
define('lastweek', 'lastweek');
define('loanbase', 'loanbase');
define('lockdb', 'lockdb');
define('market', 'market');
define('max_attacks', 'max_attacks');
define('maxstoredturns', 'maxstoredturns');
define('maxtickets', 'maxtickets');
define('maxturns', 'maxturns');
define('minvacation', 'minvacation');
define('missionadvance', 'missionadvance');
define('missionback', 'missionback');
define('missionblast', 'missionblast');
define('missioned', 'missioned');
define('missionfight', 'missionfight');
define('missionfood', 'missionfood');
define('missiongate', 'missiongate');
define('missiongold', 'missiongold');
define('missionheal', 'missionheal');
define('missionkill', 'missionkill');
define('missionpeasant', 'missionpeasant');
define('missionprod', 'missionprod');
define('missionrob', 'missionrob');
define('missionrunes', 'missionrunes');
define('missionshield', 'missionshield');
define('missionspy', 'missionspy');
define('missionsteal', 'missionsteal');
define('missionstorm', 'missionstorm');
define('missionstruct', 'missionstruct');
define('missionungate', 'missionungate');
define('mktshops', 'mktshops');
define('multi_max', 'multi_max');
define('news_forum', 'news_forum');
define('news_length', 'news_length');
define('news_prefix', 'news_prefix');
define('news', 'news');
define('news_type', 'news_type');
define('nolimit_mode', 'nolimit_mode');
define('nolimit_table', 'nolimit_table');
define('peaceset', 'peaceset');
define('perminutes', 'perminutes');
define('prefixes', 'prefixes');
define('protection', 'protection');
define('races', 'races');
define('resetvote', 'resetvote');
define('savebase', 'savebase');
define('servers', 'servers');
define('signupsclosed', 'signupsclosed');
define('sitedir', 'sitedir');
define('styles', 'styles');
define('towers', 'towers');
define('tpldir', 'tpldir');
define('troop', 'troop');
define('turnoffset', 'turnoffset');
define('turnsper', 'turnsper');
define('vacationdelay', 'vacationdelay');
define('version', 'version');
define('votepercent', 'votepercent');
define('warset', 'warset');

$do_attack = $_POST['do_attack'];
$do_borrow = $_POST['do_borrow'];
$do_build = $_POST['do_build'];
$do_buy = $_POST['do_buy'];
$do_changeflag = $_POST['do_changeflag'];
$do_changeindustry = $_POST['do_changeindustry'];
$do_changemotd = $_POST['do_changemotd'];
$do_changename = $_POST['do_changename'];
$do_changepass = $_POST['do_changepass'];
$do_changerelations = $_POST['do_changerelations'];
$do_changestyle = $_POST['do_changestyle'];
$do_changetax = $_POST['do_changetax'];
$do_changeurl = $_POST['do_changeurl'];
$do_clanopen = $_POST['do_clanopen'];
$do_createclan = $_POST['do_createclan'];
$do_delete = $_POST['do_delete'];
$do_deleteall = $_POST['do_deleteall'];
$do_delete_read = $_POST['do_delete_read'];
$do_delete_selected = $_POST['do_delete_selected'];
$do_demolish = $_POST['do_demolish'];
$do_deposit = $_POST['do_deposit'];
$do_forward = $_POST['do_forward'];
$do_joinclan = $_POST['do_joinclan'];
$do_login = $_POST['do_login'];
$do_makeasst = $_POST['do_makeasst'];
$do_makefa = $_POST['do_makefa'];
$do_makefounder = $_POST['do_makefounder'];
$do_message = $_POST['do_message'];
$do_mission = $_POST['do_mission'];
$do_modify = $_POST['do_modify'];
$do_notes = $_POST['do_notes'];
$do_notuseforces = $_POST['do_notuseforces'];
$do_nsort_rev = $_POST['do_nsort_rev'];
$do_profile = $_POST['do_profile'];
$do_recalc = $_POST['do_recalc'];
$do_remasst = $_POST['do_remasst'];
$do_remfa = $_POST['do_remfa'];
$do_removeempire = $_POST['do_removeempire'];
$do_removeself = $_POST['do_removeself'];
$do_removeunits = $_POST['do_removeunits'];
$do_repay = $_POST['do_repay'];
$do_reply = $_POST['do_reply'];
$do_revoke = $_POST['do_revoke'];
$do_search = $_POST['do_search'];
$do_sell = $_POST['do_sell'];
$do_sendaid = $_POST['do_sendaid'];
$do_set = $_POST['do_set'];
$do_signup = $_POST['do_signup'];
$do_ticket = $_POST['do_ticket'];
$do_transaction = $_POST['do_transaction'];
$do_useforces = $_POST['do_useforces'];
$do_withdraw = $_POST['do_withdraw'];

?>
