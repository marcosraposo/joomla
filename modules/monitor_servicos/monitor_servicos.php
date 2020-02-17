<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$categoria = "";
if(!empty($_GET['/categoria'])){
	$categoria = $_GET['/categoria'];
}

$ano = "";
if(!empty($_GET['ano'])){
	$ano = $_GET['ano'];
}

$mes = "";
if(!empty($_GET['mes'])){
	$mes = $_GET['mes'];
}

$nomeServico = "";
if(!empty($_GET['nomeServico'])){
	$nomeServico = $_GET['nomeServico'];
}
$dados = MonitorServicos::getMonitorServicos($params, $categoria, $ano, $mes, $nomeServico);

require JModuleHelper::getLayoutPath('monitor_servicos', $params->get('layout', 'default'));

?>