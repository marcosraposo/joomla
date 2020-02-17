<?php 
defined('_JEXEC') or die;

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
foreach ($list as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list[$i1]['anoPublicacao'] = $horarioAno2[2];
	}
	$i1++;
}

if ($ordernar) {
	array_sort_by2($list, 'anoPublicacao', $order = SORT_ASC);
}


function retiraBarras($string)
{
	$string = str_replace("/", "&#47;", $string);
	return $string;
}
?>
<div class="row conteudo selecionado" data-aba-id="1">
    <div class="col-12">
        <div class="row">
            <div class="titulo">ATAS DE REGISTRO DE PREÇOS</div>
        </div>
        <div class="row">
            <small>Última atualização: <?php echo getDataAtualizacao($list) ?></small>
        </div>
        <?php
		$ano = 0;
		for ($i = count($list) - 1; $i >= 0; $i--) {
			$atas = $list[$i];
			$horarioAno = $atas['ano'];
			if ($ano != $horarioAno) :
				$ano = $horarioAno;
				?>
        <div class="row report">
            <ul>
                <li class="titulo"><?php echo $horarioAno; ?></li>
                <li class="arrow-down"><a href="#conteudo"><img src="templates/portalTRF5/images/arrow_down_2.svg"></a></li>
            </ul>
        </div>
        <div class="row botoes w100">
			<div class="boxBotoes">
				<a href="#conteudo" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
					<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
					PDF
				</a>
				<a href="#conteudo" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
					<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
					CSV
				</a>
				<a href="#conteudo" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
					<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
					XML
				</a>
				<a href="#conteudo" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
					<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
					IMPRIMIR
				</a>
			</div>
            <div class="clearfix"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <table id="tabela_<?= $ano; ?>">
                <thead>
                    <tr>
                        <th>Ata</th>
                        <th>Publicação</th>
                        <th>Edital</th>
                        <th>Aditivos</th>
                        <th>Publicações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php	
					$texto = "";
					foreach ($list as $listDados) :
						$horarioAno2 = $listDados['ano'];
						if ($horarioAno2 == $horarioAno) :
							$texto .= "<tr>";
							foreach ($listDados['atas'] as $listaAtas) :
								$texto .= "
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listaAtas['id'] . "&MOD=SV19&niveis=" . urlencode("LICITAÇÕES E CONTRATOS/ATAS DE REGISTRO DE PREÇOS/ATAS DE REGISTRO DE PREÇOS/" . $listDados['ano'] . "/" . retiraBarras($listaAtas['descricao'])) . "'>
										" . $listaAtas['descricao'] . "
									</a>
								</td> ";
							endforeach;

							$texto .= "<tr>";
						endif;
					endforeach;
					echo $texto;
					?>
                </tbody>
            </table>
            <?php 
			//Aqui conteém o HTML que vai ser trandormado em PDF.
			$htmlPDF = "<h3>ATAS DE REGISTRO DE PREÇOS</h3>";
			$htmlPDF .= "<h4>" . $ano . "</h4>";
			$htmlPDF .= "<table border=1 id='tabela2_" . $ano . "' cellspacing=0 cellpadding=5 >
							<tr>
                            <th>Ata</th>
                            <th>Publicação</th>
                            <th>Edital</th>
							<th>Aditivos</th>
							<th>Publicações</th>
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