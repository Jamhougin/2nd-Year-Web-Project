<?php
$hostname ="localhost:3306";
$username ="auctions";
$password ="Pr0p3Rt13s;34";
$dbname ="auctions_";

$con =mysqli_connect($hostname,$username,$password, $dbname);

if (!$con){
	die ("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>