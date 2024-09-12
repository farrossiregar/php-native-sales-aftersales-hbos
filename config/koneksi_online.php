<?php
$server = "localhost";
$username = "hondabin_abdul01";
$password = "S?AuHM@#9_qU";


$database = "hondabin_showroom";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>