SCRIPT 'ATTACKER':
	$Notification 	= yes;
	$Title 		= "Attack Aftermath";
	$Body 		= "You assualted $DEFENDER_EMPIRE.<br /> You both suffered $TOTAL_CASUALTIES casualties";
	LoadScript	( 'ENDBATTLE', 'attacks.inc' );
END;



SCRIPT 'DEFENDER':
	$Notification 	= yes;
	$Title 		= array("Defended", "Assualted", "Pwned");
	$Body 		= "You were brutally assualted on by $ATTACKER_EMPIRE's vast army.
			  /n You both suffered $TOTAL_CASUALTIES casualties";
	LoadScript	( 'ENDBATTLE' );
	
	// Can have up to four buttons, width ==, lie underneath


	// Accept
	$Label[Accept] 	= "Accept";
	$Do[Accept] 	=  page(Accepted);

	$Action[Accepted] ='AcceptOffer()'; // Action will call JS onclick function -> this function sends a PHP function query to the PHP engine with the newsID
	$Page[Accepted] = "A notification will be sent to the other player indicating that you have accepted his terms."; // trigger only after successful ajax call, otherwise return error.

END;




SCRIPT 'ENDBATTLE'

	// We'll alter public order depending on the victory type etc.
	if ( $Victory )
	{
		if ( $VictoryQuality > 10 )
		{
			// Celebration
			addPatriotism ( 1, 'Expire: 1' );
			// General Awe
			addPatriotism ( 2, 'Expire: 3' );
		}
		else
			addPatriotism ( 1 );
	}
	elseif( $Defeat )
		addShame ( 1, 'Expire:4' );
END;