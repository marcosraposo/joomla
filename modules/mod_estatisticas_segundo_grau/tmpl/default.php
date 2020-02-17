<?php

function getMeses($meses)
{
    $retorno = array();
    for ($i = 0; $i < count($meses); $i++) {
        array_push($retorno, $meses[$i]['meses']);
    }
    return $retorno;
}

function getDados($meses)
{

    $anos  = array();
    $dados = array();
    $meses = getMeses($meses);

    foreach ($meses as $mes) {
        $ano = explode("/", $mes['dataPublicacao'])[2];
        if (!in_array($ano, $anos)) {
            array_push($anos, $ano);
        }
    }

    foreach ($anos as $ano) {
        $arrayAnos = array();
        $arrayAnual = array();
        $arraySemestral = array();
        $array1Semestre = array();
        $array2Semestre = array();

        foreach ($meses as $mes) {
            $anoMes = explode("/", $mes["dataPublicacao"])[2];
            if ($anoMes === $ano) {
                array_push($arrayAnos, $mes);
            }
        }

        foreach ($arrayAnos as $dado) {
            foreach ($dado['anexos'] as $anexo) {
                if (!empty($anexo['semestre'])) {
                    if ($anexo['semestre'] == 'jca') {
                        array_push($arrayAnual, $anexo);
                    } elseif ($anexo['semestre'] == '1') {
                        array_push($array1Semestre, $anexo);
                    } elseif ($anexo['semestre'] == '2') {
                        array_push($array2Semestre, $anexo);
                    }
                }
            }
        }

        array_push($arraySemestral, $array1Semestre);
        array_push($arraySemestral, $array2Semestre);

        array_push($dados, array(
            "ano" => $ano,
            "meses" => $arrayAnos,
            "semestral" => $arraySemestral,
            "anual" => $arrayAnual
        ));
    }
    return $dados;
}

function getDataAtualizacao($array)
{
    $dataAtualizacao = new DateTime();
    if (is_array($array) && !empty($array)) {
        $first = true;
        foreach ($array as $retorno) {
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

function detalhamento($detalhes, $id, $usarMargem = false)
{
    $margem = "";
    if ($usarMargem) {
        $margem = "margin-top: 0.8em";
    }
    $botao = "";
    $botao .= "           
        <div class='space'></div><div class='clearfix'></div>           
		<div class='row botoes2' style='display: none; " . $margem . "' id='" . $id . "'> 
            <ul>
                <li style='margin-left: -1.2em;'></li>
				$detalhes 
			</ul>    
		</div>
		";
    return $botao;
}

function array_sort($array){
    $i = 0;
    foreach ($array as $dados){
        if(!is_array($dados)){
            return $array;
        }

        $array[$i]['Ordem'] = $dados['descricao'];
        $i++;
    }

    $array = array_sort_aux($array, 'Ordem', SORT_ASC);

    return $array;
}

function array_sort_aux(&$arrIni, $col, $order = SORT_ASC)
{
    $arrAux = array();
    foreach ($arrIni as $key => $row) {
        $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
        $arrAux[$key] = strtolower($arrAux[$key]);
    }
    array_multisort($arrAux, $order, $arrIni);

    return $arrIni;
}

?>

<div class="spacer"></div>
<div class="spacer"></div>
<div style="display:none;">
    <input type="text" id="idMesOcultar" value="vazio" />
    <input type="text" id="idAnoOcultar" value="vazio" />
</div>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado responsivo" data-aba-id="1">
        <div class="col-12">

            <div class="row">
                <div class="titulo">SEGUNDO GRAU</div>
            </div>
            <div class="row">
                <div class="titulo">SECRETARIA JUDICIÁRIA - ESTATÍSTICAS</div>
            </div>
            <div class="row">
                <small>Última atualização: <?= getDataAtualizacao($list); ?></small>
            </div>

            <?php
            foreach (getDados($list) as $dado) :
                $idMensal = "";
                $idAnual = "";
                $liAno = "";
                $liMes = "";
                $liAnual = "";
                $liBox = "";
                $tabelasRow = "";
                $tabelaMes = "";
                $tabelaAno = "";
                $liAno .= "<li class='titulo'>" . $dado['ano'] . "</li>";
                $liAno .= "<li class='arrow-down'>
								<a href='#report' onClick=javascript:fecharNosFilhos()><img src='../templates/portalProcessosConsultas/images/arrow_down_2.svg'></a>
                            </li>";
                $liBox .= "<li class='inline'>";
                $liBox .= "</li>";
                if (!empty($dado['meses'])) {
                    $liBox .= "<li class='box' role='button' onClick=javascript:exibirBotaoRelatorio('mensal_" . $dado['ano'] . "');>
                        Mensal
                    </li>";
                    $idMensal = "mensal_" . $dado['ano'];
                }

                //Validacao para apenas montar o bloco consolidado se houver Anual, ou 1 ou 2 Semestre
                if (!empty($dado['semestral'][0]) || !empty($dado['semestral'][1]) || !empty($dado['anual'])) {
                    $liBox .= "<li class='box' role='button' onClick=javascript:exibirBotaoRelatorio('consolidado_" . $dado['ano'] . "');>Consolidado</li>";
                    $idAnual = "consolidado_" . $dado['ano'];

                    //Pegando os dados do 1 Semestre
                    if (!empty($dado['semestral'][0])) {
                        $liAnual .= "<li onClick=javascript:exibirBotaoMesesRelatorio('" . $dado['ano'] . "-Semestre1');>1º Semestre</li>";

                        $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=" . $dado['ano'] . "-Semestre1>";
                        $anexoTemp = null;

                        if(is_array($dado['semestral'][0])){
                            $dado['semestral'][0] = array_sort($dado['semestral'][0]);
                        }
                        foreach ($dado['semestral'][0] as $anexo) {
                            if (!is_array($anexo)) {
                                $anexo = $dado['semestral'][0];
                                if ($anexoTemp != $anexo) {
                                    $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $anexo['descricao']) . "'>";
                                    $tabelasRow .= $anexo['descricao'] . "</a>";
                                }
                                $anexoTemp = $anexo;
                            } else {
                                $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $anexo['descricao']) . "'>";
                                $tabelasRow .= $anexo['descricao'] . "</a>";
                            }
                        }
                        $tabelasRow .= "</div><div class='space'></div><div class='clearfix'></div>";
                    }

                    //Pegando os dados do 2 Semestre
                    if (!empty($dado['semestral'][1])) {
                        $liAnual .= "<li onClick=javascript:exibirBotaoMesesRelatorio('" . $dado['ano'] . "-Semestre2');>2º Semestre</li>";

                        $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=" . $dado['ano'] . "-Semestre2>";
                        $anexoTemp = null;

                        if(is_array($dado['semestral'][1])){
                            $dado['semestral'][1] = array_sort($dado['semestral'][1]);
                        }
                        foreach ($dado['semestral'][1] as $anexo) {
                            //Necessario caso so tenha um registro.
                            if (!is_array($anexo)) {
                                $anexo = $dado['semestral'][1];
                                if ($anexoTemp != $anexo) {
                                    $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $anexo['descricao']) . "'>";
                                    $tabelasRow .= $anexo['descricao'] . "</a>";
                                }
                                $anexoTemp = $anexo;
                            } else {
                                $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $anexo['descricao']) . "'>";
                                $tabelasRow .= $anexo['descricao'] . "</a>";
                            }
                        }
                        $tabelasRow .= "</div><div class='space'></div><div class='clearfix'></div>";
                    }

                    //Pegando os dados do Anuais
                    if (!empty($dado['anual'])) {
                        $liAnual .= "<li onClick=javascript:exibirBotaoMesesRelatorio('" . $dado['ano'] . "-ANUAL');>Anual</li>";

                        $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=" . $dado['ano'] . "-ANUAL>";
                        $anexoTemp = null;

                        if(is_array($dado['anual'])){
                            $dado['anual'] = array_sort($dado['anual']);
                        }
                        foreach ($dado['anual'] as $anexo) {
                            //Necessario caso so tenha um registro.
                            if (!is_array($anexo)) {
                                $anexo = $dado['anual'];
                                if ($anexoTemp != $anexo) {
                                    $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $anexo['descricao']) . "'>";
                                    $tabelasRow .= $anexo['descricao'] . "</a>";
                                }
                                $anexoTemp = $anexo;
                            } else {
                                $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $anexo['descricao']) . "'>";
                                $tabelasRow .= $anexo['descricao'] . "</a>";
                            }
                        }
                        $tabelasRow .= "</div><div class='space'></div><div class='clearfix'></div>";
                    }

                    $tabelaAno .= detalhamento($liAnual, $idAnual, true);
                    $tabelaAno .= "<div class='space'></div><div class='clearfix'></div>";
                }

                //Montando os dados do Mes
                foreach ($dado['meses'] as $mes) :
                    $liMes .= "<li onClick=javascript:exibirBotaoMesesRelatorio('" . $dado['ano'] . "-" . $mes['descricaoMes'] . "');>" . $mes['descricaoMes'] . "</li>";

                    $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=" . $dado['ano'] . "-" . $mes['descricaoMes'] . ">";
                    $anexoTemp = null;
                    if(is_array($mes['anexos'])){
                        $mes['anexos'] = array_sort($mes['anexos']);
                    }
                    foreach ($mes['anexos'] as $anexo) :
                        //Necessario caso so tenha um registro.
                        if (!is_array($anexo)) {
                            $anexo = $mes['anexos'];
                            if ($anexoTemp != $anexo) {
                                if($anexo['semestre'] == "est"){
                                //if ($anexo['semestre'] != "jca" && $anexo['semestre'] != "1" && $anexo['semestre'] != "2") {
                                    $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $mes['descricaoMes'] . "/" . $anexo['descricao']) . "'>";
                                    $tabelasRow .= $anexo['descricao'] . "</a>";
                                }
                            }
                            $anexoTemp = $anexo;
                        } else {
                            if($anexo['semestre'] == "est"){
                            //if ($anexo['semestre'] != "jca" && $anexo['semestre'] != "1" && $anexo['semestre'] != "2") {
                                $tabelasRow .= "<a style='text-align: center;text-decoration: none;' class='box box-col-3 col-12' href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $anexo['id'] . "&MOD=SV37&niveis=" . urlencode("PROCESSOS E CONSULTAS/ESTATÍSTICAS/SEGUNDO GRAU/" . $dado['ano'] . "/" . $mes['descricaoMes'] . "/" . $anexo['descricao']) . "'>";
                                $tabelasRow .= $anexo['descricao'] . "</a>";
                            }
                        }
                    endforeach;
                    $tabelasRow .= "</div><div class='space'></div><div class='clearfix'></div>";
                endforeach;

                $tabelaMes .= detalhamento($liMes, $idMensal, true);
                $tabelaMes .= "<div class='space'></div><div class='clearfix'></div>";
                ?>

                <div class="row report">
                    <ul>
                        <?= $liAno ?>
                    </ul>
                </div>
                <div class="row botoes" style='margin-top: -0.8em; margin-bottom: 2.5em'>
                    <ul>
                        <?= $liBox ?>
                    </ul>
                </div>
            <?php
                echo $tabelaMes;
                echo $tabelaAno;
                echo $tabelasRow;
            endforeach;
            ?>

        </div>
    </div>
</div>