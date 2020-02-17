<?php

class ModTabsCotacaoEletronicaHelper {

  private function getDadosTeste() {
    return [
      [
        'ano' => '2018', 
        'Titulo' => 'Teste 01'
      ],
      [
        'ano' => '2018', 
        'Titulo' => 'Teste 02'
      ]
    ];
  }

  public function getDadosWebService($params) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
      'dados' => self::getDadosTeste(),
    ];
	
	//$aaa[0] =  array( "ano"  => "2017", "processo" => "processo", "pregao" => "pregao", "ata" => "ata", "orgao" => "orgao", "fornecedor" => "fornecedor", "cnpj" => "cnpj", "objeto" => "objeto", "valor" => "valor", "nota" => "nota", "dados" => "dados" );
	//$aaa[1] =  array( "ano"  => "2017", "processo" => "processo1", "pregao" => "pregao1", "ata" => "ata1", "orgao" => "orgao1", "fornecedor" => "fornecedor1", "cnpj" => "cnpj1", "objeto" => "objeto1", "valor" => "valor1", "nota" => "nota1", "dados" => "dados1" );
	//$aaa[2] =  array( "ano"  => "2018", "processo" => "processo2", "pregao" => "pregao2", "ata" => "ata2", "orgao" => "orgao2", "fornecedor" => "fornecedor2", "cnpj" => "cnpj2", "objeto" => "objeto2", "valor" => "valor2", "nota" => "nota2", "dados" => "dados2" );
	//$dados["lista"] = $aaa;
	//$dados
	//return $dados;
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($params->get('url_webservice'));
		
			$responseCotacao = json_decode(json_encode($client->getCotacoesEletronicas()), True);
			$responseInformacao = json_decode(json_encode($client->getInfoComplementarCotacoes()), True);
		
			$dados["lista"] = $responseCotacao;
			$dados["listaInfo"] = $responseInformacao;
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    

  
  
}