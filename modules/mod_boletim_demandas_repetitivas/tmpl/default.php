<?php
include_once 'func.php';

$i = 0;
$i2 = 0;
$array_teste = array();
foreach ($listaBoletins as $list1) {

    foreach ($list1['meses'] as $meses) {

        if (empty($meses['dataAtualizacao'])) {
            $meses = $list1['meses'];
        }

        if (!empty($meses['anexos'])) {

            foreach ($meses['anexos'] as $anexo) {

                if (empty($anexo['dataAtualizacao'])) {
                    $anexo = $meses['anexos'];
                }

                $dataQ = explode("/", $anexo['dataPublicacao']);

                $dados['dadosTratado'][$i]['dataAtualizacao'] = $anexo['dataAtualizacao'];
                $dados['dadosTratado'][$i]['dataPublicacao'] = $anexo['dataPublicacao'];
                $dados['dadosTratado'][$i]['descricao'] = $anexo['descricao'];
                $dados['dadosTratado'][$i]['id_doc'] = $anexo['id'];
                $dados['dadosTratado'][$i]['dataNum'] = $dataQ[2] . $dataQ[1] . $dataQ[0];
                $dados['dadosTratado'][$i]['ano'] = $dataQ[2];

                $dados['dadosTratado'][$i]['mes'] = mesDescricao($dataQ[1]);

                $i++;
            }
        }
    }
}

$dados['dadosTratado'] = array_sort($dados['dadosTratado'], 'id_doc', $order = SORT_ASC);

$idAnterior = 0;
$i2 = 0;
foreach ($dados['dadosTratado'] as $test) {
    $dataQ2 = explode("/", $test['dataPublicacao']);
    if ($test['id_doc'] != $idAnterior) {
        $idAnterior = $test['id_doc'];
        $dados['dadosTratado2'][$i2]['dataAtualizacao'] = $test['dataAtualizacao'];
        $dados['dadosTratado2'][$i2]['dataPublicacao'] = $test['dataPublicacao'];
        $dados['dadosTratado2'][$i2]['descricao'] = $test['descricao'];
        $dados['dadosTratado2'][$i2]['id_doc'] = $test['id_doc'];
        $dados['dadosTratado2'][$i2]['dataNum'] = $test['dataNum'];
        $dados['dadosTratado2'][$i2]['ano'] = $dataQ2[2];
        $dados['dadosTratado2'][$i2]['mes'] = mesDescricao($dataQ2[1]);

        $i2++;
    }
}


$dados['dadosTratado2'] = array_sort($dados['dadosTratado2'], 'dataNum', $order = SORT_DESC);


function getDataAtualizacaoArray($array)
{
    $dataAtualizacao = new DateTime();
    if (is_array($array) && !empty($array)) {
        $first = true;
        foreach ($array as $retorno) {
            //var_dump($retorno);
            if ($retorno['meses']['exibe']) {
                foreach ($retorno['meses']['anexos'] as $anexo) {
                    if (!is_array($anexo)) {
                        $anexo = $retorno['meses']['anexos'];
                    }
                    if ($first) {
                        $dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($anexo['dataPublicacao']));
                        $first = false;
                    } else {
                        $dataTemp = DateTime::createFromFormat('d/m/Y', trim($anexo['dataPublicacao']));
                        if ($dataTemp > $dataAtualizacao) {
                            $dataAtualizacao = $dataTemp;
                        }
                    }
                }
            }
        }
    }

    $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
    return $dataAtualizacao;
}
?>

<div class="col-12">


    <div class="row" style="margin-top: -2em">
        <small>Última atualização: <?= getDataAtualizacaoArray($listaBoletins); 
                                    ?></small>
    </div>
    <div class="spacer"></div>

    <div style="display:none;">
        <input type="text" id="idMesOcultar" value="vazio" />
    </div>

    <?php
    $ano_lista = 0;
    foreach ($dados['dadosTratado2'] as $dado) {
        if ($ano_lista != $dado['ano']) {
            $ano_lista = $dado['ano'];
            $liAno = "";
            $liMes = "";
            $tabelasRow = "";
            $liAno .= "<li>" . $dado['ano'] . "</li>";

            foreach ($dados['dadosTratado2'] as $mes) {
                if ($dado['ano'] == $mes['ano']) {
                    $liMes .= "<li onClick=javascript:exibirBotaoRelatorio('" . $mes['ano'] . "-" . $mes['mes'] . "');>" . $mes['mes'] . "</li>";

                    $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=" . $mes['ano'] . "-" . $mes['mes'] . ">";
                    $anexoTemp = null;

                    $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $mes['id_doc'] . "&MOD=SV58&niveis=" . urlencode("JURISPRUDÊNCIA/GESTÃO DE PRECEDENTES/" . $mes['ano'] . "/" . $mes['mes'] . "/" . $mes['descricao']) . "'>";
                    $tabelasRow .= $mes['descricao'] . "</a>";

                    $tabelasRow .= "</div><div class='space'></div><div class='clearfix'></div>";
                }
            }
    ?>
            <div class="row report">
                <ul>
                    <?= $liAno ?>
                    <?= $liMes ?>
                </ul>
            </div>
    <?php
            echo $tabelasRow;
        }
    }
    ?>

</div>