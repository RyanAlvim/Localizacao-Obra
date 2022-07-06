function AssinaturaDownload(){

    var canvas = document.getElementById("quadro");
    var image = canvas.toDataURL("image/png"); 
    
	document.getElementById("assinatura").value = image;

    
}