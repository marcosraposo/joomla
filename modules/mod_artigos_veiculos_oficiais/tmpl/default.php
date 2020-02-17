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

?>

<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado" data-aba-id="1">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Relação de Veículos - TRF-5ª Região</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['veiculosTRF']);?></small>
			</div>
			<div class="row report">
				<ul>
					<?php foreach($list['veiculosTRF'] as $itemTrf): ?>
						<?php if(!empty($itemTrf['exibe'])):	?>
							<li class="titulo pointer">
								<a style="text-decoration: none" href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?= $itemTrf['id'] ?>&MOD=SV6&niveis=<?php echo urlencode('GESTÃO PATRIMONIAL/VEÍCULOS OFICIAIS/Relação de Veículos - TRF-5ª Região/'.$itemTrf['ano']); ?>">
									<?= $itemTrf['ano'] ?>
								</a>
							</li>
						<?php  endif;	?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="titulo">Relatório Geral de Veículos - Todas as Seções e Subseções</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['veiculosSecoes']);?></small>
			</div>
			<div class="row report">
				<ul>
					<?php foreach($list['veiculosSecoes'] as $itemSecoes): ?>
						<?php if(!empty($itemSecoes['exibe'])):	?>
							<li class="titulo pointer">
								<a style="text-decoration: none" href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?= $itemSecoes['id'] ?>&MOD=SV7&niveis=<?php echo urlencode('GESTÃO PATRIMONIAL/VEÍCULOS OFICIAIS/Relatório Geral de Veículos - Todas as Seções e Subseções/'.$itemSecoes['ano']); ?>">
									<?= $itemSecoes['ano'] ?>
								</a>
							</li>
						<?php  endif;	?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
