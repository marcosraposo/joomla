<?php 
defined('_JEXEC') or die;

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

	//recebe o título da página
    $titulo = $params->get('titulo');
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
				<?php
				$ano = 0;
				for($i=count($list)-1; $i>=0; $i--){
					$revista = $list[$i];
					$dataAno = explode("/", $revista['dataAtualizacao']);
					$horarioAno = $dataAno[2];
					
					if($ano != $horarioAno):
						$ano = $horarioAno;
					?>
					<div class="row report">
						<ul>
							<li class="titulo"><?php echo $horarioAno;?></li>
							<li class="arrow-down"><img src="templates/portalTRF5/images/arrow_down_2.svg"></li>
						</ul>
					</div>
					<div class="row botoes w100">
						<div class="clearfix"></div>
						<div class="container-revista">
						<?php	
						$texto = "";
						foreach($list as $listDados):
							$dataAno = explode("/", $listDados['dataAtualizacao']);
							$horarioAno2 = $dataAno[2];
							if($horarioAno2 == $horarioAno):
								foreach($listDados['editais'] as $listaRevista):
									if($listaRevista['exibe'] == "true"){
										$texto .= "<div class='box-revista'>";
										$texto .= "
										<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$listaRevista['codigo']."&MOD=SV24&niveis=".urlencode("IMPRENSA/Revista Argumento/".$horarioAno2."/".retiraBarras($listaRevista['descricaoArquivo']))."'>
										<img width='150' src='../templates/portalProcessosConsultas/images/p-revista.svg' alt=' Capa Revista - ".$listaRevista['descricaoArquivo']."' style='width: 243px;'>
										<span class='title-revista'>".$listaRevista['descricaoArquivo']."</span>
										</a>
										</div>";
									}
								endforeach;
							endif;
						endforeach;
						echo $texto;
						?>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php	endif; 
				}?>	
			
		</div>
	</div>
</div>