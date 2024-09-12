<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Honda Bintaro</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assetslogin/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assetslogin/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assetslogin/css/form-elements.css">
        <link rel="stylesheet" href="assetslogin/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body OnLoad="document.login.username.focus();">

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <!--div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>User</strong> Login</h1>
                            <div class="description">
                            	<p>
	                            	Sistem Online <strong>HONDA BINTARO</strong> ..
	                            	
                            	</p>
                            </div>
                        </div-->
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Silahkan Login</h3>
                            		<p>Masukan username dan password untuk Login:</p>
									<?php 
									//kode php ini kita gunakan untuk menampilkan pesan eror
										if (!empty($_GET['error'])) {
											if ($_GET['error'] == 1) {
											echo '<font type="century gothic" color="#dd4b39" size="2px">Email dan Password belum diisi!</font>';
												} else if ($_GET['error'] == 2) {
											echo '<font type="century gothic" color="#dd4b39" size="2px">Email belum diisi!</font>';
												} else if ($_GET['error'] == 3) {
											echo '<font type="century gothic" color="#dd4b39" size="2px">Password belum diisi!</font>';
												} else if ($_GET['error'] == 4) {
											echo '<font type="century gothic" color="#dd4b39" size="2px">Username or Password Incorrect!!!</font>';
														}
												  else if ($_GET['error'] == 5) {
											echo '<font type="century gothic" color="#dd4b39" size="2px">Username or Password Must be Character or Strings!!!</font>';
														}
										}
									?>	
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="cek_login.php" method="post" class="login-form" name = "login">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" placeholder="Username" class="form-username form-control" name="username" id="username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" placeholder="Password" class="form-password form-control" name="password" id="password">
			                        </div>
			                        <button type="submit" class="btn">Login !</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <!--div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>.....</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div-->
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assetslogin/js/jquery-1.11.1.min.js"></script>
        <script src="assetslogin/bootstrap/js/bootstrap.min.js"></script>
        <script src="assetslogin/js/jquery.backstretch.min.js"></script>
        <script src="assetslogin/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>
    </body>

</html>