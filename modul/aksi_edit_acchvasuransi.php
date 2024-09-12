<?php
include "../config/koneksi.php";
if(count($_POST)) {
		mysql_unbuffered_query("update acchv_asuransi set total = '$_POST[total]' where id_acchv = '$_POST[id_acchv]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
							header('location:../media.php?module=sub_bodyrepair_jobcontrol');
	}
	

?>