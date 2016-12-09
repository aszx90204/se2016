<?php 
require "dbconnect.php";
header('Content-Type: application/json');
session_start();
$userID = $_SESSION['uID'];
$productID=(int)$_POST["productID"];
$storeID = $_POST["storeID"];
$productSum = $_POST["productSum"];
$randomNumber = $_POST["randomNumber"];
$productName = $_POST["productName"];
$sql2 = "select price from product where product.productName = '$productName'";
$result = mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result);
$price=$row['price'];
//money = money +($price * $randomNumber)
switch($productID)
{
    case 1 :
        $sql="update store set productSum1 = $productSum,money = money +($price * $randomNumber) where store.storeID=$storeID and userID = '$userID'";
        break;
    case 2:
        $sql="update store set productSum2 = $productSum,money = money +($price * $randomNumber) where store.storeID=$storeID and userID = '$userID'";
        break;
    case 3 :
        $sql="update store set productSum3 = $productSum,money = money +($price * $randomNumber) where store.storeID=$storeID and userID = '$userID'";
        break;
    default:
}
$sql3 = "select sum(money) from store where userID = '$userID'";
$result = mysqli_query($conn,$sql3);
$row=mysqli_fetch_assoc($result);
$res=mysqli_query($conn,$sql) or die("db error");
$summoney=$row['sum(money)'];
//echo $sql; //newD;
echo $summoney;
//echo json_encode(array('money' => "$money"));
?>