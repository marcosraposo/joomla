<?php 

$url_webservice = $_GET['sv'];
$numeroDocumento = $_GET['numeroDocumento'];
$tipoDocumento = $_GET['tipoDocumento'];
$nome = $_GET['nome'];
$idDocumento = $_GET['idDocumento'];

if($nome == ""){
	echo "<font color='red'>Por favor preencher um NOME.</font>";
	exit;
}

if(strlen($nome) <= 10){
	echo utf8_encode("<font color='red'>Por favor preencher um NOME válido.</font>");
	exit;
}

if($tipoDocumento == ""){
	echo "<font color='red'>Por favor preencher um tipo de Documento.</font>";
	exit;
}

if($tipoDocumento == "RG"){
	if($numeroDocumento == ""){
		echo utf8_encode("<font color='red'>Preencha o número do documento.</font>");
		exit;
	}
}

if($tipoDocumento == "TITULO_ELEITOR"){
	$numeroDocumento = removerPonto($numeroDocumento);
	if(!validateTituloEleitor( $numeroDocumento )){
		echo utf8_encode("<font color='red'>Título de eleitor inválido</font>");
		exit;
	}
}

if($tipoDocumento == "CPF"){
	$numeroDocumento = removerPonto($numeroDocumento);
	if(!valida_cpf( $numeroDocumento )){
		echo utf8_encode("<font color='red'>CPF inválido</font>");
		exit;
	}
}

if($tipoDocumento == "CNH"){
	$numeroDocumento = removerPonto($numeroDocumento);
	if(!validateCnh( $numeroDocumento )){
		echo utf8_encode("<font color='red'>CNH inválido</font>");
		exit;
	}
}
	try {
			ini_set("soap.wsdl_cache_enabled", "0");
			ini_set('soap.wsdl_cache_ttl', 900);
			ini_set('default_socket_timeout', 15);
			
			$client = new SoapClient($url_webservice);        			
			$dataHoje = date('d/m/Y');
			
			$arguments = array('getDetalhamentoFolhaPagamento' => array('idMes' => $idDocumento, 'nome' => $nome, 'siglaTipoDoc' => $tipoDocumento, 'numeroDoc' => $numeroDocumento  ));
			$demonstrativoGestaoOrcamentaria = $client->__soapCall("getDetalhamentoFolhaPagamento", $arguments ); 
		
			echo utf8_encode("<font color='green'>Dados Salvos com sucesso!</font>");
		return "";
		} catch (Exception $e) {
		echo utf8_encode("<font color='red'>Dados não foram salvos com sucesso!</font>");
}

	
	
	

function valida_cpf( $cpf = false ) {
	if ( ! function_exists('calc_digitos_posicoes') )  {
		function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
			for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
				$soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );
				$posicoes--;
			}
			$soma_digitos = $soma_digitos % 11;
			if ( $soma_digitos < 2 ) {
				$soma_digitos = 0;
			} else {
				$soma_digitos = 11 - $soma_digitos;
			}
			$cpf = $digitos . $soma_digitos;
			return $cpf;
		}
	}
	$cpf_seque = array("00000000000", "11111111111", "22222222222", "33333333333", "44444444444", "55555555555", "66666666666", "77777777777", "88888888888", "99999999999"); 
	if ( in_array($cpf, $cpf_seque)  ) {
		return false;
	}
	if ( ! $cpf ) {
		return false;
	}
	$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
	if ( strlen( $cpf ) != 11 ) {
		return false;
	}	
	$digitos = substr($cpf, 0, 9);
	$novo_cpf = calc_digitos_posicoes( $digitos );
	$novo_cpf = calc_digitos_posicoes( $novo_cpf, 11 );
	if ( $novo_cpf === $cpf ) {
		return true;
	} else {
		return false;
	}
}	

   /**
     * Valida CNH
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    function validateCnh($value)
    {
        // Trecho retirado do respect validation

        $ret = false;

        if ((strlen($input = preg_replace('/[^\d]/', '', $value)) == 11)
            && (str_repeat($input[1], 11) != $input)
        ) {
            $dsc = 0;

            for ($i = 0, $j = 9, $v = 0; $i < 9; ++$i, --$j) {

                $v += (int)$input[$i] * $j;

            }

            if (($vl1 = $v % 11) >= 10) {

                $vl1 = 0;
                $dsc = 2;

            }

            for ($i = 0, $j = 1, $v = 0; $i < 9; ++$i, ++$j) {

                $v += (int)$input[$i] * $j;

            }

            $vl2 = ($x = ($v % 11)) >= 10 ? 0 : $x - $dsc;

            $ret = sprintf('%d%d', $vl1, $vl2) == substr($input, -2);
        }

        return $ret;
    }   

    /**
     * Valida Titulo de Eleitor
     * @param string $attribute
     * @param string $value
     * @return boolean
     */

    function validateTituloEleitor( $value){

        $input = preg_replace('/[^\d]/', '', $value);

        $uf = substr($input, -4, 2);

        if (((strlen($input) < 5) || (strlen($input) > 13)) || 
        (str_repeat($input[1], strlen($input)) == $input) || 
        ($uf < 1 || $uf > 28)) {
            return false;
        }

        $dv = substr($input, -2);
        $base = 2;

        $sequencia = substr($input, 0, -4);

        for ($i = 0; $i < 2; $i++) { 
            $fator = 9;
            $soma = 0;

            for ($j = (strlen($sequencia) - 1); $j > -1; $j--) { 
                $soma += $sequencia[$j] * $fator;

                if ($fator == $base) {
                    $fator = 10;
                }
                $fator--;
            }
            $digito = $soma % 11;
            if (($digito == 0) and ($uf < 3)) {
                $digito = 1;
            } elseif ($digito == 10) {
                $digito = 0;
            }
            if ($dv[$i] != $digito) {
                return false;
            }
            switch ($i) {
                case '0':
                    $sequencia = $uf . $digito;
                    break;
            }
        }
        return true;
    }	
	
	
function removerPonto($string){
	$pontuacao = array(";", "-", ".", " ");
	$vazio = array("", "", "", "");
	return str_replace($pontuacao, $vazio, $string);
}
 ?>
