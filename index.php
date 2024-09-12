<!DOCTYPE html>
<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==1){
 // header('location:logout.php');
  //header('location:media.php?module=sub_master_list_users');
   header('location:media_showroom.php?module=showroom');
}
else
{
    

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>H-BOS - Honda Bintaro Operational System</title>
	<link rel="stylesheet" href="res/css/style.css">
	<link rel="stylesheet" href="res/plugin/FontAwesome/css/font-awesome.min.css">
	<link rel="icon" href="/sos.png" type="image/x-icon">
</head>
<body>
	<div id="container" data-background="res/img/ramadan.jpg">
		<div class="box box-sm">
			<div class="logo">
			    <center><img src="res/img/h-bos.png" ></img></center>
				<h1 style="font-size:32pt;letter-spacing:-3px;"><span style="color:#c21c22">Honda</span> Bintaro</h1>
				<center><span style="color:white;">Operational System</span></center>
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
												else if ($_GET['error'] == 6) {
											echo '<font type="century gothic" color="#dd4b39" size="2px">Username sedang digunakan, sesi login lain sudah diakhiri oleh sistem. Silahkan login kembali</font>';
														}
										}
									?>	
			</div>
			<div class="form">
				<form role="form" action="cek_login.php" method="post" class="login-form" name = "login">
					<div class="form-group">
						<span class="form-icon"><i class="fa fa-user"></i></span>
						<input style="text-transform:lowercase"  type="text" onblur="this.value=this.value.toLowerCase()" class="form-input" placeholder="username" name="username" id="username">
					</div>
					<div class="form-group">
						<span class="form-icon"><i class="fa fa-lock"></i></span>
						<input type="password" class="form-input" placeholder="password" name="password" id="password">
					</div>
					<button class="btn btn-warning btn-block">Sign in</button>
					<div class="form-text">
						Login style | 
						<a href="#default"class="btn-default">Default</a> - 
						<a href="#square"class="btn-square">Square</a> - 
						<a href="#underline"class="btn-underline">Underline</button> - 
						<a href="#outline"class="btn-outline">Outline</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	 <!--script src='https://code.responsivevoice.org/responsivevoice.js'></script>
		<script type="text/javascript">
		responsiveVoice.OnVoiceReady = function() {
	   console.log("speech time?");
	   responsiveVoice.speak(
			 "welcome to Honda Bintaro Operational System.",
			  "US English Male",
			  {
			   pitch: 2, 
			   rate: 0.82, 
			   volume: 1
			  }
			 );
			};
		</script-->
	<script type="text/javascript" src="res/plugin/jQuery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="res/js/script.js"></script>
	<script type="text/javascript">
		$(".btn-default").click(function(){
			$("#container").removeClass("bungloon-square bungloon-underline bungloon-outline");
		});
		$(".btn-square").click(function(){
			$("#container").removeClass("bungloon-underline bungloon-outline").addClass('bungloon-square');
		});
		$(".btn-underline").click(function(){
			$("#container").removeClass("bungloon-square bungloon-outline").addClass('bungloon-underline');
		});

		$(".btn-outline").click(function(){
			$("#container").removeClass("bungloon-square bungloon-underline").addClass('bungloon-outline');
		});
	</script>
</body>
<?php
}
?>
</html>