<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModNormas::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_normas', $params->get('layout', 'default'));

?>