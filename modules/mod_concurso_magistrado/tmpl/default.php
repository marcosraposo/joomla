<?php 
defined('_JEXEC') or die;
error_reporting(0);
$dataHoje = date("d/m/Y");
require_once 'func.php';

$listConcursos = array();
$listTitulos = array();
foreach ($list as $concurso) {
    $titulo = $concurso['tituloConcurso'];
    if (!in_array($titulo, $listTitulos)) {
        array_push($listTitulos, $titulo);
    }
}


$listTitulos = ordenarTitulos($listTitulos);
foreach ($listTitulos as $titulo) {
    array_push($listConcursos, getListDadosPorConcurso($list, $titulo));
}

/*
$romanos = explode(" ",$atas['tituloConcurso']);

$ordernar = false;
foreach($list as $group){
	$romanos = explode(" ",$atas['tituloConcurso']);
	if(!empty($romanos[1])){
		$ordernar = true;
		$group->romanos = $romanos[1];
	}
}
//var_dump($ordernar);
if($ordernar){
	array_sort_by2($list, 'romanos', $order = SORT_DESC);
}*/
?>


<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">CONCURSO DE MAGISTRADOS </div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($list); ?></small>
            </div>





            <?php
            $romano = "";
            $ano = 0;
            foreach ($listConcursos as $listDados) {
                if (is_array($listDados) && !empty($listDados)) {
                    $atas = $listDados[0];
                    $horarioAno = explode("/", $atas['dataPublicacao']);
                    $romanoTitulo = $atas['tituloConcurso'];


                    if ($romano != $romanoTitulo) :
                        $ano = $horarioAno[2];
                        $romano = $romanoTitulo;

                        ?>
            <div class="row report">
                <ul>
                    <li class="titulo" style="width: 150px;"><?php echo $romanoTitulo; ?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>

            <?php endif; ?>

            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    XML
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    CSV
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_<?= $ano; ?>">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php	
                        $texto = "";
                        foreach ($listDados as $concurso) :
                            $horarioAno2 = explode("/", $concurso['dataPublicacao']);
                            $texto .= "<tr>";
                            $texto .= "<td>" . $concurso['dataPublicacao'] . "</td>";
                            $texto .= "<td>
                                        <a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $concurso['id'] . "&MOD=SV30&niveis=" . urlencode("Concuros e Seleções/Concursos de Servidores/CONCURSO DE MAGISTRADOS/" . $concurso['tituloConcurso'] . "/" . $concurso['descricao']) . "'>
                                            " . $concurso['descricao'] . "
                                        </a>
                                    </td> ";
                            $texto .= "<tr>";
                        endforeach;
                        echo $texto;
                        ?>
                    </tbody>
                </table>
                <?php 
                //Aqui conteém o HTML que vai ser trandormado em PDF.
                $htmlPDF = "<h3>CONCURSO DE MAGISTRADOS</h3>";
                $htmlPDF .= "<h4>".$concurso['tituloConcurso']."</h4>";
                $htmlPDF .= "<table border=1 id='tabela2_" . $ano . "' cellspacing=0 cellpadding=5 >
							<tr>
                            <th>Data</th>
                            <th>Descrição</th>
							</tr> ";
                $htmlPDF .= str_replace("<br />", "", $texto);
                $htmlPDF .= "</table>";
                ?>
                <div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF ?></div>

                <div class="clearfix"></div>
            </div>
            <?php	
        }
    } ?>

        </div>
    </div>
</div> 