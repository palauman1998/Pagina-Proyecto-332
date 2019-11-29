<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Recaptcha</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
    <script src="ie-emulation-modes-warning.js"></script>
</head>

<body> 
<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LfIm8MUAAAAAMUmzcJxCLVSYP87OzsyrZmDAa6t',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...
        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    }
} else { ?>
    

    <!-- FORM -->
    <form action="LoginValidation.php" method="post">
	<div class="container2">
		<center>
		<div class="logo">
		<img src="logo.png" alt="" class="logo">
		</div>
	</div>
    <div class="container1">
      <form class="form-signin"><center>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="inputEmail" class="form-control1" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control1" placeholder="Password" required>
       
        <br>
		 <div class="g-recaptcha" data-sitekey="6LfIm8MUAAAAACkzh2DUr-usgSftJjGJzMLOQG3C"></div>
        <br>
        <button class="btn btn-lg btn-primary btn-block"  type="submit">Sign in</button><br>

		<div class="createaccount">
			<a href="createaccount.html" class="createaccount">
			Sign Up
			</a>
		</div>
		<div class="createaccount">
			<a href="forget.html" class="createaccount">
			Forget Password
			</a>
		</div>
      </form>
    </div>
<?php } ?>
</body>
</html>

