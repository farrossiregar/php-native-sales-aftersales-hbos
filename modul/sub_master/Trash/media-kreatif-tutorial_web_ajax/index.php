<html>	<head>		<title>Membuat website berbasis JQUERY AJAX</title>		<link rel="stylesheet" href="style.css" type="text/css"/>		<script type="text/javascript" src="jquery-1.6.1.min.js">//memanggil jquery</script>		<script type="text/javascript" src="ajax.js">//memanggil script ajax</script>	</head>	<body onload="tampilkan('home');">		<div id="wrapper">			<div id="header">			Bagian header			</div>						<div id="content">				<div id="left">				<ul>					<li><a name="#1" onclick="tampilkan('home');">Home</a></li>					<li><a name="#2" onclick="tampilkan('php');">Tutorial PHP</a></li>					<li><a name="#3" onclick="tampilkan('html');">Bahasa HTML</a></li>					<li><a name="#4" onclick="tampilkan('ajax');">AJAX</a></li>					<li><a name="#5" onclick="tampilkan('javascript');">Pemrograman Javascript</a></li>					<li><a name="#7" onclick="tampilkan('xml');">XML</a></li>					<li><a name="#8" onclick="tampilkan('media-kreatif');">Media Kreatif</a></li>				</ul>				</div>								<div id="right">					<div id="loader" style="display:none;">Loading ...</div>				</div>								<div id="clear" style="clear:both;">&nbsp;</div>			</div>						<div id="footer">				Bagian footer			</div>		</div>	</body></html>