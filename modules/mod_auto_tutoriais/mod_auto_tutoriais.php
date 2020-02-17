<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModTutoriais::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_auto_tutoriais', $params->get('layout', 'default'));

?>