<?php

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

use Joomla\Utilities\ArrayHelper;

class ModPdfGrande{

public function getArtigoJoomla(&$params, $id)
	{
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
		$app       = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);
		$model->setState('load_tags', false);
		$items = $model->getItems();
		
		$bannersArtigo = array();
		foreach($model->getItems() as $artigo){
		//	if(in_array($artigo->catid, $params['catid']) ){
				if($artigo->id == $id){
				$data = new DateTime($artigo->created);
				$data_formatada= $data->format('d/m/Y H:i:s');
				 	$bannersArtigo = array(
						'titulo' => $artigo->title,
						'texto' => $artigo->introtext
					 );
				}
			//}
		}
		return $bannersArtigo;
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
				$dados = self::getArtigoJoomla($params, $id);
				$dados = (object) $dados;
				return $dados;

				} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $dados->return->noticia;
  }    
}