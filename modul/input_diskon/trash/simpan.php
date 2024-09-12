<?php 
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
 
// validasi seadanya :v
if ($namalengkap == '') {
    $data['error']['namalengkap'] = 'Nama tidak boleh kosong';
}
if ($alamat == '') {
    $data['error']['alamat'] = 'Alamat tidak boleh kosong';
}
 
if (empty($data['error'])) {
    // jika validasi berhasil
    $data['hasil'] = 'sukses';
    
    // lakukan proses simpan data disini atau perintah lainnya
    // INSERT INTO bla bla bla...
} else {
    // jika validasi gagal
    $data['hasil'] = 'gagal';
}
 
// tampilkan response dalam format json
echo json_encode($data);
?>