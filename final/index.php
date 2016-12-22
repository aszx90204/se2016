<?php
session_start();
require("dbconnect.php");
if (! isset($_SESSION["uID"]))
	$_SESSION["uID"] = "";
//echo $_SESSION["uID"];
if ( $_SESSION["uID"] < " ") {
	//header("Location: login.php");
    header("Location: loginForm.php");
}
?>
