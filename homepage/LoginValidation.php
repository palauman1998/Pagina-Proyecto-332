<?php
session_start();
?>

<?php
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$inputEmail=$_POST['inputEmail'];
$inputPassword=$_POST['inputPassword'];
$var_Password = crypt($inputPassword, '$6$rounds=5000$anexamplestringforsalt$');

$sql = "SELECT * FROM `Customers` where EMail = '$inputEmail'";

$result = $conn->query($sql);

//Checks if user input information provided in login matches users' records in database.
//If so, user is redirected to homepage. Else, user is prompted to try again and redirected to signin.php

if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($inputEmail == $row["EMail"] and $var_Password == $row["Password"]){
				echo "<script type='text/javascript'>
							alert('Information correct.');
					</script>";
				$_SESSION['FName'] = $row["FName"];
				$_SESSION['LName'] = $row["LName"];
				header("location:https://web.ics.purdue.edu/~g1109686/homepage/homepage.php");

			}
			else{
				echo "<script type='text/javascript'>
							alert('Information Incorrect. Please Try Again.');
					</script>";
					header("refresh:1; url=https://web.ics.purdue.edu/~g1109686/homepage/signin.php");
			}

		}
}
else{
				echo "<script type='text/javascript'>
							alert('Information Incorrect. Please Try Again.');
					</script>";
				header("refresh:1; url=https://web.ics.purdue.edu/~g1109686/homepage/signin.php");
			}

$conn->close();
?>
