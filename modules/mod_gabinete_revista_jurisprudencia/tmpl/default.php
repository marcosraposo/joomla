<?php 
defined('_JEXEC') or die;
require_once 'func.php';

//Validacao para exibir apenas os registros que contem link.
$listRevistas = array();
foreach ($list as $lista) {
	if (!empty($lista['linkImagem']) && $lista['linkImagem'] != "") {
		array_push($listRevistas, $lista);
	}
}
$list = $listRevistas;

$dataHoje = date("d/m/Y");
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
	
<div class="row conteudo selecionado" data-aba-id="1">
	<div class="col-12">
		<div class="row">
			<div class="titulo">Listas das Revistas</div>
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

							array_sort_by($list, 'dataPublicacao', $order = SORT_ASC);
							foreach($list as $listDados){
								$anoRevista =  explode("/",$listDados['dataAtualizacao']);
								if($horarioAno[2] == $anoRevista[2]){
									$ano = $anoRevista[2]; ?>
									<div class="col-3">
												<?php echo  "<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$listDados['id']."&MOD=SV31&niveis=".urlencode("GABINETE REVISTA/REVISTAS DE JURISPRUDÊNCIA/".$listDados['descricao'])."'>
																<img role='img' 
																style=' padding: .25rem;    background-color: #fff;    border: 1px solid #ddd;    border-radius: .25rem; transition: all .2s ease-in-out;  max-width: 122px;    height: 170'
																 src='".$listDados['linkImagem']."' alt='Capa da Revista ".$listDados['descricao']."'>
															</a>";?>
										<figcaption class="figure-caption"><?php echo $listDados['descricao'];?> </figcaption>
									</div>
							<?php
								}
							} ?>
						</div>			
                	</div>
				<?php	
				}; 
            }?>	
	</div>
</div>