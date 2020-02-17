<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ProjetosEspeciais::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_projetos_especiais', $params->get('layout', 'default'));

?>