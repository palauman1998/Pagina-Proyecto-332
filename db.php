<?php session_start();

//Database Connection Credentials
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";

/*$servername = "localhost";
$username = "root";
$password = "puntonet";
$dbname = "pagina";*/

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
die('Connection Failed : '.$conn->connect_error);
}
?>



