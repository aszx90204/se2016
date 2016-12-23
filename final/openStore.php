<?php
    require("dbconnect.php");
    session_start();
    $userID = $_SESSION['uID'];
    $sql = "select productName from headerquarter where userID = '$userID'";
    $result = mysqli_query($conn,$sql);  
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	</style>
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
var n = 0; 
var i = 0;
function count(obj) { 
    if (obj.checked) 
    {
        if (n<3)
        {
            n++;
        }
        else 
        { 
            alert("最多只能勾3個"); 
            return false; 
        }
    }
    else n--; 
    document.getElementById("t1").innerText = n; 
} 
function check() { 
    if (n<3  ) { 
        alert("最少要勾3個"); 
        return false; 
    }
    if($("#Name").val()=="")
    {
        alert("店面名稱不可為空");
        return false;
    }
} 

</script>
</head>

<body >
<div id="background">
			<div id="background1"></div>
			<div id="background2"></div>
			<div id="background3"></div>
			<div id="background4"></div>
		</div>
<h1 style='text-align:center'>恭喜分店開張</h1>
<br />
<p style='text-align:center; font-size:25px'>店名:<input name='Name' type='text' id='Name'></p>
<br />
<p style='text-align:center; font-size:20px'>請選擇3個要販售的產品</p>
<form onsubmit="return check()" method="post" action="open.php"> 
 <table  align=center width=40%   bgcolor="#DAA569" border="inset"> 
 <tr>
    <td align='center'>產品</td>
    <td align='center'>產品名稱</td>
  </tr>
 <?php
    while($row=mysqli_fetch_assoc($result))
    {   $productName = $row['productName'];
        echo"<tr><td align='center'><input name='product[]' type=checkbox onclick='return count(this)' value ={$row['productName']}><img src= 'images/$productName.png 'style='max-height:150px;'></td><td align='center'>{$row['productName']}</td></tr>";
    }
?>
</table>

<p style='text-align:center; font-size:20px'>您勾了 <span id="t1">0</span> 項</p>
<p style='text-align:center'><input type="submit" value="送出"></p>

</form> 

</body></html>
