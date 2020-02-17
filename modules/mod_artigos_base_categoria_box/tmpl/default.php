<?php 
defined('_JEXEC') or die;

if($list['action'] == "artigo"){
	foreach($list['dados'] as $art){
	//echo $art->id."<br>";
		if(is_object($art) && $art->id == $list['id']){ //423 1623 1250 233
			echo html_entity_decode($art->introtext);
		}
	}
 exit;	
}
	$tipo = "";
	if(!empty($_GET['tipo'])){
		$tipo = $_GET['tipo'];
	}
	$idCategoria = "168";
	if(!empty($_GET['idgrupo'])){
		$idCategoria = $_GET['idgrupo'];
	}

	
require_once("funcoes_categorias_box.php");

	$i = 0;
	foreach($list['dados'] as $group){
	if(is_object($group)){
		$horarioAno2 = explode('-', $group->publish_up);
		if(!empty($horarioAno2[0])){
			$ordernar = true;
			$mesOrdem = "";
			if($horarioAno2[1] == "12"){
				$mesOrdem = "01";
			}if($horarioAno2[1] == "11"){
				$mesOrdem = "02";
			}if($horarioAno2[1] == "10"){
				$mesOrdem = "03";
			}if($horarioAno2[1] == "09"){
				$mesOrdem = "04";
			}if($horarioAno2[1] == "08"){
				$mesOrdem = "05";
			}if($horarioAno2[1] == "07"){
				$mesOrdem = "06";
			}if($horarioAno2[1] == "06"){
				$mesOrdem = "07";
			}if($horarioAno2[1] == "05"){
				$mesOrdem = "08";
			}if($horarioAno2[1] == "04"){
				$mesOrdem = "09";
			}if($horarioAno2[1] == "03"){
				$mesOrdem = "10";
			}if($horarioAno2[1] == "02"){
				$mesOrdem = "11";
			}if($horarioAno2[1] == "01"){
				$mesOrdem = "12";
			}
			$list['dados'][$i]->anoLegislacao = $horarioAno2[0]."-".$mesOrdem;
			$i++;
		}
		}
	}
	if($ordernar){
		array_sort_by($list['dados'], 'anoLegislacao', $order = SORT_DESC);
	}
	
    $parentAlias = "";
    if(!empty($list['dados'])){
        $parentAlias = $list['dados'][0]->parent_alias;
    }

    $listArticlesByCategory = array();
    foreach ($params->get('catid') as $idCategory) {
    array_push($listArticlesByCategory, getListArticleCategory($list['dados'], $idCategory));
    }

    //recebe o título da pagina
    $titulo = $params->get('title');
	$alias_menu = $params->get('alias_menu');

    //Recebe o subtitle que foi informado como parametro no modulo.
    $subtitle = $params->get('subtitle');
    $subtitle = str_replace("<p>", "", $subtitle);
    $subtitle = str_replace("</p>", "", $subtitle);
    
    //Recebe o rodape da pagina que foi informado como parametro no modulo.
    $rodape = $params->get('footer');
    $rodape = str_replace("<p>", "", $rodape);
    $rodape = str_replace("</p>", "", $rodape);
    
	/*foreach($listArticlesByCategory as $artigosCategoria){
		if($parentAlias  == "decisoes"){
			$idCategoria = $artigosCategoria[0]->catid;
		}
		break;
	}*/
	
?>  
<div id="<?=$parentAlias?>">
    <div class="row">
        <div class="titulo"><?=$titulo?></div>                
    </div>

    <?php if($params['showDataAtualizacao'] ==1){?>	
        <div class="row">
            <small>Última atualização: <?php echo getDataAtualizacao($list['dados']);?></small>                
        </div>
    <?php }?>	
	
    <div class="clearfix"></div>
    <div class="spacer"></div>

    <?php echo html_entity_decode($subtitle); ?>

    <div class="clearfix"></div>
    <div class="spacer"></div>
    
    <div style="display:none;">
        <input type="text" id="idMesOcultar" value="vazio"/>
    </div>
    <script src="/joomla/templates/portalCorregedoria/javascript/jquery-3.3.1.min.js"></script>

	<?php 	if(empty($_GET['idgrupo'])){ ?>
	<script>
	$(document).ready(function(){
		$('.aba02').click(function(){
				var url = window.location.href;
		//alert(url.indexOf("legislacao"));
		window.location.href = 'legislacao-home?idgrupo=177&tipo=legislacao-corregedoria'; 
			$(".aba01").removeClass("selecionado");
				$(".legislacaotrf5").removeClass("selecionado");
				$(".aba02").addClass("selecionado");
				$(".legislacaocorregedoria").addClass("selecionado");
		});
	});	
	</script>
	<?php }	?>
	
	
	
	
	
	
    <?php 
	if($tipo == 'legislacao-corregedoria'){ ?>
		<script>
			$(document).ready(function(){
				$(".aba01").removeClass("selecionado");
				$(".legislacaotrf5").removeClass("selecionado");
				$(".aba02").addClass("selecionado");
				$(".legislacaocorregedoria").addClass("selecionado");
			});
		</script>
	<?php }

        $boxes = "";
        $categoriaTemp = "";
        $first = true;
		$selecao = "";
        foreach($listArticlesByCategory as $artigosCategoria){
            if(is_array($artigosCategoria) && !empty($artigosCategoria)){
                $artigo =  $artigosCategoria[0];
                if($categoriaTemp != $artigo->category_title){
                    $categoriaTemp = $artigo->category_title;
					if($artigo->catid == $idCategoria){
						$selecao = "selecionado";
					}
					$boxes .="<a href='#container' class='box $selecao textoSemSublinhado' id='".$artigo->catid."' onClick=javascript:exibirBotaoCategoria('".$artigo->catid."','".$parentAlias."');>".$categoriaTemp."</a>";
					$selecao = "";
                }
            }
        }
    ?>
    <div class="row boxes">
        <?php echo $boxes; ?>
    </div> 
    <div class="clearfix"></div>
    <div class="spacer"></div>
    <?php
        $categoriaTemp = "";
        $first = true;
        $display = "";
        foreach($listArticlesByCategory as $artigosCategoria){
            if(is_array($artigosCategoria) && !empty($artigosCategoria)){
                $artigo =  $artigosCategoria[0];
				if($artigo->catid == $idCategoria){
					if($categoriaTemp != $artigo->category_title){
						$categoriaTemp = $artigo->category_title;
						if($first){
							$display = "";
							$first = false;
						}else{
							$display = "hideCategoria";
						}
					?>  
						<div class="categoria box_<?= $artigo->catid; ?> <?=$display?>" id="">
							<div class='row'>
								<div class='titulo'><?=$categoriaTemp?></div>
							</div>
					<?php }
				
					$anoTemp = "";
					$listCategoryByAno = array();
					foreach ($artigosCategoria as $article) {
						$data = explode('-', $article->publish_up, 2);
						$anoArticle = $data[0];
						if($anoTemp != $anoArticle){
							$anoTemp = $anoArticle;
							array_push($listCategoryByAno, getListArticleAno($artigosCategoria, $anoArticle));
						}
					}
					$listMesAno = array();
					$mesAnoTemp = "";
					foreach ($listCategoryByAno as $article) {
						foreach ($article as $datas){
								if(is_array($article) && !empty($article)){
									$data = explode('-', $datas->publish_up, 3);
									$mesAnoArticle = $data[0]."-".$data[1];
								if($mesAnoTemp != $mesAnoArticle){
									$mesAnoTemp = $mesAnoArticle;
									array_push($listMesAno, getListArticleAnoMes($article, $mesAnoArticle));
								}
							}
						}
					 }
					$anoTemp = "";
					$mesTemp = "";
					$anoMesTemp = "";
					$liAno = "";
					$liMes = "";
					$tabelasRow = "";
					$primeira = 0;
					$tag = "";
					foreach ($listMesAno as $article) {
						if (is_array($article) && !empty($article)) {
							$artigo =  $article[0];
							$data = explode('-', $artigo->publish_up, 3);
							$ano = $data[0];
							$mes = $data[1];
								if ($anoTemp != $ano && $primeira > 0) {
									echo "</ul></div>";
								}
								if ($anoTemp != $ano){
									$anoTemp = $ano;
									echo $tag;
									$tag = "";
									echo "<div class='row report'><ul>";
									echo "<li>".$ano."</li>";
								}
								if ($anoMesTemp != $ano."-".$mes){
									$mesTemp = $mes;
									$anoMesTemp = $ano . "-" . $mes;
									echo "<li> <a href='#conteudo' onClick=javascript:exibirBotaoRelatorio('".$artigo->catid."--".$ano."--".$mes."--".$artigo->id."--".$alias_menu."');>".getMes($mes)."</a></li>";
									$tag .= "<div class='row botoes2 w100' style='display: none;' id=".$artigo->catid."--".$ano."--".$mes."--".$artigo->id."--".$alias_menu.">";
									$tag .= "<div id='".$artigo->id."'>".$artigo->id."</div>";
									$tag .= "<div class='clearfix'></div></div>";
									$primeira++;
								}
						}
					}	
					echo "</ul></div>";
					echo $tag;
					?>
					<?php echo $tabelasRow; ?>
				</div>
				<?php 
			
				}
            }
        }
    ?>
</div>