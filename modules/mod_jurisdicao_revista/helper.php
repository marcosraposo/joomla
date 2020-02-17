<?php

class ModJurisdicaoRevista{

  public function getDadosWebService($params) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3')
    ];
	
	
		ini_set("soap.wsdl_cache_enabled", "0");
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			// $response = json_decode(json_encode($client->getGabineteRevistas()), True);
			$response = json_decode(json_encode($client->getGabineteRevistasDetalhadas()), True);
			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    

  
  
}