<?php
    require("dbconnect.php");
    global $conn;
    $productID = $_GET['productID'];
    $storeID = $_GET['storeID'];
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">
</script>
</head>

<body >
<form method="post" action="controller.php">
    <input type="hidden" name="act" value="orderProduct">
    <input type = "hidden" name="productID" type="text" id="productID" value="<?php echo $productID ?>"/> <br>
    <input type = "hidden" name="storeID" type="text" id="storeID" value="<?php echo $storeID ?>"/> <br>
    Number:<input name="number" type="text" id="number" /> <br>
    <input type="submit" name="Submit" value="修改" />
	</form>
</body></html>