<?php defined('_JEXEC') or die;
$dataHoje = date("d/m/Y");
require_once 'func.php';
$ordernar = false;
$i = 0;
foreach($list as $group){
	$horarioAno2 = explode("/",$group['dataPublicacao']);
	if(!empty($horarioAno2[2])){
		$ordernar = true;
		$list[$i]['anorevista'] = $horarioAno2[2];
		$i++;
	}
}

if($ordernar){
	array_sort_by2($list, 'anorevista', $order = SORT_ASC);
}																	?>
		<div class="row">
            <div class="titulo">Listas dos Boletins</div>                
        </div>   
        <div class="row">
             <small>Última atualização: <?php echo getDataAtualizacaoBoletim($list); ?></small>
        </div>
<?php   $ano = 0;
        for($i=count($list)-1; $i>=0; $i--){
			$atas = $list[$i];
			$horarioAno = explode("/",$atas['dataPublicacao']);
			if($ano != $horarioAno[2]){
                $ano = $horarioAno[2];				                 ?>
				<div class="row report">
				<ul>
                <li><?php echo $horarioAno[2];?></li>
					<table  id="tabela_<?= $ano; ?>" >
					<thead>
                        <tr>
<?php					$texto = "";
						foreach($list as $listDados){
						$horarioAno2 = explode("/",$listDados['dataPublicacao']);
							if($horarioAno2[2] == $ano){
								$texto .= "<li>
								<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$listDados['id']."&MOD=SV30&niveis=".urlencode("GABINETE REVISTA/JURISDIÇÃO - PUBLICAÇÕES/BOLETIM")."'>
								".$listDados['descricao']." </a></li>";
							}
						}
						echo $texto;								?>
						</tr>
					</thead>
					</TABLE>
				</ul>                
				</div> 
              
<?php		} 
		}															?>