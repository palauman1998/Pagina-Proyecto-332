
<?php
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>

<!DOCTYPE html>
<html lang="en">
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="ie=edge">
<title>My Google Map for Boston</title>

<style>


#map{
height:400px;
width:100%;
}v 
</style>
</head>
<body>
<h1>My Google Map</h1>
  <div id="map"></div>
<script>
function initMap(){
//map options
var options = {
zoom:8,
center:{lat:42.3601, lng:-71.0589}
}

//new map
var map=new google.maps.Map( document.getElementById('map'), options);

/*
//Add marker
var marker = new google.maps.Marker({
position:{lat:42.4668,lng:-70.9495},
map:map,
icon:'http://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
});

//Add info window
var infowindow= new google.maps.infowindow({
content: '<h1>MA</h1>'
});

marker.addListener('click',function(){
infowindow.open(map,marker);
});
}
*/
addMarker({
coords:{lat:42.4668,lng:-70.9495},
 iconImage:'http://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
 content:'MA'
});
addMarker({coords:{lat:42.4584,lng:-70.9300}});
addMarker({coords:{lat:42.7762,lng:-71.0773}});
//add marker function
function addMarker(props){
var marker = new google.maps.Marker({
position:props.coords,
map:map,
icon:props.iconImage
}); 
//Check for customicon
if(props.iconImage){
//Set icon image
marker.setIcon(props.iconImage);
}

//check content
if(props.content){
var infowindow= new google.maps.infowindow({
content:props.content
});

marker.addListener('click',function(){
infowindow.open(map,marker);
});

}
}

}


/*
   // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      }
      var locations = [
        {lat: -31.563910, lng: 147.154312},
        {lat: -33.718234, lng: 150.363181},
        {lat: -33.727111, lng: 150.371124},
        {lat: -33.848588, lng: 151.209834},
        {lat: -33.851702, lng: 151.216968},
        {lat: -34.671264, lng: 150.863657},
        {lat: -35.304724, lng: 148.662905},
        {lat: -36.817685, lng: 175.699196},
        {lat: -36.828611, lng: 175.790222},
        {lat: -37.750000, lng: 145.116667},
        {lat: -37.759859, lng: 145.128708},
        {lat: -37.765015, lng: 145.133858},
        {lat: -37.770104, lng: 145.143299},
        {lat: -37.773700, lng: 145.145187},
        {lat: -37.774785, lng: 145.137978},
        {lat: -37.819616, lng: 144.968119},
        {lat: -38.330766, lng: 144.695692},
        {lat: -39.927193, lng: 175.053218},
        {lat: -41.330162, lng: 174.865694},
        {lat: -42.734358, lng: 147.439506},
        {lat: -42.734358, lng: 147.501315},
        {lat: -42.735258, lng: 147.438000},
        {lat: -43.999792, lng: 170.463352}
      ]
	  */

</script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhA8Bp64rAxY8sI9csYliM4roB030DLs&callback=initMap">
    </script>

<?php
$sensorid=$_POST['sensorid'];
$time=$_POST['time'];
$output = '';
$sql = "SELECT * FROM Test WHERE sensor = '$sensorid' AND time = '$time' ";
$result = $conn->query($sql);


if (mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
	 <th>sensor</th>
     <th>day</th>
     <th>time</th>
     <th>zone</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["sensor"].'</td>
	 <td>'.$row["day"].'</td>
    <td>'.$row["time"].'</td>
    <td>'.$row["zone"].'</td>
   </tr>
  ';
 }
 echo $output;
}
?>


</body>
</html>

