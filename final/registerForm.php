<?php
session_start();
//set the login mark to empty
$_SESSION['uID'] = "";
require("dbconnect.php");
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    html {
        height: 150%;
    }
    body {
        background-image: url(images/621402342.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: 50% 50%; 
        background-size: 1350px 650px;
        overflow-y:hidden; 
    }
</style >
</head>
<body>
<div style="position:absolute;width:500px;height:200px;top:225px;right:350px" ><font color="ivory">
<h1>Register Form</h1>
<form method="post" action="controller.php">
    <input type="hidden" name="act" value="register">
	<table height="125px">
    <tr><td><font color="ivory">User Name: </td><td><input type="text" name="id" ,id = "id"></td></tr>
    <tr><td><font color="ivory">Password : </td><td><input type="password" name="pwd",id = "pwd"></td></tr>
    <tr><td><font color="ivory">Password確認 : </td><td><input type="password" name="pwd2",id = "pwd2"></td></tr>
    <tr><td><input type="submit" name="Submit" value="註冊" /></td></tr>
	</table>
</form>
</div>
</body></html>

