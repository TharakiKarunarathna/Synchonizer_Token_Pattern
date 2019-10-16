<?php
//session creation
session_start();
//set session variable for check user loging status
$_SESSION['LoginState'] = 'SET';

//setting a cookie for current session
$sessionID = session_id();
$expiry = time()+60*60*24;
setcookie('Name', $sessionID, $expiry, '', '', '', TRUE);

//CSRF Token generating process
$CSRF_TOKEN = hash('sha256', $sessionID.rand(1000,10000));

//storing CSRF Token locally
$filename = getcwd().'\tokens\\'.$sessionID.".txt";
$TokenFile = fopen($filename, "w") or die("Unable to Create Token");
fwrite($TokenFile, $CSRF_TOKEN);
fclose($TokenFile);
header('Location: /Home.php');
?>
