<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
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
  
  
}
else{ include "konfigurasi.php";
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
		<title>Manager Target - Honda Bintaro.</title>
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
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
		<!-- end: CLIP-TWO CSS -->
        
			
		
		
		
	</head>
	<!-- end: HEAD -->
	<body>
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
						<!--div class="navbar-title">
							<span>Main Navigation</span>
						</div-->
						<ul class="main-navigation-menu">
							<li <?php if ($_GET['module']==home){ echo "class='active open'"; } ?>>
								<a href="media.php?module=home">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-home"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Home </span>
										</div>
									</div>
								</a>
							</li>
							<li <?php if (substr($_GET['module'],0,10) == 'sub_master') { echo "class='active open'"; } ?>>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-settings"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Master Data </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									
									<li <?php if ($_GET['module']=='sub_master_list_users'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_master_list_users">
											<span class="title"> Tabel User </span>
										</a>
									</li>
									<li <?php if ($_GET['module']=='sub_master_list_kategori'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_master_list_kategori">
											<span class="title"> Tabel Kategori </span>
										</a>
									</li>
									<li <?php if ($_GET['module']=='sub_master_list_item_control'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_master_list_item_control">
											<span class="title"> Tabel Item Control </span>
										</a>
									</li>
									<li <?php if ($_GET['module']=='sub_master_list_asuransi'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_master_list_asuransi">
											<span class="title"> Tabel Asuransi </span>
										</a>
									</li>
								</ul>
							</li>
							<li <?php if (substr($_GET['module'],0,10) == 'sub_target') { echo "class='active open'"; } ?>>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-write"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Target </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									<li <?php if ($_GET['module']=='sub_target_data'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_target_data">
											<span class="title">Data Target</span>
										</a>
									</li>								
									
								</ul>
							</li>
							<li <?php if (substr($_GET['module'],0,13) == 'sub_transaksi') { echo "class='active open'"; } ?>>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-pencil-alt"></i>
										</div>
										<div class="item-inner">
											<span class="title"> General Repair </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									<li <?php if ($_GET['module']=='sub_transaksi_acchv'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_transaksi_acchv">
											<span class="title"> Service Advisor </span>
										</a>
									</li>
									<li <?php if ($_GET['module']=='sub_transaksi_jcgr'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_transaksi_jcgr">
											<span class="title"> Job Control </span>
										</a>
									</li>
								</ul>
							</li>
							<li <?php if (substr($_GET['module'],0,14) == 'sub_bodyrepair') { echo "class='active open'"; } ?>>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-notepad"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Body Repair </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									<li <?php if ($_GET['module']=='sub_bodyrepair'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_bodyrepair">
											<span class="title"> Service Advisor </span>
										</a>
									</li>
									<li <?php if ($_GET['module']=='sub_bodyrepair_jobcontrol'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_bodyrepair_jobcontrol">
											<span class="title"> Job Control </span>
										</a>
									</li>
								</ul>
							</li>
							
							<li <?php if (substr($_GET['module'],0,11) == 'sub_history') { echo "class='active open'"; } ?>>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-agenda"></i>
										</div>
										<div class="item-inner">
											<span class="title"> History </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									<li <?php if ($_GET['module']=='sub_history_GR'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_history_GR">
											<span class="title">History General Repair</span>
										</a>
									</li>	
									
									<li <?php if ($_GET['module']=='sub_history_BP'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_history_BP">
											<span class="title">History Body Repair</span>
										</a>
									</li>	
								</ul>
							</li>
							<li <?php if (substr($_GET['module'],0,11) == 'sub_summary') { echo "class='active open'"; } ?>>
								<a href="javascript:void(0)">
									<div class="item-content">
										<div class="item-media">
											<i class="ti-book"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Summary </span><i class="icon-arrow"></i>
										</div>
									</div>
								</a>
								<ul class="sub-menu">
									<li <?php if ($_GET['module']=='sub_summary_service'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_summary_service">
											<span class="title">General Repair</span>
										</a>
									</li>	
									<li <?php if ($_GET['module']=='sub_summary_bodyrepair'){ echo "class='active'"; } ?>>
										<a href="media.php?module=sub_summary_bodyrepair">
											<span class="title">Body Repair</span>
										</a>
									</li>
										
								</ul>
							</li>
						</ul>
						<!-- end: MAIN NAVIGATION MENU -->
						<!-- start: CORE FEATURES -->
						<div class="navbar-title">
							<span>Core Features</span>
						</div>
						<ul class="folders">
							<li>
								<a href="pages_calendar.html">
									<div class="item-content">
										<div class="item-media">
											<span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
										</div>
										<div class="item-inner">
											<span class="title"> Calendar </span>
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="pages_messages.html">
									<div class="item-content">
										<div class="item-media">
											<span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-folder-open-o fa-stack-1x fa-inverse"></i> </span>
										</div>
										<div class="item-inner">
											<span class="title"> Messages </span>
										</div>
									</div>
								</a>
							</li>
						</ul>
						<!-- end: CORE FEATURES -->
						<!-- start: DOCUMENTATION BUTTON -->
						<div class="wrapper">
							<a href="documentation.html" class="button-o">
								<i class="ti-help"></i>
								<span>Documentation</span>
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
							<span class="sr-only">Toggle navigation</span>
							<i class="ti-view-grid"></i>
						</a>
					</div>
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-right">
							<!-- start: MESSAGES DROPDOWN -->
							<!--li class="dropdown">
								<a href class="dropdown-toggle" data-toggle="dropdown">
									<span class="dot-badge partition-red"></span> <i class="ti-comment"></i> <span>MESSAGES</span>
								</a>
								<ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
									<li>
										<span class="dropdown-header"> Unread messages</span>
									</li>
									<li>
										<div class="drop-down-wrapper ps-container">
											<ul>
												<li class="unread">
													<a href="javascript:;" class="unread">
														<div class="clearfix">
															<div class="thread-image">
																<img src="./assets/images/avatar-2.jpg" alt="">
															</div>
															<div class="thread-content">
																<span class="author">Nicole Bell</span>
																<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
																<span class="time"> Just Now</span>
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="javascript:;" class="unread">
														<div class="clearfix">
															<div class="thread-image">
																<img src="./assets/images/avatar-3.jpg" alt="">
															</div>
															<div class="thread-content">
																<span class="author">Steven Thompson</span>
																<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
																<span class="time">8 hrs</span>
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="javascript:;">
														<div class="clearfix">
															<div class="thread-image">
																<img src="./assets/images/avatar-5.jpg" alt="">
															</div>
															<div class="thread-content">
																<span class="author">Kenneth Ross</span>
																<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
																<span class="time">14 hrs</span>
															</div>
														</div>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="view-all">
										<a href="#">
											See All
										</a>
									</li>
								</ul>
							</li-->
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
									<li>
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
									</li>
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
		<script src="assets/js/summary.js"></script>		 
		<script src="vendor/bootstrap-fileinput/jasny-bootstrap.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<!-- start: JavaScript for data table -->
		
		<script src="vendor/DataTables/jquery.dataTables.min.js"></script>
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
		<script>
			jQuery(document).ready(function() {
				Main.init();
				
				UIButtons.init();
				FormElements.init();
				//FormValidator.init();
				TableData.init();
				Charts.init();
				//Index.init();
				
			});
		</script>
		 <script type="text/javascript">
			$('#id_kategori').on('change',function(){
				var isi = $('#id_kategori').val();
				$.ajax({
					method : "post",
					url : "get_item.php",
					data : {data_ajax : isi},
					success : function(data){
						$('#id_item').html(data);
						//console.log(data);
					}
					
				})
			})
		
		</script>
		
		<script type="text/javascript">
			$('#id_item').on('change',function(){
				var package = $('#id_item').val();
				if (package == 3){
					$("#package").show();
				}
				else {
					$("#package").hide();
				}
			})
			$('#target_dealer').on('blur',function(){
				if ($('#id_kategori').val() == 23 || $('#id_kategori').val() == 7 ){
					$('#target_unit').val($(this).val()/<?php echo "$gjml_sabp"; ?>);
				}
				else {
					$('#target_unit').val($(this).val()/<?php echo "$gjml_sagr"; ?>);
				}
				
			})
		
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
<?php
}
}
?>
