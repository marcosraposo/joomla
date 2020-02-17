<?php 
defined('_JEXEC') or die;

require_once("funcoes_categorias_mes_ano.php");

$listArticlesByCategory = array();
foreach ($params->get('catid') as $idCategory) {
    array_push($listArticlesByCategory, getListArticleCategoryMA($list['dados'], $idCategory));
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

?>
<div>
    <div class="row">
        <div class="titulo">
            <?= $titulo ?>
        </div>
    </div>

    <?php if ($params['showDataAtualizacao'] == 1) { ?>
    <div class="row">
        <small>Última atualização:
            <?php echo getDataAtualizacaoMA($list['dados']); ?></small>
    </div>
    <?php 
} ?>

    <div class="clearfix"></div>
    <div class="spacer"></div>

    <?php echo html_entity_decode($subtitle); ?>

    <div class="clearfix"></div>
    <div class="spacer"></div>

    <div style="display:none;">
        <input type="text" id="idMesOcultar" value="vazio" />
    </div>

    <?php
    $categoriaTemp = "";
    $first = true;
    $display = "";
    foreach ($listArticlesByCategory as $artigosCategoria) {
        if (is_array($artigosCategoria) && !empty($artigosCategoria)) {

            $anoTemp = "";
            $listCategoryByAno = array();
            foreach ($artigosCategoria as $article) {
                $data = explode('-', $article->publish_up, 2);
                $anoArticle = $data[0];
                if ($anoTemp != $anoArticle) {
                    $anoTemp = $anoArticle;
                    array_push($listCategoryByAno, getListArticleAnoMA($artigosCategoria, $anoArticle));
                }
            }
            $listMesAno = array();
            $mesAnoTemp = "";
            foreach ($listCategoryByAno as $article) {
                foreach ($article as $datas) {
                    if (is_array($article) && !empty($article)) {
                        $data = explode('-', $datas->publish_up, 3);
                        $mesAnoArticle = $data[0] . "-" . $data[1];
                        if ($mesAnoTemp != $mesAnoArticle) {
                            $mesAnoTemp = $mesAnoArticle;
                            array_push($listMesAno, getListArticleAnoMesMA($article, $mesAnoArticle));
                        }
                    }
                }
            }
            $anoTemp = "";
            $mesTemp = "";
            $anoMesTemp = "";
            $liAno = "";
            $liMes = "";
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
                    if ($anoTemp != $ano) {
                        $anoTemp = $ano;
                        echo $tag;
                        $tag = "";
                        echo "<div class='row report'><ul>";
                        echo "<li>" . $ano . "</li>";
                    }
                    if ($anoMesTemp != $ano . "-" . $mes) {
                        $mesTemp = $mes;
                        $anoMesTemp = $ano . "-" . $mes;
                        echo "<li> <a href='#conteudo' onClick=javascript:exibirBotaoRelatorio('" . $ano . "--" . $mes . "');>" . getMesMA($mes) . "</a></li>";
                        $tag .= "<div class='row botoes2 w100' style='display: none;' id=" . $ano . "--" . $mes . ">";
                        $tag .=  html_entity_decode($artigo->introtext);;
                        $tag .= "<div class='clearfix'></div></div>";
                        $primeira++;
                    }
                }
            }
            echo "</ul></div>";
            echo $tag;
            ?>
</div>
<?php 
}
}

?>
</div> 