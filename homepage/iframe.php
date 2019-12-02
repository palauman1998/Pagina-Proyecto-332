<?php
SESSION_START();
?>
<?php
$FName = $_SESSION['FName'];
$LName = $_SESSION['LName'];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Projects of Atlanta</title>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="orders.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="ie-emulation-modes-warning.js"></script>
		    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
		width: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Skyline</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
			<a class="nav-link" ><?php echo $FName;?> <?php echo " ";?><?php echo $LName;?></a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="homepage.php">Homepage </a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="aboutus.php">Contact Us</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="pastorder.php">Past Orders</a>
			</li>
			<li class="nav-item">
			<a id="logoutbutton" class="nav-link" href="logout.php">Log Out</a>
			</li>
		</ul>
	  </div>
	</nav>


  <div class="container1">
  <center>
        <h1 class="page-header">Projects of Los Angeles</h1>
        </div>

<?php

$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";



// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);
$mobile_query = "SELECT DateTime, LAT, LONGG, ZoneType, M.SensorID FROM Mobile_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID WHERE S.CityID = 1";
$mobile_result = mysqli_query($connect, $mobile_query);
$mobile_readings = "SELECT M.DateTime, LAT, LONGG, ZoneType, R.SensorID, ROUND(Pressure, 2) as Pressure, ROUND(Humidity, 2) as Humidity, ROUND(Temperature, 2) as Temperature, ROUND(PM2_5, 2) as PM2_5, ROUND(PM10, 2) as PM10, ROUND(PM1, 2) as PM1 FROM Mobile_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID INNER JOIN Readings R ON M.SensorID = R.SensorID WHERE S.CityID = 1 LIMIT 30";
$mobile_readings_result = mysqli_query($connect, $mobile_readings);
$fixed_readings = "SELECT R.DateTime, LAT, LONGG, ZoneType, R.SensorID, ROUND(Pressure, 2) as Pressure, ROUND(Humidity, 2) as Humidity, ROUND(Temperature, 2) as Temperature, ROUND(PM2_5, 2) as PM2_5, ROUND(PM10, 2) as PM10, ROUND(PM1, 2) as PM1 FROM Fixed_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID INNER JOIN Readings R ON M.SensorID = R.SensorID WHERE S.CityID = 1 LIMIT 30";
$fixed_readings_result = mysqli_query($connect, $fixed_readings);

if(isset($_POST['search']))
{

$valueToSearch = $_POST['sensorIDToSearch'];
$startDateToSearch = $_POST['startDateToSearch'];
$endDateToSearch = $_POST['endDateToSearch'];
$metric = $_POST['metric'];
echo "$metric";

  // search in all table columns
  // using concat mysql function

$query = "SELECT DateTime, R.SensorID, ROUND(Pressure, 2) as Pressure, ROUND(Humidity, 2) as Humidity, ROUND(Temperature, 2) as Temperature, ROUND(PM2_5, 2) as PM2_5, ROUND(PM10, 2) as PM10, ROUND(PM1, 2) as PM1 FROM Readings R INNER JOIN Sensors S ON R.SensorID = S.SensorID WHERE S.CityID = 1";
$fixedSensorQuery = "SELECT * FROM Fixed_Sensors F INNER JOIN Sensors S ON F.SensorID = S.SensorID WHERE S.CityID = 1";
$chartQuery = "SELECT $metric, UNIX_TIMESTAMP(CONCAT_WS('',DateTime)) AS DateTime FROM Readings R INNER JOIN Sensors S ON R.SensorID = S.SensorID WHERE S.CityID = 1";
if (strlen($valueToSearch) > 0) {
  $query .= " AND R.SensorID = $valueToSearch";
  $chartQuery .= " AND R.SensorID = $valueToSearch";

}

if (strlen($startDateToSearch) > 0) {
 $query .= " AND R.DateTime >= '$startDateToSearch'";
 $chartQuery .= " AND R.DateTime >= '$startDateToSearch'";
 //$query .= ($useAnd ? ' AND' : '') . " DateTime >= '$startDateToSearch'";
 //$useAnd = true;
}
if (strlen($endDateToSearch) > 0) {
 $query .= " AND R.DateTime <= '$endDateToSearch'";
 $chartQuery .= " AND R.DateTime <= '$endDateToSearch'";
// $query .= ($useAnd ? ' AND' : '') . " DateTime <= '$endDateToSearch'";
//  $useAnd = true;
}

$chartQuery .= " ORDER BY DateTime DESC";

$fixedSensorQueryResult = mysqli_query($connect, $fixedSensorQuery);
$search_result = filterTable($query, $connect);


$result = mysqli_query($connect, $chartQuery);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'Date Time',
  'type' => 'datetime'
 ),
 array(
  'label' => $metric,
  'type' => 'number'
 )
);
while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $DateTime = explode(".", $row["DateTime"]);
 $sub_array[] =  array(
      "v" => 'Date(' . $DateTime[0] . '000)'
     );
 $sub_array[] =  array(
      "v" => $row[$metric]
     );
 $rows[] =  array(
     "c" => $sub_array
    );
}
$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo '<script type="text/javascript">',
   'drawChart();',
   '</script>';





}


if(isset($_POST['datesearch'])){

$dateToSearch = $_POST['dateToSearch'];
  // search in all table columns
  // using concat mysql function

$queryData = "SELECT * FROM Readings WHERE DateTime LIKE $dateToSearch";
  $search_result = filterTable($queryData, $connect);


}



// function to connect and execute the query


function filterTable($query, $connect)
{

  $filter_Result = mysqli_query($connect, $query);
  return $filter_Result;
}


if(isset($_POST['mobileDate'])){
  $date = $_POST['mobileDate'];
  $mobile_time_query = "SELECT DateTime, LAT, LONGG, ZoneType, M.SensorID FROM Mobile_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID WHERE S.CityID = 1 AND DateTime = '$date'";
  $mobile_time_result = mysqli_query($connect, $mobile_time_query);
  echo $date;

  // while($row = mysqli_fetch_array($mobile_time_result)):
  //   echo $row['DateTime'];
  // endwhile;



}

?>

<form action="orderofla.php" method="post">
          Sensor Number <input type="text" name="sensorIDToSearch" placeholder="Sensor ID"><br><br>
<!--<input type="submit" name="search" value="Search by Sensor"><br><br>-->
          Start Date / Time <input type="datetime" name = "startDateToSearch" placeholder="2017-11-01 06:00:00" /><br><br>
End Date / Time <input type="datetime" name = "endDateToSearch" placeholder="2019-11-01 06:00:00" /><br><br>
Select Metric: <select name="metric">
  <option value="Temperature">Temperature</option>
  <option value="Pressure">Pressure</option>
  <option value="Humidity">Humidity</option>
  <option value="PM2_5">PM2_5</option>
  <option value="PM10">PM10</option>
  <option value="PM1">PM1</option>
</select>
<!--<input type="submit" name="datesearch" value="Search by Date"><br><br>-->
<input type="submit" name="search" value="Search" onclick="drawChart();"><br><br>
</form>
<div class="container2">


<form action="orderofla.php" name="exmType" method = "POST">
<select name="mobileDate"  method = "post" onChange="this.form.submit();">
  <?php while($row = mysqli_fetch_array($mobile_result)):?>
    <option value="<?php echo $row['DateTime']; ?>"><?php echo $row['DateTime']; ?></option>
  <?php endwhile;?>

</select>
</form>
<div id="map"></div>
<style>
.page-wrapper
{
 width:1000px;
 margin:0 auto;
}
</style>

<div class="page-wrapper">
 <br />
 <div id="line_chart" style="width: 100%; height: 500px"></div>
</div>

</div>


<script>
var customLabel = {
restaurant: {
label: 'R'
},
bar: {
label: 'B'
}
};

var map;

function initMap() {
map = new google.maps.Map(document.getElementById('map'), {
center: new google.maps.LatLng(34.0522, -118.2437),
zoom: 12
});
var infoWindow = new google.maps.InfoWindow;

// Change this depending on the name of your PHP or XML file
downloadUrl('https://web.ics.purdue.edu/~mpalau/homepage/DatabasePlotting.php', function(data) {
  var xml = data.responseXML;
  var markers = xml.documentElement.getElementsByTagName('marker');
  Array.prototype.forEach.call(markers, function(markerElem) {
    var id = markerElem.getAttribute('SensorID');
    var type = markerElem.getAttribute('ZoneType');
    var point = new google.maps.LatLng(
        parseFloat(markerElem.getAttribute('LAT')),
        parseFloat(markerElem.getAttribute('LONGG')));

    var infowincontent = document.createElement('div');
    var strong = document.createElement('strong');
    strong.textContent = id
    infowincontent.appendChild(strong);
    infowincontent.appendChild(document.createElement('br'));

    var text = document.createElement('text');
    text.textContent = type;
    infowincontent.appendChild(text);
    var icon = customLabel[type] || {};
    var marker = new google.maps.Marker({
      map: map,
      position: point,
      label: icon.label
    });
    marker.addListener('click', function() {
      infoWindow.setContent(infowincontent);
      infoWindow.open(map, marker);
    });
  });
});


//iterate through the mobileSensors in the CITY
//and call the addMarkers function below to create a marker for each mobileSensor
<?php while($row = mysqli_fetch_array($mobile_time_result)):?>
  addMarkers(<?php echo $row['SensorID'];?>, <?php echo $row['LAT'];?>, <?php echo $row['LONGG'];?>, '<?php echo $row['ZoneType'];?>' );

<?php endwhile;?>

//defining addMarkers function
//Parameters: SensorID, Latitude, Longitude, ZoneType
//Return: Void
//Purpose: Plot Mobile Sensors on map
function addMarkers(sensorid, lat,longg, zone ){


var count = 0;
var id = sensorid;
var type = zone;
var point = new google.maps.LatLng(
  lat,
    longg);

//for debugging purposes–– checks if the data changes and if it is correct
console.log("id: ", id);
console.log("type: ", type);
console.log("LAT: ", lat);
console.log("LONGG: ", longg);

//creates a div for the name of the point
var infowincontent = document.createElement('div');
var strong = document.createElement('strong');

//set name of point to the SensorID
strong.textContent = id;
infowincontent.appendChild(strong);
infowincontent.appendChild(document.createElement('br'));

//creates a a section for the text of the description
var text = document.createElement('text');

//set the description to the ZoneType
text.textContent = type
infowincontent.appendChild(text);
var icon = customLabel[type] || {};

//set marker to the global map variable
//add point to the tuple of latitude and longitude for the specific point
var marker = new google.maps.Marker({
  map: map,
  position: point,
  label: icon.label
});

//add listener so when point is clicked it shows the description created above
marker.addListener('click', function() {
  infoWindow.setContent(infowincontent);
  infoWindow.open(map, marker);
}, {passive: true});

console.log("count", ++count);

}

// console.log("count", count);


}





function downloadUrl(url, callback) {
var request = window.ActiveXObject ?
  new ActiveXObject('Microsoft.XMLHTTP') :
  new XMLHttpRequest;

request.onreadystatechange = function() {
if (request.readyState == 4) {
  request.onreadystatechange = doNothing;
  callback(request, request.status);
}
};

request.open('GET', url, true);
request.send(null);
}

function doNothing() {}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhA8Bp64rAxY8sI9csYliM4roB030DLs&callback=initMap">  </script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart()
{
var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

var options = {
 title:'Sensors Data',
 legend:{position:'bottom'},
 chartArea:{width:'90%', height:'65%'}
};

var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

chart.draw(data, options);
}
</script>
<style>
.page-wrapper
{
width:700px;
margin:0 auto;
}

.container2{
float: right;
}

.container3{
float: left;
width: 50%;
}
</style>


<div class="container3">


<?php
if (strlen($query)>0){ echo "<p>The SQL query is: '$query'</p>";
                     echo "<p>The SQL query is: '$chartQuery'</p>";
}
?>
          <!-- <table>
              <tr>
                  <th>Date and Time</th>
                  <th>Sensor ID</th>
                  <th>Pressure in hPa</th>
                  <th>Humidity (%)</th>
        <th>Temperature (C)</th>
                  <th>PM 2.5</th>
                  <th>PM 10</th>
                  <th>PM 1</th>

              </tr> -->

    <!-- populate table from mysql database -->
              <!-- <?php while($row = mysqli_fetch_array($search_result)):?>
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
          </table> -->




       <h2 class="sub-header">Air Quality Monitoring from Fixed Sensors</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <th class="text-center">Fixed Sensor ID</th>
             <th class="text-center">Date</th>
               <th class="text-center">Sensor Latitude</th>
                       <th class="text-center">Sensor Longitude</th>
                       <th class="text-center">Temperature</th>
                       <th class="text-center">Pressure</th>
                       <th class="text-center">Humidity</th>
                       <th class="text-center">PM1</th>
                       <th class="text-center">PM2.5</th>
                       <th class="text-center">PM10</th>
                       <!-- <th class="text-center">Air Quality Performance</th> -->
                     </tr>
                   </thead>
                   <tbody>
                   <?php while($row = mysqli_fetch_array($fixed_readings_result)):?>
                        <tr>
                       <th class="text-center table-light text-dark"><?php echo $row['SensorID'];?></th>
                       <td class="text-center text-dark"><?php echo $row['DateTime'];?></td>
                <td class="text-center text-dark"><?php echo $row['LAT'];?></td>
                 <td class="text-center text-dark"><?php echo $row['LONGG'];?></td>
                       <td class="text-center text-dark"><?php echo $row['Temperature'];?></td>
                <td class="text-center text-dark"><?php echo $row['Pressure'];?></td>
                 <td class="text-center text-dark"><?php echo $row['Humidity'];?></td>
                <td class="text-center text-dark"><?php echo $row['PM1'];?></td>
                       <td class="text-center text-dark"><?php echo $row['PM2_5'];?></td>
                       <td class="text-center text-dark"><?php echo $row['PM10'];?></td>
                       <!-- <td class="text-center text-dark"> <?php echo $row['SensorID'];?></td> -->
                     </tr>
                       <?php endwhile;?>

                   </tbody>
                 </table>
        </div>

        <h2 class="sub-header">Air Quality Monitoring from Mobile Sensors</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
       <th class="text-center">Mobile Sensor ID</th>
      <th class="text-center">Date</th>
        <th class="text-center">Sensor Latitude</th>
                <th class="text-center">Sensor Longitude</th>
                <th class="text-center">Temperature</th>
                <th class="text-center">Pressure</th>
                <th class="text-center">Humidity</th>
                <th class="text-center">PM1</th>
                <th class="text-center">PM2.5</th>
                <th class="text-center">PM10</th>
                <!-- <th class="text-center">Air Quality Performance</th> -->
              </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($mobile_readings_result)):?>
                 <tr>
                <th class="text-center table-light text-dark"><?php echo $row['SensorID'];?></th>
                <td class="text-center text-dark"><?php echo $row['DateTime'];?></td>
         <td class="text-center text-dark"><?php echo $row['LAT'];?></td>
          <td class="text-center text-dark"><?php echo $row['LONGG'];?></td>
                <td class="text-center text-dark"><?php echo $row['Temperature'];?></td>
         <td class="text-center text-dark"><?php echo $row['Pressure'];?></td>
          <td class="text-center text-dark"><?php echo $row['Humidity'];?></td>
         <td class="text-center text-dark"><?php echo $row['PM1'];?></td>
                <td class="text-center text-dark"><?php echo $row['PM2_5'];?></td>
                <td class="text-center text-dark"><?php echo $row['PM10'];?></td>
                <!-- <td class="text-center text-dark"> <?php echo $row['SensorID'];?></td> -->
              </tr>
                <?php endwhile;?>

            </tbody>
          </table>
        </div>

      </div>
    </div>
 </div>
  </div>
</div>

 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js'></script>
 <script src="script.js"></script>
  </section>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  <script src="holder.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="ie10-viewport-bug-workaround.js"></script>
</body>
</html>
