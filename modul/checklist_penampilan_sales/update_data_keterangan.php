<?php 
	session_start();
	include "../../config/koneksi.php";
	date_default_timezone_set('Asia/Jakarta');

	if(count($_POST)) {
		$filter = $_POST['filter_update'];
		$no = $_POST['id'];
		$no_pengecekan = $_POST['no_pengecekan'];
		$no_pengecekan_mingguan = $_POST['no_pengecekan_mingguan'];
		$kategori_penilaian = $_POST['kategori_penilaian'];
		$nama_penilaian = $_POST['nama_penilaian'];
		$kode_sales = $_POST['kategori_penilaian'];
		$leveluser = $_POST['leveluser'];
		$jam = $_POST['jam_edit'];
		$tanggal = $_POST['tanggal'];
		$catatan_keterangan = $_POST['catatan_keterangan'];
		$catatan_keterangan_cco = $_POST['keterangan'];
		$hasil_penilaian = $_POST['hasil'];
		
		if($filter == '1'){
			$filter_select = "where no = '$no'";
		}elseif($filter == '2'){
			$filter_select = "where kode_sales = '$kode_sales' and tanggal = '$tanggal'";
		}elseif($filter == '3'){
			$filter_select = "where kode_sales = '$kode_sales' and jam = '$jam' and tanggal = '$tanggal'";
		}elseif($filter == '4'){
			$filter_select = "where no_pengecekan = '$no_pengecekan'";
		}else{
			$filter_select = "where no = '$no'";
		}
		
		if($leveluser == 'admin' or ($leveluser=='supervisor' and $_SESSION['username']=='sudi123') or ($leveluser=='supervisor' and $_SESSION['username']=='supervisor')){
			
			mysql_query("UPDATE pengecekan_penampilan_sales_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' $filter_select");
			
		//	mysql_query("UPDATE pengecekan_penampilan_sales_detail SET keterangan_catatan_pengecekan = '$catatan_keterangan' where no = '$no'");
			mysql_query("UPDATE notif_penampilan_sales SET read_admin = 'Y', read_spv = 'Y', read_cco = 'N', notif_cco = 'Y' where kode_sales = '$kategori_penilaian' and no_pengecekan = '$no_pengecekan' and jam = '$jam'");
			header("location:../../../media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$no_pengecekan_mingguan"); 
		}elseif($leveluser == 'CCO' or $leveluser == 'admin'){
			
		//	mysql_query("UPDATE pengecekan_penampilan_sales_detail SET catatan_pengecekan = '$catatan_keterangan_cco', hasil_penilaian = '$hasil_penilaian' where no = '$no'");
			mysql_query("UPDATE pengecekan_penampilan_sales_detail SET catatan_pengecekan = '$catatan_keterangan_cco', hasil_penilaian = '$hasil_penilaian' $filter_select");
			mysql_query("UPDATE notif_penampilan_sales SET read_admin = 'N', notif_admin = 'Y', read_spv = 'N', notif_spv = 'Y', read_cco = 'N', notif_cco = 'Y' where kode_sales = '$kategori_penilaian' and no_pengecekan = '$no_pengecekan' and jam = '$jam'");
			header("location:../../../media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$no_pengecekan_mingguan"); 
		}else{
			
		}
	}
?>


