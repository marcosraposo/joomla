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

	public static function getAtividadeDocenciaMagistrados(&$params) {
		if ($params->get('url_webservice') != "") {
			try {

				$client = new SoapClient($params->get('url_webservice'));
	
				$response = json_decode(json_encode($client->getAtividadeDocenciaMagistrados()), True);
				$items    = $response['return'];

				return $items;
	
			} catch (Exception $e) {
				//echo "Erro ao consumir WebService!";
			}
		}
	}

	public static function getAtividadeMagistradosNaoDocente(&$params) {
		if ($params->get('url_webservice') != "") {
			try {

				$client = new SoapClient($params->get('url_webservice'));
	
				$response = json_decode(json_encode($client->getAtividadeMagistradosNaoDocente()), True);
				$items    = $response['return'];

				return $items;
	
			} catch (Exception $e) {
				//echo "Erro ao consumir WebService!";
			}
		}
	}

	public static function getList(&$params) {
		try {
			$retorno['listaDocentes']    = self::getAtividadeDocenciaMagistrados($params)['docenciaMagistrado'];
			$retorno['listaNaoDocentes'] = self::getAtividadeMagistradosNaoDocente($params)['docenciaMagistrado'];

			return $retorno;

		} catch (Exception $e) {
			//echo "Erro ao consumir WebService!";
		}
	}

}