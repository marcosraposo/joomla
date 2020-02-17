<?php
defined('_JEXEC') or die;
include("mpdf/mpdf.php");


define('DIR_DOWNLOAD', 'modules/mod_pdf_grande/tmpl/');


	$caminho = dirname(__FILE__);
	$aquivoNome = 'relatorio2.pdf';
	
	
	$aquivoNome2 = $caminho.'/relatorio2.pdf';

	$mpdf = new Mpdf();
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->WriteHTML( $dados->texto);
	$mpdf->Output($aquivoNome2);
	

	/*
		
if (!file_exists(DIR_DOWNLOAD.$aquivoNome)) {
		echo 'Arquivo não existe';
	}

	header('Content-Description: File Transfer');

	// -> Forçar Baixar:
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.$aquivoNome.'"');

	// -> Forçar Exibir:
	//header('Content-Type: application/pdf');
	//header('Content-Disposition: inline; filename="' . $aquivoNome . '"');

	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($caminho.'/'.$aquivoNome));
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Expires: 0');
	readfile($caminho.'/'.$aquivoNome);
	
exit;*/
?>








