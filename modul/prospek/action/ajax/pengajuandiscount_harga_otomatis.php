<?php
if (count($_GET)){
include '../../../../config/koneksi.php';


$tipe = $_GET['tipe_mobil'];
$warna = $_GET['warna'];
$tahun_buat = $_GET['tahun_buat'];

$hari_ini = date('Y-m-d');


$tgl_pengajuan = $_GET['tgl_pengajuan'];
//$no_pengajuan = $_GET['no_pengajuan'];
$no_spk = $_GET['no_spk'];


if ($no_spk == ""){

	$uery = mysql_query("select tw.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon from tipe_warna tw 
	left join plafon_diskon pf on pf.kode_tipe = tw.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$hari_ini' >= pf.tgl_awal and '$hari_ini' <= pf.tgl_akhir)
	where tw.kode_tipe = '$tipe' and tw.kode_warna = '$warna'  ");

	$record_warna = mysql_num_rows($uery);

	if ($record_warna >0){
		$hasil = mysql_fetch_array($uery); 
		$data = array(
					'harga'      =>  $hasil['harga_jual'],
					'tipe'   =>  $hasil['kode_tipe'],
					'plafon_diskon'   =>  $hasil['plafon_diskon'],);
		echo json_encode($data);
		
		} else {
		
		$cuery = mysql_query("SELECT t.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon FROM tipe t 
		left join plafon_diskon pf on pf.kode_tipe = t.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$hari_ini' >= pf.tgl_awal and '$hari_ini' <= pf.tgl_akhir)
		where t.kode_tipe = '$tipe' ");
		
		$record_tipe = mysql_num_rows($cuery);
		if ($record_tipe >= 1) {
		
		$hasil = mysql_fetch_array($cuery); 
		$data = array(
					'harga'      =>  $hasil['harga_jual'],
					'tipe'   =>  $hasil['kode_tipe'],
					'plafon_diskon'   =>  $hasil['plafon_diskon'],);
		echo json_encode($data);
		}else {
			$data = array(
					'harga'      =>  0,
					'tipe'   => 0,
					'plafon_diskon'   =>  0,);
		echo json_encode($data);
			
		}
	}

}else {
	
	$uery = mysql_query("select tw.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon from tipe_warna tw 
	left join plafon_diskon pf on pf.kode_tipe = tw.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$tgl_pengajuan' >= pf.tgl_awal and '$tgl_pengajuan' <= pf.tgl_akhir)
	where tw.kode_tipe = '$tipe' and tw.kode_warna = '$warna'  ");

	$record_warna = mysql_num_rows($uery);

	if ($record_warna >0){
		$hasil = mysql_fetch_array($uery); 
		$data = array(
					'harga'      =>  $hasil['harga_jual'],
					'tipe'   =>  $hasil['kode_tipe'],
					'plafon_diskon'   =>  $hasil['plafon_diskon'],);
		echo json_encode($data);
		
	} else {
		
		$cuery = mysql_query("SELECT t.*,IFNULL(pf.plafon_diskon,0) as plafon_diskon FROM tipe t 
		left join plafon_diskon pf on pf.kode_tipe = t.kode_tipe and pf.tahun_buat = '$tahun_buat' and ('$tgl_pengajuan' >= pf.tgl_awal and '$tgl_pengajuan' <= pf.tgl_akhir)
		where t.kode_tipe = '$tipe' ");
		
		$record_tipe = mysql_num_rows($cuery);
		if ($record_tipe >= 1) {
		
		$hasil = mysql_fetch_array($cuery); 
		$data = array(
					'harga'      =>  $hasil['harga_jual'],
					'tipe'   =>  $hasil['kode_tipe'],
					'plafon_diskon'   =>  $hasil['plafon_diskon'],);
		echo json_encode($data);
		}else {
			$data = array(
					'harga'      =>  0,
					'tipe'   => 0,
					'plafon_diskon'   =>  0,);
		echo json_encode($data);
			
		}
	}
	
}
}
?>