<?php defined('_JEXEC') or die;

include_once 'func.php';
//error_reporting(0);




//die;

$i = 0;
foreach($dados['dados']['return'] as $dadosTratamento ){
$i++;
 $dados['dadosTratados'][$i] = $dadosTratamento;
}



//echo"<pre>";
//var_dump($dados['dadosTratados']);
//echo"</pre>";



$dados['dadosTratados'] =  array_sort($dados['dadosTratados'], 'ordenador', SORT_DESC);
//$dados['dados'] =  array_sort($dados['dados'], 'tipoManual', SORT_ASC);

?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">

		<div class="row">
			<div class="titulo">Relatório de Licitações</div>
		</div>
		<div class="row">
			<small>Última atualização: <?php  echo getDataAtualizacao2($dados['dadosTratados']) ?></small>
		</div>
<?php	$ano = 0;
		foreach($dados['dadosTratados'] as $dadosAno ){
			$texto = "";						
			if ($ano != $dadosAno['ano']){
				$ano = $dadosAno['ano'];				?>

		<div class="row report">
            <ul>
				<li class="titulo"><?= $ano; ?></li>
				<li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
			</ul>
        </div>
		<div class="row botoes w100">
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
				<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>PDF
			</a>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?= $ano; ?>', 'xml');">
				<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>XML
			</a>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?= $ano; ?>', 'csv');">
				<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>CSV
			</a>
			<a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
				<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>	IMPRIMIR
			</a>

			<table id="tabela_<?= $ano; ?>">
			<thead>
				<tr>
					<th>Data</th>
					<th>Hora (Brasília)</th>
					<th>Documentos</th>
					<th>Objeto</th>
					<th>Valor Estimado (R$)</th>
					<th>Situação</th>
					<th>Resultado da Licitação</th>
				</tr>
			</thead>

<?php		

			foreach ($dados['dadosTratados'] as  $listDados) {
				if(empty($listDados['dataAtualizacao'])){
					$listDados = $dadosAno ;
				}
				$listDados['documentos'] = array_sort($listDados['documentos'], 'descricao', $order = SORT_ASC);
				if($listDados['ano'] == $ano){
					$texto .= "<tr>";
					$texto .= "<td>".$listDados['dataAtualizacao']."</td>";
					$texto .= "<td>".$listDados['hora']."</td>";
					$txtDocumentos = "";
					$txtResultado = "";
					$txtEdital = "";
					foreach ($listDados['documentos'] as  $documento) {
						if(empty($documento['descricao'])){
							$documento = $listDados['documentos'] ;
							$txtDocumentos .= "<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $documento['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $documento['descricao']) . "'>
						" . $documento['descricao'] . "	</a></br></br>";
						break;
						}
						//Se a primeira palavra for 'Edital' case insensiteve
						if(stripos($documento['descricao'],'Edital') === 0) 
						{
							$txtEdital .= "<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $documento['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $documento['descricao']) . "'>
							" . $documento['descricao'] . "	</a></br></br>";
						}
						else
						{
							$txtDocumentos .= "<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $documento['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $documento['descricao']) . "'>
							" . $documento['descricao'] . "	</a></br></br>";
						}
					}
					if(empty($listDados['resultados']) === false)
						foreach ($listDados['resultados'] as  $documento) {
//var_Dump( $listDados['descricaoObjeto']);
							if(empty($documento['descricao'])){
								$documento = $listDados['resultados'] ;
								$txtResultado .= "</br>".$listDados['descricaoObjeto']."</br></br>";
								$txtResultado .= "<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $documento['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $documento['descricao']) . "'>
							" . $documento['descricao'] . "	</a></br></br>";
							break;
							}
							
							$txtResultado .= "</br>".$listDados['descricaoObjeto']."</br></br>";
							$txtResultado .= "<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $documento['id'] . "&MOD=".$dados['params']['servico_pdf']."&niveis=" . urlencode("PJE/MANUAL/" . $documento['descricao']) . "'>
							" . $documento['descricao'] . "	</a></br></br>";
						}	

					$texto .= "<td>".$txtEdital.$txtDocumentos."</td>";
					$texto .= "<td>".$listDados['descricaoObjeto']."</td>";
					$texto .= "<td>".$listDados['valor']."</td>";
					$texto .= "<td>".$listDados['situacao']."</td>";
					$texto .= "<td>".$txtResultado."</td>";
				}
				$texto .= "</tr>";
			}
			echo  $texto ;			?>
			</table>
			<div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($texto); ?>" /></div>
			<div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $texto; ?></div>
		</div>
<?php		}
		}						?>


		</div>
	</div>
</div> 