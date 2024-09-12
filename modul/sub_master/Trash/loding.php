<html>
<head>
<title>Ajax Loading By yang buat :) </title>
<script type="text/javascript">
function panggilHalaman()
{
var ajaxku;
var alamat = "coba.html";
if(window.XMLHttpRequest)
{
ajaxku=new XMLHttpRequest();
}
else
{
ajaxku=new ActiveXObject("Microsoft.XMLHTTP");
}
ajaxku.onreadystatechange=function()
{
if (ajaxku.readyState==4 && ajaxku.status==200)
{
document.getElementById("biodata").innerHTML=ajaxku.responseText;
}
else
{
document.getElementById("biodata").innerHTML="Tunggu ya masih proses ne !!!";
}
}
ajaxku.open("GET",alamat,true);
ajaxku.setRequestHeader("Content-Type", "text/plain;charset=UTF-8");
ajaxku.send();
}
</script>
</head>
<body>
Selamat datang berikut adalah biodata saya :<br>
<div id="biodata"><div>
<a href="javascript:void(0)" onClick="panggilHalaman();">Tampilkan Biodata</a>
</body>
</html>