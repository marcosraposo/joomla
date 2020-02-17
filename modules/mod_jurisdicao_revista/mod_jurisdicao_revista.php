<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$list = ModJurisdicaoRevista::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_jurisdicao_revista', $params->get('layout', 'default'));

?>