///////////////////////////////////////////////////////////
// CONDITIONS.INC
// Scripted News Conditions
///////////////////////////////////////////////////////////

//****************************************
// 	Empire grows to level 1
//****************************************

	if(Age > 3 &&  Age < 5 && Worth > 10 && Order > 75)
	{
		SCRIPT('GrowingEmpire-Level1', once);
	}

//	Empire grows to level 2

	elseif(Age > 5 &&  Age < 7 && Worth > 20 && Order > 70)
	{
		SCRIPT('GrowingEmpire-Level1', once);
	}

//****************************************
// 	Empire has been ruled for 12 years
//****************************************

	if(Age > 12)
	{
		SCRIPT('YearsPast', once);
	}

//****************************************
// 	Plato founds an academy
//****************************************

	if(Year >= -341 && Culture == 'Greek')
	{
		SCRIPT('PlatoAcademy', once);
	}

//****************************************
// 	Create an olympic games invitation
//****************************************

	SCRIPT('OlympicGamesInvitation', limit=6days);

//****************************************
// 	Note the rise of bandits
//****************************************

	if(localbandits > 40)
	{
		SCRIPT('BanditProblems-level1', limit=4days);
	}

	elseif(localbandits > 60)
	{
		SCRIPT('BanditProblems-level2', limit=4days);
	}

	else(localbandits > 80)
	{
		SCRIPT('BanditProblems-level3', limit=4days);
	}

//****************************************
// 	Low Public Order
//****************************************

	if(Order > 40 && useturn && var_OrderCheck == 0)
	{
		SCRIPT('LowOrder', limit=1days);
		declare(OrderCheck, 1);
	}

	elseif(Order > 20 && useturn && var_OrderCheck == 1)
	{
		SCRIPT('LowOrder', limit=2days);
		declare(OrderCheck, 2);
	}
	
	elseif(Order > 20 && useturn && var_OrderCheck == 2)
	{
		SCRIPT('LowOrder', limit=2days);
		declare(OrderCheck, 3);
	}

//****************************************
// 	Population Increases
//****************************************

	// We go backwards to ensure that, in the case of rapid growth,
	// the events don't all show one after the other
	if(Population >= 10000000)
	{
		SCRIPT('PopulationGrowth6', once);
	}
	elseif(Population >= 1000000)
	{
		SCRIPT('PopulationGrowth5', once);
	}
	elseif(Population >= 500000)
	{
		SCRIPT('PopulationGrowth4', once);
	}
	elseif(Population >= 200000)
	{
		SCRIPT('PopulationGrowth3', once);
	}
	elseif(Population >= 100000)
	{
		SCRIPT('PopulationGrowth2', once);
	}
	elseif(Population >= 50000)
	{
		SCRIPT('PopulationGrowth1', once);
	}