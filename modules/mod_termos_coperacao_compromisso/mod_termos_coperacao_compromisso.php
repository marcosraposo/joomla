<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModTermosCoperacaoCompromisso::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_termos_coperacao_compromisso', $params->get('layout', 'default'));

?>