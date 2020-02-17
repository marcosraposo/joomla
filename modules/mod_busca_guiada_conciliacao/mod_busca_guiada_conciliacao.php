<?php

defined('_JEXEC') or die;
//echo ",,";
require_once dirname(__FILE__) . '/helper.php';

$nivel = (!empty($_GET['nivel']))? $_GET['nivel'] : "1" ;
$arg0 = (!empty($_GET['arg0']))? $_GET['arg0'] : "portal-da-transparencia";
$origem = (!empty($_GET['origem']))? $_GET['origem'] : "1";

/*	$WService  = (!empty($_GET['WService']))? urldecode($_GET['WService']) : "" ;
	$nivel = (!empty($_GET['nivel']))? $_GET['nivel'] : "0" ;
	$arg0 = (!empty($_GET['arg0']))? $_GET['arg0'] : "portal-da-transparencia";
	$origem = (!empty($_GET['origem']))? $_GET['origem'] : "1";
	$params = (!empty($_GET['params']))? $_GET['params'] : "0";
	$tituloNiveis = (!empty($_GET['tituloNiveis']))? $_GET['tituloNiveis'] : "0";
	$sentido = (!empty($_GET['sentido']))? $_GET['sentido'] : "avancar";*/

$dados = ModBuscaGuiadaConciliacao::getDadosWebService($params, $arg0, $origem, $nivel);

require JModuleHelper::getLayoutPath('mod_busca_guiada_conciliacao', $params->get('layout', 'default'));

?>



