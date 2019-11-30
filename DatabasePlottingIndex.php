<!DOCTYPE html >
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
        width: 700px;
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

        <!-- <div id="map"></div> -->

    <!-- <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(39.73715, -104.989174),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://web.ics.purdue.edu/~g1109686/DatabasePlotting.php', function(data) {
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
              text.textContent = type
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhA8Bp64rAxY8sI9csYliM4roB030DLs&callback=initMap">  </script> -->

		<div class="container1">
		<center>
          <h1 class="page-header">Projects of Denver</h1>
          </div>

<?php

include_once 'db.php';



if(isset($_POST['search']))
{

	$valueToSearch = $_POST['sensorIDToSearch'];
    // search in all table columns
    // using concat mysql function

	$query = "SELECT DateTime, SensorID, ROUND(Pressure, 2) as Pressure, ROUND(Humidity, 2) as Humidity, ROUND(Temperature, 2) as Temperature, ROUND(PM2_5, 2) as PM2_5, ROUND(PM10, 2) as PM10, ROUND(PM1, 2) as PM1  FROM Readings WHERE SensorID = $valueToSearch";
  $fixedSensorQuery = "SELECT * FROM Fixed_Sensors F INNER JOIN Sensors S ON F.SensorID = S.SensorID WHERE S.CityID = 2";
  $fixedSensorQueryResult = mysqli_query($conn, $fixedSensorQuery);
  $search_result = filterTable($query, $conn);
  $chartQuery = "SELECT Temperature, UNIX_TIMESTAMP(CONCAT_WS('',DateTime)) AS DateTime FROM Readings WHERE SensorID = $valueToSearch ORDER BY DateTime DESC";

  $result = mysqli_query($conn, $chartQuery);
  $rows = array();
  $table = array();

  $table['cols'] = array(
   array(
    'label' => 'Date Time',
    'type' => 'datetime'
   ),
   array(
    'label' => 'Temperature (°C)',
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
        "v" => $row["Temperature"]
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
    $search_result = filterTable($queryData, $conn);


}



// function to conn and execute the query


function filterTable($query, $conn)
{

    $filter_Result = mysqli_query($conn, $query);
    return $filter_Result;
}

?>

<form action="DatabasePlottingIndex.php" method="post">
            Sensor Number <input type="text" name="sensorIDToSearch" placeholder="Sensor ID"><br><br>
<!--<input type="submit" name="search" value="Search by Sensor"><br><br>-->
            Start Date / Time <input type="datetime" name = "startDateToSearch" placeholder="2017-11-01 06:00:00" /><br><br>
End Date / Time <input type="datetime" name = "endDateToSearch" placeholder="2019-11-01 06:00:00" /><br><br>
<!--<input type="submit" name="datesearch" value="Search by Date"><br><br>-->
<input type="submit" name="search" value="Search" onclick="drawChart();"><br><br>
<div class="container2">
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

function initMap() {
var map = new google.maps.Map(document.getElementById('map'), {
  center: new google.maps.LatLng(39.73715, -104.989174),
  zoom: 12
});
var infoWindow = new google.maps.InfoWindow;

  // Change this depending on the name of your PHP or XML file
  downloadUrl('https://web.ics.purdue.edu/~g1109686/DatabasePlotting.php', function(data) {
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
      text.textContent = type
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



         /*  <h2 class="sub-header">Air Quality Monitoring from Fixed Sensors</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
         <th class="text-center">Fixed Sensor ID</th>
				<th class="text-center">Date and Time</th>
                  <th class="text-center">Temperature (°C)</th>
                  <th class="text-center">Pressure (hPa)</th>
                  <th class="text-center">Humidity (%)</th>
                  <th class="text-center">PM1</th>
                  <th class="text-center">PM2.5</th>
                  <th class="text-center">PM10</th>
				  <th class="text-center">Latitude</th>
                  <th class="text-center">Longitude</th>
                  <th class="text-center">Air Quality Performance</th>
                </tr>
              </thead>
              <tbody>
                   <tr>
                  <th class="text-center table-light text-dark">1</th>
                  <td class="text-center text-dark">2018/10/25 01:00</td>
				    <td class="text-center text-dark">10</td>
                  <td class="text-center text-dark">20</td>
				   <td class="text-center text-dark">10</td>
				    <td class="text-center text-dark">5</td>
					 <td class="text-center text-dark">30</td>
                  <td class="text-center text-dark">10</td>
                  <td class="text-center text-dark">10</td>
                  <td class="text-center text-dark">110</td>
                  <td class="text-center text-dark"> Good</td>
                </tr>

              </tbody>
			   <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['SensorID'];?></td>
                    <td><?php echo $row['DateTime'];?></td>
                    <td><?php echo $row['Temperature'];?></td>
                    <td><?php echo $row['Pressure'];?></td>
					<td><?php echo $row['Humidity'];?></td>
                    <td><?php echo $row['PM1'];?></td>
                    <td><?php echo $row['PM2_5'];?></td>
                    <td><?php echo $row['PM10'];?></td>
                </tr>
                <?php endwhile;?>

            </table>
          </div>

		      <h2 class="sub-header">Air Quality Monitoring from Mobile Sensors</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
         <th class="text-center">Mobile Sensor ID</th>
				<th class="text-center">Date</th>
                  <th class="text-center">Time</th>
				  <th class="text-center">Sensor Latitude</th>
                  <th class="text-center">Sensor Longitude</th>
                  <th class="text-center">Temperature</th>
                  <th class="text-center">Pressure</th>
                  <th class="text-center">Humidity</th>
                  <th class="text-center">PM1</th>
                  <th class="text-center">PM2.5</th>
                  <th class="text-center">PM10</th>
                  <th class="text-center">Air Quality Performance</th>
                </tr>
              </thead>
              <tbody>
                   <tr>
                  <th class="text-center table-light text-dark">1</th>
                  <td class="text-center text-dark">2018/10/25</td>
				   <td class="text-center text-dark">01:00</td>
				    <td class="text-center text-dark">10</td>
                  <td class="text-center text-dark">20</td>
				   <td class="text-center text-dark">10</td>
				    <td class="text-center text-dark">5</td>
					 <td class="text-center text-dark">30</td>
                  <td class="text-center text-dark">10</td>
                  <td class="text-center text-dark">10</td>
                  <td class="text-center text-dark">110</td>
                  <td class="text-center text-dark"> Good</td>
                </tr>

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
