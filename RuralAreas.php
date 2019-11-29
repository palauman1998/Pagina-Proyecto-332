<?php session_start();



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
$LATLowBound = $_POST['LATLowBound'];
$LONGLowBound = $_POST['LONGLowBound'];
$LATUpBound = $_POST['LATUpBound'];
$LONGUpBound = $_POST['RoutingNumber'];

$sql2 = "SELECT MAX(CityID) from Projects";
$sql = "INSERT INTO RuralAreas(CityID, LATLowBound, LONGLowBound, LATUpBound, LONGUpBound)
VALUES ('$sql2', '$LATLowBound', '$LONGLowBound', '$LATUpBound', '$LONGUpBound')";

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