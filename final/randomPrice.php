<?php 
require "dbconnect.php";
header('Content-Type: application/json');
$productName = $_POST["productName"];
$sql = "select lowPrice,highPrice from rowmaterial where rowMaterialName = '$productName'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$lowPrice=$row['lowPrice'];
$highPrice=$row['highPrice'];
$price = rand($lowPrice,$highPrice);
$sql2 = "update product set price = $price+10 where productName = '$productName'";
//echo $sql; //newD;
mysqli_query($conn,$sql2)or die("db error");
echo $price+10;