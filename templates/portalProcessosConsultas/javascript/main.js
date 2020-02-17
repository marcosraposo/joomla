
var validaProcesso = function(numeroProcesso) {
	if (!numeroProcesso) return false;
	return numeroProcesso.match(/^[0-9]{7}-[0-9]{2}\.[0-9]{4}\.[0-9]\.[0-9]{2}\.[0-9]{4}$/);
}

var controleFoco = null;

$('#modal').on('hidden.bs.modal', function(){
    if (controleFoco) {
        controleFoco.focus();
    }
});

var exibeMensagem = function(mensagem) {
	$('#modal-mensagem').html(mensagem);
	$('#modal').modal();
}

	

	
$(document).ready(function(){
	$('#fone').mask('(99)9999-99999');
	$('#processo').mask('9999999-99.9999.9.99.9999');

	$('#comentario').bind('input propertychange', function() {
		var msg = "";
		if (this.value.length > 0) {
			msg = (this.getAttribute("maxlength") - this.value.length) + " caracteres disponíveis";
		}
		$('#tc-comentario').html(msg);
	});



	$('#form-solicitacao').submit(function() {
		var nome = $('#nome').val().trim();
		var email = $('#email').val().trim();
		var processo = $('#processo').val().trim();
		var fone = $('#fone').val().trim();
		var comentario = $('#comentario').val().trim();

		if (nome == "") {
			exibeMensagem('Informe seu nome');
			controleFoco = $('#nome');
			return false;
		}
				
		if (nome.length < 5) {
			alert('Digite seu nome completo');
			return false;
		}
		
		if (processo == "") {
			alert('Preencha o campo com seu Processo');
			return false;
		}

		if($('#email').val().indexOf("@") == -1 ||  $('#email').val().indexOf(".") == -1 ||  $('#email').val() == "" || $('#email').val() == null) {
			alert("Por favor, indique um e-mail válido.");
			return false;
		}

		if (!validaProcesso(processo)) {
			exibeMensagem('Informe um número de processo válido');
			controleFoco = $('#processo');
			return false;
		}
		
		$('#tc-comentario').html('<b>Dados enviados com sucesso!</b>');		
		 
		$.ajax({
			url: 'https://www5.trf5.jus.br/quero-conciliar/index.php',
			method: 'POST',
			data: {
				nome: nome,
				email: email,
				processo: processo,
				fone: fone,
				comentario: comentario
			}
		}).done(function(o, s, x){
			exibeMensagem(o);
            $('#form-solicitacao')[0].reset();
			$('#tc-comentario').html('Dados enviados com sucesso!');
		}).fail(function(x, s, e){
			exibeMensagem('Não foi possível enviar sua solicitação. Aguarde alguns instantes e tente novamente.');
		});
		
			var delay=4000; 
					
					setTimeout(function(){
						$('#form-solicitacao')[0].reset();
						$('#tc-comentario').html('');
						},delay);
		
        controleFoco = null;
        return false;
	});
});