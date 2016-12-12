<?php
session_start();
//set the login mark to empty
$_SESSION['uID'] = "";
require("dbconnect.php");
?>
<h1>Register Form</h1><hr />
<form method="post" action="controller.php">
    <input type="hidden" name="act" value="register">
    User Name: <input type="text" name="id" ,id = "id"><br />
    Password : <input type="password" name="pwd",id = "pwd"><br />
    Password確認 : <input type="password" name="pwd2",id = "pwd2"><br />
    <input type="submit" name="Submit" value="註冊" />
</form>


