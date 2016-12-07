<?php
require("dbconnect.php");
function showStore() {
	global $conn;
    $sql = "select name,storeID from store";
	return mysqli_query($conn,$sql);
}
function showStoreNumber() {
	global $conn;
    $sql = "select name,storeID from store";
	return mysqli_query($conn,$sql);
}

?>