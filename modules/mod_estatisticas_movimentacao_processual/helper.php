<?php

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

use Joomla\Utilities\ArrayHelper;


abstract class ModArticlesLatestHelper
{

	public function getListaVara($params) {
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response = json_decode(json_encode($client->getEstatisticaProcessuaisPrimeiroGrauVara()), True);
			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}

	public function getListaSecoes($params) {
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response = json_decode(json_encode($client->getEstatisticaProcessuaisPrimeiroGrauSecoes()), True);
			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}
	
	public static function getList(&$params) {
		$retorno = array();
		try {
			$retorno['varas']   = self::getListaVara($params);
			$retorno['secoes'] = self::getListaSecoes($params);
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $retorno;
	}
}