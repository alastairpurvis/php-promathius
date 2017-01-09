///////////////////////////////////////////////////////////
// NEWS.INC
// Make sure that all strings with variables use the double
// inverted commas, and that pure strings use only the single
// inverted commas.
///////////////////////////////////////////////////////////


// *****************************************************
 EVENT 'Attacked':
	$Class = Private;
	$Feed = No;
	$Title = 'Attacked by an enemy', 'Attacked!', 'Assualted by an enemy';
	
	///////////////////////
	// MESSAGES
	///////////////////////
	if (Attacks == 1)
	{
		if(Culture == Greek)
		{
			if(CultureAttacker == Greek)
				$Message = "You were attacked by a fellow Greek army of ATTACKER.";
			else
				$Message = "You were attacked by a barbarian army of ATTACKER.";
		}
		else
		{
			if(Region != RegionAttacker)
				$Message = "You were attacked by a foreign power known as ATTACKER.";
			else
				$Message = "You were attacked by a local army of ATTACKER.";
		}
	}
	else
	{
		if(Culture == Greek)
		{
			if(CultureAttacker == Barbarian || CultureAttacker == Eastern || CultureAttacker == Egyptian)
				$Message = "You were attacked NUMBER times by a barbarian army of ATTACKER.";
		}
		else
		{
				$Message = "You were attacked NUMBER times by a foreign power known as ATTACKER.";
		}
	}

	///////////////////////
	// IMAGES
	///////////////////////
	if (Faction == Macedon)
		$Image 	= 'attacked: macedon';
	elseif (Culture == Greek)
		$Image 	= 'attacked: greek';
	elseif (Culure == Barbarian)
		$Image 	= 'attacked: barbarian';
	else
		$Image 	= 'attacked: eastern';
	
END;

// *****************************************************
 EVENT 'Diplomacy':
	$Class = Private;
	$Feed = No;
	if(Diplomacy.counteroffer)
	{
		$Title = 'A counter-offer', 'A reply';
	}
	else
	{
		if(Demand)
		{
			if(ally)
				$Title = 'Ally makes demand'
			else
				$Title = 'Faction makes demand';
		}
		elseif(Offer)
		{
			if(ally)
				$Title = 'Ally makes offer';
			else
				$Title = 'An offer', 'Faction makes offer';
		}
		else
		{
			if(ally)
				$Title = 'A diplomatic message', 'Ally makes proposition';
			else
				$Title = 'A diplomatic message', 'Faction makes proposition';
		}
	}
	
	///////////////////////
	// MESSAGES
	///////////////////////
	if (Attacks == 1)
	{
		if(Culture == Greek)
		{
			if(CultureAttacker == Greek)
				$Message = "You were attacked by a fellow Greek army of ATTACKER.";
			else
				$Message = "You were attacked by a barbarian army of ATTACKER.";
		}
		else
		{
			if(Region != RegionAttacker)
				$Message = "You were attacked by a foreign power known as ATTACKER.";
			else
				$Message = "You were attacked by a local army of ATTACKER.";
		}
	}
	else
	{
		if(Culture == Greek)
		{
			if(CultureAttacker == Barbarian || CultureAttacker == Eastern || CultureAttacker == Egyptian)
				$Message = "You were attacked NUMBER times by a barbarian army of ATTACKER.";
		}
		else
		{
				$Message = "You were attacked NUMBER times by a forign power known as ATTACKER.";
		}
	}

	///////////////////////
	// IMAGES
	///////////////////////
	if (Faction == Macedon)
		$Image 	= 'attacked: macedon';
	elseif (Culture == Greek)
		$Image 	= 'attacked: greek';
	elseif (Culure == Barbarian)
		$Image 	= 'attacked: barbarian';
	else
		$Image 	= 'attacked: eastern';
	
END;

// *****************************************************
 EVENT 'DiplomacyFeedback':
	$Class = Private;
	$Feed = No;
	if(Diplomacy.success)
	{
		$Title = 'Offer Accepted';
	}
	else
	{
		$Title = 'Offer Declined';	
	}

	
END;

// *****************************************************