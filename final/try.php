<?php
 require "dbconnect.php";
 ?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">

/*function handleBomb(bombID) {
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
}*/
/*
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
    
}*/
function check()
{
    $("#k1").html("gj");
}
//javascript, to set the timer on windows load event
window.onload = function () {
	//check the bomb status every 1 second
    setInterval(function () {
		//checkBomb()
        check();
    }, 1000);
};
</script>
</head>

<body >
<?php
echo "<div id='k1'>0</div><br />";
?>
<?php
/*$i=0; //counter for bombs
$sql="select * from game"; //select all bomb information from DB
$res=mysqli_query($db,$sql) or die("db error");
$arr = array(); //define an array for bombs

while($row=mysqli_fetch_assoc($res)) {
	$arr[] = $row; //store the row into the array
	//generate the image tag, the div tag for timer text. Note on the use of $i in tag ID
	echo "<img src='images/bomb.jpg' id='bomb$i' onclick='handleBomb($i)'><div id='timer$i'>0</div><br />";
	$i++; //increase counter
}*/
?>

<script>
<?php
	//print the bomb array to the web page as a javascript object
	echo "var myArray=" . json_encode($arr);
?>
</script>

</body></html>