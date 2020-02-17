<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModTabsCotacaoEletronicaHelper::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_tabs_cotacao_eletronica', $params->get('layout', 'default'));

?>