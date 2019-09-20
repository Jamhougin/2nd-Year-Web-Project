<!--addresslistbox.php
	This creates a listbox populated with the names of 
	the clients on the client database
	James Hall c00007006 Feb:2019-->
<html>
  <head>
    <title>addresslistbox</title>
  </head>
  <body>
  	<?php 
	  	
	 	include "db.inc.php";//Connect to database

	  	$sql ="SELECT Property.address, Sales.dateAgreed, Property.propertyID, Client.name, noOflevels, recepRooms, bedrooms, bathrooms, area FROM ((Residential INNER JOIN Property ON Residential.propertyID = Property.propertyID) INNER JOIN Client ON Property.clientID = Client.clientID) LEFT JOIN Sales ON Property.propertyID = Sales.propertyID WHERE Property.deleteFlag =0 AND Property.forSale =1";
	  	$result =mysqli_query ($con, $sql);
		
	  	echo "<select class ='textbox' name ='address' id ='address' onclick ='populate()'>";//Begin listbox, uses populate()
	  	
	  	while ($row =mysqli_fetch_array($result)){
		  	$address =$row['address'];
			$propid =$row['propertyID'];
			$resstatus =propStatus($row['dateAgreed']);
			$owner =$row['name'];
			$noOflevels =$row['noOflevels'];
			$recepRooms =$row['recepRooms'];
			$bedrooms =$row['bedrooms'];
			$bathrooms =$row['bathrooms'];
			$area =$row['area'];
			$hasBids =bidStatus($row['propertyID']);
			$alltext ="$propid,$resstatus,$owner,$noOflevels,$recepRooms,$bedrooms,$bathrooms,$area,$hasBids";
		  	echo "<option value ='$alltext'> $address </option>";
	  	}
	  	echo "</select>";
	    //propStatus() determines if a property has been agreed for sale
	    function propStatus($dateAgreed){
		    if ($dateAgreed !=null){
				return "Sale Agreed";
		    }
		    else return "For Sale";
		}
	    //bidStatus() is used to determine if a property has any outstanding bids
	    function bidStatus($proId){
			include "db.inc.php";
			$bresult =mysqli_query($con, "SELECT MAX(amount) as max FROM Bid WHERE Bid.propertyID =$proId AND Bid.deleteFlag =0");
			$row1 = mysqli_fetch_array($bresult);
			$bid =$row1['max'];
			if ($bid ==null){
				return " No bids on this Property.";
			}
			else return " This Property has bids.";
		}
	  	mysqli_close($con);
	  ?>
  </body>
</html>
