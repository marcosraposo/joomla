<?php 
$WService = $params['url_webservice'];
?>

<div class="container demonstrativo bg_azul_fundo" style="padding-bottom: 40px;">
	<div class="row conteudo selecionado responsivo">
			<div class="col-12">
			<div class="titulo">Jornal Mural</div>
			<div id="dataAtualizacao"></div>
				<div class="row boxes">
					<a href="#conteudo" role="button"  class="box selecionado" onclick="exibirAnoJornalMuralImpressa('<?php echo date('Y');?>','<?php echo urlencode($WService); ?>')"><?php echo date('Y');?></a>
					<?php for($anoLista = date('Y')-1; $anoLista >= 2004; $anoLista--){?>
						<a href="#conteudo" role="button"  class="box" onclick="exibirAnoJornalMuralImpressa('<?php echo $anoLista;?>','<?php echo urlencode($WService); ?>')"><?php echo $anoLista;?></a>
					<?php } ?>
				</div>  
			<div style="display:none;">
			<input type="text" id="WService" value="<?php echo $WService; ?>"/>
			</div>
			<div  id="resultado"></div>
		</div> 
	</div>
</div> 	
	
	
	
	
	