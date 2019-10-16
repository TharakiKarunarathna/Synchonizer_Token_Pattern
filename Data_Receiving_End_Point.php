<?php
session_start();
//check user login status
if (!isset ($_SESSION['LoginState'])){
    ob_start();
    header('Location: /login.html');
    ob_end_flush();
    die();
}

//extracting user data from cookie
if(isset($_COOKIE["Details"])){
    $pieces = explode(",", $_COOKIE["Details"]);
    $username = $pieces[0];
    $telnumber = $pieces[1];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Required CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Data End-Point</title>
  </head>

  <body>
    <label><?php echo $_SESSION['status']; ?></label>
    <label><br>Name : <?php echo $username ?></label>
    <label><br><br>Tel-Number : <?php echo $telnumber ?></label>
  </body>
</html>
