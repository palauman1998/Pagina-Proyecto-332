<?php

// Access MYSQL DB via PHP
// Insert records
// Search for and display records
// DB and tables are already created

$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";
$tablename = "Readings";
//row names: DateTime (datetime),
	//SensorID (double),
	//Pressure (double),
	//Humidity (double),
	//Temperature (double),
	//PM2_5 (double)
	//PM10(double)
	//PM1(double)

// Format for time info:     2017-11-01 06:00:00

?>

<html>
  <head>
  <title>Project IE332</title>
  </head>

  <body>
    <h1>Project IE332</h1>

    <h2>Sensor Map</h2>
    <p>Click on a sensor to view data</p>
    <p>[MAP]</p>
    <form action="TrialIndex.php">
      <p>Sensor ID <input name="sensorID"></p>
      <p>Start Day/Time: [2017-11-01 06:00:00] <input name="startTime"></p>
      <p>Ending Day/Time: [2017-11-01 06:00:00] <input name="endTime"></p>
      <p><input type="submit" name="submit" value="Perform Search"></p>
      <!-- map-click and form send sensor ID and time variable to server -->
    </form>

<?php
// Is there an incoming sensor ID variable?
// If so, lookup that sensor's data for the time in question.
// Display the data in a table to the client.

  // Checking for needed incoming variable to perform DB query
  //if(isset($_POST['submit'])){
  	if(isset($_POST['sensorID']) && (isset($_POST['startTime']) && (isset($_POST['endTime']) ){
      // Proceed to DB query
      // XXXXX
      $sensorID = $_POST['sensorID'];
      $startTime = $_POST['startTime'];
      $endTime = $_POST['endTime'];
      $doQuery = true;
    } else {
      // Something missing. Show error message. Do not do DB query.
      // XXXXX
      echo "<p> Missing sensor ID, start time or end time. Try again.<p>/r/n";
      $doQuery = false;
    }
 // }

  if ($doQuery) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error){
		// will need some massaging to work nicely with html
        die('Connection Failed : '.$conn->connect_error);
	}

    //$sql = "SELECT * FROM $tablename WHERE SensorID=$sensorID AND DateTime >= $startTime AND DateTime <= $endTime';
    // Will need to do a bunch of variable formatting to $startTime and $endTime for proper function
    $sql = "SELECT * FROM Projects WHERE SensorID=$sensorID";
    $result = $conn->query($sql);

	if (!$result) {
    	// Oh no! The query failed.
    	echo "Sorry, the website is experiencing problems.";
    	// Again, do not do this on a public site, but we'll show you how
    	// to get the error information
    	echo "Error: Our query failed to execute and here is why: \n";
    	echo "Query: " . $sql . "\n";
    	echo "Errno: " . $mysqli->errno . "\n";
    	echo "Error: " . $mysqli->error . "\n";
    	exit;
	}

    if ($result->num_rows === 0) {
    	// Oh, no rows! Sometimes that's expected and okay, sometimes
    	// it is not. You decide.
    	echo "We could not find a match Sensor ID $sensorID in the time window. Please try again.";
    	exit;
	}

    // Everything looks okay. Display the results.
	echo "<h2>Database Results</h2>";
    echo "<table>\r\n";
    echo "<th><td>Sensor ID</td><td>Date/Time</td><td>Pressure</td><td>Humidity</td><td>Temperature</td><td>PM2_5</td><td>PM10</td><td>PM1</td></th>\r\n";
    while($row = $result->fetch_assoc()) {
      	echo "<tr><td>{$row["SensorID"]}</td><td>{$row["DateTime"]}</td><td>{$row["Pressure"]}</td><td>{$row["Temperature"]}</td></tr>\r\n";
    }
    echo "</table>\r\n";

    $conn->close();

  }
?>

  </body>
</html>
