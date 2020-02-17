<?php

require('functions.php');

$termo    = $_POST['termo'];
$criterio = $_POST['criterio'];
$ordenar = $_POST['ordenar'];
$estado   = isset($_POST['estado']) ? $_POST['estado'] : "";

function tiraAcento( $str ) { 
	$str = strtr(utf8_decode($str),utf8_decode("ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'#@$%&!*()_+{?}><,.;:/][=-\|"),"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy                            ");
	$str = preg_replace('/( )+/', ' ', $str);   // remove espaço duplos
	return trim($str) ;
}

$termo =  tiraAcento( $termo );

if (!empty($estado)) {
  $termoOab = $estado.$termo;
  $retorno = consultaProcesso($criterio, $termoOab);
} else {
  $retorno = consultaProcesso($criterio, $termo, $ordenar );
}
echo $retorno;