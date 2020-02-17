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

function retiraBarras($string){
    $string = str_replace("/", "&#47;", $string);
    return $string;
}

include_once 'func.php';

$ordernar = false;
$i1 = 0;
foreach ($list['posicaoPatrimonial'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list['posicaoPatrimonial'][$i1]['anoPublicacao'] = $horarioAno2[2];
		$list['posicaoPatrimonial'][$i1]['mesPublicacao'] = $horarioAno2[1];
	}
	$i1++;
}

if ($ordernar) {
	array_sort_by2($list['posicaoPatrimonial'], 'anoPublicacao', $order = SORT_DESC);
}

$ordernar = false;
$i1 = 0;
foreach ($list['termosDoacao'] as  $group) {
		//var_dump($group['descricao']);
		$tituloDesc1 = explode('-',$group['descricao']);
		$tituloDesc2 = explode('/',$tituloDesc1[1]);
		$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernar = true;
		$list['termosDoacao'][$i1]['anoPublicacao'] = $horarioAno2[2];
		$list['termosDoacao'][$i1]['numeroTermo'] = trim($tituloDesc2[0]);
	}
	$i1++;
}




/*echo "<pre>";
var_dump($list['posicaoPatrimonial']);
echo "</pre>";*/


if ($ordernar) {
	array_sort_by2($list['termosDoacao'], 'anoPublicacao', $order = SORT_DESC);
}

 $tituloNiveis = "ADMINISTRAÇÃO PATRIMONIAL DE BENS MÓVEIS /Termos de Doação /TERMOS DE ADESÃO DE SAÍDA"; ?>
<div class="container demonstrativo bg_azul_fundo">
	<div class="row">
		<div class="col-md-6 aba selecionado" data-aba="1">
			<div><a class="textoSemSublinhado" href="#container">Posição Patrimonial</a></div>
		</div>
		<div class="col-md-6 aba" data-aba="2">
			<div><a class="textoSemSublinhado" href="#container">Termos de Doação</a></div>
		</div>
	</div>
</div>

<div class="container demonstrativo bg_azul_fundo">
	<div class="row conteudo selecionado" data-aba-id="1">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Posição Patrimonial do Tribunal Regional Federal da 5ª Região</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php  echo getDataAtualizacao($list['posicaoPatrimonial'])?></small>
			</div>
			<?php $ano = 0; 
					foreach($list['posicaoPatrimonial'] as $posicao){
					if ($ano != $posicao['anoPublicacao']) {
						$ano = $posicao['anoPublicacao'];
						array_sort_by2($list['posicaoPatrimonial'], 'mesPublicacao', $order = SORT_ASC);
						?>
					<div class="row report">
						<ul>
							<li><?php echo $posicao['anoPublicacao']; ?></li>
<?php 							foreach ($list['posicaoPatrimonial'] as $mes){

									//var_dump($mes['ano']);
									if ($ano == $mes['ano']){
									echo "<li><a role='img' href='../index.php/gestao-orcamentaria/resultado-pdf?/id=".$mes['id']."&MOD=SV8&niveis=".urlencode("PORTAL DA TRANSPARÊNCIA/GESTÃO PATRIMONIAL/ADMINISTRAÇÃO PATRIMONIAL DE BENS MÓVEIS/".$mes['id'])."'>
										".$mes['mes']."
									</a></li>";
									}
								} 				?>
						</ul>
					</div>
<?php 				}
				}			?>
		</div>
	</div>

	<div class="row conteudo" data-aba-id="2">
		<div class="col-12">
			<div class="row">
				<div class="titulo">Termos de Adesão de Saída</div>
			</div>
			<div class="row">
				<small>Última atualização: <?php echo getDataAtualizacao($list['termosDoacao'])?></small>
			</div>
<?php 			$anoTermo = 0; 
					array_sort_by2($list['termosDoacao'], 'anoPublicacao', $order = SORT_DESC);
					foreach($list['termosDoacao'] as $termo){
					if ($anoTermo != $termo['ano']) :
						$anoTermo = $termo['ano'];						?>
					<div class="row report">
						<ul>
							<li class="titulo" style="width: 61px;"><?= $termo['ano'] ?></li>
							<li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
						</ul>
					</div>
					<div class="row botoes">
						<ul>
<?php						array_sort_by2($list['termosDoacao'], 'numeroTermo', $order = SORT_DESC);
							foreach ($list['termosDoacao'] as $arquivo): ?>
								<?php if ($termo['ano'] == $arquivo['ano']) : ?>
									<li class="inline">
										<a href="#botoes" role="button" class="box" onclick="window.location.href='../gestao-orcamentaria/resultado-pdf?/id=<?= $arquivo['id'] ;?>&MOD=SV9&niveis=<?php echo urlencode($tituloNiveis.'/'.$termo['ano'].'/'.retiraBarras($arquivo['descricao'])); ?>'">
											<?= $arquivo['descricao']; ?>
										</a>
									</li>
								<?php endif; 							?>
							<?php endforeach; 							?>
						</ul>
						<div class="clearfix"></div>
					</div>
				<?php endif; 
				} 														?>
		</div>
	</div>

</div>
