<!--clientlistbox.php
	This creates a listbox populated with the names of 
	the clients on the client database
	James Hall c00007006 Feb:2019-->
<html>
  <head>
    <title>clientlistbox</title>
  </head>
  <body>
  	<?php 
	  	
	 	include "db.inc.php";//Connect to database

	  	$sql ="SELECT clientID, name FROM Client";
	  	$result =mysqli_query ($con, $sql);
		
	  	echo "<select class =\"textbox\" name =\"client\" id =\"client\">";
	  	
	  	while ($row =mysqli_fetch_array($result)){
		  	$name =$row['name'];
			$clientID =$row['clientID'];
		  	echo "<option> $name $clientID</option>";
	  	}
	  	echo "</select>";
	  	mysqli_close($con);
	  ?>
  </body>
</html>
