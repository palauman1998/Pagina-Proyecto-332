<html>
  <head>
  <title>Project IE332</title>
  </head>

  <body>
    <h1>Project IE332</h1>

    <h2>Sensor Map</h2>
    <p>Click on a sensor to view data</p>
    <p>[MAP]</p>
    <form action="TemplateTrial.php">
      <p>Sensor ID <input name="sensorID"></p>
      <p><input type="submit" name="submit" value="Perform Search"></p>
      <!-- map-click and form send sensor ID and time variable to server -->
    </form>

<tr>

</tr>
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";


// Create connection
$link = new mysqli($servername, $username, $password, $dbname);

 
 
 if(isset($_POST['submit'])){
  	if(isset($_POST['sensorID'])){
      // Proceed to DB query
      // XXXXX
      $sensorID = $_POST['sensorID'];
      $doQuery = true;
    } else {
      // Something missing. Show error message. Do not do DB query.
      // XXXXX
      echo "<p> Missing sensor ID, start time or end time. Try again.<p>/r/n";
      $doQuery = false;
    }
  }
  
  if ($doQuery = true) {
	$sql = "SELECT * FROM Test WHERE sensor=" .$sensorID;
	$result = $link->query($sql);
// Everything looks okay. Display the results.
	echo "<h2>Database Results</h2>";
    echo "<table>\r\n";
    echo "<th><td>number</td><td>sensor</td><td>day</td><td>time</td><td>zone</td><td>ind</td><td>PM25</td><td>PM10</td><td>PM1</td></th>\r\n";
    while($row = $result->fetch_assoc()) {
      	echo "<tr><td>{$row["num"]}</td><td>{$row["sensor"]}</td><td>{$row["day"]}</td><td>{$row["time"]}</td><td>{$row["zone"]}</td><<td>{$row["ind"]}</td><td>{$row["PM25"]}</td><td>{$row["PM10"]}</td><td>{$row["PM1"]}</td>/tr>\r\n";
    }
    echo "</table>\r\n";	
	  
  
  }
 
 
 
 
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}















// Close connection
mysqli_close($link);
?>
  </body>
</html>