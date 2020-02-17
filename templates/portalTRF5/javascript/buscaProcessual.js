(function($) {

	var URL_ARQUIVO        = "templates/portalTRF5/includes/consulta_cp.php";
	var URL_ARQUIVO_DADOS  = "templates/portalTRF5/includes/consulta_cp_dados.php";
  var table              = null;
	var $boxResultado      = $('#boxResultado');

	var $formNumeroProcesso = $('#formNumeroProcesso');
	var $formNomeParte      = $('#formNomeParte');
	var $formNumeroOab      = $('#formNumeroOab');
	var $formNumeroCpfCnpj  = $('#formNumeroCpfCnpj');

	var $btnFechaResultado  = $('#btnFechaResultado');
	var $loadImage          = $('#loadImage');

	var $btnFecharModal = $('#btnFecharModal');

	$loadImage.hide();

	$btnFecharModal.on('click', function() {
		$('#modalPesquisa').fadeOut(function() {
			$('#modalBox').fadeOut();
		});
	});

	/****************************************
	 * Consulta Processos Por Numero
	 ***************************************/
	$formNumeroProcesso.on('submit', function(e) {
		e.preventDefault();
    if ($('#inputNumeroProcesso').val() !== "") {
			esconderAbas();
			$loadImage.show();
			$.post(URL_ARQUIVO, $formNumeroProcesso.serialize(), function(data) {
				pesquisa(data);
			});
    } else {
      alert('Informe o número do processo');
			$('#inputNumeroProcesso').focus();
		}
	});

	/****************************************
	* Consulta Processos Pelo Nome da Parte
	*****************************************/
	$formNomeParte.on('submit', function(e) {
		e.preventDefault();
		if ($('#inputNomeParte').val() !== "") {
			esconderAbas();
			$loadImage.show();
			$.post(URL_ARQUIVO, $formNomeParte.serialize(), function(data) {
				pesquisa(data);
			});
		} else {
			alert('Informe o nome da parte');
			$('#inputNomeParte').focus();
		}
	});

	/****************************************
	* Consulta Processos Pelo Numero da OAB
	*****************************************/
	$formNumeroOab.on('submit', function(e) {
		e.preventDefault();
		if ($('#inputOab').val() !== "" && $('#inputEstadoOab').val() !== "") {
			esconderAbas();
			$loadImage.show();
			$.post(URL_ARQUIVO, $formNumeroOab.serialize(), function(data) {
				pesquisa(data);
			});
		} else {
			alert('Informe o número da OAB e o Estado');
			$inputOab.focus();
		}
	});

	/*******************************************
	* Consulta Processos Pelo Numero do CPF/CNPJ
	********************************************/
	$formNumeroCpfCnpj.on('submit', function(e) {
		e.preventDefault();
		if ($('#inputCpfCnpj').val() !== "") {
			esconderAbas();
			$loadImage.show();
			$.post(URL_ARQUIVO, $formNumeroCpfCnpj.serialize(), function(data) {
				pesquisa(data);
			});
		} else {
			alert('Informe o CPF ou CNPJ desejado');
			$('#inputCpfCnpj').focus();
		}
	});

	/*******************************************
	* Funcao para fechar a tela de resultados
	********************************************/
	$btnFechaResultado.on('click', function() {
		limparCampos();
		$boxResultado.fadeOut(function() {
			$('[data-aba-search="1"].aba').addClass('selected').fadeIn();
		});
	});

	function limparCampos() {
		$('#inputNumeroProcesso').val('');
		$('#inputNomeParte').val('');
		$('#inputOab').val('');
		$('#inputEstadoOab').val('');
		$('#inputCpfCnpj').val('');
	}

  function esconderAbas() {
    $('.buscaprocessualb .aba').removeClass('selected');
  }

  $('#inputCpfCnpj').blur(function(e){
		var valor = e.target.value
		if (valor){
			var max = (valor.length <= 11)? 11: 14;
			for (i=valor.length; i<max; i++)
				valor = '0' + valor
			e.target.value = valor

			if (valor.length <= 11)
				$('#inputCpfCnpj').mask('000.000.000-00', {reverse: true})
			else
				$('#inputCpfCnpj').mask('00.000.000\/0000-00', {reverse: true})
		}
	});

	$('#inputCpfCnpj').focus(function (e){
		$('#inputCpfCnpj').unmask()
	});

	$('#inputNumeroOab').mask('000000X', {
		translation: {
			'X': {
				pattern: /[a-zA-Z]/, optional: true
			}
		}
	});

  var pesquisa = function(obj) {

		if (obj === "") {
			alert("Nenhum processo encontrado!");
			$loadImage.hide();
			limparCampos();
			$('[data-aba-search="1"].aba').addClass('selected').fadeIn();
			return;
		}

		var processos = [];
		var res = obj.replace(/[\\]/g, '');

		JSON.parse(res).forEach(function(sistema) {

			if (sistema.processos.length > 0) {
				sistema.processos.forEach(function(processo){
					processos.push({
						orgao: sistema.orgao,
						sistema: sistema.sistemaProcessual,
						resultado: sistema.resultado.mensagem,
						numero: processo.numero,
						nomeParte: processo.nomeParte,								
						link: processo.link,
						dataAutuacao: processo.dataAutuacao,
						classeJudicial: processo.classeJudicial,
						assunto: processo.assunto,
						orgaoJulgador: processo.orgaoJulgador
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
		});

		tabela = $("#tabelaProcessos").DataTable({
			data: processos,
			searching: false,
			lengthChange: false,
			destroy: true,
			paginate: false,
			info: false,
			columns: [
					{
						render: function(data, type, row, meta){
							var orgao = row.orgao.nome? row.orgao.nome: row.orgao.id
							var sistema = row.sistema.descricao? row.sistema.descricao: row.sistema.id
							return '<span title="' + orgao + ' - ' + sistema + '">' + row.orgao.id + '/' + row.sistema.id + '</span>'
						}
					},
					{
						render: function(data, type, row, meta){
							return row.resultado
						}
					},
					{
						render: function(data, type, row, meta){
							return "<a href='javascript: exibeDadosProcesso(\"" + row.orgao.id + "\", \"" + row.sistema.id + "\", \"" + row.numero + "\")' target='_blank'>" + row.numero + "</a>"
						}
					}
			]
		});

		$loadImage.hide();
		esconderAbas();
		$boxResultado.fadeIn();
	}

	exibeDadosProcesso = function(orgao, sistema, numero) {
		$.get(URL_ARQUIVO_DADOS + "?orgao="+ orgao + "&sistema=" + sistema + "&numero=" + numero, function(obj) {

			obj = JSON.parse(obj);

			$("#info-numero").html(obj.numero);
			
			//converte as nomes das partes do processo num objeto list
			$("#info-nome-parte").html(converterNomeParteToList(obj.nomeParte));
			
			//converte as movimentacoes num objeto list
			var lista = converterArrayMovToList(obj.movimentacoes);

			$("#info-movimentacao").html(lista);
			
			$("#info-link").html(obj.link ? '<a href="' + obj.link + '" target="_blank">Clique aqui</a>': 'Não');


			$('#modalBox').fadeIn(function() {
				$('#modalPesquisa').fadeIn();
			});

		}).fail(function(){
			alert("erro ao consultar os dados do processo " + numero); //NOSONAR
		});
	}
	
	function converterNomeParteToList(partes){
		let list = $('<ul></ul>');
		list.addClass("list-group bordeless");

		if (partes) {
			for(let x=0; x < partes.length;x++){
				if(partes[x].nomeParte != null){
					var li = $('<li></li>').addClass('list-group-item bordeless');
					var a = $('<a></a>').text(partes[x].nomeParte);
					li.append(a);
					list.append(li);
				}
			}
		}
		return list;
	}	
	
	function converterArrayMovToList(vetor){
		let list = $('<ul></ul>');
		list.addClass('list-group bordeless');
		if(vetor!=null && vetor.length > 0){ 
			for(let x=0; x < vetor.length;x++){
				var li = $('<li></li>').addClass('list-group-item bordeless');
				var a = $('<a></a>').text(vetor[x].data + '-' + vetor[x].descricao);
				li.append(a);
				list.append(li);
			}
		}
		return list;
	}


})(jQuery);