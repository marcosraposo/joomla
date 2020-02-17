<?php defined('_JEXEC') or die; 

include_once'func.php';

function getDataAtualizacao($array){
	$dataAtualizacao = new DateTime();
	if(is_array($array) && !empty($array)){
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if($i==0){
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataPublicacao']));
			}else{
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataPublicacao']));
				if($dataTemp > $dataAtualizacao){
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}
	function getMeses($meses) {
		$retorno = array();
		for ($i = 0; $i < count($meses); $i++) { 
			if(is_array($meses[$i])){
				array_push($retorno, $meses[$i]);
			}
		}
		return $retorno;
	}
	function retiraBarras($string){
		$string = str_replace("/", "&#47;", $string);
		return $string;
	}
	
	

$ordernar = false;
$i1 = 0;
foreach ($list as  $group1) {
	foreach ($group1 as  $group) {
	$horarioAno2 = explode("/", $group['dataPublicacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list['dadosTratados'][$i1]['anoPublicacao'] = $horarioAno2[2];
		$list['dadosTratados'][$i1]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
		$list['dadosTratados'][$i1]['dataAtualizacao'] =  $group['dataAtualizacao'];
		$list['dadosTratados'][$i1]['dataPublicacao'] =  $group['dataPublicacao'];
		$list['dadosTratados'][$i1]['descricaoRevista'] =  $group['descricaoRevista'];
		$list['dadosTratados'][$i1]['id'] =  $group['id'];
	}
	$i1++;
	}
}	

if ($ordernar) {
	array_sort($list, 'dataNumero', $order = SORT_DESC);
}
	
?>

<div style="display:none;">
	<input type="text" id="idMesOcultar" value="vazio"/>
</div>
<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado">
		<div class="col-12">
			<div class="row">
				<div class="titulo">REVISTA ESMAFE</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['revistaEsmafe'])?></small>
			</div>
<?php           $ano = "";
                foreach ($list['dadosTratados'] as $art){
					$anoPub =  explode("/",$art['dataPublicacao']);
					if($ano != $anoPub[2]){
					$ano = $anoPub[2]; 								?>
                    <ul>
                        <li class="titulo"><?= $anoPub[2]; ?></li>
                        <?php 
						$list['dadosTratados'] = array_sort($list['dadosTratados'], 'dataNumero', $order = SORT_DESC);
						foreach($list['dadosTratados'] as $arr2){
						
						
						$anoPublic =  explode("/",$arr2['dataPublicacao']);
							if($ano == $anoPublic[2]){  			?>
							<li>
                                <a href="index.php/gestao-orcamentaria/resultado-pdf?/id=<?php echo $arr2['id']."&MOD=SV40&niveis=".urlencode("CORREGEDORIA/ESTATÍSTICA/".$anoPublic[2]."/".$arr2['descricaoRevista']) ?>">
                                    <?=$arr2['descricaoRevista'];  	?>
                                </a>    
                            </li>
<?php						}
						}											?>
						
					</ul>
<?php				}
				} 													?> 
		</div>
	</div>
</div>
