<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>SignaturePad undo feature</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="signature_pad.umd.js"></script>
  <style type="text/css">
    .wrapper {
	  position: relative;
	  width: 1000px;
	  height: 318px;
	  -moz-user-select: none;
	  -webkit-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	}

	.signature-pad {
	  position: absolute;
	  left: 0;
	  top: 0;
	  width:1000px;
	  height:318px;
	  background-color: white;
	}
	  </style>
	  <!-- TODO: Missing CoffeeScript 2 -->

	  <script type="text/javascript">


		window.onload=function(){
		  
	var canvas = document.getElementById('signature-pad');
	ctx = canvas.getContext("2d");

	var background = new Image();
	// The image needs to be in your domain.
	background.src = "kanan.jpg";

	// Make sure the image is loaded first otherwise nothing will draw.
	background.onload = function() {
		ctx.drawImage(background, 0, 0, 1000, 318);
		
	};
	
	function gambar($aha){
		var background2 = new Image();
	// The image needs to be in your domain.
		background2.src = $aha;
		alert($aha);
		ctx.drawImage(background2, 0, 0, 1000, 318);
		cPush();
	}
	
	// Adjust canvas coordinate space taking into account pixel ratio,
	// to make it look crisp on mobile devices.
	// This also causes canvas to be cleared.
	function resizeCanvas() {
		// When zoomed out to less than 100%, for some very strange reason,
		// some browsers report devicePixelRatio as less than 1
		// and only part of the canvas is cleared then.
		var ratio =  Math.max(window.devicePixelRatio || 1, 1);
		canvas.width = canvas.offsetWidth * ratio;
		canvas.height = canvas.offsetHeight * ratio;
		canvas.getContext("2d").scale(ratio, ratio);
	}

	window.onresize = resizeCanvas;
	resizeCanvas();

	var signaturePad = new SignaturePad(canvas, {
	  backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
	  
	});
	
	document.getElementById('save-png').addEventListener('click', function () {
	  if (signaturePad.isEmpty()) {
		return alert("Please provide a signature first.");
	  }
	  
	  var data = signaturePad.toDataURL('image/png');
	  console.log(data);
	  window.open(data);
	});

	document.getElementById('save-jpeg').addEventListener('click', function () {
	  if (signaturePad.isEmpty()) {
		return alert("Please provide a signature first.");
	  }

	  var data = signaturePad.toDataURL('image/jpeg');
	  console.log(data);
	  window.open(data);
	});

	document.getElementById('save-svg').addEventListener('click', function () {
	  if (signaturePad.isEmpty()) {
		return alert("Please provide a signature first.");
	  }

	  var data = signaturePad.toDataURL('image/svg+xml');
	  console.log(data);
	  console.log(atob(data.split(',')[1]));
	  window.open(data);
	});

	document.getElementById('clear').addEventListener('click', function () {
		var data = signaturePad.toData();
	  signaturePad.clear();
		gambar(data);
	  
	});

	document.getElementById('undo').addEventListener('click', function () {
	
	//=====================
	var cPushArray = new Array();
	var cStep = -1;

	function cPush() {
		cStep++;
		if (cStep < cPushArray.length) { cPushArray.length = cStep; }
		cPushArray.push(document.getElementById('signature-pad').toDataURL());
		document.title = cStep + ":::" + cPushArray.length;
	}
	function cUndo() {
		if (cStep > 0) {
			cStep--;
			var canvasPic = new Image();
			canvasPic.src = cPushArray[cStep];
			canvasPic.onload = function () { ctx.drawImage(canvasPic, 0, 0); }
			document.title = cStep + ":" + cPushArray.length;
			
		}
	}	
	//======================
	var data2 = signaturePad.toDataURL('image/png');
	var data = signaturePad.toData();
	  if (data) {
		 
		data.pop(); // remove the last dot or line
		var data2 = signaturePad.toDataURL('image/png');
		signaturePad.fromData(data);
		
		
		//gambar(data2);
		cUndo();
	  }
	});


		}

	</script>

	
</head>
<body>

<div class="wrapper">
  <canvas id="signature-pad" class="signature-pad" width=1000 height=318></canvas>
</div>

<button id="save-png">Save as PNG</button>
<button id="save-jpeg">Save as JPEG</button>
<button id="save-svg">Save as SVG</button>
<button id="undo">Undo</button>
<button id="clear">Clear</button>


</body>
</html>
</html>