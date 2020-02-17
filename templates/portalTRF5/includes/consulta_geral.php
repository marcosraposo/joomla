<?php

require('functions.php');

$linhas  = !empty($_GET['linhas']) ? $_GET['linhas'] : 10;
$ordenar = !empty($_POST['ordenar']) ? $_POST['ordenar'] : 'ASC';
$termo   = $_POST['termo'];
$retorno = buscaGeral($termo, $linhas, $ordenar );

echo json_encode($retorno);