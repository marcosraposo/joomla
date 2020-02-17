<?php defined('_JEXEC') or die;
include_once 'func.php';

function getDataAtualizacao($array)
{
    $dataAtualizacao = new DateTime();

    if (is_array($array) && !empty($array)) {
        for ($i = 0; $i < count($array); $i++) {
            $relatorio = $array[$i];
            if ($i == 0) {
                $dataAtualizacao = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
            } else {
                $dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
                if ($dataTemp > $dataAtualizacao) {
                    $dataAtualizacao = $dataTemp;
                }
            }
        }
    }

    $dataAtualizacao = $dataAtualizacao->format('d/m/Y');
    return $dataAtualizacao;
}


$ordernar = false;
$i1 = 0;
foreach ($dados['listaTermoCredenciamento']['return'] as  $group) {
	$horarioAno2 = explode("/", $group['dataFimVigencia']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$dados['listaTermoCredenciamento']['return'][$i1]['anoPublicacao'] = $horarioAno2[2];
	}
	$i1++;
}

if ($ordernar) {
	array_sort_by2($dados['listaTermoCredenciamento']['return'], 'anoPublicacao', $order = SORT_ASC);
}

?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">Termos de Credenciamento</div>
            </div>
            <div class="row">
                <small>Última atualização:
                    <?php if (is_array($dados['listaTermoCredenciamento']) && !empty($dados['listaTermoCredenciamento'])) {
                        echo getDataAtualizacao($dados['listaTermoCredenciamento']['return']);
                    } ?>
                </small>
            </div>
            <?php
            $ano = 0;
            if (is_array($dados['listaTermoCredenciamento']) && !empty($dados['listaTermoCredenciamento'])) {
                for ($i = count($dados['listaTermoCredenciamento']['return']) - 1; $i >= 0; $i--) {
                    $list = $dados['listaTermoCredenciamento']['return'][$i];
                    if (!empty($list['dataFimVigencia'])) :
                        $horarioAno = explode("/", $list['dataFimVigencia']);
                        if ($ano != $horarioAno[2]) :
                            $ano = $horarioAno[2];
                            ?>
            <div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[2]; ?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
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
                            <th>Termo de Credenciamento </th>
                            <th>Instituto</th>
                            <th>Vigência (até)</th>
                            <th>Aditivos</th>
                        </tr>
                    </thead>
                    <?php
                    $texto = "";
                    foreach ($dados['listaTermoCredenciamento']['return'] as $listDados) :
                        if (!empty($listDados['dataFimVigencia'])) :
                            $horarioAno2 = explode("/", $listDados['dataFimVigencia']);
                            if ($horarioAno2[2] == $horarioAno[2]) :
                                $texto .= '<tr><td>';
                                ?>
                    <tr>
                        <td>
                            <?php foreach ($listDados['termos'] as $listaPdf) :
                                $texto .= "<br>";
                                ?>
                            <br>
                            <?php if (!empty($listaPdf['exibe'])) :
                                $texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listaPdf['codigo'] . "&MOD=SV1&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Credenciamento/" . $horarioAno2[2] . "/" . $listDados['instituicao'] . "/" . $listaPdf['descricaoArquivo']) . "'>";
                                $texto .= $listaPdf['descricaoArquivo'] . "</a>";
                                ?>
                            <a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['codigo']; ?>&MOD=SV1&niveis=<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Credenciamento/' . $horarioAno2[2] . '/' . $listDados['instituicao'] . "/" . $listaPdf['descricaoArquivo']) ?>">
                                <?php echo $listaPdf['descricaoArquivo']; ?>
                            </a>
                            <?php endif;    ?>
                            <?php endforeach;
                        $texto .= "</td>"
                        ?>
                        </td>
                        <td>
                            <?php echo $listDados['instituicao'];
                            $texto .= "<td>" . $listDados['instituicao'] . "</td>";
                            ?>
                        </td>
                        <td>
                            <?php 
                            //O conteúdo da coluna Data de Vigência deve ser alimentado pelo metadado DataAtualização. JIRA: TRFRG-19951
                            echo $listDados['dataAtualizacao'];
                            $texto .= "<td>" . $listDados['dataAtualizacao'] . "</td><td>";
                            ?>
                        </td>
                        <td>
                            <?php foreach ($listDados['aditivos'] as $listAditivo) :
                                $texto .= "<br>";
                                $texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listAditivo['codigo'] . "&MOD=SV12&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Credenciamento/" . $horarioAno2[2] . "/" . $listDados['instituicao'] . "/" . $listAditivo['descricaoArquivo']) . "'>";
                                $texto .= $listAditivo['descricaoArquivo'] . "</a>";
                                ?>
                            <br><a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listAditivo['codigo']; ?>&MOD=SV12&niveis=<?php echo urlencode('CONVÊNIOS E ACORDOS/Termos de Credenciamento/' . $horarioAno2[2] . '/' . $listDados['instituicao'] . "/" . $listAditivo['descricaoArquivo']) ?>"><?php echo $listAditivo['descricaoArquivo']; ?></a>
                            <?php endforeach;
                        $texto .= "</td>"
                        ?>
                        </td>
                    </tr>
                    <?php	endif;
            endif;
        endforeach; ?>
                </table>
                <?php 
                //Aqui conteém o HTML que vai ser trandormado em PDF.
                $htmlPDF = "<h3>Termos de Credenciamento</h3>";
                $htmlPDF .= "<h4>" . $ano . "</h4>";
                $htmlPDF .= "<table border=1 id='tabela_" . $ano . "' cellspacing=0 cellpadding=5 >
							<tr>
								<th>Convênio</th>
								<th>Instituto</th>
								<th>Vigência (até)</th>
								<th>Aditivos</th>
							</tr>";
                $htmlPDF .= str_replace("<br />", "", $texto);
                $htmlPDF .= "</table>";
                ?>
                <div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                <div class="clearfix"></div>
            </div>
            <?php	endif;
    endif;
}
} ?>
        </div>
    </div>
</div> 