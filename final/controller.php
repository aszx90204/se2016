<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>
<style>
    body{
        margin:0;
        background:#6EA404;
        text-align:center;
    }
    p{
        font-family:'Chewy', cursive;
        color:#6EA404;
        margin:0;
    }
    .cuerpo{
        width:500px;
        background:#FFF;
        -webkit-border-radius:15px;
        -moz-border-radius:15px;
        border-radius:15px;
        margin:20px auto;
        font-family:arial,sans-serif;
        -webkit-box-shadow:0px 3px 5px rgba(0, 0, 0, 0.5);
        -moz-box-shadow:0px 3px 5px rgba(0, 0, 0, 0.5);
        box-shadow:0px 3px 5px rgba(0, 0, 0, 0.5);
        padding:20px 5px;
    }
    span{
        font-family:'Chewy', cursive;
        color:#F8BA05;
        font-size:45px;
        text-shadow:0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000 , 0px 0px 3px #000;
    }
</style>
</head>
<body>
<img src="images/404.png" />
<div class="cuerpo">
    <p>Oopsssssss!!!!!</p>
    <span>Error:
<?php
session_start();
require("User.php");
require("find.php");
if(! isset($_POST["act"])) {
	exit(0);
}
//htmlspecialchars
$act =$_POST["act"];
switch($act) {
	case "orderProduct":
		$productOrder=$_POST['number'];
        $productID = $_POST['productID'];   
        $storeID = $_POST['storeID'];
		if ($productOrder) { 
                if (productOrder($productID,$productOrder,$storeID)) {
                    echo( "OK");
                    //header("Location: listMessage.php");
                } else {
                    echo( "insert failed.");
                }
            
		} else {
			echo "Message title cannot be empty";
		}
		break;
    case "register":   
        $userID= $_POST['id'];
        $password = $_POST['pwd'];
        $password2 = $_POST['pwd2'];
        if($password===$password2)
        {
            if(register($userID,$password))
            {
                echo( "OK");
                headerregister($userID);
                header("Location: loginForm.php");
            }
        }
        else
        {
            echo"( \"密碼不相等\")</br>";   
            echo "<a href='registerForm.php'>Try Again</a>";
        }
        break;
	case "login":
		$userID = $_POST['id'];
		$password = $_POST['pwd'];
		if (checkUser($userID, $password)) 
        {
			$_SESSION['uID'] = $userID;
            header("Location: factory.php");
        }
        else
        {
			$_SESSION['uID'] = "";
			echo "Login failed.<br>";
			echo "<a href='loginForm.php'>login</a>";
		}
	default:
}
?>
</span>
</div>
</body>
</html>