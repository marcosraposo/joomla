$(document).ready(function(){

    $('.owl-carousel').owlCarousel({
        ltr:true,
        loop:true,
        margin:10,
        dots: false,
        items: 2,
        autoWidth: false,
        autoplay: true,
    });

    $('.demonstrativo .aba').on('click', function(){
            $('.demonstrativo .conteudo[data-aba-id]').removeClass('selecionado');
            $('.aba.selecionado').removeClass('selecionado');
            $('.demonstrativo .conteudo[data-aba-id="'+$(this).data('aba')+'"]').addClass('selecionado');
            $(this).addClass('selecionado');
    });

    $('.report ul li:not(:first-child)').on('click', function(){
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

    $('.demonstrativo .boxes .box').on('click', function(){
        $('.demonstrativo .boxes .box').removeClass('selecionado');
        $(this).addClass('selecionado');
    });

    $('.consulta_trigger').on('click', function(){
        if($('.consulta').hasClass('visivel')){
            $('.consulta').removeClass('visivel');
            $(this).removeClass('verde');
            $('.carousel').show();
        }else{
            $("html, body").animate({ scrollTop: $('#consulta').offset().top }, 500);
            $('.consulta').addClass('visivel');
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

    

    $('.fecha_mapa').click(function(){
        $('.mapadosite_conteudo').hide();
    });
    $('.mapadosite').click(function(){
        $('.mapadosite_conteudo').show();
        var y = $(window).scrollTop(); 
        $(window).scrollTop(y+300); 
    });   

    // $('.bt_portal_processos').on('click', function(){
    //     menu_expand(1);
	// 	return false; 
    // });

    // $('.bt_portal_transparencia').on('click', function(){
    //     menu_expand(2);
	// 	return false; 
    // });
    
    $('.bt_portal_imprensa').on('click', function(){
        menu_expand(3);
		return false; 
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


    $('#btnFontMais').on('click', function() {

        var TAMANHO_PADRAO_FONT = 16;
        var TAMANHO_MAXIMO_FONT = 22;
        var TAMANHO_MINIMO_FONT = 12;

        var TAMANHO_ATUAL_FONT = parseInt($('html').css('font-size'));

        if (TAMANHO_ATUAL_FONT != TAMANHO_MAXIMO_FONT) {
            $('html').css({ 'font-size': (TAMANHO_ATUAL_FONT + 2) + "px" });
        }
    });
});



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

function consultaAPIJornalMural(ano, url_webservice){
	var xmlreq = CriaRequest();
	var result = null;
	var resultado = document.getElementById("resultado");
	xmlreq.open("GET", "../modules/mod_artigos_jornal_mural/tmpl/calendario.php?ano="+ano+"&sv="+url_webservice);
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


function consultaAPIJornalMuralAtualizarData(ano, url_webservice){
	var xmlreq = CriaRequest();
	var result = null;
	var resultadoData = document.getElementById("dataAtualizacao");
	xmlreq.open("GET", "../modules/mod_artigos_jornal_mural/tmpl/titulo.php?ano="+ano+"&sv="+url_webservice);
	  xmlreq.onreadystatechange = function(){
	         if (xmlreq.readyState == 4) {
	             if (xmlreq.status == 200) {
					resultadoData.innerHTML =  xmlreq.responseText;
	             }else{
	                resultadoData.innerHTML = "Erro: " + xmlreq.statusText;
	             }
	         }
	     };
	     xmlreq.send(null);
}


function exibirAnoJornalMuralImpressa(ano, url_webservice){
	consultaAPIJornalMuralAtualizarData(ano, url_webservice);
  consultaAPIJornalMural(ano, url_webservice);
}


(function() {
var WService = document.getElementById("WService");
if(WService){
hoje = new Date();
ano = hoje.getFullYear();
   exibirAnoJornalMuralImpressa(ano,WService.value);
}
})();






/* fun��o do menu sub item foi desabilitada a pedido do cliente
function menu_expand(id){
    $('[data-menu="'+id+'"]').toggle();
    $(document).mouseup(function(e){
        var container = $('[data-menu="'+id+'"]');
        if (!container.is(e.target) && container.has(e.target).length === 0) {  container.hide();  }
    });
} 
*/

function goBack() {
    window.history.back();
}