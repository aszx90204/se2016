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
	/*case "delete":
		$msgID=(int)$_POST['id'];
		if (delMsg($msgID)) {
			echo "Message:$msgID deleted.";
		} else {
			echo "Error deleting message";
		}
		break;*/
    /*case "update":
        $messageID=(int)$_POST['messageID'];
        $msg = $_POST['msg'];
        $authorID=$_POST['authorID'];
        $receiver = $_POST['receiver'];
        if(updateMsg($messageID,$msg))
        {
            echo( "OK");
        }
        else
        {
            echo("update not OK");
            //echo"<a href=listMessage.php>listMessage</a>";
        }
        break;*/
    /*case "updateProfile":
    {
        $loginID= $_SESSION['uID'];
        $Name = $_POST['Name'];
        $iswork = $_POST['iswork'];
        $skill = $_POST['skill'];
        $salary= $_POST['salary'];
        $employee= $_POST['employee'];
        $birthday= $_POST['birthday'];
        if(updateProfile($loginID,$Name,$iswork,$skill,$salary,$employee,$birthday))
        {
            echo( "OK");
            //header("Location: listMessage.php");
        }
        else
        {
            echo( "update profile not OK");
        }
        break;
    }*/
    /*case "register":   
        $loginID= $_POST['id'];
        $password = $_POST['pwd'];
        $Name = $_POST['Name'];
        $iswork = $_POST['iswork'];
        $skill = $_POST['skill'];
        (int)$salary= $_POST['salary'];
        $employee= $_POST['employee'];
        $password2 = $_POST['pwd2'];
        if(register($loginID,$password,$Name,$iswork,$skill,$salary,$employee) && $password==$password2)
        {
            echo( "OK");
        }
        else
        {
            echo( "register not ok</br>");
            if($password != $password2)
            {
                echo( "密碼不相等");
            }
            
        }
        break;*/
	case "login":
		$userID = $_POST['id'];
		$password = $_POST['pwd'];
		if (checkUser($userID, $password)) 
        {
			//set login session mark
			$_SESSION['uID'] = $userID;
			//echo "login OK<br>";
			//echo "<a href='./'>guest Book Home</a>";
            header("Location: factory.php");
        }
        else
        {
			//set login mark to empty
			$_SESSION['uID'] = "";
			echo "Login failed.<br>";
			echo "<a href='loginForm.php'>login</a>";
		}
	default:
}
?>