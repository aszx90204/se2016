<?php
    require("dbconnect.php");
    global $conn;
    session_start();
    $userID = $_SESSION['uID'];
    $storeID = $_GET['storeID'];
    $sql = "select * from store where store.storeID = $storeID ";  
    $result= mysqli_query($conn,$sql);
    $rs=mysqli_fetch_assoc($result);
    $productName1 = $rs["productName1"];
    $productName2 = $rs["productName2"];
    $productName3 = $rs["productName3"];
    $productSum1 = $rs["productSum1"];
    $productSum2 = $rs["productSum2"];
    $productSum3 = $rs["productSum3"];   
    $productLimit1 = $rs["productLimit1"];
    $productLimit2 = $rs["productLimit2"];
    $productLimit3 = $rs["productLimit3"];
    date_default_timezone_set("Asia/Taipei");

    $sql = "select * from headerquarter where userID = '$userID'";///******************************要加使用者  
    $result= mysqli_query($conn,$sql);
    $rs=mysqli_fetch_assoc($result);
 ?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">

function handleBomb(bombID) {
	now= new Date(); //get the current time
	tday=new Date(myArray[bombID]['expire'])
	console.log(now, tday)
	if (tday <= now) {
		//alert('exploded');
		//use jQuery ajax to reset timer
		$.ajax({
			url: "json.php",
			dataType: 'html',
			type: 'POST',
			data: { id: myArray[bombID]['id']}, //optional, you can send field1=10, field2='abc' to URL by this
			error: function(response) { //the call back function when ajax call fails
				alert('Ajax request failed!');
			},
			success: function(txt) { //the call back function when ajax call succeed
				//alert("Bomb" + bombID + ": " + txt);
                myArray[bombID]['expire'] = txt;
			}
		});
	
	} else {
		alert("counting down, be patient.")
	}
}

function checkBomb() {
	now= new Date(); //get the current time
	
	//check each bomb with a for loop
	//array length: number of items in the global array: myArray
	for (i=0; i < myArray.length;i++) {	
		tday=new Date(myArray[i]['expire']); //convert the date string into date object in javascript
		if (tday <= now) { 
			//expired, set the explode image and text
			$("#bomb" + i).attr('src',"images/explode.jpg");
			$("#timer"+i).html("exploded!")
             $("#k1").html("Dj");
		} else {
			//set the bomb image  and calculate count down
			$("#bomb" + i).attr('src',"images/bomb.jpg");
			//$("#timer"+i).html(Math.floor((tday-now)/1000))	;
            $("#timer"+i).html("hey")	
             $("#k1").html("Dj");
		}
	}
}
function randomPrice()
{
    for(var i = 1 ;i<=3;i++)
    {
        switch(i)
        {
            case 1:
                var productName = myArray[0]['productName1'];
                break;
            case 2:
                var productName = myArray[0]['productName2'];
                break;
            case 3:
                var productName = myArray[0]['productName3'];
                break;
            default:
        }
        $.ajax({
            url: "randomPrice.php",
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
                $("#productPrice"+i).html(txt);
            }
        });   
    }
}
function productSum()
{
	var i;
    $("#try1").html(5);
    $("#k1").html(2);
	//check each bomb with a for loop
	//array length: number of items in the global array: myArray
	for (i=1; i <=3;i++) 
    {	
        //$("#productSum"+i).html(myArray[0]['productSum1']-(Math.floor(Math.random()*4)));
        switch(i)
        {
            case 1 :
                var x = (Math.floor(Math.random()*4));
                nowSum1 = myArray[0]['productSum1'];
                nowSum1 = nowSum1 - x;
                if(nowSum1<0)
                    nowSum1 = 0;
                $("#productSum"+i).html(nowSum1);
                myArray[0]['productSum1']=nowSum1;
                if(nowSum1 !=0 && x !=0)
                {
                    $.ajax({
                        url: "json3.php",
                        dataType: 'html',
                        type: 'POST',
                        data: { 
                                productID : i,
                                storeID : myArray[0]['storeID'],//myArray[0]['storeID'],
                                productSum : nowSum1,
                                randomNumber : x,
                                productName : myArray[0]['productName1']
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
                break;
            case 2 :
                var x = (Math.floor(Math.random()*3));
                nowSum2 = myArray[0]['productSum2'];
                nowSum2 = nowSum2 - x;
                if(nowSum2<0)
                    nowSum2 = 0;
                $("#productSum"+i).html(nowSum2);
                myArray[0]['productSum2']=nowSum2;
                if(nowSum2 !=0 && x !=0)
                {
                    $.ajax({
                        url: "json3.php",
                        dataType: 'html',
                        type: 'POST',
                        data: { 
                                productID : i,
                                storeID : myArray[0]['storeID'],//myArray[0]['storeID'],
                                productSum : nowSum2,
                                randomNumber : x,
                                productName : myArray[0]['productName2']
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
                break;
            case 3 :
                var x = (Math.floor(Math.random()*5));
                nowSum3 = myArray[0]['productSum3'];
                nowSum3 = nowSum3 - x;
                if(nowSum3<0)
                    nowSum3 = 0;
                $("#productSum"+i).html(nowSum3);
                myArray[0]['productSum3']=nowSum3;
                if(nowSum3 != 0 && x !=0)
                {
                    $.ajax({
                        url: "json3.php",
                        dataType: 'html',
                        type: 'POST',
                        data: { 
                                productID : i,
                                storeID : myArray[0]['storeID'],//myArray[0]['storeID'],
                                productSum : nowSum3,
                                randomNumber : x,
                                productName : myArray[0]['productName3']
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
                break;
            default:
        }
	} 
}
function orderProduct(productID,storeID,number)
{
 	now= new Date(); //get the current time
    switch(productID)
    {
        case 1 :
            nowSum1 = myArray[0]['productSum1'];
            $.ajax({
                url: "json2.php",
                dataType: 'html',
                type: 'POST',
                data: { 
                    orderNumber : number,
                    productID :productID,
                    storeID : storeID,//myArray[0]['storeID'],
                    productSum :nowSum1
                    //productorder : productorder,
                }, //optional, you can send field1=10, field2='abc' to URL by this
                error: function(response) { //the call back function when ajax call fails
                    alert('Ajax request failed!');
                },
                success: function(txt) { //the call back function when ajax call succeed
                    //alert("Bomb" + bombID + ": " + txt);
                    //alert(txt);
                    myArray[0]['productSum1'] = txt;
                }
            });
            break;
        case 2 :
            nowSum2 = myArray[0]['productSum2'];
            $.ajax({
                url: "json2.php",
                dataType: 'html',
                type: 'POST',
                data: { 
                    orderNumber : number,
                    productID :productID,
                    storeID : storeID,//myArray[0]['storeID'],
                    productSum :nowSum2
                    //productorder : productorder,
                }, //optional, you can send field1=10, field2='abc' to URL by this
                error: function(response) { //the call back function when ajax call fails
                    alert('Ajax request failed!');
                },
                success: function(txt) { //the call back function when ajax call succeed
                    //alert("Bomb" + bombID + ": " + txt);
                    //alert(txt);
                    myArray[0]['productSum2'] = txt;
                }
            });
            break;
        case 3 :
            nowSum3 = myArray[0]['productSum3'];
            $.ajax({
                url: "json2.php",
                dataType: 'html',
                type: 'POST',
                data: { 
                    orderNumber : number,
                    productID :productID,
                    storeID : storeID,//myArray[0]['storeID'],
                    productSum :nowSum3
                    //productorder : productorder,
                }, //optional, you can send field1=10, field2='abc' to URL by this
                error: function(response) { //the call back function when ajax call fails
                    alert('Ajax request failed!');
                },
                success: function(txt) { //the call back function when ajax call succeed
                    //alert("Bomb" + bombID + ": " + txt);
                    //alert(txt);
                    myArray[0]['productSum3'] = txt;
                }
            });
            break;
        default:
    }
}
function orderNumber(productID,storeID)
{
    var number = parseInt(prompt("訂購多少","0"));
    //checkHead(productID,storeID,number);//確認總店庫存夠
    if(checkNumber(productID,number) == 1)
    {
        if(checkHead(productID,storeID,number)== 1)//確認沒到達上限
        {
            orderProduct(productID,storeID,number); 
        }
    }
}
function checkHead(productID,storeID,number)//已改
{
    var successTxt;
    $.ajax({
        url: "json4.php",
        dataType: 'html',
        type: 'POST',
        async: false,
        data: { 
            orderNumber : number,
            productID :productID,
            storeID: storeID
            //productorder : productorder,
        }, //optional, you can send field1=10, field2='abc' to URL by this
        error: function(response) { //the call back function when ajax call fails
            //alert(txt);
            alert(response);
        },
        success: function(txt) { //the call back function when ajax call succeed
            //alert("Bomb" + bombID + ": " + txt);
            alert(txt);
            successTxt = txt;
            //myArray[0]['productSum3'] = txt;    
        }
    });    
    if(successTxt =='訂購成功')
    {
        return 1 ;
    }
}
function checkNumber(productID,number)
{
    switch (productID)
    {
        case 1 :
            var limit =<?php echo $productLimit1;?>;
            var nowSum = parseInt(myArray[0]['productSum1']);
            break;
        case 2 :
            var limit =<?php echo $productLimit2;?>;
            var nowSum = parseInt(myArray[0]['productSum2']);
            break;
        case 3 :
            var limit =<?php echo $productLimit3;?>;
            var nowSum = parseInt(myArray[0]['productSum3']);
            break;
    }
    if(nowSum+number > limit)
    {
        alert("超過商店庫存上限,上限為:"+limit);
        return 0 ;
    }
    else{
        return 1;
    }
}
//javascript, to set the timer on windows load event
window.onload = function () {
	//check the bomb status every 1 second
    setInterval(function () {
		//checkBomb()　
        //check();
        productSum();
    }, 1000);
    setInterval(function () {
		//checkBomb()　
        //check();
        randomPrice();
    }, 10000);
};
</script>
</head>
<body >
<div id='headerquarter'><a href = 'factory.php'>總店</a></div><br/>
<?php
echo "<div id='k1'>0</div><br />";
echo "<div id='try1'>0</div><br />";
?>
 <table border=4 align=center width=60%  cellspacing=5 cellpadding=6>
  <tr>
    <td>產品名稱</td>
    <td>產品庫存</td>
    <td>產品價格</td>
  </tr>
<?php
$i=1; //counter for products
$sql="select * from store where store.storeID =$storeID "; //select all bomb information from DB
$res=mysqli_query($conn,$sql) or die("db error");
$arr = array(); //define an array for bombs
while($row=mysqli_fetch_assoc($res)) {
	$arr[] = $row; //store the row into the array
	//generate the image tag, the div tag for timer text. Note on the use of $i in tag ID
    $storeID = $row['storeID'];
    for($i;$i<=3;$i++)
    {
        $productID = "$i";
        //echo '<div class="logo"><a href="http://www.example.com/" onClick="_gaq.push([\'_trackEvent\', \'Join\', \'Home\', \'BigButton\']);">Link Text</a>';
        //echo "<tr><td><img src='images/cake.png' id='product$i' onclick='location.href ='orderProduct.php?productID = {$productID }?storeID = {$storeID}''</td><br />";
        //!!!!    echo "<tr><td><button onclick=\"self.location.href='orderProduct.php?productID={$productID}&storeID={$storeID}'\"><img src= 'images/cake.png' id='product$i'></button><div ></div></td><br />";
        //echo "<td><div id =\"productSum$i\"  ></div>", $rs["productSum$i"],"</td></tr>";
        switch($i)
        {
            case 1:
                echo "<tr><td><button onclick='orderNumber($productID,$storeID)'\"><img src= 'images/$productName1.png' id='product$i'></button><div ></div></td><br />";
                echo"<td><p id ='productSum$i' >0</p></td>";
                echo"<td><p id ='productPrice$i' >0</p></td></tr>";
                break;
            case 2 :
                echo "<tr><td><button onclick='orderNumber($productID,$storeID)'\"><img src= 'images/$productName2.png' id='product$i'></button><div ></div></td><br />";
                echo"<td><p id ='productSum$i' >0</p></td>";
                echo"<td><p id ='productPrice$i' >0</p></td></tr>";
                break;               
            case 3 :
                echo "<tr><td><button onclick='orderNumber($productID,$storeID)'\"><img src= 'images/$productName3.png' id='product$i'></button><div ></div></td><br />";
                echo"<td><p id ='productSum$i' >0</p></td>";
                echo"<td><p id ='productPrice$i' >0</p></td></tr>";
                break;
            default:
        }
	}
    echo "<tr><td><img src= 'images/money.jpg' ></td><br />";
    echo"<td><p id ='moneySum' >0</p></td></tr>";
}
?>
<!--</table>-->
<script>
<?php
	//print the bomb array to the web page as a javascript object
	echo "var myArray=" . json_encode($arr);
?>
</script>
</body></html>