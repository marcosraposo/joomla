<?php
defined('_JEXEC') or die;

function strip_html_tags2( $text ){
	$text = preg_replace(array('@<((br)|(hr))@iu'),		array(' '),	$text );
	return $text;
}

function strip_html_tags( $text ){
	$text = str_replace("<table","<table bordercor='#5776B0;' ",$text);
	$text = str_replace('border="0"','border="1"',$text);
return str_replace("style=","a=",$text);
}

$texto = strip_html_tags($dados->texto);

//$texto = preg_replace('/<br><br>+/', '<br>', $texto); 

//nl2br();

?>
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="titulo"> <?php echo $dados->titulo; ?> </div>
			<div style="text-align:left;font-size:13px;"><?php echo $dados->subtitulo; ?></div>
            <br><div style="text-align:right;"><small><?php echo $dados->data_formatada; ?></small></div>
			<br><div style="text-align: justify; font-size: 12.0pt; line-height: 115%; "><?php echo $texto; ?></div>
			<br><br>
			<div  style="text-align:right;">Por: <?php echo $dados->autor; ?></div>
        </div>
    </div>
</div>







