<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModManuais::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_manual', $params->get('layout', 'default'));

?>