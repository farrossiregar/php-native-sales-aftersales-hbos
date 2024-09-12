// by Chtiwi Malek on CODICODE.COM

function DrawPic() {
    // Get the canvas element and its 2d context
    var Cnv = document.getElementById('myCanvas');
    var Cntx = Cnv.getContext('2d');
    
    // Create gradient
    var Grd = Cntx.createRadialGradient(100, 100, 20, 140, 100, 230);
    Grd.addColorStop(0, "red");
    Grd.addColorStop(1, "black");

    // Fill with gradient
    Cntx.fillStyle = Grd;
    Cntx.fillRect(0, 0, 300, 200);

    // Write some text
    for (i=1; i<10 ; i++)
    {
        Cntx.fillStyle = "white";
        Cntx.font = "36px Verdana";
        Cntx.globalAlpha = (i-1) / 9;
        Cntx.fillText("Codicode.com", i * 3 , i * 20);
    }
}

function UploadPic() {
    
    // generate the image data
    var Pic = document.getElementById("myCanvas").toDataURL("image/png");
    Pic = Pic.replace(/^data:image\/(png|jpg);base64,/, "")

    // Sending the image data to Server
    $.ajax({
        type: 'POST',
        url: 'Save_Picture.aspx/UploadPic',
        data: '{ "imageData" : "' + Pic + '" }',
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function (msg) {
            alert("Done, Picture Uploaded."); 
        }
    });
}
