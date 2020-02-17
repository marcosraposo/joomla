<?php
class ModAutoBox{
  public function getDadosWebService($params, $categoria, $ano, $mes, $nomeServico) {
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
	  'mes' => $mes,
    ];
	
		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($params->get('url_webservice'));
			$nomeServico = (empty($nomeServico))? $dados["params"]['nomeServico'] : $nomeServico;
			if($nomeServico == 'getLegislacaoInstitucional'){
				$responseMenu = json_decode(json_encode($client->getLegislacaoListaMenu()), True);
				$dados['menu'] = $responseMenu['return'];
				if(!empty($categoria) && !empty($ano)  && !empty($mes)  ){
					$responseDetalhada = array('getLegislacaoInstitucionalDetalhada' => array('categoria' => $categoria, 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getLegislacaoInstitucionalDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}

				$arguments = array('getLegislacaoInstitucional' => array('categoria' => $categoria));
				$arguments = $client->__soapCall("getLegislacaoInstitucional", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				$dados['dados'] = (empty($result['return']['legislacao']['legislacao']))? "" : $result['return']['legislacao']['legislacao'];
				
			}else if($nomeServico == 'getLegislacaoCjfInstitucional'){
				$responseMenu = json_decode(json_encode($client->getLegislacaoCjfListaMenu()), True);
				$dados['menu'] = $responseMenu['return'];
					
				if(!empty($categoria) && !empty($ano)  && !empty($mes)  ){
					$responseDetalhada = array('getLegislacaoCjfInstitucionalDetalhada' => array('categoria' => $categoria, 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getLegislacaoCjfInstitucionalDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}

				$arguments = array('getLegislacaoCjfInstitucional' => array('categoria' => $categoria));
				$arguments = $client->__soapCall("getLegislacaoCjfInstitucional", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				if(!empty($result['return']['legislacao']['legislacao']) && strstr($categoria, 'CJF')){
					$dados['dados'] =  $result['return']['legislacao']['legislacao'];
				}
			}else if($dados["params"]['nomeServico'] == 'getCorregedoriaAtosAdministrativos'){
				$responseMenu = json_decode(json_encode($client->getCorregedoriaAtosAdministrativoMenu()), True);
				$dados['menu'] = $responseMenu['return'];
				if(!empty($categoria) && !empty($ano)  && !empty($mes)  ){
					$responseDetalhada = array('getCorregedoriaAtosAdministrativosDetalhada' => array('categoria' => $categoria, 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getCorregedoriaAtosAdministrativosDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}

				$arguments = array('getCorregedoriaAtosAdministrativos' => array('categoria' => $categoria));
				$arguments = $client->__soapCall("getCorregedoriaAtosAdministrativos", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				if(!empty($result['return']['atosAdministrativos']['corregedoriaAtosAdministrativos'])){
					$dados['dados'] = $dados['dados'] = $result['return']['atosAdministrativos']['corregedoriaAtosAdministrativos'];
				}
				
			}else if($dados["params"]['nomeServico'] == 'getCorregedoriaDecisoes'){
				$responseMenu = json_decode(json_encode($client->getCorregedoriaDecisoesMenu()), True);
				$dados['menu'] = $responseMenu['return'];
				if(!empty($categoria) && !empty($ano)  && !empty($mes)  ){
					$responseDetalhada = array('getDecisoesDetalhada' => array('categoria' => $categoria, 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getDecisoesDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}

				$arguments = array('getCorregedoriaDecisoes' => array('categoria' => $categoria));
				$arguments = $client->__soapCall("getCorregedoriaDecisoes", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				if(!empty($result['return']['atosAdministrativos']['corregedoriaAtosAdministrativos'])){
					$dados['dados'] = $result['return']['atosAdministrativos']['corregedoriaAtosAdministrativos'];
				}
				
			}else if($nomeServico == 'getLegislacaoCorregedoriaInstitucional'){
				$responseMenu = json_decode(json_encode($client->getLegislacaoCorregedoriaListaMenu()), True);
				$dados['menu'] = $responseMenu['return'];
				if(!empty($categoria) && !empty($ano)  && !empty($mes)  ){
					$responseDetalhada = array('getLegislacaoCorregedoriaDetalhada' => array('categoria' => $categoria, 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getLegislacaoCorregedoriaDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}

				$arguments = array('getLegislacaoCorregedoriaInstitucional' => array('categoria' => $categoria));
				$arguments = $client->__soapCall("getLegislacaoCorregedoriaInstitucional", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				if(!empty($result['return']['legislacao']['legislacao'])){
					$dados['dados'] = $result['return']['legislacao']['legislacao'];
				}
				
			}else if($dados["params"]['nomeServico'] == 'getCorregedoriaInstitucional'){
				$responseMenu = json_decode(json_encode($client->getCorregedoriaInstitucional()), True);
				$dados['menu'] = $responseMenu['return'];
				
				$arguments = array('getCorregedoriaInstitucional' => array('categoria' => $categoria));
				$arguments = $client->__soapCall("getCorregedoriaInstitucional", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				$dados['dados'] = $result['return'][0]['legislacao']['legislacao'];
				
			}else if($dados["params"]['nomeServico'] == 'getConselhoAdministracaoInstitucional'){
				$dados['menu'] = null;
				if( !empty($ano)  && !empty($mes)  ){
					$dados['params']['categoria'] = "Legislacao Conselho Adm Decisoes";
					$responseDetalhada = array('getConselhoAdministracaoInstitucionalDetalhada' => array('categoria' => 'Legislacao Conselho Adm Decisoes', 'mes' => $mes, 'ano' => $ano));
					$responseDetalhada = $client->__soapCall("getConselhoAdministracaoInstitucionalDetalhada", $responseDetalhada ); 
					$resultDetalhada = json_decode(json_encode($responseDetalhada), True);
					$dados['dadosDetalhado'] = (empty($resultDetalhada['return']))? "" : $resultDetalhada['return'];
				}

				$arguments = array('getConselhoAdministracaoInstitucional' => array('categoria' => 'Legislacao Conselho Adm Decisoes'));
				$arguments = $client->__soapCall("getConselhoAdministracaoInstitucional", $arguments ); 
				$result = json_decode(json_encode($arguments), True);
				$dados['dados'] = $result['return']['legislacao']['legislacao'];
			}

		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados;
  }    
}