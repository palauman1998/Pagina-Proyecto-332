<form action="index.php" method="post">
<?php
//fetch.php
$connect = MySQLi_connect(

   "mydb.itap.purdue.edu", //Server host name.

   "g1109686", //Database username.

   "Algorithm12345", //Database password.

   "g1109686" //Database name or anything you would like to call it.

);



//Check connection

if (MySQLi_connect_errno()) {

   echo "Failed to connect to MySQL: " . MySQLi_connect_error();

}

$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
	SELECT * from Test WHERE sensor like '%".$search."%' 
 ";
}
else
{
 $query = "
	SELECT * from Test
 ";
}
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
	 <th>Sensor ID</th>
     <th>Day</th>
     <th>Time</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["sensor"].'</td>
    <td>'.$row["day"].'</td>
    <td>'.$row["time"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>