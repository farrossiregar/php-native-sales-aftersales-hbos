<?php
include "../../../config/koneksi.php";
session_start();

$data = mysql_query("select * from data_mobil where norangka = '$_POST[norangka_local]' ");
$data2 = mysql_fetch_array($data);



$module = $_GET['module'];
$act = $_GET['act'];

$cekdulu= "select * from matching_local where norangka_local='$_POST[norangka_local]' and aktif = 'Y'"; 
$prosescek= mysql_query($cekdulu);
if (mysql_num_rows($prosescek)>0) { //proses mengingatkan data sudah ada
    echo "<script>alert('Mobil sudah di Booking');history.go(-1) </script>";
    //echo "<script>window.location = '/media_showroom.php?module=logistik_lihatstock' </script>;
}

else 
{
    
if ($module == 'logistik_lihatstock' and $act == 'tambah' ){
	$data=mysql_query("select * from matching_local order by nounique")  ;
				  while ($r = mysql_fetch_array($data)){
					$nounique = $r['nounique'];
				  }
				  $nounique=$nounique+1;
				  
				  if ($_SESSION[leveluser]=='supervisor' ){
				      mysql_query("insert into matching_local (tgl,norangka_local,aktif,nama_sales_local,nounique,fix,user,no_spk_local,nama_customer_local,jenis_pembayaran_local) values 
								('$_POST[tgl]','$_POST[norangka_local]','Y','$_POST[nama_sales_local]','$nounique','N','$_SESSION[username]','$_POST[no_spk_local]','$_POST[nama_customer_local]','$_POST[jenis_pembayaran_local]' )");
							
				   
				   
    				    // Untuk merubah status pada data mobil //===========================================
    				  mysql_query("update data_mobil set reserved = 'Y',fixbooked = 'N',bisabooking = 'N' where norangka = '$_POST[norangka_local]'");
    				  
    				  $data_mobil = mysql_query("select * from data_mobil where norangka = '$_POST[norangka_local]' and nomatching = ''");
    				  $data_mobil_array = mysql_fetch_array($data_mobil);
    				  
    				  $bisabooking = mysql_query("select max(umur) as maxumur,norangka,kode_tipe,kode_warna,umur,reserved,fixbooked FROM data_mobil 
    				  where kode_tipe = '$data_mobil_array[kode_tipe]' and kode_warna = '$data_mobil_array[kode_warna]' and nomatching = '' and reserved !='Y'");
    				  $bisabooking_array = mysql_fetch_array($bisabooking);
    				  
    				  
    				  mysql_query("update data_mobil set bisabooking = 'Y' where kode_tipe = '$bisabooking_array[kode_tipe]' and 
        				  kode_warna = '$bisabooking_array[kode_warna]' and umur = '$bisabooking_array[maxumur]'");
    				  
    				  
				    if (!headers_sent()) { header("location:../../../media_showroom.php?module=logistik_lihatstock");}
				  
				     //===================================================================================
				 
				  }
				 
				  else {
                        mysql_query("insert into matching_local (tgl,norangka_local,aktif,nama_sales_local,nounique,fix,user,no_spk_local,nama_customer_local,jenis_pembayaran_local) values 
								('$_POST[tgl]','$_POST[norangka_local]','Y','$_POST[nama_sales_local]','$nounique','Y','$_SESSION[username]','$_POST[no_spk_local]','$_POST[nama_customer_local]','$_POST[jenis_pembayaran_local]' )");
								
						  // Untuk merubah status pada data mobil //===========================================
        				  
        				  mysql_query("update data_mobil set reserved = 'Y',fixbooked = 'Y',bisabooking = 'N' where norangka = '$_POST[norangka_local]'");
        				  
        				  $data_mobil = mysql_query("select * from data_mobil where norangka = '$_POST[norangka_local]' and nomatching = ''");
        				  $data_mobil_array = mysql_fetch_array($data_mobil);
        				  
        				  $bisabooking = mysql_query("select max(umur) as maxumur,norangka,kode_tipe,kode_warna,umur,reserved,fixbooked FROM data_mobil 
        				  where kode_tipe = '$data_mobil_array[kode_tipe]' and kode_warna = '$data_mobil_array[kode_warna]' and nomatching = '' and reserved !='Y'");
        				  $bisabooking_array = mysql_fetch_array($bisabooking);
        				  
        				  
        				  mysql_query("update data_mobil set bisabooking = 'Y' where kode_tipe = '$bisabooking_array[kode_tipe]' and 
        				  kode_warna = '$bisabooking_array[kode_warna]' and umur = '$bisabooking_array[maxumur]'");
        				  
    				  
				    if (!headers_sent()) { header("location:../../../media_showroom.php?module=logistik_lihatstock");}
				  
				     //===================================================================================
								
								
								
								if (!headers_sent()) { header("location:../../../media_showroom.php?module=logistik_lihatstock");}
								}
                        }		
				
else {
	 mysql_unbuffered_query("delete from matching_local where norangka_local = '$_POST[id]' ");								
	if (!headers_sent()) {header('location:../../../media_showroom.php?module=logistik_lihatstock');}
}

}
?>