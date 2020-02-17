<?php defined('_JEXEC') or die;

//ordenar lista por array
require_once 'func.php';

function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();

	if(is_array($array) && !empty($array)){
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if($i==0){
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
			}else{
				$dataTemp = DateTime::createFromFormat('d/m/Y', $relatorio['dataAtualizacao']);
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
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

$ordernar = false;
$i = 0;
foreach($dados['listaConvOrgao']['return'] as $group  ){
	$horarioAno2 = explode("/",$group['dataFimVigencia']);
	if(!empty($horarioAno2[2])){
		$ordernar = true;		
		 $dados['listaConvOrgao']['return'][$i]['anoCotacao'] = $horarioAno2[2];
		 $i++;
	}
}

if($ordernar){
	array_sort_by($dados['listaConvOrgao']['return'], 'anoCotacao', $order = SORT_ASC);
}

$ordernar = false;
$i = 0;
foreach($dados['listaConvInstituicao']['return'] as $group  ){


	$horarioAno2 = explode("/",$group['dataFimVigencia']);
	if(!empty($horarioAno2[2])){
		$ordernar = true;		
		 $dados['listaConvInstituicao']['return'][$i]['anoCotacao'] = $horarioAno2[2];
		 $i++;
	}
}

if($ordernar){
	array_sort_by($dados['listaConvInstituicao']['return'], 'anoCotacao', $order = SORT_ASC);
}

//var_dump($dados['listaConvOrgao']['return']); die();

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
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_tab_1'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['listaConvOrgao']['return']) ?></small>
            </div>
		<?php
		$ano = 0;
		for($i=count($dados['listaConvOrgao']['return'])-1; $i>=0; $i--){
			$list = $dados['listaConvOrgao']['return'][$i];
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
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
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
						<th>Convênio</th>
						<th>Instituto</th>
						<th>Vigência (até)</th>
						<th>Aditivos</th>
					</tr>
				</thead>
			<?php
			$texto = "";	
			foreach($dados['listaConvOrgao']['return'] as $listDados):
				$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
				if($horarioAno2[2] == $horarioAno[2]):

					$texto .= '<tr><td>';
				?>
				<tr>
                    <td>
						<?php foreach($listDados['convenios'] as $listaPdf):
						$texto .= "<br>";
						?>
							<br>
							<?php if(!empty($listaPdf['exibe'])):	
							$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=".$listaPdf['id']."&MOD=SV10&niveis=".urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_1']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao']))."'>";
							$texto .= $listaPdf['descricao']."</a>";
							?>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['id'] ;?>&MOD=SV10&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_1']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao'])) ?>">
									<?php echo $listaPdf['descricao'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						$texto .= "</td>"
						?>	
					</td>
					<td>
					<?php echo $listDados['descricaoInstituicao']; 
						$texto .="<td>".$listDados['descricaoInstituicao']."</td>";
					?>
					</td>
					<td>
					<?php echo $listDados['dataFimVigencia'];
						$texto .="<td>".$listDados['dataFimVigencia']."</td><td>";
					?> 
					</td>
					<td>
						<?php foreach($listDados['anexos'] as $listaPdf):
						$texto .= "<br>";
						?>
							<br>
							<?php if(!empty($listaPdf['exibe'])):	
								$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=".$listaPdf['id']."&MOD=SV11&niveis=".urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_1']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao']))."'>";
								$texto .= $listaPdf['descricao']."</a>";
							?>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['id'] ;?>&MOD=SV11&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_1']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao'])) ?>">
									<?php echo $listaPdf['descricao'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						$texto .= "</td>"
						?>	
					</td>
                </tr>
				<?php	endif;
				endforeach;?>	
				   </table>
				   <?php 
					//Aqui conteém o HTML que vai ser trandormado em PDF.
					$htmlPDF = "<h3>".$dados['dados']['titulo_tab_1']."</h3>";
					$htmlPDF .= "<h4>".$ano."</h4>";
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
		}?>	
			
        </div>
    </div>
	<div class="row conteudo" data-aba-id="2">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_tab_2'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['listaConvInstituicao']['return']); ?></small>
            </div>
<?php
		$ano = 0;
		for($i=count($dados['listaConvInstituicao']['return'])-1; $i>=0; $i--){
			$list = $dados['listaConvInstituicao']['return'][$i];
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
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>', 'pdf');">
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
                         <th>Convênio</th>
                        <th>Instituto</th>
                        <th>Vigência (até)</th>
                        <th>Aditivos</th>
					</tr>
					</thead>
			<?php	
			
			foreach($dados['listaConvInstituicao']['return'] as $listDados):
			$texto = "";			
			$horarioAno2 = explode("/",$listDados['dataFimVigencia']);
				if($horarioAno2[2] == $horarioAno[2]):
					$texto .= '<tr><td>';
				?>
				<tr>
					<td>
						<?php foreach($listDados['convenios'] as $listaPdf):?>
							<?php if(!empty($listaPdf['exibe'])):	
							$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=".$listaPdf['id']."&MOD=SV10&niveis=".urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_2']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao']))."'>";
							$texto .= $listaPdf['descricao']."</a>";
							?>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['id'] ;?>&MOD=SV10&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_2']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao'])) ?>">
									<?php echo $listaPdf['descricao'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;?>	
					</td>
					<td>
					<?php echo $listDados['descricaoInstituicao'];
						$texto .="<td>".$listDados['descricaoInstituicao']."</td>";
					?></td>
					<td><?php echo $listDados['dataFimVigencia'];
						$texto .="<td>".$listDados['dataFimVigencia']."</td><td>";?> 
					</td>
					<td>
						<?php foreach($listDados['anexos'] as $listaPdf):?>
							<?php if(!empty($listaPdf['exibe'])):	
								$texto .= "<a href='index.php/gestao-orcamentaria/resultado-pdf?/id=".$listaPdf['id']."&MOD=SV11&niveis=".urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_2']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao']))."'>";
								$texto .= $listaPdf['descricao']."</a>";?>
							<a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $listaPdf['id'] ;?>&MOD=SV11&niveis=<?php echo urlencode("CONVÊNIOS E ACORDOS/Convênios com Orgãos Instituições E Sistemas/".$dados['dados']['titulo_tab_2']."/".$horarioAno2[2]."/".retiraBarras($listDados['descricaoInstituicao'])."/".retiraBarras($listaPdf['descricao'])) ?>">
									<?php echo $listaPdf['descricao'];?>
							</a>	
							<?php  endif;	?>
						<?php endforeach;
						$texto .= "</td>"?>	
					</td>
                </tr>		
				<?php	endif;
				endforeach;?>	
				   </table>
				   <?php 
					//Aqui conteém o HTML que vai ser trandormado em PDF.
					$htmlPDF = "<h3>".$dados['dados']['titulo_tab_2']."</h3>";
					$htmlPDF .= "<h4>".$ano."</h4>";
					$htmlPDF .= "<table border=1 id='tabela_2_" . $ano . "' cellspacing=0 cellpadding=5 >
							<tr>
								<th>Convênio</th>
								<th>Instituto</th>
								<th>Vigência (até)</th>
								<th>Aditivos</th>
							</tr>";
					$htmlPDF .= str_replace("<br />", "", $texto);
					$htmlPDF .= str_replace("<br>", "", $texto);
					$htmlPDF .= "</table>";
					?>
					<div style="display:none;"><input id="table_2_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
					<div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                <div class="clearfix"></div>
            </div>
		<?php	endif; 
		}?>	
        </div>
    </div>
	<div class="row conteudo" data-aba-id="3">
        <div class="col-12">
            <div class="row">
                <div class="titulo"><?= $dados['dados']['titulo_tab_3'] ?></div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['listaConvMinisterio']['return']); ?></small>
            </div>                       				
		<?php	
		foreach($dados['listaConvMinisterio']['return'] as $listDados):			
			?>	
			<div class="spacer"></div>
			<div class="spacer"></div>
			<div class="row">
				<b><?php echo $listDados['descricaoConvenio'];?></b>
			</div>
			<div class="spacer"></div>			
			 <div class="row">
				<?php echo nl2br($listDados['observacao']); ?>
			</div>
			<div class="row">
				<ul class="ul-btn">
					<li><div class="box aj-btn" style="color: #0275d8;">Acordo de Cooperação Técnica</div></li>
					<li><a href="<?php echo $listDados['linkSistema'];?>" role="button" target="_blank"><div class="box aj-btn" style="color: #0275d8;"><?php echo $listDados['linkSistema'];?></div></a></li>					
					<li><div class="box aj-btn" style="color: #0275d8;">Coordenador Master</div></li>
				</ul>    
			</div>
			<?php 	
			endforeach;?>	
		   <div class="clearfix"></div>
		   <div class="spacer"></div>
		   <div class="row">
				<small>Informações atualizadas pela Secretaria Judiciária.<br/>Dúvidas ou sugestões, fone (81) 3425-9136.</small>
			</div>            	
        </div>		
    </div>
</div>
