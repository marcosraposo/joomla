<?php

class ModBuscaGuiadaConcursos {

  public function getDadosWebService($params, $arg0, $origem, $nivel) {
	 $response['params'] = $params;
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response['return'] = json_decode(json_encode($client->buscaGuiada()), True);
			return $response;
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
  }    

}