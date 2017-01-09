<?

// Check that the script is not being accessed directly
if (!defined('PROMATHIUS')) {
    die("Hacking attempt");
}

$num = $_GET["target"];

// Create an error message if the diplomacy offer is invalid
function killprop($error)
{
    global $config, $users;
    mysql_query("UPDATE " . $config['prefixes'][1] . "_players SET new_error='$error' WHERE num='$users[num]';");
    $uri = urldecode($_SERVER['REQUEST_URI']);
    $action = substr($uri, strpos($uri, '?') + 1);
    header("Location: ?" . $action);
    endScript();
}

// Create a declaration in the database
function createDecl($declaration, $target)
{
    global $config, $users, $enemy;

    $diplomacydb = $config['prefixes'][1] . "_diplomacy";
    $end_trade = 0;
    $end_alliance = 0;
    $end_military = 0;
    $allow_diplomacy = 0;
    $prohibit_diplomacy = 0;

    if ($declaration[end_trade])
        $end_trade = 1;
    if ($declaration[end_alliance])
        $end_alliance = 1;
    if ($declaration[end_military])
        $end_military = 1;
    if ($declaration[allow_diplomacy])
        $allow_diplomacy = 1;
    if ($declaration[prohibit_diplomacy])
        $prohibit_diplomacy = 1;

    if ($allow_diplomacy) {
        $users[prohibit_diplomacy] = str_replace("," . $target, "", $users[prohibit_diplomacy]);
        $users[prohibit_diplomacy] = str_replace(", " . $target, "", $users[prohibit_diplomacy]);
        $users[prohibit_diplomacy] = str_replace($target, "", $users[prohibit_diplomacy]);
        saveuserdata($users, "prohibit_diplomacy");
    }
    if ($prohibit_diplomacy) {
        if ($users[prohibit_diplomacy])
            $users[prohibit_diplomacy] = $users[prohibit_diplomacy] . "," . $target;
        else
            $users[prohibit_diplomacy] = $target;
        saveUserData($users, "prohibit_diplomacy");
    }
    if ($end_trade) {
        $users[trade_agreements] = str_replace("," . $target, "", $users[trade_agreements]);
        $users[trade_agreements] = str_replace(", " . $target, "", $users[trade_agreements]);
        $users[trade_agreements] = str_replace($target, "", $users[trade_agreements]);
        saveuserdata($users, "trade_agreements");
        $enemy[trade_agreements] = str_replace("," . $users[num], "", $enemy[trade_agreements]);
        $enemy[trade_agreements] = str_replace(", " . $users[num], "", $enemy[trade_agreements]);
        $enemy[trade_agreements] = str_replace($users[num], "", $enemy[trade_agreements]);
        saveuserdata($enemy, "trade_agreements");
    }
    if ($end_alliance) {
        $users[alliances] = str_replace("," . $target, "", $users[alliances]);
        $users[alliances] = str_replace(", " . $target, "", $users[alliances]);
        $users[alliances] = str_replace($target, "", $users[alliances]);
        saveuserdata($users, "alliances");
        $enemy[alliances] = str_replace("," . $users[num], "", $enemy[alliances]);
        $enemy[alliances] = str_replace(", " . $users[num], "", $enemy[alliances]);
        $enemy[alliances] = str_replace($users[num], "", $enemy[alliances]);
        saveuserdata($enemy, "alliances");
        $users[military_agreements] = str_replace("," . $target, "", $users[military_agreements]);
        $users[military_agreements] = str_replace(", " . $target, "", $users[military_agreements]);
        $users[military_agreements] = str_replace($target, "", $users[military_agreements]);
        saveuserdata($users, "military_agreements");
        $enemy[military_agreements] = str_replace("," . $users[num], "", $enemy[military_agreements]);
        $enemy[military_agreements] = str_replace(", " . $users[num], "", $enemy[military_agreements]);
        $enemy[military_agreements] = str_replace($users[num], "", $enemy[military_agreements]);
        saveuserdata($enemy, "military_agreements");
    }
    if ($end_military) {
        $users[military_agreements] = str_replace("," . $target, "", $users[military_agreements]);
        $users[military_agreements] = str_replace(", " . $target, "", $users[military_agreements]);
        $users[military_agreements] = str_replace($target, "", $users[military_agreements]);
        saveuserdata($users, "military_agreements");
        $enemy[military_agreements] = str_replace("," . $users[num], "", $enemy[military_agreements]);
        $enemy[military_agreements] = str_replace(", " . $users[num], "", $enemy[military_agreements]);
        $enemy[military_agreements] = str_replace($users[num], "", $enemy[military_agreements]);
        saveuserdata($enemy, "military_agreements");
    }


    if ($end_trade || $end_alliance || $end_military) {
        $query = "INSERT INTO $diplomacydb (end_alliance, end_trade, end_military)
					VALUES ($end_alliance, $end_trade, $end_military);";
        mysql_safe_query($query);
        if (mysql_error())
            killprop("An internal error occurred. Please report this as a bug.");
    }
}

// Create a proposition in the database
function createProp($proposition, $target, $type)
{
    global $config, $users;

    $diplomacydb = $config['prefixes'][1] . "_diplomacy";

    $trade_rights = 0;
    $alliance = 0;
    $trade_rights = 0;
    $military_rights = 0;
    $threaten_trade = 0;
    $threaten_alliance = 0;
    $threaten_military = 0;
    $end_war = 0;
    $offer_gold = $proposition[gold_offer_real];
    $demand_gold = $proposition[gold_demand_real];

    if ($proposition[trade_rights])
        $trade_rights = 1;
    if ($proposition[alliance])
        $alliance = 1;
    if ($proposition[trade_rights])
        $trade_rights = 1;
    if ($proposition[military_rights])
        $military_rights = 1;
    if ($proposition[break_trade])
        $threaten_trade = 1;
    if ($proposition[break_alliance])
        $threaten_alliance = 1;
    if ($proposition[break_military])
        $threaten_military = 1;
    if ($proposition[end_war])
        $end_war = 1;

    $query = "INSERT INTO $diplomacydb (concerns, type, trade_rights, alliance, military_rights, demand_cash, offer_cash, threaten_trade, threaten_alliance, threaten_military, ceasefire)
				VALUES ($target, $type, $trade_rights, $alliance, $military_rights, $demand_gold, $offer_gold, $threaten_trade, $threaten_alliance, $threaten_military, $end_war);";
    mysql_safe_query($query);

    if (mysql_error())
        killprop("An internal error occurred. Please report this as a bug.");
}


if ($num) {
    fixInputNum($num);
    $enemy = loadUser($num);
    if (!$enemy[signedup]) {
        initGUI();
        endScript("The $uera[empire] specified does not exist.");
    }
} else {
    initGUI();
    endScript("No $uera[empire] selected.");
}

// Get relations data like trade agreements, alliances etc.
include ($game_root_path . "/lib/relations.php");
getRelations();

if ($set_diplomacy) {
    // Error catcher
    if ($enemy_prohibit_diplomacy && $_POST[allow_diplomacy]) {
        $error = "You cannot simply allow diplomatic relations,<br> as this $uera[empire] has made certain that it does not wish to do diplomacy with you.";
        killprop($error);
    }
    if ($player_prohibit_diplomacy && $_POST[prohibit_diplomacy]) {
        $error = "You have already prohibited diplomacy.";
        killprop($error);
    }
    if (!$player_prohibit_diplomacy && $_POST[allow_diplomacy]) {
        $error = "Diplomacy is already allowed with this $uera[empire].";
        killprop($error);
    } elseif ($alliance && $_POST[prohibit_diplomacy]) {
        $error = "You are in an alliance, for which you cannot prohibit diplomacy without severing the alliance.";
        killprop($error);
    } elseif ($trade_agreement && $_POST[prohibit_diplomacy]) {
        $error = "You have a trade agreement with this $uera[empire], for which you cannot prohibit diplomacy without severing the agreement.";
        killprop($error);
    } elseif ($military_agreement && $_POST[prohibit_diplomacy]) {
        $error = "You have a military agreement with this $uera[empire], for which you cannot prohibit diplomacy without severing the agreement.";
        killprop($error);
    } elseif (!$alliance && $_POST[end_alliance]) {
        $error = "You are not in an alliance with this $uera[empire].";
        killprop($error);
    } elseif ($alliance && $military_agreement && $_POST[end_alliance] && !$_POST[end_military]) {
        $error = "Ending the alliance will break your military agreement.";
        killprop($error);
    } elseif (!$trade_agreement && $_POST[end_trade]) {
        $error = "You do not have a trade agreement with this $uera[empire].";
        killprop($error);
    } elseif (!$military_agreement && $_POST[end_military]) {
        $error = "You do not have a military agreement with this $uera[empire].";
        killprop($error);
    } else {
        $declaration = $_POST;
        $target = $enemy[num];
        createDecl($declaration, $target);
    }
}

if ($do_diplomacy) {
    $_POST['gold_offer_real'] = fixInputNumReturn($_POST['gold_offer_real']);
    $_POST['gold_demand_real'] = fixInputNumReturn($_POST['gold_demand_real']);

    // Error catcher
    if ($enemy_prohibit_diplomacy) {
        $error = "This $uera[empire] does not wish to do diplomacy with you.";
        killprop($error);
    } elseif ($player_prohibit_diplomacy) {
        $error = "You do not wish to do diplomacy with this $uera[empire].<br> Allow diplomatic relations if yu wish to do diplomacy.";
        killprop($error);
    } elseif ($at_war && !$_POST['end_war'] && $_POST['military_rights']) {
        $error = "You are at war with this $uera[empire]. A military agreement is impossible.";
        killprop($error);
    } elseif ($at_war && !$_POST['end_war'] && $_POST['alliance']) {
        $error = "You are at war with this $uera[empire]. An alliance is impossible.";
        killprop($error);
    } elseif ($at_war && !$_POST['end_war'] && $_POST['trade_rights']) {
        $error = "You are at war with this $uera[empire]. A trade agreement is impossible.";
        killprop($error);
    } elseif (!$alliance && $_POST['break_alliance']) {
        $error = "You are not in an alliance with this $uera[empire].";
        killprop($error);
    } elseif (!$trade_agreement && $_POST['break_trade']) {
        $error = "You do not have a trade agreement.";
        killprop($error);
    } elseif (!$military_agreement && $_POST['break_military']) {
        $error = "You do not have a military agreement.";
        killprop($error);
    } elseif ($_POST['trade_rights'] && $_POST['break_trade']) {
        $error = "You cannot simultaneously request a trade agreement and threaten to break it.";
        killprop($error);
    } elseif ($_POST['alliance'] && $_POST['break_alliance']) {
        $error = "You cannot simultaneously request an alliance and threaten to break it.";
        killprop($error);
    } elseif ($_POST['military_rights'] && $_POST['break_alliance']) {
        $error = "You cannot simultaneously request a military agreement and threaten to break it.";
        killprop($error);
    } elseif (!$at_war && $_POST['end_war']) {
        $error = "You are not at war with this $uera[empire].";
        killprop($error);
    } elseif ($_POST['gold_offer_real'] && $_POST['gold_demand_real']) {
        $error = "It is illogical to make both an offer and demand of currency.";
        killprop($error);
    } elseif ($alliance && $_POST['alliance']) {
        $error = "You are already in an alliance with this $uera[empire].";
        killprop($error);
    } elseif ($trade_agreement && $_POST['trade_rights']) {
        $error = "You already have trade rights with this $uera[empire].";
        killprop($error);
    } elseif ($militay_agreement && $_POST['military_rights']) {
        $error = "You already have military rights with this $uera[empire].";
        killprop($error);
    } elseif ($_POST['military_rights'] && !$_POST['alliance']) {
        $error = "Before requesting military rights, you should be an ally with this empire.";
        killprop($error);
    } elseif ($_POST['gold_offer_real'] > gamefactor($users[cash])) {
        $error = "You do not have a treasury large enough to make such an offer.";
        killprop($error);
    } else {
        // Make sure that there is an offer and demand
        $proposition = $_POST;
        $target = $enemy[num];
        $type = 0;
        createProp($proposition, $target, $type); // Final step - process and put information in the DB
    }
}

getRelations();
initGUI();

$tpl->assign('target', $num);
$tpl->assign('err', $current_Error);
$tpl->assign('enemy', $enemy);
$tpl->assign('maxmoney', gamefactor($users[cash]));
$tpl->display('actions/profile/diplomacy.tpl');
?>
