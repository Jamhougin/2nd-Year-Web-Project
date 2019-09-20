<!DOCTYPE html>
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
		<title>Withdraw Bid</title>
	</head>
	<body>
		<form action ="withdrawabid.html.php" method ="post" name ="reportForm">
			<input type ="hidden" name ="choice">
		</form>
		<div id ="wrapper">
			<div id ="nav">
				<?php include 'menu.php';?>
			</div>
			<h1>Withdraw a Bid</h1>
			<div>
				<input class ="button" type ="button" id ="residenceButton" value ="Residential Bids" onclick ="resOrder()" title ="Click here for residential report">
				<input class ="button" type ="button" id ="landButton" value ="Land Bids" onclick ="landOrder()" title ="Click here for land report" disabled>
				<input class ="button" type ="button" id ="officeButton" value ="Office Bids" onclick ="officeOrder()" title ="Click here for office report" disabled><br>
				<script>
					//Functions for onclick in button tags above
					function resOrder(){
						document.reportForm.choice.value ="Residential Bids";
						document.reportForm.submit();
					}
					function landOrder(){
						document.reportForm.choice.value ="Land Bids";
						document.reportForm.submit();
					}
					function officeOrder(){
						document.reportForm.choice.value ="Office Bids";
						document.reportForm.submit();
					}
				</script>
				<?php
					function produceAddressList($protype){
						include "db.inc.php";//Connect to database
						$sql = "SELECT DISTINCT address FROM Property INNER JOIN $protype ON $protype.propertyID = Property.propertyID INNER JOIN Bid ON $protype.propertyID = Bid.propertyID";
						
						$result =mysqli_query ($con, $sql);
						echo "<form id ='menu' method ='post'><label for ='address'>Address: </label>";
						echo "<select class ='textbox2' name ='address' id ='address'>";//Begin listbox

						while ($row =mysqli_fetch_array($result)){
							$address =$row['address'];
							echo "<option value='$address'> $address </option>";
						}
						echo "</select></form><br><br><br>";
						listBids($protype,$address);
					};//End function
					function listBids($prot,$addr){
						include "db.inc.php";//Connect to database
						//$addressSelection = $_POST['address'];
						echo $addr, $prot;
						$sql1 = "SELECT Bid.propertyID, Property.address AS padd, Bid.clientID, Client.name, Client.phoneNo AS phone, Client.address AS cadd, Bid.amount, Bid.datePlaced FROM ((Bid INNER JOIN Property ON Bid.propertyID = Property.propertyID) INNER JOIN Client ON Bid.clientID = Client.clientID) INNER JOIN $prot ON Bid.propertyID = $prot.propertyID WHERE Property.address = '$addr'";
						$resultbr =mysqli_query ($con, $sql1);
						if (!$resultbr){//Check if there are any results to return
							echo 	"<table>
								<tr><th>Property Number</th><th>Address</th><th>Client Number</th><th>Client Name (Click to show info)</th><th>Amount of Bid</th><th>Date of Bid</th></tr>";
						}
						else{
							echo 	"<table>
									<tr><th>Property Number</th><th>Address</th><th>Client Number</th><th>Client Name (Click to show info)</th><th>Amount of Bid</th><th>Date of Bid</th></tr>";

							while ($row1 =mysqli_fetch_array($resultbr)){
								$date =date_create($row1['datePlaced']);
								$FDate =date_format($date,"d/m/Y");
								
								//the input tag below contains data- tags that contain the address and phone number of the client named in the value tag
								echo 	"<tr><td>".$row1['propertyID']."</td>
										<td>".$row1['padd']."</td>
										<td>".$row1['clientID']."</Td>
										<td><input data-cadd='$row1[cadd]' data-phone='$row1[phone]' class='repbutton' type='button' name='name' id ='name' value='".$row1['name']."'title ='Click for more details'  onClick='clientInfo(this)'></td>
										<td>".$row1['amount']."</td>
										<td>".$FDate."</td>
										</tr>";	
							}//End while
						}//End else
						echo "</table>";
					};//End function
							  
					$choice ="Residential Bids";
					if (ISSET($_POST['choice'])){
						$choice =$_POST['choice'];
					}
							  
					if ($choice =="Residential Bids"){
				?>
				<script>
					document.getElementById("residenceButton").disabled =true;
					document.getElementById("landButton").disabled =false;
					document.getElementById("officeButton").disabled =false;
				</script>
				<?php
					$res ="Residential";
						produceAddressList($res);
						
					}
				else if ($choice =="Land Bids"){
				?>
				<script>
					document.getElementById("residenceButton").disabled =false;
					document.getElementById("landButton").disabled =true;
					document.getElementById("officeButton").disabled =false;
				</script>
				<?php
					$land ="Land";
						produceAddressList($land);
						
					}
				 else if ($choice =="Office Bids"){
				?>
				<script>
					document.getElementById("residenceButton").disabled =false;
					document.getElementById("landButton").disabled =false;
					document.getElementById("officeButton").disabled =true;
				</script>
				<?php
					$off ="Office";
						produceAddressList($off);
					 	
					}
				
				?><br>
				<button class ="button" type ="button" onClick ="toBids()">Quit</button><br><br>
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