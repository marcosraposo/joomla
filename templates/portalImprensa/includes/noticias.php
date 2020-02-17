<?php 

require('functions.php');

$texto      = isset($_POST['txtTextoPesquisa']) ? $_POST['txtTextoPesquisa'] : "";
$dataInicio = isset($_POST['txtDataInicio']) ? $_POST['txtDataInicio'] : "";
$dataFim    = isset($_POST['txtDataFim']) ? $_POST['txtDataFim'] : "";
$limite     = isset($_POST['limite']) ? $_POST['limite'] : 0;
$pagina    =  isset($_POST['pagina']) ? $_POST['pagina'] : 0;

if (!empty($texto)) {
  $limite = 0;
} else {
  $limite = $_POST['limite'];
}

$retorno = getNoticiasPaginada($dataInicio, $dataFim, $texto, $limite, $pagina);

if (empty($retorno['listaNoticias'])) {
  $retorno['listaNoticias'] = [];
}

echo json_encode($retorno);

