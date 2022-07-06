var input_antigo = document.querySelector("#queryObra");
var valor_antigo = input_antigo.value;

window.setInterval(function() {
	var input = document.querySelector("#queryObra");
	var texto = input.value;
	if(texto != ""){
		
		if(valor_antigo != texto){
		$.get( `http://localhost:8080/Teste/execute.php?queryObra=${texto}`, function( data ) {
			let informacoes = JSON.parse(data)
			if(informacoes.status == "1"){
				console.log(informacoes["responseBody"]["rows"].length)
				var sizeJson = informacoes["responseBody"]["rows"].length;
				for(let i = 0; i < sizeJson; i++){
					console.log(i + ": " + informacoes["responseBody"]["rows"][i])
					document.getElementById("codigo").innerHTML += informacoes["responseBody"]["rows"][i][0] + " " +"<br>";
					document.getElementById("nome").innerHTML += informacoes["responseBody"]["rows"][i][1] + "<br>";		
				}
			}else{
				document.getElementById("erro").innerHTML = "ERRO";
				document.getElementById("erro").style.display = "block";
			}

		});
		
		valor_antigo = texto;
		console.log("paasei")
		document.getElementById("codigo").innerHTML = "";
		document.getElementById("nome").innerHTML = "";	
		
	}else{
		
		console.log("NADA");
	}
		
	}
	
}, 2000);

$("td").click(function(){
	 var theLink = $(this).text();
     alert(theLink);
 });




