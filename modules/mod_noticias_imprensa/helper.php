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

/**
 * Helper for mod_articles_latest
 *
 * @since  1.6
 */
abstract class ModArticlesLatestHelper
{
	
	public static function getList(&$params) {
		try {

			$client = new SoapClient($params->get('url_webservice'));

			$parametros = array('getNoticiasPaginadas' => array(
				'dataInicio' => '',
				'dataFim' => '',
				'texto' => '', 
				'limiteNoticiasPagina' => '',
				'pagina' => '0'
			
			));

			$method = $client->__soapCall('getNoticiasPaginadas', $parametros);

			$response = json_decode(json_encode($method), True);
			$noticias = $response['return'];

			return $noticias;

		} catch (Exception $e) {
			//echo "Erro ao consumir WebService!";
		}
	}

}
