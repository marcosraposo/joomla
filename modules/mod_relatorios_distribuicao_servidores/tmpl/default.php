<?php defined('_JEXEC') or die; 

include_once 'func.php';
	array_sort_by($list['distribuicaoServidoresCargosComissao']['anos'], 'ano', $order = SORT_DESC);

	function retiraBarras($string){
		$string = str_replace("/", "&#47;", $string);
		return $string;
	}

	$tituloNiveis = "GESTÃO DE PESSOAS/Distribuição de Servidores, Cargos e Funções de Confiança";
?>

<div style="display:none;">
	<input type="text" id="idMesOcultar" value="vazio"/>
</div>
<div class="container demonstrativo bg_azul_fundo">
	
	<div class="row conteudo selecionado">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Tabelas de Lotação de Pessoal (TLPS)</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['distribuicaoServidoresCargosComissao']) ?></small>
			</div>

			<?php 

				function detalhamentoRelatorio($botaoResultado, $anoMes){
					$botao = "";
						$botao .= "
							<div class='row botoes2' style='display: none' id='".$anoMes."'> 
								<ul>
									$botaoResultado 
								</ul>    
								<div class='clearfix'></div>                         
							</div>
							";

					return $botao;
				}

				foreach($list['distribuicaoServidoresCargosComissao'] as $lista2){
				if(is_array($lista2)){
					$ano = "";
					$conjBotoes = "";	
					$mesOrdem  = "";
					foreach($list['distribuicaoServidoresCargosComissao']['anos'] as $anos){
					
						if($ano != $anos['ano']){
							$ano = $anos['ano'];
							echo "<div class='row report'>
										<ul id='nav'>";
							echo "<li>".$anos['ano']."</li>";
						
						$botao = "";
						$mesOrdem = "";
						foreach($list['distribuicaoServidoresCargosComissao']['anos'] as $anos2){
							if($anos2['ano'] == $ano){
								foreach($anos2 as $meses2){
									if(is_array($meses2)){
										if($mesOrdem != $meses2[0]['descricaoMes']){
											$mesOrdem = $meses2[0]['descricaoMes'];
											$idAnoMes = $anos2['ano'].$meses2[0]['descricaoMes'];
											echo "<li><a href='#conteudo' onClick=\"javascript:exibirBotaoRelatorio('".$idAnoMes."', this)\">".$meses2[0]['descricaoMes']."</a></li>";
										}
										$id =  $meses2[0]['anexo']['id'];
										$botao .= "<li class='inline'><a href='#conteudo' role='button'  class='box' onClick=window.location.href='../gestao-orcamentaria/resultado-pdf?/id=$id&MOD=SV23&niveis=".urlencode('Distribuição de Servidores'.'/'.$anos2['ano'].'/'.$meses2[0]['anexo']['descricao']."/".retiraBarras($meses2[0]['anexo']['descricao']))."'>".$meses2[0]['anexo']['descricao']."</a></li>";
									}
								}
								$conjBotoes .= detalhamentoRelatorio($botao, $idAnoMes);
							}
						}
							echo "</ul></div>";
					}
					echo $conjBotoes;
					}

				}
			}
			?>
			
		</div>
	</div>

</div>
