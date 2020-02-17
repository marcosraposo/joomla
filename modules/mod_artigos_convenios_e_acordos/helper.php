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

		$retorno = array();

		try {

			$client = new SoapClient($params->get('url_webservice'));
			
			
			$function = 'envioUltimasNoticiasPortalTransparencia';
			$arguments= array('envioUltimasNoticiasPortalTransparencia' => array(
                        'arg0'   => $params->get('categoria')));
			
			$result = $client->__soapCall($function, $arguments);
						

			$response = json_decode(json_encode($result), True);
						
			$items    = $response['return'];

			for ($i = 0; $i < 6; $i++) { 
				$retorno[$i] = $items[$i];
			}

		} catch (Exception $e) {
			//echo "Erro ao consumir WebService!";
		}

		return $retorno;
	}

}
