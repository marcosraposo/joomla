<?php 
defined('_JEXEC') or die;
//error_reporting(0);
$dataHoje = date("d/m/Y");
require_once 'func.php';
$ordernar = false;
$i = 0;
foreach($list as $group){
	$horarioAno2 = explode("/",$group['dataPublicacao']);
	if(!empty($horarioAno2[2])){
		$ordernar = true;
		$list[$i]['anoRevista'] = $horarioAno2[2];
		$i++;
	}
}
if($ordernar){
	array_sort_by($list, 'anoRevista', $order = SORT_ASC);
}
?>


	
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
		<div class="col-12">
		<div class="row">
                <div class="titulo">REVISTA ARGUMENTO</div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($list); ?></small>
            </div>
<?php	
            $ano = 0;
            for($i=count($list)-1; $i>=0; $i--){
                $atas = $list[$i];
				$horarioAno = explode("/",$atas['dataPublicacao']);
                if($ano != $horarioAno[2]){
                    $ano = $horarioAno[2];
                    ?>
                <div class="row report">
                    <ul>
                        <li class="titulo" style="width: 50px;"><?php echo $horarioAno[2];?></li>
                        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                    </ul>
                </div>
                <div class="row botoes ">
					<div class="row">
						<?php
						foreach($list as $listDados){
						$anoRevista =  explode("/",$listDados['dataAtualizacao']);
						if($horarioAno[2] == $anoRevista[2]){
						$ano = $anoRevista[2]; ?>
						<div class="col-3">
									<?php echo  "<a  href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$listDados['id']."&MOD=SV33&niveis=".urlencode("IMPRENSA/Revista Argumento/".$listDados['nomeArquivo'])."'>
													<img width='150' role='img' class='img-thumbnail' src='".$listDados['linkImagem']."' alt='Capa da Revista ".$listDados['nomeArquivo']."'>
												</a>";?>
							<figcaption class="figure-caption"><?php echo $listDados['nomeArquivo'];?> </figcaption>
						</div>
						<?php
							}
						} ?>
					</div>			
                </div>
            <?php	}; 
            }?>	
        </div>
	</div>
</div>		