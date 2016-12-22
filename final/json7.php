<?php 
session_start();
date_default_timezone_set("Asia/Taipei");
require "dbconnect.php";
$userID = $_SESSION['uID'];
$orderNumber = $_POST["orderNumber"];
$productName =$_POST["productName"];
$sql2 = "select sum(money) from store where userID = '$userID'";//持有總金額
$result = mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result);
$summoney=$row['sum(money)'];
$sql3 = "select nowPrice from rowmaterial where  rowMaterialName = '$productName'";//現在元瞭價格
$price = mysqli_query($conn,$sql3);
$pricerow=mysqli_fetch_assoc($price);
$nowPrice=$pricerow['nowPrice'];
if($summoney - ($nowPrice * $orderNumber) > 0)
{
    echo "OK";
}
else
{
    echo "NO";
}
?>