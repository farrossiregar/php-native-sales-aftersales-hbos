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



//	SUB TRANSAKSI
//	TRANSAKSI SHOWROOM

/*

if ($_GET['module']==sub_transaksi_stock)
{
	include "modul/transaksi_stock_online.php";
}

if ($_GET['module']==sub_transaksi_faktur_fiktif)
{
	include "modul/transaksi_faktur_fiktif.php";
}

if ($_GET['module']==sub_transaksi_booking_stock)
{
	include "modul/booking_stock.php";
}

if ($_GET['module']==sub_transaksi_stock_teralokasi)
{
	include "modul/stock_teralokasi.php";
}

if ($_GET['module']==sub_transaksi_pengajuan_discount)
{
	include "modul/pengajuan_diskon/pengajuan_discount.php";
}

if ($_GET['module']==logistik_puk)
{
	include "modul/permohonan_unit_keluar/permohonan_unit_keluar.php";
}

if ($_GET['module']==sub_transaksi_alokasi_unit_hpm)
{
	include "modul/alokasi_unit_hpm/alokasi_unit_hpm.php";
}

if ($_GET['module']==sub_transaksi_acchv)
{
	include "modul/transaksi_generalrepair.php";
}

if ($_GET['module']==sub_transaksi_input_discount)
{
	include "modul/input_discount_spk.php";
}

*/

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
	include "modul/test_drive/test_drive.php";
}

if ($_GET['module']==prospek_pengajuandiscount)
{
	include "modul/pengajuan_diskon/pengajuan_discount.php";
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

if ($_GET['module']==penjualan_terbaik_sales)
{
	include "modul/penjualan_terbaik/penjualan_terbaik_sales.php";
}
if ($_GET['module']==penjualan_terbaik_supervisor)
{
	include "modul/penjualan_terbaik/penjualan_terbaik_spv.php";
}

if ($_GET['module']==ekspor)
{
	include "modul/ekspor.php";
}



//	CHECKLIST
if ($_GET['module']==sub_master_checklist_pameran)
{
	include "modul/master_data_pameran/input_checklist_pameran.php";
}

if ($_GET['module']==checklist_checklist_pameran)
{
	include "modul/master_data_pameran/checklist_pameran.php";
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



// GENERAL REPAIR



//summary service new
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