<?php 
date_default_timezone_set("Asia/Taipei");
require "dbconnect.php";
$orderNumber = $_POST["orderNumber"];
$productName =$_POST["productName"];
$productStock = $_POST["productStock"];
/*$sql2 = "select orderNumber from headerquarter where productName ='$productName'";
$result = mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result);
$orderNumber = $row['orderNumber'];
/*$sql = "select productStock from headerquarter where productName = '$productName'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$productStock = $row['productStock'];*/
//$stockSum  = $productStock+$orderNumber;
$sql = "update headerquarter set orderNumber = 0,productStock = $productStock+$orderNumber where productName ='$productName'";
$res=mysqli_query($conn,$sql) or die("db error");
echo ($productStock+$orderNumber);//newD;
?>