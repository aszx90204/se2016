<?php 
date_default_timezone_set("Asia/Taipei");
require "dbconnect.php";
$orderNumber = $_POST["orderNumber"];
$productName =$_POST["productName"];
/*$sql = "select productStock from headerquarter where productName = '$productName'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$productStock = $row['productStock'];*/
$x = rand(2,6);
$newD = date("Y-m-d H:i:s",strtotime("1 minutes"));
$sql = "update headerquarter set orderNumber = $orderNumber ,expire ='$newD' where productName = '$productName'";
$res=mysqli_query($conn,$sql) or die("db error");
/*$array = mysql_fetch_row($res);
echo json_encode($array); */
$json = array(
    "expire" => $newD,
    "orderNumber" => $orderNumber
);
echo json_encode($json);//newD;
?>