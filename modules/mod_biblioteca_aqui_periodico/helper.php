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


abstract class ModBibliotecaPeriodico
{
public function getList($params, $pagina, $limite) {
	
			ini_set("soap.wsdl_cache_enabled", "0");
			ini_set('soap.wsdl_cache_ttl', 900);
			ini_set('default_socket_timeout', 15);
		try {
			$client = new SoapClient($params->get('url_webservice'));

			$arguments = array('getNovaAquisicaoPeriodico' => array('limiteRegistro' => $limite, 'pagina' => $pagina));
			$limiteRegistro = $client->__soapCall("getNovaAquisicaoPeriodico", $arguments ); 
			$limiteRegistro = json_decode(json_encode($limiteRegistro), True);
		
			$limiteRegistro['pagina'] = $pagina;
			$limiteRegistro['limite'] = $limite;
			return $limiteRegistro;
		} catch (Exception $e) {
			echo "Erro ao consumir WebService!";
		}
	}
}
