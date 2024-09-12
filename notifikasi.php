<?php
	session_start();
?>

<script>
	
	
	var leveluser = "<?php echo $_SESSION['leveluser']?>";
	var username = "<?php echo $_SESSION['username']?>";
	var kode_spv = "<?php echo $_SESSION['kode_spv']?>";
	if(leveluser != ''){
		if(leveluser == 'admin' || leveluser == 'HRD' || leveluser == 'CCO' || leveluser == 'MNGR' || leveluser == 'mngr_bengkel' ||leveluser == 'user' || 
		leveluser == 'DRKSI' || leveluser == 'supervisor' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'mngr_finance'  || 
		leveluser == 'staff_logistik' || leveluser == 'ar_finance' || leveluser == 'spv_finance'){
			function cek_aktivitas(){
				var title_sos = "Honda Bintaro - Sistem Operasional Sales";
				
			
			//	if(leveluser == 'admin'){
					function test(url, data, success, leveluser_notif, message_title, data_set, url_set){
						var urlTest = url;
						var dataTest = data;
						var successTest = success;
						var leveluserTest = leveluser_notif;
						var message_titleTest = message_title;
						var data_set_notif = data_set;
						var url_set_notif = url_set;
						$.ajax({
							method: "post",
							url: url,
							data: data,
							cache: false,
							success: function(notif_pengecekan){
								console.log(notif_pengecekan);
								if(notif_pengecekan != '' && (leveluserTest)){
									$("#myAudio").attr("autoplay", "true");
									var notif_string = notif_pengecekan.toString();
									var notif_trim = notif_string.trim();
									var notif_split = notif_trim.split("|");
									var i;
									var notif_string2 = notif_split.toString();
									var notif_trim2 = notif_string2.trim();
									var notif_split2 = notif_trim2.split(",");
									var msg_title = message_titleTest;
									var granted = 0;
									
									for (i=0; i <= (notif_split.length-i-i) ;i++){
										var redirect_onclick = notif_split2[5];
										
										if(msg_title = "PENGECEKAN SHOWROOM"){
											if(leveluser == 'admin' || leveluser == 'HRD'){
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
											}else{
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
											}
										}else if(msg_title = "PENGECEKAN SERVICE"){
											if(leveluser == 'admin' || leveluser == 'HRD'){
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
											}else{
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
											}
										}else if(msg_title = "PENGECEKAN PENAMPILAN SALES"){
											if(leveluser == 'admin' || leveluser == 'supervisor'){
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
											}else{
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
											}
											console.log(isi);
										}else if(msg_title = "PENGECEKAN PENAMPILAN SA"){
											if(leveluser == 'admin' || leveluser == 'supervisor'){
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
											}else{
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
											}
										}else if(msg_title = "PENGAJUAN DISKON"){
											if(leveluser == 'user'){
												var isi = "Dear " + user + ", Pengajuan Diskon dengan no pengajuan " + notif_split2[0] + " sudah diproses";
											}else if(leveluser == 'MNGR' || leveluser == 'admin'){
												leveluser = 'Pak Burli';
												var isi = "Dear " + leveluser + (", terdapat ") + "Pengajuan Diskon dari " + notif_split2[1] + " dengan no pengajuan " + notif_split2[0];
											}else if(leveluser = 'DRKSI'){
												leveluser = 'Pak Tin Kok Sin';
												var isi = "Dear " + leveluser + ", Pengajuan Diskon dengan no pengajuan " + notif_split2[0] + " menunggu persetujuan";
											}else{
												var isi = "";
											}
										}else if(msg_title = "PERMOHONAN UNIT KELUAR"){
											if(leveluser == 'admin' || leveluser == 'supervisor'){
												var isi = "No SPK : " + notif_split2[0] + '\n' + 'Waktu Keluar : ' + notif_split2[2] + '\n' + 'No Rangka : ' + notif_split2[3] + '\n \n \n' +  notif_split2[4];
											}else{
												var isi = "No SPK : " + notif_split2[0] + '\n' + 'Waktu Keluar : ' + notif_split2[2] + '\n' + 'No Rangka : ' + notif_split2[3] + '\n \n \n' +  notif_split2[4];
											}
										}else if(msg_title = "PEMASANGAN AKSESORIS"){
											var isi = "No Permohonan " + notif_split2[0] + '\n \n' + 'Tipe : ' + notif_split2[1] + + notif_split2[2] + + notif_split2[3];
										}else{
											var isi =  "";
										}
										
										
										if (!("Notification" in window)) {
											alert("This browser does not support desktop notification");
										}else if (Notification.permission === "granted") {
											granted = 1;
										}else if (Notification.permission !== 'denied') {
											Notification.requestPermission(function (permission) {
												if (permission === "granted") {
													granted = 1;
												}
											});
										}
								 
										if (granted == 1) {
										//	var notification = new Notification(msg_title, {
											var notification = new Notification(message_titleTest, {
												body: isi,
												icon: 'favicon.png'
											});	
											if (redirect_onclick) {
												notification.onclick = function() {
													window.location.href = redirect_onclick;
												}
											}
										}
										
										setTimeout(function deletenotif(){
											var no_spk = notif_split2[0];
											var nopengajuan = notif_split2[0];
											if(msg_title = "PERMOHONAN UNIT KELUAR"){
												var data_set_notif_delete = 'nospk='+no_spk+'&leveluser='+leveluser;
											}else if(msg_title = "PENGAJUAN_DISKON"){
												var data_set_notif_delete = 'no_pengajuan='+nopengajuan+'&data2='+username;
											}else{
												var data_set_notif_delete = data_set_notif;
											}
											$.ajax({
												method: "post",
												data : data_set_notif_delete,
												url: url_set_notif,
												success: function(data){
													console.log(data);
												}
											});
										}, 2000);
									}
								}
							}
						});	
					}
					
					var showroom = {
						url:"notif_pengecekan/ceknotif_pengecekan.php",
						data:'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'admin' || leveluser == 'HRD' || leveluser == 'CCO',
						message_title: "PENGECEKAN SHOWROOM",
						data_delete: 'leveluser='+leveluser,
						url_delete: "notif_pengecekan/stop_notif_pengecekan.php",
					}
					var notif_showroom = new test(showroom.url, showroom.data, showroom.success, showroom.leveluser_get_notif, showroom.message_title, showroom.data_delete, showroom.url_delete);
					
					var service = {
						url:"notif_pengecekan/ceknotif_pengecekan_service.php",
						data:'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'admin' || leveluser == 'CCO' || leveluser == 'HRD',
						message_title: "PENGECEKAN SERVICE",
						data_delete: 'data_user='+leveluser,
						url_delete: "notif_pengecekan/stop_notif_pengecekan_service.php",
					}
					
					var notif_service = new test(service.url, service.data, service.success, service.leveluser_get_notif, service.message_title, service.data_delete, service.url_delete);
					
					var sales = {
						url:"notif_pengecekan/ceknotif_penampilan_sales.php",
						data:'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'admin' || leveluser == 'CCO' || leveluser == 'supervisor',
						message_title: "PENGECEKAN PENAMPILAN SALES",
						data_delete: 'data_user='+leveluser,
						url_delete: "notif_pengecekan/stop_notif_penampilan_sales.php",
					}
					
					var notif_sales = new test(sales.url, sales.data, sales.success, sales.leveluser_get_notif, sales.message_title, sales.data_delete, sales.url_delete);
					
					var sa = {
						url:"notif_pengecekan/ceknotif_penampilan_sa.php",
						data:'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'admin' || leveluser == 'mngr_bengkel',
						message_title: "PENGECEKAN PENAMPILAN SA",
						data_delete: 'leveluser='+leveluser,
						url_delete: "notif_pengecekan/stop_notif_penampilan_sa.php",
					}
					
					var notif_sa = new test(sa.url, sa.data, sa.success, sa.leveluser_get_notif, sa.message_title, sa.data_delete, sa.url_delete);
					
				/*	var diskon = {
						url:"ceknotif.php",
						data: 'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'DRKSI' || leveluser == 'MNGR' || leveluser == 'user' || leveluser == 'admin',
						message_title: "PENGAJUAN DISKON",
						data_delete: "",
						url_delete: "stop_notif.php",
					}	
					
					var notif_pengajuan_diskon = new test(diskon.url, diskon.data, diskon.success, diskon.leveluser_get_notif, diskon.message_title, diskon.data_delete, diskon.url_delete);		*/
					
				/*	var aksesoris = {
						url:"ceknotif_pemasangan_aksesoris.php",
						data: 'leveluser='+leveluser+'&kode_spv='+kode_spv,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'admin' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'supervisor' || leveluser == 'MNGR' || leveluser == 'mngr_finance' || leveluser == 'staff_logistik',
						message_title: "PEMASANGAN AKSESORIS",
						data_delete: "",
						url_delete: "stop_notif_aksesoris.php",
					}		
					
					var notif_aksesoris = new test(aksesoris.url, aksesoris.data, aksesoris.success, aksesoris.leveluser_get_notif, aksesoris.message_title, aksesoris.data_delete, aksesoris.url_delete);	*/
					
				/*	var unit_keluar = {
						url:"ceknotif_permohonan_unit_keluar.php",
						data: 'leveluser='+leveluser+'&kode_spv='+kode_spv,
						success:"total_pesan_pengecekan",
						leveluser_get_notif: leveluser == 'admin' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'supervisor' || leveluser == 'MNGR' || leveluser == 'mngr_finance',
						message_title: "PERMOHONAN UNIT KELUAR",
						data_delete: "",
						url_delete: "stop_notif_unit_keluar.php",
					}	
					
					var notif_unit_keluar = new test(unit_keluar.url, unit_keluar.data, unit_keluar.success, unit_keluar.leveluser_get_notif, unit_keluar.message_title, unit_keluar.data_delete, unit_keluar.url_delete);	*/
					
			//	}
				
			
			
				//==================JUMLAH PESAN DI BADGE==================
			    $.ajax({
					method: "post",
					url: "notif_pengecekan/cekpesan_pengecekan.php",
					data: 'leveluser='+leveluser,
			        cache: false,
			        success: function(total_pesan_pengecekan){
						if((leveluser == 'supervisor' && username == 'sudi123') || leveluser == 'admin' || leveluser == 'HRD'){
							var jumlah_pesan_pengecekan = total_pesan_pengecekan;
						}else{
							var jumlah_pesan_pengecekan = 0;
						}
						
					/*	var pesan_pengajuan_jumlah = function(){
							$.ajax({
								url: "cekpesan.php",
								cache: false,
								success: function(total_pesan_pengajuan){
									if(leveluser == 'MNGR' || leveluser == 'DRKSI' || leveluser == 'user' || leveluser == 'admin' || leveluser == 'staff_logistik'){
										var jumlah_pesan_pengajuan = parseInt(total_pesan_pengajuan);
									}else{
										var jumlah_pesan_pengajuan = 0;
									}
									
								}
							})
						}
						console.log(pesan_pengajuan_jumlah());	*/
						
						
						$.ajax({
							method: "post",
							url: "cekpesan.php",
							cache: false,
							data: 'leveluser=' + leveluser,
							success: function(total_pesan_pengajuan){
								if(leveluser != ''){
									if(leveluser == 'MNGR' || leveluser == 'DRKSI' || leveluser == 'user' || leveluser == 'admin' || leveluser == 'staff_logistik'){
										var jumlah_pesan_pengajuan = total_pesan_pengajuan;
									//	var jumlah_pesan_pengajuan = 2030;
											
										$.ajax({
											method: "post",
											url: "notif_pengecekan/jumlah_hasil_pengecekan.php",
											data: 'leveluser='+leveluser,
											cache: false,
											success: function(total_hasil_pengecekan){
											//	if(leveluser == 'CCO' || leveluser == 'HRD' || leveluser == 'user' || leveluser == 'supervisor' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'mngr_finance'){
												if(leveluser == 'MNGR' || leveluser == 'mngr_bengkel' || leveluser == 'DRKSI' || leveluser == 'admin' || leveluser == 'HRD' || (leveluser == 'supervisor' && username == 'sudi123') ){
													var jumlah_pengecekan_hasil = total_hasil_pengecekan;
												}else{
													var jumlah_pengecekan_hasil = 0;
												}
												var total_semua_pesan = parseInt(jumlah_pengecekan_hasil) + parseInt(jumlah_pesan_pengecekan) + parseInt(jumlah_pesan_pengajuan);
												if(total_semua_pesan != 0){
													$("title").html("(" + total_semua_pesan + ") " + title_sos);
												}else{
													$("title").html(title_sos);
												}
												$("#hasil_pengecekan").html(jumlah_pengecekan_hasil);
												$("#jmlh").html(total_semua_pesan);
												
												//================== MENAMPILKAN ISI PESAN APPROVE PENGECEKAN DI BADGE ================== //
												$.ajax({
													method: "post",
													url: "notif_pengecekan/lihathasil_pengecekan.php",
													data: 'leveluser='+leveluser,
													cache: false,
													success: function(total_pesan_pengajuan){
														$("#loading").hide();
														$("#konten-info-pengecekan").html(total_pesan_pengajuan);
													}
												});
											}
											
										});
										
									}else{
										var jumlah_pesan_pengajuan = 0;
									}
								}else{
									var jumlah_pesan_pengajuan = 0;
								}
							//	console.log(jumlah_pesan_pengajuan);
								
								
								
								$("#jmlh2").html(total_pesan_pengajuan);
								
								//================== MENAMPILKAN ISI PESAN PENGAJUAN DI BADGE ==================//
								$.ajax({
									url: "lihatpesan.php",
									cache: false,
									success: function(total_pesan_pengajuan){
										$("#loading").hide();
										$("#konten-info").html(total_pesan_pengajuan);
									}
								});
							}
						});
				
			            $("#jmlh_showroom").html(total_pesan_pengecekan);
						$("#jmlh_showroom2").html(total_pesan_pengecekan);
						
						//================== MENAMPILKAN ISI PESAN PENGECEKAN DI BADGE ==================
						$.ajax({
							method: "post",
							url: "notif_pengecekan/lihatpesan_pengecekan.php",
							data: 'leveluser='+leveluser,
							cache: false,
							success: function(lihat_pesan_pengecekan){
								$("#loading").hide();
								$("#konten-info-showroom").html(lihat_pesan_pengecekan);
							}
						});
					}
				});
			
			  //================== MENAMPILKAN NOTIFIKASI PESAN PENGAJUAN DISKON ==================
				$.ajax({
					method: "post",
					url: "ceknotif.php",
					cache: false,
					data: 'leveluser='+leveluser,
					success: function(notif_pengajuan_record){
						if(leveluser != ''){
							if(notif_pengajuan_record != '' && (leveluser == 'DRKSI' || leveluser == 'MNGR' || leveluser == 'user' || leveluser == 'admin')){
								$("#myAudio").attr("autoplay", "true");
								var notif_pengajuan_record_string = notif_pengajuan_record.toString();
								var notif_pengajuan_record_trim = notif_pengajuan_record_string.trim();
								var notif_pengajuan_record_split = notif_pengajuan_record_trim.split("|");
								var i;
									var notif_pengajuan_item_string = notif_pengajuan_record_split.toString();
									var notif_pengajuan_item_trim = notif_pengajuan_item_string.trim();
									var notif_pengajuan_item_split = notif_pengajuan_item_trim.split(",");
									var msg_title = "PENGAJUAN DISKON";
									var granted = 0;
								//	var NotificationIsSupported = !!(window.Notification || win.webkitNotifications || navigator.mozNotification ); 
								
								for (i=0; i <= (notif_pengajuan_record_split.length-i-i) ;i++){
									var redirect_onclick = notif_pengajuan_item_split[4];
								
									if(leveluser == 'user'){
										var isi = "Dear " + user + ", Pengajuan Diskon dengan no pengajuan " + notif_pengajuan_item_split[0] + " sudah diproses";
									}else if(leveluser == 'MNGR'){
										leveluser = 'Pak Burli';
										var isi = "Dear " + leveluser + (", terdapat ") + "Pengajuan Diskon dari " + notif_pengajuan_item_split[1] + " dengan no pengajuan " + notif_pengajuan_item_split[0];
									}else if(leveluser = 'DRKSI'){
										leveluser = 'Pak Tin Kok Sin';
										var isi = "Dear " + leveluser + ", Pengajuan Diskon dengan no pengajuan " + notif_pengajuan_item_split[0] + " menunggu persetujuan";
									}
									
									if (!("Notification" in window)) {
								//	if (!("Notification" in window || "webkitNotifications" in window || "mozNotification" in navigator)) {
										alert("This browser does not support desktop notification");
									}
									
									else if (Notification.permission === "granted") {
								//	else if (Notification.permission === "granted" || webkitNotifications.permission === "granted" || mozNotification.permission === "granted") {
										granted = 1;
									}
							 
									else if (Notification.permission !== 'denied') {
										Notification.requestPermission(function (permission) {
											if (permission === "granted") {
												granted = 1;
											}
										});
									}
							 
									if (granted == 1) {
										var notification = new Notification(msg_title, {
											body: isi,
											icon: 'favicon.png'
										});	
									
										if (redirect_onclick) {
											notification.onclick = function() {
												window.location.href = redirect_onclick;
											//	window.open(redirect_onclick);
											}
										}
									}
									
									setTimeout(function deletenotif(){
										var nopengajuan = notif_pengajuan_item_split[0];
										var username = "<?php echo $_SESSION['username'] ?>";
										$.ajax({
											method: "post",
											data : 'no_pengajuan='+nopengajuan+'&data2='+username,
											url: "stop_notif.php",
											success: function(data){
											}
										});
									}, 2000);
								}
								
							}else{
								if (!("Notification" in window)) {
									
								}
							}
						}
					}
				});
				
				//================== MENAMPILKAN NOTIFIKASI PESAN PEMASANGAN AKSESORIS ==================
				
				
				$.ajax({
					method: "post",
					url: "ceknotif_pemasangan_aksesoris.php",
					data: 'leveluser='+leveluser + '&kode_spv=' + kode_spv,
					cache: false,
					success: function(notif_pemasangan_accs){
						if(leveluser != ''){
							if(notif_pemasangan_accs != '' && (leveluser == 'admin' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'supervisor' || leveluser == 'MNGR' || leveluser == 'mngr_finance' || leveluser == 'staff_logistik')){
								$("#myAudio").attr("autoplay", "true");
								var notif_pengajuan_record_string = notif_pemasangan_accs.toString();
								var notif_pengajuan_record_trim = notif_pengajuan_record_string.trim();
								var notif_pengajuan_record_split = notif_pengajuan_record_trim.split("|");
								var i;
									var notif_pengajuan_item_string = notif_pengajuan_record_split.toString();
									var notif_pengajuan_item_trim = notif_pengajuan_item_string.trim();
									var notif_pengajuan_item_split = notif_pengajuan_item_trim.split(",");
									var msg_title = "PEMASANGAN AKSESORIS";
									var granted = 0;
								
								for (i=0; i <= (notif_pengajuan_record_split.length-i-i) ;i++){
									var redirect_onclick = notif_pengajuan_item_split[5];
									var isi = "No Permohonan " + notif_pengajuan_item_split[0] + '\n \n' + 'Tipe : ' + notif_pengajuan_item_split[1] + '\n \n' + notif_pengajuan_item_split[2] + '\n \n' + notif_pengajuan_item_split[3];
									
									if (!("Notification" in window)) {
										alert("This browser does not support desktop notification");
									}else if (Notification.permission === "granted") {
										granted = 1;
									}else if (Notification.permission !== 'denied') {
										Notification.requestPermission(function (permission) {
											if (permission === "granted") {
												granted = 1;
											}
										});
									}
							 
									if (granted == 1) {
										var notification = new Notification(msg_title, {
											body: isi,
											icon: 'favicon.png'
										});	
										if (redirect_onclick) {
											notification.onclick = function() {
												window.location.href = redirect_onclick;
											}
										}
									}
									
									setTimeout(function deletenotif_aksesoris(){
										var nopermohonan = notif_pengajuan_item_split[0];
										var leveluser = "<?php echo $_SESSION['leveluser'] ?>";
										$.ajax({
											method: "post",
											data : 'nopermohonan='+nopermohonan+'&leveluser='+leveluser,
											url: "stop_notif_aksesoris.php",
											success: function(data){
												console.log(data);
											}
										});
									}, 2000);
									
								}
							}
						}
					}
				});	
				
				$.ajax({
					method: "post",
					url: "ceknotif_permohonan_unit_keluar.php",
					data: 'leveluser='+leveluser+'&kode_spv='+kode_spv,
					cache: false,
					success: function(notif_permohonan_unit_keluar){
						if(leveluser != ''){
							if(notif_permohonan_unit_keluar != '' && (leveluser == 'admin' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'supervisor' || leveluser == 'MNGR' || leveluser == 'mngr_finance')){
								$("#myAudio").attr("autoplay", "true");
								var notif_pengajuan_record_string = notif_permohonan_unit_keluar.toString();
								var notif_pengajuan_record_trim = notif_pengajuan_record_string.trim();
								var notif_pengajuan_record_split = notif_pengajuan_record_trim.split("|");
								var i;
									var notif_pengajuan_item_string = notif_pengajuan_record_split.toString();
									var notif_pengajuan_item_trim = notif_pengajuan_item_string.trim();
									var notif_pengajuan_item_split = notif_pengajuan_item_trim.split(",");
									var msg_title = "PERMOHONAN UNIT KELUAR";
									var granted = 0;
								
								for (i=0; i <= (notif_pengajuan_record_split.length-i-i) ;i++){
									var redirect_onclick = notif_pengajuan_item_split[5];
									var isi = "No SPK : " + notif_pengajuan_item_split[0] + '\n' + 'Waktu Keluar : ' + notif_pengajuan_item_split[2] + '\n' + 'No Rangka : ' + notif_pengajuan_item_split[3] + '\n \n' +  notif_pengajuan_item_split[4];
									
									if (!("Notification" in window)) {
										alert("This browser does not support desktop notification");
									}else if (Notification.permission === "granted") {
										granted = 1;
									}else if (Notification.permission !== 'denied') {
										Notification.requestPermission(function (permission) {
											if (permission === "granted") {
												granted = 1;
											}
										});
									}
							 
									if (granted == 1) {
										var notification = new Notification(msg_title, {
											body: isi,
											icon: 'favicon.png'
										});	
										if (redirect_onclick) {
											notification.onclick = function() {
												window.location.href = redirect_onclick;
											}
										}
									}
									
									setTimeout(function deletenotif_unit_keluar(){
										var nospk = notif_pengajuan_item_split[0];
										var leveluser = "<?php echo $_SESSION['leveluser'] ?>";
										$.ajax({
											method: "post",
											data : 'nospk='+nospk+'&leveluser='+leveluser,
											url: "stop_notif_unit_keluar.php",
											success: function(data){
												console.log(data);
											}
										});
									}, 2000);
									
								}
							}
						}
					}
				});
				
				var waktu = setTimeout("cek_aktivitas()",60000);
			}
			
			
			$(document).ready(function(){
			    cek_aktivitas();
				
			    $("#pesan_showroom").click(function(){
					$("#loading").show();
					if(x==1){
						$("#pesan_showroom").css("background-color","#efefef");
						x = 0;
					}else{
						$("#pesan_showroom").css("background-color","#4B59a9");
						x = 1;
					}
					$("#info").toggle();
				});
				
				$("#content").click(function(){
					$("#info").hide();
					$("#pesan_showroom").css("background-color","#4B59a9");
					x = 1;
				});
				
				
				$("#pesan").click(function(){
					$("#loading").show();
					if(x==1){
						$("#pesan").css("background-color","#efefef");
						x = 0;
					}else{
						$("#pesan").css("background-color","#4B59a9");
						x = 1;
					}
					$("#info").toggle();
				});
				
				$("#content").click(function(){
					$("#info").hide();
					$("#pesan").css("background-color","#4B59a9");
					x = 1;
				});
			});
		}
	}else{
		$("title").html("Honda Bintaro - Sistem Operasional Sales");
		$("#jmlh_showroom").html("0");
		$("#jmlh_showroom2").html("0");
		$("#jmlh").html("0");
		$("#jmlh2").html("0");
	}
		
</script>