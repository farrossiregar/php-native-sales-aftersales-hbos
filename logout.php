<?php
//lanjutkan session yang sudah dibuat sebelumnya
include "config/koneksi.php";

session_start();

//hapus session yang sudah dibuat

  session_destroy();
	
	mysql_query("update user_login set aktif = 'N' where aktif = 'Y' and username = '$_SESSION[username]'");
  //redirect ke halaman login
    header('location:index.php');
  //header('location:media.php?module=sub_master_list_users');





?>