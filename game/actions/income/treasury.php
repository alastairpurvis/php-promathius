<?php
// Check that the script is not being accessed directly
if ( !defined('PROMATHIUS') )
{
	die("Hacking attempt");
}

$size = calcSizeBonus($users[networth]);
$loanrate = $config[loanbase] + $size;
$savrate = $config[savebase] - $size;

$maxloan = $users['networth'] * $config['greatness'] * $config['maxloan'];
$maxsave = $users['networth'] * $config['greatness'] * $config['maxsave'];

if ($do_borrow) {
	if ($lastweek)
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "We cannot offer you a loan at this time.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("Cannot take out loans during the last week of the game!");
	}
	fixInputNum($borrow);
	$borrow = invfactor($borrow);
	if(!empty($_POST['borrow_max']))
		$borrow = max(0, $maxloan-$users[loan]);
	if ($borrow < 0)
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "How could it be possible to take a loan out of " . $borrow . " gold pieces?";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("Cannot take out a negative loan.");
		}
	if ($borrow + $users[loan] > $maxloan)
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "We cannot offer you a loan for this amount.";
//		$error = "A loan of this sheer size is unspeakable, even for a King. Nobody can loan you this much gold.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("Cannot take out a loan for that much!");
		}
	$users[cash] += $borrow;
	$users[loan] += $borrow;
	saveUserData($users, "networth cash loan");
} 
if ($do_repay) {
	fixInputNum($repay);
	$repay = invfactor($repay);
	if(!empty($_POST['repay_max']))
		$repay = min($users[cash], $users[loan]);
	if ($repay > $users[cash])
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "Sorry, but your coffers don't contain the gold to make a repayment that large.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
		}
	if ($repay > $users[loan])
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "Though your generosity is most appreciated, you don't owe that much gold.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
		}
	$users[cash] -= $repay;
	$users[loan] -= $repay;
	saveUserData($users, "networth cash loan");
} 
if ($do_deposit) {
	fixInputNum($deposit);
	$deposit = invfactor($deposit);
	if(!empty($_POST['deposit_max']))
		$deposit = min($users[cash], $maxsave-$users[savings]);
	if ($deposit > $users[cash])
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "Sorry, but your coffers don't contain enough gold to make a deposit that large.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("You don't have that much money!");
		}
	if ($deposit < 0)
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "How could it be possible to deposit " . $borrow . " gold pieces?";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("You cannot deposit a negative amount of money!");
		}
	if ($deposit + $users[savings] > $maxsave)
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "Sorry, but it is just too impractical to make a saving so abundantly large.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("Cannot have that much in savings!");
		}
	$users[cash] -= $deposit;
	$users[savings] += $deposit;
	saveUserData($users, "networth cash savings");
} 
if ($do_withdraw) {
	fixInputNum($withdraw);
	$withdraw = invfactor($withdraw);
	if(!empty($_POST['withdraw_max']))
		$withdraw = $users[savings];
	if ($withdraw > $users[savings])
	{
		$tpl->assign('authstr', $authstr);
		$tpl->assign('borrow', commas($borrow));
		$tpl->assign('repay', commas($repay));
		$tpl->assign('deposit', commas($deposit));
		$tpl->assign('withdraw', commas($withdraw));
		$tpl->assign('savrate',$savrate);
		$tpl->assign('maxsave',commas($maxsave));
		$tpl->assign('savings',commas($users[savings]));
		$tpl->assign('loanrate',$loanrate);
		$tpl->assign('maxloan',commas($maxloan));
		$tpl->assign('loan',commas($users[loan]));
		// Load the game graphical user interface
initGUI();
		$error = "You do not have that much gold in your savings account.";
		$tpl->assign("err", $error);
		$tpl->display('bank.tpl');
		endScript("");
//		endScript("You don't have that much in your savings account!");
		}
	$users[cash] += $withdraw;
	$users[savings] -= $withdraw;
	saveUserData($users, "networth cash savings");
} 

$tpl->assign('do_borrow', $do_borrow);
$tpl->assign('do_repay', $do_repay);
$tpl->assign('do_deposit', $do_deposit);
$tpl->assign('do_withdraw', $do_withdraw);
$tpl->assign('authstr', $authstr);
$tpl->assign('borrow', commas($borrow));
$tpl->assign('repay', commas($repay));
$tpl->assign('deposit', commas($deposit));
$tpl->assign('withdraw', commas($withdraw));
$tpl->assign('savrate',$savrate);
$tpl->assign('maxsave',commas($maxsave));
$tpl->assign('savings',commas($users[savings]));
$tpl->assign('loanrate',$loanrate);
$tpl->assign('maxloan',commas($maxloan));
$tpl->assign('loan',commas($users[loan]));
if ($users[turnsused] < $config[protection])
        $tpl->assign('protectnotice', $protectnotice=1);
        


// Load the game graphical user interface
initGUI();
$tpl->display('actions/income/treasury.tpl');
endScript("");
?>
