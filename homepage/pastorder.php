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
    <title>Past Orders</title>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="pastorder.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="ie-emulation-modes-warning.js"></script>
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
          <h2 class="sub-header"><center>Air Quality Monitoring Condition</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
               <tr>
                  <th class="text-center">Project ID</th>
                  <th class="text-center">City Name</th>
                   <th class="text-center">Total Area</th>
                  <th class="text-center">Budget</th>
                  <th class="text-center">Duration</th>
                  <th class="text-center">Fixed Sensor Numbers</th>
				   <th class="text-center">Mobile Sensor Numbers</th>
				   <th class="text-center">Start Date</th>
                  <th class="text-center">Status</th>
                 
                </tr>
              </thead>
              <tbody>
                <tr>
	   <th class="text-center text-dark"><a href="orderofmiami.php">1</a></th>
	<td class="text-center text-dark"><a href="orderofmiami.php">Miami</a></td>
                  <td class="text-center text-dark">56.06 sq miles</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
                  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
				  
                </tr>
                <tr>
                    <th class="text-center table-light text-dark"><a href="orderofseattle.php">2</a></th>
                  <td class="text-center text-dark"><a href="orderofseattle.php">Seattle</td>
                  <td class="text-center text-dark">142.07 sq miles</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
               <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
				  
                </tr>
                <tr>
                   <th class="text-center text-dark"><a href="orderofatalanta.php">3</th>
                  <td class="text-center text-dark"><a href="orderofatlanta.php">Atlanta</td>
                  <td class="text-center text-dark">134.02 sq miles</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
                 <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
				  
                </tr>
                   <tr>
                   <th class="text-center table-light text-dark"><a href="orderofchicago.php">4</th>
                  <td class="text-center text-dark"><a href="orderofchicago.php">Chicago</td>
                  <td class="text-center text-dark">227.63 sq miles</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
              <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
				  
                </tr>
                   <tr>
                   <th class="text-center text-dark"><a href="orderofdenver.php">5</th>
                  <td class="text-center text-dark"><a href="orderofdenver.php">Denver</td>
                  <td class="text-center text-dark">154.97</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
                 <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
				  
                   <tr>
                   <th class="text-center table-light text-dark"><a href="orderofindy.php">6</th>
                  <td class="text-center text-dark"><a href="orderofindy.php">Indianapolis</td>
                  <td class="text-center text-dark">368.15 sq miles</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
                 <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
				  
                </tr>   <tr>
                   <th class="text-center text-dark"><a href="orderofnashville.php">7</th>
                  <td class="text-center text-dark"><a href="orderofnashville.php">Nashville</td>
                  <td class="text-center text-dark">525.94 sq miles</td>
                  <td class="text-center text-dark">$10k</td>
                  <td class="text-center text-dark">1 year</td>
                  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark">100</td>
				  <td class="text-center text-dark"> 10/10/2018</td>
                  <td class="text-center text-dark"> Active</td>
			
                </tr>
              </tbody>
            </table>
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
