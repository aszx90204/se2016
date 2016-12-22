<?php
    require("dbconnect.php");
    session_start();
    $userID = $_SESSION['uID'];
    $sql = "select productName from headerquarter where userID = '$userID'";
    $result = mysqli_query($conn,$sql);  
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<h1>恭喜分店開張<h1>
<p>請選擇3個要販售的產品</p>
<form onsubmit="return check()" method="post" action="open.php"> 
<?php
    while($row=mysqli_fetch_assoc($result))
    {   $productName = $row['productName'];
        echo"<input name='product[]' type=checkbox onclick='return count(this)' value ={$row['productName']}><img src= 'images/$productName.png'>{$row['productName']}</br>";
    }
    echo" 店名:<input name='Name' type='text' id='Name'><br>"
?>
<input type="submit">您勾了 <span id="t1">0</span> 項 
</form> 

</body></html>
