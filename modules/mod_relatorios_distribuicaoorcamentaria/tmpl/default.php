<?php defined('_JEXEC') or die; 
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
$lista = null;
if(empty($list['distribuicaoOrcamentaria'][0])){
	$lista['distribuicaoOrcamentaria'][0] = $list['distribuicaoOrcamentaria'];
}else{
	$lista['distribuicaoOrcamentaria'] = $list['distribuicaoOrcamentaria'];
}																				?>
<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Distribuição Orçamentária</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($lista['distribuicaoOrcamentaria'])?></small>
			</div>
<?php 			$anoTermo = 0; 
				foreach($lista['distribuicaoOrcamentaria'] as $dados ){
					if ($anoTermo != $dados['ano']) {
						$anoTermo = $dados['ano'];								?>
					<div class="row report">
						<ul>
							<li class="titulo"><?= $dados['ano']; ?></li>
							<li class="arrow-down">
								<a href="#report"><img src="templates/portalTRF5/images/arrow_down_2.svg"></a>
							</li>
						</ul>
					</div>
					<div class="row botoes" >
						<ul>
							<?php foreach ($lista['distribuicaoOrcamentaria'] as $arquivo): ?>
								<?php if ($dados['ano'] == $arquivo['ano']) : 	?>
									<li class="inline">
										<div class="box" role="button"><a href='../gestao-orcamentaria/resultado-pdf?/id=<?= $arquivo['id'] ;?>&MOD=SV16&niveis=<?php echo urlencode('GESTÃO ORÇAMENTÁRIA/DISTRIBUIÇÃO ORÇAMENTÁRIA/'.$dados['ano'].'/'.retiraBarras($arquivo['descricao'])) ?>'>
											<?= $arquivo['descricao']; ?></a>
										</div>
									</li>
<?php 								endif; ?>
<?php 							endforeach; ?>
						</ul>
						<div class="clearfix"></div>
					</div>
<?php		} 																	?>
<?php } 																		?>
		</div>
	</div>
</div>
