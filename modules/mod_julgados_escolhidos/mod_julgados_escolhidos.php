<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModJulgadosEscolhidos::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_julgados_escolhidos', $params->get('layout', 'default'));

?>