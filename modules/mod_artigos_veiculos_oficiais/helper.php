<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

use Joomla\Utilities\ArrayHelper;


abstract class ModArticlesLatestHelper
{

	public function getListaVeiculosTRF($params) {
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response = json_decode(json_encode($client->getRelacaoVeiculosTRF5()), True);

			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}

	public function getListaVeiculosSecoes($params) {
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response = json_decode(json_encode($client->getRelacaoVeiculosSecoesSubSecoes()), True);

			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}
	
	public static function getList(&$params) {
		$retorno = array();
		try {
			$retorno['veiculosTRF']    = self::getListaVeiculosTRF($params);
			$retorno['veiculosSecoes'] = self::getListaVeiculosSecoes($params);
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
		return $retorno;
	}

}
