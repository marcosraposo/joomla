<?php 
defined('_JEXEC') or die;
$dataHoje = date("d/m/Y");
require_once 'func.php';
$pagina = $list['pagina'];
$limite = $list['limite'];

if(!empty($_GET['pagina'])){
			$ano = 0;
			$pagina = "0";
			$totalArquivo = "";
		
			foreach($list['return'] as $atas){
				$pagina = $atas['pagina'];
				$totalArquivo = $atas['totalArquivo'];

				$horarioAno = explode("/",$atas['dataPublicacao']);
				echo  "<a role='img' href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$atas['id']."&MOD=SV36&niveis=".urlencode("BIBLIOTECA/Novas Aquisições/LIVROS/".$atas['volumePublicacao'])."'>
					<img class='img-thumbnail' src='".$atas['linkImagem']."' alt='".$atas['nomeArquivo']."'>
				</a>";
				?>
                 	<div class="col-sm-2">
                    <figcaption class="figure-caption"><?php echo $atas['nomeArquivo'];?><br>Ano: <?php echo $atas['dataAtualizacao'];?><br>N.º: <?php echo $atas['numeroPublicacao'];?><br>Volume.º: <?php echo $atas['volumePublicacao'];?></figcaption>
                  </div>
            <?php	
            }
exit;
}


?>

        	  
        <div class="col-12">

            <div class="row">
              <div class="col-12">
                <div class="row" id="telaAquisicaoPeriodico">

				<?php
				$ano = 0;
				$pagina = "0";
				$totalArquivo = "";
				foreach($list['return'] as $atas){
					$pagina = $atas['pagina'];
					$totalArquivo = $atas['totalArquivo'];
					$horarioAno = explode("/",$atas['dataPublicacao']);
					echo  "<a role='img' href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$atas['id']."&MOD=SV36&niveis=".urlencode("BIBLIOTECA/Novas Aquisições/LIVROS/".$atas['volumePublicacao'])."'>
						<img class='img-thumbnail' src='".$atas['linkImagem']."' alt='".$atas['nomeArquivo']."'>
					</a>";
					?>
						<div class="col-sm-2">
						<figcaption class="figure-caption"><?php echo $atas['nomeArquivo'];?><br>Ano: <?php echo $atas['dataAtualizacao'];?><br>N.º: <?php echo $atas['numeroPublicacao'];?><br>Volume.º: <?php echo $atas['volumePublicacao'];?></figcaption>
					  </div>
				<?php	
				}
				
			 ?>
		
                </div>
              </div>   
            </div>
            <div class="spacer"></div>
        </div>    
		
<div style="display:none">
<input value="<?php echo $totalArquivo; ?>" id="telaAquisicaoPeriodico_arquivo">
<input value="<?php echo $pagina; ?>" id="telaAquisicaoPeriodico_pagina">		
</div>

<?php if($totalArquivo >= $pagina ){ ?>
<center>
	<div class="row divBotacaoCarregarPeriodico" style="margin: 0 auto;">
      <div class="col-12">
        <button id="buttonLoadMorePeriodico" class="button-load-more" onClick="javaScript:consultaAquisicaoPeriodico(<?php echo $pagina;?>);" value="Carregar mais"  >
          Carregar Mais
        </button>
      </div>
    </div>
</center>
<?php	} ?>	

		