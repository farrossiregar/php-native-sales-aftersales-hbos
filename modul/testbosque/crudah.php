<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Posting Multiple form dengan PHP</title>
</head>
<body>
<form method="post" action="insert.php">
<?php
$jumlah=11;
for($i=0; $i<$jumlah; $i++){
$nomor = $i + 1;
echo $nomor .". ";
?>
Bulan <input type="text" name="bulan[]" /> Model <input type="text" name="model[]" /> Target <input type="text" name="target[]" /><br />
<?php
}
//cetak tombol jika inputan lebih dari 0
if($jumlah >0){
echo "<input type=\"submit\" name=\"btnSiswa\" value=\"Simpan\" />";
}
?>
</form>
</body>
</html>