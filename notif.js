/*var x = 1;

function cek(){ //function untuk mengecek pesan 
    $.ajax({
        url: "cekpesan.php", //script php untuk mengecek pesan, didalamnya berupa query select
        cache: false,
        success: function(msg){ 
            $("#jmlh").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

$(document).ready(function(){  //event pada saat document telah selesai loadingnya
    cek();
    $("#pesan").click(function(){ //pada saat diklik link message akan muncul daftar pesannya
        $("#loading").show();
        if(x==1){
            $("#pesan").css("background-color","#efefef");
            x = 0;
        }else{
            $("#pesan").css("background-color","#4B59a9");
            x = 1;
        }
        $("#info").toggle();
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "lihatpesan.php",
            cache: false,
            success: function(msg){
                $("#loading").hide();
                $("#konten-info").html(msg);
            }
        });

    });
    $("#content").click(function(){
        $("#info").hide();
        $("#pesan").css("background-color","#4B59a9");
        x = 1;
    });
});	*/


