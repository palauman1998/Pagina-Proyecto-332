<?php
SESSION_START();
include_once 'includes/mysql.php';
?>
<?php
$FName = $_SESSION['FName'];
$LName = $_SESSION['LName'];


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $CityName = $_POST['CityName'];
  $State = $_POST['State'];
  $Budget = $_POST['Budget'];
  $Duration = $_POST['Duration'];
  $StartDate = $_POST['StartDate'];
  $LATLowBound = $_POST['LATLowBound'];
  $LONGLowBound = $_POST['LONGLowBound'];
  $LATUpBound = $_POST['LATUpBound'];
  $LONGUpBound = $_POST['LONGUpBound'];

  $queryinsert = "INSERT INTO Projects (CustomerID,CityName,State,Budget,Duration,StartDate,LATLowBound,LONGLowBound,LATUpBound,LONGUpBound) 
  VALUES (1, '".$CityName."','".
  $State ."','".
  $Budget ."','".
  $Duration ."','".
  $StartDate ."','".
  $LATLowBound ."','".
  $LONGLowBound ."','".
  $LATUpBound ."','".
  $LONGUpBound ."');";

  $insertCity = mysqli_query($conn, $queryinsert) or die(mysqli_error($conn));

  // Set Arrays
  $arrIRLaLow = [];
  $arrIRLnLow = [];
  $arrIRLaUp = [];
  $arrIRLnUp = [];

  $arrRULaLow = [];
  $arrRULnLow = [];
  $arrRULaUp = [];
  $arrRULnUp = [];
  
  $arrHPLaLow = [];
  $arrHPLnLow = [];
  $arrHPLaUp = [];
  $arrHPLnUp = [];

  //Fill Arrays Invalid 
  foreach($_POST['IR_LATLOWBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrIRLaLow,$value);
    }
  }
  foreach($_POST['IR_LONGLOWBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrIRLnLow,$value);
    }
  }
  foreach($_POST['IR_LATUpBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrIRLaUp,$value);
    }
  }
  foreach($_POST['IR_LONGUpBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrIRLnUp,$value);
    }
  }

  //Fill Arrays Rural
  foreach($_POST['RU_LATLOWBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrRULaLow,$value);
    }
  }
  foreach($_POST['RU_LONGLOWBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrRULnLow,$value);
    }
  }
  foreach($_POST['RU_LATUpBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrRULaUp,$value);
    }
  }
  foreach($_POST['RU_LONGUpBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrRULnUp,$value);
    }
  }

  //Fill Arrays HotsPot
  foreach($_POST['HP_LATLOWBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrHPLaLow,$value);
    }
  }
  foreach($_POST['HP_LONGLOWBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrHPLnLow,$value);
    }
  }
  foreach($_POST['HP_LATUpBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrHPLaUp,$value);
    }
  }
  foreach($_POST['HP_LONGUpBound_'] as $key => $value) 
  {
    if ($value != '')
    {
      array_push($arrHPLnUp,$value);
    }
  }


  //Get last city inserted
  $querycity = "SELECT CityID FROM Projects ORDER BY 1 DESC LIMIT 0,1";
  $resultCity = mysqli_query($conn, $querycity) or die(mysqli_error($conn));
  $rowcity = $resultCity->fetch_array(MYSQLI_ASSOC);
  $CityID = $rowcity['CityID']; 


  //Insert Invalid && Rural && HotsPots
  for ($j=0; $j<9; $j++)
  {
    //InvalidRegion
    if ( isset($arrIRLaLow[$j]) && isset($arrIRLnLow[$j]) && isset($arrIRLaUp[$j]) && isset($arrIRLnUp[$j]) )
    {
      $queryInvalidRegion = "INSERT INTO InvalidRegion (CityID, LATLowBound, LONGLowBound, LATUpBound, LONGUpBound) values ($CityID,'" . $arrIRLaLow[$j]."','".$arrIRLnLow[$j]."','".$arrIRLaUp[$j]."','".$arrIRLnUp[$j]."');";
      $insertCityIR = mysqli_query($conn, $queryInvalidRegion) or die(mysqli_error($conn));
    }
    //Rural
    if ( isset($arrRULaLow[$j]) && isset($arrRULnLow[$j]) && isset($arrRULaUp[$j]) && isset($arrRULnUp[$j]) )
    {
      $queryRural = "INSERT INTO RuralAreas (CityID, LATLowBound, LONGLowBound, LATUpBound, LONGUpBound) values ($CityID,'" . $arrRULaLow[$j]."','".$arrRULnLow[$j]."','".$arrRULaUp[$j]."','".$arrRULnUp[$j]."');";
      $insertCityRU = mysqli_query($conn, $queryRural) or die(mysqli_error($conn));
    }
    //HotsPots
    if ( isset($arrHPLaLow[$j]) && isset($arrHPLnLow[$j]) && isset($arrHPLaUp[$j]) && isset($arrHPLnUp[$j]) )
    {
      $queryHotsPot = "INSERT INTO Hotspots (CityID, LATLowBound, LONGLowBound, LATUpBound, LONGUpBound) values ($CityID,'" . $arrHPLaLow[$j]."','".$arrHPLnLow[$j]."','".$arrHPLaUp[$j]."','".$arrHPLnUp[$j]."');";
      $insertCityHP = mysqli_query($conn, $queryHotsPot) or die(mysqli_error($conn));
    }
  }

  header("Location: index.php?saved=true");


}


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
    <title>Homepage</title>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/homepage.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="ie-emulation-modes-warning.js"></script>

  </head>

  <body>

    <!-- Calls particle.js file feature for attractiveness-->
    <div id="particles-js"></div>
	<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  	<script src="js/particles.js"></script>
	<script src="js/app.js"></script>

  <!-- Includes navigation bar to continue with overall design of website -->

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Skyline</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">

    <!-- Includes the name of the user signed into the website in navigation bar-->

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
			<a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#exampleModal">Place Order</a>
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
<br><br>
<br><br>
<br>
  <section class="landingpage">
  <form method="post">
      <div class="container1">
        <center>
        <div class="title">
          <img src="images/logo.png" alt="" class="logo" id="logo1">
        </div>

	  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width:80%;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <!--Begins form allowing user input for new desired projects-->
                <div class="container2">
                  <div class="form-group">
                  <label for="city_select">City</label>
                    <input type="text" class="form-control" id="city_select" placeholder="West Lafayette" name="CityName">
                  </div>
                  <div class="form-group">
                  <label for="city_select">State</label>
                    <input type="text" class="form-control" id="state_select" placeholder="Indiana" name="State">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Budget (US Dollars):</label>
                    <input type="text" class="form-control" id="Budget" placeholder="1000" name="Budget">
                  </div>
                  <div class="form-group">
                    <label for="duration_select">Duration (Years)</label>
                    <select class="form-control" id="duration_select" name="Duration">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                    </select>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">When Do You Wish This Project To Start?:</label>
                      <input type="text" class="form-control" id="StartDate" placeholder="2019-11-01 00:00:00" name="StartDate">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Lower Left Coordinate Latitude:</label>
                    <input type="text" class="form-control" placeholder="Latitude" name="LATLowBound">
                  </div>
				           <div class="form-group">
                    <label for="message-text" class="col-form-label">Lower Left Coordinate Longitude:</label>
                    <input type="text" class="form-control" id="lower-left-longitude-boundary" placeholder="Longitude" name="LONGLowBound">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Upper Right Coordinate Latitude:</label>
                    <input type="text" class="form-control" id="upper-right-latitude-boundary" placeholder="latitude" name="LATUpBound">
                  </div>
				          <div class="form-group">
                    <label for="message-text" class="col-form-label">Upper Right Coordinate Longitude:</label>
                    <input type="text" class="form-control" id="upper-right-longitude-boundary" placeholder="longtitude" name="LONGUpBound">
                  </div>
                </div>

                <div class="container3">
                  <h3>Invalid Regions:</h3>
                  <h6> This includes: Bodies of water and protected areas where sensors should not be placed <h6>
                  <div class="form-group">
                  <!--button type="button" class="btn btn-primary btn-xs add">Add</button>
                  <button type="button" class="btn btn-default btn-xs remove">Remove</button><span class="msg text-danger"></span-->
                 <hr>
    
                 <div class="container dynamic-rows"></div>

                 <script type="text/template" id="form_rows_tpl">
                    <div class="row">
                      <div>
                      <p>
                      </p>
                      </div>
                      <?php for ($i = 1; $i<=10; $i++) { ?>
                      <?php if ($i == 1) { ?><div id="invalidregion<?php echo $i; ?>" style="display:block;"><?php } else { ?> <div  id="invalidregion<?php echo $i; ?>" style="display:none;"> <?php } ?>   
                          <label for="IR_LATLOWBound_[{{count}}]"><?php echo $i; ?>. Lower Left Coordinate Latitude</label>
                          <input type="text" name="IR_LATLOWBound_[]" placeholder="Latitude" />
                          <br/>
                          <label for="IR_LONGLOWBound_[{{count}}]">Lower Left Coordinate Longitude</label>
                          <input type="text" name="IR_LONGLOWBound_[]" placeholder="Longitude"  />
                          <br/>
                          <label for="IR_LATUpBound_[{{count}}]">Upper Right Coordinate Latitude</label>
                          <input type="text" name="IR_LATUpBound_[]" placeholder="Latitude"  />
                          <br/>
                          <label for="IR_LONGUpBound_[{{count}}]">Upper Right Coordinate Longitude</label>
                          <input type="text" name="IR_LONGUpBound_[]" placeholder="Longitude"  />
                          <br/>
                          <button type="button" class="btn btn-primary btn-xs" onclick="displayForm('invalidregion', <?php echo $i; ?>);">Add</button>
                      </div>
                    <?php } ?>
                    <div class="col-lg-4">
                    
                    </div>
                    </div>
                  </script>
                  </div>
                </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#final_data">Continue</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Do you wish to continue with no budget?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#exampleModal').modal('hide');">No</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#budget" onclick="$('#exampleModal').modal('hide');">Yes</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="budget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">How much of the area do you want to cover?</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body budget_body">
              
                 <div class="container2">
                   <div class="form-group group">
                     <div class="radiobutton">
                       <label class="budget_desc">5%<input type="radio" name="optradio" class="radio_option"></label>
                       <label class="budget_desc">10%<input type="radio" name="optradio" class="radio_option"></label>
                       <label class="budget_desc">20%<input type="radio" name="optradio" class="radio_option"></label>
                     </div>
                   </div>
                 </div>
               
               <div class="budget_number"></div>
             </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#final_data">Continue</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="final_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width:80%;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Additional Input</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                 <div class="container4">
                  <h3>Rural Regions</h3>
                  <div class="form-group">
                 <hr>
                 <?php for ($i = 1; $i<=10; $i++) { ?>
                    <?php if ($i == 1) { ?><div id="ruralregion<?php echo $i; ?>" style="display:block;"><?php } else { ?> <div  id="ruralregion<?php echo $i; ?>" style="display:none;"> <?php } ?>   
                    <label for="RU_LATLOWBound_[{{count}}]"><?php echo $i; ?>. Lower Left Coordinate Latitude</label>
                    <input type="text" name="RU_LATLOWBound_[]" placeholder="Latitudee" />
                    <br/>
                    <label for="RU_LONGLOWBound_[{{count}}]">Lower Left Coordinate Longitude</label>
                    <input type="text" name="RU_LONGLOWBound_[]" placeholder="Longitude"  />
                    <br/>
                    <label for="RU_LATUpBound_[{{count}}]">Upper Right Coordinate Latitude</label>
                    <input type="text" name="RU_LATUpBound_[]" placeholder="Latitude"  />
                    <br/>
                    <label for="RU_LONGUpBound_[{{count}}]">Upper Right Coordinate Longitude</label>
                    <input type="text" name="RU_LONGUpBound_[]" placeholder="Longitude"  />
                    <br/>
                    <button type="button" class="btn btn-primary btn-xs" onclick="displayForm('ruralregion', <?php echo $i; ?>);">Add</button>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="container5">
                  <h3>Hotspot</h3>
                  <div class="form-group">
                 <hr>
                 <?php for ($i = 1; $i<=10; $i++) { ?>
                    <?php if ($i == 1) { ?><div id="hotspot<?php echo $i; ?>" style="display:block;"><?php } else { ?> <div  id="hotspot<?php echo $i; ?>" style="display:none;"> <?php } ?>   
                    <label for="HP_LATLOWBound_[{{count}}]"><?php echo $i; ?>. Lower Left Coordinate Latitude</label>
                    <input type="text" name="HP_LATLOWBound_[]" placeholder="Latitudeee" />
                    <br/>
                    <label for="HP_LONGLOWBound_[{{count}}]">Lower Left Coordinate Longitude</label>
                    <input type="text" name="HP_LONGLOWBound_[]" placeholder="Longitude"  />
                    <br/>
                    <label for="HP_LATUpBound_[{{count}}]">Upper Right Coordinate Latitude</label>
                    <input type="text" name="HP_LATUpBound_[]" placeholder="Latitude"  />
                    <br/>
                    <label for="HP_LONGUpBound_[{{count}}]">Upper Right Coordinate Longitude</label>
                    <input type="text" name="HP_LONGUpBound_[]" placeholder="Longitude"  />
                    <br/>
                    <button type="button" class="btn btn-primary btn-xs" onclick="displayForm('hotspot', <?php echo $i; ?>);">Add</button>
                    </div>
                    <?php } ?>
                  </div>
                </div>

                </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    </section>
     
    <?php if (isset($_GET['saved'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show hidden" id="popup" role="alert" style="z-index: 999;">
      <strong>Order has been placed.</strong><br> We will get back to you in the next 2-4 weeks. Thank you for your patience! We are really excited to be working with you!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php } ?>

	 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
     <script src='https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js'></script>
   <script src="js/script.js"></script>
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
    <script>
      function displayForm(type, idDiv)
      {
        idDiv = idDiv + 1;
        $('#'+type+idDiv).show();
      }
    </script>
  </body>
</html>
