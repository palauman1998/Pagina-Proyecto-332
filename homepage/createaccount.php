 <?php session_start();

//Database Connection Credentials
$servername = "mydb.itap.purdue.edu";
$username = "g1109686";
$password = "Algorithm12345";
$dbname = "g1109686";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
	die('Connection Failed : '.$conn->connect_error);
}
//Insert Statement - Form to Database. Encrypts sensitive user information before sending to database.
//$CustomerID=$_POST['CustomerID'];
$FName = $_POST['firstName'];
$LName = $_POST['lastName'];
$EMail = $_POST['email'];
$Password = $_POST['password'];
$AccountName = $_POST['accountname'];
$RoutingNumber = $_POST['routingnumber'];
$AccountNumber = $_POST['accountnumber'];
$BillingStreet = $_POST['billingstreet'];
$City = $_POST['city'];
$State = $_POST['state'];
$Country = $_POST['country'];
$Zipcode = $_POST['zipcode'];
$var_Password = crypt($Password, '$6$rounds=5000$anexamplestringforsalt$');
$var_AccountName = crypt($AccountNam, '$6$rounds=5000$anexamplestringforsalt$');
$var_RoutingNumber = crypt($RoutingNumber, '$6$rounds=5000$anexamplestringforsalt$');
$var_AccountNumber = crypt($AccountNumber, '$6$rounds=5000$anexamplestringforsalt$');
//$sql = "SELECT CustomerID, FName, LName, EMail, Password,AccountName, RoutingNumber,AccountNumber, BillingStreet, City, State, Country, Zipcode FROM `Customers` WHERE CustomerID = '$CustomerID'";
//$sqlnew = "UPDATE `Customers` SET`Password`= '$var_Password' WHERE CustomerID = '$CustomerID'";
$sql = "INSERT INTO Customers(FName, LName, EMail, Password, AccountName, RoutingNumber, AccountNumber,BillingStreet,City,Country,State,Zipcode)
VALUES ('$FName', '$LName', '$EMail', '$var_Password', '$var_AccountName', '$var_RoutingNumber', '$var_AccountNumber', '$BillingStreet', '$City', '$State', '$Country', '$Zipcode')";

//Send Query. Alert user if failed.
$result = $conn->query($sql);
if ($result === FALSE) {
	echo "<script> alert('Error: Profile not updated.'); </script>";
}
else
{
echo "<script> alert('Profile updated!'); </script>";
header("refresh:1; url=https://web.ics.purdue.edu/~g1109686/homepage/signin.php");//User is refreshed to home page
}

$conn->close();


?>
