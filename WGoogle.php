<?php


// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);



// Opens a connection to a MySQL server

$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
	die('Connection Failed : '.$conn->connect_error);

// Select all the rows in the markers table

$query = "SELECT * FROM Fixed_Sensors WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

//header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("SensorID",$row['SensorID']);
  $newnode->setAttribute("LAT",$row['LAT']);
  $newnode->setAttribute("LONGG", $row['LONGG']);
  $newnode->setAttribute("ZoneType", $row['ZoneType']);
}

echo $dom->saveXML();

$conn->close(); 

?>