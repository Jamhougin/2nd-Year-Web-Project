<!--addaresidence.html.php
	This displays the AddProperty form
	James Hall c00007006 Feb:2019-->
<!DOCTYPE html>
<?php
//Check if Logged In
session_start();
if (isset($_SESSION['user'])){
?>
<html lang ="en">
	<head>
		<script type ="text/javascript" src ="OnClick.js"></script>
		<script type ="text/javascript" src ="Residence.js"></script>
		<link rel ="icon" type ="image/png" href ="http://auctioneers.candept.com/logo2.png" sizes="16x16">
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
		<meta charset ="UTF-8">
		<title>AddResidence</title>
	</head>
	<body>
		<div id ="wrapper">
			<div id ="nav"><!--Navigation menu-->
				<?php include 'menu.php';?>
			</div>
			<h1>Add a Residential Property</h1>
			<form name ="myform" action = "AddProperty.php" method = "post" onsubmit = "return confirm('Do you want to Add a new Property?');">
				<label for ="client">Client Name: </label>
					<?php include 'clientlistbox.php'; ?><br><!--Adds a listbox populated with client names-->
				<label for ="propertytype">Property Type: </label>
					<input class ="textbox" type ="text" name ="propertytype" id ="propertytype" required><br>
				<label for ="address">Address: </label>
					<input class ="textbox" type ="text" name ="address" id ="address" required><br>
				<label for ="location">Location: </label>
					<input class ="textbox" type ="text" name ="location" id ="location" required><br>
				<label for ="nooflevels">Number of Levels: </label>
					<input class ="textbox" type ="number" name ="nooflevels" id ="nooflevels" required><br>
				<label for ="nofrecep">Number of Reception Rooms: </label>
					<input class ="textbox" type ="number" name ="nofrecep" id ="nofrecep" required><br>
				<label for ="noofbed">Number of Bedrooms: </label>
					<input class ="textbox" type ="number" name ="noofbed" id ="noofbed" required><br>
				<label for ="noofbath">Number of Bathrooms: </label>
					<input class ="textbox" type ="number" name ="noofbath" id ="noofbath" required><br>
				<label for ="area">Area of House: </label>
					<input class ="textbox" type ="number" name ="area" id ="area" required><br>
				<label for ="heating">Heating Type: </label>
					<input class ="textbox" type ="text" name ="heating" id ="heating" required><br>
				<label for ="site">Site Info: </label>
					<input class ="textbox" type ="text" name ="site" id ="site" required><br>
				<label for ="notes">Notes: </label>
					<input class ="textbox" type ="text" name ="notes" id ="notes"><br>
				<label for ="asking">Asking Price: </label>
					<input class ="textbox" type ="number" name ="asking" id ="asking" required><br>
				<label for="viewtimes">Viewing Times: </label>
					<input class ="textbox" type ="text" name ="viewtimes" id ="viewtimes" required><br>
				<input class ="formsub" type ="reset" value ="Clear"><br><br>
				<input class ="formsub" type ="submit" value ="Submit">
			</form><br><br><br><br>
			<div id ="menu">
				<button class ="button" type ="button" title ="Back to Property" onClick ="toProperty()">Quit</button><br><br>
			</div>
		</div>
	</body>
</html>
<?php
}
else {//If not Logged In
	echo 	"<link rel ='icon' type ='image/png' href ='http://auctioneers.candept.com/logo2.png' sizes='16x16'>
			<link rel ='stylesheet' type ='text/css' href ='auctioneerstyle.css'>
			<h1>You must be logged in to view this page</h1>
			<input class ='button' type ='button' value ='Go to Login' onClick ='window.location =\"login.php\"'>";
	session_destroy();	
}
?>