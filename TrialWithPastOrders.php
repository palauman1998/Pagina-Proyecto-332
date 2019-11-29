<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";



// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
//$Area = 100;
$sql = "SELECT P.CityID, P.CityName, P.Budget, P.Duration, COUNT( F.SensorID ) , COUNT( M.SensorID ) , P.StartDate FROM Projects P, Fixed_Sensors F, Mobile_Sensors M WHERE P.CityID =1";
$sql2 = "SELECT P.CityID, P.CityName, P.Budget, P.Duration, COUNT( F.SensorID ) , COUNT( M.SensorID ) , P.StartDate FROM Projects P, Fixed_Sensors F, Mobile_Sensors M WHERE P.CityID =2";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>Project ID</th>";
                echo "<th>City</th>";
                //echo "<th>Total Area</th>";
				echo "<th>Budget</th>";
                echo "<th>Duration</th>";
                echo "<th>Number of Fixed Sensors</th>";
				echo "<th>Number of Mobile Sensors</th>";
                echo "<th>Start Date</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['CityID'] . "</td>";
                echo "<td>" . $row['CityName'] . "</td>";
                echo "<td>" . $row['Budget'] . "</td>";
				echo "<td>" . $row['Duration'] . "</td>";
                echo "<td>" . $row['SensorID'] . "</td>";
                echo "<td>" . $row['SensorID'] . "</td>";
				echo "<td>" . $row['StartDate'] . "</td>";
             
            echo "</tr>";
        }
        echo "</table>";
        // Close result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} elseif($result = mysqli_query($link, $sql2)){
	echo "<th>Yep</th>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>