(function($) {

  var URL_ARQUIVO        = "../templates/portalTRF5/includes/consulta_cp.php";
  var URL_ARQUIVO_DADOS  = "../templates/portalTRF5/includes/consulta_cp_dados.php";

  var $formPesquisaNumero = $('#formPesquisaNumero');
  var $formPesquisaNome   = $('#formPesquisaNome');
  var $formPesquisaOab    = $('#formPesquisaOab');
  var $fromPesquisaCpf    = $('#formPesquisaCpf');
  var $botaoLimparProcessual    = $('.botaoLimparProcessual');
  
  
  $botaoLimparProcessual.on('click', limparCampos);
  $(".spanResResulta").text('0');

  
  $formPesquisaNumero.on('submit', function(e) {
	$(".spanResResulta").text('');
	$(".spanResResulta").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
    e.preventDefault();
    pesquisarProcesso($(this));
  });

  $formPesquisaNome.on('submit', function(e) {
	$(".spanResResulta").text('');
	$(".spanResResulta").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
    e.preventDefault();
    pesquisarProcesso($(this));
  });

  $formPesquisaOab.on('submit', function(e) {
	$(".spanResResulta").text('');
	$(".spanResResulta").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
    e.preventDefault();
    pesquisarProcesso($(this));
  });

  $fromPesquisaCpf.on('submit', function(e) {
	$(".spanResResulta").text('');
    $(".spanResResulta").append('<img src="../templates/portalTRF5/images/progressoIcone.gif"/ width="20">');
    e.preventDefault();
    pesquisarProcesso($(this));
  });
  
	function limparCampos() {
		document.getElementById('campoNumero').value = '';
		document.getElementById('campoNome').value = '';
		document.getElementById('campoCriterio').value = '';
		document.getElementById('campoCPF').value = '';
	}


  $('.pesquisa__box-button').on('click', function() {

    $formPesquisaNumero.hide();
    $formPesquisaNome.hide();
    $formPesquisaOab.hide();
    $fromPesquisaCpf.hide();

    switch($(this).text()) {
      case "Número do Processo":
          $formPesquisaNumero.fadeIn();
        break; 
      case "Nome da Parte":
          $formPesquisaNome.fadeIn();
        break; 
      case "Número da OAB":
          $formPesquisaOab.fadeIn();
        break;
      case "Número do CPF ou CNPJ":
          $fromPesquisaCpf.fadeIn();
        break;  
    }

   removeClassActiveButton();

    $(this).addClass('box-button--active');
  });



   
 $('#pesquisa__body-processos').on('click', function(e) {
 var divCollapseContent = e.target.parentElement.parentElement; 
	if($('.collapse__content').hasClass('collapse--active')){
		removeClassActive();
	}else{   
		if(e.target.alt != null){
			var valoresImg = e.target.alt.split(" - ");
			var numero  = valoresImg[0].trim(); 
			var orgao   = valoresImg[1].trim(); 
			var sistema = valoresImg[2].trim(); 
			var idDivContent = valoresImg[3].trim();
			pesquisarDadosProcesso(orgao, sistema, numero, idDivContent); 
			divCollapseContent.classList.toggle('collapse--active'); 
		}else{
			var valores = e.target.textContent.split(" - "); 
			var numero  = valores[0].trim(); 
			var orgao   = valores[1].trim(); 
			var sistema = valores[2].trim(); 
			
			if (numero !== "Nenhum processo encontrado") { 
				pesquisarDadosProcesso(orgao, sistema, numero, divCollapseContent); 
				divCollapseContent.classList.toggle('collapse--active'); 
			} else { 
				 alert("Nenhum Processo encontrado!"); 
			}
		}
    }
    
 });

 $('#pesquisa__body-processos-esparta').on('click', function(e) {
 var divCollapseContent = e.target.parentElement.parentElement; 
	if($('.collapse__content').hasClass('collapse--active')){
		removeClassActive();
	}else{   
		if(e.target.alt != null){
			var valoresImg = e.target.alt.split(" - ");
			var numero  = valoresImg[0].trim(); 
			var orgao   = valoresImg[1].trim(); 
			var sistema = valoresImg[2].trim(); 
			var idDivContent = valoresImg[3].trim();
			pesquisarDadosProcesso(orgao, sistema, numero, idDivContent); 
			divCollapseContent.classList.toggle('collapse--active'); 
		}else{
			var valores = e.target.textContent.split(" - "); 
			var numero  = valores[0].trim(); 
			var orgao   = valores[1].trim(); 
			var sistema = valores[2].trim(); 
			
			if (numero !== "Nenhum processo encontrado") { 
				pesquisarDadosProcesso(orgao, sistema, numero, divCollapseContent); 
				divCollapseContent.classList.toggle('collapse--active'); 
			} else { 
				 alert("Nenhum Processo encontrado!"); 
			}
		}
    }
  });
 

  function removeClassActive() {
    $('.collapse__content').removeClass('collapse--active');
  }

  function removeClassActiveButton() {
    $('.pesquisa__box-button').removeClass('box-button--active');
  }


  /**
   * Função que realiza o request com os dados da pesquisa
   */
  function pesquisarProcesso(form) {
    $.post(URL_ARQUIVO, form.serialize(), processarDados).done(function() {
      $('#spanRes').text(totalProcessos);
    });
  }

  /**
   * Função que realiza o request com os dados de um processo especifico
   */
  function pesquisarDadosProcesso(orgao, sistema, numero, _processo) {
    $.get(URL_ARQUIVO_DADOS+"?orgao="+orgao+"&sistema="+sistema+"&numero="+numero, function(retorno) {
      
      var processo = JSON.parse(retorno);

      var nomeDaParte = "<ul>";
      processo.partes.forEach(function(nome) {
        nomeDaParte += "<li>"+nome.nome+"</li>";
      });
      nomeDaParte += "</ul>";

      var listaMovimentacoes = "<ul>";
      processo.movimentacoes.forEach(function(mov) {
        listaMovimentacoes += "<li>" + mov.data + " - " + mov.descricao +"</li>";
      });
      listaMovimentacoes += "</ul>";

      var texto = `
        <p style="color: #5776B0;">Nome da Parte</p>
        ${nomeDaParte}

        <p style="color: #5776B0;">Últimas Movimentações</p>
        ${listaMovimentacoes}

        <p>Link: ${processo.url ? '<a href="http://' + processo.url + '" target="_blank">Clique aqui</a>' : 'Não'}</p>
      `;
		if(document.getElementById(_processo)){
			document.getElementById(_processo).innerHTML = texto;
		}else{
			_processo.querySelector('.collapse__body').innerHTML = texto;
		}
    });
  }


  
  /**
   * Função de callback para processar os dados retornados da consulta
   * @param retorno Dados dos processos consultados
   */
  function processarDados(retorno) {

    totalProcessos = 0;

    if (retorno == "") {
      alert("Nenhum processo encontrado!");
      return;
    }

	response = JSON.parse(retorno);

		var i = 0;
		response[0].processos.forEach(function(sistema) {

		console.log(sistema.sistema);
			if (sistema.sistema === "ESPARTA") {
			  var processosEsparta = [];
			  adicionarProcessos(processosEsparta, response[0].processos, response[0].processos.length, 'pesquisa__body-processos-esparta');
			} else {
			  var processosPJE = [];
			  adicionarProcessos(processosPJE, response[0].processos, response[0].processos.length, 'pesquisa__body-processos');
			}
			i++;
		});
	
	  
	  
	  
      
   //
		
  }

  function adicionarProcessos(processos, sistema, totalProcessos, divRenderProcessos) {
    if (totalProcessos > 0) {
	$(".spanResResulta").text(totalProcessos);

      sistema.forEach(function(processo){
        processos.push({
          orgao: processo.orgao,
          sistema: processo.sistema,
          resultado: processo.classeJudicial,
          numero: processo.numero,
          nomeParte: null,								
          link: processo.url,
          dataAutuacao: processo.dataDistribuicao,
          classeJudicial: processo.classeJudicial,
          assunto: null,
          orgaoJulgador: processo.orgao
        })
      })
    } else {
      processos.push({
        orgao: sistema.orgao,
        sistema: sistema.sistemaProcessual,
        resultado: sistema.resultado.mensagem,
        numero: "Nenhum processo encontrado",
        nomeParte: null,							
        link: null,
        dataAutuacao: null,
        classeJudicial: null,
        assunto: null,
        orgaoJulgador: null
      })
    }

    var dadosProcesso = "";
    var i = 0;
    processos.forEach(function(processo, i) {
      dadosProcesso += renderProcesso(processos, i);
	  i++;
    });
    $('#'+divRenderProcessos).html("").html(dadosProcesso).fadeIn();
  } 

  function renderProcesso(processo, i) {
	  var imagem = `<img onClick="javascript:exibirProcesso('collapse${i}')" alt="${processo[i].numero} - ${processo[i].orgao} - ${processo[i].sistema} - collapse${i}" src="../templates/portalTRF5/images/seta_baixo.png">`;
	  
	  
    return `    	  
      <div class="collapse__content" >
        <header class="collapse__header callapse">
           <span>${processo[i].numero} - ${processo[i].orgao} - ${processo[i].sistema}</span>
          ${
            processo[i].numero !== "Nenhum processo encontrado"
              ? imagem
              : ''
          }
        </header>
        <div class="collapse__body" id="collapse${i}"></div>
      </div>

    `;
  }

})(jQuery);