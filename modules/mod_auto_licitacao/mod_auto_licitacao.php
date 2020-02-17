<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModAutoLicitacao::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_licitacao', $params->get('layout', 'default'));

?>