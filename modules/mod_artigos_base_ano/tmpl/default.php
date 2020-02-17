<?php 
defined('_JEXEC') or die;

require_once("funcoes_ano.php");

$anoTemp = "";
$listArticlesByAno = array();
foreach ($list as $article) {
    $data = explode('-', $article->publish_up, 2);
    $anoArticle = $data[0];
    if ($anoTemp != $anoArticle) {
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
    <div class="titulo"><?= $titulo ?></div>
</div>
<div class="row">
    <small>Última atualização: <?php echo getDataAtualizacao2($list); ?></small>
</div>
<div class="clearfix"></div>
<div class="spacer"></div>

<?php if (!empty($subtitle)) {

    echo html_entity_decode($subtitle); ?>

<div class="clearfix"></div>
<div class="spacer"></div>
<?php

}
?>

<?php 
$anoTemp = "";
foreach ($listArticlesByAno as $artigosAno) {
    if (is_array($artigosAno) && !empty($artigosAno)) {
        $artigo =  $artigosAno[0];
        $data = explode('-', $artigo->publish_up, 2);
        $ano = $data[0];
        if ($anoTemp != $ano) {
            $anoTemp = $ano;
            ?>
<div class="row report">
    <ul style="width: 100%;">
        <li class="titulo" style="display: inline-block; width: 55px !important;"><?= $anoTemp ?></li>
        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
    </ul>
</div>
<?php 
} ?>
<div class="row botoes w100" style="display: none;">

    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('<?= $artigo->catid."_".$ano; ?>');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        PDF
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $artigo->catid."_".$ano; ?>', 'export', '<?php echo $artigosAno[0]->category_title; ?>', this);">
        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
        IMPRIMIR
    </a>
    <div class="clearfix"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>


    <?php
    $texto = html_entity_decode(getTextoExibicao2($artigosAno));
    $texto = str_replace("<table", "<table id='tabela_" . $ano . "' ", $texto);
    echo $texto;

    $htmlPDF = "<h3>".$artigosAno[0]->category_title.": ".$ano."</h3>";
    $htmlPDF .= html_entity_decode(getTextoExibicao2($artigosAno));
    $htmlPDF = str_replace("<table", "<table border='1'", $htmlPDF);
    $htmlPDF .= "</table>";
    ?>
    <div style="display:none;"><input id="table_<?= $artigo->catid."_".$ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
    <div style="display:none;" id="tabela_export_<?= $artigo->catid."_".$ano; ?>"><?php echo $htmlPDF ?></div>



    <div class="clearfix"></div>
    <div class="spacer"></div>

</div>
<?php 
}
}
?> 