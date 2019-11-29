<?php

//INTEGRATE TABLE 

/* SELECT R.DateTime, R.SensorID, R.Pressure, R. Humidity, R.Temperature, R.PM2_5, R.PM10, R.PM1, ROUND(F.LAT, 3), ROUND(F.LONGG, 3)
FROM Readings R, Fixed_Sensors F
WHERE R.SensorID = 1 AND R.SensorID = F.SensorID  */

/* SELECT P.CityID, P. CityName, P.Budget, P.Duration, COUNT(F.SensorID), P.StartDate
FROM Projects P, Fixed_Sensors F, Sensors S
WHERE P.CityID = S.CityID AND S.SensorID = F.SensorID AND P.CityID = 2 */

if(isset($_POST['search'])) {

$sensorIDToSearch = intval($_POST['sensorIDToSearch']);
$startDateToSearch = $_POST['startDateToSearch'];
$endDateToSearch = $_POST['endDateToSearch'];

$query = "SELECT * FROM Readings WHERE";
$useAnd = false;

  if ($sensorIDToSearch > 0) {
 $query .= " SensorID = $sensorIDToSearch";
 $useAnd = true;
}
if (strlen($startDateToSearch) > 0) {
 $query .= ($useAnd ? ' AND' : '') . " DateTime >= '$startDateToSearch'";
 $useAnd = true;
}
if (strlen($endDateToSearch) > 0) {
 $query .= ($useAnd ? ' AND' : '') . " DateTime <= '$endDateToSearch'";
  $useAnd = true;
}
$search_result = filterTable($query);

}



// function to connect and execute the query


function filterTable($query)
{


$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";



// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP HTML TABLE DATA SEARCH</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>

        <form action="Video.php" method="post">
            Sensor Number <input type="text" name="sensorIDToSearch" placeholder="Sensor ID"><br><br>
<!--<input type="submit" name="search" value="Search by Sensor"><br><br>-->
            Start Date / Time <input type="datetime" name = "startDateToSearch" placeholder="2017-11-01 06:00:00" /><br><br>
End Date / Time <input type="datetime" name = "endDateToSearch" placeholder="2019-11-01 06:00:00" /><br><br>
<!--<input type="submit" name="datesearch" value="Search by Date"><br><br>-->
<input type="submit" name="search" value="Search"><br><br>


<?php
if (strlen($query)>0) echo "<p>The SQL query is: '$query'</p>";
?>
            <table>
                <tr>
                    <th>Date and Time</th>
                    <th>Sensor ID</th>
                    <th>Pressure in hPa</th>
                    <th>Humidity (%)</th>
					<th>Temperature (C)</th>
                    <th>PM 2.5</th>
                    <th>PM 10</th>
                    <th>PM 1</th> 
					<th>Latitude</th>
                    <th>Longitude</th>
                    <th>Status</th>

                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['DateTime'];?></td>
                    <td><?php echo $row['SensorID'];?></td>
                    <td><?php echo $row['Pressure'];?></td>
                    <td><?php echo $row['Humidity'];?></td>
<td><?php echo $row['Temperature'];?></td>
                    <td><?php echo $row['PM2_5'];?></td>
                    <td><?php echo $row['PM10'];?></td>
                    <td><?php echo $row['PM1'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>

    </body>
</html>