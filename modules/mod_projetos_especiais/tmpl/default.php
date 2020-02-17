<?php 
require_once 'func.php';

$ordernar = false;

foreach($dados['dados'] as $group2){
	$horarioAno3 = explode("-",$group2->publish_up);
	if(!empty($horarioAno3[0])){
		$ordernar = true;
		$group2->anocotacao = $horarioAno3[0];
	}
}

if($ordernar){
	array_sort_by($dados['dados'], 'anocotacao', $order = SORT_DESC);
}



?>
<div class="container demonstrativo bg_azul_fundo" style="padding-bottom: 40px;">
    <div class="row conteudo selecionado responsivo">
        <div class="col-12">
		<div class="row">
                <div class="titulo">Projetos Especiais</div>                
            </div>   
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacaoArtigo($dados['dados'])?></small> 
				<?php echo $dados['params']['titulo_tab_1']; ?>
            </div>
            <div class="spacer"></div> 
			<?php
			$ano = 0;
			foreach($dados['dados'] as $group){
				if($group->parent_id == "59"){
					$horarioAno = explode("-",$group->publish_up);
					if($ano != $horarioAno[0]){
					$ano = $horarioAno[0];
					?>
							<div class="row report">
								<ul>
									<li><?php echo $horarioAno[0]; ?></li>
									<li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
								</ul>                
							</div>     
					
					<div class="row botoes pt-2">
					<?php
						foreach($dados['dados'] as  $listDados){
							$horarioAno2 = explode("-",$listDados->publish_up);
							if($horarioAno2[0] == $ano && $listDados->parent_id == "59"){
							?>
                             	<div class="titulo lower pb-1 mt-0"><?php echo  $listDados->category_title; ?></div>
								   <?php echo  $listDados->introtext; ?>
								<div class="clearfix"></div>          
							<?php
							}
						}?>
						</div>
						<?php
					}
				}
			}
			?>
		
        </div>   
    </div>
</div>

