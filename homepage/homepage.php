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
    <title>Homepage</title>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="homepage.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="ie-emulation-modes-warning.js"></script>

  </head>

  <body>
    <div id="particles-js"></div>
	<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  	<script src="particles.js"></script>
	<script src="app.js"></script>
	
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
      <div class="container1">
        <center>
        <div class="title">
          <img src="logo.png" alt="" class="logo" id="logo1">
        </div>
	  
	  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="container2">
                  <div class="form-group">
                  <label for="city_select">City</label>
                    <input type="text" class="form-control" id="city_select" placeholder="City">
                  </div>
                  <div class="form-group">
                  <label for="city_select">State</label>
                    <input type="text" class="form-control" id="state_select" placeholder="State">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Budget ($):</label>
                    <input type="text" class="form-control" id="bottom-right" placeholder="1000">
                  </div>
                  <div class="form-group">
                    <label for="duration_select">Duration (year)</label>
                    <select class="form-control" id="duration_select">
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
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Upper Right Coordinate Latitude:</label>
                    <input type="text" class="form-control" name="upper-right-latitude-boundary" placeholder="Latitude">
                  </div>
				   <div class="form-group">  
                    <label for="message-text" class="col-form-label">Upper Right Coordinate Longitude:</label>
                    <input type="text" class="form-control" id="upper-right-longitude-boundary" placeholder="Longitude">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Bottom Left Coordinate Latitude:</label>
                    <input type="text" class="form-control" id="bottom-left-latitude-boundary" placeholder="latitude">
                  </div>
				  <div class="form-group">
                    <label for="message-text" class="col-form-label">Bottom Left Coordinate Longitude:</label>
                    <input type="text" class="form-control" id="bottom-left-longitude-boundary" placeholder="longtitude">
                  </div>
                </div>
                <div class="container3">
                  <h3>Invalid Regions:</h3>
                  <h6> This includes: Bodies of water and protected areas <h6>
                  <div class="form-group">
       
					<button type="button" class="btn btn-primary btn-xs add">Add</button> 
					<button type="button" class="btn btn-default btn-xs remove">Remove</button><span class="msg text-danger"></span>
                 <hr>
				 
                 <form>
                 <div class="container dynamic-rows"></div>
                 </form>

                 <script type="text/template" id="form_rows_tpl">
                 
				<div class="row">
                <div>
                 <p>
				<label for="upper-right-latitude-invalid_{{count}}">{{count}}. Upper Right Coordinate Latitude</label><br>
                <input type="text" name="upper-right-latitude-invalid"placeholder="Latitude"id="upper-right-latitude-invalid_{{count}}">
                </p>
                </div>
                <div >
               
                <label for="upper-right-longitude-invalid_{{count}}">Upper Right Coordinate Longitude</label><br>
                <input type="text" name="upper-right-longitude-invalid"placeholder="Longitude" id="upper-right-longitude-invalid_{{count}}">
				  <label for="bottom-left-latitude-invalid_{{count}}">Bottom Left Coordinate Latitude</label><br>
                <input type="text" name="bottom-left-latitude-invalid"placeholder="Latitude" id="bottom-left-latitude-invalid_{{count}}">
				  <label for="bottom-left-longitude-invalid_{{count}}}">Bottom Left Coordinate Longitude</label><br>
                <input type="text" name="bottom-left-longitude-invalid"placeholder="Longitude" id="bottom-left-longitude-invalid_{{count}}">
                
                </div>
                <div class="col-lg-4">
                <p>
                </div>
                </div>
                </script>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmation">Continue</button>
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
               <form style="display: contents; vertical-align: middle;"> 
                 <div class="container2"> 
                   <div class="form-group group"> 
                     <div class="radiobutton"> 
                       <label class="budget_desc">5%<input type="radio" name="optradio" class="radio_option"></label> 
                       <label class="budget_desc">10%<input type="radio" name="optradio" class="radio_option"></label> 
                       <label class="budget_desc">20%<input type="radio" name="optradio" class="radio_option"></label> 
                     </div> 
                   </div> 
                 </div> 
               </form> 
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
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Additional Input</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                 <div class="container4">
                  <h3>Rural Regions</h3>
                  <div class="form-group">
       
					<button type="button" class="btn btn-primary btn-xs add">Add</button> 
					<button type="button" class="btn btn-default btn-xs remove">Remove</button> <span class="msg text-danger"></span>
                 <hr>
				 
                 <form>
                 <div class="container dynamic-rows"></div>
                 </form>

                 <script type="text/template" id="form_rows_tpl">
                 
				<div class="row">
                <div>
                 <p>
				<label for="upper-right-latitude-rural_{{count}}">{{count}}. Upper Right Coordinate Latitude</label><br>
                <input type="text" name="upper-right-latitude-rural"placeholder="Latitude"id="upper-right-latitude-rural_{{count}}">
                </p>
                </div>
                <div >
                <label for="upper-right-longitude-rural_{{count}}">Upper Right Coordinate Longitude</label><br>
                <input type="text" name="upper-right-longitude-rural"placeholder="Longitude" id="upper-right-longitude-rural_{{count}}">
				  <label for="bottom-left-latitude-rural_{{count}}">Bottom Left Coordinate Latitude</label><br>
                <input type="text" name="bottom-left-latitude-rural"placeholder="Latitude" id="bottom-left-latitude-rural_{{count}}">
				  <label for="bottom-left-longitude-invalid_{{count}}}">Bottom Left Coordinate Longitude</label><br>
                <input type="text" name="bottom-left-longitude-rural"placeholder="Longitude" id="bottom-left-longitude-rural_{{count}}">
                
                </div>
                <div class="col-lg-4">
                <p>
                </div>
                </div>
                </script>
                  </div>
                </div>
				
                 <div class="container5">
                  <h3>Hotspots:</h3>
                  <h6> This includes: Industrial Areas, Residential Areas, Urban Areas <h6>
                  <div class="form-group">
       
					<button type="button" class="btn btn-primary btn-xs add">Add</button> 
					<button type="button" class="btn btn-default btn-xs remove">Remove</button> <span class="msg text-hotspot"></span>
                 <hr>
				 
                 <form>
                 <div class="container dynamic-rows"></div>
                 </form>

                 <script type="text/template" id="form_rows_tpl">
                 
				<div class="row">
                <div>
                 <p>
				<label for="upper-right-latitude-hotspot_{{count}}">{{count}}. Upper Right Coordinate Latitude</label><br>
                <input type="text" name="upper-right-latitude-hotspot"placeholder="Latitude"id="upper-right-latitude-hotspot_{{count}}">
                </p>
                </div>
                <div >
                <label for="upper-right-longitude-hotspot_{{count}}">Upper Right Coordinate Longitude</label><br>
                <input type="text" name="upper-right-longitude-hotspot"placeholder="Longitude" id="upper-right-longitude-hotspot_{{count}}">
				  <label for="bottom-left-latitude-hotspot_{{count}}">Bottom Left Coordinate Latitude</label><br>
                <input type="text" name="bottom-left-latitude-hotspot"placeholder="Latitude" id="bottom-left-latitude-hotspot_{{count}}">
				  <label for="bottom-left-longitude-hotspot_{{count}}}">Bottom Left Coordinate Longitude</label><br>
                <input type="text" name="bottom-left-longitude-hotspot"placeholder="Longitude" id="bottom-left-longitude-hotspot_{{count}}">
                
                </div>
                <div class="col-lg-4">
                <p>
                </div>
                </div>
                </script>
                  </div>
                </div>
				
           
                </div>
              </form>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Submit</button>
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
