<?php 
/*require "dbconnect.php";
$i=(int)$_POST["id"];
$newD = date("Y-m-d H:i:s",strtotime("430 minutes"));
$sql="update game set expire ='$newD' where id=$i";
$res=mysqli_query($db,$sql) or die("db error");
echo $sql; //newD;*/
?>
<?php 
date_default_timezone_set("Asia/Taipei")
require "dbconnect.php";
$storeID =$_POST["storeID"];
$product =$_POST["product"];//第幾個產品
$ran=$_POST["ran"];
switch($product)
{
    case 1 :
        $sql="update store set productSum1 =productSum1-$ran where store.storeID=$storeID";
        break;
    case 2 :
        $sql="update store set productSum2 =productSum2-$ran where store.storeID=$storeID";
        break;
    case 3 :
        $sql="update store set productSum1 =productSum3-$ran where store.storeID=$storeID";
        break;
    default:
}
$res=mysqli_query($conn,$sql) or die("db error");
echo $sql; //newD;
?>
