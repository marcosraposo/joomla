<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModAutoInfoComp::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_info_comp', $params->get('layout', 'default'));

?>