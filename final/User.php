<?php
require("dbconnect.php");

function checkUser($uID, $Pwd) {
	global $conn;
	$uID =mysqli_real_escape_string($conn,$uID);
	$sql = "SELECT password FROM user WHERE userID='$uID'";
    //$sql2 = "SELECT department FROM person WHERE loginID='$uID'";
	if ($result = mysqli_query($conn,$sql)) {
		if ($row=mysqli_fetch_assoc($result)) {
			if ($row['password'] === $Pwd) {
                return true;               
			} 
		}
	}
	return false;
}
/*function checkDep($uID,$Pwd) {
	global $conn;
	$uID = mysqli_real_escape_string($conn,$uID);
	$sq2 = "SELECT password,department FROM person WHERE loginID='$uID'";
    //$sql2 = "SELECT department FROM person WHERE loginID='$uID'";
	if ($result = mysqli_query($conn,$sq2)) {
		if ($row=mysqli_fetch_assoc($result)) {
			if ($row['password'] === $Pwd) {
				return $row['department'];
			} 
		}
	}
	return -1;
}*/
?>
