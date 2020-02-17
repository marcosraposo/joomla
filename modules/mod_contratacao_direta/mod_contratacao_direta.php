<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModContratacaoDireta::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_contratacao_direta', $params->get('layout', 'default'));

?>