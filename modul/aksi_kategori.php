								<?php
									include "koneksi.php";		
											
			mysql_query("insert into kategori values (default,'{$_POST['nm_kategori']}','{$_POST['klasifikasi']}','Y')");
			
				$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil disimpan</div>";
								
		 ?>