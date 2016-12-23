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
<div style="position:absolute;width:500px;height:200px;top:225px;right:320px" ><font color="ivory">
<h1>Register Form</h1>
<form method="post" action="controller.php">
    <input type="hidden" name="act" value="register">
    User Name: <input type="text" name="id" ,id = "id"><br />
    Password : <input type="password" name="pwd",id = "pwd"><br />
    Password確認 : <input type="password" name="pwd2",id = "pwd2"><br />
    <input type="submit" name="Submit" value="註冊" />
</form>
</div>
</body></html>

