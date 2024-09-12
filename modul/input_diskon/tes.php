<!DOCTYPE html>
<html>
    <head>
        <title>Ajax Jquery - Belajarphp.net</title>
    </head>
    <body>
        <form action="">
            
            <div class="form-group">
													<label class="control-label">
														Harga OTR <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="harga_otr" name="harga_otr" onkeypress="return hanyaAngka(event)" onKeyup="titikpemisah();"/>
													</div>
												</div>
												
												
            <div class="form-group" id="id_leasing">
													<label for="form-field-select-2">
														Nama leasing <span class="symbol required"></span>
													</label>
													<select name='leasing' id='leasing' class='form-control'>
													<option selected value=''>PILIH LEASING</option>
													<option value='group1' >MBF</option>
													<option value='group1' >MTF</option>
													<option value='group1' >OTO MULTIARTA</option>
													<option value='group1' >MY BANK</option>
													
													<option value='' >KKB BCA</option>
													<option value='group2' >BCA</option>
													<option value='group2' >MAF</option>
												    </select>
												</div>
												<div class="form-group" id="id_tenor">
													<label for="form-field-select-2">
														Tenor <span class="symbol required"></span>
													</label>
													<select name='tenor' id='tenor' class='form-control'>
													<option disabled selected value=''>PILIH TENOR</option>
													<option value='1tahun' >1 TAHUN</option>
													<option value='2tahun' >2 TAHUN</option>
													<option value='3tahun' >3 TAHUN</option>
													<option value='4tahun' >4 TAHUN</option>
													<option value='5tahun' >5 TAHUN</option>
													<option value='6tahun' >6 TAHUN</option>
												    </select>
												</div>
												
												
													<div class="form-group">
													<label class="control-label">
														Refund <span class="symbol required"></span>
													</label>
													<div class="input-group">
														<span class="input-group-addon">Rp</span>
															<input type="text" class="form-control" id="refund" name="refund" onkeypress="return hanyaAngka(event)" onFocus="startCalc();" onBlur="stopCalc();" onKeyup="titikpemisah();"/>
													</div>
												</div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
       
       
        <script type="text/javascript">
		    
           	$('#tenor').on('change',function isi_otomatis(){
                var harga_otr = $("#harga_otr").val();
                var leasing = $("#leasing").val();
                var tenor = $("#tenor").val();
                $.ajax({
                    url: 'hitung_refund.php',
                    data: 'harga_otr='+harga_otr+'&leasing='+leasing+'&tenor='+tenor,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    //var refund = harga_otr * val(obj.rasio) * 0.15;
                    $('#refund').val(Math.round(obj.rasio*harga_otr*0.15));
                    //$('#refund').val(obj.rasio);
                    //$('#alamat').val(obj.alamat);
                   // $('#kelurahan').val(obj.kelurahan);
                });
            })
        </script>
    </body>
</html>