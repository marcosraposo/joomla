<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModProdIntelectualDes::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_prod_intelectual', $params->get('layout', 'default'));

?>