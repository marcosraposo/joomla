<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$dados = ModBoletinsAdministrativos::getDadosWebService($params);

require JModuleHelper::getLayoutPath('mod_artigos_boletins_adm', $params->get('layout', 'default'));

?>