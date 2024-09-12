<?php
include "config/koneksi.php";
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

// Apabila username dan password ditemukan
if ($ketemu > 0){
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
  timer();

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();
		$last_login = date("Y-m-d H:i:s");
		$tgllalu = date('Y-m-d H:i:s', strtotime('-1 days'));
  mysql_query("UPDATE users SET id_session='$sid_baru',last_login = '$last_login' WHERE username='$username'");
  mysql_query("INSERT into user_login values ('','$username','$last_login')");
  //mysql_query("UPDATE matching_local set aktif = 'N' where tgl < '$tgllalu' and fix='N'");
  if ($r['bisnis'] == 'SERVICE'){
	header('location:media.php?module=home');
  }	
  else {
	  //header('location:media_showroom.php?module=showroom');
	  header('location:media_showroom.php?module=sub_transaksi_stock');
  }
}
else{
  header('location:index.php?error=4');
}
}
?>
