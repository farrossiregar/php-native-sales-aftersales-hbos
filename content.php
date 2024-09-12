<?php 

include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";


////////////////////////////////////////////////////////////////////////
/////////////////////// PENGATURAN MODULE MODULE ///////////////////////
////////////////////////////////////////////////////////////////////////

$module = addslashes($_GET['module']);


if ($_GET['module']==showroom)
{
	include "modul/home_showroom.php";
}



//	KONFIGURASI

if (substr($module,0,6) == "konfig"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		include "modul/konfigurasi/$module.php";
	}
}

//	PROSPEK
if ($_GET['module']==prospek_test_drive)
{
	include "modul/prospek/test_drive/test_drive.php";
}
/*
if ($_GET['module']==prospek_pengajuandiscount)
{
	include "modul/pengajuan_diskon/pengajuan_discount.php";
}

*/

if (substr($module,0,7) == "prospek"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}

// SUMMARY PENJUALAN


if (substr($module,0,17) == "summary_penjualan"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}


// AKSESORIS

if (substr($module,0,9) == "aksesoris"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}

// LOGISTIK

if (substr($module,0,8) == "logistik"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		include "modul/logistik/$module.php";
	}
}

//	INFORMASI & BERITA

if ($_GET['module']==info_promo_lihat)
{
	include "modul/promo_info.php";
}


//	PENJUALAN TERBAIK
if (substr($module,0,17) == "penjualan_terbaik"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}

//ekspor
if ($_GET['module']==ekspor)
{
	include "modul/ekspor.php";
}



//	CHECKLIST
/*if (substr($module,0,9) == "checklist"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}*/

if ($_GET['module']==checklist_checklist_pameran)
{
	include "modul/master_data_pameran/checklist_pameran.php";
}

if ($_GET['module']==checklist_checklist_summary_pameran)
{
	include "modul/master_data_pameran/checklist_summary_pameran.php";
}

if ($_GET['module']==checklist_showroom)
{
	include "modul/checklist_showroom/checklist_showroom.php";
}

if ($_GET['module']==checklist_penampilan_sales)
{
	include "modul/checklist_penampilan_sales/checklist_penampilan_sales.php";
}



// INPUT TARGET SHOWROOM


/*if (substr($module,0,17) == "sub_master"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}
*/

if ($_GET['module']==sub_master_target_penjualan_salesman)
{
	include "modul/master_data_showroom/target_penjualan_salesman.php";
}

if ($_GET['module']==sub_master_target_penjualan_supervisor)
{
	include "modul/master_data_showroom/target_penjualan_supervisor.php";
}

if ($_GET['module']==sub_master_target_penjualan_per_model)
{
	include "modul/master_data_showroom/target_penjualan_per_model.php";
}

if ($_GET['module']==sub_master_target_insentif_sales)
{
	include "modul/master_data_showroom/insentif_sales.php";
}

if ($_GET['module']==sub_master_target_insentif_plafon)
{
	include "modul/master_data_showroom/insentif_plafon_sales.php";
}




// GENERAL REPAIR


if (substr($module,0,22) == "service_general_repair"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}
/*
if ($_GET['module']==service_general_repair_booking_service)
{
	include "modul/booking_service/booking_service.php";
}

if ($_GET['module']==service_general_repair_history_service)
{
	include "modul/general_repair/general_repair_history_service.php";
}*/


//summary service new
if (substr($module,0,23) == "service_summary_service"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}

// checklist
/*if (substr($module,0,17) == "service_checklist"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}*/


if ($_GET['module']==service_checklist_service)
{
	include "modul/checklist_service/checklist_service.php";
}

if ($_GET['module']==service_checklist_penampilan_sa)
{
	include "modul/checklist_penampilan_sa/checklist_penampilan_sa.php";
}

//Target service
if (substr($module,0,29) == "service_master_target_service"){
	$query = mysql_query("select * from menu where module = '$module'");
	
	while ($data_module = mysql_fetch_array($query)){
		$path = $data_module['path'];
		include "modul/$path/$module.php";
	}
}


?>