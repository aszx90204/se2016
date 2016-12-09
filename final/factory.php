<?php
require("dbconnect.php");
require ("find.php");
session_start();
$userID = $_SESSION['uID'];
$result =showStore($userID); 
date_default_timezone_set("Asia/Taipei");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<title>總店</title>
<style type="text/css">
</style>
<script language="javascript">

function orderStock(productID) { ///************使用者*******
	now= new Date(); //get the current time
	tday=new Date(myArray[productID]['expire']);
	console.log(now, tday);
	if (tday <= now ) {
		//alert('exploded');
		//use jQuery ajax to reset timer
        var number = parseInt(prompt("訂購多少","0"));     
		$.ajax({
			url: "json5.php",
			dataType:'json',
			type: 'POST',
			data: {
                orderNumber : number,
                productName : myArray[productID]['productName']}, //optional, you can send field1=10, field2='abc' to URL by this
			error: function(response) { //the call back function when ajax call fails
				alert('Ajax request failed!');
			},
			success: function(data) { //the call back function when ajax call succeed
				//alert("Bomb" + bombID + ": " + txt);
                //myArray[productID]['orderNumber'] = data['ordernumber'];
                myArray[productID]['expire'] = data.expire;
                myArray[productID]['orderNumber'] = data.orderNumber;   
			}
		});	
	} else {
		alert("counting down, be patient.")
	}
}
function checkStock()
{
    for(var i =0;i<myArray.length;i++)
    {
        //var productStock = myArray[i]['productStock'];
        $("#productStock"+i).html(productStock);
    }
}
function checkMoney()//已改
{
    for(var i = 0;i< storeArray.length;i++)
    {
        for( var j =1;j<=3;j++)
        {
            var x = (Math.floor(Math.random()*4));
            switch(j)
            {
                case 1:
                    nowSum = storeArray[i]['productSum1'] - x;
                    storeArray[i]['productSum1']=nowSum;
                    productName = storeArray[i]['productName1'];
                    break;
                case 2:
                    nowSum = storeArray[i]['productSum2'] - x;
                    storeArray[i]['productSum2']=nowSum;     
                    productName = storeArray[i]['productName2'];
                    break;
                case 3:
                    nowSum = storeArray[i]['productSum3'] - x;
                    storeArray[i]['productSum3']=nowSum;     
                    productName = storeArray[i]['productName3'];
                    break;      
                default:
            }
            if(nowSum<0)
            {
                nowSum = 0;
                //alert("分店"+storeArray[i]['storeID']+"的商品:"+productName+"已售罄,請調貨");
            }
            if(nowSum!=0 && x !=0)
            {
                $.ajax({
                    url: "headerMoney.php",
                    dataType: 'html',
                    type: 'POST',
                    async: false,
                    data: { 
                            productID : j,
                            storeID : storeArray[i]['storeID'],//myArray[0]['storeID'],
                            productSum : nowSum,
                            randomNumber : x,
                            productName : productName
                            //productorder : productorder,
                    }, //optional, you can send field1=10, field2='abc' to URL by this
                    error: function(response) { //the call back function when ajax call fails
                        alert('Ajax request failed!');
                    },
                    success: function(txt) { //the call back function when ajax call succeed
                        //alert("Bomb" + bombID + ": " + txt);
                        //alert(txt);
                        $("#moneySum").html(txt);                       
                    }
                });  
            }
        }
    }
}
function productArrive() {
	now= new Date(); //get the current time
	for (i=0; i < myArray.length;i++) {	
		tday=new Date(myArray[i]['expire']); //convert the date string into date object in javascript
		if (tday <= now) { 
            if(myArray[i]['orderNumber'] != 0)
            {
                $.ajax({
                    url: "json6.php",
                    dataType: 'html',
                    type: 'POST',
                    async: false,
                    //timeout: 500,
                    data: {
                        productStock : myArray[i]['productStock'],
                        orderNumber : myArray[i]['orderNumber'],
                        productName : myArray[i]['productName']}, //optional, you can send field1=10, field2='abc' to URL by this
                    error: function(response) { //the call back function when ajax call fails
                        alert('Ajax request failed!');
                    },
                    success: function(txt) { //the call back function when ajax call succeed
                        //alert(txt);
                        myArray[i]['productStock'] = txt;
                        myArray[i]['orderNumber'] = 0 ;
                        $("#try1").html(txt);
                        location.reload(true);

                    }
                });
                $("#timer"+i).html("");
            }
            else //(tday <= now && myArray[i]['orderNumber'] == 0)
            {
                $("#timer"+i).html("");
            } 
        }
        else 
        {
			//set the bomb image  and calculate count down
			$("#timer"+i).html(Math.floor((tday-now)/1000))	        
		}
	}
}
window.onload = function () {
	//check the bomb status every 1 second
    setInterval(function () {
		//checkBomb()　
        //check();
        productArrive();
    }, 1000);
    setInterval(function () {
		//checkBomb()　
        //check();
        checkMoney();
    }, 1000);
};
</script>
</head>
<body>
<?php
echo "<div id='k1'>0</div><br />";
echo "<div id='try1'>0</div><br />";
?>
<?php
    $sql2="select * from store where userID = '$userID'";//已改
    $storeres=mysqli_query($conn,$sql2) or die("db error");
    $storeArr = array(); //define an array for bombs
    while($roow=mysqli_fetch_assoc($storeres)) {
        $storeArr[] = $roow;
    }//store the row into the array    
?>
<?php
    $sql4="select sum(money) from store where userID = '$userID'";
    $storemoney=mysqli_query($conn,$sql4) or die("db error");//define an array for bombs
    $money=mysqli_fetch_assoc($storemoney);
        //store the row into the array    
?>
<TABLE BGCOLOR=yellow  BORDER CELLPADDING="8"
       CELLSPACING="4" COLS="3">
<?php
if ($result) {  
	while (	$rs=mysqli_fetch_assoc($result)) {
		//echo "<td>" . $rs['name'] . "</td>";
        echo"<td><a href='store.php?storeID={$rs['storeID']}'>".$rs['name']."</a></td>";   
	}
} else {
	echo "<tr><td>No data found!<td></tr>";
}
?>
</TABLE>
<!--*******************************************-->
<TABLE BGCOLOR=yellow  BORDER CELLPADDING="8"
       CELLSPACING="4" COLS="3">
<?php
$i=0; //counter for products
$sql="select * from headerquarter where userID = '$userID'"; //已改
$res=mysqli_query($conn,$sql) or die("db error");
$arr = array(); //define an array for bombs
while($row=mysqli_fetch_assoc($res)) {
	$arr[] = $row; //store the row into the array	
    $productName = $row['productName'];       
    /*echo "<tr><td><img src='images/$productName.png' id='product$i' onclick='orderStock($i)'></td>";
    echo "<td><div id='timer$i'>0</div></td>";
    echo "<td><div id='ProductStock$i'>".$row['productStock']."</div></td></tr>";*/
    echo "<tr><td><button onclick='orderStock($i)'\"><img src= 'images/$productName.png' id='product$i'></button><div ></div></td><br />";
    echo "<td><div id='timer$i'></div></td>";
    echo "<td><div id='ProductStock$i'>".$row['productStock']."</div></td></tr>";
    $i++; //increase counter
}
echo "<tr><td><img src= 'images/money.jpg' ></td><br />";
echo"<td><p id ='moneySum' >".$money['sum(money)']."</p></td></tr>";
?>
</TABLE>

<script>
<?php
	//print the bomb array to the web page as a javascript object
	echo "var myArray=" . json_encode($arr);
?>
</script>
<script>
<?php
	//print the bomb array to the web page as a javascript object
	echo "var storeArray=" . json_encode($storeArr);
?>
</script>
</body>
</html>

