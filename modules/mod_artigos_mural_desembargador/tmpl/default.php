<?php 
defined('_JEXEC') or die;

    function getDataAtualizacao($array){
		$dataAtualizacao = new DateTime();
		$first = true;
		if(is_array($array) && !empty($array)){
			//for ($i = 0; $i < count($array); $i++) {
				//var_dump($array['editais']);die();
				//$relatorio = $array[$i];
				foreach ($array['editais'] as $mural) {
					if($first){
						$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $mural['dataAtualizacao']);
						$first = false;
					}else{
						$dataTemp = DateTime::createFromFormat('d/m/Y', $mural['dataAtualizacao']);
						if($dataTemp > $dataAtualizacao){
							$dataAtualizacao = $dataTemp;
						}
					}
				}
			//}
		}

		$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
		return $dataAtualizacao;
	}

	function retiraBarras($string){
		$string = str_replace("/", "&#47;", $string);
		return $string;
	}

	//Recebe o subtitle que foi informado como parametro no modulo.
    $subtitle = $params->get('subtitle');
    $subtitle = str_replace("<p>", "", $subtitle);
    $subtitle = str_replace("</p>", "", $subtitle);

	//recebe o título da página
	$titulo = $params->get('titulo');
	
	//recebe o título da tabela
	$titleTable = $params->get('titleTable');

    //Recebe o rodape da pagina que foi informado como parametro no modulo.
    $rodape = $params->get('footer');
    $rodape = str_replace("<p>", "", $rodape);
    $rodape = str_replace("</p>", "", $rodape);
?>

<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado" data-aba-id="1">
		<div class="col-12">
			<div class="row">
				<div class="titulo"><?=$titulo?></div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list)?></small>
			</div>
			
			<div class="clearfix"></div>
			<div class="spacer"></div>
			
			<?php echo html_entity_decode($subtitle); ?>

			<div class="clearfix"></div>
			<div class="spacer"></div>
			
			<div class="row">
				<div class="titulo" style="font-size: 2vh;">
					<?php echo html_entity_decode($titleTable); ?>
				</div>
			</div>
			
			<?php
				$ano = 0;
				for($i=0; $i <= count($list['editais'])-1; $i++){
					$relatorio = $list['editais'][$i];
				//	var_dump($relatorio);
					//foreach ($list['editais'] as $mural) {
						$dataAno = explode("/", $relatorio['dataAtualizacao']);
						$horarioAno = $dataAno[2];
					//}

					if($ano != $horarioAno):
						$ano = $horarioAno;
						?>
					<div class="row report">
						<ul>
							<li class="titulo"><?php echo $horarioAno;?></li>
							<li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
						</ul>
					</div>
					<div class="row botoes w100">
						<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							PDF
						</a>
						<a href="#conteudo" role="button"  class="download"  onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							XML
						</a>
						<a href="#conteudo" role="button"  class="download"  onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							CSV
						</a>
						<a href="#conteudo" role="button"  class="download" onClick="javascript:imiprimirTabela('<?= $ano; ?>');">
							<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
							IMPRIMIR
						</a>
						<div class="clearfix"></div>
						<div class="spacer"></div>
						<div class="spacer"></div>
						<table  id="tabela_<?= $ano; ?>" >
						<thead>
							<tr>
								<th>DATA</th>
								<th>HORA</th>
								<th>MURAL</th>
							</tr> 
						</thead>
						<tbody>
						<?php	
						$texto = "";
						//foreach($list as $listDados):
							foreach ($list['editais'] as $mural) {
								$dataAno = explode("/", $mural['dataAtualizacao']);
								$horarioAno2 = $dataAno[2];
								if($horarioAno2 == $horarioAno){
									if($mural['exibe']){
										$texto .= "<tr>
											<td>".$mural['dataAtualizacao']."</td>
											<td>".$mural['hora']."</td>
											<td>
												<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$mural['codigo']."&MOD=SV25&niveis=".urlencode("PROCESSOS E CONSULTAS/Mural Gabinete Desembargador Marcelo Navarro/".$horarioAno2."/".retiraBarras($mural['descricaoArquivo']))."'>
													".$mural['descricaoArquivo']."
												</a>
											</td>
											<tr>";
									}
								}
							}
						//endforeach;
						echo $texto;
						?>
						</tbody>
						</table>
						<?php 
						//Aqui contêm o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>".$titulo."</h3>";
						$htmlPDF .= "<table border=1 id='tabela2_".$ano."' cellspacing=0 cellpadding=5 >
								<tr>
								<th>DATA</th>
								<th>HORA</th>
								<th>MURAL</th>
								</tr> ";
						$htmlPDF .= str_replace("<br />","",$texto);
						$htmlPDF .= "</table>";
					?>
						<div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>"/></div>
						<div class="clearfix"></div>
					</div>
				<?php	endif; 
				}?>	
				
				<div class="clearfix"></div>
				<div class="spacer"></div>

				<?php echo html_entity_decode($rodape); ?>
		</div>
	</div>
</div>