<?php defined('_JEXEC') or die;

include_once 'func.php';

$i = 0;
foreach($dados['dados']['return'] as $dadosTratamento ){
$i++;
	$dados['dadosTratados'][$i] = $dadosTratamento;
}

//$dados['dados'] =  array_sort($dados['dados'], 'tipoManual', SORT_ASC);
?>
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
		<div class="row">
			<div class="titulo">INFORMAÇÕES COMPLEMENTARES</div>
		</div>
		<div class="row">
			<small>Última atualização: <?php //echo getDataAtualizacao2($dados['dadosTratados']) ?></small>
		</div>
 <?php $ano = 0;
		foreach($dados['dadosTratados'] as $dadosAno ){
			$texto = "";						
			if ($ano != $dadosAno['ano']){
				$ano = $dadosAno['ano'];?>
		<div class="row report">
			<ul style="width: 100%;">
				<li class="titulo" style="display: inline-block; width: 58px;"><?= $ano; ?></li>
				<li class="arrow-down up"><a href="#conteudo" role="button"><img src="/joomla/templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
			</ul>
		</div>
		<div class="row botoes w100">
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('i<?= $ano; ?>');">
				<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>PDF
			</a>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('i<?= $ano; ?>', 'xml');">
				<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>XML
			</a>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('i<?= $ano; ?>', 'csv');">
				<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>CSV
			</a>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_i<?= $ano; ?>', 'export', '', this);">
				<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>	IMPRIMIR
			</a>
			<table id="tabela_i<?= $ano; ?>">
			<thead>
				<tr>
					<th>COTAÇÃO ELETRÔNICA Nº</th>
					<th>DOCUMENTOS COMPLEMENTARES</th>
					<th>DESCRIÇÃO RESUMIDA DO OBJETO</th>
				</tr>
			</thead>
<?php		foreach ($dados['dadosTratados'] as  $listDados) {
				if(empty($listDados['numeroCotacao'])){
					$listDados = $dadosAno ;
				}
				if($listDados['ano'] == $ano){
					$texto .= "<tr>";
					$texto .= "<td>".$listDados['numeroCotacao']."</td>";
					$texto .= "<td>";
					$descricao = "";
					foreach ($listDados['documentos'] as  $documento) {
						if(empty($documento['descricao'])){
							$documento = $listDados['documentos'] ;
						}
						if($documento['descricao'] != $descricao){
						$descricao = $documento['descricao'];
						$texto .= "<p><a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $documento['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $documento['descricao']) . "'>
						" . $documento['descricao'] . "	</a></p>";
						}
					}
					$texto .= "</td>";
					$texto .= "<td>".$listDados['descricaoObjeto']."</td>";
					$texto .= "</tr>";
				}
			}
			echo  $texto ;			?>
			</table>
			<div style="display:none;"><input type="text" id="table_i<?= $ano; ?>" value="<?php echo urlencode($texto); ?>" /></div>
			<div style="display:none;" id="tabela_export_i<?= $ano; ?>"><?php echo $texto; ?></div>
		</div>
<?php		}
		} 			?>


		</div>
	</div>
