<?php defined('_JEXEC') or die;
include_once 'func.php';

$ano = "";
if(!empty($dados['params']['ano'])){
	if(empty($dados['dadosDetalhado'])){
		echo "Não existe conteúdo.";
		exit;
	}else{
		foreach ($dados['dadosDetalhado'] as $arr) {
			if(is_array($arr)){
				if($dados["params"]['nomeServico'] == "Legislacao Sumulas"){
					echo conteudoSumulas($arr, $dados, $dados['params']['mes']);	
				}else if(  ($dados['params']['categoria'] == "Legislacao Portaria CJF")  ||  ($dados['params']['categoria'] == "Legislacao Corregedoria Regimento Int") ||  ($dados['params']['categoria'] == "Legislacao Regimento Interno") ){
					echo portariaCJF($arr, $dados, $dados['params']['mes']);
				}else if($dados['params']['categoria'] == "Legislacao Conselho Adm Decisoes"){
					echo decisaoConselhoAdm($arr, $dados, $dados['params']['mes']);
				}else{
					echo conteudo($arr, $dados, $dados['params']['mes']);	
				}
			}
		}
	}
exit;	
}

//Esta condição vai simplicar a lista de listas que recebo, de modo que fique uma lista de array, para que seja rederizado na tela
$i=0;
if(!empty($dados['dados'])){
    $ano = "";
	$mes = "";
    foreach ($dados['dados'] as $art) {
		if(is_array( $art)){
		$i = 0;
		$i2 = 0;
			foreach($art as $arr){
				if(empty($arr['ano'])){
					$arr = $art;
				}
				
				if($ano != $arr['ano']){
					$ano = $arr['ano'];
					$i2 = 0;
				}
				if($mes != $arr['meses']['descricaoMes']){
					$mes = $arr['meses']['descricaoMes'];
					$arr['meses']['numeroMes'] = $i2;
					$dados['dadosTratado'][$i]['ano'] = $arr['ano'];
					$dados['dadosTratado'][$i]['dataAtualizacao'] = $arr['dataAtualizacao'];
					$dados['dadosTratado'][$i]['descricaoMes'] = $arr['meses']['descricaoMes'];
					$dados['dadosTratado'][$i]['exibe'] = $arr['meses']['exibe'];
					$dados['dadosTratado'][$i]['id'] = $arr['meses']['id'];
					$dados['dadosTratado'][$i]['numeroMes'] = $i2;
					$dados['dadosTratado'][$i]['meses'] = $arr['meses'];
					$i++;
					$i2++;
				}
			}
		}
	}
}

$dados['dadosTratado'] = (empty($dados['dadosTratado']))? "": $dados['dadosTratado'];	

if(!empty(strpos($_SERVER["REQUEST_URI"], "aba02"))){
echo "	<script>
			$('.aba01').removeClass('selecionado');
			$('.aba02').addClass('selecionado');
			$('.legislacaotrf5').removeClass('selecionado');
						$('.aba02').addClass('selecionado');
						$('.legislacaocorregedoria').addClass('selecionado');
		</script>
		";
}

$aba = "";
if(!empty( $dados['params']['aba02']) &&  $dados['params']['aba02'] = 1){
	$aba = "aba02";
}	
?>  
<div id="1111">
    <div class="row">
        <div class="titulo"><?php echo $dados['params']['titulo_tab_1'];?> </div>                
    </div>
  
        <div class="row">
            <small>Última atualização: <?php  echo getDataAtualizacaoA($dados['dadosTratado']);?></small>                
        </div>
	
    <div class="clearfix"></div>
    <div class="spacer"></div>
    
    <div style="display:none;">
        <input type="text" id="idMesOcultar" value="vazio"/>
    </div>
    <script src="/joomla/templates/portalCorregedoria/javascript/jquery-3.3.1.min.js"></script>

	 <div style="display:none;">
        <input type="text" value="" id="ultimoID">
    </div>
	
<?php 
    $boxes = "";
	$selecao = "";
	
	if($dados['menu'] != null){
		foreach($dados['menu'] as $categoria){
		if($categoria['categoria'] == $dados['params']['categoria']){
			$selecao = "selecionado";
			}else{
			$selecao = "";
			}
			$boxes .="<a href='".$dados['params']['titulo_tab_2']."?/categoria=".$categoria['categoria']."&".$aba."#container' class='box aba022 $selecao textoSemSublinhado'>".$categoria['descricao']."</a>";
		}	
	}
	?>
    <div class="row boxes">
        <?php echo $boxes; 														?>
    </div> 
    <div class="clearfix"></div>
    <div class="spacer"></div>
	
<?php 
if(!empty($dados['dadosTratado'])){
$ano = "";
    foreach ($dados['dadosTratado'] as $dadosT) {
		if( $dadosT['ano'] != $ano){
			$ano = $dadosT['ano']; 												?>
            <ul>
            <li><?= $dadosT['ano']; ?></li>
<?php 		$tag = "";
			$dados['dadosTratado'] = array_sort($dados['dadosTratado'], 'numeroMes', $order = SORT_DESC);
			foreach ($dados['dadosTratado'] as $dadosT2) {
				if($dadosT2['ano'] == $ano){ 									?>
						<li>
						<a onClick="exibirConteudoAutoBox('<?php echo $dadosT2['ano']."--".$dadosT2['meses']['descricaoMes']."--".$dados['params']['categoria']."--".$dados['params']['titulo_tab_2']."--".$dados['params']['nomeServico'];?>')">
						<?=$dadosT2['meses']['descricaoMes'];
				 echo   "</li>";									
							$tag .= "<div class='row botoes2 w100' style='display: none; ' id=".$dadosT2['ano']."--".$dadosT2['meses']['descricaoMes'].">";
							$tag .= "<div id='".$dadosT2['ano']."--".$dadosT2['meses']['descricaoMes']."'>teste</div>";
							$tag .= "<div class='clearfix'></div></div>";       ?>
						</a>    
<?php			}
			}	
		}																		?>
			</ul>
<?php	echo $tag;			
	}
}   																			?>
</div>