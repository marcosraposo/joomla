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
?>
<div class="row conteudo" data-aba-id="3">
	<div class="col-12">
		<div class="row">
			<div class="titulo">Relatórios Mensais das Contratações Diretas 2008 à 2013</div>
		</div>
		<div class="row">
			<small>Última atualização: <?php echo getDataAtualizacao($dados['listaContratacaoDireta']['return']); ?></small>
		</div>
		<?php
			$ano = 0;
			//foreach($dados['listaContratacaoDireta']['return'] as $list):
			for ($i=0; $i<= count($dados['listaContratacaoDireta']['return'])-1; $i++){
				$list = $dados['listaContratacaoDireta']['return'][$i];
		?>
		<div class="row">
			<?php
			if($ano != $list['ano']):
				$ano = $list['ano'];
				?>
				<ul>
				<li onclick="window.location.href='../gestao-orcamentaria/resultado-pdf?/id=<?php echo $list['id'] ;?>&MOD=SV5&niveis=<?php echo urlencode('LICITAÇÕES E CONTRATOS/Contratações Diretas/Relatórios Mensais das Contratações Diretas 2008 à 2013/'.$list['ano'])?>'"><?php echo $list['ano'];?></li>
				<?php foreach($dados['listaContratacaoDireta']['return'] as $listDados):
					if($list['ano'] == $listDados['ano']):?>
						<a  href="#conteudo" onclick="window.location.href='../gestao-orcamentaria/resultado-pdf?/id=<?php echo $listDados['id'] ;?>&MOD=SV5&niveis=<?php echo urlencode('LICITAÇÕES E CONTRATOS/Contratações Diretas/Relatórios Mensais das Contratações Diretas 2008 à 2013/'.$list['ano'].'/'.$listDados['mes'])?>'"><?php echo $listDados['mes'];?> </a> 
					<?php endif;
				endforeach;?>
				</ul>			
			<?php	endif; ?>

		</div>
			<?php } ?>
	</div>
</div>