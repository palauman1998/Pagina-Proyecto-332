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
    <title>Contact Us</title>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	 <link href="aboutus.css" rel="stylesheet" >
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

    <div class="title">
<br>
      <center>
      <h1 style="color: black;">Meet our Awesome Team</h1>
      <h3>We are Purdue Industrial Engineering Students here to provide optimized dynamic sensor network solutions over multiple geographic regions</h3><br>
      </center>
    </div>
    <div class="outercontainer">
      <div class="row">
        <div class="column">
          <div class="card" style="width: 20rem;style="height: 15rem;>
            <img src="1.png" width="150" height="150" alt="Manuel" class="pfp" style="margin-left:75px">
            <div class="container" style="margin-left:20px">
              <h2 style="margin-left:20px">Manuel Palau</h2>
              <p class="title" style="margin-left:100px">CEO</p>
              <p style="margin-left:50px">mpalau@purdue.edu</p>
			       <p><button class="button" onclick=" window.open(' https://co.linkedin.com/in/manuel-palau-511442189','_blank')">Contact</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card"style="width: 20rem;style="height: 15rem;>
            <img src="2.jpg" width="150" height="150" alt="Marcus" class="pfp" style="margin-left:75px">
            <div class="container" style="margin-left:20px">
              <h2 style="margin-left:20px">Marcus Oleson</h2>
              <p class="title" style="margin-left:60px">Head-Programmer</p>
              <p style="margin-left:50px">moleson@purdue.edu</p>
              <p><button class="button" onclick=" window.open('https://www.linkedin.com/in/marcus-oleson-773323153/','_blank')">Contact</button></p>
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card" style="width: 20rem;style="height: 15rem;>
            <img src="3.png" width="150" height="150" alt="Nihar" class="pfp" style="margin-left:75px">
            <div class="container" style="margin-left:20px">
              <h2 style="margin-left:35px">Nihar Vallem</h2>
              <p class="title" style="margin-left:5px">Website Designer and Programmer</p>
              <p style="margin-left:50px">nvallem@purdue.edu</p>
              <p><button class="button" onclick=" window.open('https://www.linkedin.com/in/nihar-vallem-3a9683140/','_blank')">Contact</button></p>
            </div>
          </div>
        </div>
		
        <div class="column">
          <div class="card" style="width: 20rem;style="height: 15rem;>
            <img src="4.jpeg" width="150" height="150" alt="Jiani"  class="pfp" style="margin-left:75px">
            <div class="container" style="margin-left:20px">
              <h2 style="margin-left:60px">Jiani He</h2>
              <p class="title" style="margin-left:50px">Senior Programmer</p>
              <p style="margin-left:50px">he364@purdue.edu</p>
			  <p><button class="button" onclick=" window.open('https://www.linkedin.com/in/jiani-he-19980225/','_blank')">Contact</button></p>
        
            </div>
          </div>
        </div>

        <div class="column">
          <div class="card" style="width: 20rem; style="height: 15rem;>
          <img src="6.jpeg" width="150px" height="150" alt="Rohan" class="pfp" style="margin-left:75px">
            <div class="container" style="margin-left:20px">
              <h2 style="margin-left:20px">Rohan Deb Roy</h2>
              <p class="title" style="margin-left:60px">Solutions Architect</p>
              <p style="margin-left:50px">rdebroy@purdue.edu</p>
			  <p><button class="button" onclick=" window.open('https://www.linkedin.com/in/rohandebroy/','_blank')">Contact</button></p>
            </div>
          </div>
        </div>

        <div class="column">
            <div class="card" style="width: 20rem;style="height: 15rem;>
              <img src="7.jpeg" width="150" height="150" alt="Julianna" class="pfp" style="margin-left:75px">
              <div class="container" style="margin-left:20px">
                <h2 style="margin-left:-5px">Julianna Reisinger</h2>
                <p class="title" style="margin-left:40px">Head-Solutions Architect</p>
                <p style="margin-left:50px">reising0@purdue.edu</p>
			    <p><button class="button" onclick=" window.open('https://www.linkedin.com/in/julianna-reisinger-033094182/','_blank')">Contact</button></p>
              </div>
            </div>
          </div>
		  
		    <div class="column">
          <div class="card" style="width: 20rem;style="height: 15rem;>
            <img src="5.jpeg" width="150" height="150" alt="Spoorthi" class="pfp" style="margin-left:75px">
            <div class="container" style="margin-left:20px">
              <h2 style="margin-left:50px">Spoorthi Jeedigunta</h2>
              <p class="title" style="margin-left:60px">Solutions Architect</p>
              <p style="margin-left:50px">sjeedigu@purdue.edu</p>
			  <p><button class="button" onclick=" window.open('https://www.linkedin.com/in/spoorthi-r-jeedigunta-a2127a146','_blank')">Contact</button></p>
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
