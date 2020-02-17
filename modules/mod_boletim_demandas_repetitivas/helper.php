<?php

defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

use Joomla\Utilities\ArrayHelper;


abstract class modBoletimDemandasRepetidas
{

	public static function getList(&$params) {
		try {
			$client   = new SoapClient($params->get('url_webservice'));
			$response = json_decode(json_encode($client->getBoletimDemandasRepetitivas()), True);
			return $response['return'];
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}

}
