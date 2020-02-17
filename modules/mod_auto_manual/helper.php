<?php

class ModManuais{

  public function getDadosWebService($params) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
	  'nomeServico' => $params->get('nomeServico'),
	  'servico_pdf' => $params->get('servico_pdf')

 
    ];
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($params->get('url_webservice'));
			
			if($dados["dados"]['nomeServico'] == "getManualAdvogadoPJE"){
				$response = json_decode(json_encode($client->getManualAdvogadoPJE()), True);
			}
			if($dados["dados"]['nomeServico'] == "getManualServidorPJE"){
				$response = json_decode(json_encode($client->getManualServidorPJE()), True);
			}
			if($dados["dados"]['nomeServico'] == "getManualMagistradoPje"){
				$response = json_decode(json_encode($client->getManualMagistradoPje()), True);
			}
			
			$dados["manual"] = $response['return'];
			$dados["params"] = $params;

		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		//var_dump($response);
		return $dados;
  }    
}