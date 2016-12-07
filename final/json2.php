<?php 
date_default_timezone_set("Asia/Taipei");
require "dbconnect.php";
$orderNumber = $_POST["orderNumber"];
$storeID = $_POST["storeID"];
$productID =$_POST["productID"];
$nowSum =$_POST["productSum"];
switch($productID)
{
    case 1 :
        $sql="update store set productSum1 = $orderNumber+$nowSum where store.storeID=$storeID";
        break;
    case 2:
        $sql="update store set productSum2 = $orderNumber+$nowSum where store.storeID=$storeID";
        break;
    case 3 :
        $sql="update store set productSum3 = $orderNumber+$nowSum where store.storeID=$storeID";
        break;
    default:
}
//$sql="update store set productorder2 = $orderNumber where store.storeID=$storeID";
$res=mysqli_query($conn,$sql) or die("db error");
echo $orderNumber+$nowSum; //newD;
?>
