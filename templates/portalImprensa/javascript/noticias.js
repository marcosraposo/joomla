(function($) {

  var URL = "../templates/portalImprensa/includes/noticias.php";

  var $formPesquisa      = $('#formPesquisa');
  var $inputPesquisa     = $('#inputPesquisaImprensa');
  var $noticiasContainer = $('#noticiasContainer');
  var $buttonLoadMore    = $('#buttonLoadMore');
  var $inputLimite       = $('#inputLimite');
  var $dataInicio        = $('#dataInicioNoticia');
  var $dataFim           = $('#dataFimNoticia');
  var $qtdRegistros      = $('#qtdRegistros');
  var $inputPagina       = $('#inputPagina');
  var $inputPesquisaBotao= $('#inputPesquisaBotao');
  var $inputBotaoLimpar= $('#inputBotaoLimpar');
  
  
  $inputBotaoLimpar.on('click', limparCampos);
  $inputPesquisaBotao.on('click', pesquisarNoticiasBotao);
  $inputPesquisa.on('keypress', pesquisarNoticias);
  $dataInicio.on('keypress', pesquisarNoticias);
  $dataFim.on('keypress', pesquisarNoticias);
  $buttonLoadMore.on('click', carregarMaisNoticias);

  function pesquisarNoticiasBotao(e) {
	  $inputLimite.val(0);
	  $inputPagina.val(0);
      e.preventDefault();
      $noticiasContainer.html("<p>Carregando noticias...</p>");
      $.post(URL, $formPesquisa.serialize(), renderNoticias);
  }

  function pesquisarNoticias(e) {
	  $inputLimite.val(0);
	  $inputPagina.val(0);
    if (e.which === 13) {
      e.preventDefault();
      $noticiasContainer.html("<p>Carregando noticias...</p>");
      $.post(URL, $formPesquisa.serialize(), renderNoticias);
    }
  }

  function carregarMaisNoticias() {
    $buttonLoadMore.text("Carregando...");
    $.post(URL, $formPesquisa.serialize(), renderMaisNoticias);
  }
  
  function limparCampos() {
	document.getElementById('dataInicioNoticia').value = '';
	document.getElementById('dataFimNoticia').value = '';
	document.getElementById('inputPesquisaImprensa').value = '';
  }

  function renderMaisNoticias(noticias) {
    var retorno = "";
    var lista = JSON.parse(noticias);
	
	var paginaTela = document.getElementById('inputPagina');
	pagina = parseInt(paginaTela.value) + 12;
	
	paginaTela.value = pagina;
	
	if(lista.totalRegistros <= pagina){
		document.getElementById('buttonLoadMore').style.display = "none";
	}else{
		document.getElementById('buttonLoadMore').style.display = "block";
	}
	
    lista.listaNoticias.forEach(function(noticia) {
      retorno += renderNoticia(noticia);
    });
    $buttonLoadMore.text("Carregar Mais");
    $noticiasContainer.append(retorno);
  }

  function renderNoticias(noticias) {
    var retorno = "";
	
/*
//var resultado = noticias.indexOf("VAZIO");
	if(!JSON.parse(noticias)){
		$noticiasContainer.html("<p>Nenhuma noticia encontrada</p>");
	}*/
	
	try {
		var lista = JSON.parse(noticias);
	
		if(!lista.listaNoticias.length){
			lista.listaNoticias = [ lista.listaNoticias];
		}

	}
	catch(err) {
	 $noticiasContainer.html("<p>Nenhuma noticia encontrada</p>");
	 document.getElementById('buttonLoadMore').style.display = "none";
	 return false;
	}

	
    $inputLimite.val(lista.numPagina);
	$qtdRegistros.val(lista.totalRegistros);
	$inputPagina.val(lista.qtdRegistros);
	
	if(lista.qtdRegistros >= 12){
		document.getElementById('buttonLoadMore').style.display = "block";
	}else{
		document.getElementById('buttonLoadMore').style.display = "none";
	}
	//alert(lista.qtdRegistros);
	console.log(lista.qtdRegistros);
	//$.isEmptyObject({});
	if(lista.qtdRegistros >= 1){
		lista.listaNoticias.forEach(function(noticia) {
		  retorno += renderNoticia(noticia);
		});
	}
    if (retorno === '') {
      $noticiasContainer.html("<p>Nenhuma noticia encontrada</p>");
    } else {
      $noticiasContainer.html("").html(retorno);
    }
  }

  function renderNoticia(noticia) {
    return `
      <a class="box_simples" href="noticias/leitura-de-noticias?/id=${noticia.id}" style="text-decoration: none; color: #5776B0">  
        <div class="conteudo_noticias">
          <div class="titulo lower ml-4" style="margin-top:12px;">
            ${noticia.titulo}
          </div> 
          <div class="p-box-noticias-1 ml-4 mr-3 mt-3">
            ${noticia.texto.substring(0, 285)}...
          </div>
          <div class="box-plus mt-1 mb-2 mr-4">
            <img class="conteudo_icone_mais" width="20" src="../templates/portalImprensa/images/plus.svg">
          </div>
        </div>
      </a>
    `;
  }

})(jQuery);