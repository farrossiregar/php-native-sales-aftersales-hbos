
$(document).ready(function() {
			$('.status_spk').on('change',function(){
				//var package = $('.metodebayar').val();
				var status_spk = $('input[name=status_spk]:checked').val();
				//document.getElementById("leasing").selectedIndex = "0";
				//document.getElementById("tenor").selectedIndex = "0";
				if (status_spk == "Y"){
					$("#id_nospk").show();
					$("#tgl_spk").show();
					$("#ket_tidakspk").hide();
					
				}else {
					
					$("#id_nospk").hide();
					$("#tgl_spk").hide();
					$("#ket_tidakspk").show();
					
					$("#no_spk").val("");
				}
				
			})
			
})

function removereadonly(){
	var read=document.getElementById("refund")
		.removeAttribute("readonly",0);
		
		var metodebyr = $('input[name=cara_beli]:checked').val();
		
		if (metodebyr != "KREDIT"){
			
			$("#refund").val(0);
			$("#id_leasing").hide();
			$("#id_tenor").hide();
			$("#ikut_asuransi").show();
			document.getElementById("leasing").selectedIndex = "0";
			document.getElementById("tenor").selectedIndex = "0";
			
			
		}else{
			
			 $("#id_leasing").show();
				$("#id_tenor").show();
				$("#ikut_asuransi").hide();
		}
	//var read=document.getElementById("leasing")
		//.removeAttribute("required",0);  
	//var read=document.getElementById("tenor")
		//.removeAttribute("required",0);
 //alert("atribut textbox readonly telah terhapus");

  }
  
  
  
			function cek_asu(){
				var ikut_asuransi = $('input[name=ikut_asuransi]:checked').val();
						
						if (ikut_asuransi == "Y"){
								$("#nama_asuransi").show();
								$("#keterangan_asuransi").hide();
								$("#ket_asuransi").val("");
							}else {
								$("#nama_asuransi").hide();
								$("#keterangan_asuransi").show();
								document.getElementById("asuransi").selectedIndex = "0"; 
							}
							
							
				
			}
		  
  
  
		
                                      function addreadonly(){
										  
                                          document.getElementById("refund").readOnly = true;
										  $("#id_leasing").show();
											$("#id_tenor").show();
											$("#ikut_asuransi").hide();
											
                                          //document.getElementById("leasing").required = true;
                                          //document.getElementById("tenor").required = true;
                                      }
									  
									  
									   function removerequire(){
									  //  var read=document.getElementById("k")
										 //   .removeAttribute("readonly",0);
										var read=document.getElementById("ket_asuransi")
											.removeAttribute("required",0);  
									   // var read=document.getElementById("tenor")
										   // .removeAttribute("required",0);
									 //alert("atribut textbox readonly telah terhapus");
									  }
									  function addrequire(){
										 // document.getElementById("refund").readOnly = true;
										  document.getElementById("ket_asuransi").required = true;
										  //document.getElementById("tenor").required = true;
									  }
						
			
						
						
						
						function cek_input_pengajuan() {
							
							var PromoDealer = (document.form.promo_dealer.value).length;
							var CaraBeli = (document.form.cara_beli.value).length;
							var KetDiskon = (document.form.ket_discount.value).split(' ').join('').length;
							var Pengajuan_Diskon = (document.form.pengajuan_disc.value).length;
							var metodebyr = $('input[name=cara_beli]:checked').val();
							var TahunBuat = (document.form.tahun_buat.value).length;							
							var Jenis_identitas = (document.form.jenis_identitas.value).length;
							var No_identitas = (document.form.no_identitas.value).split(' ').join('').length;
							var Hp_customer = (document.form.hp_customer.value).split(' ').join('').length;
							var Alamat_customer = (document.form.alamat_customer.value).split(' ').join('').length;
							var nama_Warna = (document.form.warna.value).length;
							
							
							if (metodebyr == "KREDIT"){
								var Leasing = (document.form.leasing.value).length;
								var Tenor = (document.form.tenor.value).length;
								var nama_leasing = document.form.leasing.value;
							}else{
								var Leasing = "";
								var Tenor = "";
								var nama_leasing = "";
							}
							
							var nilai_refund = document.form.refund.value;
							
							
							//alert(nama_leasing);
							//return false;
							if (PromoDealer == "Tidak Ikut Program"){
							
								if (metodebyr == "KREDIT" && ((nama_leasing != "(KPM) MANDIRI" && nama_leasing != "(KKB) BCA" && nama_leasing != "(KKB) MAYBANK" ) && nilai_refund == 0 )){
									swal({
									title: "Peringatan!",
									text: "Proses kalkulasi refund selesai",
									type: "warning",
									confirmButtonColor: "#007AFF"
									});
									
									hitung_refund();
								
									return false;
									
								}
							}
							if (Jenis_identitas < 1){
								swal({
									title: "Peringatan!",
									text: "Jenis Identitas Tidak Boleh Kosong",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								//document.form.warna.focus();
								return false;
								
							}
							
							if (No_identitas < 1){
								swal({
									title: "Peringatan!",
									text: "Nomor Identitas Tidak Boleh Kosong",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								//document.form.warna.focus();
								return false;
								
							}
							
							if (Hp_customer < 1){
								swal({
									title: "Peringatan!",
									text: "Nomor HP Customer Tidak Boleh Kosong",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								//document.form.warna.focus();
								return false;
								
							}
							
							if (Alamat_customer < 1){
								swal({
									title: "Peringatan!",
									text: "Alamat Customer Tidak Boleh Kosong",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								//document.form.warna.focus();
								return false;
								
							}
							
							if (nama_Warna < 1){
								swal({
									title: "Peringatan!",
									text: "Warna Mobil Tidak Boleh Kosong",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								//document.form.warna.focus();
								return false;
								
							}
							
							if (TahunBuat < 1){
								swal({
									title: "Peringatan!",
									text: "Tahun Mobil Tidak Boleh Kosong",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								//document.form.tahun_buat.focus();
								return false;
								
							}
							
							
							if (PromoDealer < 1){
							swal({
								title: "Peringatan!",
								text: "Program Marketing Tidak Boleh Dikosongkan",
								type: "warning",
								confirmButtonColor: "#007AFF"
							});
							
							
							return false;
							
							}
							if (CaraBeli < 1){
								swal({
									title: "Peringatan!",
									text: "Metode Pembayaran Tidak Boleh Dikosongkan",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								
								return false;
								
							}
							
							if (metodebyr == "KREDIT"){
								if (Leasing < 1) {
									swal({
										title: "Peringatan!",
										text: "Leasing Tidak Boleh Dikosongkan",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									return false;
								}
								if (Tenor < 1) {
									swal({
										title: "Peringatan!",
										text: "Tenor Tidak Boleh Dikosongkan",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									return false;
								}
							}
							
							if (KetDiskon < 1){
								swal({
									title: "Peringatan!",
									text: "Keterangan Tidak Boleh Dikosongkan",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								
								return false;
								
							}
							if (Pengajuan_Diskon < 1){
								swal({
									title: "Peringatan!",
									text: "Pengajuan Diskon Tidak Boleh Dikosongkan",
									type: "warning",
									confirmButtonColor: "#007AFF"
								});
								
								
								return false;
								
							}
							
						
							document.getElementById("form").submit(); 
							//alert("submit data");
						}
						
						function promo_dealer1(){
							var prog_sales = $("#promo_dealer").val();				
						//	if (prog_sales == 'MTF KOMBINASI'){
							if (prog_sales == 'BCA KOMBINASI' || prog_sales == 'MBF KOMBINASI' || prog_sales == 'MTF KOMBINASI' || prog_sales == 'OTO MULTIARTHA KOMBINASI' || prog_sales == 'MAYBANK KOMBINASI' || prog_sales == 'CLIPAN KOMBINASI'){
							document.getElementById("radio2").checked = true;
							$("#ikut_asuransi").hide();
							//document.getElementById("id_metodebyr").disabled = true;
							//var package = $('.metodebayar').val();
								var metodebyr = $('input[name=cara_beli]:checked').val();
								//document.getElementById("leasing").selectedIndex = "6";
								//document.getElementById("tenor").selectedIndex = "0";
								
								if (metodebyr == "KREDIT"){
									$("#id_leasing").show();
									$("#id_tenor").show(); 
									$("#refund").show();
									//$("#jenis_asuransi").show();
									
									//document.getElementById("radio8").checked = true;
									document.getElementById("radio2").checked = true;		
									document.getElementById("leasing").selectedIndex = "2";
									$("#id_metodebyr").hide();
									$("#id_leasing").hide();
									$("#id_metodebyr2").show();
									$("#id_leasing2").show();
									//document.getElementById("tenor").required = true;
									$("#refund").val(0);	
								}						
							}
							else {
								document.getElementById("id_metodebyr").disabled = false;
								document.getElementById("leasing").disabled = false;
								//document.getElementById("radio8").checked = false;
								document.getElementById("leasing").selectedIndex = "0";
								document.getElementById("tenor").selectedIndex = "0";
								document.getElementById("radio2").checked = false;
								//$("#jenis_asuransi").hide();
								$("#id_tenor").hide();
								$("#refund").val(0);
								$("#id_metodebyr").show();
								//$("#id_leasing").show();
								$("#id_metodebyr2").hide();
								$("#id_leasing2").hide();
								$("#id_leasing").hide();
							}
						}
						
						//format angka saat ketik
						
						function startCalc(){
							interval = setInterval("calc()",1);
						}                                        
													
						function stopCalc(){
							clearInterval(interval);
						}
						function calc(){
							one = document.form.pengajuan_disc.value;
							two = document.form.total_discount_accs.value; 
							three = document.form.refund.value; 
							
							var rupiah1 = one;
							var rupiah2 = two;
							var rupiah3 = three;
							var clean1 = rupiah1.replace(/\D/g, '');
							var clean2 = rupiah2.replace(/\D/g, '');
							var clean3 = rupiah3.replace(/\D/g, '');
							
							
							
							var bilangan = (clean1 * 1) + (clean2 * 1) - (clean3 * 1);
							
							
							var	reverse = bilangan.toString().split('').reverse().join(''),
							ribuan 	= reverse.match(/\d{1,3}/g);
							ribuan	= ribuan.join('.').split('').reverse().join('');
							
							var disc_bruto = (clean1 * 1) + (clean2 * 1);
							
							var	disc_bruto1 = disc_bruto.toString().split('').reverse().join(''),
							disc_bruto2 	= disc_bruto1.match(/\d{1,3}/g);
							disc_bruto2	= disc_bruto2.join('.').split('').reverse().join('');
							
							document.form.discbruto.value = (disc_bruto2);
							if (bilangan < 0){
								document.form.total_discount.value = (0);
								//document.form.discbruto.value = (0);
							}
							else {
								document.form.total_discount.value = (ribuan);
								document.form.discbruto.value = (disc_bruto2);
							}
							
							
						}
						
						
						///=========================
						
						function asal_prospek(){
											var isipd = $('input[name=asal_prospek]:checked').val();
											//alert(isipd);
											$.ajax({
												method : "post",
												url : "modul/prospek/action/ajax/pengajuandiscount_asal_prospek.php",
												data : {data_ajax : isipd},
												success : function(data){
													$('#ket_asal_prospek').html(data);
													//console.log(data);
													//$('#harga_otr').val(10000000);
												
												}
												
											})
											
											
										}
										
							function get_tipe(){
								
								var isipd = $('#model').val();
								$.ajax({
									method : "post",
									url : "modul/prospek/action/ajax/pengajuandiscount_get_tipe.php",
									data : {data_ajax : isipd},
									success : function(data){
										$('#tipe_mobil').html(data);
										
									
									}
									
								})
							}
							
							function get_warna(){
							
								var isipd = $('#tipe_mobil').val();
								$.ajax({
									method : "post",
									url : "modul/prospek/action/ajax/pengajuandiscount_get_warna.php",
									data : {data_ajax : isipd},
									success : function(data){
										$('#warna').html(data);
									}
									
								})
							}
							
							function promo(){
													
								var isipd = $('#promo_dealer').val();
								//alert(isipd);
								$("#ikut_asuransi").hide();
									//$("#id_ikut_asuransi").hide();
										$("#refund").val(0);
										//document.getElementById("leasing").selectedIndex = "0";
										//document.getElementById("tenor").selectedIndex = "0";
									
									$.ajax({
										method : "post",
										url : "modul/prospek/action/ajax/pengajuandiscount_get_promo.php",
										data : {data_ajax : isipd},
										success : function(data){
											$('#id_metodebyr_2').html(data);
											console.log(data);
											//$('#harga_otr').val(10000000);
										
										}
										
									})
								
							}
							
							function tampil_leasing(){
								var isipd = $('input[name=cara_beli]:checked').val();
								//alert(isipd);
									if (isipd != "KREDIT"){
										$("#refund").val(0);
										//document.getElementById("leasing").selectedIndex = "0";
										//document.getElementById("tenor").selectedIndex = "0";
									}else{
										
										document.getElementById("radio20").checked = false;
										document.getElementById("radio21").checked = false;
										document.getElementById("asuransi").selectedIndex = "0";
										
										
									}
									$.ajax({
										method : "post",
										url : "modul/prospek/action/ajax/pengajuandiscount_get_tampil_leasing.php",
										data : {data_ajax : isipd},
										success : function(data){
											$('#tampil_leasing_2').html(data);
											console.log(data);
											//$('#harga_otr').val(10000000);
										
										}
										
									})
									
									$.ajax({
											method : "post",
											url : "modul/prospek/action/ajax/pengajuandiscount_get_tampil_asuransi.php",
											data : {data_ajax : isipd},
											success : function(data){
												$('#tampil_asuransi_5').html(data);
												console.log(data);
												//$('#harga_otr').val(10000000);
											
											}
											
										})
							}
							function asuransi(){
												//	$('#id_ikut_asuransi').on('change',function(){
														var ikut_asuransi = $('input[name=ikut_asuransi]:checked').val();
														//alert(ikut_asuransi);
														if (ikut_asuransi == "Y"){
																$("#nama_asuransi").show();
																$("#keterangan_asuransi").hide();
															}else {
																$("#nama_asuransi").hide();
																$("#keterangan_asuransi").show();
																document.getElementById("asuransi").selectedIndex = "0"; 
															}
														
												//	})
												}
		
							
			function hitung_refund(){
				
				var harga_otr = $("#harga_otr").val();
				var harga_otr2 = harga_otr.replace(/\D/g, '');
				var leasing = $("#leasing").val();
				var tenor = $("#tenor").val();
				//var refund_awal = $("#refund").val();
				var refund_awal = "";
				if (harga_otr === ""){
					harga_otr = 0;
				}
				if (leasing != "" && tenor != ""){
					$("#preload-wrapper6").show();
					
					$.ajax({
						url: 'modul/prospek/action/ajax/pengajuandiscount_hitung_refund.php',
						data: 'harga_otr='+harga_otr+'&leasing='+leasing+'&tenor='+tenor,
						success :function (data) {
							var json = data,
							obj = JSON.parse(json);
							var a = Math.round(obj.rasio*harga_otr2*0.15);
							var	reverse = a.toString().split('').reverse().join(''),
							ribuan 	= reverse.match(/\d{1,3}/g);
							ribuan	= ribuan.join('.').split('').reverse().join('');
							 $('#refund').val(ribuan);
							 var prog_sales = $("#promo_dealer").val();
							 if (prog_sales == 'BCA KOMBINASI'){
								 $('#refund').val(0);
								 document.getElementById("refund").readOnly = true;
								 document.getElementById("tenor").required = true;
							 }
							 else if (prog_sales == 'MBF KOMBINASI'){
								 $('#refund').val(0);
								 document.getElementById("refund").readOnly = true;
								 document.getElementById("tenor").required = true;
							 }
							 else if (prog_sales == 'MTF KOMBINASI'){
								 $('#refund').val(0);
								 document.getElementById("refund").readOnly = true;
								 document.getElementById("tenor").required = true;
							 }
							 else if (prog_sales == 'OTO MULTIARTA KOMBINASI'){
								 $('#refund').val(0);
								 document.getElementById("refund").readOnly = true;
								 document.getElementById("tenor").required = true;
							 }
							 else if (prog_sales == 'MAYBANK KOMBINASI'){
								 $('#refund').val(0);
								 document.getElementById("refund").readOnly = true;
								 document.getElementById("tenor").required = true;
							 }
							 else{
							 }
							 
							var refund_new = $("#refund").val();	
							if (refund_awal != refund_new){
								$(".preload-wrapper6").fadeOut("slow");
							}
						
						},
						error: function (data) {
							alert("File ajax tidak ditemukan");
							$(".preload-wrapper6").fadeOut("slow");
					   }
				
					});
				}
				startCalc();
			}				
														
										
			function harga_otomatis($jenis){
				var carabyr = $('input[name=cara_beli]:checked').val();
                var tipe_mobil = $("#tipe_mobil").val();
				var warna = $("#warna").val();
				var tahun_buat = $("#tahun_buat").val();
				
				if ($jenis == "ulang"){
					var tgl_pengajuan = $("#tgl_pengajuan").val();
					var no_pengajuan = $("#no_pengajuan").val();
					var no_spk = $('#no_spk').val();
					
				}else{
					var tgl_pengajuan = ""
					var no_pengajuan = ""
					var no_spk = "";
					
				}
				
				
				
				var harga_lama = "";
				
				if (warna == null || tahun_buat == ""){
					$('#harga_otr').val(0);	
					warna = "Kosong";
					tahun_buat = "1988"
				}
				
                else {
					$(".preload-wrapper3").show();	
					
					$.ajax({
						url: 'modul/prospek/action/ajax/pengajuandiscount_harga_otomatis.php',
						data: 'tipe_mobil='+tipe_mobil+'&warna='+warna+'&tahun_buat='+tahun_buat+'&tgl_pengajuan='+tgl_pengajuan+'&no_pengajuan='+no_pengajuan+'&no_spk='+no_spk,
					}).success(function (data) {
						var json = data,
						obj = JSON.parse(json);
						var a = (obj.harga);
						var	reverse = a.toString().split('').reverse().join(''),
						ribuan 	= reverse.match(/\d{1,3}/g);
						ribuan	= ribuan.join('.').split('').reverse().join('');
						$('#harga_otr').val(ribuan);
						
						var b = (obj.plafon_diskon);
						var	reverse = b.toString().split('').reverse().join(''),
						ribuan2 	= reverse.match(/\d{1,3}/g);
						ribuan2		= ribuan2.join('.').split('').reverse().join('');						
						 
						$('#discount_unit').val(ribuan2);
						
						var harga_baru = $('#harga_otr').val();
						
						if (harga_baru != harga_lama){
							$(".preload-wrapper3").fadeOut("slow");							
						}
						if (carabyr == 'KREDIT'){
							hitung_refund();
						}
						
						
					});
				}
            startCalc();
            
			}