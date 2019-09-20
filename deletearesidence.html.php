<!DOCTYPE html>
<!--deletearesidence.html.php
	This page is used to remove the chosen property from the Property Table, as well as the Residential table.
	It will also remove all associated bids and Sales
	James Hall c00007006 Feb:2019-->
<?php
session_start();
if (isset($_SESSION['user'])){
?>
<html lang ="en">
	<head>
		<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="icon" type ="image/png" href ="http://auctioneers.candept.com/logo2.png" sizes="16x16">
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
		<meta charset ="UTF-8">
		<title>DeleteResidence</title>
	</head>
	<body>
		<div id ="wrapper">
			<div id ="nav">
				<?php include 'menu.php';?>
			</div>
			<h1>Delete a Residential Property</h1>
			<form action = "DeleteProperty.php" method = "post"  onsubmit = "return bidCheck();">
				<label for ="address">Residential Address: </label>
					<?php include 'addresslistbox.php'; ?><br><!--Adds a listbox populated with Residential addresses-->
				<script>
					//Populate the form with data
					function populate(){
						var sel = document.getElementById("address");
						var result = sel.options[sel.selectedIndex].value;
						var residenceDetails =result.split(',');
						document.getElementById("propid").value =residenceDetails[0];
						document.getElementById("status").value =residenceDetails[1];
						document.getElementById("owner").value =residenceDetails[2];
						document.getElementById("nooflevels").value =residenceDetails[3];
						document.getElementById("nofrecep").value =residenceDetails[4];
						document.getElementById("noofbed").value =residenceDetails[5];
						document.getElementById("noofbath").value =residenceDetails[6];
						document.getElementById("area").value =residenceDetails[7];
					}
					//Check if user wants to Delete and also displays whether there are bids on the property
					function bidCheck(){
						var sel1 = document.getElementById("address");
						var bresult = sel1.options[sel1.selectedIndex].value;
						var bresidenceDetails =bresult.split(',');
						var hasBids =bresidenceDetails[8];//String containing info on whether there are outstanding bids
						var response = confirm(hasBids+' Are you sure you want to delete?');
						if(response){ return true;}
						else {return false;}
					}
				</script>
				<label for ="propid">Property ID: </label>
					<input class ="textbox" type ="number" name ="propid" id ="propid" disabled><br>
				<label for ="status">Status: </label>
					<input class ="textbox" type ="text" name ="status" id ="status" disabled><br>
				<label for ="owner">Owner: </label>
					<input class ="textbox" type ="text" name ="owner" id ="owner" disabled><br>
				<label for ="nooflevels">Number of Levels: </label>
					<input class ="textbox" type ="number" name ="nooflevels" id ="nooflevels" disabled><br>
				<label for ="nofrecep">Number of Reception Rooms: </label>
					<input class ="textbox" type ="number" name ="nofrecep" id ="nofrecep" disabled><br>
				<label for ="noofbed">Number of Bedrooms: </label>
					<input class ="textbox" type ="number" name ="noofbed" id ="noofbed" disabled><br>
				<label for ="noofbath">Number of Bathrooms: </label>
					<input class ="textbox" type ="number" name ="noofbath" id ="noofbath" disabled><br>
				<label for ="area">Area of House: </label>
					<input class ="textbox" type ="number" name ="area" id ="area" disabled><br>
				<input class ="formsub" type ="submit" value ="Delete">
			</form><br><br><br><br>
			<div id ="menu">
				<button type ="button" class ="button" title ="Back to Property" onClick ="toProperty()">Quit</button><br><br>
			</div>
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