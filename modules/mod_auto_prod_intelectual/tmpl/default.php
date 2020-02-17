<?php defined('_JEXEC') or die;

include_once 'func.php';

function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

$dados['responseProducao'] =  array_sort($dados['responseProducao'], 'nomeDesembargador', SORT_ASC);	?>
            <div class="row">
                <div class="titulo">Produção Intelectual dos Desembargadores</div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['responseProducao']); ?></small>
            </div>
			
<?php		$ano = 0;
			$prodTipo = "";
			foreach($dados['responseProducao'] as $prod){
					if ($prodTipo != $prod['nomeDesembargador']) :
						$prodTipo = $prod['nomeDesembargador']; ?>
            <div class="row report">
                <ul>
                    <li class="titulo"><?php echo $prod['nomeDesembargador']; ?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('<?php echo urlencode($prod['nomeDesembargador']);?>');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?php echo urlencode($prod['nomeDesembargador']);?>', 'export', 'Produção Intelectual dos Desembargadores', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_<?php echo urlencode($prod['nomeDesembargador']);?>">
                    <tr>
                        <th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>
<?php				$texto  = "";
					foreach($dados['responseProducao'] as $lista){
						if ($prodTipo == $lista['nomeDesembargador']) : ?>
<?php							$texto .= "<tbody>
								<tr>
								<td>" . $lista['tipoAquisicao'] . "</td>
								<td>" . $lista['dataAtualizacao'] . "</td>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$lista['id']."&MOD=SV49&niveis=".urlencode("BIBLIOTECA/PRODUÇÃO INTELECTUAL/" . $lista['titulo']) . "'>
									".$lista['titulo']."</a>
								</td>
								</tbody>
								</tr>";
						endif;
						};
					echo  $texto;										?>
                </table>
<?php 				//Aqui conteém o HTML que vai ser trandormado em PDF.
					$htmlPDF = "<h3>Produção Intelectual dos Desembargadores </h3>";
					$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
							<tr>
							<th>NORMAS</th>
							<th>DATA</th>
							<th>DESCRIÇÃO</th>
							</tr>";
					$htmlPDF .= str_replace("<br />", "", $texto);
					$htmlPDF .= "</table>";								?>
					<div style="display:none;"><input id="table_<?php echo urlencode($prod['nomeDesembargador']);?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
					<div style="display:none;" id="tabela_export_<?php echo urlencode($prod['nomeDesembargador']);?>"><?php echo $htmlPDF; ?></div>
				<div class="clearfix"></div>
			</div>
<?php		endif;
			} 															?>

