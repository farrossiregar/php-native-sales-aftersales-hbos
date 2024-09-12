<?php
$server = "localhost";
$username = "hondabintaro";
$password = "hondabintaro0102";


$database = "hondabin_service";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>