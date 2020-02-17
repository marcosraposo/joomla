<?php

require('functions.php');

$linhas  = !empty($_GET['linhas']) ? $_GET['linhas'] : 10;
$termo   = $_POST['termo'];
$retorno = buscaGeralJoomla($termo, $linhas);

echo json_encode($retorno);