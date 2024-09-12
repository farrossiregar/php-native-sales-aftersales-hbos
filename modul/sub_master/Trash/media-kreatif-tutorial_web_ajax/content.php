<?php
if($_POST['content']=='home'){
?>
<p>
<img alt="Welcome" src="http://media-kreatif.com/themes/mki/images/logo.jpg" style="margin:0 5px 5px 0" align="left" />Kami merupakan perkumpulan beberapa mahasiswa ITN Malang yang memiliki persamaan tujuan untuk dapat saling berbagi ilmu terutama dalam bidang IT. Berangkat dari persamaan tujuan tersebut, maka kami dirikan Media Kreatif ini sebagai sarana penujang dan sebagai media penyaluran minat dan bakat.</p>
<p>
<strong>Visi dan Misi</strong></p>
<p>Media kreatif didirikan untuk dapat mengahasilkan produk - produk edukasi dengan harapan dapat ikut berpartisipasi dalam rangka mencerdaskan bangsa.</p><p>
<strong>Produk</strong></p>
<p>Produk yang kami rancang kedepannya antara lain :</p>
<ol>
	<li>Web Design dan Programming berbasis PHP</li>
	<li>Tutorial dan Buku elektronik ( Ebook ) untuk dapat di baca olhe segenap lapisan Masyarakat</li>
	<li>Aplikasi - aplikasi komputer berbasis website</li>
	<li>Aplikasi - aplikasi edukasi untuk anak Usia dini dan TK</li>
	<li>Ujian online untuk kalangan SMP , SMU dan Perguruan tinggi</li>
	<li>Dan lain - lain</li>
</ol>
<p>Salam kreatif</p>
<?php
}
else if($_POST['content']=='php'){
?>
<p>
	<img src="http://media-kreatif.com/images/image/2013-02-15-15-33-27_n.jpg" align="left"/>PHP (PHP Hypertext Preprocessor) merupakan bahasa pemrograman berbasis website opensource. PHP sangat populer di kalangan programer website di karenakan beberapa hal berikut :</p>
<p>
	- PHP merupakan bahasa pemrograman opensource<br />
	- Kemudahan dalam syntax / perintah - perintah yang digunakan<br />
	- Dukungan tutorial yang cukup banyak baik dalam bentuk buku fisik, ebook dan tutorial di internet<br />
	- Dapat di jalankan di beberapa platform OS ( Linux, Windows )<br />
	- Dan lain - lain</p>

<?php
}
else if($_POST['content']=='html'){
?>
<h3 class="title">
	Belajar bahasa HTML</h3>
<p>
	<img src="http://media-kreatif.com/images/image/2013-02-16-00-21-55_h.jpg" align="left"/>HTML (Hypert Text Markup Language) merupakan bahasa pemrograman yang digunakan dalam pembuatan halaman web. Dalam penggunaannya sebagian besar kode HTML tersebut harus terletak di antara tag kontainer. Yaitu diawali dengan dan diakhiri dengan (terdapat tanda &quot;/&quot;).</p>
<?php
}
else{
?>
Menampilkan konten lainnya, data yang ditampilkan pada script content ini bisa mengambil dari database seperti yang dilakukan pada umunya, yaitu dengan menambahkan script koneksi, kemudian membuat query untuk mengakses tabel tertentu
<?php
}
?> 