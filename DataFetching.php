<! DOCTYPE html>
<html>
<head>
	<title> Filters in PHP</title>
</head>
<body>

	<form class = "form-horizontal" action = "DataFetching.php" method = "POST">
			<div class="form-group">
				<label class = "col-lg-2 control-label">DateTime</label>
				<div class="col-lg-4">
					<input type = "text" class = "form-control"name = "DateTime" placeholder="Insert time in this manner">
				</div>
			</div>

			<div class="form-group">
				<label class = "col-lg-2 control-label">SensorID</label>
				<div class="col-lg-4">
					<input type = "text" class = "form-control" name = "SensorID">
				</div>
			</div>

			<div class="form-group">
				<label class = "col-lg-2 control-label">LAT</label>
				<div class="col-lg-4">
					<input type = "text" class = "form-control" name = "LAT">
				</div>
			</div>

			<div class="form-group">
				<label class = "col-lg-2 control-label">LONGG</label>
				<div class="col-lg-4">
					<input type = "text" class = "form-control" name = "LONGG">
				</div>
			</div>

			<div class="form-group">
				<label class = "col-lg-2 control-label"></label>
				<div class="col-lg-4">
					<input type = "submit" name = "submit">
				</div>
			</div>
		</form>


		<div class= "row">
			<table>
				<thead>
			  <tr>
					<th>DateTime</th>
					<th>SensorID</th>
					<th>LAT</th>
					<th>LONGG</th>
					<th>Reading</th>
				</tr>
			</thead>


			<tbody>
				<?php
				include("db.php");
				if(isset($_POST['submit'])){
					$DateTime = $_POST['DateTime'];
					$SensorID = $_POST['SensorID'];
					$LAT = $_POST['LAT'];
					$LONGG = $_POST['LONGG'];

					if($DateTime != "" ||$SensorID != ""||$LAT != ""||$LONGG != ""){
						echo $query = "SELECT Readings.DateTime, Readings.SensorID, Fixed_Sensors.LAT, Fixed_Sensors.LONGG, Readings.Humidity
						FROM Readings, Fixed_Sensors
						WHERE Readings.SensorID = '$SensorID' OR Readings.DateTime = '$DateTime' OR Fixed_Sensors.LAT = '$LAT' OR Fixed_Sensors.LONGG = '$LONGG'";
						exit();
						$data = mysqli_query($conn, $query) or die('error');
						if(mysqli_num_rows($data) > 0){
							while ($row = mysqli_fetch_assoc($data)) {
								$DateTime = $row['DateTime'];
								$SensorID = $row['SensorID'];
								$LAT = $row['LAT'];
								$LONGG = $row['LONGG'];
								$Humidity = $row['Humidity'];
								?>
								<tr>
									<td><?php echo $DateTime;?></td>
									<td><?php echo $SensorID;?></td>
									<td><?php echo $LAT;?></td>
									<td><?php echo $LONGG;?></td>
									<td><?php echo $Humidity;?></td>
								</tr>
								<?php
							}
						}else{
							?>
							<tr>
								<td>Records Not Found!</td>
							</tr>
							<?php
						}

				}
				?>
			</tbody>
			</table>
		</div>
	</body>
</html>
