<?php
require("dbconnect.php");
function showStore($userID) {
	global $conn;
    $sql = "select name,storeID from store where userID = '$userID'";
	return mysqli_query($conn,$sql);
}
function showStoreNumber($userID) {
	global $conn;
    $sql = "select count(*) from store where userID = '$userID'";
	return mysqli_query($conn,$sql);
}
function register($userID,$password)
{
    global $conn;
    $sql = "insert into user(userID,password)values('$userID','$password')";
    return (mysqli_query($conn,$sql) or die("使用者名稱重複")) ;
}
function headerregister($userID)
{
    global $conn;
    date_default_timezone_set("Asia/Taipei");
    $newD = date("Y-m-d H:i:s");
    for($i = 1; $i<=3;$i++)
    {
        switch($i)
        {
            case 1 :
                $sql ="insert into headerquarter(productName,productStock,userID,expire,orderNumber)values('brade',0,'$userID','$newD',0)";
                mysqli_query($conn,$sql); 
                break;
            case 2 :
                $sql ="insert into headerquarter(productName,productStock,userID,expire,orderNumber)values('chocolate',0,'$userID','$newD',0)";
                mysqli_query($conn,$sql); 
                break;
            case 3 :
                $sql ="insert into headerquarter(productName,productStock,userID,expire,orderNumber)values('toast',0,'$userID','$newD',0)";
                mysqli_query($conn,$sql); 
                break;
            default:
        }     
    }
    return true;
}
function factorymoney($userID)
{
    global $conn;
    $sql= "select sum(money) from store where userID = '$userID'";
    $result = mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $summoney=$row['sum(money)'];
    return $summoney;
}
function check_input($value)
{
// 去除斜杠
    if (get_magic_quotes_gpc())
    {
        $value = stripslashes($value);
    }
    // 如果不是数字则加引号
    if (!is_numeric($value))
    {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}

?>