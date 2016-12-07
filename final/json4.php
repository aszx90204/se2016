<?php 
date_default_timezone_set("Asia/Taipei");
require "dbconnect.php";
$orderNumber = $_POST["orderNumber"];
$storeID = $_POST["storeID"];
$productID =$_POST["productID"];
//$nowSum =$_POST["productSum"];
switch($productID)
{
    case 1 :
        $sql="select productStock,productName from headerquarter where headerquarter.productName =(select productName1 from store where store.storeID = $storeID)";
        break;
    case 2:
        $sql="select productStock,productName from headerquarter where headerquarter.productName =(select productName2 from store where store.storeID = $storeID)";
        break;
    case 3 :
        $sql="select productStock,productName from headerquarter where headerquarter.productName =(select productName3 from store where store.storeID = $storeID)";
        break;
    default:
}
//$sql="update store set productorder2 = $orderNumber where store.storeID=$storeID";
$res=mysqli_query($conn,$sql) or die("db error");
$row=mysqli_fetch_assoc($res);
if($row['productStock'] >= $orderNumber)
{
    //$productStock =  $row['productStock'];
    $productName = $row['productName'];
    $sql2 = "update headerquarter set productStock = productStock-$orderNumber where productName = '$productName'";
    mysqli_query($conn,$sql2) or die("db error");
    echo"訂購成功";
}
else
{
    echo"總店庫存不夠,請等總店訂購";
}
?>