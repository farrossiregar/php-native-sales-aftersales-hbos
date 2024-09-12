<?php
	session_start();
?>

<script>
	
	
		var leveluser = "<?php echo $_SESSION['leveluser']?>";
		var username = "<?php echo $_SESSION['username']?>";
		var kode_spv = "<?php echo $_SESSION['kode_spv']?>";
		if(leveluser == 'admin' || leveluser == 'HRD' || leveluser == 'CCO' || leveluser == 'MNGR' || leveluser == 'mngr_bengkel' ||leveluser == 'user' || leveluser == 'DRKSI' || leveluser == 'supervisor' || leveluser == 'salesadm' || leveluser == 'staff_supervisor' || leveluser == 'mngr_finance'){
			function cek_aktivitas(){
				var title_sos = "Honda Bintaro - Sistem Operasional Sales";
				
			
				if(leveluser == 'admin'){
					function test(url, data, success, leveluser_notif, message_title){
						var urlTest = url;
						var dataTest = data;
						var successTest = success;
						var leveluserTest = leveluser_notif;
						var message_titleTest = message_title;
						$.ajax({
							method: "post",
							url: url,
							data: data,
							cache: false,
							success: function(notif_pengecekan){
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
										}else if(msg_title = "PENGECEKAN PENAMPILAN SA"){
											if(leveluser == 'admin' || leveluser == 'supervisor'){
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
											}else{
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
											}
										}else if(msg_title = "PERMOHONAN UNIT KELUAR"){
											if(leveluser == 'admin' || leveluser == 'supervisor'){
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
												var isi = "No SPK : " + notif_pengajuan_item_split[0] + '\n \n' + 'Waktu Keluar "';
												$('#keterangan').val(parse['catatan_pengecekan'] + '\n \n' + user + ' [' + jam + '] ' + ' : ');
											}else{
												var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
											}
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
										
										setTimeout(function deletenotif(){
											$.ajax({
												method: "post",
												data : 'leveluser='+leveluser,
												url: "notif_pengecekan/stop_notif_pengecekan.php",
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
					
				/*	var jumlah_hasil_pengecekan = {
						url:"notif_pengecekan/jumlah_hasil_pengecekan.php",
						data:'leveluser='+leveluser,
						success:"total_hasil_pengecekan",
					}
					
					var cekpesan_pengecekan = {
						url:"notif_pengecekan/cekpesan_pengecekan.php",
						data:'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
					}
					
					var cekpesan = {
						url:"cekpesan.php",
						data:"",
						success:"total_pesan_pengajuan",
					}	*/
				/*	var hasil_pengecekan = new test(jumlah_hasil_pengecekan.url, jumlah_hasil_pengecekan.data, jumlah_hasil_pengecekan.success);
					var jumlah_pengecekan = new test(cekpesan_pengecekan.url, cekpesan_pengecekan.data, cekpesan_pengecekan.success);
					var jumlah_pengajuan = new test(cekpesan.url, cekpesan.data, cekpesan.success);	*/
					
				//	console.log(test());
				
					var ceknotif_pengecekan = {
						url:"notif_pengecekan/ceknotif_pengecekan.php",
						data:'leveluser='+leveluser,
						success:"total_pesan_pengecekan",
						leveluser: leveluser == 'admin' || leveluser == 'HRD' || leveluser == 'CCO',
						message_title: "PENGECEKAN SHOWROOM",
					}
					
					var notif_pengecekan = new test(ceknotif_pengecekan.url, ceknotif_pengecekan.data, ceknotif_pengecekan.success, ceknotif_pengecekan.leveluser, ceknotif_pengecekan.message_title);
					
				/*	var notif_unit_keluar = {
						url:"ceknotif_permohonan_unit_keluar.php",
						data:"",
						success:"total_pesan_pengecekan",
						leveluser: "",
						message_title: "PERMOHONAN UNIT KELUAR",
						delete_notif: "notif_pengecekan/stop_notif_pengecekan.php",
					}
					
					var notif_unit_keluar = new test(notif_unit_keluar.url, notif_unit_keluar.data, notif_unit_keluar.success, notif_unit_keluar.leveluser, notif_unit_keluar.message_title);	*/
					
				}
				
			
			
				//==================JUMLAH PESAN DI BADGE==================
			    $.ajax({
					method: "post",
					url: "notif_pengecekan/cekpesan_pengecekan.php",
					data: 'leveluser='+leveluser,
			        cache: false,
			        success: function(total_pesan_pengecekan){
						if(leveluser == 'MNGR' || leveluser == 'DRKSI' || leveluser == 'user' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'mngr_finance' || leveluser == 'mngr_bengkel'){
							var jumlah_pesan_pengecekan = 0;
						}else{
							var jumlah_pesan_pengecekan = total_pesan_pengecekan;
						}
						$.ajax({
							url: "cekpesan.php",
							cache: false,
							success: function(total_pesan_pengajuan){
								var jumlah_pesan_pengajuan = total_pesan_pengajuan;
								$.ajax({
									method: "post",
									url: "notif_pengecekan/jumlah_hasil_pengecekan.php",
									data: 'leveluser='+leveluser,
									cache: false,
									success: function(total_hasil_pengecekan){
										if(leveluser == 'CCO' || leveluser == 'HRD' || leveluser == 'user' || leveluser == 'supervisor' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'mngr_finance'){
											var jumlah_pengecekan_hasil = 0;
										}else{
											var jumlah_pengecekan_hasil = total_hasil_pengecekan;
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
					
					
					
				//================== MENAMPILKAN NOTIFIKASI PESAN PENGECEKAN SHOWROOM ==================
				/*	$.ajax({
					method: "post",
					url: "notif_pengecekan/ceknotif_pengecekan.php",
					data: 'leveluser='+leveluser,
					cache: false,
					success: function(notif_pengecekan){
						if(notif_pengecekan != '' && (leveluser == 'admin' || leveluser == 'HRD' || leveluser == 'CCO')){
							$("#myAudio").attr("autoplay", "true");
							var notif_string = notif_pengecekan.toString();
							var notif_trim = notif_string.trim();
							var notif_split = notif_trim.split("|");
							var i;
							var notif_string2 = notif_split.toString();
							var notif_trim2 = notif_string2.trim();
							var notif_split2 = notif_trim2.split(",");
							var msg_title = "PENGECEKAN SHOWROOM";
							var granted = 0;
							
							for (i=0; i <= (notif_split.length-i-i) ;i++){
								var redirect_onclick = notif_split2[5];
								if(leveluser == 'admin' || leveluser == 'HRD'){
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
								}else{
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
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
								
								setTimeout(function deletenotif_pengecekan_showroom(){
												$.ajax({
													method: "post",
													data : 'data1='+leveluser,
													url: "notif_pengecekan/stop_notif_pengecekan.php",
													success: function(data){
														console.log(data);
													}
												});
											}, 2000);
							}
						}else{
							if (!("Notification" in window)) {
								
							}
						}
					}
				});	*/
				
				//================== MENAMPILKAN NOTIFIKASI PESAN PENGECEKAN SERVICE ==================
			/*	$.ajax({
					method: "post",
					url: "notif_pengecekan/ceknotif_pengecekan_service.php",
					data: 'leveluser='+leveluser,
					cache: false,
					success: function(notif_pengecekan){
						if(notif_pengecekan != '' && (leveluser == 'admin' || leveluser == 'CCO' || leveluser == 'HRD' )){
							$("#myAudio").attr("autoplay", "true");
							var notif_string = notif_pengecekan.toString();
							var notif_trim = notif_string.trim();
							var notif_split = notif_trim.split("|");
							var i;
								var notif_string2 = notif_split.toString();
								var notif_trim2 = notif_string2.trim();
								var notif_split2 = notif_trim2.split(",");
								var msg_title = "PENGECEKAN SERVICE";
								var granted = 0;
							
							for (i=0; i <= (notif_split.length-i-i) ;i++){
								var redirect_onclick = notif_split2[5];
								
								if(leveluser == 'admin' || leveluser == 'HRD'){
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
								}else{
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
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
								
								setTimeout(function deletenotif_pengecekan_service(){
												var leveluser = "<?php echo $_SESSION['leveluser'] ?>";
												$.ajax({
													method: "post",
													data : 'data_user='+leveluser,
													url: "notif_pengecekan/stop_notif_pengecekan_service.php",
													success: function(data){
														console.log(data);
													}
												});
											}, 2000);
							}
						}
					}
				});	*/
				
				//================== MENAMPILKAN NOTIFIKASI PESAN PENGECEKAN PENAMPILAN SALES ==================
			/*	$.ajax({
					method: "post",
					url: "notif_pengecekan/ceknotif_penampilan_sales.php",
					data: 'leveluser='+leveluser,
					cache: false,
					success: function(notif_pengecekan){
						if(notif_pengecekan != '' && (leveluser == 'admin' || leveluser == 'CCO' || leveluser == 'supervisor' )){
							$("#myAudio").attr("autoplay", "true");
							var notif_string = notif_pengecekan.toString();
							var notif_trim = notif_string.trim();
							var notif_split = notif_trim.split("|");
							var i;
								var notif_string2 = notif_split.toString();
								var notif_trim2 = notif_string2.trim();
								var notif_split2 = notif_trim2.split(",");
								var msg_title = "PENGECEKAN PENAMPILAN SALES";
								var granted = 0;
							
							for (i=0; i <= (notif_split.length-i-i) ;i++){
								var redirect_onclick = notif_split2[5];
								
								if(leveluser == 'admin' || leveluser == 'supervisor'){
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
								}else{
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
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
								
								setTimeout(function deletenotif_pengecekan_service(){
												var leveluser = "<?php echo $_SESSION['leveluser'] ?>";
												$.ajax({
													method: "post",
													data : 'data_user='+leveluser,
													url: "notif_pengecekan/stop_notif_penampilan_sales.php",
													success: function(data){
														console.log(data);
													}
												});
											}, 2000);
							}
						}
					}
				});	*/
				
				//================== MENAMPILKAN NOTIFIKASI PESAN PENGECEKAN PENAMPILAN SA ==================
			/*	$.ajax({
					method: "post",
					url: "notif_pengecekan/ceknotif_penampilan_sa.php",
					data: 'leveluser='+leveluser,
					cache: false,
					success: function(notif_pengecekan){
					//	if(notif_pengecekan != '' && (leveluser == 'admin' || leveluser == 'staff_salesadm' || leveluser == 'salesadm' || leveluser == 'supervisor' || leveluser == 'MNGR_FINANCE' || leveluser == 'MNGR' )){
						if(notif_pengecekan != '' && (leveluser == 'admin' || leveluser == 'mngr_bengkel' )){
							$("#myAudio").attr("autoplay", "true");
							var notif_string = notif_pengecekan.toString();
							var notif_trim = notif_string.trim();
							var notif_split = notif_trim.split("|");
							var i;
								var notif_string2 = notif_split.toString();
								var notif_trim2 = notif_string2.trim();
								var notif_split2 = notif_trim2.split(",");
								var msg_title = "PENGECEKAN PENAMPILAN SA";
								var granted = 0;
								
							for (i=0; i <= (notif_split.length-i-i) ;i++){
								var redirect_onclick = notif_split2[5];
								
								if(leveluser == 'admin' || leveluser == 'supervisor'){
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[4];
								}else{
									var isi =  notif_split2[3] + "\n" + notif_split2[1] + " " + notif_split2[2] + "\n" + notif_split2[6];
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
								
								setTimeout(function deletenotif_pengecekan_service(){
									$.ajax({
										method: "post",
										data : 'data_user='+leveluser,
										url: "notif_pengecekan/stop_notif_penampilan_sa.php",
										success: function(data){
											console.log(data);
										}
									});
								}, 2000);
							}
						}
					}
				});	*/
			  
			  //================== MENAMPILKAN NOTIFIKASI PESAN PENGAJUAN DISKON ==================
				$.ajax({
					method: "post",
					url: "ceknotif.php",
					cache: false,
					success: function(notif_pengajuan_record){
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
								console.log(isi);
								
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
										data : 'data1='+nopengajuan+'&data2='+username,
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
				});	
				
				//================== MENAMPILKAN NOTIFIKASI PESAN PEMASANGAN AKSESORIS ==================
				
				
				$.ajax({
					method: "post",
					url: "ceknotif_pemasangan_aksesoris.php",
					data: 'leveluser='+leveluser,
					cache: false,
					success: function(notif_pemasangan_accs){
						if(notif_pemasangan_accs != '' && (leveluser == 'admin' || leveluser == 'salesadm' || leveluser == 'staff_salesadm' || leveluser == 'supervisor' || leveluser == 'MNGR' || leveluser == 'mngr_finance')){
							$("#myAudio").attr("autoplay", "true");
						//	console.log(notif_pemasangan_accs);
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
								var isi = "Pemasangan Aksesoris dengan No Permohonan " + notif_pengajuan_item_split[0];
								
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
				});		
				
			//	if(username == 'farsros'){
				$.ajax({
					method: "post",
					url: "ceknotif_permohonan_unit_keluar.php",
					data: 'leveluser='+leveluser+'&kode_spv='+kode_spv,
					cache: false,
					success: function(notif_permohonan_unit_keluar){
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
				});
			//	}
				
				var waktu = setTimeout("cek_aktivitas()",60000);
			}
			
			
			$(document).ready(function(){  //event pada saat document telah selesai loadingnya
			    cek_aktivitas();
				
			    $("#pesan_showroom").click(function(){ //pada saat diklik link message akan muncul daftar pesannya
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
				
				
				$("#pesan").click(function(){ //pada saat diklik link message akan muncul daftar pesannya
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
			
		}else{
			$("title").html("Honda Bintaro - Sistem Operasional Sales");
			$("#jmlh_showroom").html("0");
			$("#jmlh_showroom2").html("0");
		}
		
</script>