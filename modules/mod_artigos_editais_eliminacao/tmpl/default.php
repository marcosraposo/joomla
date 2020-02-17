<?php 
require_once 'func.php';
defined('_JEXEC') or die;
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
foreach ($list['editais'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list['editais'][$i1]['anocotacao'] = $horarioAno2[2];
	}
	$i1++;
}

if ($ordernar) {
	array_sort_by($list['editais'], 'anocotacao', $order = SORT_DESC);
}

function retiraBarras($string)
{
	$string = str_replace("/", "&#47;", $string);
	return $string;
}

//recebe o título da página
$titulo = $params->get('titulo');
?>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $titulo ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($list['editais']) ?></small>
            </div>
            <?php
			$ano = 0;
			foreach ($list['editais'] as $editais) {
				$dataAno = explode("/", $editais['dataAtualizacao']);
				$horarioAno = $dataAno[2];

				if ($ano != $horarioAno) :
					$ano = $horarioAno;
					?>
            <div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno; ?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
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
                            <th>Nº DO EXPEDIENTE</th>
                            <th>DATA DE ATUALIZAÇÃO</th>
                            <th>OBSERVAÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php	
						$texto = "";
						foreach ($list['editais'] as $listDados) :
							$dataAno = explode("/", $listDados['dataAtualizacao']);
							$horarioAno2 = $dataAno[2];
							if ($horarioAno2 == $horarioAno) :
								$texto .= "<tr>";
								$texto .= "
										<td>
										<a href='/joomla/index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['codigo'] . "&MOD=SV24&niveis=" . urlencode("PROCESSOS E CONSULTAS/EDITAIS DE ELIMINAÇÃO/" . $horarioAno2 . "/" . retiraBarras($listDados['descricaoArquivo'])) . "'>
										" . $listDados['descricaoArquivo'] . "
										</a>
										</td> 
										<td>" . $listDados['dataAtualizacao'] . "</td>
										<td>" . $listDados['descricaoArquivo'] . "</td>";
								$texto .= "<tr>";
							endif;
						endforeach;
						echo $texto;
						?>
                    </tbody>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>" . $titulo . "</h3>";
				$htmlPDF .= "<h4>" . $ano . "</h4>";
				$htmlPDF .= "<table border=1 id='tabela2_" . $ano . "' cellspacing=0 cellpadding=5 >
								<tr>
								<th>Nº DO EXPEDIENTE</th>
								<th>DATA DE ATUALIZAÇÃO</th>
								<th>OBSERVAÇÕES</th>
								</tr> ";
				$htmlPDF .= str_replace("<br />", "", $texto);
				$htmlPDF .= "</table>";
				?>
                <div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
				
                <div class="clearfix"></div>
            </div>
            <?php	endif;
	} ?>

        </div>
    </div>
</div> 