<?php

function getNoticiasPaginada($dataInicio, $dataFim, $texto, $limite, $pagina) {
  try {

    //$client = new SoapClient('http://localhost:8087/feeder2/FeedService?wsdl');
    $client = new SoapClient('http://feeder.trf5.gov.br/feeder2/FeedService?wsdl');

    $parametros = array('getNoticiasPaginadas' => array(
      'dataInicio' => $dataInicio,
      'dataFim' => $dataFim,
      'texto' => $texto, 
      'limiteNoticiasPagina' => $limite,
	 'pagina' => $pagina
    ));
	
    $method = $client->__soapCall('getNoticiasPaginadas', $parametros);

    $response = json_decode(json_encode($method), True);
    $noticias = $response['return'];
	
	/*if(isset($response['return'])){
		exit;
	}*/

	$i = 0;
	
	foreach($noticias['listaNoticias'] as $lista){
		if(isset($lista['texto'])){
			$texto = str_replace($lista['texto'], '"', '');
			$noticias['listaNoticias'][$i]['texto'] =  strip_tags(html_entity_decode($lista['texto']));
		$i++;
		}

	}
    return $noticias;
  } catch (Exception $e) {
    //echo "Erro ao consumir WebService!";
  }
}