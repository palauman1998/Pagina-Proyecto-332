<?php
//Database Connection Credentials
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
	die('Connection Failed : '.$conn->connect_error);
}
//Insert Statement - Form to Database
$FName = $_POST['firstName'];
$LName = $_POST['lastName'];
$EMail = $_POST['email'];
$AccountNumber = $_POST['accountnumber'];
$newpassword= $_POST['newpassword'];
$var_AccountNumber = crypt($AccountNumber, '$6$rounds=5000$anexamplestringforsalt$');
$var_newpassword=crypt($newpassword, '$6$rounds=5000$anexamplestringforsalt$');

//Update info
$sql = "SELECT * from Customers WHERE EMail = '$EMail'";
$sqlnew = "UPDATE `Customers` SET`Password`= '$var_newpassword' WHERE EMail= '$EMail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($FName == $row["FName"] and $LName == $row["LName"] and $EMail == $row["EMail"] and $var_AccountNumber == $row["AccountNumber"]){
				if ($conn->query($sqlnew) === TRUE) {
					 echo "<script type='text/javascript'>
							alert('Password updated successfully');
					</script>";
					header("refresh:1; url=https://web.ics.purdue.edu/~g1109686/homepage/signin.php");
				} else {
					echo "Error updating record: " . $conn->error;
				}
			}else{
				echo "<script type='text/javascript'>
							alert('Information Incorrect1. Please Try Again.');
					</script>";
				header("refresh:1; url=https://web.ics.purdue.edu/~g1109686/homepage/forget.html");
			}
		}		
}else{
	echo "<script type='text/javascript'>
							alert('Information Incorrect2. Please Try Again.');
					</script>";
				header("refresh:1; url=https://web.ics.purdue.edu/~g1109686/homepage/forget.html");
}
$conn->close();

?>