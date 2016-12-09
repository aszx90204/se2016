<?php
require("dbconnect.php");
function showStore($userID) {
	global $conn;
    $sql = "select name,storeID from store where userID = '$userID'";
	return mysqli_query($conn,$sql);
}
function showStoreNumber() {
	global $conn;
    $sql = "select name,storeID from store";
	return mysqli_query($conn,$sql);
}

?>