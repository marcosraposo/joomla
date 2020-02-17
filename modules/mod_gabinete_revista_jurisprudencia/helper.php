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

abstract class ModGabineteRevistaJurisprudencia
{
	
	public function getList($params) {
	
	ini_set("soap.wsdl_cache_enabled", "0");
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response = json_decode(json_encode($client->getGabineteRevistasDetalhadas()), True);

			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}
}
