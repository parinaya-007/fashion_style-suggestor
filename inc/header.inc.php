<?php

$db=mysqli_connect("localhost","root","","fashion_style") or die("Couldnt connect to database");

session_start();
if(!isset($_SESSION['user_log']))
{
	$user="";
	//$error1="";
}
else
{
	$user= $_SESSION['user_log'];
	//$error1= $_SESSION['error1'];

	//header("Location: home.php");
}

//session_start();
if(!isset($_SESSION['error']))
{
	//$user="";
	$error1="";
}
else
{
	//$user= $_SESSION['user_log'];
	$error1= $_SESSION['error1'];

	//header("Location: home.php");
}

?>
<html lang="en">
  <head>
  <script src="js/main.js" type="text/javascript"></script>
  </head>
</html>
