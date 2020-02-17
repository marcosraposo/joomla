<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = DemostrativoRelatorio::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_demostrativo_relatorio', $params->get('layout', 'default'));

?>