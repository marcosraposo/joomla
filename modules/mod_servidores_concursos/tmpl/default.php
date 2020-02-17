<?php 
defined('_JEXEC') or die;
//error_reporting(0);
$dataHoje = date("d/m/Y");
require_once 'func.php';
$ordernar = false;
$listaAnos = array();
$pos = 0;
foreach ($list as $group) {
    $horarioAno2 = explode("/", $group['dataPublicacao']);
    if (!empty($horarioAno2[2])) {
        $ordernar = true;
        $list[$pos]['ano'] = $horarioAno2[2];
    }
	$pos++;
}


$pos = 0;
foreach ($list as $group) {
    $data = explode("/", $group['dataPublicacao']);
	//var_dump($data);
	$list[$pos]['dataNum'] = $data[2].$data[1].$data[0];
	$pos++;
}




if ($ordernar) {
    array_sort_by($list, 'anoConcurso', $order = SORT_DESC);
}

rsort($listaAnos);

function retiraBarras($string)
{
    $string = str_replace("/", "&#47;", $string);
    return $string;
}

$ano2 = 0;
foreach ($list as $anoTemp) {
   
	
	if($ano2 != $anoTemp['anoConcurso']){
	
	$ano2 = $anoTemp['anoConcurso'];

    ?>
<div class="row report">
    <ul>
        <li class="titulo" style="width: 50px;">
            <?php echo $ano2; ?>
        </li>
        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
    </ul>
</div>
<div class="row botoes w100">
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('1<?= trim($ano2); ?>', 'pdf');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        PDF
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('1<?= trim($ano2); ?>', 'xml');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        XML
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('1<?= trim($ano2); ?>', 'csv');">
        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
        CSV
    </a>
    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_1<?= trim($ano2); ?>', 'export', 'Concursos Servidores <?= $ano2; ?>', this);">
        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
        IMPRIMIR
    </a>
    <div class="clearfix"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <table id="tabela_1<?= trim($ano2); ?>">
        <thead>
            <tr>
                <th>SEQ.</th>
                <th>Data</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <?php	
            $texto = "";
			 array_sort_by($list, 'dataNum', $order = SORT_DESC);
            foreach ($list as $listDados) {
			krsort($listDados);
			
                //$horarioAno2 = explode("/", $listDados['dataPublicacao']); 
                $anoConcurso = $listDados['anoConcurso'];
                if ($listDados['anoConcurso'] == $ano2) {
                    $texto .= "<tr>";
                    $texto .= "<td>" . $listDados['id'] . "</td>";
                    $texto .= "<td>" . $listDados['dataPublicacao'] ."</td>";
                    $texto .= " <td>
											<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $listDados['id'] . "&MOD=SV28&niveis=" . urlencode("Concuros e Seleções/Concursos de Servidores/CONCURSOS/" . $listDados['descricao']) . "'>
												" . $listDados['descricao'] . "
											</a>
										</td> ";
                    $texto .= "<tr>";
                }
            }
            echo $texto;
            ?>
        </tbody>
    </table>
    <?php 
    //Aqui conteém o HTML que vai ser trandormado em PDF.
    $htmlPDF = "<h3>Servidores Concursos</h3>";
    $htmlPDF .= "<table border=1 id='tabela_1" . trim($ano2) . "' cellspacing=0 cellpadding=5 >
							<tr>
                            <th>SEQ.</th>
                            <th>Data</th>
                            <th>Descrição</th>
							</tr> ";
    $htmlPDF .= str_replace("<br />", "", $texto);
    $htmlPDF .= "</table>";
    ?>
    <div style="display:none;"><input id="table_1<?= trim($ano2); ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
    <div style="display:none;" id="tabela_export_1<?= trim($ano2); ?>"><?php echo $htmlPDF; ?></div>
    <div class="clearfix"></div>
</div>
<?php	 //endif;
}

}
 ?> 