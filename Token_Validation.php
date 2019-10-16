<?php
session_start();
//check user login status
if (!isset ($_SESSION['LoginState'])){
    ob_start();
    header('Location: /login.html');
    ob_end_flush();
    die();
}
//getting user session id saved in cookie
$cookie = $_COOKIE['Name'];
//getting CSRF token user submit
$received_token = $_POST['MyToken'];
//formatting user submitted CSRF token for comparisson
$final_token = str_replace('"',"",$received_token);

//open token file using user session id and extract data from the file
$token_file = fopen(getcwd().'\tokens\\'.$cookie.".txt", "r") or die ("Invalid Token !!!");
$token = fread($token_file, filesize(getcwd().'\tokens\\'.$cookie.".txt"));
fclose($token_file);
//compare user submitted CSRF token with Server Generated original CSRF token
if ($token == $final_token){
  $_SESSION['status'] = "Details submitted!!! ";
  setcookie("Details",$_POST['u_name'].",".$_POST['p_number']);
}else{
  $_SESSION['status'] = "Invalid Token!!!";
  setcookie("Details","".","."");
}
header('Location: /Data_Receiving_End_Point.php');
?>
