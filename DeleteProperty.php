<!--DeleteProperty.php
	This will remove the chosen property from the Property Table, as well as the Residential table.
	It will also remove all associated bids and Sales
	James Hall c00007006 Feb:2019-->
<html>
	<head>
		<title>DeleteProperty</title>
		<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
	</head>
	<body>
		<?php 

			include "db.inc.php";//Connect to database
			
			$rAddress = $_POST['address'];//Get Client Name and ID
			preg_match_all('!\d+!', $rAddress, $matches);//Extract Array containing ID
			$addID1 = implode(',', $matches[0]);//Change Array to single variable
			$addID2 = explode(',', $addID1);//Change variable to 1 dimensional array
			$addID = $addID2[0];

			$sql ="UPDATE Property SET deleteFlag =true WHERE Property.propertyID ='$addID'";
			if(! mysqli_query($con, $sql)){
				echo "delete prop Error ".mysql_error();
			}
			else $sql2 ="UPDATE Bid SET deleteFlag =true WHERE Bid.propertyID ='$addID'";
			if(! mysqli_query($con, $sql2)){
				echo "delete Bid Error ".mysql_error();
			}
			else	$sql3 ="UPDATE Sales SET deleteFlag =true WHERE propertyID ='$addID'";

			if(! mysqli_query($con, $sql3)){
				echo "delete sale Error ".mysql_error();
			}
			else echo "Residential Address:".$addID." deleted<br><button class =\"button\" type =\"button\" onClick =\"toDeleteResidence()\">Quit</button>";
			mysqli_close($con);
			?>
	</body>
</html>
