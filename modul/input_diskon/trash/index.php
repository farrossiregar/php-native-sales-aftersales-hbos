<html>
    <head>
        <title>AJAX Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
    </head>
    <body>
        <div style="width: 400px; margin: auto">
            <h1>AJAX Form</h1>
            <form id="formku">
                <div id="pesan"></div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <!-- untuk pesan error validasi -->
                    <span class="text-danger" id="error_namalengkap"></span>
                    <input id="namalengkap" class="form-control" type="text" name="namalengkap">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <!-- untuk pesan error validasi -->
                    <span class="text-danger" id="error_alamat"></span> 
                    <input id="alamat" class="form-control" type="text" name="alamat">
                </div>
                <div class="form-group">
                    <button id="tombolsimpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>    
            <small>&COPY; harviacode.com</small>
        </div>

        <?php
        $a=3;
        switch ($a)
        {
        case 0 :
            echo "Angka Nol";
            break;
        case 1 :
            echo "Angka Satu";
            break;
        case 2 :
            echo "Angka Dua";
            break;
        case 3 :
            echo "Angka Tiga";
            break;
        case 4 :
            echo "Angka Empat";
            break;
        case 5 :
            echo "Angka Lima";
            break;
        default :
            echo "Angka diluar jangkauan";
            break;
        }
        ?>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <!-- tambahkan javascript di bawah sini -->

        <script>
            $("#formku").submit(function(e) {
                // mencegah default submit form
                e.preventDefault();
                
                // kosongkan error form
                $("#error_namalengkap").html('');
                $("#error_alamat").html('');
                
                // ambil data form dengan serialize
                var dataform = $("#formku").serialize();
                $.ajax({
                    url: "simpan.php",
                    type: "post",
                    data: dataform,
                    success: function(result) {
                        var hasil = JSON.parse(result);
                        if (hasil.hasil !== "sukses") {
                            // tampilkan pesan error

                            switch (hasil.error.namalengkap)


                            if (hasil.error.namalengkap !== ''){
                                 $("#error_namalengkap").html(hasil.error.namalengkap);
                                 $("#namalengkap").focus();
                            }
                             if (hasil.error.alamat !== ''){
                                  $("#error_alamat").html(hasil.error.alamat);
                                  $("#alamat").focus();
                            }
                           
                           
                        } else {
                            // do something, misalnya menampilkan berhasil
                            $("#pesan").html("<div class=\"alert alert-success\">Data berhasil disimpan !</div>");
                            // kosongkan lagi error form
                            $("#namalengkap").val('');
                            $("#alamat").val('');
                        }
                    }
                });
            });
        </script>

    </body>
</html>