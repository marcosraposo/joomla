<?php defined('_JEXEC') or die;

//echo "<pre>";
//var_dump($dados['listaParceria']);
//echo "<pre>";


function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();
	if(is_array($array) && !empty($array)){
		foreach($array['return'] as $datas){
				$relatorio = $array['return'];
				$dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function getDataAtualizacao2($array){
	$dataAtualizacao = new DateTime();
	if(is_array($array) && !empty($array)){
		foreach($array['return'] as $datas){
				$dataTemp = DateTime::createFromFormat('d/m/Y', $datas['dataAtualizacao']);
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

function retiraBarras($string){
    $string = str_replace("/", "&#47;", $string);
    return $string;
}
?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row">
        <div class="col-md-4 aba selecionado" data-aba="1">
            <div><a class="textoSemSublinhado" href="#container"><?= $dados['dados']['titulo_tab_1'] ?></a></div>
        </div>
        <div class="col-md-4 aba" data-aba="2">
            <div><a class="textoSemSublinhado" href="#container"><?= $dados['dados']['titulo_tab_2'] ?></a></div>
        </div>
		<div class="col-md-4 aba" data-aba="3">
            <div><a class="textoSemSublinhado" href="#container"><?= $dados['dados']['titulo_tab_3'] ?></a></div>
        </div>
    </div>
 </div>
 <div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_1'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao2($dados['listaCoperacao']); ?></small>
            </div>

		<?php
        $ano = 0;
        foreach ($dados['listaCoperacao'] as $list2) {
		        foreach ($list2 as $list) {
		    $horarioAno = explode("/",$list['dataFimVigencia']);
			if($ano != $horarioAno[2]):
				$ano = $horarioAno[2];
				?>
			<div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[2];?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						PDF
					</a>
					<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						XML
					</a>
					<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						CSV
					</a>
					<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
						<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
						IMPRIMIR
					</a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_<?= $ano; ?>">
				<thead>
				<tr>
                    <th>Termo de Cooperação</th>
                    <th>Instituto</th>
                    <th>Vigência (até)</th>
                    <th>Aditivos</th>
                </tr>
				</thead>
			<?php	
			$texto = "";
			foreach($dados['listaCoperacao'] as $listDados2){
			foreach($listDados2 as $listDados){
			    $horarioAno2 = explode("/",$listDados['dataFimVigencia']);
				if($horarioAno2[2] == $horarioAno[2]):
					$texto .= '<tr><td>';
				?>
				<tr>
                        <td>
						<?php foreach($listDados['termos'] as $listaPdf):
							 $texto .= "<br>";
						?>
							<br>
							<?php if(!empty($listaPdf['exibe'])):	
                                $texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listaPdf['codigo'] . "&MOD=SV2&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/" .$dados['dados']['titulo_box_1']."/". $horarioAno2[2] . "/" . retiraBarras($listDados['instituicao']) . "/" . retiraBarras($listaPdf['descricaoArquivo'])) . "'>";
                                $texto .= $listaPdf['descricaoArquivo'] . "</a>";
                                ?>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['codigo'] ;?>&MOD=SV2&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_1']."/".$horarioAno2[2]."/".retiraBarras($listDados['instituicao'])."/".retiraBarras($listaPdf['descricaoArquivo'])) ?>">
									<?php echo $listaPdf['descricaoArquivo'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						 $texto .= "</td>"?>	
						</td>
                        <td><?php echo $listDados['instituicao']; $texto .= "<td>" . $listDados['instituicao'] . "</td>";?></td>
                        <td><?php echo $listDados['dataAtualizacao']; $texto .= "<td>" . $listDados['dataAtualizacao'] . "</td><td>";?> </td>
						<td>
						<?php foreach($listDados['aditivos'] as $listAditivo):
							$texto .= "<br>";
							$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listAditivo['codigo'] . "&MOD=SV13&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_1']."/" . $horarioAno2[2] . "/" .retiraBarras($listDados['instituicao']). "/".retiraBarras($listAditivo['descricaoArquivo']))."'>";
							$texto .= $listAditivo['descricaoArquivo'] . "</a>";
                        ?>
						<br><a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listAditivo['codigo'] ;?>&MOD=SV13&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_1']."/".$horarioAno2[2]."/".retiraBarras($listDados['instituicao'])."/".retiraBarras($listAditivo['descricaoArquivo'])) ?>"><?php echo $listAditivo['descricaoArquivo'];?></a>
						<?php endforeach;
						$texto .= "</td>"?>	
						</td>
                </tr>
				<?php	endif; 
				}
				}
				?>	
				   </table>
				   <?php 
					//Aqui conteém o HTML que vai ser trandormado em PDF.
					$htmlPDF = "<h3>".$dados['dados']['titulo_box_1']."</h3>";
					$htmlPDF .= "<h4>" . $ano . "</h4>";
					$htmlPDF .= "<table border=1 id='tabela_" . $ano . "' cellspacing=0 cellpadding=5 >
								<tr>
									<th>Termo de Cooperação</th>
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
		}
		}
?>	
		
		
		
		
        </div>
    </div>
    <div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_2'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao2($dados['listaParceria']); ?></small>
            </div>

		<?php
        $ano = 0;
        foreach ($dados['listaParceria'] as $list2) {
		foreach ($list2 as $list) {
			if(!empty($list['dataFimVigencia'])){
				$horarioAno = explode("/",$list['dataFimVigencia']);
				if($ano != $horarioAno[2]):
					$ano = $horarioAno[2];
					?>
				<div class="row report">
					<ul>
						<li class="titulo"><?php echo $horarioAno[2];?></li>
						<li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
					</ul>
				</div>
				<div class="row botoes w100">
					<a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							PDF
						</a>
						<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'xml');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							XML
						</a>
						<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'csv');">
							<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
							CSV
						</a>
						<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('tabela2_export_<?= $ano; ?>', 'export', '', this);">
							<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
							IMPRIMIR
						</a>
					<div class="clearfix"></div>
					<div class="spacer"></div>
					<div class="spacer"></div>
					<table id="tabela_2_<?= $ano; ?>">
					<thead>
					<tr>
							<th>Termo de Parceria</th>
							<th>Instituto</th>
							<th>Vigência (até)</th>
							<th>Aditivos</th>
					</tr>
					</thead>
				<?php	
				$texto = "";
				foreach($dados['listaParceria'] as $listDados2){
				foreach($listDados2 as $listDados){
				$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
					if($horarioAno2[2] == $horarioAno[2]):
						$texto .= '<tr><td>';
					?>
					<tr>
							<td>
							<?php foreach($listDados['termos'] as $listaPdf):
								$texto .= "<br>";
							?>
								<br>
								<?php if(!empty($listaPdf['exibe'])):	
									$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listaPdf['codigo'] . "&MOD=SV3&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/" .$dados['dados']['titulo_box_2']."/". $horarioAno2[2] . "/" . retiraBarras($listDados['instituicao']) . "/" . retiraBarras($listaPdf['descricaoArquivo'])) . "'>";
									$texto .= $listaPdf['descricaoArquivo'] . "</a>";
								?>
								<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['codigo'] ;?>&MOD=SV3&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_2']."/".$horarioAno2[2]."/".retiraBarras($listDados['instituicao'])."/".retiraBarras($listaPdf['descricaoArquivo'])) ?>">
										<?php echo $listaPdf['descricaoArquivo'];?>
								</a>	
								<?php  endif;	?>
							<?php endforeach;
						 		$texto .= "</td>";?>	
							</td>
							<td><?php echo $listDados['instituicao']; $texto .= "<td>" . $listDados['instituicao'] . "</td>";?></td>
							<td><?php echo $listDados['dataAtualizacao']; $texto .= "<td>" . $listDados['dataAtualizacao'] . "</td><td>";?> </td>
							<td>
							<?php foreach($listDados['aditivos'] as $listAditivo):
								$texto .= "<br>";
								$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listAditivo['codigo'] . "&MOD=SV14&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_2']."/" . $horarioAno2[2] . "/" .retiraBarras($listDados['instituicao']). "/".retiraBarras($listAditivo['descricaoArquivo']))."'>";
								$texto .= $listAditivo['descricaoArquivo'] . "</a>";
							?>
							<br><a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listAditivo['codigo'] ;?>&MOD=SV14&MOD=SV3&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_2']."/".$horarioAno2[2]."/".retiraBarras($listDados['instituicao'])."/".retiraBarras($listAditivo['descricaoArquivo'])) ?>"><?php echo $listAditivo['descricaoArquivo'];?></a>
							<?php endforeach;
							$texto .= "</td>";
							?>	
							</td>
					</tr>
					<?php	endif; 
					}
					}?>	
					   </table>
					<?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>".$dados['dados']['titulo_box_2']."</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1 id='tabela_2_" . $ano . "' cellspacing=0 cellpadding=5 >
									<tr>
										<th>Termo de Parceria</th>
										<th>Instituto</th>
										<th>Vigência (até)</th>
										<th>Aditivos</th>
									</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
					<div style="display:none;"><input id="table_2_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
					<div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
					<div class="clearfix"></div>
				</div>
			<?php	endif; 
			}else{
			echo "Não há registro.";
			}
		}
		}?>	
		
        </div>
    </div>
	<div class="row conteudo" data-aba-id="3">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_box_3'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['listaCompromisso']); ?></small>
            </div>
		
		<?php
        $ano = 0;
        foreach($dados['listaCompromisso'] as $list){
		    $horarioAno = explode("/",$list['dataFimVigencia']);
			if($ano != $horarioAno[2]):
				$ano = $horarioAno[2];
				?>
			<div class="row report">
                <ul>
                    <li class="titulo"><?php echo $horarioAno[2];?></li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('3_<?= $ano; ?>');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						PDF
					</a>
					<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('3_<?= $ano; ?>', 'xml');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						XML
					</a>
					<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('3_<?= $ano; ?>', 'csv');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						CSV
					</a>
					<a href="#conteudo" role="button"  class="download" onClick="javascript:baixarDocumento('tabela3_export_<?= $ano; ?>', 'export', '', this);">
						<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
						IMPRIMIR
					</a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_3_<?= $ano; ?>">
				<thead>
				<tr>
                        <th>Termo de Compromisso</th>
                        <th>Instituto</th>
                        <th>Vigência (até)</th>
                        <th>Aditivos</th>
                </tr>
				</thead>
			<?php	
			$texto = "";
			foreach($dados['listaCompromisso'] as $listDados):
			$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
				if($horarioAno2[2] == $horarioAno[2]):
					$texto .= '<tr><td>';
				?>
				<tr>
                        <td>
						<?php foreach($listDados['termos'] as $listaPdf):
							$texto .= "<br>";
						?>
							<br>
							<?php if(!empty($listaPdf['exibe'])):	
								$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listaPdf['codigo'] . "&MOD=SV4&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/" .$dados['dados']['titulo_box_3']."/". $horarioAno2[2] . "/" . retiraBarras($listDados['instituicao']) . "/" . retiraBarras($listaPdf['descricaoArquivo'])) . "'>";
								$texto .= $listaPdf['descricaoArquivo'] . "</a>";
							?>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['codigo'] ;?>&MOD=SV4&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_3']."/".$horarioAno2[2]."/".retiraBarras($listDados['instituicao'])."/".retiraBarras($listaPdf['descricaoArquivo'])) ?>">
									<?php echo $listaPdf['descricaoArquivo'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						$texto .= "</td>";
						?>	
						</td>
						<td><?php echo $listDados['instituicao'];
							$texto .= "<td>" . $listDados['instituicao'] . "</td>";
							?>
						</td>
						<td><?php echo $listDados['dataAtualizacao'];
						$texto .= "<td>" . $listDados['dataAtualizacao'] . "</td><td>";
						?> </td>
						<td>
						<?php foreach($listDados['aditivos'] as $listAditivo):
							$texto .= "<br>";
							$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listAditivo['codigo'] . "&MOD=SV15&niveis=" . urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_3']."/" . $horarioAno2[2] . "/" .retiraBarras($listDados['instituicao']). "/".retiraBarras($listAditivo['descricaoArquivo']))."'>";
							$texto .= $listAditivo['descricaoArquivo'] . "</a>";
						?>
						<br><a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listAditivo['codigo'] ;?>&MOD=SV15&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Termos de Cooperação Compromisso e Parceria/".$dados['dados']['titulo_box_3']."/".$horarioAno2[2]."/".retiraBarras($listDados['instituicao'])."/".retiraBarras($listAditivo['descricaoArquivo'])) ?>"><?php echo $listAditivo['descricaoArquivo'];?></a>
						<?php endforeach;
							$texto .= "</td>";
						?>	
						</td>
                </tr>
				<?php	endif; 
				endforeach;?>	
				   </table>
				   <?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>".$dados['dados']['titulo_box_3']."</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1 id='tabela_3_" . $ano . "' cellspacing=0 cellpadding=5 >
									<tr>
										<th>Termo de Compromisso</th>
										<th>Instituto</th>
										<th>Vigência (até)</th>
										<th>Aditivos</th>
									</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
					<div style="display:none;"><input id="table_3_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
					<div style="display:none;" id="tabela3_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		}?>	
		
			
        </div>
    </div>

</div>







