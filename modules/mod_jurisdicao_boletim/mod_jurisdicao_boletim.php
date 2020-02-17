<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$list = ModJurisdicaoBoletins::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_jurisdicao_boletim', $params->get('layout', 'default'));

?>