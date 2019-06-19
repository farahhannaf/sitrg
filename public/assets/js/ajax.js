function createAjax(){
	if(window.ActiveXObject){
		try{
			return new ActiveXObject("Microsoft.XMLHTTP");
			//ie lama
		}catch(e){
			return new ActiveXObject("Msxml2.XMLHTTP");
			//ie baru
		}
	}
	else if(window.XMLHttpRequest){
		return new XMLHttpRequest();
	}
}

var xmlhttp = createAjax();
function sendRequest(halaman, parameter, konten){ //fungsi nama 
	var obj = window.document.getElementById(konten); //variabel
	obj.innerHTML = "Loading...";
	if(xmlhttp.readyState==4 || xmlhttp.readyState==0){ //status pengiriman data 1 kirim, 2 di terima, 3 diproses, 4 di jalankan
		xmlhttp.open('POST', halaman, true); //membuka halaman yang dikirim
		xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
		xmlhttp.onreadystatechange=function(){ //ketika siap 
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				obj.innerHTML=parseScript(xmlhttp.responseText); 
			}
		}
		xmlhttp.send(parameter);
	}
}

function parseScript(_source)
{
		var source = _source;
		var scripts = new Array();
		
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
 
			scripts.push(source.substring(s_e+1, e));
			source = source.substring(0, s) + source.substring(e_e+1);
		}
 
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
			}
			catch(ex) {
				// do what you want here when a script fails
			}
		}
		// Return the cleaned source
		return source;
}