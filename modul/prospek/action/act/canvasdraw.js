// by Chtiwi Malek ===> CODICODE.COM

var mousePressed = false;
var lastX, lastY;
var ctx;

function InitThis() {
    ctx = document.getElementById('myCanvas').getContext("2d");
	
    $('#myCanvas').mousedown(function (e) {
		console.log("a");
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#myCanvas').mousemove(function (e) {
        if (mousePressed) {
			console.log("b");
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#myCanvas').mouseup(function (e) {
        if (mousePressed) {
            mousePressed = false;
            cPush();
        }
    });

    $('#myCanvas').mouseleave(function (e) {
        if (mousePressed) {
            mousePressed = false;
            cPush();
        }
    });
	
	var canvas = document.getElementById("myCanvas");
	
	
		
	canvas.addEventListener("touchstart", function (e) {
		if (e.touches.length == 1) {
		var touch = e.touches[0];
		}
		var mouseEvent = new MouseEvent("mousedown", {
			clientX: touch.pageX-touch.target.offsetLeft+23,
			clientY: touch.pageY-touch.target.offsetTop+25
		});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchend", function (e) {
		var mouseEvent = new MouseEvent("mouseup", {});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchmove", function (e) {
		if (e.touches.length == 1) {
		var touch = e.touches[0];
		}
		var mouseEvent = new MouseEvent("mousemove", {
			clientX: touch.pageX-touch.target.offsetLeft+23,
			clientY: touch.pageY-touch.target.offsetTop+25
		});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	
	
	
	// Prevent scrolling when touching the canvas
	canvas.addEventListener("touchstart", function (e) {
		
		
		if (e.target == canvas) {			
			e.preventDefault();
		}
	}, false);
	canvas.addEventListener("touchend", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
	canvas.addEventListener("touchmove", function (e) {
		
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);

	
 //   drawImage();
	
	
	
	
	
}

function InitTtd() {
    ctxTtd = document.getElementById('myCanvas2').getContext("2d");
	
    $('#myCanvas2').mousedown(function (e) {
		console.log("a");
        mousePressed = true;
        DrawTtd(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#myCanvas2').mousemove(function (e) {
        if (mousePressed) {
			console.log("b");
            DrawTtd(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#myCanvas2').mouseup(function (e) {
        if (mousePressed) {
            mousePressed = false;
            cPush();
        }
    });

    $('#myCanvas2').mouseleave(function (e) {
        if (mousePressed) {
            mousePressed = false;
            cPush();
        }
    });
	
	var canvas = document.getElementById("myCanvas2");
	
	

   

	
	
	
		
	canvas.addEventListener("touchstart", function (e) {
		if (e.touches.length == 1) {
		var touch = e.touches[0];
		}
		var mouseEvent = new MouseEvent("mousedown", {
			clientX: touch.pageX-touch.target.offsetLeft+23,
			clientY: touch.pageY-touch.target.offsetTop+25
		});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchend", function (e) {
		var mouseEvent = new MouseEvent("mouseup", {});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	canvas.addEventListener("touchmove", function (e) {
		if (e.touches.length == 1) {
		var touch = e.touches[0];
		}
		var mouseEvent = new MouseEvent("mousemove", {
			clientX: touch.pageX-touch.target.offsetLeft+23,
			clientY: touch.pageY-touch.target.offsetTop+25
		});
		canvas.dispatchEvent(mouseEvent);
	}, false);
	
	
	
	// Prevent scrolling when touching the canvas
	canvas.addEventListener("touchstart", function (e) {
		
		
		if (e.target == canvas) {			
			e.preventDefault();
		}
	}, false);
	canvas.addEventListener("touchend", function (e) {
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);
	canvas.addEventListener("touchmove", function (e) {
		
		if (e.target == canvas) {
			e.preventDefault();
		}
	}, false);

	
    drawImageTtd();
	
	
	
	
	
}

function drawImageTtd() {
    var image = new Image();
	image.src = 'modul/service_general_repair/action/act/ttd.jpg';
    $(image).load(function () {
        ctxTtd.drawImage(image, 0, 0, 300, 150);
        cPush();
    });   
}

function drawImageSedan() {
    var image = new Image();
	image.src = 'modul/prospek/action/kondisi_kendaraan/type-sedan.jpg';
    $(image).load(function () {
        ctx.drawImage(image, 0, 0, 1006, 318);
        cPush();
    });   
}

function drawImageSUV() {
    var image = new Image();
	image.src = 'modul/prospek/action/kondisi_kendaraan/type-suv.jpg';
    $(image).load(function () {
        ctx.drawImage(image, 0, 0, 1006, 318);
        cPush();
    });   
}



function Draw(x, y, isDown) {
    if (isDown) {
        ctx.beginPath();
        ctx.strokeStyle = $('#selColor').val();
        ctx.lineWidth = $('#selWidth').val();
        ctx.lineJoin = "round";
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.closePath();
        ctx.stroke();
    }
    lastX = x;
    lastY = y;
}

function DrawTtd(x, y, isDown) {
    if (isDown) {
        ctxTtd.beginPath();
        ctxTtd.strokeStyle = 'black';
        ctxTtd.lineWidth = 2;
        ctxTtd.lineJoin = "round";
        ctxTtd.moveTo(lastX, lastY);
        ctxTtd.lineTo(x, y);
        ctxTtd.closePath();
        ctxTtd.stroke();
    }
    lastX = x;
    lastY = y;
}

var cPushArray = new Array();
var cStep = -1;

function cPush() {
    cStep++;
    if (cStep < cPushArray.length) { cPushArray.length = cStep; }
    cPushArray.push(document.getElementById('myCanvas').toDataURL());
    //document.title = cStep + ":" + cPushArray.length;
}
function cUndo() {
    if (cStep > 0) {
        cStep--;
        var canvasPic = new Image();
        canvasPic.src = cPushArray[cStep];
        canvasPic.onload = function () { ctx.drawImage(canvasPic, 0, 0); }
        //document.title = cStep + ":" + cPushArray.length;
    }
}
function cRedo() {
    if (cStep < cPushArray.length-1) {
        cStep++;
        var canvasPic = new Image();
        canvasPic.src = cPushArray[cStep];
        canvasPic.onload = function () { ctx.drawImage(canvasPic, 0, 0); }
        //document.title = cStep + ":" + cPushArray.length;
    }
}