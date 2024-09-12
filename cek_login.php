<?php
include "config/koneksi.php";
//include "config/koneksi_service.php";

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  header('location:index.php?error=5');
}
else{
$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
$nama = $r['username'];

//==================	CEK LOGOUT	===================
/*$time = date("Y-m-d H:i:s");
$qry = mysql_query("select * from user_logout where username='$nama' order by logout desc");	
if(strtotime($time) >= strtotime($logout)){
}*/

// Apabila username dan password ditemukan
if ($ketemu > 0){
	
	$query = mysql_query("select username,aktif from user_login where aktif = 'Y' and username = '$username'");
	$jml_data = mysql_num_rows($query);
	if ($jml_data > 0 ){
		
		mysql_query("update user_login set aktif = 'N' where aktif = 'Y' and username = '$username'");
		header('location:index.php?error=6');
		return false;
		
	}
/*	$qry = mysql_query("select * from path where username='$nama'");
	$sql2 = mysql_num_rows($qry);
	$sql = mysql_fetch_array($qry);
		//if($sql2 > 0){	*/
	
  session_start();
  date_default_timezone_set('Asia/Jakarta');
  include "timeout.php";

  //$_SESSION[namauser]     = $r[username];
  $_SESSION[username]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[foto]		  = $r[foto];	
  $_SESSION[bisnis]		  = $r[bisnis];	
  // session timeout
  $_SESSION[login] = 1;
  $_SESSION[email] = $r[email];
  $_SESSION[kode_spv]		  = $r[kode_supervisor];
  $_SESSION[kode_sales]		  = $r[kode_sales];
  timer();

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();
	
	$_SESSION['id_session'] = session_id();
	 
	 
		$last_login = date("Y-m-d H:i:s");
		$tgllalu = date('Y-m-d H:i:s', strtotime('-3 days'));
  mysql_query("UPDATE users SET id_session='$sid_baru',last_login = '$last_login' WHERE username='$username'");
  mysql_query("INSERT into user_login values ('','$username','$last_login','$sid_baru','Y')");
  //mysql_query("UPDATE matching_local set aktif = 'N' where tgl < '$tgllalu' and fix='N'");
  mysql_unbuffered_query("update pengajuan_discount set status_spk = 'N' where tgl_pengajuan_ulang < '$tgllalu' and status_approved = 'Y' and no_spk='' ");
  
  
  /// Nonaktifkan matching lokal untuk yang lebih dari 7 hari ///
  
  $tgl_mundur_matching = date('Y-m-d H:i:s', strtotime('-7 days'));
  
  $query_matching = mysql_query("SELECT ml.aktif,dm.norangka,dm.kode_sales,dm.kode_supervisor FROM data_mobil dm
					left join matching_local ml on ml.norangka_local = dm.norangka
					where dm.nomatching != '' and dm.tglmatching < '$tgl_mundur_matching' and dm.nofaktur = '' and ml.aktif = 'Y'");
						
  while ($data_matching = mysql_fetch_array($query_matching)){
	  $norangka = trim($data_matching['norangka']);
	  
	  mysql_unbuffered_query("UPDATE matching_local set aktif = 'N' where norangka_local = '$norangka' and fix != 'Y' ");
	  mysql_unbuffered_query("update data_mobil set bisabooking = 'Y' where norangka = '$norangka' ");
	  
	  
  }
  
  
  
  
  if ($r['bisnis'] == 'SERVICE'){
	header('location:media.php?module=home');
  }	
  else {
	  //header('location:media_showroom.php?module=showroom');
	  header('location:media_showroom.php?module=showroom');
  }
}
else{
  header('location:index.php?error=4');
}
}
?>
