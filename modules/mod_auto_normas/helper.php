<?php

class ModNormas{

  public function getDadosWebService($params) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
	  'getNormaAtoPJE' => $params->get('getNormaAtoPJE'),
	  'getNormaLeiPJE' => $params->get('getNormaLeiPJE'),
	  'getNormaPortariaPJE' => $params->get('getNormaPortariaPJE'),
	  'getNormaProvimentoPJE' => $params->get('getNormaProvimentoPJE'),
	  'getNormaResolucaoPJE' => $params->get('getNormaResolucaoPJE')
	  ];
	
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			ini_set('soap.wsdl_cache_ttl', 900);
			ini_set('default_socket_timeout', 15);
			
			$client = new SoapClient($params->get('url_webservice'));

			$responseAto = json_decode(json_encode($client->getNormaAtoPJE()), True);
			$responseLei = json_decode(json_encode($client->getNormaLeiPJE()), True);
			$responsePortaria = json_decode(json_encode($client->getNormaPortariaPJE()), True);
			$responseProvimento = json_decode(json_encode($client->getNormaProvimentoPJE()), True);
			$responseResolucao = json_decode(json_encode($client->getNormaResolucaoPJE()), True);
				
			$dados["responseAto"] = $responseAto['return'];	
			$dados["responseLei"] = $responseLei['return'];	
			$dados["responsePortaria"] = $responsePortaria['return'];	
			$dados["responseProvimento"] = $responseProvimento['return'];
			$dados["responseResolucao"] = $responseResolucao['return'];	
			
			$dados["params"] = $params;

		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    

  
  
}