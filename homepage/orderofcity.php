<?php
SESSION_START();
include_once 'includes/mysql.php';
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
    <title>Projects of City</title>
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

        thead, tbody { display: block; }

        tbody {
        height: 400px;       /* Just for the demo          */
        overflow-y: auto;    /* Trigger vertical scroll    */
        overflow-x: hidden;  /* Hide the horizontal scroll */
        }
        </style>
 
        <style>
        table,tr,th,td
        {
          border: 1px solid black;
        }
      </style>
      <script>
        var _locations = [];
      </script>
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
  
<?php
//Global Var
$cityID = 0;
$andSENSORID = "";
$andSENSORIDG = "";
$andINIT = "";
$andEND = "";
$type = '1';

//CityID Validation
if (!isset($_GET['cityID'])){
    //Redirect to pastorder if cityID parameter
    header("Location: pastorder.php");
}else{
  $cityID = $_GET['cityID'];
  $querycity = "SELECT CityName, State from Projects where cityID = " . $cityID;
}

if(isset($_POST['search'])) 
{

        $sensorIDToSearch = intval($_POST['sensorIDToSearch']);
        $startDateToSearch = $_POST['startDateToSearch'];
        $endDateToSearch = $_POST['endDateToSearch'];

        if ($sensorIDToSearch > 0) {
          $andSENSORID = " AND R.SensorID = $sensorIDToSearch";
          $andSENSORIDG = " AND SensorID = $sensorIDToSearch";
        }

        if (strlen($startDateToSearch) > 0) {
          $andINIT = " AND DateTime >= '$startDateToSearch'";
        }

        if (strlen($endDateToSearch) > 0) {
          $andEND = " AND DateTime <= '$endDateToSearch'";
        }

        //For the Map

        $querymap = "SELECT DateTime, LAT, LONGG FROM
                    (
                    SELECT SensorID, '' as DateTime, LAT, LONGG, ZoneType, 'Fixed' as TypeSensor FROM Fixed_Sensors
                    UNION
                    SELECT SensorID, DateTime, LAT, LONGG, ZoneType, 'Mobile' as TypeSensor FROM Mobile_Sensors
                    ) as R WHERE 1=1 ".$andSENSORID;
        //echo $querymap;
        $resultmap = mysqli_query($conn, $querymap) or die(mysqli_error($conn));

}

      //For Fixed Table
      $query1 =  "SELECT R.SensorID, R.DateTime as 'Time', R.Temperature, R.Pressure, R.Humidity, R.PM1, R.PM2_5, R.PM10, FS.LAT, FS.LONGG, 'Good' as 'Quality'
      FROM Readings R 
      INNER JOIN Sensors S ON R.SensorID = S.SensorID
      INNER JOIN Fixed_Sensors FS ON FS.SensorID = R.SensorID
      WHERE S.cityID = ".$cityID.$andSENSORID.$andINIT.$andEND;

      //For Mobile Table
      $query2 =  "SELECT R.SensorID, R.DateTime as 'Time', R.Temperature, R.Pressure, R.Humidity, R.PM1, R.PM2_5, R.PM10, MS.LAT, MS.LONGG, 'Good' as 'Quality'
      FROM Readings R 
      INNER JOIN Sensors S ON R.SensorID = S.SensorID
      INNER JOIN Mobile_Sensors MS ON MS.SensorID = R.SensorID
      WHERE S.cityID = ".$cityID.$andSENSORID.$andINIT.$andEND;

      //Sensor Type 
      if(isset($_POST['type'])) 
      {
        $column = $_POST['type']; // Take the column name, table Readings
      }  else {
        $column = 'Temperature'; //If Sensor Type is null Then Temperature is the default
      }

      // Pending Group by Month:: ANDY
      $chartQuery = "SELECT " . $column. ", UNIX_TIMESTAMP(DATE_FORMAT(DateTime, '%Y-%m-%d 00:00:00')) AS DateTime FROM Readings WHERE 1=1 ".$andSENSORIDG.$andINIT.$andEND." GROUP BY UNIX_TIMESTAMP(DATE_FORMAT(DateTime, '%Y-%m-%d 00:00:00')) ORDER BY DateTime";
      
      //Graph Type Filter
      if(isset($_POST['gtype'])) 
      {
        if (isset($_POST['gtype']) == 'avg')
        {
            $chartQuery = "SELECT AVG(". $column.") as ".$column.",  UNIX_TIMESTAMP(DATE_FORMAT(DateTime, '%Y-%m-%d 00:00:00')) AS DateTime FROM Readings WHERE 1=1 ".$andSENSORIDG.$andINIT.$andEND." GROUP BY UNIX_TIMESTAMP(DATE_FORMAT(DateTime, '%Y-%m-%d 00:00:00')) ORDER BY DateTime";
        }
      }
    
      //echo $chartQuery;

      $result = mysqli_query($conn, $chartQuery) or die(mysqli_error($conn));

      $rows = array();
      $table = array();
      $table['cols'] = array(array( 'label' => 'Date Time', 'type' => 'datetime'),
      array('label' => $column,'type' => 'number'));

      while($row = mysqli_fetch_array($result))
      {
      $sub_array = array();
      $DateTime = explode(".", $row["DateTime"]);
      $sub_array[] =  array(
            "v" => 'Date(' . $DateTime[0] . '000)'
          );
      $sub_array[] =  array(
            "v" => $row[$column]
          );
      $rows[] =  array(
          "c" => $sub_array
          );
      }
      $table['rows'] = $rows;
      $jsonTable = json_encode($table);

?>
<form action="orderofcity.php?cityID=<?php echo $cityID?>" method="post">
Sensor Number <input type="text" name="sensorIDToSearch" placeholder="Sensor ID"><br><br>
<!--<input type="submit" name="search" value="Search by Sensor"><br><br>-->
Start Date / Time <input type="datetime" name = "startDateToSearch" placeholder="2017-11-01 06:00:00" /><br><br>
End Date / Time <input type="datetime" name = "endDateToSearch" placeholder="2019-11-01 06:00:00" /><br><br>
Sensor Type <select name="type">
  <option value="Temperature" selected>Temperature</option>
  <option value="Pressure">Pressure</option>
  <option value="Humidity">Humidity</option>
  <option value="PM1">PM 1</option>
  <option value="PM2_5">PM 2.5</option>
  <option value="PM10">PM 10</option>
</select><br><br>
Graph Type   <select name="gtype">
  <option value="detail" selected>Detail</option>
  <option value="avg">Average</option>
</select><br><br>
<!--<input type="submit" name="datesearch" value="Search by Date"><br><br>-->
<input type="submit" name="search" value="Search"><br><br>
<p>Filtros aplicados: </p> 
<?php
if(isset($_POST['sensorIDToSearch'])) { echo $_POST['sensorIDToSearch'].'<br/>'; }
if(isset($_POST['sensorIDToSearch'])) { echo $_POST['startDateToSearch'].'<br/>'; }
if(isset($_POST['sensorIDToSearch'])) { echo $_POST['endDateToSearch'].'<br/>'; }
if(isset($_POST['sensorIDToSearch'])) { echo $_POST['type'].'<br/>'; }
if(isset($_POST['sensorIDToSearch'])) { echo $_POST['gtype'].'<br/>'; }
?>
          <?php 
          $resultCity = mysqli_query($conn, $querycity) or die(mysqli_error($conn));
          $rowcity = $resultCity->fetch_array(MYSQLI_ASSOC);
          ?>
          <h1 style="text-align:center;"><?php echo $rowcity['CityName']; ?> - <?php echo $rowcity['State']; ?></h1>
          <?php 
          //echo  $query1;
          $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
          ?>
          <div id="map"></div>
          <div class="page-wrapper">
          <br />
            <div id="line_chart" style="width: 100%; height: 500px"></div>
          </div>
          <h2 class="sub-header">Air Quality Monitoring from Fixed Sensors</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
              </thead>
              <tbody>
              <tr>
                  <td class="text-center">Fixed Sensor ID</th> 
                  <td class="text-center">Date and Time</th>
                  <td class="text-center">Temperature (°C)</th>
                  <td class="text-center">Pressure (hPa)</th>
                  <td class="text-center">Humidity (%)</th>
                  <td class="text-center">PM1</th>
                  <td class="text-center">PM2.5</th>
                  <td class="text-center">PM10</th>
                  <td class="text-center">Latitude</th>
                  <td class="text-center">Longitude</th>
                  <td class="text-center">Air Quality Performance</th>
                </tr>
                <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($result1)) { ?>
                <tr>
                  <td><?php echo $row['SensorID'];?></td>
                  <td><?php echo $row['Time'];?></td>
                  <td><?php echo $row['Pressure'];?></td>
                  <td><?php echo $row['Humidity'];?></td>
                  <td><?php echo $row['Temperature'];?></td>
                  <td><?php echo $row['PM2_5'];?></td>
                  <td><?php echo $row['PM10'];?></td>
                  <td><?php echo $row['PM1'];?></td>
                  <td><?php echo $row['LAT'];?></td>
                  <td><?php echo $row['LONGG'];?></td>
                  <td><?php echo $row['Quality'];?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
          </div>
      
          <?php 
          //echo  $query2;
          $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
          ?>
		      <h2 class="sub-header">Air Quality Monitoring from Mobile Sensors</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
              </thead>
              <tbody>
              <tr>
                  <td class="text-center">Mobile Sensor ID</th> 
                  <td class="text-center">Date and Time</th>
                  <td class="text-center">Temperature (°C)</th>
                  <td class="text-center">Pressure (hPa)</th>
                  <td class="text-center">Humidity (%)</th>
                  <td class="text-center">PM1</th>
                  <td class="text-center">PM2.5</th>
                  <td class="text-center">PM10</th>
                  <td class="text-center">Latitude</th>
                  <td class="text-center">Longitude</th>
                  <td class="text-center">Air Quality Performance</th>
                </tr>
                   <?php while($row = mysqli_fetch_array($result2)) { ?>
                   <tr>
                      <td><?php echo $row['SensorID'];?></td>
                      <td><?php echo $row['Time'];?></td>
                      <td><?php echo $row['Pressure'];?></td>
                      <td><?php echo $row['Humidity'];?></td>
                      <td><?php echo $row['Temperature'];?></td>
                      <td><?php echo $row['PM2_5'];?></td>
                      <td><?php echo $row['PM10'];?></td>
                      <td><?php echo $row['PM1'];?></td>
                      <td><?php echo $row['LAT'];?></td>
                      <td><?php echo $row['LONGG'];?></td>
                      <td><?php echo $row['Quality'];?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
		  
        </div>
      </div>
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

    function initMap() {
      _locations = [
      <?php while($rowmap = mysqli_fetch_array($resultmap)) {?>
        ['<?php echo $rowmap['DateTime'] ?>', <?php echo $rowmap['LAT'] ?>, <?php echo $rowmap['LONGG'] ?>],
      <?php } ?>
      ];
      var locations = _locations;

      var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(locations[0][1], locations[0][2]),
        zoom: 10
      });
      var infoWindow = new google.maps.InfoWindow();

      var marker, i;

      for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infoWindow.setContent(locations[i][0]);
          infoWindow.open(map, marker);
        }
        })(marker, i));
      }

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

  </body>
</html>
