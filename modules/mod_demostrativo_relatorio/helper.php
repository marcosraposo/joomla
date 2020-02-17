<?php

class DemostrativoRelatorio{

  public function getDadosWebService($params) {
	 $dados["dados"] = [
      'url_webservice' => $params->get('url_webservice'),
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3')
    ];
    
	ini_set("soap.wsdl_cache_enabled", "0");
	ini_set('soap.wsdl_cache_ttl', 900);
	ini_set('default_socket_timeout', 15);
	$client = new SoapClient($params->get('url_webservice'));
	$response = json_decode(json_encode($client->getRelatorioDemonstrativoGestaoOrcamentaria()), True);

	$dados["distribuicaoOrcamentaria"] = $response['return'];			
				
	return $dados;
  }

  
  
}