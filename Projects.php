<?php
session_start();

if(isset($_SESSION['Username'])){
					$Username=$_SESSION['Username'];}
					
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

//Insert statement - add form info
		$CityName = $_POST['CityName'];
		$State = $_POST['State'];
		$Budget = $_POST['Budget'];
		$DesiredCoverage = $_POST['DesiredCoverage'];
		$Duration = $_POST['Duration'];
		$LATLowBound = $_POST['LATLowBound'];
		$LONGLowBound = $_POST['LONGLowBound'];
		$LATUpBound = $_POST['LATUpBound'];
		$LONGUpBound = $_POST['LONGUpBound'];
		
$sql = "INSERT INTO Projects(CityName, State, Budget, DesiredCoverage, Duration, LATLowBound, LONGLowBound, LATUpBound, LONGUpBound)
VALUES ('$CityName', '$State', '$Budget', '$DesiredCoverage', '$Duration', '$LATLowBound', '$LONGLowBound', '$LATUpBound', '$LONGUpBound')";

//Send Query. Alert user if failed.
	$result = $conn->query($sql);
	if ($conn->error)
	{
		echo "<script> alert('Error: Profile not updated.'); </script>";
	}
	else
	{
	echo "<script> alert('Profile updated!'); </script>";
	echo "<script>window.location = 'owner profile page.php'</script>"; 
	}
	
	
	$conn->close(); 
 ?>