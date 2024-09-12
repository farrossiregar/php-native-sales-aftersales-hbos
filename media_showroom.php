<?php
session_start();
error_reporting(0);

include "timeout.php";
include "config/koneksi.php";

if($_SESSION[login]==1){
	
	if($_SESSION['leveluser']=='sales' ){
		if(!cek_login()){
			$_SESSION[login] = 0;
		}
	}
	
}

$query_data = mysql_query("select username,aktif from user_login where username = '$_SESSION[username]' and session_id = '$_SESSION[id_session]' ");
//$data_userlogin = mysql_fetch_array($query);

while ($data_userlogin = mysql_fetch_array($query_data)){
	$status_aktif = $data_userlogin['aktif'];
	
}
//$status_aktif = $_SESSION['id_session'];


if ($status_aktif == 'N' ){
	$_SESSION[login] = 0;
}

if($_SESSION[login]==0){
  header('location:logout.php');
  //header('location:media.php?module=sub_master_list_users');
  
?>
<script type="text/javascript">    
    
        $('.bs-example-modal-lg').modal('show');
    
</script>

<?php
}
else{
	
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
	
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
  
	/* $login = mysql_query("SELECT * from path");
		$login2 = mysql_fetch_array($login);
		$users = $login2[username];
		if ($_SESSION[username] == $users){
			echo "<link href='style.css' rel='stylesheet' type='text/css'>
				<center>Anda sedang login <br>";
				echo "<a href=index.php><b>LOGIN</b></a></center>";
		}
	*/
  
  
}
else{ include "konfigurasi.php";
date_default_timezone_set('Asia/Jakarta');

$user = $_SESSION[username];
$path = substr($_SERVER[REQUEST_URI], 11);
$time = date("Y-m-d H:i:s");
$browser = $_SERVER['HTTP_USER_AGENT'];
//$browser = $_SERVER['BROWSER_NAME_PATTERN'];
$update1 = mysql_query("UPDATE path set module='$path', time='$time', browser='$browser' where username='$user'");

?>


<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Honda Bintaro - Sistem Operasional Sales.</title>
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="icon" href="/sos.png" type="image/x-icon">
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		
		<link href="vendor/bootstrap-fileinput/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->
		
		<!-- start: CSS TIME PICKER & DATE PICKER -->
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
        <link href="vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
		
		<link href="vendor/ladda-bootstrap/ladda-themeless.min.css" rel="stylesheet" media="screen">
		
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<script type="text/javascript" src="assets/js/titikpemisahfield.js"></script>
		<!-- end: CLIP-TWO CSS -->
		
		
		<link href="vendor/sweetalert/sweet-alert.css" rel="stylesheet" media="screen">
		<link href="vendor/sweetalert/ie9.css" rel="stylesheet" media="screen">
		<link href="vendor/toastr/toastr.min.css" rel="stylesheet" media="screen">
		
		<!--- DATETIMEPICKER -->
		<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-datetimepicker.min.css"-->
		<link rel="stylesheet" type="text/css" href="timepicker.css">
		<link rel="stylesheet" type="text/css" href="bootstrap-datetimepicker.css">
		
		<!--- DATETIMEPICKER -->
		
		<link rel="stylesheet" type="text/css" href="csslucuk.css">
		
		<!-- end: CLIP-TWO CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="vendor/fullcalendar/fullcalendar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		
		
		
		<style type = "text/css">
		/* CSS BLINK */
        .blink {
          animation: blink-animation 0.5s steps(5, start) infinite;
          -webkit-animation: blink-animation 0.5s steps(5, start) infinite;
        }
        @keyframes blink-animation {
          to {
            visibility: hidden;
          }
        }
        @-webkit-keyframes blink-animation {
          to {
            visibility: hidden;
          }
        }
		
		
		/* CSS LOADING */
		
		.preload-wrapper {
			z-index:9999999999;
			position: fixed;
			top:0;
			left: 0;
			right: 0;
			bottom:0;
			background:#fff;
			overflow: hidden;
		}
		#preloader_4{
			position:relative;
			width:70px;
			margin:23% auto;
		}
		#preloader_4 span{
			position:absolute;
			width:20px;
			height:20px;
			background:#3498db;
			opacity:0.5;
		border-radius:20px;
			-animation: preloader_4 1s infinite ease-in-out;
			-webkit-animation: preloader_4 1s infinite ease-in-out; 
		}
		#preloader_4 span:nth-child(2){
			left:20px;
			animation-delay: .2s;
			-webkit-animation-delay: .2s;
		}
		#preloader_4 span:nth-child(3){
			left:40px;
			-webkit-animation-delay: .4s;
			animation-delay: .4s;
		}
		#preloader_4 span:nth-child(4){
			left:60px;
			animation-delay: .6s;
			-webkit-animation-delay: .6s;
		}
		#preloader_4 span:nth-child(5){
			left:80px;
			animation-delay: .8s;
			-webkit-animation-delay: .8s;
		}
		@keyframes preloader_4 {
			0% {opacity: 0.3; transform:translateY(0px);    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
			50% {opacity: 1; transform: translateY(-10px); background:#f1c40f;  box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
			100%  {opacity: 0.3; transform:translateY(0px); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
		}
		@-webkit-keyframes preloader_4 {
			0% {opacity: 0.3; transform:translateY(0px);    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
			50% {opacity: 1; transform: translateY(-10px); background:#f1c40f;  box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
			100%  {opacity: 0.3; transform:translateY(0px); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
		}
		
		
		
		.preload-wrapper6 {
			z-index:9999999999;
			position: fixed;
			top:0;
			left: 0;
			right: 0;
			bottom:0;
			background:#fff;
			overflow: hidden;
			//display: none;
		}
		
		#preloader6{
			position:relative;
			width: 42px;
			height: 42px;
			margin:23% auto;
			animation: preloader_6 5s infinite linear;
			-webkit-animation: preloader_6 5s infinite linear;
		}
		#preloader6 span{
			width:20px;
			height:20px;
			position:absolute;
			background:red;
			display:block;
			animation: preloader_6_span 1s infinite linear;
			-webkit-animation: preloader_6_span 1s infinite linear;    
		}
		#preloader6 span:nth-child(1){
		background:#2ecc71;
		 
		}
		#preloader6 span:nth-child(2){
		left:22px;
		background:#9b59b6;
			animation-delay: .2s;
			-webkit-animation-delay: .2s;
		}
		#preloader6 span:nth-child(3){
		top:22px;
		background:#3498db;
			animation-delay: .4s;
			-webkit-animation-delay: .4s;
		}
		#preloader6 span:nth-child(4){
		top:22px;
		left:22px;
		background:#f1c40f;
			animation-delay: .6s;
			-webkit-animation-delay: .6s;
		}
		@keyframes preloader_6 {
		   0% { transform:rotate(0deg); }
		   50% { transform:rotate(180deg); }
		   100% { transform:rotate(360deg); }
		}
		@-webkit-keyframes preloader_6 {
		   0% { -webkit-transform:rotate(0deg); }
		   50% { -webkit-transform:rotate(180deg); }
		   100% { -webkit-transform:rotate(360deg); }
		}
		@-webkit-keyframes preloader_6_span {
		   0% { -webkit-transform:scale(1); }
		   50% { -webkit-transform:scale(0.5); }
		   100% { -webkit-transform:scale(1); }
		}
		@keyframes preloader_6_span {
		   0% { transform:scale(1); }
		   50% { transform:scale(0.5); }
		   100% { transform:scale(1); }
		}
		@-webkit-keyframes preloader_6_span {
		   0% { -webkit-transform:scale(1); }
		   50% { -webkit-transform:scale(0.5); }
		   100% { -webkit-transform:scale(1); }
		}
		

		
		
		.preload-wrapper3 {
			z-index:9999999999;
			position: fixed;
			top:0;
			left: 0;
			right: 0;
			bottom:0;
			background:#fff;
			overflow: hidden;
		}
		#preloader_3{
			position:relative;
			width:40px;
			margin: 23% auto;
		}
		#preloader_3:before{
			width:20px;
			height:20px;
			border-radius:20px;
			background:blue;
			content:'';
			position:absolute;
			background:#9b59b6;
			-webkit-animation: preloader_3_before 1.5s infinite ease-in-out;
			animation: preloader_3_before 1.5s infinite ease-in-out;
		}
		 
		#preloader_3:after{
			width:20px;
			height:20px;
			border-radius:20px;
			background:blue;
			content:'';
			position:absolute;
			background:#2ecc71;
			left:22px;
			animation: preloader_3_after 1.5s infinite ease-in-out;
			-webkit-animation: preloader_3_after 1.5s infinite ease-in-out;    
		}
		 
		@keyframes preloader_3_before {
			0% {transform: translateX(0px) rotate(0deg)}
			50% {transform: translateX(50px) scale(1.2) rotate(260deg); background:#2ecc71;border-radius:0px;}
			  100% {transform: translateX(0px) rotate(0deg)}
		}
		@keyframes preloader_3_after {
			0% {transform: translateX(0px)}
			50% {transform: translateX(-50px) scale(1.2) rotate(-260deg);background:#9b59b6;border-radius:0px;}
			100% {transform: translateX(0px)}
		}
		@-webkit-keyframes preloader_3_before {
			0% {-webkit-transform: translateX(0px) rotate(0deg)}
			50% {-webkit-transform: translateX(50px) scale(1.2) rotate(260deg); background:#2ecc71;border-radius:0px;}
			  100% {-webkit-transform: translateX(0px) rotate(0deg)}
		}
		@-webkit-keyframes preloader_3_after {
			0% {-webkit-transform: translateX(0px)}
			50% {-webkit-transform: translateX(-50px) scale(1.2) rotate(-260deg);background:#9b59b6;border-radius:0px;}
			100% {-webkit-transform: translateX(0px)}
		}
		
		.select2-container .select2-selection--single {
		  //font-family: 'Arial', Verdana;
		  font-size: 14px;
		  //box-sizing: border-box;
		 // display: block;
		  height: 34px;
		  border-radius : 0px;
		  width : 100%;
		  
		
		}
		.select2-container--default .select2-selection--single .select2-selection__rendered {
			line-height:31px;
		}
		.select2-container--default .select2-selection--single .select2-selection__arrow {
			height: 31px;
			
		}
		
							
		#showroom {
			display : none;
		}
		.tampil {
			display : block;
			
		}
		.menu-utama {
			
		}				
		 
		 
		#sidebar > div nav > ul {
			margin: 0px 0;
		 }
						
        </style>
		
	</head>
	<!-- end: HEAD -->
	<body>
	<!-- LOADING DULU BRO -->
	<div id="preload-wrapper" class="preload-wrapper">
		<div id="preloader_4">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
        </div>
	</div>
	
	<!-- LOADING BUAT AJAX SUKSES -->
	<div id="preload-wrapper6" class="preload-wrapper6" style="display:none;">	
		<div id="preloader6">
		   <span></span>
		   <span></span>
		   <span></span>
		   <span></span>		  
	   </div>
	</div>
	
	
	<div class="preload-wrapper3" style="display:none;">
		<div id="preloader_3">
		</div>
	</div>
	
	<!-- ------------------------------------ -->
	
		<div id="app">
			<!-- sidebar -->
			<div class="sidebar app-aside" id="sidebar">
				<div class="sidebar-container perfect-scrollbar">
					<nav>
						<!-- start: SEARCH FORM -->
						<div class="search-form">
							<a class="s-open" href="#">
								<i class="ti-search"></i>
							</a>
							<form class="navbar-form" role="search">
								<a class="s-remove" href="#" target=".navbar-form">
									<i class="ti-close"></i>
								</a>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Search...">
									<button class="btn search-button" type="submit">
										<i class="ti-search"></i>
									</button>
								</div>
							</form>
						</div>
						<!-- end: SEARCH FORM -->
						<!-- start: MAIN NAVIGATION MENU -->
						
						
						<script>
							function show_menu(id) {
								var x = document.getElementById(id);
									$('#'+id).slideToggle("fast");
							}
							function hide_menu(id) {
								var x = document.getElementById(id);
									$('#'+id).slideUp("fast");
							}
						</script>
						
						<!--div class="navbar-title">
							<span>Main Navigation</span>
						</div-->
						<ul class="main-navigation-menu">
							<li <?php if ($_GET['module']==showroom){ echo "class='active open'"; } ?>>
								<a href="media_showroom.php?module=showroom">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-home"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Home</span>
										</div>
									</div>
								</a>
							</li>
						
						<?php  
						 $menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE jenis_bisnis = 'KONFIG' and mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' order by mn.kode_menu asc");
						 while($sql=mysql_fetch_array($menu)){
							$kd_menu=$sql['kode_menu'];
							$modul=$sql['module'];
							$panjang_modul = strlen($modul);
							$nama_menu=$sql['nama_menu'];
							$link=$sql['link'];
							$lvlmn=$sql['level_menu'];
							$accs=$sql['akses'];
							
							$mod=substr($sql['module'],0,$panjang_modul);
							
								if($accs == 'Y'){
						?>
						
							<li <?php if (substr($_GET['module'],0,$panjang_modul) == $sql['module']) { echo "class='active open'"; } ?>>
								
								<?php { ?>
								
								<a href="<?php echo $sql['link']; ?>">
									<div class="item-content">
										<div class="item-media">
											<i class="<?php echo $sql['icon']; ?>"></i>
										</div>
										<div class="item-inner">
											<span class="title"> <?php echo $sql['nama_menu']; ?> </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<?php }?>
								
								
								<ul class="sub-menu">
									<?php 
									
										$mn=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'sub_menu' and ac.akses='Y' order by mn.kode_menu asc");
										while($mn2=mysql_fetch_array($mn)){
											$mdl=substr($mn2['module'],0,$panjang_modul);
												if($mdl == $mod){
									?>
									<li <?php if ($_GET['module'] == $mn2['module']){ echo "class='active'"; } ?>>
										<a href="<?php echo $mn2['link']; ?>">
											<span class="title"> <?php echo $mn2['nama_menu']; ?> </span>
										</a>
									</li>
									<?php
											}
										}
									?>
																		
								</ul>
							</li>
						
						
						<?php
							}
							}
					
						?>
						</ul> 
						
						<?php  
							$menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.jenis_bisnis = 'SALES'  and mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' and ac.akses='Y' order by mn.kode_menu asc");
							$jml_record = mysql_num_rows($menu);
							
							if ($jml_record > 0){
								
								
								
						?>
						
						<div class="menu-utama ">
							<div class="item-content <?php if (substr($_GET['module'],0,8)!='showroom' and substr($_GET['module'],0,7)!='service' and substr($_GET['module'],0,6)!='konfig'){ echo "active"; } ?> " onclick = "show_menu('showroom'); hide_menu('service');">
								<div class="item-media">
									<i class="ti-car"></i>
								</div>
								<div class="item-inner">
									<span class="title" > Sales</span><i class="ti-plus pull-right" ></i>
								</div>
							</div>
						</div>
						
						
						
						
						<ul  class="main-navigation-menu" id = "showroom" <?php if (substr($_GET['module'],0,8)!='showroom' and substr($_GET['module'],0,7)!='service' and substr($_GET['module'],0,6)!='konfig'){ echo "style=' display:block;'"; }else {echo "style=' display:none;'";} ?> >	
						<?php  
						 $menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.jenis_bisnis = 'SALES'  and mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' order by mn.kode_menu asc");
						 while($sql=mysql_fetch_array($menu)){
							$kd_menu=$sql['kode_menu'];
							$modul=$sql['module'];
							$panjang_modul = strlen($modul);
							$nama_menu=$sql['nama_menu'];
							$link=$sql['link'];
							$lvlmn=$sql['level_menu'];
							$accs=$sql['akses'];
							
							$mod=substr($sql['module'],0,$panjang_modul);
							
								if($accs == 'Y'){
						?>
						
							<li <?php if (substr($_GET['module'],0,$panjang_modul) == $sql['module']) { echo "class='active open'"; } ?>>
								
								<?php { ?>
								
								<a href="<?php echo $sql['link']; ?>">
									<div class="item-content">
										<div class="item-media">
											<i class="<?php echo $sql['icon']; ?>"></i>
										</div>
										<div class="item-inner">
											<span class="title"> <?php echo $sql['nama_menu']; ?> </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<?php }?>
								
								
								<ul class="sub-menu">
									<?php 
									
										$mn=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'sub_menu' and ac.akses='Y' order by mn.kode_menu asc");
										while($mn2=mysql_fetch_array($mn)){
											$mdl=substr($mn2['module'],0,$panjang_modul);
												if($mdl == $mod){
									?>
									<li <?php if ($_GET['module'] == $mn2['module']){ echo "class='active'"; } ?>>
										<a href="<?php echo $mn2['link']; ?>">
											<span class="title"> <?php echo $mn2['nama_menu']; ?> </span>
										</a>
									</li>
									<?php
											}
										}
									?>
																		
								</ul>
							</li>
						
						
						<?php
							}
							}
					
						?>
						</ul> 
							<?php  
							$menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.jenis_bisnis = 'SERVICE' and mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' and ac.akses = 'Y' order by mn.kode_menu asc");
							$jml_record = mysql_num_rows($menu);
							
							if ($jml_record > 0){
								
								
								
						?>
						<div class="navbar-title">
							<span>Menu Service</span>
						</div>
						
						<?php
								}
							}
						?>
						<!-- end: MAIN NAVIGATION MENU  !-->
						<?php  
							$menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.jenis_bisnis = 'SERVICE' and mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' and ac.akses = 'Y' order by mn.kode_menu asc");
							$jml_record = mysql_num_rows($menu);
							
							if ($jml_record > 0){
								
								
								
						?>
						
						
						<div class="menu-utama">
							<div class="item-content <?php if (substr($_GET['module'],0,7)=='service'){ echo "active"; } ?>" onclick = "show_menu('service'); hide_menu('showroom');">
										<div class="item-media" style="font-size:17px">
											<i class="ti-dashboard"></i>
										</div>
										<div class="item-inner">
											<span class="title" style="font-size:13px"> Service</span><i class="ti-plus pull-right" ></i>
										</div>
									</div>
						</div>
						
						<?php
							}
						?>
						
						<ul class="main-navigation-menu" id = "service" <?php if (substr($_GET['module'],0,7)==service){ echo "style=' display:block;'"; }else {echo "style=' display:none;'";} ?> >	
						<?php  
						 $menu=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.jenis_bisnis = 'SERVICE' and mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'main_menu' order by mn.kode_menu asc");
						 while($sql=mysql_fetch_array($menu)){
							$kd_menu=$sql['kode_menu'];
							$modul=$sql['module'];
							$panjang_modul = strlen($modul);
							$nama_menu=$sql['nama_menu'];
							$link=$sql['link'];
							$lvlmn=$sql['level_menu'];
							$accs=$sql['akses'];
							
							$mod=substr($sql['module'],0,$panjang_modul);
							
								if($accs == 'Y'){
						?>
						
							<li <?php if (substr($_GET['module'],0,$panjang_modul) == $sql['module']) { echo "class='active open'"; } ?>>
								
								<?php { ?>
								
								<a href="<?php echo $sql['link']; ?>">
									<div class="item-content">
										<div class="item-media">
											<i class="<?php echo $sql['icon']; ?>"></i>
										</div>
										<div class="item-inner">
											<span class="title"> <?php echo $sql['nama_menu']; ?> </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<?php }?>
								
								
								<ul class="sub-menu">
									<?php 
									
										$mn=mysql_query("SELECT mn.*, ac.* FROM menu mn, akses ac WHERE mn.kode_menu = ac.kode_menu and ac.level='$_SESSION[leveluser]' and mn.level_menu = 'sub_menu' and ac.akses='Y' order by mn.kode_menu asc");
										while($mn2=mysql_fetch_array($mn)){
											$mdl=substr($mn2['module'],0,$panjang_modul);
												if($mdl == $mod){
									?>
									<li <?php if ($_GET['module'] == $mn2['module']){ echo "class='active'"; } ?>>
										<a href="<?php echo $mn2['link']; ?>">
											<span class="title"> <?php echo $mn2['nama_menu']; ?> </span>
										</a>
									</li>
									<?php
											}
										}
									?>
																		
								</ul>
							</li>
						
						
						<?php
							}
							}
					
						?>
						</ul>
						<ul class="folders">
							<li>
								<a href="../logout.php">
									<div class="item-content">
										<div class="item-media">
											<span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-sign-out fa-stack-1x fa-inverse"></i> </span>
										</div>
										<div class="item-inner">
											<span class="title"> Keluar </span>
										</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="wrapper">
							<a href="#" class="button-o">
								<i class="ti-help"></i>
								<span>Butuh Bantuan</span>
							</a>
						</div>
						<!-- end: DOCUMENTATION BUTTON -->
					
					</nav>
				</div>
			</div>
			<!-- / sidebar -->
			<div class="app-content">
				<!-- start: TOP NAVBAR -->
				<header class="navbar navbar-default navbar-static-top">
					<!-- start: NAVBAR HEADER -->
					<div class="navbar-header">
						<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
							<i class="ti-align-justify"></i>
						</a>
						<a class="navbar-brand" href="#">
							<img src="assets/images/logo_honda.png" alt="Honda"/>
						</a>
						<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
							<i class="ti-align-justify"></i>
						</a>
						
						
						<a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<!--span class="sr-only">Toggle navigation</span-->
							<i class="ti-user"></i>
							<?php 
								if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='MNGR' || $_SESSION['leveluser']=='DRKSI' || $_SESSION['leveluser']=='user' || 
								$_SESSION['leveluser']=='HRD' || $_SESSION['leveluser']=='staff_logistik' || $_SESSION['leveluser']=='mngr_bengkel' || ($_SESSION['leveluser']=='supervisor' and $_SESSION['username']=='sudi') ||
								$_SESSION['leveluser']=='ar_finance' || $_SESSION['leveluser']=='spv_finance' ){
							?>
							<span class="badge partition-red" id="jmlh" style="background-color:red;">0</span> <!--i class="ti-comment"></i-->
							<?php
								}
							?>
						</a>
					</div>
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					<!--<script src="notif.js"></script>-->

					
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-right">
							<!-- start: MESSAGES DROPDOWN -->
							<li class="dropdown">
								<?php 
									if ($_SESSION['username']=='farros' ||  $_SESSION['leveluser']=='MNGR' ||  $_SESSION['leveluser']=='mngr_bengkel' ||  $_SESSION['leveluser']=='DRKSI'){
								?>
								<a id = "pesan_pengecekan" href class="dropdown-toggle" data-toggle="dropdown">
									<span class="badge partition-red" id="hasil_pengecekan" style="background-color:red;">0</span> <i class="fa fa-check-square-o"></i> 
									<span>Setujui Pengecekan</span>
								</a>
								<ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
									<li>
										<span class="dropdown-header">Hasil Pengecekan Showroom dan Service</span>
									</li>
									<li>
										<div class="drop-down-wrapper ps-container">
											<ul id = "konten-info-pengecekan" style="overflow:scroll;height:400px;">
												
											</ul>
										</div>
									</li>
									
								</ul>
								<?php
									}
								?>
							</li>
							<li class="dropdown">
								<?php 
									if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='HRD' or ($_SESSION['leveluser']=='supervisor' and $_SESSION['username']=='supervisor' )){
								?>
								<a id = "pesan_showroom" href class="dropdown-toggle" data-toggle="dropdown">
									<span class="badge partition-red" id="jmlh_showroom" style="background-color:red;">0</span> <i class="ti-check"></i> 
									<span>Aktivitas</span>
								</a>
								<ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
									<li>
										<span class="dropdown-header"> Aktivitas Pengecekan Showroom dan Service</span>
									</li>
									<li>
										<div class="drop-down-wrapper ps-container">
											<ul id = "konten-info-showroom" style="overflow:scroll;height:400px;">
											</ul>
										</div>
									</li>
								</ul>
								<?php
									}
								?>
							</li>
							
							<li class="dropdown">
								<?php 
									if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='MNGR' || $_SESSION['leveluser']=='DRKSI' || $_SESSION['leveluser']=='user' || $_SESSION['leveluser']=='staff_logistik' ||
									$_SESSION['leveluser']=='salesadm' || $_SESSION['leveluser']=='staff_salesadm' || $_SESSION['leveluser']=='supervisor' || $_SESSION['leveluser']=='mngr_finance' ||
									$_SESSION['leveluser']=='ar_finance' || $_SESSION['leveluser']=='spv_finance'){


								?>
								<a id = "pesan" href class="dropdown-toggle" data-toggle="dropdown">
									<span class="badge partition-red" id="jmlh2" style="background-color:red;">0</span> <i class="ti-comment"></i> 
									<span>Pengajuan</span>
								</a>
								<ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
									<li>
										<span class="dropdown-header"> Pengajuan</span>
									</li>
									<li>
										<div class="drop-down-wrapper ps-container">
											<ul id = "konten-info" style="overflow:scroll;height:300px;">

											</ul>
										</div>
									</li>
									<!--li class="view-all">
										<a href="#">
											See All
										</a>
									</li-->
								</ul>
								<?php
									}
									?>
							</li>
							

							
							<!-- end: MESSAGES DROPDOWN -->
							<!-- start: ACTIVITIES DROPDOWN -->
							<!--li class="dropdown">
								<a href class="dropdown-toggle" data-toggle="dropdown">
									<i class="ti-check-box"></i> <span>ACTIVITIES</span>
								</a>
								<ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
									<li>
										<span class="dropdown-header"> You have new notifications</span>
									</li>
									<li>
										<div class="drop-down-wrapper ps-container">
											<div class="list-group no-margin">
												<a class="media list-group-item" href="">
													<img class="img-circle" alt="..." src="assets/images/avatar-1.jpg">
													<span class="media-body block no-margin"> Use awesome animate.css <small class="block text-grey">10 minutes ago</small> </span>
												</a>
												<a class="media list-group-item" href="">
													<span class="media-body block no-margin"> 1.0 initial released <small class="block text-grey">1 hour ago</small> </span>
												</a>
											</div>
										</div>
									</li>
									<li class="view-all">
										<a href="#">
											See All
										</a>
									</li>
								</ul>
							</li-->
							<!-- end: ACTIVITIES DROPDOWN -->
							<!-- start: LANGUAGE SWITCHER -->
							<!--li class="dropdown">
								<a href class="dropdown-toggle" data-toggle="dropdown">
									<i class="ti-world"></i> English
								</a>
								<ul role="menu" class="dropdown-menu dropdown-light fadeInUpShort">
									<li>
										<a href="#" class="menu-toggler">
											Deutsch
										</a>
									</li>
									<li>
										<a href="#" class="menu-toggler">
											English
										</a>
									</li>
									<li>
										<a href="#" class="menu-toggler">
											Italiano
										</a>
									</li>
								</ul>
							</li-->
							<!-- start: LANGUAGE SWITCHER -->
							<!-- start: USER OPTIONS DROPDOWN -->
							<li class="dropdown current-user">
								<a href class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?php echo 'image/small_'.$_SESSION['foto']; ?>" alt="<?php echo "".$_SESSION['namalengkap']."";?>"> <span class="username"><?php echo "".$_SESSION['namalengkap']."";?> <i class="ti-angle-down"></i></i></span>
								</a>
								<ul class="dropdown-menu dropdown-dark">
									<!--<li>
										<a href="pages_user_profile.html">
											My Profile
										</a>
									</li>
									<li>
										<a href="pages_calendar.html">
											My Calendar
										</a>
									</li>
									<li>
										<a hef="pages_messages.html">
											My Messages (3)
										</a>
									</li>
									<li>
										<a href="login_lockscreen.html">
											Lock Screen
										</a>
									</li> -->
									<li>
										<a href="logout.php">
											Log Out
										</a>
									</li>
								</ul>
							</li>
							<!-- end: USER OPTIONS DROPDOWN -->
						</ul>
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
						<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<div class="arrow-left"></div>
							<div class="arrow-right"></div>
						</div>
						<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
					</div>
					
					
					<!--a class="dropdown-off-sidebar" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
						&nbsp;
					</a-->
					<!-- end: NAVBAR COLLAPSE -->
				</header>
				<!-- end: TOP NAVBAR -->
				
				<?php include('content.php')?>
				
				
				
				
				
			</div>	
			<!-- start: FOOTER -->
			<footer>
				<div class="footer-inner">
					<div class="pull-left">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Honda Bintaro</span>. <span>All rights reserved</span>
					</div>
					<div class="pull-right">
						<span class="go-top"><i class="ti-angle-up"></i></span>
					</div>
				</div>
			</footer>
			<!-- end: FOOTER -->	
				
			<!-- start: SETTINGS -->
			<div class="settings panel panel-default hidden-xs hidden-sm" id="settings">
				<button ct-toggle="toggle" data-toggle-class="active" data-toggle-target="#settings" class="btn btn-default">
					<i class="fa fa-spin fa-gear"></i>
				</button>
				<div class="panel-heading">
					Style Selector
				</div>
				<div class="panel-body">
					<!-- start: FIXED HEADER -->
					<div class="setting-box clearfix">
						<span class="setting-title pull-left"> Fixed header</span>
						<span class="setting-switch pull-right">
							<input type="checkbox" class="js-switch" id="fixed-header" />
						</span>
					</div>
					<!-- end: FIXED HEADER -->
					<!-- start: FIXED SIDEBAR -->
					<div class="setting-box clearfix">
						<span class="setting-title pull-left">Fixed sidebar</span>
						<span class="setting-switch pull-right">
							<input type="checkbox" class="js-switch" id="fixed-sidebar" />
						</span>
					</div>
					<!-- end: FIXED SIDEBAR -->
					<!-- start: CLOSED SIDEBAR -->
					<div class="setting-box clearfix">
						<span class="setting-title pull-left">Closed sidebar</span>
						<span class="setting-switch pull-right">
							<input type="checkbox" class="js-switch" id="closed-sidebar" />
						</span>
					</div>
					<!-- end: CLOSED SIDEBAR -->
					<!-- start: FIXED FOOTER -->
					<div class="setting-box clearfix">
						<span class="setting-title pull-left">Fixed footer</span>
						<span class="setting-switch pull-right">
							<input type="checkbox" class="js-switch" id="fixed-footer" />
						</span>
					</div>
					<!-- end: FIXED FOOTER -->
					<!-- start: THEME SWITCHER -->
					<div class="colors-row setting-box">
						<div class="color-theme theme-1">
							<div class="color-layout">
								<label>
									<input type="radio" name="setting-theme" value="theme-1">
									<span class="ti-check"></span>
									<span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
									<span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
								</label>
							</div>
						</div>
						<div class="color-theme theme-2">
							<div class="color-layout">
								<label>
									<input type="radio" name="setting-theme" value="theme-2">
									<span class="ti-check"></span>
									<span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
									<span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
								</label>
							</div>
						</div>
					</div>
					<div class="colors-row setting-box">
						<div class="color-theme theme-3">
							<div class="color-layout">
								<label>
									<input type="radio" name="setting-theme" value="theme-3">
									<span class="ti-check"></span>
									<span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
									<span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
								</label>
							</div>
						</div>
						<div class="color-theme theme-4">
							<div class="color-layout">
								<label>
									<input type="radio" name="setting-theme" value="theme-4">
									<span class="ti-check"></span>
									<span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
									<span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
								</label>
							</div>
						</div>
					</div>
					<div class="colors-row setting-box">
						<div class="color-theme theme-5">
							<div class="color-layout">
								<label>
									<input type="radio" name="setting-theme" value="theme-5">
									<span class="ti-check"></span>
									<span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
									<span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
								</label>
							</div>
						</div>
						<div class="color-theme theme-6">
							<div class="color-layout">
								<label>
									<input type="radio" name="setting-theme" value="theme-6">
									<span class="ti-check"></span>
									<span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"></span> </span>
									<span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span>
								</label>
							</div>
						</div>
					</div>
					<!-- end: THEME SWITCHER -->
				</div>
			</div>
			<!-- end: SETTINGS -->
		</div>
		
		<!-- Start Ajax Post Php -->
		<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
		<!--script type="text/javascript" src="vendor/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="vendor/jquery/jquery-1.7.2.min"></script>
		
		<!-- End Ajax Post Php -->
		
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		
		<!-- start: JAVASCRIPTS DATE/TIME PICKER -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/Chart.js/Chart.min.js"></script>
		<script src="vendor/jquery.sparkline/jquery.sparkline.min.js"></script>
		
		<script src="assets/js/main.js"></script>		
		<script src="assets/js/index.js"></script>
		<!--script src="assets/js/summary.js"></script-->	
		
		
		<?php
			if($_GET['module']=='summary_penjualan_semua_data_sales' or $_GET['module']=='summary_penjualan_spk'){
		?>
		<script src="assets/js/faktur_penjualan.js"></script>
		<?php
			}
		?>
		
		<?php
			if($_GET['module']=='service_summary_service_semua_sa'){
		?>
		<script src="assets/js/summary_faktur_service.js"></script>
		<?php
			}
		?>
		
		<?php
			if($_GET['module']=='summary_penjualan_asuransi'){
		?>
		<script src="assets/js/asuransi_penjualan.js"></script>
		<?php
			}
		?>
		<?php
			if($_GET['module']=='summary_penjualan_komparasi_spk' || $_GET['module']=='summary_penjualan_komparasi_faktur'){
		?>
		<script src="assets/js/grafik_komparansi.js"></script>
		<?php
			}
		?>
		<?php	
			if($_GET['module']=='service_summary_service_booking_srv'){
		?>
		<script src="assets/js/grafik_bookingsrv.js"></script>
		<?php
			}
		?>
		
		
		<?php
			if($_GET['module']=='prospek_test_drive'){
		?>
		<script src="assets/js/pages-calendar.js"></script>
		<script src="assets/js/maps-test.js"></script>
		<?php
			}
		?>
		<!--script src="assets/js/faktur_penjualan2.js"></script-->
		<script src="vendor/bootstrap-fileinput/jasny-bootstrap.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<!-- start: JavaScript for data table -->
		
		<script src="vendor/DataTables/jquery.dataTables.js"></script>
		<script src="assets/js/table-data.js"></script>
		<!-- start: JavaScript for data table -->
		<script src="vendor/ladda-bootstrap/spin.min.js"></script>
		<script src="vendor/ladda-bootstrap/ladda.min.js"></script>
		<script src="assets/js/ui-buttons.js"></script>
		<!-- start: JavaScript for data table -->
		<!--- FORM VALIDATION -->
		<script src="vendor/ckeditor/ckeditor.js"></script>
		<script src="vendor/ckeditor/adapters/jquery.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/form-validation.js"></script>
		<!--- FORM VALIDATION -->
		
		<!--- DATETIMEPICKER -->
		<script src="moment-with-locales.js"></script>
		<script src="bootstrap-datetimepicker.js"></script>
		<script src="bootstrap.timepicker.js"></script>
		
		<script type="text/javascript">
			$('#datetimepicker1').datetimepicker();
			$('#datetimepicker2').datetimepicker();
		</script>
		
		<link href="vendor/fullcalendar/fullcalendar.min.css" rel="stylesheet" media="screen">
		<!--- DATETIMEPICKER -->
		
		
		<!-- end: JAVASCRIPTS buat sweet alert -->
		<script src="vendor/sweetalert/sweet-alert.min.js"></script>
		<script src="vendor/toastr/toastr.min.js"></script>	
		<!-- start: JavaScript Event Handlers for this page -->
		
		
		
	<!--	=========================== Calendar ================================  -->
	

	<!-- end: MAIN JAVASCRIPTS -->
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="vendor/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	<script src="vendor/moment/moment.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
	<script src="vendor/fullcalendar/fullcalendar.min.js"></script>
	<script src="vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/main.js"></script>
	<!-- start: JavaScript Event Handlers for this page -->
	<script src="assets/js/pages-calendar.js"></script>
	
	
	<!--	=========================== Calendar ================================  -->
	
	
	
	<!--	=========================== Toogle on off ================================  -->
	<link href="vendor/bootstrap-toggle/css/bootstrap-toggle.css" rel="stylesheet">
	<script src="vendor/bootstrap-toggle/js/bootstrap-toggle.js"></script>
		
	<?php
		include "notifikasi.php";
	?>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Calendar.init();
				UIButtons.init();
				FormElements.init();
				//FormValidator.init();
				TableData.init();
				Charts.init();
				//Index.init();
				
			});
		</script>

		
		<script type="text/javascript">
		
			
		
			
			
			
			/*
			$('.metodebayar').on('change',function(){
				//var package = $('.metodebayar').val();
				var metodebyr = $('input[name=cara_beli]:checked').val();
				
				
				document.getElementById("leasing").selectedIndex = "0";
				document.getElementById("tenor").selectedIndex = "0";
				if (metodebyr == "TUNAI"){
					$("#id_leasing").hide();
					$("#id_tenor").hide();
					$("#jenis_asuransi").hide();
					
					
					$("#refund").val(0);
					//$("#leasing").selectedIndex = "0";
					document.getElementById("leasing").selectedIndex = "0";
					document.getElementById("tenor").selectedIndex = "0";
					document.getElementById("radio7").checked = false;
					//document.getElementById("radio8").checked = false;
					
					
					$("#ikut_asuransi").show();
					$("#id_ikut_asuransi").show();
					
					
				}
					if (metodebyr == "KREDIT"){
					$("#id_leasing").show();
					$("#id_tenor").show(); 
					$("#refund").show();
					$("#ikut_asuransi").hide();
					
					document.getElementById("radio20").checked = false;
					document.getElementById("radio21").checked = false;
					document.getElementById("asuransi").selectedIndex = "0"; 	
				}
					if (metodebyr == "GSO" || metodebyr == "COP"){
					$("#id_leasing").hide();
					$("#id_tenor").hide();
					$("#jenis_asuransi").hide();
                    //$("#refund").hide();
					$("#refund").val(0);
					$("#ikut_asuransi").show();
					
				}
			})
			
			*/
			
			
		//==============================================================================================================
		//======================================================= UNTUK SHOW HIDE SUPERVISOR PADA INPUT USER LOGIN =======================================================
			$('#id_level').on('change',function(){
				var id_level = $('#id_level').val();
				if (id_level == "user"){
					$("#id_spv").show();
					$("#kodesales").show();
				}else{
					$("#id_spv").hide();
					$("#kodesales").hide();
				}
			})
		
		//==========================================================================================
		//=============== UNTUK TIPE PADA LIHAT STOCK==============================
			$('#model').on('change',function(){
				var isi = $('#model').val();
				$.ajax({
					method : "post",
					url : "get_tipe.php",
					data : {data_ajax : isi},
					success : function(data){
						$('#tipe').html(data);
						//console.log(data);
					}
					
				})
			})
		
		
			$('#tipe').on('change',function(){
				var isi = $('#tipe').val();
				$.ajax({
					method : "post",
					url : "get_warna.php",
					data : {data_ajax : isi},
					success : function(data){
						$('#warna').html(data);
						//console.log(data);
					}
					
				})
			})
		
		
		<!-- BUAT NYARI SALES -->
		
			$('#idspvtarget').on('change',function(){
		//	$('#id_spv').on('click',function(){
				//alert('TEST');
				//console.log("MJJ");
				var isipd = $('#idspvtarget').val();
				$.ajax({
					method : "post",
					url : "modul/master_data_showroom/get_data/get_data_sales.php",
					data : {data_ajax : isipd},
					success : function(data){
						$('#tampil_data_sales').html(data);
					
					}
					
				})	
			})
		
		
			
			function tambah2(){
			//	document.getElementById("demo").innerHTML = add();
				var f = add();
				var z = y;
				console.log(z);
			
			}
			
			
			function match() {
				var input = $('#cari').val();
				$('#cari').keyup(function(){
					$.ajax({
						method : "post",
						url : "crud7.php",
						data : {data : input},
						success : function(data){
							var dd = data.toString();
							var d = dd.trim();
							var dat = d.split(",");
							var k = 5;
							var dataa = dat.slice(0, k);
							var m = d.match(input);
					
							console.log(dataa);
							$('#bd').html(dataa);
						}
					})
				})
			
			}
			
	
		//BIAR ABIS LODING LANGSUNG NAMPILIN HALAMAN CUY
		$('#myModal').modal('show');
		
        $(window).load(function() { $(".preload-wrapper").fadeOut("slow"); })
		
		$(".preload-wrapper6").hide();
		
		</script>
    
    <!--script type='text/javascript'> 
     $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
     });
     </script-->
    <script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
	
	<!--script>
		$('.bootstrap-timepicker').timepicker();
	</script-->
	<script>
		$("#datetimepicker2").datetimepicker({
			showClear: true,
			format: 'HH:mm',
		});
		$("#datetimepicker2").val("00:00:00").change();
	</script>
	<script type="text/javascript">
		$(function () {
			$('#datetimepicker3').datetimepicker({
				format: 'LT'
			});
		});
	</script>
	
	
	
	
	
	</body>
</html>
<?php
}
}
?>
