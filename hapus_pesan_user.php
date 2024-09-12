<?php
session_start();
include "config/koneksi.php";
	$nopengajuan = $_POST['data'];

	$pesan = mysql_query("UPDATE notif set read_user = 'Y' WHERE no_pengajuan = '$nopengajuan'");

		$berhasil = "sukses";
		echo $berhasil;
?>