<?php 
$servico = urldecode($_GET['sv']);
$ano = $_GET['ano'];




		try {
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($servico);
			$arguments = array('getJornalMural' => array('ano' => $ano));
			$list = $client->__soapCall("getJornalMural", $arguments); 
		} catch (Exception $e) {
			$nivel = "resultado";
		}

$ultimaData = "";
	foreach($list->return as $mes){
		foreach($mes->listaMesAno as $dias){
				if(!empty($dias->url) && $dias->url != ""){
					$ultimaData = $dias->dataPublicacao;
				}
		}
	}
	
	?>
	 <div class="row" id="dataAtualizacao"><small>Última atualização: <?php echo $ultimaData;?></small></div>






