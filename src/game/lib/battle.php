<?
/////////////////////////////////////////////////////////////////
// BATTLE.PHP
// This file is a container for all battle results
/////////////////////////////////////////////////////////////////
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}
////////////////////////
// VICTORIES
////////////////////////

if ($utotal_loss >= 1)
{
    if ($utotal_loss > ($etotal_loss + 1) * 10 && $utotal_loss > 1000)
    {
        $victory_type = "Pyrrhic Victory";
        $randomvictory[] = "Your army won the battle against %s at such a high cost, that another victory such as this will probably soon cost you the war. You managed to gain %s.";
        $randomvictory[] = "Your soldiers paid dearly for this victory against %s. You gained %s.";
    }
    else
        if ($utotal_loss > ($etotal_loss + 1) * 4 && $utotal_loss > 100)
        {
            $victory_type = "Brute Victory";
            $randomvictory[] = "Your army won the battle against %s through absolute brute numbers. You gained %s.";
            $randomvictory[] = "Your victory against %s is due only to absolute brute numbers. You gained %s.";
        }
        else
            if ($utotal_loss * 4 < $etotal_loss)
            {
                $victory_type = "Great Victory";
                $randomvictory[] = "You achieved a magnificent victory against %s and gained %s.";
                $randomvictory[] = "After a heroic conflict, your soldiers through cunning strategy and hard discipline eventually smashed through %'s defences, gaining %s.";
            }
            else if ($utotal_loss < 50 && $etotal_loss < 50)
            {
                $victory_type = "Victory";
                $randomvictory[] = "In one short conflict, your troops managed to smash through %s's weak defences and capture %s.";
                $randomvictory[] = "In a swift attack, your troops managed to smash through %s's meagre defences and capture %s.";
            }
            else
            {
                $victory_type = "Victory";
                $randomvictory[] = "Your army breaked through %s's defences capturing %s.";
                $randomvictory[] = "Your army managed to press your enemy %s hard enough to gain %s.";
                $randomvictory[] = "After hours of bloody conflict, your troops managed to push through %s's defences and gain %s.";
                $randomvictory[] = "Your army, through relentless determination, manages to outdo %s and gain %s.";
            }
}
else
{
    $victory_type = "Clean Victory";
    $randomvictory[] = "Through cunning tactics, your troops were able to attain a victory against %s without any bloodshed. You gained %s.";
    $randomvictory[] = "Though there were injuries, nobody was killed in today's victory against %s. You gained %s.";
    // NOTE: Check that the enemy has troops
    $randomvictory[] = "As a result of %s's cowardly soldiers, the enemy fleed before taking any casualties! You gained %s.";
}

////////////////////////
// DEFEATS
////////////////////////

if ($utotal_loss >= 1 || $etotal_loss >= 1)
{
    if ($utotal_loss > ($etotal_loss + 1) * 14)
    {
        $defeat_type = "Crushing Defeat";
        $randomdefeat[] = "Your army was utterly crushed - what a shameful defeat!";
    }
    else
        if ($utotal_loss > ($etotal_loss + 1) * 5)
        {
            $defeat_type = "Crushing Defeat";
            $randomdefeat[] = "Your army has suffered a crushing defeat against %s.";
        }
        else
            if ($utotal_loss * 3 < $etotal_loss)
            {
                $defeat_type = "Close Defeat";
                $randomdefeat[] = "After a heroic fight, your army just barely failed to gain a victory.";
            }
            else if ($utotal_loss < 60 && $etotal_loss < 60)
            {
                $defeat_type = "Defeat";
                $randomdefeat[] = "After a speedy conflict, your army was eventually repelled by %s's defences.";
                $randomdefeat[] = "In a matter of mere minutes, your soldiers were defeated and routed by %s.";
                $randomdefeat[] = "In a very brief battle, your soldiers were defeated and routed by %s.";
            }
            else
            {
                $defeat_type = "Defeat";
                $randomdefeat[] = "After a long and bloody battle, your army was eventually repelled by %s's defences.";
                $randomdefeat[] = "After an intensive conflict, your army was eventually broken and routed.";
            }
}
else
{
    $defeat_type = "Draw";
    $randomdefeat[] = "Your soldiers did not manage to make any gains, although there were surprisingly no casualties.";
    $randomdefeat[] = "No soldiers were lost this day, though we failed to breach %s's defences.";
}

?>