<?php 

require('functions.php');

$orgao   = $_GET['orgao'];
$sistema = $_GET['sistema'];
$numero  = $_GET['numero'];

$retorno = consultaDadosProcesso($orgao, $sistema, $numero);

echo $retorno;