<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';


$id = "";
if(!empty($_GET['/id'])){
	$id = $_GET['/id'];
}

$mod = "";
if(!empty($_GET['MOD'])){
	$mod = $_GET['MOD'];
}

$niveis = "";
if(!empty($_GET['niveis'])){
	$niveis = $_GET['niveis'];
}

$dados = ModResultadoHelper::getDadosWebService($params, $id, $mod, $niveis);

require JModuleHelper::getLayoutPath('mod_resultado', $params->get('layout', 'default'));

?>



