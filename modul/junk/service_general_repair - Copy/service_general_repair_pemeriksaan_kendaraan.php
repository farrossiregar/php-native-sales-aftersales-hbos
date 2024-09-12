

<script type="text/javascript" src="modul/service_general_repair/action/act/canvasdraw.js"></script>			
<script type="text/javascript" src="assets/js/jquery.1.6.js"></script>	
<script>
	$(document).ready(function(){
		$('#tambahdata').click(function(){
			$('#loading').show();
			$.ajax({
				method : "post",
				url : "modul/service_general_repair/action/pemeriksaan_kendaraan_tambah_data.php",
				data : "id=Permohonan",
				success : function(data){
					$('#tampiltambahdata').html(data);	
					panggil();
					
					InitThis();
					InitTtd();
					
					$('#loading').hide();
					$('#tampiltambahdata').slideDown(3000);
					$('#tambahdata').fadeOut(1000);
					$('#tampildata').fadeOut(1000);
					
					$('#batal').click(function(){
						$('#tampiltambahdata').slideUp(800);
						$('#tambahdata').fadeIn(1000);
						$('#tampildata').fadeIn(1000);
					})
				}	
			})
			
			
			
		})
		
		
		$('#tampildata').click(function(){
			$('#loading').hide();
			$('#tampilfilterdata').slideDown(1000);
			$('#tambahdata').fadeOut(800);
			$('#tampildata').fadeOut(800);
			
			$('#batal_tampil').click(function(){
				$('#tampilfilterdata').slideUp(1000);
				$('#tambahdata').fadeIn(800);
				$('#tampildata').fadeIn(800);
			})
			
		//	$('#loading').show();
		/*	$('#tampil_data').click(function(){
				$.ajax({
					method : "post",
					url : "modul/service_general_repair/action/pemeriksaan_kendaraan_lihat_data.php",
					success : function(data){
						$('#data_pemeriksaan').html(data);	
					//	panggil();
					//	InitThis();
						
					}	
				})
			})	*/
		})
		
	})
	
	function cari_data_pemeriksaan(){
		var periode_pemeriksaan = $('#periode_pemeriksaan').val();
		$.ajax({
			method : "post",
			url : "modul/service_general_repair/action/pemeriksaan_kendaraan_lihat_data.php",
			data: 'periode_pemeriksaan='+periode_pemeriksaan,
			success : function(data){
				$('#data_pemeriksaan').html(data);	
				$('#header_table').show();	
			console.log(data);
			}	
		})
	}
</script>
<style>
		#tampiltambahdata{display:none;}
		#tampilfilterdata{display:none;}
		#loading{display:none;}		
		
		
		
</style>
<style>
		.bgtable {background: url(assets/type-sedan-samping.png) -16px 0 no-repeate;}
	</style>
<?php
session_start();
$level = $_SESSION['leveluser'];
										    
$cek_akses = mysql_query("select m.kode_menu,a.akses,a.tambah_data from menu m 
left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' 

");
$cek_akses2 = mysql_fetch_array($cek_akses);

										
if($cek_akses2['akses'] != 'Y'){

  
	include "modul/protected.php";

}else{
		
		switch($_GET[act]){
		//tampilkan data
		default:
?>

				<?php
										
					if ($_GET['status']=='ok'){
						
					$msg = "
						<div class='alert alert-success alert-dismissable'>
						
						<h4><i class='icon fa fa-check'></i> Selamat!</h4>
						Berhasil menyimpan data, Pilih Tanggal dan klik tombol tampilkan data untuk melihat detail data yang sudah disimpan.</div>";
						
					//echo $msg;
					?>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">Info</h4>
								</div>
								<div class="modal-body">
									<?php echo $msg; ?>
																						
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
										Tutup
									</button>
									<!--button type="button" class="btn btn-primary">
										Save changes
									</button-->
								</div>
							</div>
						</div>
					</div>

					<?php
					}
					?>
				
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Data Pemeriksaan Kendaraan</h1>
									<span class="mainDescription">Input Data Pemeriksaan Kendaraan</span>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Showroom</span>
									</li>
									<li>
										<span>General Repair</span>
									</li>
									<li class="active">
										<span>Pemeriksaan Kendaraan</span>
									</li>
								</ol>
							</div>
						</section>
						
						<div class="modal fade" id="modal_pemeriksaan_kendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onpageshow="focus">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header" style="background-color: white;">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='exit_modal();'>
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModal2Label">Ubah Data Pemeriksaan</h4>
									</div>
									<div class="modal-body" style="background-color: white;" id = 'modal_booking'>
										<form role="form" id="form" enctype="multipart/form-data" method="post" action="" >
											<div class="row">
												<div class="col-md-12" >
												<?php echo(isset ($msg) ? $msg : ''); ?>
													<div class="errorHandler alert alert-danger no-display ">
														<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
													</div>
													<div class="successHandler alert alert-success no-display">
														<i class="fa fa-ok"></i> Your form validation is successful!
													</div>
												</div>
												<div class="col-md-12" id = "detail_pemeriksaan">	
													
												</div>												
											</div>												
										</form>												
									</div>												
								</div>												
							</div>												
						</div>												
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										
										<p class="progress-demo">
											<?php
											$level = $_SESSION['leveluser'];
											
											$cek_akses = mysql_query("select m.kode_menu,a.* from menu m left join akses a on m.kode_menu = a.kode_menu where m.module = '$_GET[module]' and a.level = '$level' ");
											$cek_akses2 = mysql_fetch_array($cek_akses);
											if($cek_akses2['tambah_data'] == 'Y')
											{
										
											?>
											<button id="tambahdata" type = "button" class="btn btn-wide btn-primary " >
												<span class="ladda-label"><i class="fa fa-plus"></i> Tambah Data </span>
											</button>	
											<?php
											}
											?>
											<button id="tampildata" type="button" class="btn btn-wide btn-o btn-success">
												Filter Pencarian
											</button>	
										</p>
										
										<hr>
								</div>	
							</div>		
							<div class="row">
								<div class="center" id="loading">
										<img src="assets/loading.gif" width="50px" alt="loading" />
									</div>
								<div class="col-md-12" id="tampiltambahdata">
									
								</div>
								<div class="col-md-12" id="tampilfilterdata">
									<div class="row">
										<div class="col-md-12">
										<?php echo(isset ($msg) ? $msg : ''); ?>
											<div class="errorHandler alert alert-danger no-display">
												<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
											</div>
											<div class="successHandler alert alert-success no-display">
												<i class="fa fa-ok"></i> Your form validation is successful!
											</div>
											
										</div>
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<div class="form-group">
															<label class="control-label">
																Pilih Tanggal Pemeriksaan<span class="symbol required"></span>
															</label>
															<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
																<input class="form-control" type="text" id="periode_pemeriksaan" name="periode_pemeriksaan" readonly>
															</div>
														</div>
													</div>
													<div class="form-group">
														<button id="tampil_data" class="btn btn-white btn-info btn-bold" onclick="cari_data_pemeriksaan()">Tampilkan Data</button>
														<button id="batal_tampil" class="btn btn-white btn-danger btn-bold">Keluar</button>
													</div>
												</div>
											</div>
											<div id = 'header_table'  class = "table-responsive" style="display:none;">
												<table class="table table-striped table-bordered table-hover table-full-width">
													<thead>
														<tr>
															<th>No</th>
															<th>Keterangan</th>
														</tr>
													</thead>
													<div id="container">
														<div id="content">
															<div id="content-item-template" class="content-item">
																<span class="line-number">
																</span>
																<span class="data">
																	<tbody id="data_pemeriksaan">
																		
																	</tbody>
																</span>
															</div>
														</div>
													</div>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class = "col-md-12">
								
							</div>
								
								<!--div align="center">
									<canvas id="myCanvas" width="1000" height="318" style="border:2px solid black"></canvas>
									<br /><br />
									<button onclick="javascript:drawImage();return false;">Clear Area</button>
									Line width : <select id="selWidth">
										<option value="1">1</option>
										<option value="3">3</option>
										<option value="5">5</option>
										<option value="7">7</option>
										<option value="9" selected="selected">9</option>
										<option value="11">11</option>
									</select> 
									Color : <select id="selColor">
										<option value="black">black</option>
										<option value="blue" selected="selected">blue</option>
										<option value="red">red</option>
										<option value="green">green</option>
										<option value="yellow">yellow</option>
										<option value="gray">gray</option>
									</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button onclick="javascript:cUndo();return false;">Undo</button>
									<button onclick="javascript:cRedo();return false;">Redo</button>
									<div>
										<input type="button" onclick="uploadEx()" value="Upload" />
									</div>
							 
									<form method="post" accept-charset="utf-8" name="form1">
										<input name="hidden_data" id='hidden_data' type="hidden"/>
									</form>
								</div-->
	<script>
            function uploadEx() {
                var canvas = document.getElementById("myCanvas");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
            //  xhr.open('POST', 'modul/service_general_repair/action/act/simpen.php', true);
				xhr.open('POST', 'modul/service_general_repair/action/pemeriksaan_kendaraan_simpan.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Succesfully uploaded');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
    </script>
							</div>	
						</div>
					</div>
				
		
		

			
<?php 
	break;
	case "buat":
	include "action/buat_permohonan.php";
		

	break;
	
} 
}?>