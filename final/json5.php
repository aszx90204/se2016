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
$sql4 = "SELECT count(*) from store where userID = '$userID'";//店鋪個數
$storeNum = mysqli_query($conn,$sql4);
$storerow=mysqli_fetch_assoc($storeNum);
$storeNumber=$storerow['count(*)'];  $money = (int)(($summoney - ($nowPrice*$orderNumber))/$storeNumber);
$sql5 = "update store set money = $money where store.userID ='$userID'";//把錢平均分攤
mysqli_query($conn,$sql5);
$x = rand(2,6);
$newD = date("Y-m-d H:i:s",strtotime("$x minutes"));
$sql = "update headerquarter set orderNumber = $orderNumber ,expire ='$newD' where productName = '$productName' and userID ='$userID'";
$res=mysqli_query($conn,$sql) or die("db error");
$json = array(
    "expire" => $newD,
    "money" => ($money*$storeNumber),
    "orderNumber" => $orderNumber
);
echo json_encode($json);//newD;
?>