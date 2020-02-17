<?php

class ModMovDetalhada{

  public function getDadosWebService($params, $categoria, $ano, $mes) {
	 $dados["params"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
	  'nomeServico' => $params->get('nomeServico'),
	  'servico_pdf' => $params->get('servico_pdf'),
	  'aba02' => $params->get('aba02'),
	  'categoria' => $categoria,
	  'ano' => $ano,
	  'mes' => $mes
    ];
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");

			$client = new SoapClient($params->get('url_webservice'));

$categoria = "Estatistica Corregedoria";
			
				if(!empty($categoria) && !empty($ano)  && !empty($mes)  ){
					$responseDetalhada = array('getEstatisticaCorregedoriaDetalhada' => array('categoria' => $categoria, 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getEstatisticaCorregedoriaDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}
				
				$arguments = json_decode(json_encode($client->getEstatisticaCorregedoria()), True);

				$result = json_decode(json_encode($arguments), True);
				//echo "<pre>";
				//var_dump($result['return']['estatisticaCorregedoria']['estatisticaCorregedoria']);
				//echo "</pre>";

				$dados['dados'] = (empty($result['return']['estatisticaCorregedoria']['estatisticaCorregedoria']))? "" : $result['return']['estatisticaCorregedoria']['estatisticaCorregedoria'];
			

			
			
			
			
			
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    
}