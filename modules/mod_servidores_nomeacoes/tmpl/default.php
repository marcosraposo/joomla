<?php 
defined('_JEXEC') or die;
error_reporting(0);
$dataHoje = date("d/m/Y");
require_once 'func.php';
$ordernar = false;
$listaAnos = array();

$pos = 0;
foreach ($list as $group){
    $horarioAno2 = explode("/", $group['dataPublicacao']);
    if (!empty($horarioAno2[2])) {
        $ordernar = true;
        $list[$pos]['anoConcurso'] = $horarioAno2[2];
    }
	$pos++;
}


$pos = 0;
foreach ($list as $group) {
    $data = explode("/", $group['dataPublicacao']);
	$list[$pos]['dataNum'] = $data[2].$data[1].$data[0];
	$pos++;
}



if ($ordernar) {
    array_sort_by2($list, 'anoConcurso', $order = SORT_DESC);
}


$ano = 0;
foreach ($list as $anoTemp) {
	if($ano != $anoTemp['anoConcurso']){
		$ano = $anoTemp['anoConcurso'];
	
    ?>
<div class="row report">
    <ul>
        <li class="titulo" style="width: 50px;">
            <?php echo $ano; ?>
        </li>
        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
    </ul>
</div>
<div class="row botoes w100">
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        PDF
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        XML
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        CSV
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', 'LISTAGEM DAS NOMEAÇÕES <?= $ano; ?>', this);">
        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
        IMPRIMIR
    </a>
    <br />
    <br />
    <div class="spacer"></div>

    <table id="tabela_<?= $ano; ?>">
        <thead>
            <tr>
                <td>SEQ</td>
                <td>DATA</td>
                <td>DESCRIÇÃO</td>
            </tr>
        </thead>
        <?php	
		if ($ordernar) {
			array_sort_by2($list, 'dataNum', $order = SORT_DESC);
		}
        $texto = "";
        foreach ($list as $listDados) :
            $horarioAno2 = explode("/", $listDados['dataPublicacao']);
            if ($listDados['anoConcurso']  == $ano) :
                // $texto .= "<div class='row report'>"; 
                $texto .= "<tr>";
                $texto .= " <td>" . $listDados['id'] . "</td> ";
                $texto .= " <td>
								<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['id'] . "&MOD=SV29&niveis=" . urlencode("Concuros e Seleções/Concursos de Servidores/NOMEAÇÕES/" . $listDados['descricao']) . "'>
									" . $listDados['dataPublicacao'] . "
								</a>
							</td> ";
                $texto .= " <td>
								<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['id'] . "&MOD=SV29&niveis=" . urlencode("Concuros e Seleções/Concursos de Servidores/NOMEAÇÕES/" . $listDados['descricao']) . "'>
									" . $listDados['descricao'] . "
								</a>
							</td> ";
                $texto .= "</tr>";

            endif;
        endforeach;
        echo $texto;
        ?>


    </TABLE>
    <?php 
    //Aqui conteém o HTML que vai ser trandormado em PDF.
    $htmlPDF = "<h3>Servidores Nomeações</h3>";
    $htmlPDF .= "<table border=1 id='tabela2_" . $ano . "' cellspacing=0 cellpadding=5 >
				<tr>
				<th>SEQ.</th>
				<th>Data</th>
				<th>Descrição</th>
				</tr> ";
    $htmlPDF .= str_replace("<br />", "", $texto);
    $htmlPDF .= "</table>";
    ?>
    <div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
    <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
    <div class="clearfix"></div>
</div>
<?php	 //endif; 
}
}
 ?> 