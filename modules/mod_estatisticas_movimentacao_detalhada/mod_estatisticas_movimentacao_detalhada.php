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

$dados = ModMovDetalhada::getDadosWebService($params, $categoria, $ano, $mes);

require JModuleHelper::getLayoutPath('mod_estatisticas_movimentacao_detalhada', $params->get('layout', 'default'));

?>