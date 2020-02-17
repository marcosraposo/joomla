<?php

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

use Joomla\Utilities\ArrayHelper;

class ModNoticiasLeitura{
	public function getBannerJoomla(&$params, $id)
	{
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
		$app       = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);
		$model->setState('load_tags', false);
		$items = $model->getItems();
		
		$bannersJoomla = array();
		foreach($model->getItems() as $artigo){
			if(in_array($artigo->catid, $params['catid']) ){
				if($artigo->id == $id){
				$data = new DateTime($artigo->created);
				$data_formatada= $data->format('d/m/Y H:i:s');
				 	$bannersJoomla = array(
						'url' => $artigo->images,
						'texto' => $artigo->introtext,
						'data_formatada' => $data_formatada,
						'autor' => $artigo->author,
						'subtitulo' => '',
						'titulo' => $artigo->title,
						'linkNoticia' => $artigo->id
					 );
				}
			}
		}
		return $bannersJoomla;
	}


  public function getDadosWebService($params, $id, $tipoNoticia) {
	 $dados["dados"] = [
      'titulo_tab_1' => $params->get('titulo_tab_1'),
      'titulo_tab_2' => $params->get('titulo_tab_2'),
      'titulo_tab_3' => $params->get('titulo_tab_3'),
      'titulo_box_1' => $params->get('titulo_box_1'),
      'titulo_box_2' => $params->get('titulo_box_2'),
      'titulo_box_3' => $params->get('titulo_box_3'),
	  'tipoNoticia' => $tipoNoticia,
	  'idNoticias' => $id,
    ];
		try {
		
			if(!empty($tipoNoticia) && $tipoNoticia == 'artigo'){
				$dados = self::getBannerJoomla($params, $id);
				$dados = (object) $dados;
				return $dados;
			}else{
				ini_set("soap.wsdl_cache_enabled", "0");
				ini_set('soap.wsdl_cache_ttl', 900);
				ini_set('default_socket_timeout', 15);
				$client = new SoapClient($params->get('url_webservice'));
				$arguments = array('getNoticiaById' => array('idNoticia' => $id));
				$dados = $client->__soapCall("getNoticiaById", $arguments ); 
			}

		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados->return->noticia;
  }    
}