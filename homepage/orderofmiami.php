<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Projects of Miami</title>
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
	
	<style>
            table,tr,th,td
            {
                border: 1px solid black;
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
  
<?php

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

//SELECT R.DateTime, R.SensorID, R.Pressure, R.Humidity, R.Temperature, R.PM2_5, R.PM10, R.PM1, F.ZoneType  FROM Readings R, Fixed_Sensors F 
/*
if(isset($_POST['search']))
{

$valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function

$query = "SELECT * FROM Readings WHERE SensorID = $valueToSearch";
    $search_result = filterTable($query);



}
if(isset($_POST['datesearch'])){

//$dateToSearch = $_POST['dateToSearch'];
$startDateToSearch = $_POST['startDateToSearch'];
$endDateToSearch = $_POST['endDateToSearch'];
    // search in all table columns
    // using concat mysql function

//$query = "SELECT * FROM Readings WHERE DateTime LIKE $dateToSearch";
$query = "SELECT * FROM Readings WHERE DateTime >= '$startDateToSearch' AND DateTime <= '$endDateToSearch'";
    $search_result = filterTable($query);


}
*/


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
<form action="orderofmiami.php" method="post">
            Sensor Number <input type="text" name="sensorIDToSearch" placeholder="Sensor ID"><br><br>
<!--<input type="submit" name="search" value="Search by Sensor"><br><br>-->
            Start Date / Time <input type="datetime" name = "startDateToSearch" placeholder="2017-11-01 06:00:00" /><br><br>
End Date / Time <input type="datetime" name = "endDateToSearch" placeholder="2019-11-01 06:00:00" /><br><br>
<!--<input type="submit" name="datesearch" value="Search by Date"><br><br>-->
<input type="submit" name="search" value="Search"><br><br>


<?php
if (strlen($query)>0) echo "<p>The SQL query is: '$query'</p>";
?>
            <h2 class="sub-header">Air Quality Monitoring from Fixed Sensors</h2>
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



         <!--<h2 class="sub-header">Air Quality Monitoring from Fixed Sensors</h2>
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
    </div> */ -->

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
