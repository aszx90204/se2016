<?php
$host = 'localhost';
$user = 'bess';
$pass = '123';
$db = 'final';
$conn = mysqli_connect($host, $user, $pass, $db) or die('Error with MySQL connection'); //��MyMSQL�s�u�õn�J
mysqli_query($conn,"SET NAMES utf8"); //��ܽs�X
?>