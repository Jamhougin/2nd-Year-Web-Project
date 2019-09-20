<!DOCTYPE html>
<?php
session_start();
//Check if logged in
if (isset($_SESSION['user'])){
?>
<html lang ="en">
	<head>
		<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="icon" type ="image/png" href ="http://auctioneers.candept.com/logo2.png" sizes="16x16">
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
		<meta charset ="UTF-8">
		<title>Home Page</title>
	</head>
	<body>
		<div id ="wrapper">
			<div id ="nav">
				<?php include 'menu.php';?>
			</div>
			<h1>Main Menu</h1>
			<div id ="menu">
				<button class ="button" type ="button" onClick ="toBids()">Deal with Bids</button><br><br>
				<button class ="button" type ="button" onClick ="toSales()">Deal with Sales</button><br><br>
				<button class ="button" type ="button" onClick ="toClients()">Client Maintenance</button><br><br>
				<button class ="button" type ="button" onClick ="toProperty()">Property Maintenance</button><br><br>
				<button class ="button" type ="button" onClick ="toReports()">Reports</button>
			</div><br><br><br><br>
			<!--This form's Submit button will log the user out-->
			<form action="logout.php" method="post">
				<input class ="button" type="submit" value ="Quit"/>
				</form>
		</div>
	</body>
</html>
<?php
}
else {
	echo 	"<link rel ='icon' type ='image/png' href ='http://auctioneers.candept.com/logo2.png' sizes='16x16'>
			<link rel ='stylesheet' type ='text/css' href ='auctioneerstyle.css'>
			<h1>You must be logged in to view this page</h1>
			<input class ='button' type ='button' value ='Go to Login' onClick ='window.location =\"login.php\"'>";
	session_destroy();	
}
?>