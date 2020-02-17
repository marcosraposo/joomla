<?php defined('_JEXEC') or die;

function getDataAtualizacao($array)
{
	$dataAtualizacao = new DateTime();

	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataPublicacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataPublicacao']));
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}
?>



<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">Julgados Escolhidos </div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['JulgadosEscolhidos']['return']); ?></small>
            </div>

            <?php
			$ano = 0;
			for ($i = count($dados['JulgadosEscolhidos']['return']) - 1; $i >= 0; $i--) {
				$list = $dados['JulgadosEscolhidos']['return'][$i];
				if (!empty($list['dataPublicacao'])) :
					$horarioAno = explode("/", $list['dataPublicacao']);
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
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', 'Julgados Escolhidos', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_<?= $ano; ?>">
                    <tr>
                        <th>Data Publicação</th>
                        <th>Descrição</th>
                        <th>Desembargador</th>
                        <th>Tipo do Julgamento</th>
                    </tr>
                    <?php
					$texto  = "";

					foreach ($dados['JulgadosEscolhidos']['return'] as $listDados) :
						if (!empty($listDados['dataPublicacao'])) :
							$horarioAno2 = explode("/", $listDados['dataPublicacao']);
							if ($horarioAno2[2] == $horarioAno[2]) :
								?>

                    <?php	
					$texto .= "<tbody>
							<tr>
								<td>" . $listDados['dataPublicacao'] . "</td>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['id'] . "&MOD=SV34&niveis=" . urlencode("JURISPRUDÊNCIA/JULGADOS ESCOLHIDOS/" . $listDados['descricaoJulgado']) . "'>
													" . $listDados['descricaoJulgado'] . "
												</a>
								
								</td>
								<td>" . $listDados['nomeDesembargador'] . "</td>
								<td>" . $listDados['tipoJulgado'] . "</td>
								</tbody>
								</tr>
					";




				endif;
			endif;
		endforeach;

		echo  $texto;
		?>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>Julgados Escolhidos</h3>";
				$htmlPDF .= "<h4>" . $ano . "</h4>";
				$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
						<tr>
						<th>DATA PUBLICAÇÃO</th>
						<th>DESCRIÇÃO</th>
						<th>DESEMBARGADOR</th>
						<th>TIPO DO JULGAMENTO</th>
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
} ?>
    </div>
</div>
</div> 