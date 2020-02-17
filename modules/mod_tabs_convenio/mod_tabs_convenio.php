<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModTabsConveniosHelper::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_tabs_convenio', $params->get('layout', 'default'));

?>