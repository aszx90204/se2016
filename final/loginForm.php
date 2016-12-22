<?php
session_start();
//set the login mark to empty
$_SESSION['uID'] = "";
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
</script>
<style type="text/css">
    html {
        height: 150%;
    }
    body {
        background-image: url(images/481078952.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: 50% 50%; 
        background-size: 1350px 650px;

    }
</style >


</head>

<body >
<div style="position:absolute;width:500px;height:200px;top:200px;right:400px" >
<form method="post" action="controller.php">
<h1 font color = "blue"><font color="ivory">Login Form</h1><hr />
<input type="hidden" name="act" value="login">
User Name: <input type="text" name="id"><br />
</br>
Password : <input type="password" name="pwd"><br />
</br>
<input type="submit">&nbsp;
<a href="registerForm.php"><input type="text" name ="register" id = "register" value = "註冊" ></a>
</form>
</div>
</body></html>