


function fecharBuscaGuiada(){
	$("#consulta").removeClass("visivel");
	  $('.carousel').show();
	    $('.consulta_trigger').removeClass('verde');
}

function resultadoBuscaGuiadaOpcoes(){
	var resultadoBuscaGuiadaOpcoes = document.getElementById("resultadoBuscaGuiadaOpcoes");
	
	
	var texto = '';
	texto += '				  <div class="searchlbox">';
    texto += '                    Gest�o Or�ament�ria';
    texto += '                </div>';
    texto += '                <div class="searchlbox">';
    texto += '                    Op��o';
    texto += '                </div>';
	resultadoBuscaGuiadaOpcoes.innerHTML =  texto;	
}

function resultadoBuscaGuiada(arg0, origem, nivel){

document.getElementById("resultadoBuscaGuiadaOpcoes")
 	$('.resultadoBuscaGuiada').html("").load("../includes/buscaGuiada.php?arg0="+encodeURI(arg0)+"&origem="+encodeURI(origem)+"&nivel="+nivel+"");

}
	
	
	
