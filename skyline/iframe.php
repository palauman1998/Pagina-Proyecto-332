<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="orders.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="ie-emulation-modes-warning.js"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
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

<?php

include_once 'includes/mysql.php';


$mobile_query = "SELECT DateTime, LAT, LONGG, ZoneType, M.SensorID FROM Mobile_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID WHERE S.CityID = 1";
$mobile_result = mysqli_query($connect, $mobile_query);
$mobile_readings = "SELECT M.DateTime, LAT, LONGG, ZoneType, R.SensorID, ROUND(Pressure, 2) as Pressure, ROUND(Humidity, 2) as Humidity, ROUND(Temperature, 2) as Temperature, ROUND(PM2_5, 2) as PM2_5, ROUND(PM10, 2) as PM10, ROUND(PM1, 2) as PM1 FROM Mobile_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID INNER JOIN Readings R ON M.SensorID = R.SensorID WHERE S.CityID = 1 LIMIT 30";
$mobile_readings_result = mysqli_query($connect, $mobile_readings);
$fixed_readings = "SELECT R.DateTime, LAT, LONGG, ZoneType, R.SensorID, ROUND(Pressure, 2) as Pressure, ROUND(Humidity, 2) as Humidity, ROUND(Temperature, 2) as Temperature, ROUND(PM2_5, 2) as PM2_5, ROUND(PM10, 2) as PM10, ROUND(PM1, 2) as PM1 FROM Fixed_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID INNER JOIN Readings R ON M.SensorID = R.SensorID WHERE S.CityID = 1 LIMIT 30";
$fixed_readings_result = mysqli_query($connect, $fixed_readings);




if(isset($_POST['mobileDate']))
{
  $date = $_POST['mobileDate'];
  $mobile_time_query = "SELECT DateTime, LAT, LONGG, ZoneType, M.SensorID FROM Mobile_Sensors M INNER JOIN Sensors S ON M.SensorID = S.SensorID WHERE S.CityID = 1 AND DateTime = '$date'";
  $mobile_time_result = mysqli_query($connect, $mobile_time_query);
  //echo $date;
  // while($row = mysqli_fetch_array($mobile_time_result)):
  //   echo $row['DateTime'];
  // endwhile;
  }
?>

<div class="container2">


<form action="iframe.php" name="exmType" method = "POST">
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

      <div class="container3">
      </div>
    </div>
 </div>
  </div>
</div>

 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js'></script>
 <script src="js/script.js"></script>
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
