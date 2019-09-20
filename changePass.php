<!--changePass.php
	This creates the change password screen
	James Hall c00007006 Mar:2019-->
<?php
include 'db.inc.php';
session_start();

echo '<script type ="text/javascript" src ="OnClick.js"></script>
		<link rel ="icon" type ="image/png" href ="http://auctioneers.candept.com/logo2.png" sizes="16x16">
		<link rel ="stylesheet" type ="text/css" href ="auctioneerstyle.css">
		<meta charset ="UTF-8">';
if (isset($_SESSION['user'])){
	if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['confirmPass'])){
		$old =$_POST['oldPass'];
		$new =$_POST['newPass'];
		$confirm =$_POST['confirmPass'];
		
		$user =$_SESSION['user'];
		
		$sql ="SELECT * FROM Staff WHERE name ='$user' AND password ='$_POST[oldPass]'";
		if (!mysqli_query($con,$sql)){
			echo "Error in Select Query".mysqli_error($con);
		}
		else{
			if (mysqli_affected_rows($con) ==0){
				buildPage($old, $new, $confirm);
				echo "<div>Old Password Incorrect!</div>";
			}
			else{
				if ($_POST['newPass'] !=$_POST['confirmPass']){
					buildPage($old, $new, $confirm);
					echo "<div>New Passwords don't match, please try again!</div>";
				}
				else{
					$sql ="UPDATE Staff SET password ='$_POST[newPass]' WHERE name ='$user'";
					if (!mysqli_query($con, $sql)) echo "Error in Update Query".mysqli_error($con);
					else{
						if (mysqli_affected_rows($con) ==0){
							buildPage($old, $new, $confirm);
							echo "<div>No changes made!</div>";
						}
						else{
							echo 	"<div>Your Password has been changed!</div>
									<div><input class ='button' type ='button' value ='Go to Main Menu' onClick ='window.location =\"auctioneerindex.html.php\"'></div>";
									session_destroy();
						}
					}
				}
			}
		}
	}
	else buildPage("", "", "");
}
else echo "<link rel ='icon' type ='image/png' href ='http://auctioneers.candept.com/logo2.png' sizes='16x16'>
			<link rel ='stylesheet' type ='text/css' href ='auctioneerstyle.css'>
			<h1>You must be logged in to view this page</h1>
			<input class ='button' type ='button' value ='Go to Login' onClick ='window.location =\"login.php\"'>";

function buildPage($o, $n, $c){
	echo 	"<body>
			<form action ='changePass.php' method ='post'>
			<h1>Change Password</h1>
			<label for ='oldPass'>Old Password</label>
			<input class ='textbox' type ='password' name ='oldPass' id ='oldPass' autocomplete ='off' value =$o><br><br>
			<label for ='newPass'>New Password</label>
			<input class ='textbox' type ='password' name ='newPass' id ='newPass' autocomplete ='off' value =$n><br><br>
			<label for ='confirmPass'>Confirm New Password</label>
			<input class ='textbox' type ='password' name ='confirmPass' id ='confirmPass' autocomplete ='off' value =$c><br><br>
			<input class ='button' type ='submit' value ='Submit'>
			</form>
			</body>";
}
mysqli_close($con);
?>