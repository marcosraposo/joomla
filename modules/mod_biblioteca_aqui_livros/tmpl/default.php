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
              ?>
                 	<div class="col-sm-2">
					<?php
					echo "<a role='img' href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$atas['id']."&MOD=SV32&niveis=".urlencode("BIBLIOTECA/Novas Aquisições/LIVROS/".$atas['nomeArquivo'])."'>
							<img class='img-thumbnail' src='".$atas['linkImagem']."' alt='".$atas['nomeArquivo']."'>
						</a>";
					?>
                    <figcaption class="figure-caption"><?php echo $atas['nomeArquivo'];?> <br>Autor:<?php echo $atas['autor'];?><br>Ano: <?php echo $atas['dataAtualizacao'];?></figcaption>
                  </div>
            <?php 
            }
 exit;	
}

?>

        <div class="col-12">
            <div class="row">
              <div class="col-12">
                <div class="row"  id="telaAquisicaoLivros">
				<?php
				$ano = 0;
				$pagina = "0";
				$totalArquivo = "";
				foreach($list['return'] as $atas){
					$pagina = $atas['pagina'];
					$totalArquivo = $atas['totalArquivo'];
					$horarioAno = explode("/",$atas['dataPublicacao']);
               
                    $ano = $horarioAno[2];?>
                 	<div class="col-sm-2">
					<?php
					echo "<a role='img' href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$atas['id']."&MOD=SV32&niveis=".urlencode("BIBLIOTECA/Novas Aquisições/LIVROS/".$atas['nomeArquivo'])."'>
							<img class='img-thumbnail' src='".$atas['linkImagem']."' alt='".$atas['nomeArquivo']."'>
						</a>";
					?>
                    <figcaption class="figure-caption"><?php echo $atas['nomeArquivo'];?> <br>Autor:<?php echo $atas['autor'];?><br>Ano: <?php echo $atas['dataAtualizacao'];?></figcaption>
					</div>
				<?php } ?>	
                </div>
              </div>   
            </div>
            <div class="spacer"></div>
        </div>   
		
<div style="display:none">
<input value="<?php echo $totalArquivo; ?>" id="telaAquisicaoLivros_arquivo">
<input value="<?php echo $pagina; ?>" id="telaAquisicaoLivros_pagina">		
</div>



<?php if($totalArquivo >= $pagina ){ ?>	
<center>
	<div class="row" style="margin: 0 auto;">
      <div class="col-12">
        <button id="buttonLoadMore" class="button-load-more" onClick="javaScript:consultaAquisicaoLivros(<?php echo $pagina;?>);" value="Carregar mais"  >
          Carregar Mais
        </button>
      </div>
    </div>
</center>
<?php	} ?>


		