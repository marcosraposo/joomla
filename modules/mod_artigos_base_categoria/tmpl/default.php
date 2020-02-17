<?php 
defined('_JEXEC') or die;

require_once("funcoes_categorias.php");

$listArticlesByCategory = array();
foreach ($params->get('catid') as $idCategory) {
    array_push($listArticlesByCategory, getListArticleCategory2($list, $idCategory));
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

//Recebe o rodape da pagina que foi informado como parametro no modulo.
$new_field = $params->get('new_field');
$new_field = str_replace("<p>", "", $new_field);
$new_field = str_replace("</p>", "", $new_field);

?>
<div class="row">
    <div class="titulo"><?= $titulo ?></div>
</div>

<?php if ($params['showDataAtualizacao'] == 1) { ?>
<div class="row">
    <small>Última atualização: <?php echo getDataAtualizacao3($list); ?></small>
</div>
<?php 
} ?>

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
$categoriaTemp = "";
foreach ($listArticlesByCategory as $artigosCategoria) {
    if (is_array($artigosCategoria) && !empty($artigosCategoria)) {
        $artigo =  $artigosCategoria[0];
        if ($categoriaTemp != $artigo->category_title) {
            $categoriaTemp = $artigo->category_title;
            ?>
<div class="row report">
    <ul style="width: 100%;">
        <div class="titulo" style="display: inline-block;"><li><?= $categoriaTemp ?></li></div>
        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
    </ul>
</div>
<?php 
} ?>
<div class="row botoes w100" style="display: none;">
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('<?php echo $artigo->catid."_".$categoriaTemp; ?>')">
        <div class=" icone"><img src="templates/portalTRF5/images/download.svg"></div>
        PDF
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?php echo $artigo->catid."_".$categoriaTemp; ?>', 'export', '<?= $categoriaTemp; ?>', this)">
        <div class=" icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
        IMPRIMIR
    </a>
    <div class="clearfix"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>

    <?php echo html_entity_decode(getTextoExibicao3($artigosCategoria)); ?>

    <?php 
    $htmlPDF = "<h3>" . $categoriaTemp . "</h3>";
    $htmlPDF .= html_entity_decode(getTextoExibicao3($artigosCategoria));
    $htmlPDF = str_replace("<table", "<table border='1' style='border: 1px solid #ccc;' ", $htmlPDF);
    $htmlPDF .= "</table>";
    ?>
    <div style="display:none;"><input id="table_<?php echo $artigo->catid."_".$categoriaTemp; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
    <div style="display:none;" id="<?php echo $artigo->catid."_".$categoriaTemp; ?>"><?php echo $htmlPDF ?></div>

    <div class="clearfix"></div>
    <div class="spacer"></div>

</div>
<?php 
}
}
?> 

<div class="clearfix"></div>
<div class="spacer"></div>

<?php if (!empty($rodape)) {

    echo html_entity_decode($rodape); 
}
?>

<div class="clearfix"></div>
<div class="spacer"></div>

<div class="clearfix"></div>
<div class="spacer"></div>

<?php if (!empty($new_field)) {

    echo html_entity_decode($new_field); 
}
?>