<?
$config = array();
require_once($phpbb_root_dir.'lib/language.php');

// MYSQL INFORMATION
	$config['dbhost'] = 'localhost';
	// Database name
	$config['dbname'] = 'promathius';
	// Username to connect to the database with
	$config['dbuser'] = 'root';
	// Password of user to connect to database
	$config['dbpass'] = '';
	// Whether to use persistent database connections. Not all databases support this, but if yours does, use it.
	$config['pconnect'] = 0;
	// Prefixes to use for the game tables 
	$config['prefixes'][1] = 'game';
	// Prefixes to use for the forum tables 
	$config['forum_prefix'] = 'phpbb';

// SERVER INFORMATION
	// The  main website url with NO TRAILING SLASH
	$config['mainurl'] = 'http://localhost';
	// The url for the game's directory with a trailing slash
	$config['sitedir'] = 'http://localhost'.'/';
	$config['sitedirnoslash'] = 'http://localhost';
	// Where we go when we logout
	$config['home']	 = $serverinfo['SiteDirectory'].'/';

// Check to see whether phpBB is calling or not
if($phpbb_root_path != '')
{
	$attackfile = $phpbb_root_path."../data/ini/attacking.ini";
	$factionsfile = $phpbb_root_path."../data/ini/factions.ini";
	$regionsfile = $phpbb_root_path."../data/ini/regions.ini";
	$rulesfile = $phpbb_root_path."../data/ini/rules.ini";
	$magicfile = $phpbb_root_path."../data/ini/magic.ini";
	$languagefile = $phpbb_root_path."../data/ini/language.ini";
	$measuresfile = $phpbb_root_path."../data/ini/measures.ini";
	$standardsfile = $phpbb_root_path."../data/ini/standards.ini";
	$unitsfile = $phpbb_root_path."../data/ini/units.ini";
	$structuresfile = $phpbb_root_path."../data/ini/structures.ini";
}
else
{
 	$attackfile = $data_root_path."/ini/attacking.ini";
 	$factionsfile = $data_root_path."/ini/factions.ini";
 	$regionsfile = $data_root_path."/ini/regions.ini";
 	$rulesfile = $data_root_path."/ini/rules.ini";
 	$magicfile = $data_root_path."/ini/magic.ini";
 	$languagefile = $data_root_path."/ini/language.ini";
 	$measuresfile = $data_root_path."/ini/measures.ini";
	$standardsfile = $data_root_path."/ini/standards.ini";
 	$unitsfile = $data_root_path."/ini/units.ini";
	$structuresfile = $data_root_path."/ini/structures.ini";
}

// Load INI Files
	$attacking = parse_ini_file($attackfile, true); 
	$factions = parse_ini_file($factionsfile, true); 
	$regions = parse_ini_file($regionsfile, true);  
	$rules = parse_ini_file($rulesfile, true); 
	$magic = parse_ini_file($magicfile, true); 
	$language = parse_ini_file($languagefile, true); 
	$measures = parse_ini_file($measuresfile, true); 
	$standards = parse_ini_file($standardsfile, true); 
	$units = parse_ini_file($unitsfile, true); 
	$structures = parse_ini_file($structuresfile, true); 


// GENERAL GAME INFORMATION
	$config['version'] = 'v0.9';# Game version number
	$config['gamename_short']	= 'PROM';# Game acronym
	$config['gamename_full']	= 'Promathius';# Full game name
	$config['news']	 = ''	;# Server MOTD/News, not implemented yt
	$config['servers'][1] = 'Promathius'	;# Full name of the game
	$config['dateformat'] = 'M d, g:i a'	;# Date format (PHP)
	$config['multi_max'] = 99999;# Maximum number of accounts a player can have

// TIME
	$config['startyear'] = $rules['Time']['StartYear'];# Year the game should start at after each reset or on first game
	$config['endyear']	 = $rules['Time']['EndYear'];# Year the game reset
	$config['yeartime'] = $rules['Time']['YearTime'];# Duration of a year in the game for every day in real life e.g. 3 days
	$config['seasontime'] = $rules['Time']['SeasonTime'];
	$config['seasons'] = $rules['Time']['Seasons'];
	$config['seasonnames'] = explode(",", $rules['Time']['SeasonNames']);
	$config['ruletime'] = $rules['Time']['MaxRuleTime'];# How long in years does a player have to rule an empire?
	$config['update_time'] = 8;# This is the time of day for which news headlines are updated and years will progress
	$config['abandon_delay']	= $rules['Restrictions']['AbandonDelay'];# The time in hours a player must wait after abandoning their empire before they are allowed to create a new one
	$config['minvacation'] = 72;# Minimum vacation duration
	$config['vacationdelay']	= 12;# Delay before empire is protected

// BASIC RULES
	$config['protection'] = $rules['Turns']['ProtectionDuration']	;# Duration of protection
	$config['initturns'] = $rules['Turns']['InitialTurns'];# Turns given on empire creation

	$config['max_attacks'] = $rules['Attacking']['MaxAttacks'];# Maximum attacks for unallied empires
	$config['minhealth'] = $rules['Attacking']['require_onceHealth'];
	$config['attack_penalty'] = $rules['Attacking']['HealthPenalty'];
	$config['online_warn'] = 10;# Minutes within which to warn people that they are under attack
	$config['alt_networth'] = 0;# Use an alternative networth-calculation formula?
	$config['greatness'] = $rules['Greatness']['Value'];# Divisor to determine the value of 'greatness' (has only an aesthetic effect, does not affect game mechanics)
	$config['greatness_roundoff']	= $rules['Greatness']['Round']	;# Round off greatness by how many decimal places? (Again, does not affect calculations)

// MISC
	$config['abandontag'] = 0;# Put an 'abandoned' tag onto abandoned empires to free up names for new empires?
	$config['maxmissions'] = $rules['Restrictions']['MaxMissions'];# Maximum amount of missions that can be posted by a single player

// RAFFLE
	$config['jackpot'] = 0;# Default raffle jackpot
	$config['maxtickets'] = 5;# Maximum number of raffle tickets per empire

// FUNDING
	$config['loanbase'] = $rules['Bank']['LoanRate'];# Base savings rate
	$config['savebase'] = $rules['Bank']['SaveRate'];# Base loan rate			;
	$config['maxloan'] = $rules['Bank']['MaxLoan'];# Times networth is the max loan
	$config['maxsave'] = $rules['Bank']['MaxSave'];# Times networth is the max savings

// FOOD
	$config['food_buy'] = 20;
	$config['food_sell'] = 5;


// MARKET
	$config['game_factor'] = 1/1000;# (was 1/1000)How to amplify values of troops, food, etc. shown in the game
	$config['market'] = $rules['Market']['SellDelay'];# Hours to arrive on market
	$config['maxsales'] = $rules['Market']['MaximumSales'];
	$config['sellcommission'] = $rules['Market']['RemoveCommission']*10;
	$config['cancelcommission'] = $rules['Market']['CancelCommission']*10;
	$config['bmperc'] = $rules['Market']['MaxSellPercentage']*10000;# Percentage of troops that can be sold on black market (divide by 100 for percentage)
	$config['mktshops'] = $rules['Market']['PrivateMarketPremium'];# Percentage of black market cost bonus for which shops are responsible

	$config['buildingrateincrease'] = $rules['Building']['RateIncrease'];
	$config['buildspeed']	= $rules['Building']['BuildSpeed'];
	$config['buildings']	= $rules['Building']['BaseCost'] / $config['game_factor'];
	$config['demdepreciation']	= $rules['Building']['DemolitionDepreciation'];
	$config['buildingoutput']	= $rules['Building']['BuildingOutput'];
	$config['shopsincome']	= $rules['Building']['CashProduceIncome'];
	$config['towerbonus']	=   $rules['Building']['DefenseOrderBonus'];
	$config['homesbonus']	=   $rules['Building']['HomeOrderBonus'];
	$config['indc']	 = $rules['Military']['RecruitmentRate'];# Industry output multiplier
	$config['PopulationRecruitLimit'] = $rules['Military']['PopulationRecruitLimit'];
	$config['NormalOutputPercent'] = $rules['Military']['NormalOutputPercent'];
	$config['troopcosts']	=   $rules['Military']['Upkeep'];
	$config['troopbonus']	=   $rules['Military']['OrderBonus'];
	$config['default_era'] = 2;# Default era users are put into

	$config['TaxIncomeMod'] = $rules['Taxes']['IncomeModifier'];
	$config['TaxOrderPenalty'] = $rules['Taxes']['OrderPenalty'];
	$config['MaxTax'] = $rules['Taxes']['MaxRate'];
	
	$config['PopValue'] = $rules['Population']['CitizenScale'];
	$config['corruption'] = $rules['Population']['Corruption'];
	$config['OrderAffectGrowth'] = $rules['Population']['OrderAffectGrowth'];
	$config['CashShortagePen'] = $rules['Population']['CashShortagePenalty'];
	$config['FoodShortagePen'] = $rules['Population']['FoodShortagePenalty'];
	$config['foodgrowthbonus'] = $rules['Population']['FoodGrowthBonus'];
	$config['AttackRecovery'] = $rules['Population']['AttackRecovery'];

// RESTRICTIONS
	$config['disabled_pages'][]	= '/hero';# Pages to restrict access to
	$config['disabled_pages'][]	= 'example'	;
	$config['disabled_pages'][]	= 'stocks'	;

	$config['vacation_pages'][]	= 'scores'	;# Pages that can be accessed during vacation
	$config['vacation_pages'][]	= 'main';
	$config['vacation_pages'][]	= 'status';
	$config['vacation_pages'][]	= 'messages'	;
	$config['vacation_pages'][]	= 'sentmail'	;
	$config['vacation_pages'][]	= 'clanforum'	;
	$config['vacation_pages'][]	= 'contacts'	;
	$config['vacation_pages'][]	= 'profiles'	;
	$config['vacation_pages'][]	= 'clancrier'	;
	$config['vacation_pages'][]	= 'search'	;
	$config['vacation_pages'][]	= 'map'	;
	$config['vacation_pages'][]	= 'news'	;
	$config['vacation_pages'][]	= ''	;
	$config['vacation_pages'][]	= ''	;

// DIPLOMACY ADDON
	$config['warset'] = 0;# Allow individual war declarations?
	$config['peaceset'] = 0;# Allow individual alliances?

// STYLES
	$config['default_style']	= 1;# Default style to use
	$config['styles'][1]['name']	= 'Promathius';# Specify styles
	$config['styles'][1]['file']	= 'data/stylesheet.css'	;
	$config['tpldir'] = 'templates';# Default style directory


// EMPIRE CREATION
	$config['start_land']	= $rules['Establishment']['Land'];
	$config['start_cash']	= $rules['Establishment']['Cash'] / $config['game_factor'];
	$config['start_food']	= $rules['Establishment']['Food'] / $config['game_factor'];
	$config['start_runes']	= $rules['Establishment']['Runes'] / $config['game_factor'];
	$config['start_peasants']	= $rules['Establishment']['Peasants'];
									

// MISSIONS
	$config['magic']['hidden'] = $magic['Magic']['Hidden'];
	
	$config['missionspy'] = $magic['Intelligence']['Name'];
	$config['missionspycost'] = $magic['Intelligence']['Cost'];
	$config['missionspyratio'] = $magic['Intelligence']['Ratio'];
	
	$config['missionblast'] = $magic['Blast']['Name'];
	$config['missionblastcost'] = $magic['Blast']['Cost'];
	$config['missionblastratio'] = $magic['Blast']['Ratio'];
	
	$config['missionshield']	= $magic['Shield']['Name']	;
	$config['missionshieldcost'] = $magic['Shield']['Cost'];
	$config['missionshieldratio'] = $magic['Shield']['Ratio'];
	
	$config['missionstorm'] = $magic['FoodDestroy']['Name']	;
	$config['missionstormcost'] = $magic['FoodDestroy']['Cost'];
	$config['missionstormratio'] = $magic['FoodDestroy']['Ratio'];
	
	$config['missionrunes'] = $magic['RuneDestroy']['Name']	;
	$config['missionrunescost'] = $magic['RuneDestroy']['Cost'];
	$config['missionrunesratio'] = $magic['RuneDestroy']['Ratio'];
	
	$config['missionstruct']	= $magic['DestroyStructures']['Name'];
	$config['missionstructcost']	= $magic['DestroyStructures']['Cost'];
	$config['missionstructratio']	= $magic['DestroyStructures']['Ratio'];
	
	$config['missionfood'] = $magic['Forage']['Name']	;
	$config['missionfoodcost'] = $magic['Forage']['Cost']	;
	$config['missionfoodratio'] = $magic['Forage']['Ratio']	;
	
	$config['missiongold'] = $magic['GenerateCash']['Name']	;
	$config['missiongoldcost'] = $magic['GenerateCash']['Cost']	;
	$config['missiongoldratio'] = $magic['GenerateCash']['Ratio']	;

	$config['missioned'] = $magic['Explore']['Name']	;
	$config['missionedcost'] = $magic['Explore']['Cost']	;
	$config['missionedratio'] = $magic['Explore']['Ratio']	;
	
	$config['missionheal'] = $magic['Heal']['Name'];
	$config['missionhealcost'] = $magic['Heal']['Cost'];
	$config['missionhealratio'] = $magic['Heal']['Ratio'];
	
	$config['missionpeasant']	= $magic['GatherPeasants']['Name'];
	$config['missionpeasantcost']	= $magic['GatherPeasants']['Cost'];
	$config['missionpeasantratio']	= $magic['GatherPeasants']['Radio'];

	$config['missionprod'] = $magic['ProdMarket']['Name']	;
	$config['missionprodcost'] = $magic['ProdMarket']['Cost']	;
	$config['missionprodratio'] = $magic['ProdMarket']['Ratio']	;

	$config['missionkill'] = $magic['Suicide']['Name']	;# Otherwise known as 'Seppuku'
	$config['missionkillcost'] = $magic['Suicide']['Cost']	;
	$config['missionkillratio'] = $magic['Suicide']['Ratio']	;

	$config['missiongate'] = $magic['Gate']['Open'];
	$config['missiongatecost'] = $magic['Gate']['CostOpen'];
	$config['missiongateratio'] = $magic['Gate']['RatioOpen'];
	
	$config['missiongatextend']	= $magic['Gate']['Extend'];
	$config['missiongatextendcost']	= $magic['Gate']['CostExtend'];
	$config['missiongatextendratio']	= $magic['Gate']['RatioExtend'];

	$config['missionungate']	= $magic['Gate']['Close'];
	$config['missionungatecost']	= $magic['Gate']['CostClose'];
	$config['missionungateratio']	= $magic['Gate']['RatioClose'];

	$config['missionfight'] = $magic['WizardFight']['Name'];
	$config['missionfightcost'] = $magic['WizardFight']['Cost'];
	$config['missionfightratio'] = $magic['WizardFight']['Ratio'];

	$config['missionsteal'] = $magic['StealCash']['Name']	;
	$config['missionstealcost'] = $magic['StealCash']['Cost']	;
	$config['missionstealratio'] = $magic['StealCash']['Ratio'];

	$config['missionrob'] = $magic['StealFood']['Name'];
	$config['missionrobcost'] = $magic['StealFood']['Cost'];
	$config['missionrobratio'] = $magic['StealFood']['Ratio'];

	$config['missionadvance']	= $magic['Move']['Advance'];
	$config['missionadvancecost']	= $magic['Move']['CostAdvance'];
	$config['missionadvanceratio']	= $magic['Move']['RatioAdvance'];
	
	$config['missionback'] = $magic['Move']['Back']	;
	$config['missionbackcost'] = $magic['Move']['CostBack']	;
	$config['missionbackratio']	= $magic['Move']['RatioBack'];

	$config['roundend'] = "Feb. 1, 2006."	;# An English representation of the time of the round's end

// MILITARY
	$config['towers'] = $rules['Defending']['DefencesPoints'];# Defensive points provided by guard towers
	$config['blddef'] = $rules['Defending']['BuildingPoints'];# Defensive points provided by other buildings
	$config['force_atktype']	= 2;# Forces Standard Attacks under 500 land. Set to 0 to disable.
	$config['force_atkland']	= 500;

// ATTACKING
if($duplicate != 1)
{
	$atktypedata[] = array();
	$defaultatk = $attacking['AttackTypes']['General'];
	$duplicate = 1; // Prevent duplicate entries
	
	function addAtkDefaultValue($string, $attack, $num, $tactical = 0)
	{
		global $atktypedata, $attacking, $defaultatk;
		if($tactical)
			$string2 =  $tactical;
		else
			$string2 = $string;
		$atktypedata[$e][$string] = $attacking[$defaultatk][$string2];
	}
	function addAtkValue($string, $attack, $num, $tactical = 0)
	{
		global $atktypedata, $attacking, $defaultatk;
		if($tactical)
			$string2 =  $tactical;
		else
			$string2 = $string;
		if(!$attacking[$attack][$string])
		{
			$atktypedata[$num][$string] = $attacking[$defaultatk][$string2];
		}
		else
		{
			$atktypedata[$num][$string] = $attacking[$attack][$string2];
		}
	}
	for ($e = 1; $e <= $attacking['AttackTypes']['Number']; $e++)
	{
		if($attacking['AttackTypes'][$e] == $attacking['AttackTypes']['General'])
		{
			$atkdefault = $attacking['AttackTypes'][$e];
			addAtkDefaultValue('ValidTypes', $atkdefault, $e);
			addAtkDefaultValue('OrderPenalty', $atkdefault, $e);
			addAtkDefaultValue('OverallBonus', $atkdefault, $e);
			addAtkDefaultValue('LossPenalty', $atkdefault, $e);
			addAtkDefaultValue('BuildingGain', $atkdefault, $e);
			addAtkDefaultValue('BuildingDestroy', $atkdefault, $e);
			addAtkDefaultValue('PopulationDensityWeight', $atkdefault, $e);
			addAtkDefaultValue('GainableLand', $atkdefault, $e);
			addAtkDefaultValue('PopulationControlWeight', $atkdefault, $e);
			addAtkDefaultValue('OrderWeight', $atkdefault, $e);
			addAtkDefaultValue('DefenseRemainingWeight', $atkdefault, $e);
			$fightratio = str_replace("%", "", $attacking[$atkdefault]['FightRatio']);
			$fightratio = explode("-", str_replace(" ", "", $fightratio));
			$atktypedata[$e]['MinFight'] = $fightratio[0];
			$atktypedata[$e]['MaxFight'] = $fightratio[1];
			foreach($attacking[$atkdefault] as $id => $name)
			{
				$objectarray = explode(":", $id);
				$objectarray[0] = strtolower($objectarray[0]);
				if($objectarray[0] == 'tactical')
				{
					addAtkDefaultValue($objectarray[1], $atkdefault, $e, $id);
				}
			}
		}
		$e = 999; // Break the loop
	}
	for ($e = 1; $e <= $attacking['AttackTypes']['Number']; $e++)
	{
		$config['atknames'][$e] = $language['Attacking']['Atk'.$e];
		$config['atkdescriptions'][$e] = $language['Attacking']['Atk'.$e.'Descr'];
		$atk = $attacking['AttackTypes'][$e];
		addAtkValue('ValidTypes', $atk, $e);
		addAtkValue('OrderPenalty', $atk, $e);
		addAtkValue('OverallBonus', $atk, $e);
		addAtkValue('LossPenalty', $atk, $e);
		addAtkValue('BuildingGain', $atk, $e);
		addAtkValue('BuildingDestroy', $atk, $e);
		addAtkValue('PopulationDensityWeight', $atk, $e);
		addAtkValue('GainableLand', $atk, $e);
		addAtkValue('PopulationControlWeight', $atk, $e);
		addAtkValue('OrderWeight', $atk, $e);
		addAtkValue('DefenseRemainingWeight', $atk, $e);
		$fightratio = str_replace("%", "", $attacking[$atk]['FightRatio']);
		$fightratio = explode("-", str_replace(" ", "", $fightratio));
		$atktypedata[$e]['MinFight'] = $fightratio[0];
		$atktypedata[$e]['MaxFight'] = $fightratio[1];
		foreach($attacking[$atk] as $id => $name)
		{
			$objectarray = explode(":", $id);
			$objectarray[0] = strtolower($objectarray[0]);
			if($objectarray[0] == 'tactical')
			{
				addAtkValue($objectarray[1], $atk, $e, $id);
			}
		}
	}
}
	$config['sackmodifiercash'] = $rules['Attacking']['CashAttackGains'];# Cash attack gains are multiplied by this amount
	$config['sackmodifierfood'] = $rules['Attacking']['FoodAttackGains'];# Food attack gains are multiplied by this amount
	$config['landattackgains'] = $rules['Attacking']['LandAttackGains'];# Food attack gains are multiplied by this amount

$config['races'] = $factions['Factions']['Number'];
$config['regions'] = count($regions['Regions']);
$config['regionarray'] = $regions['Regions'];
$config['defaultfaction'] = $factions['Factions']['Default'];

for ($e = 1; $e <= count($regions['Regions']); $e++)
{
	$ername = $regions['Regions'][$e];
	$erstring = $regions[$ername]['Name'];
	$config['regiontags'][$ername] = $erstring;
	for ($i2 = 1; $i2 <= $factions['Factions']['Number']; $i2++)
	{
		$new_e = ($e * 100) + $i2;
		$config['eras']	= count($regions['Regions']);
		$config['er'][$new_e]['ename']	= $erstring;
		$config['regionpos'][$ername]['x']	= $regions[$ername]['Latitude'];
		$config['regionpos'][$ername]['y']	= $regions[$ername]['Longitude'];
		$config['er'][$new_e]['ncash']	= $config['ncash'];
		$config['er'][$new_e]['nfood']	= $config['nfood'];
		$config['er'][$new_e]['nrunes']	= $config['nrunes'];
		$config['er'][$new_e]['wizards']	= $config['wizards'];
		$config['er'][$new_e]['offenseb']	= 1;
		$config['er'][$new_e]['defenceb']	= 1;
		$config['er'][$new_e]['bptb']	= 1;
		$config['er'][$new_e]['rcrtb']	= 1;
		$config['er'][$new_e]['costsb']	= 1;
		$config['er'][$new_e]['magicb']	= 1;
		//$config['er'][$new_e]['indb']	= 1;
		$config['er'][$new_e]['pcib']	= 1;
		$config['er'][$new_e]['explb']	= 1;
		$config['er'][$new_e]['mktb']	= 1;
		$config['er'][$new_e]['foodb']	= 1;
		$config['er'][$new_e]['runesb']	= 1;
		$config['er'][$new_e]['farmsb']	= 1;
	
		if($regions[$ername]['Offense'] && $regions[$ername]['Offense'] != 0)
			$config['er'][$new_e]['offenseb']	= $regions[$ername]['Offense'];
		if($regions[$ername]['Defence'] && $regions[$ername]['Defence'] != 0)
			$config['er'][$new_e]['defenceb']	= $regions[$ername]['Defence'];
		if($regions[$ername]['BuildSpeed'] && $regions[$ername]['BuildSpeed'] != 0)
			$config['er'][$new_e]['bptb']	= $regions[$ername]['BuildSpeed'];
		if($regions[$ername]['RecruitSpeed'] && $regions[$ername]['RecruitSpeed'] != 0)
			$config['er'][$new_e]['rcrtb']	= $regions[$ername]['RecruitSpeed'];
		if($regions[$ername]['TroopCosts'] && $regions[$ername]['TroopCosts'] != 0)
			$config['er'][$new_e]['costsb']	= $regions[$ername]['TroopCosts'];
		if($regions[$ername]['MagicPower'] && $regions[$ername]['MagicPower'] != 0)
			$config['er'][$new_e]['magicb']	= $regions[$ername]['MagicPower'];
		//if($regions[$ername]['TroopOutput'] && $regions[$ername]['TroopOutput'] != 0)
		//	$config['er'][$new_e]['indb']	= $regions[$ername]['TroopOutput'];
		if($regions[$ername]['Income'] && $regions[$ername]['Income'] != 0)
			$config['er'][$new_e]['pcib']	= $regions[$ername]['Income'];
		if($regions[$ername]['Explore'] && $regions[$ername]['Explore'] != 0)
			$config['er'][$new_e]['explb']	= $regions[$ername]['Explore'];
		if($regions[$ername]['MarketCosts'] && $regions[$ername]['MarketCosts'] != 0)
			$config['er'][$new_e]['mktb']	= $regions[$ername]['MarketCosts'];
		if($regions[$ername]['FoodConsumption'] && $regions[$ername]['FoodConsumption'] != 0)
			$config['er'][$new_e]['foodb']	= $regions[$ername]['FoodConsumption'];
		if($regions[$ername]['RuneProduction'] && $regions[$ername]['RuneProduction'] != 0)
			$config['er'][$new_e]['runesb']	= $regions[$ername]['RuneProduction'];
		if($regions[$ername]['FoodProduction'] && $regions[$ername]['FoodProduction'] != 0)
			$config['er'][$new_e]['farmsb']	= $regions[$ername]['FoodProduction'];
	}
}

	// Faction Optional Factors
	function createRaceFactor($flong, $fshort)
	{
		global $factions, $config, $new_i, $new_il, $fname;
		
		if(!$factions[$fname][$flong] || $factions[$fname][$flong] == 0)
		{
			$factions[$fname][$flong]	= 1;
		}
		$config['er'][$new_i][$fshort]	= $factions[$fname][$flong] * $config['er'][$new_il][$fshort.'b'];
	}

for ($i = 1; $i <= $factions['Factions']['Number']; $i++)
{
	$new_i = $i + (100);
	$fname = $factions['Factions'][$i];
	if(!$factions[$fname])
		die("Fatal Error: Faction <B>'".$fname."'</b> does not exist.");
	if($fname != '' || $fname != 0 || $fname != null)
		$config['er'][$new_i]['rname'] = $fname;
	else
		$config['er'][$new_i]['rname'] = "Unknown";
	$config['er'][strtolower($fname)] = $i;
	
	// Get the region descriptions
		$facdescr1path = $phpbb_root_path.'../data/descriptions/Factions/'.strtolower($fname).'.htm';
		$facdescr2path = $data_root_path.'/descriptions/Factions/'.strtolower($fname).'.htm';
		if($phpbb_root_path != '' && file_exists($facdescr1path))
			$config['er'][$new_i]['factiondescriptions'][$i] = file_get_contents($facdescr1path);
		elseif(file_exists($facdescr2path))
			$config['er'][$new_i]['factiondescriptions'][$i] = file_get_contents($data_root_path.'/descriptions/Factions/'.strtolower($fname).'.htm');
				
	
	$config['er'][$new_i]['location']	= $factions[$fname]['Location'];
	if($config['er'][$new_i]['location'] <= 0)
		$config['er'][$new_i]['location'] = '1';

	$config['er'][$new_i]['regionselectdescription'] = $factions[$fname]['RegionSelectDescription'];
	
	// Process regional data from regions.ini
	$theregiontags	= explode(',', str_replace(" ", "", $factions[$fname]['Regions']));
	foreach($theregiontags as $num => $name)
	{
		$config['er'][$new_i]['regiontags'][$num] = $theregiontags[$num];
		$config['er'][$new_i]['regions'][$num] = $config['regiontags'][$theregiontags[$num]];
		
		// Get the region descriptions
			$regdescr1path = $phpbb_root_path.'../data/descriptions/Regions/'.strtolower($theregiontags[$num]).'.htm';
			$regdescr2path = $data_root_path.'/descriptions/Regions/'.strtolower($theregiontags[$num]).'.htm';
			if($phpbb_root_path != '' && file_exists($regdescr1path))
				$config['er'][$new_i]['regiondescriptions'][$num] = file_get_contents($regdescr1path);
			elseif(file_exists($regdescr2path))
				$config['er'][$new_i]['regiondescriptions'][$num] = file_get_contents($data_root_path.'/descriptions/Regions/'.strtolower($theregiontags[$num]).'.htm');
				
		if(!$config['er'][$new_i]['regions'][$num])
			$config['er'][$new_i]['regions'][$num] = 'MISSING: '.$theregiontags[$num];
	}

	$config['er'][$new_i]['culture']	= $factions[$fname]['Culture'];	
	$config['er'][$new_i]['unlock']	= $factions[$fname]['Unlockrequire_oncement'];
	$config['troops'] = count($units['Units']);
	$config['trooptotal'] = count($units['Units']);
	for ($t = 1; $t <= count($units['Units']); $t++)
	{
		$troopname = $units['Units'][$t];
		if(!$troopname){
			unset($units['Units'][$t]);
			$config['trooptotal']--;
			$config['troops']--;
			break;
		}
		$config['troopindex'][$t] = $units['Units'][$t];
		$int_i = $t - 1;
		$tr = $t - 1;
		$factiontroop = $factions[$fname]['Unit'.$t];
		$config['er'][$new_i]['troop'.$tr]	= $factiontroop;
		$config['er'][$new_i]['troopidentifier'.$troopname]	= $tr;
		$config['er'][$new_i]['troopidname'.$tr]	= $troopname;

		// Name
		$troopstring = explode(',', $units[$troopname]['Name']);
		$config['er'][$new_i]['troop'.$tr]	= $troopstring[1];
		$config['er'][$new_i]['troop'.$tr.'alt']	= $troopstring[0];

		// Descr		
		$config['er'][$new_i]['troop'.$tr.'description']	= $units[$troopname]['Description'];
		
		// Type
		$config['er'][$new_i]['troop'.$tr.'type']	= $units[$troopname]['Type'];
		$config['er'][$new_i]['troop'.$troopname.'type']	= $units[$troopname]['Type'];
		
		// Cost
		$config['troop'][$int_i] = $units[$troopname]['Cost'];
		
		// Prerequisites
		$trooprequires = str_replace(' ', '', $units[$troopname]['Requires']);
		$trooprequires = explode(':', $trooprequires);
		$config['er'][$new_i]['troop'.$tr.'requires'] = $trooprequires[0];
		if (!$trooprequires[1])
			$config['er'][$new_i]['troop'.$tr.'requiresamnt'] = 1;
		else
			$config['er'][$new_i]['troop'.$tr.'requiresamnt'] = $trooprequires[1];
		
		// Recruitment rate
		$config['er'][$new_i]['troop'.$tr.'rate'] = $units[$troopname]['TrainablePerBarracks'];
		
		// Faction
		$unit_factions = explode(',', $units[$troopname]['Factions']);
		for ($uf = 0; $uf <= count($unit_factions); $uf++)
		{
			$unit_faction = str_replace(' ', '', strtolower($unit_factions[$uf]));
			if($unit_faction == strtolower($fname))
			{
				$config['er'][$new_i]['troop'.$tr.'validfaction'] = true;
				//echo $fname. "s can train ".$troopname.".<br>";
			}
		}
		$config['er'][$new_i]['troop'.$tr.'factions']	= $unit_factions;
		
		// Defence
		$config['er'][$new_i]['troop'.$tr.'armor']	= $units[$troopname]['Armor'];
		$config['er'][$new_i]['troop'.$tr.'block']	= $units[$troopname]['Block'];
		
		// Attack
		$config['er'][$new_i]['troop'.$tr.'weapon']	= $units[$troopname]['Weapon'];
		$config['er'][$new_i]['troop'.$tr.'skill']	= $units[$troopname]['Skill'];
		
		// Loyalty
		$config['er'][$new_i]['troop'.$tr.'loyalty']	= $units[$troopname]['Loyalty'];
		
		// OrderBonus
		$config['er'][$new_i]['troop'.$tr.'orderbonus']	= $units[$troopname]['OrderBonus'];
		
		// FoodConsumption
		$config['troop'.$int_i]['foodconsumption']	= $units[$troopname]['Food'];
		
		// Size
		if($units[$troopname]['Size'])
			$config['er'][$new_i]['troop'.$troopname.'size']	= $units[$troopname]['Size'];
		else
			$config['er'][$new_i]['troop'.$troopname.'size'] = 1;
		
		// Determine if it is the transport unit
		if($units[$troopname]['Transporter'] == 1)
		{
			$config['aidtroop'] = $t -1;
		}
	}

	
	/////////////////////////
	// Structures
	/////////////////////////
	
	foreach ($structures as $id => $name)
	{
	
		// ID
		$config['er'][$new_i]['structure'.$id.'id'] = $id;
		
		// Name
		$buildingstring = explode(',', $structures[$id]['Name']);
		$config['er'][$new_i]['structure'.$id]	= $buildingstring[1];
		$config['er'][$new_i]['structure'.$id.'alt']	= $buildingstring[0];

		$config['er'][$new_i]['structure'.$id.'description'] = $structures[$id]['Description'];

		// Income Category
		$config['er'][$new_i]['structure'.$id.'category'] = $structures[$id]['Category'];
	
		// Cost
		$config['structure'][$id] = $structures[$id]['Cost'];
			
		// Recruitment rate
		$config['er'][$new_i]['structure'.$id.'rate'] = $structures[$id]['BuildablePerTurn'];

		// Employees required
		$config['er'][$new_i]['structure'.$id.'employees'] = $structures[$id]['Employees'];

		// Land
		$config['er'][$new_i]['structure'.$id.'land'] = $structures[$id]['Land'];
		
		$building_factions = explode(',', $structures[$id]['Factions']);
		for ($uf = 0; $uf <= count($building_factions); $uf++)
		{
			$building_faction = str_replace(' ', '', strtolower($building_factions[$uf]));
			if($building_faction == strtolower($fname))
			{
				$config['er'][$new_i]['structure'.$id.'validfaction'] = true;
			}
		}
		
		// Attack value
		$config['er'][$new_i]['structure'.$id.'attack'] = $structures[$id]['Attack'];
		$config['er'][$new_i]['structure'.$id.'dtype'] = $structures[$id]['DefenseType'];
		
		// Strength
		$config['er'][$new_i]['structure'.$id.'strength'] = $structures[$id]['Strength'];
		if($config['er'][$new_i]['structure'.$id.'strength'] <= 10)
			$config['er'][$new_i]['structure'.$id.'strength'] = 10;
		
		// Size
		if($structures[$id]['Size'])
			$config['er'][$new_i]['structure'.$id.'size'] = $structures[$id]['Size'];
		else
			$config['er'][$new_i]['structure'.$id.'size'] = 1;

	}
	

	$new_il = $i + (100*$factions[$fname]['Location']);
	
	createRaceFactor('Offense', 'offense');
	createRaceFactor('Defence', 'defence');
	createRaceFactor('BuildSpeed', 'bpt');
	createRaceFactor('RecruitSpeed', 'rcrt');
	createRaceFactor('TroopCosts', 'costs');
	createRaceFactor('MagicPower', 'magic');
	createRaceFactor('Income', 'pci');
	createRaceFactor('Explore', 'expl');
	createRaceFactor('MarketCosts', 'mkt');
	createRaceFactor('FoodConsumption', 'food');
	createRaceFactor('RuneProduction', 'runes');
	createRaceFactor('FoodProduction', 'farms');

	
	// Starting troops + buildings
		$trooparray = '';
		$troops = '';
		foreach($factions[$fname] as $id => $name)
		{
			$objectarray = explode(":", $id);
			$objectarray[0] = strtolower($objectarray[0]);
			if($objectarray[0] == 'unit')
			{
				$config['er'][$new_i]['troopstart']['unit_'.$objectarray[1]] = $factions[$fname][$id]/$config['game_factor'];
			}
			elseif($objectarray[0] == 'structure')
			{
				$config['er'][$new_i]['structurestart'][$objectarray[1]] = $factions[$fname][$id]/$config['game_factor'];
			}
		}
		
		$config['er'][$new_i]['starting_land'] = $factions[$fname]['Land'];
		$config['er'][$new_i]['starting_cash'] = $factions[$fname]['Funds']/$config['game_factor'];
		$config['er'][$new_i]['starting_agents'] = $factions[$fname]['Agents']/$config['game_factor'];
		$config['er'][$new_i]['starting_runes'] = $factions[$fname]['Runes']/$config['game_factor'];
		$config['er'][$new_i]['starting_food'] = $factions[$fname]['Food']/$config['game_factor'];
		$config['er'][$new_i]['starting_taxrate'] = $factions[$fname]['Taxrate'];
		$config['er'][$new_i]['starting_population'] = $factions[$fname]['Population'];
		$config['er'][$new_i]['starting_loan'] = $factions[$fname]['Loan']/$config['game_factor'];
		$config['er'][$new_i]['starting_savings'] = $factions[$fname]['Savings']/$config['game_factor'];
		$config['er'][$new_i]['starting_patriotism'] = $factions[$fname]['Patriotism'];
		$config['er'][$new_i]['starting_shame'] = $factions[$fname]['Shame'];
	
	$config['er'][$new_i]['nomove']	= $factions[$fname]['NoMovingRegions'];
	$config['er'][$new_i]['nogate']	= $factions[$fname]['NoExpeditions'];
	$config['er'][$new_i]['nokill']	= $factions[$fname]['NoSuicide'];
	$config['er'][$new_i]['nosteal']	= $factions[$fname]['NoStealingCash'];
	$config['er'][$new_i]['norob']	= $factions[$fname]['NoStealingFood'];
	$config['er'][$new_i]['nofight']	= $factions[$fname]['NoFighting'];
	$config['er'][$new_i]['noprod']	= $factions[$fname]['NoMarketProdding'];
	$config['er'][$new_i]['nofood']	= $factions[$fname]['NoFoodCreate'];
	$config['er'][$new_i]['nospy']	= $factions[$fname]['NoSpying'];
	$config['er'][$new_i]['noblast']	= $factions[$fname]['NoBlast'];
	$config['er'][$new_i]['noshield']	= $factions[$fname]['NoShieldDefences'];
	$config['er'][$new_i]['nostruct']	= $factions[$fname]['NoSabotageBuildings'];
	$config['er'][$new_i]['nopeasant']	= $factions[$fname]['NoGatherPeasants'];
	$config['er'][$new_i]['noheal']	= $factions[$fname]['NoHeal'];
	$config['er'][$new_i]['noexplore']	= $factions[$fname]['NoExplore'];
	$config['er'][$new_i]['nogold']	= $factions[$fname]['NoExtraTaxing'];
	$config['er'][$new_i]['norunes']	= $factions[$fname]['NoDestroyRunes'];
	$config['er'][$new_i]['nostorm']	= $factions[$fname]['NoPoisenCrops'];
	
	$config['er'][$new_i]['homes_description'] = "Reduce poverty and allow for further population growth.";
	$config['er'][$new_i]['shops_description'] = "Stengthen the economy of the empire through trade.";
	$config['er'][$new_i]['industry_description'] = "Facilitate the ongoing recruitment of military personal.";
	$config['er'][$new_i]['barracks_description'] = "Provide work for idle troops, reducing military costs.";
	$config['er'][$new_i]['labs_description'] = "Stimulate the intellectual growth of society, and catalyze the publication of scrolls.";
	$config['er'][$new_i]['farms_description'] = "Provide the starches and meats necessary for the survival of society.";
	$config['er'][$new_i]['towers_description'] = "Protect citizen states by means of walls, gates and towers. Aside from protection against foreign powers, defenses also increase populace loyalty.";

	$config['er'][$new_i]['homes']	= $rules['Building']['Homes'];# In determining precedence, the following attributes prioritize for race:
	$config['er'][$new_i]['shops']	= $rules['Building']['CashProduce'];#    rname, offense, defence, bpt, costs, magic, ind, pci, expl, mkt,
	$config['er'][$new_i]['industry']	= $rules['Building']['TroopProduce']	;#    food, runes, farms, troop*
	$config['er'][$new_i]['barracks']	= $rules['Building']['TroopHouse'];# And the following attributes prioritize for era:
	$config['er'][$new_i]['labs']	= $rules['Building']['RuneProduce'];#    ename, peasants, nfood, nrunes, wizards, homes, shops, industry
	$config['er'][$new_i]['labs_single']	= $rules['Building']['RuneProduceAlt'];#    ename, peasants, nfood, nrunes, wizards, homes, shops, industry
	$config['er'][$new_i]['nfarms']	= $rules['Building']['FoodProduce'];#    barracks, labs, nfarms, towers, empire, o_troop*, d_troop*
	$config['er'][$new_i]['towers']	= $rules['Building']['Defences']	;
	
	if($factions[$fname]['Homes'] != '')
		$config['er'][$new_i]['homes']	= $factions[$fname]['Homes'];
	if($factions[$fname]['CashProduce'] != '')
		$config['er'][$new_i]['shops']	= $factions[$fname]['CashProduce'];
	if($factions[$fname]['TroopProduce'] != '')
		$config['er'][$new_i]['industry']	= $factions[$fname]['TroopProduce'];
	if($factions[$fname]['TroopHouse'] != '')
		$config['er'][$new_i]['barracks']	= $factions[$fname]['TroopHouse'];
	if($factions[$fname]['RuneProduce'] != '')
		$config['er'][$new_i]['labs']	= $factions[$fname]['RuneProduce'];
	if($factions[$fname]['RuneProduceAlt'] != '')
		$config['er'][$new_i]['labs_single']	= $factions[$fname]['RuneProduceAlt'];
	if($factions[$fname]['FoodProduce'] != '')
		$config['er'][$new_i]['nfarms']	= $factions[$fname]['FoodProduce'];
	if($factions[$fname]['Defences'] != '')
		$config['er'][$new_i]['towers']	= $factions[$fname]['Defences'];
		
	$config['er'][$new_i]['empire'] = $config['er'][101]['empire'];
	if($factions[$fname]['Empire'] != '')
		$config['er'][$new_i]['empire']	= $factions[$fname]['Empire'];
	
	for ($e = 2; $e <= count($regions['Regions']); $e++)
	{
		$config['er'][$i + (100 * $e)] = $config['er'][$new_i];
		$config['er'][$i + (100 * $e)]['ename']	= $regions['Regions'][$e];
	}
	
		if($factions[$fname]['Debug'] > 0 || $factions['Factions']['DebugAll'] > 0)
		{
			if($debug < 1){
				echo '<center><h1>Debug Mode</h1>';
				echo "This mode combines the game factors of each faction with their default region's. This is useful for balancing.<br />";
				echo 'Remove any "Debug = Yes" from factions.ini to restore the game.';
			}
			$debug++;
			echo '<table><tr><td colspan=2 align=center><br /><b>'.$i.'. '.'<u>'.$config['er'][$new_i]['rname'].'</u></b><br /></td></tr>';
			echo '<tr><td colspan=2 align=center>In '.$regions['Regions'][$config['er'][$new_i]['location']].'<br /><br /></td></tr>';
			echo '<td>Offense: 	</td><td align=right>'.$config['er'][$new_i]['offense'].'<br /></td></tr>';
			echo '<td>Defense: 	</td><td align=right>'.$config['er'][$new_i]['defence'].'<br /></td></tr>';
			echo '<td>Build Speed: 	</td><td align=right>'.$config['er'][$new_i]['bpt'].'<br /></td></tr>';
			echo '<td>Recruit Speed: 	</td><td align=right>'.$config['er'][$new_i]['rcrt'].'<br /></td></tr>';
			echo '<td>Troop Costs: 	</td><td align=right>'.$config['er'][$new_i]['costs'].'<br /></td></tr>';
			echo '<td>Magic Power: 	</td><td align=right>'.$config['er'][$new_i]['magic'].'<br /></td></tr>';
			//echo '<td>Troop Output: 	</td><td align=right>'.$config['er'][$new_i]['ind'].'<br /></td></tr>';
			echo '<td>Income: 	</td><td align=right>'.$config['er'][$new_i]['pci'].'<br /></td></tr>';
			echo '<td>Explore: 	</td><td align=right>'.$config['er'][$new_i]['expl'].'<br /></td></tr>';
			echo '<td>Market Cost: 	</td><td align=right>'.$config['er'][$new_i]['mkt'].'<br /></td></tr>';
			echo '<td>Food Consumption: 	</td><td align=right>'.$config['er'][$new_i]['food'].'<br /></td></tr>';
			echo '<td>Rune Production: 	</td><td align=right>'.$config['er'][$new_i]['runes'].'<br /></td></tr>';
			echo '<td>Food Production: 	</td><td align=right>'.$config['er'][$new_i]['farms'].'<br /></td></tr>';
			echo '</table>';
		}
}

	// Order Values
	$config['order_unemployment'] = $rules['Order']['Unemployment'];
	$config['order_military'] = $rules['Order']['Military'];
	$config['order_workersneeded'] = $rules['Order']['WorkersNeeded'];
	$config['order_shame'] = $rules['Order']['Shame'];
	$config['order_patriotism'] = $rules['Order']['Patriotism'];
	$config['order_structures'] = $rules['Order']['Structures'];
	$config['order_size'] = $rules['Order']['Size'];
	$config['order_taxes'] = $rules['Order']['Taxes'];

	/////////////////////////////////////////
	// Structures
	/////////////////////////////////////////
	foreach($structures as $name => $value)
	{
		// Find out what each building does
		if($structures[$name]['Homes']) // A home?
		{
			$config['structures']['homes'][$name] = $structures[$name]['Homes'];
			//echo strtoupper($name).":".$structures[$name]['Homes']." homes found.<Br>";
		}
		if($structures[$name]['FoodProduce']) // A farm?
		{
			$config['structures']['farms'][$name] = $structures[$name]['FoodProduce'];
			//echo strtoupper($name).":".$structures[$name]['FoodProduce']." food gains.<Br>";
		}
		if($structures[$name]['TradeIncome'] || $structures[$name]['TradeDecay'] || $structures[$name]['DistanceDecay']) // A Market?
		{
			if($structures[$name]['TradeIncome'])
				$config['structures']['markets'][$name] = $structures[$name]['TradeIncome'];
			else
				$config['structures']['markets'][$name] = 0;
				
			if($structures[$name]['TradeDecay'])
				$config['structures']['markets_decay'][$name] = $structures[$name]['TradeDecay'];
			else
				$config['structures']['markets_decay'][$name] = 0.2;
			if($structures[$name]['DistanceDecay'])
				$config['structures']['markets_distance'][$name] = $structures[$name]['DistanceDecay'];
			else
				$config['structures']['markets_distance'][$name] = 0.25;
			if($structures[$name]['AveragePlayerIncome'])
				$config['structures']['markets_avgincome'][$name] = $structures[$name]['AveragePlayerIncome'];
			else
				$config['structures']['markets_avgincome'][$name] = 10000;
		}
		if($structures[$name]['TradeImprove'])
				$config['structures']['markets_roads'][$name] = $structures[$name]['TradeImprove'];

		if($structures[$name]['Income']) // Other income?
		{
			$config['structures']['income'][$name] = $structures[$name]['Income'];
			if($config['er'][$new_i]['structure'.$name.'category'])
				$config['structures']['incomecategory'][$name] = $config['er'][$new_i]['structure'.$name.'category'];
			else
				$config['structures']['incomecategory'][$name] = $config['er'][$new_i]['structure'.$name];
		}
		if($structures[$name]['FactoryType']) // A factory (e.g. barracks)?
		{
			$config['structures']['factory'.$structures[$name]['FactoryType']][$name] = $structures[$name]['FactoryType'];
		}
		if($structures[$name]['RuneProduce']) // Produces scrolls?
		{
			$config['structures']['runes'][$name] = $structures[$name]['RuneProduce'];
			//echo strtoupper($name).":".$structures[$name]['PublicOrder']." public order bonus.<Br>";
		}
		if($structures[$name]['AgentTrain']) // Trains agents?
		{
			$config['structures']['agents'][$name] = $structures[$name]['AgentTrain'];
			//echo strtoupper($name).":".$structures[$name]['PublicOrder']." public order bonus.<Br>";
		}
		if($structures[$name]['PublicOrder']) // Public order bonus?
		{
			$porderd = explode(":", $structures[$name]['PublicOrder']);
			$porderd = str_replace(" ", "", $porderd);
			$config['structures']['PublicOrder'][$name] = $porderd[1];
			$config['structures']['PublicOrderCategory'][$name] = $porderd[0];
			//echo strtoupper($name).":".$structures[$name]['PublicOrder']." public order bonus.<Br>";
		}
		if($structures[$name]['FulfillNeed']) // Public order bonus?
		{
			$porderd = explode(":", $structures[$name]['FulfillNeed']);
			$porderd = str_replace(" ", "", $porderd);
			$config['structures']['FulfillNeed'][$name] = $porderd[1];
			$config['structures']['FulfillNeedCategory'][$name] = $porderd[0];
			//echo strtoupper($name).":".$structures[$name]['PublicOrder']." public order bonus.<Br>";
		}
		if($structures[$name]['WallProtection']) // Walls?
		{
			$config['structures']['walls'][$name] = $structures[$name]['WallProtection'];
			//echo strtoupper($name).":".$structures[$name]['WallProtection']." wall protection.<Br>";
		}
		if($structures[$name]['TowerProtection']) // Towers?
		{
			$config['structures']['towers'][$name] = $structures[$name]['TowerProtection'];
			//echo strtoupper($name).":".$structures[$name]['TowerProtection']." tower protection.<Br>";
		}
	}

$config['measures'] = $measures;
$config['standards'] = $standards;

	$config['maxturns'] = $rules['Turns']['MaximumTurns'];# Max accumulated turns
	$config['maxstoredturns']	= 50;# Max stored turns
	$config['signupsclosed']	= 0;# Signups closed?
	$config['lockdb'] = 0;# Lock the database?
	$config['lastweek'] = 0;# Last week? (No loans)
	$config['turnsper'] = $rules['Turns']['TurnsGiven'];# X turns
	$config['perminutes'] = $rules['Turns']['TurnDelay'];# per Y minutes
	$config['updatetime']	= 1;
	$config['turnoffset'] = 0;# Correct for server lag
	$config['resetvote'] = 0;# Allow reset voting?
	$config['votepercent'] = 75;# Percent before notifying admins?
	$config['news']	 = '<span class="mnormal"></span>';
	$config['roundend'] = "Never";# An English representation of the time of the round's end

if($debug > 0)
{
	die;
}


