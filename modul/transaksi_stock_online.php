<?php
session_start();

date_default_timezone_set('Asia/Jakarta');
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
	
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title" class="padding-top-15 padding-bottom-15">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Stock Online</h1>
									<span class="mainDescription">Cek Stock</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: DYNAMIC TABLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<div class="panel-group accordion" id="accordion">
    									<div class="panel panel-white">
    										<div class="panel-heading">
    											<h5 class="panel-title">
    											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
    											    <i class="fa fa-hand-o-right  "></i> <b style=color:#007aff>KLIK DISINI UNTUK FILTER TIPE MOBIL</b> <i class="fa fa-hand-o-left  "></i>
    											</a></h5>
    										</div>
    											
    										<div id="collapseOne" class="panel-collapse collapse">
    											<div class="panel-body">
    													
    													
    												<form role="form" id="form" enctype="multipart/form-data" method="get" action="<?php echo $_SERVER[PHP_SELF] ?>" >
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
    											<div class="col-md-6">
    												
    												<input type = "hidden" name = "module" value = "sub_transaksi_stock" />
    												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Model <span class="symbol required"></span>
    													</label>													
    													<select name = "model" id="model" class = "form-control" >														
    														<option value="semua_model" selected>SEMUA MODEL</option>
    														<?php $data = mysql_query("select kode_model,nama_model from data_mobil where nopenjualan = '' group by nama_model");
    															while ($r=mysql_fetch_array($data))
    															{
    																echo "<option value=$r[kode_model]> $r[nama_model] </option>";
    															}
    															
    														?>
    													</select>
    												</div>
    												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Tipe <span class="symbol required"></span>
    													</label>													
    													<select name = "tipe" id = "tipe" class = "form-control" >	
    														<option value = "semua_tipe">SEMUA TIPE</option>
    													</select>
    												</div>
    												<div class="form-group">
    													<label for="form-field-select-2">
    														Pilih Warna <span class="symbol required"></span>
    													</label>													
    													<select name = "warna" id="warna" class = "form-control" >														
    														<option value="semua_warna">SEMUA WARNA</option>
    														<?php 
    															/*
    															$data = mysql_query("select * from warna where status = 1");
    															while ($r=mysql_fetch_array($data))
    															{
    																echo "<option value=$r[kode_warna]> $r[nama_warna] </option>";
    															}
    															*/
    														?>
    													</select>
    												</div>
    												
    											</div>											
    										</div>
													
													
												</div>
											</div>
									</div>
									</div>
									<div class="row">											
											<div class="col-md-12">
												
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-search"></i> Proses
												</button>
											<br /><br /><span><b style=color:red>Perhatian!</b> Jika anda langsung melakukan proses, maka semua stok akan ditampilkan. Jika ingin mencari berdasarkan model, tipe dan warna klik filter mobil diatas tombol proses. Setelah melakukan filter jangan lupa untuk klik tombol proses!</span>
											</div>
									</div>
									</form>
									
									<!--form role="form" id="form" enctype="multipart/form-data" method="get" action="<?php echo $_SERVER[PHP_SELF] ?>" >
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
											<div class="col-md-6">
												
												<input type = "hidden" name = "module" value = "sub_transaksi_stock" />
												<div class="form-group">													
													<select name = "model" id="model" style="width:120px">														
														<option value="semua_model" selected>PILIH MODEL</option>
														<?php $data = mysql_query("select kode_model,nama_model from data_mobil where nopenjualan = '' group by nama_model");
															while ($r=mysql_fetch_array($data))
															{
																echo "<option value=$r[kode_model]> $r[nama_model] </option>";
															}
															
														?>
													</select>
													<select name = "tipe" id = "tipe" style="width:120px" >	
														<option value = "semua_tipe">PILIH TIPE</option>
													</select>
													<select name = "warna" id="warna" style="width:120px" >														
														<option value="semua_warna">PILIH WARNA</option>
														<?php 
															/*
															$data = mysql_query("select * from warna where status = 1");
															while ($r=mysql_fetch_array($data))
															{
																echo "<option value=$r[kode_warna]> $r[nama_warna] </option>";
															}
															*/
														?>
													</select>
												</div>
												
											</div>											
										</div>
										
										<div class="row">											
											<div class="col-md-12">
												
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Proses
												</button>
												
											</div>
										</div>
									</form-->
								</div>
							</div>
						</div>
						
						<?php 
						/* $quer = "SELECT norangka,nomesin,tahun_buat,tglbeli,nopenjualan,tglmatching,w.nama_warna
						 ,m.kode_model,t.nama_tipe,kode_sales,nama_sales,nomatching,ml.norangka_local,ml.nama_sales_local,ml.tgl,ml.nounique
						 FROM data_mobil dm
						left join tipe t on t.kode_tipe=dm.kode_tipe
						left join model m on m.kode_model=t.kode_model
						left join warna w on w.kode_warna=dm.kode_warna
						left join matching_local ml on ml.norangka_local = dm.norangka and ml.aktif='Y'";
						 */
						 
						$quer = "SELECT dm.norangka,nomesin,harga_jual,tahun_buat,tglbeli,nopenjualan,tglmatching,kode_model,nama_model,kode_tipe,nama_tipe,kode_warna,nama_warna,bisabooking,umur
						 ,kode_sales,nama_sales,nomatching,nofaktur,status,ml.norangka_local,ml.nama_sales_local,ml.tgl,ml.nounique,ml.fix,ml.user,ml.no_spk_local,ml.nama_customer_local,ml.jenis_pembayaran_local,
						 ff.norangka as rangka_fiktif
						 FROM data_mobil dm
						
						left join matching_local ml on ml.norangka_local = dm.norangka and ml.aktif='Y' 
						left join faktur_fiktif ff on ff.norangka = dm.norangka 
						";
						?>
						
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
							
							
								<div class="col-md-12">
									<!--h5 class="over-title margin-bottom-15">Keseluruhan <span class="text-bold">Data Sales</span></h5-->
									
										
									<?php if ($_GET['model']=='semua_model') { 
									?>	
									
									<script type="text/javascript" language="JavaScript">
                                     function konfirmasi()
                                     {
                                     tanya = confirm("Booking yang dibatalkan tidak bisa dikembalikan, yakin ingin batal booking?");
                                     if (tanya == true) return true;
                                     else return false;
                                     }</script>
									
									<div class = "table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
											<thead>
												<tr>
												 
													<th>Tipe</th>												
													<th>Keterangan</th>
													
													
												</tr>
											</thead>
											<tbody>
												<?php 
												$tampil = mysql_query("$quer order by dm.umur desc,dm.nama_tipe asc");
												
												$hasil = mysql_num_rows($tampil);
												
												
												while($r=mysql_fetch_array($tampil)){
												  //$tgl_posting=tgl_indo($r[tanggal]);
												  $harga = "$r[harga_jual]";
												  
												  //Untuk harga special color
												  $query_data = mysql_query("select * from tipe_warna where kode_tipe = '$r[kode_tipe]' and kode_Warna = '$r[kode_warna]' ");
												  $jml_data_warna = mysql_num_rows($query_data);
												  $datanya = mysql_fetch_array($query_data);
												  
												  if ($jml_data_warna > 0){
												     $rupiah = "Rp ".number_format($datanya[harga_jual],0,".",".");
												  }
												  else {
												     $rupiah = "Rp ".number_format($harga,0,".","."); 
												  }
												  if($r[rangka_fiktif]!=''){$rangka_fiktif = "<font color = 'red'> F <br/></font>";} else {$rangka_fiktif="";}
												  
												  $nofaktur = "$r[nofaktur]";
												  $jenispembayaranlocal = "$r[jenis_pembayaran_local]";
												  $nopenjualan = "$r[nopenjualan]";
												  $alokasifaktur=$nofaktur;
    												if($alokasifaktur!=="") {
    												$alokasifaktur="Sudah Faktur"; 
    												}
    												if($alokasifaktur=="") {
    												$alokasifaktur="Belum Faktur"; 
    												}
    											  $jenispembayaran=$jenispembayaranlocal;
    												if($jenispembayaran=="1") {
    												$jenispembayaran="Kredit"; 
    												}
    												if($jenispembayaran=="2") {
    												$jenispembayaran="Tunai"; 
    												}
    												if($jenispembayaran=="3") {
    												$jenispembayaran="GSO"; 
    												}
    											  $terjual=$nopenjualan;
    												if($terjual!=="") {
    												$terjual="<br />Terjual Belum BSTK"; 
    												}
												  
												  echo "<tr><td align=center>  ($r[nama_tipe]) <br />$rupiah <br/>$rangka_fiktif</td>
												  <td>  
														   No.Rangka : <b>$r[norangka]</b><br />
														   No.Mesin : $r[nomesin]  ";
												 
												  echo "<br />Warna : <b>$r[nama_warna]</b>
															<br />Tahun : $r[tahun_buat] <br />";
												  if ($_SESSION['leveluser'] == 'MNGR' || $_SESSION['leveluser'] == 'DRKSI' || $_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'supervisor'){
												  /*echo "Umur : ". (abs(strtotime(date('Y-m-d')) - strtotime($r[tglbeli])))/86400; **/
												  echo "Umur : ". $r['umur'];
												  echo " Hari<br />"; 
														
												  }
												  
												  
												 if ($r[nomatching]!=''){
													 $tgllalu = date('Y-m-d H:i:s', strtotime('-8 days'));
													 if ($r['tglmatching'] < "$tgllalu" and $alokasifaktur == "Belum Faktur" ){
														 //echo "Umur matching lebih dari 7 hari";
														 
														 
														 
														 
														 
														 
														 if ($_SESSION[leveluser]!='user'){  	  
														
														if ($r['norangka_local']!=''){
															if ($_SESSION[leveluser]=='supervisor'){
																if ($r['fix']=='N')
																{
																    echo "<div style=color:darkorchid;font-style:italic;>Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
																	
																}   
																else
																{
																    echo "<div style=color:#26a69a;font-style:italic;>Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
																}  
															}
															else {
															    if ($r['fix']=='N')
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:darkorchid;>
																            No SPK : ".$r[no_spk_local]." <br /> 
																            Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> 
																            Nama Customer : ".$r[nama_customer_local]." <br />
																            Jenis Pembayaran : ".$jenispembayaran." <br />
																            By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}   
																else
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:#26a69a;>
																            No SPK : ".$r[no_spk_local]." <br /> 
        																    Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br />
        																    Nama Customer : ".$r[nama_customer_local]." <br />
        																    Jenis Pembayaran : ".$jenispembayaran." <br />
        																    By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}
																 
															}
														}
														
														else {
															$tombol_booking = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-car'></i> Booking No Rangka</a>";
															$tombol_fakturfiktif = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-book'></i>  Set Faktur Fiktif</a>";
														    if (trim($r['bisabooking']) =='Y'){
														    	
																echo $tombol_booking;
																//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																
																if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' or $_SESSION[leveluser]=='MNGR' )
														        {		
																	
																	echo "   ".$tombol_fakturfiktif; 
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    else
														    {
														        if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' or $_SESSION[leveluser]=='MNGR' )
														        {
																	echo $tombol_booking;
																	echo "   ".$tombol_fakturfiktif;
														            //echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    /*echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>"; */
														}                               
													}
													else {
														if ($r['norangka_local']!=''){
															echo "<div style=color:darkorchid;font-style:italic;float:right;>Reserved : $r[nama_sales_local]". (date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
														} 
													}
														 
														 
														 
														 
													 }else {
														echo "<div style = 'color:red;'>Teralokasi : $r[kode_sales] ".date("d-m-Y",strtotime($r[tglmatching]))."<br />$alokasifaktur $terjual</div>"; 
													
													 }
												 }
												 else {
													if ($_SESSION[leveluser]!='user'){  	  
														
														if ($r['norangka_local']!=''){
															if ($_SESSION[leveluser]=='supervisor'){
																if ($r['fix']=='N')
																{
																    echo "<div style=color:darkorchid;font-style:italic;>Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
																}   
																else
																{
																    echo "<div style=color:#26a69a;font-style:italic;>Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
																}  
															}
															else {
															    if ($r['fix']=='N')
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:darkorchid;>
																            No SPK : ".$r[no_spk_local]." <br /> 
																            Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> 
																            Nama Customer : ".$r[nama_customer_local]." <br />
																            Jenis Pembayaran : ".$jenispembayaran." <br />
																            By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}   
																else
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:#26a69a;>
																            No SPK : ".$r[no_spk_local]." <br /> 
        																    Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br />
        																    Nama Customer : ".$r[nama_customer_local]." <br />
        																    Jenis Pembayaran : ".$jenispembayaran." <br />
        																    By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}
																 
															}
														}
														
														else {
															$tombol_booking = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-car'></i> Booking No Rangka</a>";
															$tombol_fakturfiktif = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-book'></i>  Set Faktur Fiktif</a>";
														    if (trim($r['bisabooking']) =='Y'){
														    	
																echo $tombol_booking;
																//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																
																if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' )
														        {		
																	
																	echo "   ".$tombol_fakturfiktif; 
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    else
														    {
														        if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' )
														        {
																	echo $tombol_booking;
																	echo "   ".$tombol_fakturfiktif;
														            //echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    /*echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>"; */
														}                               
													}
													else {
														if ($r['norangka_local']!=''){
															echo "<div style=color:darkorchid;font-style:italic;float:right;>Reserved : $r[nama_sales_local]". (date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
														} 
													}
												 }
													
												  
												}
												 $jmldata = mysql_num_rows(mysql_query("$quer"));
												 $jml_teralokasi = mysql_num_rows(mysql_query("$quer where dm.nomatching!='' and dm.nopenjualan=''"));
												 $jml_free = mysql_num_rows(mysql_query("$quer where dm.nomatching='' and dm.nopenjualan=''"));
												 $jml_fix = mysql_num_rows(mysql_query("$quer where ml.fix = 'Y' and dm.nomatching=''"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix = $jml_free;
												 $jml_alokasiblmfaktur = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = ''"));
												$jml_alokasisdhfaktur = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != ''"));
												$jml_stokterjualblmbstk = mysql_num_rows(mysql_query("$quer where dm.status = 'BLM BSTK'"));
												
												
											/*	 $jmldata_thn = mysql_num_rows(mysql_query("$quer where dm.tahun_buat = '$tahun'"));
												 $jml_teralokasi_thn = mysql_num_rows(mysql_query("$quer where dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun'"));
												 $jml_free_thn = mysql_num_rows(mysql_query("$quer where dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun'"));
												 $jml_fix_thn = mysql_num_rows(mysql_query("$quer where ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '$tahun'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_thn = $jml_free_thn_lalu;
												 $jml_alokasiblmfaktur_thn = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '$tahun_lalu'"));
												$jml_alokasisdhfaktur_thn = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '$tahun_lalu'"));
												$jml_stokterjualblmbstk_thn = mysql_num_rows(mysql_query("$quer where dm.status = 'BLM BSTK' and dm.tahun_buat = '$tahun_lalu'"));	*/
													
												//======== STOK TAHUN LALU =========//
												$tahun_lalu = (date('Y'))-1;
												 $jmldata_thn_lalu = mysql_num_rows(mysql_query("$quer where dm.tahun_buat = '$tahun_lalu'"));
												 $jml_teralokasi_thn_lalu = mysql_num_rows(mysql_query("$quer where dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_lalu'"));
												 $jml_free_thn_lalu = mysql_num_rows(mysql_query("$quer where dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_lalu'"));
												 $jml_fix_thn_lalu = mysql_num_rows(mysql_query("$quer where ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '$tahun_lalu'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_thn_lalu = $jml_free_thn_lalu;
												 $jml_alokasiblmfaktur_thn_lalu = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '$tahun_lalu'"));
												$jml_alokasisdhfaktur_thn_lalu = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '$tahun_lalu'"));
												$jml_stokterjualblmbstk_thn_lalu = mysql_num_rows(mysql_query("$quer where dm.status = 'BLM BSTK' and dm.tahun_buat = '$tahun_lalu'"));
												
												//======== STOK TAHUN INI =========//
												$tahun_ini = date('Y');
												 $jmldata_thn_ini = mysql_num_rows(mysql_query("$quer where dm.tahun_buat = '$tahun_ini'"));
												 $jml_teralokasi_thn_ini = mysql_num_rows(mysql_query("$quer where dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_ini'"));
												 $jml_free_thn_ini = mysql_num_rows(mysql_query("$quer where dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_ini'"));
												 $jml_fix_thn_ini = mysql_num_rows(mysql_query("$quer where ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '$tahun_ini'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_thn_ini = $jml_free_thn_ini;
												 $jml_alokasiblmfaktur_thn_ini = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '$tahun_ini'"));
												$jml_alokasisdhfaktur_thn_ini = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '$tahun_ini'"));
												$jml_stokterjualblmbstk_thn_ini = mysql_num_rows(mysql_query("$quer where dm.status = 'BLM BSTK' and dm.tahun_buat = '$tahun_ini'"));
												
												//======== STOK DO =========//
												 $jmldata_do = mysql_num_rows(mysql_query("$quer where dm.tahun_buat = '-'"));
												 $jml_teralokasi_do = mysql_num_rows(mysql_query("$quer where dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '-'"));
												 $jml_free_do = mysql_num_rows(mysql_query("$quer where dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '-'"));
												 $jml_fix_do = mysql_num_rows(mysql_query("$quer where ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '-'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_do = $jml_free_do;
												 $jml_alokasiblmfaktur_do = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '-'"));
												$jml_alokasisdhfaktur_do = mysql_num_rows(mysql_query("$quer where dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '-'"));
												$jml_stokterjualblmbstk_do = mysql_num_rows(mysql_query("$quer where dm.status = 'BLM BSTK' and dm.tahun_buat = '-'"));		
												
												 ?>
											
									<?php } else {;?>
									
									<div class = "table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
											<thead>
												<tr>
													<th>Tipe</th>												
													<th>Keterangan</th>
													
													
												</tr>
											</thead>
											<tbody>
												<?php 
											//	$cari_alokasi = mysql_query("select * from alokasi_unit_hpm");
												if ($_GET['tipe']=='semua_tipe'){
													if ($_GET['warna']=='semua_warna'){                  
														$filter= "where dm.kode_model='$_GET[model]'";
														$tampil = mysql_query("$quer $filter ORDER BY dm.umur desc, dm.norangka asc ");
													}
													else{                  
														$filter = "where dm.kode_model='$_GET[model]' and dm.kode_warna='$_GET[warna]'";
														$tampil = mysql_query("$quer $filter ORDER BY dm.umur desc, dm.norangka asc ");
													}
												}
												else{
													  if ($_GET['warna']=='semua_warna'){                
														$filter = "where dm.kode_model='$_GET[model]' and dm.kode_tipe='$_GET[tipe]'";
														$tampil = mysql_query("$quer $filter ORDER BY dm.umur desc, dm.norangka asc ");
													  }
													  else{                
														$filter = "where dm.kode_model='$_GET[model]' and dm.kode_tipe='$_GET[tipe]' and
														dm.kode_warna='$_GET[warna]'";
														$tampil = mysql_query("$quer $filter ORDER BY dm.umur desc, dm.norangka asc ");
													  }  
													  
												}
												
												$hasil = mysql_num_rows($tampil);
												while($r=mysql_fetch_array($tampil)){
												  //$tgl_posting=tgl_indo($r[tanggal]);
												  $harga = "$r[harga_jual]";
												  
												   //Untuk harga special color
												  $query_data = mysql_query("select * from tipe_warna where kode_tipe = '$r[kode_tipe]' and kode_Warna = '$r[kode_warna]' ");
												  $jml_data_warna = mysql_num_rows($query_data);
												  $datanya = mysql_fetch_array($query_data);
												  
												  if ($jml_data_warna > 0){
												     $rupiah = "Rp ".number_format($datanya[harga_jual],0,".",".");
												  }
												  else {
												     $rupiah = "Rp ".number_format($harga,0,".","."); 
												  }
												  if($r[rangka_fiktif]!=''){$rangka_fiktif = "<font color = 'red'> F <br/></font>";} else {$rangka_fiktif="";}
												  
												  $nofaktur = "$r[nofaktur]";
												  $jenispembayaranlocal = "$r[jenis_pembayaran_local]";
												  $nopenjualan = "$r[nopenjualan]";
												  $alokasifaktur=$nofaktur;
    												if($alokasifaktur!=="") {
    												$alokasifaktur="Sudah Faktur"; 
    												}
    												if($alokasifaktur=="") {
    												$alokasifaktur="Belum Faktur"; 
    												}
    											  $jenispembayaran=$jenispembayaranlocal;
    												if($jenispembayaran=="1") {
    												$jenispembayaran="Kredit"; 
    												}
    												if($jenispembayaran=="2") {
    												$jenispembayaran="Tunai"; 
    												}
    												if($jenispembayaran=="3") {
    												$jenispembayaran="GSO"; 
    												}
    											  $terjual=$nopenjualan;
    												if($terjual!=="") {
    												$terjual="<br />Terjual Belum BSTK"; 
    												}
												  echo "<tr><td align=center>  ($r[nama_tipe])<br />$rupiah <br/> $rangka_fiktif</td>
												  <td>  
														   No.Rangka : <b>$r[norangka]</b><br />
														   No.Mesin : $r[nomesin]  ";
												 
												  echo "<br />Warna : <b>$r[nama_warna]</b>
															<br />Tahun : $r[tahun_buat] <br />";
												   if ($_SESSION['leveluser'] == 'MNGR' || $_SESSION['leveluser'] == 'DRKSI' || $_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'supervisor'){
												  /*echo "Umur : ". (abs(strtotime(date('Y-m-d')) - strtotime($r[tglbeli])))/86400; */
												  echo "Umur : ". $r['umur'];
												  echo " Hari<br />";
												   }
												   
												   
												   
												 if ($r[nomatching]!=''){
													 $tgllalu = date('Y-m-d H:i:s', strtotime('-8 days'));
													 if ($r['tglmatching'] < "$tgllalu" and $alokasifaktur == "Belum Faktur" ){
														 //echo "Umur matching lebih dari 7 hari";
														 
														 
														 
														 
														 
														 
														 if ($_SESSION[leveluser]!='user'){  	  
														
														if ($r['norangka_local']!=''){
															if ($_SESSION[leveluser]=='supervisor'){
																if ($r['fix']=='N')
																{
																    echo "<div style=color:darkorchid;font-style:italic;>Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
																	
																}   
																else
																{
																    echo "<div style=color:#26a69a;font-style:italic;>Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
																}  
															}
															else {
															    if ($r['fix']=='N')
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:darkorchid;>
																            No SPK : ".$r[no_spk_local]." <br /> 
																            Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> 
																            Nama Customer : ".$r[nama_customer_local]." <br />
																            Jenis Pembayaran : ".$jenispembayaran." <br />
																            By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}   
																else
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:#26a69a;>
																            No SPK : ".$r[no_spk_local]." <br /> 
        																    Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br />
        																    Nama Customer : ".$r[nama_customer_local]." <br />
        																    Jenis Pembayaran : ".$jenispembayaran." <br />
        																    By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}
																 
															}
														}
														
														else {
															$tombol_booking = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-car'></i> Booking No Rangka</a>";
															$tombol_fakturfiktif = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-book'></i>  Set Faktur Fiktif</a>";
														    if (trim($r['bisabooking']) =='Y'){
														    	
																echo $tombol_booking;
																//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																
																if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' or $_SESSION[leveluser]=='MNGR' )
														        {		
																	
																	echo "   ".$tombol_fakturfiktif; 
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    else
														    {
														        if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' or $_SESSION[leveluser]=='MNGR' )
														        {
																	echo $tombol_booking;
																	echo "   ".$tombol_fakturfiktif;
														            //echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    /*echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>"; */
														}                               
													}
													else {
														if ($r['norangka_local']!=''){
															echo "<div style=color:darkorchid;font-style:italic;float:right;>Reserved : $r[nama_sales_local]". (date("d-m-Y",strtotime($r[tgl])))."<br /> By: ".$r[user]."</div>";
														} 
													}
														 
													 }else {
														echo "<div style = 'color:red;'>Teralokasi : $r[kode_sales] ".date("d-m-Y",strtotime($r[tglmatching]))."<br />$alokasifaktur $terjual</div>"; 
													
													 }
												 }

												 
												 
												 
												 else {
													if ($_SESSION[leveluser]!='user'){  	  
														
														if ($r['norangka_local']!=''){
															if ($_SESSION[leveluser]=='supervisor'){
																if ($r['fix']=='N')
																{
																    echo "<div style=color:darkorchid;font-style:italic;>Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))." By: ".$r[user]."</div>";
																}   
																else
																{
																    echo "<div style=color:#26a69a;font-style:italic;>Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))." By: ".$r[user]."</div>";
																}  
															}
															else {
															    if ($r['fix']=='N')
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:darkorchid;>
																            No SPK : ".$r[no_spk_local]." <br /> 
																            Reserved : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br /> 
																            Nama Customer : ".$r[nama_customer_local]." <br />
																            Jenis Pembayaran : ".$jenispembayaran." <br />
																            By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}   
																else
																{
																    $tampilnama	=mysql_query("SELECT * FROM users WHERE username='$r[user]'");
                            				                        $nama	    =mysql_fetch_array($tampilnama);
																    echo "<div style=color:#26a69a;>
																            No SPK : ".$r[no_spk_local]." <br /> 
        																    Fix Booked : $r[nama_sales_local] ".(date("d-m-Y",strtotime($r[tgl])))."<br />
        																    Nama Customer : ".$r[nama_customer_local]." <br />
        																    Jenis Pembayaran : ".$jenispembayaran." <br />
        																    By: ".$nama[nama_lengkap]."<br /> <a href='media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=$r[norangka]'> [Ubah Data]</a> | <a onclick='return konfirmasi()' href='modul/ubahdata.php?id=$r[norangka]'> [Batal Booking]</a></div>";
																}
																 
															}
														}
														
														else {
															$tombol_booking = "<a class='btn btn-xs btn-primary' href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-car'></i> Booking No Rangka</a>";
															$tombol_fakturfiktif = "<a class='btn btn-xs btn-success' href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]' data-placement='top' data-toggle='tooltip' data-original-title='Booking Norangka $r[norangka]'><i class='fa fa-book'></i>  Set Faktur Fiktif</a>";
														    
														    if (trim($r['bisabooking']) =='Y'){
														    	echo $tombol_booking;
																//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																
																if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' )
														        {																	
																	echo "   ".$tombol_fakturfiktif;
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    else
														    {
														        if ($_SESSION[leveluser]=='admin' or $_SESSION[leveluser]=='salesadm' )
														        {
																	echo $tombol_booking;
																	echo " ".$tombol_fakturfiktif;
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>";
																	//echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=fakturfiktif&id=$r[norangka]'> / Faktur Fiktif</a>";
														        }
														    }
														    /*echo "<a href='media_showroom.php?module=sub_transaksi_stock&act=tambah&id=$r[norangka]'>Booking No Rangka</a>"; */
														}                             
													}
													else {
														if ($r['norangka_local']!=''){
															echo "<div style=color:darkorchid;font-style:italic;float:right;>Reserved : $r[nama_sales_local]". (date("d-m-Y",strtotime($r[tgl])))." By: ".$r[user]."</div>";
														} 
													}
												 }
													
												
													
												  
												}
												$jmldata = mysql_num_rows(mysql_query("$quer $filter"));
												$jml_teralokasi = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching!='' and dm.nopenjualan=''"));
												$jml_free = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching=''"));
												$jml_fix = mysql_num_rows(mysql_query("$quer $filter and ml.fix = 'Y' and dm.nomatching=''"));
												//$jml_freefix = $jml_free - $jml_fix;
												$jml_freefix = $jml_free;
												$jml_alokasiblmfaktur = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = ''"));
												$jml_alokasisdhfaktur = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != ''"));
												$jml_stokterjualblmbstk = mysql_num_rows(mysql_query("$quer $filter and dm.status = 'BLM BSTK' "));
												
												//======== STOK TAHUN LALU =========//
												$tahun_lalu = (date('Y'))-1;
												 $jmldata_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and dm.tahun_buat = '$tahun_lalu'"));
												 $jml_teralokasi_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_lalu'"));
												 $jml_free_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_lalu'"));
												 $jml_fix_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '$tahun_lalu'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_thn_lalu = $jml_free_thn_lalu;
												 $jml_alokasiblmfaktur_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '$tahun_lalu'"));
												$jml_alokasisdhfaktur_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '$tahun_lalu'"));
												$jml_stokterjualblmbstk_thn_lalu = mysql_num_rows(mysql_query("$quer $filter and dm.status = 'BLM BSTK' and dm.tahun_buat = '$tahun_lalu'"));
												
												//======== STOK TAHUN INI =========//
												$tahun_ini = date('Y');
												 $jmldata_thn_ini = mysql_num_rows(mysql_query("$quer $filter and dm.tahun_buat = '$tahun_ini'"));
												 $jml_teralokasi_thn_ini = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_ini'"));
												 $jml_free_thn_ini = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '$tahun_ini'"));
												 $jml_fix_thn_ini = mysql_num_rows(mysql_query("$quer $filter and ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '$tahun_ini'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_thn_ini = $jml_free_thn_ini;
												 $jml_alokasiblmfaktur_thn_ini = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '$tahun_ini'"));
												$jml_alokasisdhfaktur_thn_ini = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '$tahun_ini'"));
												$jml_stokterjualblmbstk_thn_ini = mysql_num_rows(mysql_query("$quer $filter and dm.status = 'BLM BSTK' and dm.tahun_buat = '$tahun_ini'"));
												
												//======== STOK DO =========//
												 $jmldata_do = mysql_num_rows(mysql_query("$quer $filter and dm.tahun_buat = '-'"));
												 $jml_teralokasi_do = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching!='' and dm.nopenjualan='' and dm.tahun_buat = '-'"));
												 $jml_free_do = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching='' and dm.nopenjualan='' and dm.tahun_buat = '-'"));
												 $jml_fix_do = mysql_num_rows(mysql_query("$quer $filter and ml.fix = 'Y' and dm.nomatching='' and dm.tahun_buat = '-'"));
												 //$jml_freefix = $jml_free - $jml_fix;
												 $jml_freefix_do = $jml_free_do;
												 $jml_alokasiblmfaktur_do = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur = '' and dm.tahun_buat = '-'"));
												$jml_alokasisdhfaktur_do = mysql_num_rows(mysql_query("$quer $filter and dm.nomatching != '' and dm.nopenjualan = '' and dm.nofaktur != '' and dm.tahun_buat = '-'"));
												$jml_stokterjualblmbstk_do = mysql_num_rows(mysql_query("$quer $filter and dm.status = 'BLM BSTK' and dm.tahun_buat = '-'"));
												
												
									}?>
											</tbody>
										</table>
									</div>
									<?php 
										if($hasil > 0){
											echo "All : <b>$jmldata</b>, Stock Free : <b>$jml_freefix</b>, Fix Booked : <b>$jml_fix</b>, Teralokasi : <b>$jml_teralokasi</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk</b><br /><br />";
											
										/*	if($_SESSION['leveluser']=='admin'){
												echo "<ul>";
												echo "<li>Stock $tahun_lalu :</br> All : <b>$jmldata_thn_lalu</b>, Stock Free : <b>$jml_freefix_thn_lalu</b>, Fix Booked : <b>$jml_fix_thn_lalu</b>, Teralokasi : <b>$jml_teralokasi_thn_lalu</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur_thn_lalu</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur_thn_lalu</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk_thn_lalu</b></li></br>";
												echo "<li>Stock DO :</br> All : <b>$jmldata_do</b>, Stock Free : <b>$jml_freefix_do</b>, Fix Booked : <b>$jml_fix_do</b>, Teralokasi : <b>$jml_teralokasi_do</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur_do</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur_do</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk_do</b></li><br />";
												echo "<li>Stock DO :</br> All : <b>$jmldata_do</b>, Stock Free : <b>$jml_freefix_do</b>, Fix Booked : <b>$jml_fix_do</b>, Teralokasi : <b>$jml_teralokasi_do</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur_do</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur_do</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk_do</b></li><br />";
												echo "</ul>";
											}	*/
											
										//	if($_SESSION['leveluser']=='admin'){
												echo "<ul>";
												echo "<li>Stock $tahun_lalu :</br> All : <b>$jmldata_thn_lalu</b>, Stock Free : <b>$jml_freefix_thn_lalu</b>, Fix Booked : <b>$jml_fix_thn_lalu</b>, Teralokasi : <b>$jml_teralokasi_thn_lalu</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur_thn_lalu</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur_thn_lalu</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk_thn_lalu</b></li></br>";
												echo "<li>Stock $tahun_ini :</br> All : <b>$jmldata_thn_ini</b>, Stock Free : <b>$jml_freefix_thn_ini</b>, Fix Booked : <b>$jml_fix_thn_ini</b>, Teralokasi : <b>$jml_teralokasi_thn_ini</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur_thn_ini</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur_thn_ini</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk_thn_ini</b></li><br />";
												echo "<li>Stock DO :</br> All : <b>$jmldata_do</b>, Stock Free : <b>$jml_freefix_do</b>, Fix Booked : <b>$jml_fix_do</b>, Teralokasi : <b>$jml_teralokasi_do</b>, Alokasi Belum Faktur ATPM : <b>$jml_alokasiblmfaktur_do</b>, Alokasi Sudah Faktur ATPM : <b>$jml_alokasisdhfaktur_do</b>, Stok Terjual Belum BSTK : <b>$jml_stokterjualblmbstk_do</b></li><br />";
												echo "</ul>";
										}
										//	}
									?>
								</div>
							</div>
						</div>
						<!-- end: DYNAMIC TABLE -->
					</div>
				</div>
	
	
	<?php 
		break;
		case "fakturfiktif":
		$tgl = date('Y-m-d H:i:s');
		
		
		if(count($_POST)) {
			
			$data = mysql_query("select * from faktur_fiktif where norangka = '$_GET[id]'");
			$jml_data = mysql_num_rows($data);
			
			if ($jml_data > 0){
				
				$msg = "
							
				<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Data Sudah Ada.
				</div>
				
				";	
			}
			else {				
			
				mysql_unbuffered_query("insert into faktur_fiktif (norangka) values('$_GET[id]') ");
						
								
				$msg = "
							
				<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-check'></i> Selamat!</h4>
				Berhasil menambah data.
				</div>
				
				";	
				
			}
		}
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Stock</h1>
									<span class="mainDescription">Faktur Fiktif</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									
									<form role="form" id="form" enctype="multipart/form-data" method="POST" action="">
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
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Tanggal <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $tgl; ?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Kategori" class="form-control" name="tgl" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nomor Rangka <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $_GET[id]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="norangka_local" readonly required>
												</div>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onClick="self.history.back()">
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>



	
	<?php 
		break;
		case "tambah":
		$tgl = date('Y-m-d H:i:s');
		
	?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Stock</h1>
									<span class="mainDescription">Booking Rangka</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									
									<form role="form" id="form" enctype="multipart/form-data" method="POST" action="modul/aksi_bookingstock.php?module=sub_transaksi_stock&act=tambah">
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
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">
														Tanggal <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" type="text" value = "<?php echo $tgl; ?>" onblur="this.value=this.value.toUpperCase()" placeholder="Nama Kategori" class="form-control" name="tgl" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nomor Rangka <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $_GET[id]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="norangka_local" readonly required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Booking Untuk <span class="symbol required"></span>
													</label>
													<?php if ($_SESSION['leveluser'] != "salesadm") {  ?>
													<input style="text-transform:uppercase"  type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="nama_sales_local" required>
													
													<?php  }else { ?>
													
													<select name="nama_sales_local" id="nama_sales_local" class="form-control" >
													<option selected value="">-- PILIH --</option>
													<option value="HOLD ADMIN" >HOLD ADMIN</option>
													<option value="HOLD BENGKEL" >HOLD BENGKEL</option>
													<option value="HOLD LOGISTIK" >HOLD LOGISTIK</option>
													<option value="HOLD MD" >HOLD MD</option>
													<option value="FIX FAKTUR" >FIX FAKTUR</option>
													<option value="REQUEST PERPANJANG" >REQUEST PERPANJANG</option>
													
												    </select>
													
													<?php  } ?>
												</div>
												<div class="form-group">
													<label class="control-label">
														No SPK <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = ""  type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="no_spk_local" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Customer <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = ""  type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="nama_customer_local" required>
												</div>
    											
    											<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="jenis_pembayaran_local" value="1" required>
													<label for="radio1">
														Kredit
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="jenis_pembayaran_local" value="2" required>
													<label for="radio2">
														Tunai
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio3" name="jenis_pembayaran_local" value="3" required>
													<label for="radio3">
														GSO
													</label>
												</div>
												
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Save
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_transaksi_stock';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Cancel </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php	
	break;
	case "ubahbook":
	    
	$a = "select * from matching_local where norangka_local='$_GET[id]'"; 
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
				
	if(count($_POST)) {
			
	mysql_unbuffered_query("update matching_local set nama_sales_local = '$_POST[nama_sales_local]', no_spk_local = '$_POST[no_spk_local]', jenis_pembayaran_local = '$_POST[jenis_pembayaran_local]', nama_customer_local = '$_POST[nama_customer_local]' where norangka_local = '$_GET[id]'");
				
						
	$msg = "
					
		<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4><i class='icon fa fa-check'></i> Selamat!</h4>
		Berhasil mengubah data.
		</div>
		
		";	
	}
	
	$a = "select * from matching_local where norangka_local='$_GET[id]'";
	$kueri = mysql_query($a);
	$r = mysql_fetch_array($kueri);
	$jenis=$r['jenis_pembayaran_local'];
?>

		
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Stock Booking</h1>
									<span class="mainDescription">Ubah Data Booking</span>
								</div>
								
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: FORM VALIDATION EXAMPLE 1 -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									
									<form role="form" id="form___" enctype="multipart/form-data" method="POST" action="media_showroom.php?module=sub_transaksi_stock&act=ubahbook&id=<?php echo $_GET[id]; ?>">
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
											<div class="col-md-6">
												
												<input  type="hidden" value = "<?php echo $_GET[id]; ?>" name="id" >
											
												<div class="form-group">
													<label class="control-label">
														Nomor Rangka <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $_GET[id]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="norangka_local" required readonly>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nomor SPK <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $r[no_spk_local]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="no_spk_local" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Sales <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $r[nama_sales_local]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="nama_sales_local" required>
												</div>
												<div class="form-group">
													<label class="control-label">
														Nama Customer <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $r[nama_customer_local]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="nama_customer_local" required>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio1" name="jenis_pembayaran_local" value="1" <?php if($jenis=='1'){echo 'checked';}?>>
													<label for="radio1">
														Kredit
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio2" name="jenis_pembayaran_local" value="2" <?php if($jenis=='2'){echo 'checked';}?>>
													<label for="radio2">
														Tunai
													</label>
												</div>
												<div class="radio clip-radio radio-primary radio-inline">
													<input type="radio" id="radio3" name="jenis_pembayaran_local" value="3" <?php if($jenis=='3'){echo 'checked';}?>>
													<label for="radio3">
														GSO
													</label>
												</div>
												<div class="form-group">
													<label class="control-label">
														User Booking <span class="symbol required"></span>
													</label>
													<input style="text-transform:uppercase" value = "<?php echo $r[user]; ?>" type="text" onblur="this.value=this.value.toUpperCase()" class="form-control"  name="user" required readonly>
												</div>
											</div>											
										</div>
										<div class="row">
											<div class="col-md-12">
												<div>
													<span class="symbol required"></span>Harus diisi
													<hr>
												</div>
											</div>
										</div>
										<div class="row">											
											<div class="col-md-4">
												<button class="btn btn-primary btn-wide" type="submit">
													<i class="fa fa-save"></i> Ubah
												</button>
												<button type = "button" class="btn btn-wide btn-danger ladda-button" data-style="expand-right" onclick=window.location.href='?module=sub_transaksi_stock';>
													<span class="ladda-label"><i class="fa fa-mail-reply"></i> Keluar </span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- end: FORM VALIDATION EXAMPLE 1 -->
					</div>
				</div>

<?php break;
}
}
 ?>