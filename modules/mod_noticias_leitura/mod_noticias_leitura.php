<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$id = "";
if(!empty($_GET['/id'])){
	$id = $_GET['/id'];
}

$tipoNoticia = "";
if(!empty($_GET['tipoNoticia'])){
	$tipoNoticia = $_GET['tipoNoticia'];
}

$dados = ModNoticiasLeitura::getDadosWebService($params, $id, $tipoNoticia);

require JModuleHelper::getLayoutPath('mod_noticias_leitura', $params->get('layout', 'default'));

?>