<?php
class MonitorServicos{
  public function getMonitorServicos($params, $categoria, $ano, $mes, $nomeServico) {
	$dados["params"] = $params;
	 
	ini_set("soap.wsdl_cache_enabled", "0");
	ini_set('soap.wsdl_cache_ttl', 900);
	ini_set('default_socket_timeout', 15);

	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$response1 = json_decode(json_encode($client->bannersHome()), True);
		$dados["servico"][0]['nome'] = "Serviços de Banner Carrocel";
		$dados["servico"][0]['estado'] = "S";
	} catch (Exception $e) {
		$dados["servico"][0]['nome'] = "Serviços de Banner Carrocel";
		$dados["servico"][0]['estado'] = "N";
	}

	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$response1 = json_decode(json_encode($client->getConvenioSistema()), True);
		$dados["servico"][1]['nome'] = "Serviços dos Convênios";
		$dados["servico"][1]['estado'] = "S";
	} catch (Exception $e) {
		$dados["servico"][1]['nome'] = "Serviços dos Convênios";
		$dados["servico"][1]['estado'] = "N";
	}
	
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$response1 = json_decode(json_encode($client->getConcursosNomeacoes()), True);
		$dados["servico"][2]['nome'] = "Concurso e Nomeações";
		$dados["servico"][2]['estado'] = "S";
	} catch (Exception $e) {
		$dados["servico"][2]['nome'] = "Concurso e Nomeações";
		$dados["servico"][2]['estado'] = "N";
	}
	
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$arguments = array('buscaGuiada' => array('arg0' => 'portal-da-transparencia', 'origem' => '0', 'nivel' => '1', 'params' => '0', 'title' => '0'));
		$arguments = $client->__soapCall("buscaGuiada", $arguments); 
		$dados["servico"][3]['nome'] = "Busca Guiada Portal da Transparência";
		$dados["servico"][3]['estado'] = "S";
	} catch (Exception $e) {
		$dados["servico"][3]['nome'] = "Busca Guiada Portal da Transparência";
		$dados["servico"][3]['estado'] = "N";
	}
	
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$parametros = array('consultaProcesso' => array(
		  'criterio' => 'porNumero',
		  'termo' => '08049151920194050000',
		  'ordenar' => 'false'
		));
		$method = $client->__soapCall('consultaProcesso', $parametros);
		$response = json_decode(json_encode($method), True);
		if($response['return'] == 'error'){
			$dados["servico"][4]['nome'] = "Consulta Processual - CP Unificado";
			$dados["servico"][4]['estado'] = "N";
		}else{
			$dados["servico"][4]['nome'] = "Consulta Processual - CP Unificado";
			$dados["servico"][4]['estado'] = "S";
		}
	} catch (Exception $e) {
		$dados["servico"][4]['nome'] = "Consulta Processual - CP Unificado";
		$dados["servico"][4]['estado'] = "N";
	}
	
	
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$parametros = array('consultaDadosProcesso' => array(
		  'orgao' => 'TRF5',
		  'sistema' => 'PJE',
		  'numero' => '0804915-19.2019.4.05.0000'
		));
		$method = $client->__soapCall('consultaDadosProcesso', $parametros);
		$response = json_decode(json_encode($method), True);
		if($response['return'] == 'error'){
			$dados["servico"][5]['nome'] = "Consulta Processual - CP Unificado - Dados do Processo";
			$dados["servico"][5]['estado'] = "N";
		}else{
			$dados["servico"][5]['nome'] = "Consulta Processual - CP Unificado - Dados do Processo";
			$dados["servico"][5]['estado'] = "S";
		}
	} catch (Exception $e) {
		$dados["servico"][5]['nome'] = "Consulta Processual - CP Unificado - Dados do Processo";
		$dados["servico"][5]['estado'] = "N";
	}

	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$parametros = array('buscaElastica' => array(
		  'termo' => 'trf5',
		  'linhas' => '10',
		  'ordenador' => 'asc'
		));
		$method = $client->__soapCall('buscaElasticaPortal', $parametros);
		$response = json_decode(json_encode($method), True);
		if(empty($response['return']['retornoBusca']['hits'])){
			$dados["servico"][6]['nome'] = "Busca Elástica Notícias";
			$dados["servico"][6]['estado'] = "N";
		}else{
			$dados["servico"][6]['nome'] = "Busca Elástica Notícias";
			$dados["servico"][6]['estado'] = "S";
		}
	} catch (Exception $e) {
		$dados["servico"][6]['nome'] = "Busca Elástica Notícias";
		$dados["servico"][6]['estado'] = "N";
	}
	
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$parametros = array('buscaElasticaPortal' => array(
		  'termo' => 'trf5',
		  'linhas' => '10',
		  'ordenador' => 'asc'
		));
		$method = $client->__soapCall('buscaElasticaPortal', $parametros);
		$response = json_decode(json_encode($method), True);
		if(empty($response['return']['retornoBusca']['hits'])){
			$dados["servico"][7]['nome'] = "Busca Elástica do Portal no Joomla";
			$dados["servico"][7]['estado'] = "N";
		}else{
			$dados["servico"][7]['nome'] = "Busca Elástica do Portal no Joomla";
			$dados["servico"][7]['estado'] = "S";
		}
	} catch (Exception $e) {
		$dados["servico"][7]['nome'] = "Busca Elástica do Portal no Joomla";
		$dados["servico"][7]['estado'] = "N";
	}
		
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$parametros = array('getNoticiasPaginadas' => array(
		  'dataInicio' => '01/01/2010',
		  'dataFim' => '01/01/2019',
		  'texto' => 'dica cultural', 
		  'limiteNoticiasPagina' => '10',
		 'pagina' => '1'
		));
		$method = $client->__soapCall('getNoticiasPaginadas', $parametros);
		json_decode(json_encode($method), True);
		$dados["servico"][8]['nome'] = "Busca de Notícias Paginado";
		$dados["servico"][8]['estado'] = "S";
	} catch (Exception $e) {
		$dados["servico"][8]['nome'] = "Busca de Notícias Paginado";
		$dados["servico"][8]['estado'] = "N";
	}
		
	try {
		$client = new SoapClient($params->get('servico_url_1'));
		$arguments = array('getLegislacaoInstitucionalPDF' => array('arg0' => '55883'));
		$result = $client->__soapCall("getLegislacaoInstitucionalPDF", $arguments ); 
		$restultado = json_decode(json_encode($result), True);
		$dados["servico"][9]['nome'] = "Serviços de PDFs do UPLOADER";
		$dados["servico"][9]['estado'] = "S";
	} catch (Exception $e) {
		$dados["servico"][9]['nome'] = "Serviços de PDFs do UPLOADER";
		$dados["servico"][9]['estado'] = "N";
	}
	return $dados;
  }    
}