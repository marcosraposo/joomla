<?php

class ModTutoriais{

  public function getDadosWebService($params) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
	  'nome_servico' => $params->get('nome_servico')
	  ];
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			
			$client = new SoapClient($params->get('url_webservice'));
			
			$getTutoriaisPJE = json_decode(json_encode($client->getTutoriaisPJE()), True);

			$dados["tutoriaisPJE"] = $getTutoriaisPJE['return'];	

			$dados["params"] = $params;

		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    

  
  
}