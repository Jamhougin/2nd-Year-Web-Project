<!--login.php
	This creates the login screen
	James Hall c00007006 Mar:2019-->
<?php
include 'db.inc.php';
session_start();
echo '<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="icon" type ="image/png" href ="http://auctioneers.candept.com/logo2.png" sizes="16x16">
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
		<meta charset ="UTF-8">';
if (isset($_POST['loginName']) && isset($_POST['passWord'])){
	$attempts =$_SESSION['attempts'];
	
	$sql = "SELECT * FROM Staff WHERE name = '$_POST[loginName]' AND password = '$_POST[passWord]'";
	
	if (!mysqli_query($con,$sql)) echo "Error in Query". mysqli_error($con);
	else{
		if (mysqli_affected_rows($con) ==0){
			$attempts++;
			
			if ($attempts <=3){
				$_SESSION['attempts'] =$attempts;
				buildPage($attempts);
				
				echo "<div> No records found matching username and password, Please try again. </div>";
			}
			else {
				echo "<div>Sorry, You have used your 3 attempts.<br>Shutting down . . .</div>";
			}
		}
		else{
			//Successfull login
			$_SESSION['user'] =$_POST['loginName']; //Session variable to keep track of login name
			
			echo 	"<div id ='wrapper'>
					<h1>Login Successful!</h1><br>
					<h1>Welcome to our Website</h1><br>
					<input class ='button' type ='button' value = 'Change Password' onCLick ='window.location = \"changePass.php\"'>
					<input class ='button' type ='button' value = 'Main Menu' onCLick ='window.location = \"auctioneerindex.html.php\"'>
					</div>";
		}
	}
}
else{
	//Building page for initial display
	$attempts =1;
	$_SESSION['attempts'] =$attempts;
	buildPage($attempts);
};

function buildPage($att){
	echo 	"<body>
			<div id ='wrapper'>
			<form action ='login.php' method ='post'>
			<h1> JDC Auctioneering Systems</h1><br>
			<h1> Attempt Number: $att </h1>
			<label for ='loginName'>Login Name</label>
			<input class ='textbox' type ='text' name ='loginName' id ='loginName' autocomplete ='off'><br><br>
			<label for ='passWord'>Password</label>
			<input class ='textbox' type ='password' name ='passWord' id ='passWord'><br><br>
			<input class ='button' type ='submit' value ='Submit'>
			</div>
			</form>";
}
mysqli_close($con);
?>