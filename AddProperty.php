<!--AddProperty.php
	This adds a new Residential property to the database
	with an insert into the Property and Residential tables
	James Hall c00007006 Feb:2019-->
<html>
	<head>
		<title>AddProperty</title>
		<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
	</head>
	<body>
		<?php 

			include "db.inc.php";//Connect to database
			
			$cName = $_POST[client];//Get Client Name and ID
			preg_match_all('!\d+!', $cName, $matches);//Extract Array containing Matches
			$clientID = implode('', $matches[0]);//Change matches to single variable

			$rresult = mysqli_query($con,"SELECT MAX(residentialID) as max FROM Residential");//Returns highest numbered residentialID
			$row = mysqli_fetch_array($rresult);
			$resNum = $row['max'] +1;
		
			$presult = mysqli_query($con, "SELECT MAX(propertyID) as max1 FROM Property");//Returns highest numbered propertyID
			$row1 = mysqli_fetch_array($presult);
			$propNum = $row1['max1'] +1;	
			$true = true;
			$false = false;

			$sql1 ="INSERT INTO Residential (residentialID, propertyID, type, noOfLevels, recepRooms, bedrooms, bathrooms, area, heatingType, site, notes) VALUES ($resNum, $propNum, '$_POST[propertytype]','$_POST[nooflevels]','$_POST[nofrecep]','$_POST[noofbed]','$_POST[noofbath]','$_POST[area]','$_POST[heating]','$_POST[site]','$_POST[notes]')";//Create new Residential entry
			if(! mysqli_query($con, $sql1)){
				echo "Residence Error ".mysql_error();
			}
			else	$sql2 ="INSERT INTO Property (propertyID, clientID, address, location, forSale, askingPrice, viewingTimes, deleteFlag) VALUES ('$propNum', '$clientID', '$_POST[address]', '$_POST[location]', '$true', '$_POST[asking]', '$_POST[viewtimes]', '$false')";//Create new Property entry

			if(! mysqli_query($con, $sql2)){
				echo "Property Error ".mysql_error();
			}
			else echo "Property No.".$propNum.", Address:".$_POST[address]." for ".$cName." created<br><button class =\"button\" type =\"button\" onClick =\"toAddResidence()\">Quit</button>";
			mysqli_close($con);
			?>
	</body>
</html>
