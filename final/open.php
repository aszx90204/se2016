<?php
require("dbconnect.php");
require ("find.php");
session_start();
$userID = $_SESSION['uID'];
$product = $_POST ['product'];
$name = mysql_real_escape_string($_POST ['Name']);
$showStoreNumber = showStoreNumber($userID);
$storeRow =  mysqli_fetch_assoc($showStoreNumber);
$storeNum = $storeRow['count(*)'];
if($storeNum>0)
{
    $openMoney = (5000*pow(2,$storeNum));//開店所需金額
    $x = rand(150,300);
    $y = rand(150,300);
    $z = rand(150,300);
    $sql = "insert into store(name,productName1,productName2,productName3,productLimit1,productLimit2,productLimit3,productSum1,productSum2,productSum3,userID,money)values('$name','$product[0]','$product[1]','$product[2]',$x,$y,$z,0,0,0,'$userID',0)";
    mysqli_query($conn,$sql) or die ("db error");//新店資訊
    $sql2 = "select sum(money) from store where userID = '$userID'";//持有總金額
    $result = mysqli_query($conn,$sql2);
    $row=mysqli_fetch_assoc($result);
    $summoney=$row['sum(money)'];
    $money = (int)(($summoney - $openMoney)/$storeNum);
    $sql5 = "update store set money = $money where store.userID ='$userID'";//把錢平均分攤
    mysqli_query($conn,$sql5);
}
else
{
    $openMoney = 0;
    $x = rand(100,200);
    $y = rand(100,200);
    $z = rand(100,200);
    $sql = "insert into store(name,productName1,productName2,productName3,productLimit1,productLimit2,productLimit3,productSum1,productSum2,productSum3,userID,money)values('$name','$product[0]','$product[1]','$product[2]',$x,$y,$z,0,0,0,'$userID',5000)";
    mysqli_query($conn,$sql) or die ("db error");//新店資訊
    
}
header("Location: factory.php");
?>