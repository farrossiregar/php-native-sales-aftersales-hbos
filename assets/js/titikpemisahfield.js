function kurensi(nilai) 
{
		bk = nilai.replace(/[^\d]/g,"");
		ck = "";
		panjangk = bk.length;
		j = 0;
		for (i = panjangk; i > 0; i--) 
		{
			j = j + 1;
			if (((j % 3) == 1) && (j != 1)) 
			{
				ck = bk.substr(i-1,1) + "." + ck;
				xk = bk;
			} 
			else 
			{
				ck = bk.substr(i-1,1) + ck;
				xk = bk;
			}
		}
		return ck;
}

function titikpemisah() 
{
    
    ttm = document.getElementById( 'form' ).elements['harga_otr'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['harga_otr'].value = kttm;
	
	ttm = document.getElementById( 'form' ).elements['discount_unit'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['discount_unit'].value = kttm;
    
	ttm = document.getElementById( 'form' ).elements['pengajuan_disc'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['pengajuan_disc'].value = kttm;
	
	ttm = document.getElementById( 'form' ).elements['total_discount_accs'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['total_discount_accs'].value = kttm;
	
	ttm = document.getElementById( 'form' ).elements['total_discount'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['total_discount'].value = kttm;
	
	ttm = document.getElementById( 'form' ).elements['refund'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['refund'].value = kttm;
	
	
	
	ttm = document.getElementById("id_hrg_accs").value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById("id_hrg_accs").value = kttm;

}

function titikpemisah2() 
{
    ttm = document.getElementById( 'form' ).elements['disc_approved'].value;
	strtt= ttm.toString();
	kttm = kurensi(strtt);
	
	document.getElementById( 'form' ).elements['disc_approved'].value = kttm;
}