<?php

echo ini_get('display_errors');

if (!ini_get('display_errors')) {
ini_set('display_errors', '1');
}
echo ini_get('display_errors');

include_once 'db.php';

$sensorIDQuery = "SELECT MIN(R.SensorID) as min, MAX(R.SensorID) as max FROM Readings R LIMIT 1";
$startDatesQuery = "SELECT R.DateTime FROM Readings R";
$endDatesQuery = "SELECT R.DateTime FROM Readings R";

$sensorList = mysqli_query($conn, $sensorIDQuery);
$temprow = mysqli_fetch_assoc($sensorList);
// echo "sensor min: '$temprow['min']'";
echo "</br>";
$minSensor =  $temprow['min'];
echo "</br>";
$maxSensor = $temprow['max'];




if(isset($_POST['search'])) {

$sensorIDToSearch = intval($_POST['sensorIDToSearch']);
$startDateToSearch = $_POST['startDateToSearch'];
$endDateToSearch = $_POST['endDateToSearch'];
$zoneToSearch = $_POST['$zoneToSearch'];

//$query = "SELECT * FROM Readings WHERE";
$query = "SELECT R.DateTime, R.SensorID, R.Pressure, R.Humidity, R.Temperature, R.PM2_5, R.PM10, R.PM1, ROUND(F.LAT, 3), ROUND(F.LONGG, 3), F.ZoneType
  FROM Readings R, Fixed_Sensors F WHERE R.SensorID = F.SensorID";

//$useAnd = false;

  if ($sensorIDToSearch > 0) {
 $query .= " AND R.SensorID = $sensorIDToSearch";
 //$useAnd = true;
}
if (strlen($startDateToSearch) > 0) {
 $query .= " AND R.DateTime >= '$startDateToSearch'";
 //$query .= ($useAnd ? ' AND' : '') . " DateTime >= '$startDateToSearch'";
 //$useAnd = true;
}
if (strlen($endDateToSearch) > 0) {
 $query .= " AND R.DateTime <= '$endDateToSearch'";
// $query .= ($useAnd ? ' AND' : '') . " DateTime <= '$endDateToSearch'";
//  $useAnd = true;
}
if (strlen($zoneToSearch) > 0) {
 $query .= " AND F.ZoneType LIKE '$zoneToSearch%'";
// $query .= ($useAnd ? ' AND' : '') . " DateTime <= '$endDateToSearch'";
//  $useAnd = true;
}
$search_result = filterTable($query, $conn);

}



// function to conn and execute the query


function filterTable($query, $conn)
{

// Create connion
$filter_Result = mysqli_query($conn, $query);
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

<form action="Video2.php" method="post">
            Sensor Number <input type="number" name="sensorIDToSearch" placeholder="Sensor ID" min=<?php echo $minSensor;?> max=<?php echo $maxSensor;?>><br><br>
<!--<input type="submit" name="search" value="Search by Sensor"><br><br>-->
            Start Date / Time <input type="datetime" name = "startDateToSearch" placeholder="2017-11-01 06:00:00" /><br><br>
End Date / Time <input type="datetime" name = "endDateToSearch" placeholder="2019-11-01 06:00:00" /><br><br>
Type of Zone <input type="text" name = "$zoneToSearch" placeholder="Rural, Residential" /><br><br>

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
                <?php echo "hello";?>
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
					          <td><?php echo $row['ROUND(F.LAT, 3)'];?></td>
                    <td><?php echo $row['ROUND(F.LONGG, 3)'];?></td>
                    <td><?php echo $row['ZoneType'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>

    </body>
</html>
