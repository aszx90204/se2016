<?php
session_start();
//set the login mark to empty
$_SESSION['uID'] = "";
?>
<h1>Login Form</h1><hr />
<form method="post" action="controller.php">
<input type="hidden" name="act" value="login">
User Name: <input type="text" name="id"><br />
Password : <input type="password" name="pwd"><br />
<input type="submit">&nbsp;
</form>
<a href="regisertForm.php"><input type="submit" name ="register" id = "register" value = "註冊" ></a>