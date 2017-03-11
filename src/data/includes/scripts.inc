///////////////////////////////////////////////////////////
// SCRIPTS.INC
// Make sure that all strings with variables use the double
// inverted commas, and that pure strings use only the single
// inverted commas.
///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////
// FUNCTIONS:
// Negatives apply, e.g. giveMoney(-200) takes away 200 gold)
//
//	enable('name', condition)	- enable a specified action
//	giveMoney
//	giveFood
//	giveRunes
//	giveLand
//	giveMages
//	giveUnitX
//	giveBuildingX			- House, Academy, custom building ID etc.
//	giveTurns
//	useTurns			- calculate turn uses
//	useTurnsSilently		- calculate turn uses without displaying the turn use report
//	Dialog				= creates a question dialog like "Enter lottery?"
//	Dialog.optionX			= creates an option with the specified string name, maximum of 3
//	Dialog.optionX.doY		= creates an action for a specified option, there are maximum of five actions per option, ** Always enclose functions here with ''
//	addDB(name, whatever)	- adds a value/string to a database. Useful for random selects in raffle-like events.
//	declare(name, string/number)	- creates/edits a variable
//
///////////////////////////////////////////////////////////

// *****************************************************
SCRIPT 'YearsPast':
	Class 		= 	Private;
	Feed 		= 	No;
	Title 		= 	"A dozen years";
	Message 	= 	"It has been twelve years since you founded your empire.";
	Image 		= 	"general: yearspast";
END;

// *****************************************************
SCRIPT 'PlatoAcademy':
	Class 		= 	Public;
	Feed 		= 	Yes;
	Title 		= 	'Plato's academy';
	Message 	= 	'Plato has founded an academy in Athens that is deemed to change the fate of intellect throughout the known world.';
	Image 		= 	'special: academy';
END;

// *****************************************************
SCRIPT 'OlympicGamesInvitation':
	Class 		= 	Public;
	Feed 		= 	No;
	Title 		= 	'The Olympic Games Begin';
	Message 	= 	'Every four years the Olympic Games are held at the site of Olympia to honour the gods. 
				Athletes from your faction have been invited to enter this great event.
				Admission is 150 gold per athlete. The winning prize will be 50,000 denarii (gold).'
	Image 		= 	'special: olympicgames';
	
	// Offer option to enter
	Dialog 		= 	'Would you like to enter?';
					Dialog.option1 = 'Yes';
						Dialog.option1.do1 = 'addDB(OlympicGamesContestants, ID)';
						Dialog.option1.do2 = 'giveMoney(-150)'
						// This was taken out, but would navigate to a second dialog
						// Dialog.option1.do3 = 'SCRIPT("OlympicGamesSecondAthlete", once)'
						// Dialog.option1.do4 = 'GOTO("OlympicGamesSecondAthlete", latest)'
					Dialog.option2 = 'No';
						Dialog.option2.do1 = "nothing";
END;

// *****************************************************
SCRIPT 'GrowingEmpire-Level1':
	Class 		= 	Private;
	Feed 		= 	No;
	Title 		= 	'An impressed populace';
	Message 	= 	'Although you are still very new to the throne, your citizens are impressed by your efforts.
					You are seen as a 'good leader' and many are beginning to feel at greater ease under your rule.';
	Image 		= 	'general: happypopulace';

	// Note that people are satisfied with the player's actions
	Opinion 	= 	greatness_happiness1;
					Opinion.Bonus = 3;		// Increase public order by 3%
					Opinion.DaysGrace = 3;		// Keep this opinion for at least 3 days
					Opinion.Decrease = -1;		// Start decreasing it at a rate of 1 order point
					Opinion.MaxDayDecrease = 3;	// Decrease it for three days (hence back to where it was)
					Opinion.ExpireRate = 1; 	// Rate in days, so 1 means that it goes down by 1 for every 1 day passed
END;

// *****************************************************
SCRIPT 'BanditProblems-Level1':
	Class 		= 	Public;
	Feed 		= 	No;
	Title 		= 	"Bandits on the rise";
	Message 	= 	"Farmers throughout the region are reporting significant bandit problems, and these problems are beginning to affect the local economy.
				Somebody needs to crush these rebels. Will it be you?";
	Image 		= 	"general: bandits";
END;

SCRIPT 'BanditProblems-Level2':
	Class 		=  	Public;
	Feed 		= 	No;
	Title 		= 	"Bandits a serious problem";
	Message 	= 	"Everyday there are reports of viscious bandits, pillaging small towns and farms throughout the region. 
				It is suspected that the majority of these bandits are foreigners, for which they are not at all welcome.
				Somebody needs to crush these rebels once and for all. Will it be you?";
	Image 		= 	"general: bandits";
END;

SCRIPT 'BanditProblems-Level3':
	Class 		= 	Public;
	Feed 		= 	No;
	Title 		= 	"A bandit warzone";
	Message 	= 	"Robbery and chaos is rampant through REGION. Foreign powers have come into our lands and are living off of our local resources.
				It is even said that "rivers were sucked up", as if a god had come from the heavens to quench his thirst.
				Somebody needs to silence these unwelcome barbarians..Perhaps it is a time to gather.";
	Image 		= 	"general: bandits";
END;

// *****************************************************