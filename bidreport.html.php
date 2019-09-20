<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['user'])){
?>
<html lang ="en">
	<head>
		<script>
			//Creates alert with data on the clients address and phone number
			function clientInfo(sender){
				var sel = document.getElementById("name").value;
				var addr =sender.dataset.cadd;
				var phone =sender.dataset.phone;
				alert("Address:"+addr+"\nPhone:"+phone);
			}
		</script>						
		<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="icon" type ="image/png" href ="http://auctioneers.candept.com/logo2.png" sizes="16x16">
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
		<meta charset ="UTF-8">
		<title>Bid Report</title>
	</head>
	<body>
		<form action ="bidreport.html.php" method ="post" name ="reportForm">
			<input type ="hidden" name ="choice">
		</form>
		<div id ="wrapper">
			<div id ="nav">
				<?php include 'menu.php';?>
			</div>
			<h1>Bid Reports</h1>
			<div>
				<input class ="button" type ="button" id ="residenceButton" value ="Residential Bids" onclick ="resOrder()" title ="Click here for residential report">
				<input class ="button" type ="button" id ="landButton" value ="Land Bids" onclick ="landOrder()" title ="Click here for land report" disabled>
				<input class ="button" type ="button" id ="officeButton" value ="Office Bids" onclick ="officeOrder()" title ="Click here for office report" disabled><br>
				<script>
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
					//This creates the table containing the report
					function produceBReport($con,$sql){
						$resultbr = mysqli_query($con,$sql);
						if (!$resultbr){//Check if there are any results to return
							echo 	"<table>
								<tr><th>Property Number</th><th>Address</th><th>Client Number</th><th>Client Name (Click to show info)</th><th>Amount of Bid</th><th>Date of Bid</th></tr>";
						}
						else{
							echo 	"<table>
									<tr><th>Property Number</th><th>Address</th><th>Client Number</th><th>Client Name (Click to show info)</th><th>Amount of Bid</th><th>Date of Bid</th></tr>";

							while ($row =mysqli_fetch_array($resultbr)){
								$date =date_create($row['datePlaced']);
								$FDate =date_format($date,"d/m/Y");
								
								//the input tag below contains data- tags that contain the address and phone number of the client named in the value tag
								echo 	"<tr><td>".$row['propertyID']."</td>
										<td>".$row['padd']."</td>
										<td>".$row['clientID']."</Td>
										<td><input data-cadd='$row[cadd]' data-phone='$row[phone]' class='repbutton' type='button' name='name' id ='name' value='".$row['name']."'title ='Click for more details'  onClick='clientInfo(this)'></td>
										<td>".$row['amount']."</td>
										<td>".$FDate."</td>
										</tr>";	
							}//End while
						}//End else
						echo "</table>";
					};//End function
					$choice ="Residential Bids";//Sets choice on first visiting page
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
					include 'db.inc.php';
						$sql ="SELECT Bid.propertyID, Property.address AS padd, Bid.clientID, Client.name, Client.phoneNo AS phone, Client.address AS cadd, Bid.amount, Bid.datePlaced FROM ((Bid INNER JOIN Property ON Bid.propertyID = Property.propertyID) INNER JOIN Client ON Bid.clientID = Client.clientID) INNER JOIN Residential ON Bid.propertyID = Residential.propertyID";
						produceBReport($con,$sql);
					}
				else if ($choice =="Land Bids"){
				?>
				<script>
					document.getElementById("residenceButton").disabled =false;
					document.getElementById("landButton").disabled =true;
					document.getElementById("officeButton").disabled =false;
				</script>
				<?php
					include 'db.inc.php';
						$sql ="SELECT Bid.propertyID, Property.address AS padd, Bid.clientID, Client.name, Client.phoneNo AS phone, Client.address AS cadd, Bid.amount, Bid.datePlaced FROM ((Bid INNER JOIN Property ON Bid.propertyID = Property.propertyID) INNER JOIN Client ON Bid.clientID = Client.clientID) INNER JOIN Land ON Bid.propertyID = Land.propertyID";
						produceBReport($con,$sql);
					}
				 else if ($choice =="Office Bids"){
				?>
				<script>
					document.getElementById("residenceButton").disabled =false;
					document.getElementById("landButton").disabled =false;
					document.getElementById("officeButton").disabled =true;
				</script>
				<?php
					include 'db.inc.php';
						$sql ="SELECT Bid.propertyID, Property.address AS padd, Bid.clientID, Client.name, Client.phoneNo AS phone, Client.address AS cadd, Bid.amount, Bid.datePlaced FROM ((Bid INNER JOIN Property ON Bid.propertyID = Property.propertyID) INNER JOIN Client ON Bid.clientID = Client.clientID) INNER JOIN Office ON Bid.propertyID = Office.propertyID";
						produceBReport($con,$sql);
					}
				
				?><br>
				<button class ="button" type ="button" title ="Back to Reports" onClick ="toReports()">Quit</button><br><br>
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