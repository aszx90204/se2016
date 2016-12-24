<?php
require("dbconnect.php");
require ("find.php");
session_start();
$userID = $_SESSION['uID'];
$factorymoney = factorymoney($userID);
$result =showStore($userID); 
$showStoreNumber = showStoreNumber($userID);
$storeRow =  mysqli_fetch_assoc($showStoreNumber);
$storeNum = $storeRow['count(*)'];
date_default_timezone_set("Asia/Taipei");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<title>總店</title>
		<link rel="stylesheet" type="text/css" media="screen" href="http://www.gifmania.tw/rec/css/styles.css" />
		<style type="text/css">
			body {
				background-color:#AADFFF;
				background-image:url('http://www.gifmania.tw/rec/img/fondo_body.png');
			}
			#background1 {
				background-image:url(images/b1.png);
			}
			#background2 {
				background-image:url(images/b2.png);
			}
			#background3 {
				background-image:url(images/b3.png);
			}
			#background4 {
				background-image:url(images/b4.png);
			}
            .shief{
                background-color:#8D9FB3;
                width:100%;
                height:225px;
                text-align:center;
                
            }
			a {
	            color:#800000;
				font-weight:bold;
            }
		</style>
		
<script language="javascript">
var mymoney= <?php echo $factorymoney ?> ;
function orderStock(productID) { ///************使用者*******
    var msg ; 
	now= new Date(); //get the current time
	tday=new Date(myArray[productID]['expire']);
	console.log(now, tday);
	if (tday <= now ) {
		//alert('exploded');
		//use jQuery ajax to reset timer
        var number = parseInt(prompt("訂購多少","0"));   
        if(number>0)
        {
            $.ajax({
                url: "json7.php",
                dataType:'html',
                type: 'POST',
                async: false,
                data: {
                    orderNumber : number,
                    productName : myArray[productID]['productName']}, //optional, you can send field1=10, field2='abc' to URL by this
                error: function(response) { //the call back function when ajax call fails
                    alert('Ajax request failed!');
                },
                success: function(txt) { //the call back function when ajax call succeed    
                    msg = txt;
                }
            });
            if(msg =="OK")
            {
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
                        myArray[productID]['expire'] = data.expire;
                        myArray[productID]['orderNumber'] = data.orderNumber; 
                        $("#moneySum").html(data.money);      
                    }
                });       
            }
            else
            {
                alert("錢不夠QQ");
            }
        }
        else
        {
            alert("輸入正整數");
        }
    } 
    else
    {
        alert("商品即將抵達");
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
                        $("#moneySum").html(txt);    
                        mymoney = txt;
                    }
                });  
            }
        }
    }
}
function rowMaterialPrice()
{
    for(var i = 0 ;i<myArray.length;i++)
    {

        var productName = myArray[i]['productName'];
        $.ajax({
            url: "rowMaterialPrice.php",
            dataType: 'html',
            async: false,
            type: 'POST',
            data: { 
                productName : productName                               
            }, //optional, you can send field1=10, field2='abc' to URL by this
            error: function(response) { //the call back function when ajax call fails
                alert('Ajax request failed!');
            },
            success: function(txt) { //the call back function when ajax call succeed                         
                //alert(productName+":"+txt);      
                $("#rowMaterialPrice"+i).html(txt);
            }
        });   
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
function open()
{
    if(<?php echo $storeNum ?> == 0)
    {
        var openCost = 0;
    }
    else{
        var openCost = (5000*(Math.pow(2,<?php echo $storeNum-1 ?>)));   
    }
    if(mymoney<openCost)
    {
        alert("開店資金不夠需要"+openCost+"元");
        return false;
    }
    else
    {
        if(confirm("開店需要"+openCost+"元,確定要開新店嗎?"))
        {
            window.location = 'openStore.php';
        }
        else
        {
            return false;
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
    setInterval(function () {
		//checkBomb()　
        //check();
        rowMaterialPrice();
    }, 10000);
};
</script>
</head>
<body onload = "rowMaterialPrice()"  onunload="if(event.clientY<0) document.location=document.location.href"  oncontextmenu="return false">
		<div id="background">
			<div id="background1"></div>
			<div id="background2"></div>
			<div id="background3"></div>
			<div id="background4"></div>
		</div>
        <div class ="shief">
            <a href = "loginForm.php"><img src = "images/shief.gif"  title="登出"></a>
        </div>
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
<TABLE CELLPADDING="4" align="center" CELLSPACING="4" COLS="3">
<?php
if ($result) {  
	while (	$rs=mysqli_fetch_assoc($result)) {
		//echo "<td>" . $rs['name'] . "</td>";
        echo"<td><a href='store.php?storeID={$rs['storeID']}'><img src = 'images/store.png' title = '進入分店'><br \> <p align='center'>".$rs['name']."</p></a></td>";   
	}
    echo"<td><A href='javascript:open()'>開新店！！！！</A></td>";
} else {
	echo "<tr><td>No data found!<td></tr>";
}
?>
</TABLE>
<!--*******************************************-->
<div id ="productTable">
<table align=center width=60%   bgcolor="#DAA569" border="inset" style = "margin: 0px auto 100px;">
      <!-- CELLSPACING="4" COLS="3" BORDER CELLPADDING="0">-->
    <tr>
        <td></td>
        <td align='center'><img src= 'images/clock.gif'></td>
        <td align='center'><img src= 'images/money.png'></td>
        <td align='center'><img src= 'images/bread_pretzel_resized.png'></td>
    </tr>
<?php
$i=0; //counter for products
$sql="select * from headerquarter where userID = '$userID'"; //已改
$res=mysqli_query($conn,$sql) or die("db error");
$arr = array(); //define an array for bombs
while($row=mysqli_fetch_assoc($res)) {
	$arr[] = $row; //store the row into the array	
    $productName = $row['productName'];       
    echo "<tr><td align='center'><button onclick='orderStock($i)'  title='訂購' style='width:200px;height:100px;'><img src= 'images/$productName.png' id='product$i' style='max-height:100px;'></button></td><br />";
    echo "<td align='center'><div id='timer$i'></div></td>";
    echo "<td align='center'><div id='rowMaterialPrice$i'></div></td>";
    echo "<td align='center'><div id='ProductStock$i'>".$row['productStock']."</div></td></tr>";
    $i++; //increase counter
}
echo "<tr><td align='center'><img src= 'images/111.gif' ></td><br />";
echo"<td colspan='3' align='center'><p id ='moneySum' value ='2000'>".$money['sum(money)']."</p></td></tr>";
?>
</TABLE>
</div> 
<script>
<?php
	echo "var myArray=" . json_encode($arr);
?>
</script>
<script>
<?php
	echo "var storeArray=" . json_encode($storeArr);
?>
</script>
<!--<A href="javascript:open()">開新店！！！！</A>-->
</div>
</body>
</html>

