(function($) {

  var URL_ARQUIVO_NOTICIAS = "../templates/portalTRF5/includes/consulta_geral.php";
  var URL_ARQUIVO_JOOMLA   = "../templates/portalTRF5/includes/consulta_geral_joomla.php";

  var $inputPesquisa   = $('#inputPesquisa');
  var $formPesquisa    = $('#formPesquisa');
  var $btnMostrarMaisNoticias    = $('#btnMostrarMaisNoticias');
  var $btnMostrarMaisNoticiasJoomla    = $('#btnMostrarMaisNoticiasJoomla');
  var $pesquisaGeralOrdenacao    = $('#pesquisaGeralOrdenacao');
  var $containerJoomla   = $('.pesquisa__links-box');
  var $containerNoticias = $('.pesquisa__body-box');
  var $spanRes           = $('#spanRes');
  var $botaoLimparPesquisaGeral           = $('#botaoLimparPesquisaGeral');
  var carregando = document.getElementById('spanRes');
  var totalNoticias = 0;
  var totalJoomla   = 0;
  var linhas = 10;
  var linhasJoomla = 10;
  var valorPesquisa = location.href.split('?q=')[1];

 $botaoLimparPesquisaGeral.on('click', limparCampos);

  consultarURL(valorPesquisa);

  $formPesquisa.on('submit', function(e) {
	carregando.innerHTML = '<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">';
    e.preventDefault();
    linhas = 10;
    linhasJoomla = 10;
    pesquisarNoticias($inputPesquisa.val());
    pesquisarJoomla($inputPesquisa.val());
  });

  function countValores(valor, valores) {
    var total = 0;
    for (i = 0; i < valores.length; i++) {
      if (valores[i] === valor) {
        total++;
      }
    }
    return total;
  }

  function limparCampos() {
	document.getElementById('inputPesquisa').value = '';
  }

  function carregarMaisNoticias() {
    $buttonLoadMore.text("Carregando...");
    $.post(URL, $formPesquisa.serialize(), renderMaisNoticias);
  }
  
  function consultarURL(valor) {

    var url = location.href.split('/');

    var total = countValores('index.php', url);

    if (total === 1) {
      URL_ARQUIVO_NOTICIAS = "../templates/portalTRF5/includes/consulta_geral.php";
      URL_ARQUIVO_JOOMLA   = "../templates/portalTRF5/includes/consulta_geral_joomla.php";
    } else {
      URL_ARQUIVO_NOTICIAS = "../../templates/portalTRF5/includes/consulta_geral.php";
      URL_ARQUIVO_JOOMLA   = "../../templates/portalTRF5/includes/consulta_geral_joomla.php";
    }

    if (valor) {
      valor = valor.replace(new RegExp("%20", 'g'), " ");
      valor = decodeURI(valor);
    }

    $inputPesquisa.val(valor);

    setTimeout(function() {
      $formPesquisa.submit();
    }, 10);
  }

  function countResultados() {
    // totalNoticias = 0;
    // totalJoomla   = 0;

    $spanRes.html('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
    $spanRes.hide().html(totalJoomla + totalNoticias).fadeIn();
  }

  //*******************************************
  // Funções JOOMLA
  //*******************************************
  function pesquisarJoomla(valor) {
   
	linhasJoomla = 10
   //$('#btnMostrarMaisNoticiasJoomla').on('click',  linhasJoomla += 10);
  
    $.post(URL_ARQUIVO_JOOMLA+"?linhas="+linhasJoomla, $formPesquisa.serialize(), renderNoticiasJoomla).done(function() {
      $spanRes.html('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
      $spanRes.hide().html((totalJoomla + totalNoticias)).fadeIn();
    });
  }

  /**
   * Função que realiza o request para mostrar mais noticias
   */
  function mostrarMaisNoticiasJoomlaAPI() {
    linhas += 10;
    $('#btnMostrarMaisNoticiasJoomla').text("Carregando...");
    $.post(URL_ARQUIVO_JOOMLA+"?linhas="+linhas, $formPesquisa.serialize(), renderNoticiasJoomla).done(function() {
      $spanRes.html('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
      $spanRes.hide().html(totalJoomla + totalNoticias).fadeIn();
      $('#btnMostrarMaisNoticiasJoomla').text("Mostrar Mais +");
    });
	
	if(totalJoomla >= 10){
		$("#btnMostrarMaisNoticiasJoomla").css("display", "block");
	}else{
		$("#btnMostrarMaisNoticiasJoomla").css("display", "none");
	}
	
  }

  $('#btnMostrarMaisNoticiasJoomla').on('click', mostrarMaisNoticiasJoomlaAPI);

  function renderNoticiasJoomla(noticiasJoomla) {

    totalJoomla = 0;

    if (noticiasJoomla !== "" && noticiasJoomla !== "null") {
      var $retornoHtml = "";
      var retornoAPI   = JSON.parse(noticiasJoomla);

      if (retornoAPI.retornoBusca.hits.total != 0) {

        var arrayRetorno = retornoAPI.retornoBusca.hits.hits;

        arrayRetorno.forEach(function(noticia) {
          totalJoomla++;
          $retornoHtml += renderNoticiaJoomla(noticia._source);
        });
        $containerJoomla.html("");
        $containerJoomla.hide().html($retornoHtml).fadeIn('slow');
	
		if(totalJoomla % 10 == 0){
			$("#btnMostrarMaisNoticiasJoomla").css("display", "block");
		}else{
			$("#btnMostrarMaisNoticiasJoomla").css("display", "none");
		}
		
      } else {
        $containerJoomla.html("");
        $containerJoomla.hide().html('<p class="message">Nenhuma notícia encontrada!</p>').fadeIn('slow');
      }

    } else {
      $containerJoomla.html("");
      $containerJoomla.hide().html('<p class="message">Nenhuma notícia encontrada!</p>').fadeIn('slow');
    }
  }

  function renderNoticiaJoomla(noticia) {
	var linkPagina = noticia.urlconteudo.split('/portal-da-transparencia/').join('/');
	var linkPagina = linkPagina.split('/servicos/').join('/');
	var linkPagina = linkPagina.split('/imprensa/').join('/');
	var linkPagina = linkPagina.split('/biblioteca/').join('/');
	var linkPagina = linkPagina.split('/trf5-sustentavel/').join('/');
	var linkPagina = linkPagina.split('/esmafe/').join('/');
	var linkPagina = linkPagina.split('/conciliacao/').join('/');
	var linkPagina = linkPagina.split('/concursos-e-selecoes/').join('/');
	var linkPagina = linkPagina.split('/conselho-de-administracao/').join('/');
	var linkPagina = linkPagina.split('/corregedoria/').join('/');
	var linkPagina = linkPagina.split('/jurisprudencia/').join('/');
	var linkPagina = linkPagina.split('/portal-dos-servicos-publicos/').join('/');
	var linkPagina = linkPagina.split('/legislacao/').join('/');
	var linkPagina = linkPagina.split('/processos-e-consultas/').join('/');
	
 return `
      <article>
        <a href="${linkPagina}">
          <h1>${noticia.title}</h1>
        </a>
        <p>
          ${noticia.introtext.replace(/<.*?>/g, '').substring(0, 250)}...
        </p>
      </article>
    `;
   /*  return `
      <article>
          <h1>${noticia.title}</h1>
        <p>
          ${noticia.introtext.replace(/<.*?>/g, '').substring(0, 250)}...
        </p>
      </article>
    `;*/
  }

  //*******************************************
  // Funções NOTICIAS
  //*******************************************
  function pesquisarNoticias(valor) {
    linhas = 10;

    $.post(URL_ARQUIVO_NOTICIAS+"?linhas="+linhas, $formPesquisa.serialize(), renderNoticiasAPI).done(function() {
      $spanRes.html('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
      $spanRes.hide().html(totalJoomla + totalNoticias).fadeIn();
    });
	
	if(totalNoticias >= 10){
		$("#btnMostrarMaisNoticias").css("display", "block");
	}else{
		$("#btnMostrarMaisNoticias").css("display", "none");
	}
	
	if(totalJoomla >= 10){
		$("#btnMostrarMaisNoticiasJoomla").css("display", "block");
	}else{
		$("#btnMostrarMaisNoticiasJoomla").css("display", "none");
	}
  }

  /**
   * Função que realiza o request para mostrar mais noticias
   */
  function mostrarMaisNoticiasAPI() {
    linhas += 10;
    $('#btnMostrarMaisNoticias').text("Carregando...");
    $.post(URL_ARQUIVO_NOTICIAS+"?linhas="+linhas, $formPesquisa.serialize(), renderNoticiasAPI).done(function() {
      $spanRes.html('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
      $spanRes.hide().html(totalJoomla + totalNoticias).fadeIn();
      $('#btnMostrarMaisNoticias').text("Mostrar Mais +");
    });
	if(totalJoomla >= 10){
		$("#btnMostrarMaisNoticiasJoomla").css("display", "block");
	}else{
		$("#btnMostrarMaisNoticiasJoomla").css("display", "none");
	}
  }

  $('#btnMostrarMaisNoticias').on('click', mostrarMaisNoticiasAPI);

  function renderNoticiasAPI(noticiasAPI) {

    totalNoticias = 0;

    if (noticiasAPI !== "" && noticiasAPI !== null) {
      var $retornoHtml = "";
      var retornoAPI   = JSON.parse(noticiasAPI);


      if (retornoAPI.retornoBusca.hits.total != 0) {

        var arrayRetorno = retornoAPI.retornoBusca.hits.hits;

        arrayRetorno.forEach(function(noticia) {
			console.log(totalNoticias);
          totalNoticias++;
          $retornoHtml += renderNoticiaAPI(noticia._source);
        });
        $containerNoticias.html("");
        $containerNoticias.hide().html($retornoHtml).fadeIn('slow');

      } else {
        $containerNoticias.html("");
        $containerNoticias.hide().html('<p class="message">Nenhuma notícia encontrada!</p>').fadeIn('slow');
      }

    } else {
      $containerNoticias.html("");
      $containerNoticias.hide().html('<p class="message">Nenhuma notícia encontrada!</p>').fadeIn('slow');
    }
	if(totalNoticias >= 10){
		$("#btnMostrarMaisNoticias").css("display", "block");
	}else{
		$("#btnMostrarMaisNoticias").css("display", "none");
	}
	
  }

  function renderNoticiaAPI(noticia) {
    return `
      <a href="noticias/leitura-de-noticias?/id=${noticia.id}" >
        <article>
          <h2>${noticia.titulo}</h2>
          <p>${noticia.texto.substring(0, 170)}...</p>
        </article>
      </a>
    `;
  }

})(jQuery);