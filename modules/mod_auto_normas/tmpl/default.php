<?php defined('_JEXEC') or die;
include_once  'func.php';

function getDataAtualizacao($array)
{
	$dataAtualizacao = new DateTime();
	if (is_array($array) && !empty($array)) {
		for ($i = 0; $i < count($array); $i++) {
			$relatorio = $array[$i];
			if ($i == 0) {
				$dataAtualizacao = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
			} else {
				$dataTemp = DateTime::createFromFormat('d/m/Y', trim($relatorio['dataAtualizacao']));
				if ($dataTemp > $dataAtualizacao) {
					$dataAtualizacao = $dataTemp;
				}
			}
		}
	}
	$dataAtualizacao = $dataAtualizacao->format('d/m/Y');
	return $dataAtualizacao;
}

$ordernar = false;


$i=0;
foreach ($dados['responseAto'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernarresponseAto = true;
		$dados['responseAto'][$i]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
	}
	$i++;
}

$i=0;
foreach ($dados['responseLei'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernarresponseLei = true;
		$dados['responseLei'][$i]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
	}
	$i++;
}

$i=0;
foreach ($dados['responsePortaria'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernarresponsePortaria = true;
		$dados['responsePortaria'][$i]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
	}
	$i++;
}

$i=0;
foreach ($dados['responseProvimento'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernarresponseProvimento = true;
		$dados['responseProvimento'][$i]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
	}
	$i++;
}

$i=0;
foreach ($dados['responseResolucao'] as  $group) {
	$horarioAno2 = explode("/", $group['dataAtualizacao']);
	if (!empty($horarioAno2[2])) {
		$ordernarresponseResolucao = true;
		$dados['responseResolucao'][$i]['dataNumero'] = $horarioAno2[2].$horarioAno2[1].$horarioAno2[0];
	}
	$i++;
}

if($ordernarresponseAto){
	array_sort_by2($dados['responseAto'], 'dataNumero', $order = SORT_DESC);
}
if($ordernarresponseLei && !empty($dados['responseLei']['dataNumero'])){
	array_sort_by2($dados['responseLei'], 'dataNumero', $order = SORT_DESC);
}
if($ordernarresponsePortaria){
	array_sort_by2($dados['responsePortaria'], 'dataNumero', $order = SORT_DESC);
}
if($ordernarresponseProvimento){
	array_sort_by2($dados['responseProvimento'], 'dataNumero', $order = SORT_DESC);
}
if($ordernarresponseResolucao){
	array_sort_by2($dados['responseResolucao'], 'dataNumero', $order = SORT_DESC);
}






?>
			
<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">NORMAS - PJE</div>
            </div>
            <div class="row">
                <small>Última atualização: <?php echo getDataAtualizacao($dados['responseAto']); ?></small>
            </div>
            <div class="row report">
                <ul>
                    <li class="titulo">Ato</li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('atos');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_atos', 'export', 'PJE', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_atos">
                    <tr>
                        <th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>
                    <?php
					$texto  = "";
					foreach($dados['responseAto'] as $ato){ ?>
                    <?php	
					$texto .= "<tbody>
								<tr>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $ato['id'] . "&MOD=SV44&niveis=" . urlencode("PJE/NORMAS/" . $ato['descricaoNorma']) . "'>
									" . $ato['descricaoNorma'] . "</a>
								</td>
								<td>" . $ato['dataAtualizacao'] . "</td>
								<td>" . $ato['descricao'] . "</td>
								</tbody>
								</tr>";
			};
		echo  $texto;
		?>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>PJE Atos </h3>";
				$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
						<tr>
						<th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
						</tr>";
				$htmlPDF .= str_replace("<br />", "", $texto);
				$htmlPDF .= "</table>";
				?>
                <div style="display:none;"><input id="table_atos" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_atos"><?php echo $htmlPDF; ?></div>
            <div class="clearfix"></div>
        </div>
		
		
			<div class="row report">
                <ul>
                    <li class="titulo">Lei</li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('lei');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_lei', 'export', 'PJE', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_lei">
                    <tr>
                        <th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>
                    <?php
					$texto  = "";
					foreach($dados['responseLei'] as $lei){
						if(!empty($lei['descricaoNorma'])){
						$texto .= "<tbody>
									<tr>
									<td>
										<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $lei['id'] . "&MOD=SV45&niveis=" . urlencode("PJE/NORMAS/" . $lei['descricaoNorma']) . "'>
										" . $lei['descricaoNorma'] . "</a>
									</td>
									<td>" . $lei['dataAtualizacao'] . "</td>
									<td>" . $lei['descricao'] . "</td>
									</tbody>
									</tr>";
						}
					};
		echo  $texto;
		?>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>PJE Lei </h3>";
				$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
						<tr>
						<th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
						</tr>";
				$htmlPDF .= str_replace("<br />", "", $texto);
				$htmlPDF .= "</table>";
				?>
                <div style="display:none;"><input id="table_lei" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_lei"><?php echo $htmlPDF; ?></div>
            <div class="clearfix"></div>
        </div>
		
		

			<div class="row report">
                <ul>
                    <li class="titulo">Portaria</li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('portaria');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_portaria', 'export', 'PJE', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_portaria">
                    <tr>
                        <th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>
                    <?php
					$texto  = "";
					foreach($dados['responsePortaria'] as $portaria){ ?>
                    <?php	
					$texto .= "<tbody>
								<tr>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $portaria['id'] . "&MOD=SV46&niveis=" . urlencode("PJE/NORMAS/" . $portaria['descricaoNorma']) . "'>
													" . $portaria['descricaoNorma'] . "</a>
								</td>
								<td>" . $portaria['dataAtualizacao'] . "</td>
								<td>" . $portaria['descricao'] . "</td>
								</tbody>
								</tr>
					";
			};
		echo  $texto;
		?>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>PJE Portaria </h3>";
				$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
						<tr>
						<th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
						</tr>";
				$htmlPDF .= str_replace("<br />", "", $texto);
				$htmlPDF .= "</table>";
				?>
                <div style="display:none;"><input id="table_portaria" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_portaria"><?php echo $htmlPDF; ?></div>
            <div class="clearfix"></div>
        </div>
		
		
		
		
		
			<div class="row report">
                <ul>
                    <li class="titulo">Provimento</li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('provimento');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_provimento', 'export', 'PJE', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_provimento">
                    <tr>
                        <th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>
                    <?php
					$texto  = "";
					foreach($dados['responseProvimento'] as $provimento){ ?>
                    <?php	
					$texto .= "<tbody>
								<tr>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $provimento['id'] . "&MOD=SV47&niveis=" . urlencode("PJE/NORMAS/" . $provimento['descricaoNorma']) . "'>
													" . $provimento['descricaoNorma'] . "</a>
								</td>
								<td>" . $provimento['dataAtualizacao'] . "</td>
								<td>" . $provimento['descricao'] . "</td>
								</tbody>
								</tr>
					";
			};
		echo  $texto;
		?>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>PJE Provimento </h3>";
				$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
						<tr>
						<th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
						</tr>";
				$htmlPDF .= str_replace("<br />", "", $texto);
				$htmlPDF .= "</table>";
				?>
                <div style="display:none;"><input id="table_provimento" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_provimento"><?php echo $htmlPDF; ?></div>
            <div class="clearfix"></div>
        </div>
		
		
		
		
		
			<div class="row report">
                <ul>
                    <li class="titulo">Resolução</li>
                    <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                </ul>
            </div>
            <div class="row botoes w100">
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('resolucao');">
                    <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                    PDF
                </a>
                <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_resolucao', 'export', 'PJE', this);">
                    <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                    IMPRIMIR
                </a>
                <div class="clearfix"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <table id="tabela_resolucao">
                    <tr>
                        <th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
                    </tr>
                    <?php
					$texto  = "";
					foreach($dados['responseResolucao'] as $resolucao){ ?>
                    <?php	
					$texto .= "<tbody>
								<tr>
								<td>
									<a href='../index.php/gestao-orcamentaria/resultado-pdf?/id=" . $resolucao['id'] . "&MOD=SV48&niveis=" . urlencode("PJE/NORMAS/" . $resolucao['descricaoNorma']) . "'>
													" . $resolucao['descricaoNorma'] . "</a>
								</td>
								<td>" . $resolucao['dataAtualizacao'] . "</td>
								<td>" . $resolucao['descricao'] . "</td>
								</tbody>
								</tr>";
			};
		echo  $texto;
		?>
                </table>
                <?php 
				//Aqui conteém o HTML que vai ser trandormado em PDF.
				$htmlPDF = "<h3>PJE Resolução </h3>";
				$htmlPDF .= "<table border=1 cellspacing=0 cellpadding=5 >
						<tr>
						<th>NORMAS</th>
                        <th>DATA</th>
                        <th>DESCRIÇÃO</th>
						</tr>";
				$htmlPDF .= str_replace("<br />", "", $texto);
				$htmlPDF .= "</table>";
				?>
                <div style="display:none;"><input id="table_resolucao" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                <div style="display:none;" id="tabela_export_resolucao"><?php echo $htmlPDF; ?></div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div> 









