$(document).ready(function(){
    $('.demonstrativo .aba').on('click', function(){
            $('.demonstrativo .conteudo[data-aba-id]').removeClass('selecionado');
            $('.aba.selecionado').removeClass('selecionado');
            $('.demonstrativo .conteudo[data-aba-id="'+$(this).data('aba')+'"]').addClass('selecionado');
            $(this).addClass('selecionado');
    });

	
	
    $('.report ul li:not(:first-child)').on('click', function(){
		$('.arrow-down').removeClass('down').addClass('up');
        if($(this).hasClass('selected')){
            $(this).removeClass('selected');
            $(this).parent().parent().next(".botoes").hide();
            $(this).removeClass('down').addClass('up');
        }else{
            $(this).removeClass('up').addClass('down');
            $('.report ul li').removeClass('selected');
            $('.conteudo .row.botoes').hide();
            $(this).addClass('selected');
            $(this).parent().parent().next(".botoes").show();
        }
    });

    /* $('.demonstrativo .boxes .box').on('click', function(){
        $('.demonstrativo .boxes .box').removeClass('selecionado');
        $(this).addClass('selecionado');
    }); */

	$('#portalTransparenciaBuscaGuiada').on('click', function(){
		var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=corregedoria&origem=1&nivel=0&params=0&tituloNiveis="+encodeURI('Portal da Transpar\u00eancia')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});
		
	$('#consultaGestaoOrcamentaria').on('click', function(){
		var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=11&origem=corregedoria/11&nivel=1&params=0&tituloNiveis="+encodeURI('GEST\u00c3O OR\u00c7AMENT\u00c1RIA')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});

	$('#consultaLicitacaoContratacao').on('click', function(){
	var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=13&origem=corregedoria/13&nivel=1&params=0&tituloNiveis="+encodeURI('LICITA\u00c7\u00d5ES E CONTRATA\u00c7\u00d5ES')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});

	$('#convencioAcordos').on('click', function(){
	var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=15&origem=corregedoria/15&nivel=1&params=0&tituloNiveis="+encodeURI('CONV\u00caNIOS E ACORDOS')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});

	$('#gestaoPatrimonial').on('click', function(){
	var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=16&origem=corregedoria/16&nivel=1&params=0&tituloNiveis="+encodeURI('GEST\u00c3O PATRIMONIAL')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});

	$('#gestaoPessoas').on('click', function(){
	var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=18&origem=corregedoria/18&nivel=1&params=0&tituloNiveis="+encodeURI('GEST\u00c3O DE PESSOAS')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});

	$('#governaTI').on('click', function(){
	var WService = document.getElementById('webService').value;
		$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/tmpl/default.php?arg0=19&origem=corregedoria/19&nivel=1&params=0&tituloNiveis="+encodeURI('GOVERNAN\u00c7A EM TI')+"&sentido=avancar&WService="+encodeURI(WService)+"");
	});


    $('.consulta_trigger').on('click', function(){
        if($('#consulta2').hasClass('visivel')){
            $('#consulta2').removeClass('visivel');
            $(this).removeClass('verde');
            $('.carousel').show();
        }else{
            $("html, body").animate({ scrollTop: $('#consulta2').offset().top }, 500);
            $('#consulta2').addClass('visivel');
            $(this).addClass('verde');
            $('.carousel').hide();
		}
    });
	

    $('.chevron.volta').click(function(e){
        $('[data-aba-search]').removeClass('selected');
        var id = $(this).closest('[data-aba-search]').data('aba-search')-1;
        id = (id<1)?id=1:id;
        $('[data-aba-search="'+id+'"]').addClass('selected');
    });

    $('.consulta .aba .fecha').click(function(){
        $('.consulta').removeClass('visivel');
        $('.consulta_trigger').removeClass('verde');
        $('.carousel').show();
    });

    $('[data-aba-search] .box').click(function(){
        $('[data-aba-search]').removeClass('selected');
        var id = $(this).closest('[data-aba-search]').data('aba-search')+1;
        id = (id>7)?id=8:id;
        $('[data-aba-search="'+id+'"]').addClass('selected');
    });

    $('.linha_clicavel').click(function(){
        $(this).find('.linha').toggle();

    });
    
    $('.fixadorodape').click(function(){
        window.scrollTo(0,0);
    });

    $('.togglemobilemenu').click(function(){
        $('.headermenucontent').toggleClass('visivel');
        // $(document).mouseup(function(e){
        //     var container = $('.headermenucontent');
        //     if (!container.is(e.target) && container.has(e.target).length === 0) {  
        //         container.hide();  
        //     }
        // });
    });

    $('.box_me, .conteudo .download, .demonstrativo .conteudo .box, .menulocal .box').each(
        function(){ //funcao mouseenter
            $(this).hover(
                function(){
                    var img = $(this).find('img[src$=".svg"]');
                    var src = img.attr('src');
                    if(!src) return;
                    var dir = src.substring(0,src.lastIndexOf('/')+1)
                    var nome = src.substring(src.lastIndexOf('/')+1); 
                    img.attr('src', dir+"branco_"+nome);                
                },
                function(){ //funcao mouseleave
                    var img = $(this).find('img');
                    var src = img.attr('src');
					if(src.indexOf("branco_") > 0){
						if(!src) return;
						var dir = src.substring(0,src.lastIndexOf('/')+1)
						var nome = src.substring(src.lastIndexOf('/')+1);
						if(src){
							img.attr('src', dir+nome.substring(7));
						}
					}
                }
            );           
    });  
    // var atual = 0;
    // $('.ccontainer .volta, .ccontainer .avanca').click(function(){
    //     var c_left = parseInt($(".carousel .titulo").css('left'), 10);        
    //     var c_width = parseInt($(".carousel .titulo").css('width'), 10)+1;  
        
    //     $(".carousel .titulo").css('width', c_width); 
    //     /* EXIT */
    //     $(".carousel .fundo").delay(100).animate({ opacity: 0 }, 200);
    //     $(".carousel .titulo").delay(50).animate({ left: $(window).width()+150 }, 500, function() {
    //         $(".carousel .titulo").css('left', ($(window).width()+150)*-1);
    //     });
        
    //     $(".carousel .fundo").delay(300).animate({ opacity: 1 }, 200);
    //     $(".carousel .titulo").delay(450).animate({ left: c_left }, 300);
        
    //     $(".carousel .titulo").delay(450).css("left","");
          
    //     $('[data-slide-to].active').removeClass('active');
    //     if(atual == ($('[data-slide-to]').length-1) ){
    //         atual = 0;
    //     }else{
    //         atual++;
    //     }

    //     $('[data-slide-to] .fundo').each(function() {
    //         $(this).hide();
    //     });

    //     $('[data-slide-to="'+atual+'"]').show().addClass('active');
    //     // $('[data-slide-to="'+atual+'"] .fundo').show();

    // });

    $('.btnTradutor').on('click', function() {
            if($('#barraIdiomas').is(':visible')){
                $('#barraIdiomas').hide();
                $('#barraIdiomasInferior').hide();
                $('.h158').css('padding', '48px');
            }else{
                $('.h158').css('padding', '27px');
                $('#barraIdiomas').show();
                $('#barraIdiomasInferior').show();
            }
        });


    function avancarBanner() {

        var $itemActive   = $('.carousel .banner-item-active');
        var bannerAtual   = $itemActive.attr('data-slide-to');
        var proximoBanner = parseInt(bannerAtual) + 1;
        var totalBanners  = $('.carousel .banner-item').length;

        if (parseInt(bannerAtual) === (totalBanners - 1)) {
            proximoBanner = 0;
        }

        $itemActive.removeClass('banner-item-active');

        $('[data-slide-to="'+proximoBanner+'"]')
            .addClass('banner-item-active');
    }

    function voltarBanner() {

        var $itemActive   = $('.carousel .banner-item-active');
        var bannerAtual   = $itemActive.attr('data-slide-to');
        var proximoBanner = parseInt(bannerAtual) - 1;
        var totalBanners  = $('.carousel .banner-item').length;

        if (parseInt(bannerAtual) === 0) {
            proximoBanner = (totalBanners - 1);
        }

        $itemActive.removeClass('banner-item-active');

        $('[data-slide-to="'+proximoBanner+'"]')
            .addClass('banner-item-active');
    }

    function avancarMiniBanner() {
        var $itemActive = $('.mini-banner .mini-banneritem-active');
        var bannerAtual   = $itemActive.attr('data-mini-slide-to');
        var proximoBanner = parseInt(bannerAtual) + 1;
        var totalBanners  = $('.mini-banner .banneritem').length;

        if (parseInt(bannerAtual) === (totalBanners - 1)) {
            proximoBanner = 0;
        }

        $itemActive.removeClass('mini-banneritem-active');

        $('[data-mini-slide-to="'+proximoBanner+'"]')
            .addClass('mini-banneritem-active');
    }

    function voltarMiniBanner() {
        var $itemActive = $('.mini-banner .mini-banneritem-active');
        var bannerAtual   = $itemActive.attr('data-mini-slide-to');
        var proximoBanner = parseInt(bannerAtual) - 1;
        var totalBanners  = $('.mini-banner .banneritem').length;

        if (parseInt(bannerAtual) === 0) {
            proximoBanner = (totalBanners - 1);
        }

        $itemActive.removeClass('mini-banneritem-active');

        $('[data-mini-slide-to="'+proximoBanner+'"]')
            .addClass('mini-banneritem-active');
    }

    setInterval(function() {
        avancarBanner();
    }, 5000);


    $('.box_mini_banner .ccontainer .avanca').click(function(e) {
        e.preventDefault();
        avancarMiniBanner();
    });

    $('.box_mini_banner .ccontainer .volta').click(function(e) {
        e.preventDefault();
        voltarMiniBanner();
    });



    $('.ccontainer .avanca').click(function() {
        avancarBanner();
    });

    $('.ccontainer .volta').click(function() {
        voltarBanner();
    });

    // fim functions banner

    // $('.bt_portal_processos').on('click', function(){
    //     menu_expand(1);
	// 	return false; 
    // });

    $('.bt_portal_transparencia').on('click', function(){
        menu_expand(2);
		return false; 
    });
    
    // $('.bt_portal_imprensa').on('click', function(){
    //     menu_expand(3);
	// 	return false; 
    // });

    $('.fecha_mapa').click(function(){
        $('.mapadosite_conteudo').hide();
    });
    $('.mapadosite').click(function(){
        $('.mapadosite_conteudo').show();
        var y = $(window).scrollTop(); 
        $(window).scrollTop(y+300); 
    });   
    

    $(window).scroll(function(){
        if($('[data-menu]').is(':visible')){
            $('[data-menu]').hide();
        }
    });

    function aplicaWidthUL(maior_width_ul){        
        $('.report ul > li.titulo').each(function(){
            $(this).parent('ul').css('width', '100%');
            $(this).css('display', 'inline-block');
            $(this).innerWidth(maior_width_ul+20);
        });
    }

    var elems = $('.report ul > li.titulo').nextAll(), total_uls = elems.length;
    count_uls = 0;
    var maior_width_ul = 0;
    $('.report ul > li.titulo').each(function(){        
        if($(this).width() > maior_width_ul){
            maior_width_ul = $(this).width();
        }
        count_uls++;
        
        if (count_uls == total_uls) {
            aplicaWidthUL(maior_width_ul);
        }
    });
});

function goBack() {
    window.history.back();
}



function menu_expand(id){
   // $('[data-menu="'+id+'"]').toggle(); // função do menu sub item foi desabilitada a pedido do cliente
    $(document).mouseup(function(e){
        var container = $('[data-menu="'+id+'"]');
    });
}

function CriaRequest() {
	try{
		request = new XMLHttpRequest();        
	}catch (IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");       
		}catch(IEAntigo){
			try{
				request = new ActiveXObject("Microsoft.XMLHTTP");          
			}catch(falha){
				request = false;
			}
		}
	}
	if (!request) 
		alert("Seu Navegador n\u00e3o suporta Ajax!");
	else
		return request;
}

function baixarPDF(id){
	var htmlPDF = document.getElementById('table_'+id).value; 
	gerarPDF(htmlPDF);
} 

function baixarDocumento(id, tipo, titulo, botao){
	if(botao){
		var img = $(botao).find('img[src$=".svg"]');
		var src = img.attr('src');
		var dir = src.substring(0,src.lastIndexOf('/')+1);
		var nome = src.substring(src.lastIndexOf('/')+1); 
		img.attr('src', dir+nome.substring(7));
	}
         if(id =='terceirizacao' || id =='obras-e-servicos-de-engenharia'){
			   if(tipo == 'print'){
				   var html_tabela = document.getElementById(id).innerHTML; 
					document.documentElement.innerHTML =   '<h3>'+titulo+'</h3><table  border=1 cellspacing=0 cellpadding=5 >'+html_tabela+'</table>';
					window.print();
					location.reload();
			   }else{
				$('#'+id).tableExport({type:tipo});
			   }
		 } else if (tipo == 'export') {
		     var conteudo = document.getElementById(id).innerHTML;
		     tela_impressao = window.open('about:blank');
		     tela_impressao.document.write(conteudo);
		     tela_impressao.window.print();
		     tela_impressao.window.close();
		 } else {
			$('#tabela_'+id).tableExport({type:tipo});
		 }
} 

function imiprimirTabela(id){
	var htmlPDF = document.getElementById('table_'+id).value; 
	var html_tabela = document.getElementById('tabela_'+id).innerHTML; 
	htmlPDF = decodeURIComponent(htmlPDF)
	var i = 0;
	while ((i = htmlPDF.indexOf("+", i)) != -1) {
		htmlPDF = htmlPDF.replace("+", " ");
	}
	var res = htmlPDF.split("</h3>");
	res = res[0].replace("+", " ");
    document.documentElement.innerHTML =  res + '</h3><table  border=1 cellspacing=0 cellpadding=5 >'+html_tabela+'</table>';
	window.print();
	location.reload();
} 

function gerarPDF(htmlPDF) {
    var xmlreq = CriaRequest();
    var result = null;
    var url = "../includes/gerarPDF.php";
    var params = "htmlPDF=" + encodeURIComponent(htmlPDF);
    xmlreq.open("POST", url, true);
    xmlreq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlreq.onreadystatechange = function () {
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                window.open("../includes/gerarPDF.php?cmd=1", 'Download');
            } else {
                result.innerHTML = "Erro: " + xmlreq.statusText;
            }
        }
    };
    xmlreq.send(params);
}

function consultaAPIsecao(secao, url_webservice){
	var xmlreq = CriaRequest();
	var result = null;
	var resultado = document.getElementById("resultado");
	xmlreq.open("GET", "../../modules/mod_demostrativo_relatorio/tmpl/consultaServidor.php?secao="+secao+"&sv="+url_webservice);
	  xmlreq.onreadystatechange = function(){
	         if (xmlreq.readyState == 4) {
	             if (xmlreq.status == 200) {
			resultado.innerHTML =  xmlreq.responseText;
	             }else{
	                resultado.innerHTML = "Erro: " + xmlreq.statusText;
	             }
	         }
	     };
	     xmlreq.send(null);
}


function exibirSecaoDemostrativoOrcamentario(secao, url_webservice){
  consultaAPIsecao(secao, url_webservice);
}


(function() {
var WService = document.getElementById("WService");
if(WService){
   exibirSecaoDemostrativoOrcamentario('trf5',WService.value);
}
})();




function CriaRequest() {
	try{
		request = new XMLHttpRequest();        
	}catch (IEAtual){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");       
		}catch(IEAntigo){
			try{
				request = new ActiveXObject("Microsoft.XMLHTTP");          
			}catch(falha){
				request = false;
			}
		}
	}
	if (!request) 
		alert("Seu Navegador n\u00e3o suporta Ajax!");
	else
		return request;
}




function exibirBotaoRelatorio(anoMes, event){
	$(".row .report li").removeClass("selected2");

	var artigo = anoMes.split('--');
	
	//consultar via ajax pelo o codigo do artigo(posição 3 do array)
	if(artigo[3]){
	var xmlreq = CriaRequest();
	var result = null;
	var resultado = document.getElementById(artigo[3]);
	resultado.textContent = "carregando...";
	xmlreq.open("GET", artigo[4]+"?/id="+artigo[3]+"&tipo="+artigo[4]+"&action=artigo");
	  xmlreq.onreadystatechange = function(){
	         if (xmlreq.readyState == 4) {
	             if (xmlreq.status == 200) {
					resultado.innerHTML = xmlreq.responseText;
	             }else{
	                resultado.innerHTML = "Erro: " + xmlreq.statusText;
	             }
	         }
	     };
	     xmlreq.send(null);
	}
	
	idMesOcultar  = document.getElementById('idMesOcultar');
	if(idMesOcultar.value == 'vazio'){
		idMesOcultar.value = anoMes ;
		$(event).toggleClass('selected2');
	}
	 
	if(document.getElementById(anoMes)){
		if(document.getElementById(anoMes).style.display == 'none'){
			document.getElementById(anoMes).style.display = 'block';
			$(event).toggleClass('selected2');
			if(idMesOcultar.value != anoMes){
				document.getElementById(idMesOcultar.value).style.display = 'none';
			}
		}else{
			document.getElementById(anoMes).style.display = 'none';
			$(event).removeClass('selected2');
		}
	}
	
	idMesOcultar.value = anoMes ;
}





function exibirConteudoAutoBox(anoMes, event){
	$(".row .report li").removeClass("selected2");

	var artigo = anoMes.split('--');

	var ultimoID = document.getElementById('ultimoID');
	if(ultimoID.value){
		document.getElementById(ultimoID.value).style.display = 'none';
	}
	//ultimoID.style.display = 'none';
	ultimoID.value = artigo[0]+'--'+artigo[1];
	
	var xmlreq = CriaRequest();
	var result = null;
	var resultado = document.getElementById(artigo[0]+'--'+artigo[1]);
	resultado.textContent = "carregando...";
	xmlreq.open("GET", artigo[3]+"?/categoria="+artigo[2]+"&ano="+artigo[0]+"&mes="+artigo[1]+"&nomeServico="+artigo[4]);
	  xmlreq.onreadystatechange = function(){
	         if (xmlreq.readyState == 4) {
	             if (xmlreq.status == 200) {
					resultado.innerHTML = xmlreq.responseText;
	             }else{
	                resultado.innerHTML = "Erro: " + xmlreq.statusText;
	             }
	         }
	     };
	     xmlreq.send(null);
	
	/*
	idMesOcultar  = document.getElementById('idMesOcultar');
	if(idMesOcultar.value == 'vazio'){
		idMesOcultar.value = anoMes ;
		$(event).toggleClass('selected2');
	}
	 
	if(document.getElementById(anoMes)){
		if(document.getElementById(anoMes).style.display == 'none'){
			document.getElementById(anoMes).style.display = 'block';
			$(event).toggleClass('selected2');
			if(idMesOcultar.value != anoMes){
				document.getElementById(idMesOcultar.value).style.display = 'none';
			}
		}else{
			document.getElementById(anoMes).style.display = 'none';
			$(event).removeClass('selected2');
		}
	}
	*/
if(document.getElementById(artigo[0]+'--'+artigo[1]).style.display == 'none'){
	document.getElementById(artigo[0]+'--'+artigo[1]).style.display = 'block';
}else{
	document.getElementById(artigo[0]+'--'+artigo[1]).style.display = 'none';
}
	
	
	
	
	idMesOcultar.value = anoMes ;
}


function exibirBoxConteudoMes(idAnoMes) {
	$('.boxConteudoMes').hide();
	$('#'+idAnoMes).show();
}

function exibirBotaoCategoria(id, classe, event) {
    $("#"+classe+" .categoria").addClass("hideCategoria");

    $(".box_"+id).removeClass("hideCategoria");

    $('.demonstrativo #'+classe+' .boxes .box').removeClass('selecionado');
    $("#"+id).addClass('selecionado');
	
	window.location.href = '?idgrupo='+id+'&tipo='+classe; 
	
}
 
 
function fechar() { 
    document.getElementById("posiciona").style.display = 'none'; 
    document.getElementById("posiciona2").style.display = 'none'; 
}
	
	
function rolar() { 
	window.scrollTo(5,300);
}
	
function exibirModalDemostrativoRelatorio(idDocumento) { 
	document.getElementById('idDocumento').value = idDocumento;
	document.getElementById("nomeConsulta").value = ''; 
	document.getElementById("numeroDocumentoConsulta").value = ''; 
	document.getElementById("tipoDocumentoConsulta").selectedIndex = "0"
	document.getElementById('posiciona2').style.display = 'block';
	rolar();
}

document.getElementById("tipoDocumentoConsulta").addEventListener("change", myFunction);
function myFunction(){
	var $select = $('#tipoDocumentoConsulta option:selected').val();
	if( $select == "CPF"){

			$(document).ready(function(){
  				$('.numeroDocumento').mask('000.000.000-00');
  				$('#unmask').click(function(){
					var unmask_value = $('.numeroDocumento').cleanVal();
				});
			});
	}else{
		$(document).ready(function(){
  				$('.numeroDocumento').unmask();
  				
			});
	}
}
	
function salvarDadosConsultaOrcamentaria(){
	var nome = document.getElementById("nomeConsulta").value; 
	var numeroDocumento = document.getElementById("numeroDocumentoConsulta").value; 
	var WService = document.getElementById("WService").value;
	var idDocumento = document.getElementById("idDocumento").value;
	
	var selector = document.getElementById('tipoDocumentoConsulta');
    var tipoDocumento = selector[selector.selectedIndex].value;
	
	
	var x = document.getElementById("tipoDocumentoConsulta").selectedIndex; 
	
	var xmlreq = CriaRequest();
	var result = null;
	var resultado = document.getElementById("resultadoConsulta");
	xmlreq.open("GET", "../../modules/mod_demostrativo_relatorio/tmpl/cadastroBaixarDocumento.php?nome="+nome+"&tipoDocumento="+tipoDocumento+"&numeroDocumento="+numeroDocumento+"&sv="+WService+"&idDocumento="+idDocumento);
	  xmlreq.onreadystatechange = function(){
	         if (xmlreq.readyState == 4) {
	             if (xmlreq.status == 200) {
					resultado.innerHTML =  xmlreq.responseText;
					var delay=4000; 
					if(xmlreq.responseText.indexOf("green") > -1){// Essa condi��o vem da valida��o no arquivo  cadastroBaixarDocumento.php
					setTimeout(function(){
							window.location.href='../gestao-orcamentaria/resultado-pdf?/id='+idDocumento+'&MOD=SV20';
							fechar() ;
						},delay);
					}
	             }else{
	                resultado.innerHTML = "Erro: " + xmlreq.statusText;
	             }
	         }
	     };
	     xmlreq.send(null);
}



function fecharBuscaGuiada(){
	$("#consulta2").removeClass("visivel");
	$('.carousel').show();
	$('.consulta_trigger').removeClass('verde');
}

function resultadoBuscaGuiada(arg0, origem, nivel, params, tituloNiveis, sentido){
var WService = document.getElementById('webService').value;
 	$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada_corregedoria/tmpl/default.php?arg0="+encodeURI(arg0)+"&origem="+encodeURI(origem)+"&nivel="+nivel+"&params="+params+"&tituloNiveis="+encodeURI(tituloNiveis)+"&sentido="+encodeURI(sentido)+"&WService="+encodeURI(WService)+"");
 	//$('.resultadoBuscaGuiada').html("").load("../modules/mod_busca_guiada/mod_busca_guiada.php?arg0="+encodeURI(arg0)+"&origem="+encodeURI(origem)+"&nivel="+nivel+"&params="+params+"&tituloNiveis="+encodeURI(tituloNiveis)+"&sentido="+encodeURI(sentido)+"&WService="+encodeURI(WService)+"");
}
