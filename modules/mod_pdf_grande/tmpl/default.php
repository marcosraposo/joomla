<?php
defined('_JEXEC') or die;
include("mpdf/mpdf.php");

	$caminho = dirname(__FILE__);
	$aquivoNome = $caminho.'/relatorio.pdf';
	$texto = str_replace("<table","<table border='1' cellpadding=0 cellspacing=0 ",$dados->texto);
	$mpdf = new Mpdf();
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->WriteHTML( $texto);
	$mpdf->Output($aquivoNome);
?>

<script>
window.close();
</script>






