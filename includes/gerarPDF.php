<?php

include("../mpdf/mpdf.php");
$aquivoNome = 'relatorio.pdf';

if($_GET['cmd'] == 1){
	if (!file_exists($aquivoNome)) {
		die('Arquivo não existe');
	}

	header('Content-Description: File Transfer');

	// -> Forçar Baixar:
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.$aquivoNome.'"');

	// -> Forçar Exibir:
	//header('Content-Type: application/pdf');
	//header('Content-Disposition: inline; filename="' . $aquivoNome . '"');

	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($aquivoNome));
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Expires: 0');
	readfile($aquivoNome);
}else{
	$htmlPDF = urldecode($_POST['htmlPDF']);
	$mpdf = new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
	//$css = file_get_contents("css/estilo.css");
	//$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($htmlPDF);
	$mpdf->Output($aquivoNome, "F");
}

?>
