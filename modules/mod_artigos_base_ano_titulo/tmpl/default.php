<?php 
    defined('_JEXEC') or die;
    
    require_once("funcoes_ano_titulo.php");

    $anoTemp = "";
    $listArticlesByAno = array();
    foreach ($list as $article) {
        $data = explode('-', $article->publish_up, 2);
        $anoArticle = $data[0];
        if($anoTemp != $anoArticle){
            $anoTemp = $anoArticle;
            array_push($listArticlesByAno, getListArticleAno($list, $anoArticle));
        }
    }

    //recebe o título da pagina
    $titulo = $params->get('title');

    //Recebe o subtitle que foi informado como parametro no modulo.
    $subtitle = $params->get('subtitle');
    $subtitle = str_replace("<p>", "", $subtitle);
    $subtitle = str_replace("</p>", "", $subtitle);
    
    //Recebe o rodape da pagina que foi informado como parametro no modulo.
    $rodape = $params->get('footer');
    $rodape = str_replace("<p>", "", $rodape);
    $rodape = str_replace("</p>", "", $rodape);
    
?>
    <div class="row">
        <div class="titulo"><?=$titulo?></div>                
    </div>   
    <div class="row">
        <small>Última atualização: <?php echo getDataAtualizacao2($list);?></small>                
    </div>
    <div class="clearfix"></div>
    <div class="spacer"></div>

    <?php echo html_entity_decode($subtitle); ?>

    <div class="clearfix"></div>
    <div class="spacer"></div>
    
    <div style="display:none;">
        <input type="text" id="idMesOcultar" value="vazio"/>
    </div>
    <?php 
        $anoTemp = "";
        $indice = 0;
        foreach($listArticlesByAno as $artigosAno){
            if(is_array($artigosAno) && !empty($artigosAno)){
                $articleTitles = "";
                $tabelasRow = "";
                foreach ($artigosAno as $art) {
                    $articleTitles .=  "<li><a href='#conteudo' onClick=javascript:exibirBotaoRelatorio('".$art->id."');>".$art->title."</a></li>";
                    $tabelasRow .= "<div class='row botoes2 w100' style='display: none;' id=".$art->id.">";
                    $tabelasRow .= html_entity_decode($art->introtext);
                    $tabelasRow .= "<div class='clearfix'></div></div>";
                }
                $artigo =  $artigosAno[0];
                $data = explode('-', $artigo->publish_up, 2);
                $ano = $data[0];
                if($anoTemp != $ano){
                    $anoTemp = $ano;
                    ?>
                    <div class="row report">
                        <ul>
                            <li><?=$anoTemp?></li>
                            <?=$articleTitles?>
                        </ul>
                    </div>
                <?php } ?>
                <?php echo $tabelasRow; ?>
            <?php 
            }
        }
    ?>