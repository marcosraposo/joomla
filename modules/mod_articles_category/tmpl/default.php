<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$dataHoje = date("d/m/Y");
require_once 'func.php';
$ordernar = false;



/*
foreach ($list as $group) {
	$horarioAno2 = explode("/", $group->title);
	if (!empty($horarioAno2[1])) {
		$ordernar = true;
		$group->anocotacao = $horarioAno2[1];
	}
}

if ($ordernar) {
	array_sort_by($list, 'anocotacao', $order = SORT_ASC);
}*/


$ordernar = false;
$i1 = 0;
foreach ($list as  $group) {
	$horarioAno2 = explode("-", $group->created);
	if (!empty($horarioAno2[0])) {
		$ordernar = true;
		$list[$i1]->anoCreate = $horarioAno2[0];
	}
	$i1++;
}

if ($ordernar) {
	array_sort_by($list, 'anoCreate', $order = SORT_ASC);
}



$categoriasExibidas = array("bancos-de-termos-de-referencia", "obras-e-servicos-de-engenharia", "licitacoes", "participacoes-trf5-orgaos-participacoes", "atas-de-registro-de-preco-adesao", "participacoes-trf5-orgaos-adesoes", "termos-de-cessao-de-uso", "licitacoes-e-contratacoes-dispensas", "contratacoes-diretas-inexigibilidades", "cotacao-eletronica", "informacoes-complementares", "processos-de-aplicacao-de-penalidades", "desfazimento-de-bens");


foreach ($list as $group) {
	if ($group->parent_alias == "banco-de-termos-de-referencia") {
		array_push($categoriasExibidas, $group->category_alias);
	}
}
?>

<?php
$ano = 0;
if ($group->category_alias == "cotacao-eletronica") : ?>
<div class="row conteudo selecionado" data-aba-id="1">
    <div class="col-12">
        <div class="row">
            <div class="titulo">Relação de Cotações Eletrônicas Realizadas</div>
        </div>
        <div class="row">
            <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
        </div>
        <?php
				for ($i = count($list) - 1; $i >= 0; $i--) {
					$group = $list[$i];
					$horarioAno = explode("-", $group->created);
					if ($ano != $horarioAno[0]) :
						$ano = $horarioAno[0];
						?>
        <div class="row report">
            <ul>
                <li class="titulo"><?php echo $horarioAno[0]; ?></li>
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
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                IMPRIMIR
            </a>
            <div class="clearfix"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <table id="tabela_<?= $ano; ?>">
                <thead>
                    <tr>
                        <th>Cotação Eletrônica Nº</th>
                        <th>Descrição</th>
                        <th>Data de Abertura</th>
                        <th>Horário de Abertura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php	
										$texto = "";
										foreach ($list as $group_name =>  $listDados) :
											$horarioAno2 = explode("-", $listDados->created);
											if ($horarioAno2[0] == $horarioAno[0]) :
												$texto .= "<tr>";
												$texto .=  html_entity_decode($listDados->introtext);
												$texto .= "</tr>";
												?>
                    <?php	endif;
								endforeach;
								echo  str_replace("<br />", "", $texto);
								?>
                </tbody>
            </table>
            <?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>Relação de Cotações Eletrônicas Realizadas</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1 id='tabela2_" . $ano . "' cellspacing=0 cellpadding=5 >
						<tr>
						<th>Cotação Eletrônica Nº</th>
						<th>Descrição</th>
						<th>Data de Abertura</th>
						<th>Horário de Abertura</th>
						</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
            <div style="display:none;"><input id="table_<?= $ano; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
            <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>

            <div class="clearfix"></div>
        </div>
        <?php	endif;
		} ?>
    </div>
</div>
<?php
endif;
?>


<?php
$ano = 0;
if ($group->category_alias == "informacoes-complementares") : ?>
<div class="row conteudo" data-aba-id="2">
    <div class="col-12">
        <div class="row">
            <div class="titulo">Relação de Cotações Eletrônicas Realizadas</div>
        </div>
        <div class="row">
            <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
        </div>
        <?php
				for ($i = count($list) - 1; $i >= 0; $i--) {
					$group = $list[$i];
					$horarioAno = explode("-", $group->created);
					if ($ano != $horarioAno[0]) :
						$ano = $horarioAno[0];
						?>
        <div class="row report">
            <ul>
                <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
            </ul>
        </div>
        <div class="row botoes w100">
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>');">
                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                PDF
            </a>
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'xml');">
                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                XML
            </a>
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'csv');">
                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                CSV
            </a>
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela2_export_<?= $ano; ?>', 'export', '', this);">
                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                IMPRIMIR
            </a>
            <div class="clearfix"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <table id="tabela_2_<?= $ano; ?>">
                <thead>
                    <tr>
                        <th>Cotação Eletrônica Nº</th>
                        <th>Documentos Complementares</th>
                        <th>Descrição Resumida do Objeto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php	
										$texto = "";
										foreach ($list as $group_name =>  $listDados) :
											$horarioAno2 = explode("-", $listDados->created);
											if ($horarioAno2[0] == $horarioAno[0]) :
												$texto .= "<tr>";
												$texto .=  html_entity_decode($listDados->introtext);
												$texto .= "</tr>";
												?>
                    <?php	endif;
								endforeach;
								echo str_replace("<br />", "", $texto);
								?>
                </tbody>
            </table>
            <?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>Relação de Cotações Eletrônicas Realizadas - Informações Complementares</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1  cellspacing=0 cellpadding=5 >
						<tr>
						<th>Cotação Eletrônica Nº</th>
						<th>Documentos Complementares</th>
						<th>Descrição Resumida do Objeto</th>
						</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
            <div style="display:none;"><input type="text" id="table_2_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
            <div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
            <div class="clearfix"></div>
        </div>
        <?php	endif;
		} ?>
    </div>
</div>
<?php
endif;
?>


<?php
$ano = 0;
if ($group->category_alias == "processos-de-aplicacao-de-penalidades") : ?>
<div class="row conteudo selecionado">
    <div class="col-12">
        <div class="row">
            <div class="titulo">Processos de Aplicação de Penalidades</div>
        </div>
        <div class="row">
            <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
        </div>
        <?php
				for ($i = count($list) - 1; $i >= 0; $i--) :
                    $group = $list[$i];
                    //foreach ($list as $group_name => $group) :
					$horarioAno = explode("-", $group->created);
					if ($ano != $horarioAno[0]) :
						$ano = $horarioAno[0];
						?>
        <div class="row report">
            <ul>
                <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
            </ul>
        </div>
        <div class="row botoes w100">
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
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
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '',this);">
                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                IMPRIMIR
            </a>
            <br>


            <table id="tabela_<?= $ano; ?>" style="  width:700px; font-size: 10.5px;   ">
                <thead>
                    <tr>
                        <th style="font-size: 10.5px;">Nº Processo</th>
                        <th style="font-size: 10.5px;">Empresa</th>
                        <th style="font-size: 10.5px;">CNPJ</th>
                        <th style="font-size: 10.5px;">Nº Contrato Empenho</th>
                        <th style="font-size: 10.5px;">Tipo Sanção</th>
                        <th style="font-size: 10.5px;">Fundamentação Legal</th>
                        <th style="font-size: 10.5px;">Motivo da Sanção</th>
                        <th style="font-size: 10.5px;">Data Início da Sanção</th>
                        <th style="font-size: 10.5px;">Data Fim da Sanção</th>
                        <th style="font-size: 10.5px;">Origem da Informação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php	
										$texto = "";
										foreach ($list as $group_name =>  $listDados) :
											$horarioAno2 = explode("-", $listDados->created);
											if ($horarioAno2[0] == $horarioAno[0]) :
												$texto .= "<tr>";
												$texto .=  html_entity_decode($listDados->introtext);
												$texto .= "</tr>";
												?>
                    <?php	endif;
								endforeach;
								echo  str_replace("<br />", "", $texto);
								?>
                </tbody>
            </table>
            <?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.

						$htmlPDF = "<h3>Processos de Aplicação de Penalidades</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1  cellspacing=0 >
						<tr>
						<th>Nº Processo</th>
                        <th>Empresa</th>
                        <th>CNPJ</th>
                        <th>Nº Contrato / Emprenho</th>
                        <th>Tipo Sanção</th>
                        <th>Fundamentação Legal</th>
                        <th>Motivo da Sanção</th>
                        <th>Data Início da Sanção</th>
                        <th>Data Fim da Sanção</th>
                        <th>Origem da Informação</th>
						</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
            <div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
            <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>

        </div>
        <?php	endif;
		endfor; ?>
    </div>
</div>
<?php endif; ?>

<?php
$ano = 0;
if ($group->category_alias == "contratacoes-diretas-inexigibilidades") : ?>
<div class="row conteudo selecionado" data-aba-id="1">
    <div class="col-12">
        <div class="row">
            <div class="titulo">Relatórios de Contratações Diretas - Inexigibilidade</div>
        </div>
        <div class="row">
            <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
        </div>
        <?php
                for($i=count($list)-1; $i >= 0; $i--) :
                    $group = $list[$i];
                //foreach ($list as $group_name => $group) :
					$horarioAno = explode("-", $group->created);
					if ($ano != $horarioAno[0]) :
						$ano = $horarioAno[0];
						?>
        <div class="row report">
            <ul>
                <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
            </ul>
        </div>
        <div class="row botoes w100">
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
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
            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                IMPRIMIR
            </a>
            <br>
            <table id="tabela_<?= $ano; ?>">
                <thead>
                    <tr>
                        <th>SEQ.</th>
                        <th>Nº Processo</th>
                        <th>Favorecido</th>
                        <th>CNPJ</th>
                        <th>Objeto</th>
                        <th>Valor</th>
                        <th>Nº Contrato</th>
                        <th>Amparo Legal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php	
										$texto = "";
										foreach ($list as $group_name =>  $listDados) :
											$horarioAno2 = explode("-", $listDados->created);
											if ($horarioAno2[0] == $horarioAno[0]) :
												$texto .= "<tr>";
												$texto .=  html_entity_decode($listDados->introtext);
												$texto .= "</tr>";
												?>
                    <?php	endif;
								endforeach;
								echo  str_replace("<br />", "", $texto);
								?>
                </tbody>
            </table>
            <?php 
						//Aqui conteém o HTML que vai ser trandormado em PDF.
						$htmlPDF = "<h3>Relatórios de Contratações Diretas - Inexigibilidade</h3>";
						$htmlPDF .= "<h4>" . $ano . "</h4>";
						$htmlPDF .= "<table border=1>
						<tr>
                        <th>SEQ.</th>
                        <th>Nº Processo</th>
                        <th>Favorecido</th>
                        <th>CNPJ</th>
                        <th>Objeto</th>
                        <th>Valor</th>
                        <th>Nº Contrato</th>
                        <th>Amparo Legal</th>
					</tr>";
						$htmlPDF .= str_replace("<br />", "", $texto);
						$htmlPDF .= "</table>";
						?>
            <div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
            <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
        </div>
        <?php	endif;
		endfor; ?>
    </div>
    <div>
        <?php endif;
			?>

        <?php
				$ano = 0;
				if ($group->category_alias == "licitacoes-e-contratacoes-dispensas") : ?>
        <div class="row conteudo" data-aba-id="2">
            <div class="col-12">
                <div class="row">
                    <div class="titulo">Relatórios de Contratações Diretas - Dispensa de Licitação</div>
                </div>
                <div class="row">
                    <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                </div>
                <?php
                    for($i=count($list)-1; $i >= 0; $i--) :
                        $group = $list[$i];
                                //foreach ($list as $group_name => $group) :
									$horarioAno = explode("-", $group->created);
									if ($ano != $horarioAno[0]) :
										$ano = $horarioAno[0];
										?>
                <div class="row report">
                    <ul>
                        <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                    </ul>
                </div>
                <div class="row botoes w100">
                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>');">
                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                        PDF
                    </a>
                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'xml');">
                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                        XML
                    </a>
                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'csv');">
                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                        CSV
                    </a>
                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela2_export_<?= $ano; ?>', 'export', '', this);">
                        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                        IMPRIMIR
                    </a>
                    <br>
                    <table id="tabela_2_<?= $ano; ?>">
                        <thead>
                            <tr>
                                <th>SEQ.</th>
                                <th>Nº Processo</th>
                                <th>Favorecido</th>
                                <th>CNPJ</th>
                                <th>Objeto</th>
                                <th>Valor</th>
                                <th>Nº Contrato</th>
                                <th>Amparo Legal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php	
														$texto = "";
														foreach ($list as $group_name =>  $listDados) :
															$horarioAno2 = explode("-", $listDados->created);
															if ($horarioAno2[0] == $horarioAno[0]) :
																$texto .= "<tr>";
																$texto .=  html_entity_decode($listDados->introtext);
																$texto .= "</tr>";
																?>
                            <?php	endif;
												endforeach;
												echo  str_replace("<br />", "", $texto);
												?>
                        </tbody>
                    </table>
                    <?php 
										//Aqui conteém o HTML que vai ser trandormado em PDF.
										$htmlPDF = "<h3>Relatórios de Contratações Diretas - Dispensa de Licitação</h3>";
										$htmlPDF .= "<h4>" . $ano . "</h4>";
										$htmlPDF .= "<table border=1>
						<tr>
                        <th>SEQ.</th>
                        <th>Nº Processo</th>
                        <th>Favorecido</th>
                        <th>CNPJ</th>
                        <th>Objeto</th>
                        <th>Valor</th>
                        <th>Nº Contrato</th>
                        <th>Amparo Legal</th>
						</tr>";
										$htmlPDF .= str_replace("<br />", "", $texto);
										$htmlPDF .= "</table>";
										?>
                    <div style="display:none;"><input type="text" id="table_2_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                    <div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>

                </div>
                <?php	endif;
						endfor; ?>
            </div>
            <div>
                <?php endif;
							?>


                <!-- DESFAZIMENTO DE BENS -->
                <?php
								$ano = 0;
								if ($group->category_alias == "desfazimento-de-bens") :
									foreach ($list as $group_name => $group) :
										$horarioAno = explode("-", $group->created);
										if ($ano != $horarioAno[0]) :
											$ano = $horarioAno[0];
											?>
                <div class="row report">
                    <ul>
                        <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                    </ul>
                </div>
                <div class="row botoes w100">
                    <a href="#conteudo" role="button" class="download">
                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                        PDF
                    </a>
                    <a href="#conteudo" role="button" class="download">
                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                        XML
                    </a>
                    <a href="#conteudo" role="button" class="download">
                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                        CSV
                    </a>
                    <a href="#conteudo" role="button" class="download">
                        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                        IMPRIMIR
                    </a>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <th>Nº Processo</th>
                                <th>Empresa</th>
                                <th>CNPJ</th>
                                <th>Nº Contrato/Emprenho</th>
                                <th>Tipo Sanção</th>
                                <th>Fundamentação Legal</th>
                                <th>Motivo da Sanção</th>
                                <th>Data Início da Sanção</th>
                                <th>Data Fim da Sanção</th>
                                <th>Origem da Informação</th>
                            </tr>
                        </thead>
                        <?php	
												$texto = "";
												foreach ($list as $group_name =>  $listDados) :
													$horarioAno2 = explode("-", $listDados->created);
													if ($horarioAno2[0] == $horarioAno[0]) :
														$texto .= "<tr>";
														$texto .=  html_entity_decode($listDados->introtext);
														$texto .= "</tr>";
														?>
                        <?php	endif;
										endforeach;
										echo  str_replace("<br />", "", $texto);
										?>
                    </table>
                </div>
                <?php	endif;
						endforeach;
					endif;
					?>




                <!-- PARTICIPACOES TRF5 ORGAOS PARTICIPACOES -->
                <?php
								$ano = 0;
								if ($group->category_alias == "participacoes-trf5-orgaos-participacoes") : ?>
                <div class="row conteudo selecionado" data-aba-id="1">
                    <div class="col-12">
                        <div class="row">
                            <div class="titulo">Participações do Trf5 em Licitações de Outros Órgãos</div>
                        </div>
                        <div class="row">
                            <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                        </div>
                        <?php
												for($i=count($list)-1; $i >= 0; $i--) :
                                                    $group = $list[$i];
                                                    //foreach ($list as $group_name => $group) :
													$horarioAno = explode("-", $group->created);
													if ($ano != $horarioAno[0]) :
														$ano = $horarioAno[0];
														?>
                        <div class="row report">
                            <ul>
                                <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                                <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                            </ul>
                        </div>
                        <div class="row botoes w100">
                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
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
                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                                IMPRIMIR
                            </a>
                            <br>
                            <table id="tabela_<?= $ano; ?>">
                                <thead>
                                    <tr>
                                        <th>Nº PROCESSO</th>
                                        <th>Nº PREGÃO</th>
                                        <th>Nº DA ATA DE REGISTRO DE PREÇOS</th>
                                        <th>ÓRGÃO GERENCIADOR</th>
                                        <th>OBJETO</th>
                                        <th>VALOR</th>
                                        <th>FORNECEDOR</th>
                                        <th>CNPJ</th>
                                        <th>NOTA DE EMPENHO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php	
																		$texto = "";
																		foreach ($list as $group_name =>  $listDados) :
																			$horarioAno2 = explode("-", $listDados->created);
																			if ($horarioAno2[0] == $horarioAno[0]) :
																				$texto .= "<tr>";
																				$texto .=  html_entity_decode($listDados->introtext);
																				$texto .= "</tr>";
																				?>
                                    <?php	endif;
																endforeach;
																echo  str_replace("<br />", "", $texto); ?>
                                </tbody>
                            </table>
                            <?php 
														//Aqui conteém o HTML que vai ser trandormado em PDF.
														$htmlPDF = "<h3>Participações do TRF5 em Licitações de Outros Órgãos</h3>";
														$htmlPDF .= "<h4>" . $ano . "</h4>";
														$htmlPDF .= "<table border=1  cellspacing=0>
						<tr>
						<th>Nº PROCESSO</th>
                        <th>Nº PREGÃO</th>
                        <th>Nº DA ATA DE REGISTRO DE PREÇOS</th>
                        <th>ÓRGÃO GERENCIADOR</th>
                        <th>OBJETO</th>
                        <th>VALOR</th>
                        <th>FORNECEDOR</th>
						<th>CNPJ</th>
						<th>NOTA DE EMPENHO</th>
						</tr>";
														$htmlPDF .= str_replace("<br />", "", $texto);
														$htmlPDF .= "</table>";
														?>
                            <div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                            <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                        </div>
                        <?php	endif;
										endfor; ?>
                    </div>
                    <div>
                        <?php endif;
											?>










                        <!-- PARTICIPACOES TRF5 ORGAOS ADESOES -->
                        <?php
												$ano = 0;
												if ($group->category_alias == "participacoes-trf5-orgaos-adesoes") : ?>
                        <div class="row conteudo" data-aba-id="2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="titulo">Adesão de Outros Órgãos as ARP's do TRF5</div>
                                </div>
                                <div class="row">
                                    <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                                </div>
                                <?php
                                                    for($i=count($list)-1; $i >= 0; $i--) :
                                                        $group = $list[$i];
                                                        //foreach ($list as $group_name => $group) :
																	$horarioAno = explode("-", $group->created);
																	if ($ano != $horarioAno[0]) :
																		$ano = $horarioAno[0];
																		?>
                                <div class="row report">
                                    <ul>
                                        <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                                        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                                    </ul>
                                </div>
                                <div class="row botoes w100">
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>');">
                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                        PDF
                                    </a>
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'xml');">
                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                        XML
                                    </a>
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'csv');">
                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                        CSV
                                    </a>
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela2_export_<?= $ano; ?>', 'export', '', this);">
                                        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                                        IMPRIMIR
                                    </a>
                                    <br>
                                    <table id="tabela_2_<?= $ano; ?>">
                                        <thead>
                                            <tr>
                                                <th>ÓRGÃO NÃO PARTICIPANTE</th>
                                                <th>QUANTIDADE SOLICITADA</th>
                                                <th>VALOR TOTAL DA ADESÃO</th>
                                                <th>N.º ATA - TRF5</th>
                                                <th>Processo Licitatório</th>
                                                <th>EMPRESA VENCEDORA</th>
                                                <th>OBJETO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php	
																						$texto = "";
																						foreach ($list as $group_name =>  $listDados) :
																							$horarioAno2 = explode("-", $listDados->created);
																							if ($horarioAno2[0] == $horarioAno[0]) :
																								$texto .= "<tr>";
																								$texto .=  html_entity_decode($listDados->introtext);
																								$texto .= "</tr>";
																								?>
                                            <?php	endif;
																				endforeach;
																				echo  str_replace("<br />", "", $texto);
																				?>
                                        <tbody>
                                    </table>
                                    <?php 
																		//Aqui conteém o HTML que vai ser trandormado em PDF.
																		$htmlPDF = "<h3>Adesão de Outros Órgãos as ARP's do TRF5</h3>";
																		$htmlPDF .= "<h4>" . $ano . "</h4>";
																		$htmlPDF .= "<table border=1  cellspacing=0 >
						<tr>
                        <th>ÓRGÃO NÃO PARTICIPANTE</th>
                        <th>QUANTIDADE SOLICITADA</th>
                        <th>VALOR TOTAL DA ADESÃO</th>
                        <th>N.º ATA - TRF5</th>
                        <th>Processo Licitatório</th>
                        <th>EMPRESA VENCEDEDORA</th>
                        <th>OBJETO</th>
						</tr>";
																		$htmlPDF .= str_replace("<br />", "", $texto);
																		$htmlPDF .= "</table>";
																		?>
                                    <div style="display:none;"><input type="text" id="table_2_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                                    <div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>

                                </div>
                                <?php	endif;
														endfor; ?>
                            </div>
                            </div>
                                <?php endif;
															?>





                                <!-- ATA DE REGISTRO DE PREÇO ADESOES -->
                                <?php
																$ano = 0;
																if ($group->category_alias == "atas-de-registro-de-preco-adesao") : ?>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="titulo">Adesões de Outros Órgãos as Arp's do Trf5</div>
                                    </div>
                                    <div class="row">
                                        <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                                    </div>
                                    <?php
																		for ($i = count($list) - 1; $i >= 0; $i--) {
																			$group = $list[$i];
																			$horarioAno = explode("-", $group->created);
																			if ($ano != $horarioAno[0]) :
																				$ano = $horarioAno[0];
																				?>
                                    <div class="row report">
                                        <ul style="width: 20%">
                                            <li class="titulo" style="display: inline-block; width: 59px;"><?= $ano; ?></li>
                                            <li class="arrow-down"><a href="#abaAdesao"><img src="templates/portalTRF5/images/arrow_down_2.svg" width="34"></a></li>
                                        </ul>
                                    </div>
                                    <div class="row botoes w100">
                                        <div class="boxBotoes">
                                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('2_<?= $ano; ?>', 'pdf');">
                                                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                                PDF
                                            </a>
                                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'xml');">
                                                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                                XML
                                            </a>
                                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('2_<?= $ano; ?>', 'csv');">
                                                <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                                CSV
                                            </a>
                                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela2_export_<?= $ano; ?>', 'export', '', this);">
                                                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                                                IMPRIMIR
                                            </a>
                                        </div>
                                        <br>
                                        <table id="tabela_2_<?= $ano; ?>">
                                            <thead>
                                                <tr>
                                                    <th>Nº PROCESSO</th>
                                                    <th>Nº PREGÃO</th>
                                                    <th>ÓRGÃO GESTOR</th>
                                                    <th>EMPRESA VENCEDORA</th>
                                                    <th>CNPJ</th>
                                                    <th>ASSUNTO</th>
                                                    <th>VALOR</th>
                                                    <th>Nº NOTA DE EMPENHO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php	
																								$texto = "";
																								foreach ($list as $group_name =>  $listDados) :
																									$horarioAno2 = explode("-", $listDados->created);
																									if ($horarioAno2[0] == $horarioAno[0]) :
																										$texto .= "<tr>";
																										$texto .=  html_entity_decode($listDados->introtext);
																										$texto .= "</tr>";
																										?>
                                                <?php	endif;
																						endforeach;
																						echo  str_replace("<br />", "", $texto);
																						?>
                                                </body>
                                        </table>
                                        <?php 
																				//Aqui conteém o HTML que vai ser trandormado em PDF.
																				$htmlPDF = "<h3>Adesões de Outros Órgãos as ARP's do TRF5</h3>";
																				$htmlPDF .= "<h4>" . $ano . "</h4>";
																				$htmlPDF .= "<table border=1  cellspacing=0 cellpadding=5 >
						<tr>
						<th>Nº PROCESSO</th>
						<th>Nº PREGÃO</th>
						<th>ÓRGÃO GESTOR</th>
						<th>EMPRESA VENCEDORA</th>
						<th>CNPJ</th>
						<th>ASSUNTO</th>
						<th>VALOR</th>
						<th>Nº NOTA DE EMPENHO</th>
						</tr>";
																				$htmlPDF .= str_replace("<br />", "", $texto);
																				$htmlPDF .= "</table>";
																				?>
                                        <div style="display:none;"><input type="text" id="table_2_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                                        <div style="display:none;" id="tabela2_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                                    </div>
                                    <?php	endif;
																}
															endif;
															?>
                                </div>


                                <!-- LICITAÇÕES -->
                                <?php
																$ano = 0;
																if ($group->category_alias == "licitacoes") : ?>
                                <div class="row">
                                    <div class="titulo">Relatório de Licitações</div>
                                </div>
                                <div class="row">
                                    <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                                </div>
                                <?php
																for ($i = count($list) - 1; $i >= 0; $i--) {
																	$group = $list[$i];
																	//foreach($list as $group_name => $group):
																	$horarioAno = explode("-", $group->created);
																	if ($ano != $horarioAno[0]) :
																		$ano = $horarioAno[0];
																		?>
                                <div class="row report">
                                    <ul>
                                        <li class="titulo" style="display: inline-block; width: 59px;"><?= $ano; ?></li>
                                        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                                    </ul>
                                </div>
                                <div class="row botoes w100">
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                        PDF
                                    </a>
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?= $ano; ?>', 'xml');">
                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                        XML
                                    </a>
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?= $ano; ?>', 'csv');">
                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                        CSV
                                    </a>
                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                                        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                                        IMPRIMIR
                                    </a>
                                    <br>
                                    <table id="tabela_<?= $ano; ?>">
                                        <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Hora (Brasília)</th>
                                            <th>Documentos /Resultado da Licitação</th>
                                            <th>Objeto</th>
                                            <th>Valor Estimado (R$)</th>
                                            <th>Situação</th>
                                        </tr>
                                        </thead>
                                        <?php	
																				$texto = "";
																				foreach ($list as $group_name =>  $listDados) :
																					$horarioAno2 = explode("-", $listDados->created);
																					if ($horarioAno2[0] == $horarioAno[0]) :
																						$texto .= "<tr>";
																						$texto .=  html_entity_decode($listDados->introtext);
                                                                                        $texto .= "</tr>";
                                                                                        $texto = str_replace("<tbody>", "", $texto);
                                                                                        $texto = str_replace("</tbody>", " ", $texto);
																						?>
                                        <?php	endif;
																		endforeach;
																		echo  str_replace("<br />", "", $texto);
																		?>
                                    </table>
                                    <?php 
																		//Aqui conteém o HTML que vai ser trandormado em PDF.
																		$htmlPDF = "<h3>Relatório de Licitações</h3>";
																		$htmlPDF .= "<h4>".$ano."</h4>";
																		$htmlPDF .= "<table border=1 id='tabela_" . $ano . "' cellspacing=0 cellpadding=5 >
						<tr>
						<th>Data</th>
						<th>Hora</th>
						<th>Documentos/Resultado da Licitação</th>
                        <th>Objeto</th>
                        <th>Valor Estimado (R$)</th>
                        <th>Situação</th>
						</tr>";
                                                                        $htmlPDF .= str_replace("<br />", "", $texto);
                                                                        $htmlPDF = str_replace("<tbody>", "", $htmlPDF);
                                                                        $htmlPDF = str_replace("</tbody>", " ", $htmlPDF);
																		$htmlPDF .= "</table>";
																		?>
                                    <div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                                    <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
                                </div>
                                <?php	endif;
														}
													endif;
													?>



                                <?php if (in_array($group->category_alias, array("bancos-de-termos-de-referencia", "ti-servicos", "ti-servicos-novo", "terceirizacao", "obras-e-servicos-de-engenharia"))) : ?>
                                <div class="spacer"></div>
                                <div class="spacer"></div>
                                <div class="container demonstrativo bg_azul_fundo">
                                    <div class="row conteudo selecionado" data-aba-id="1">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="titulo">Banco de termos de referência</div>
                                            </div>
                                            <div class="row">
                                                <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                                            </div>

                                            <div>
                                                <table border=0>
                                                    <?php array_sort_by($list, 'category_title', $order = SORT_ASC);
                                                        $category_alias = "";
                                                        $category_alias2 = "";
                                                        $texto = "";
                                                        $i = 0;
                                                        foreach ($list as $categoria) {
                                                            if ($categoria->category_alias != $category_alias) {
                                                                $i++;
                                                                echo " </table>";
                                                                
                                                                $htmlPDF = "<h3>Banco de Termos de Referência</h3>";
                                                                $htmlPDF .= "<h4>" . $categoria->category_title . "</h4>";
                                                                $htmlPDF .= $categoria->introtext;
                                                                $htmlPDF = str_replace("<table ", "<table border='1' colspan='0' cellspacing='0' ", $htmlPDF);
                                                                $htmlPDF = str_replace("<br />", "", $htmlPDF);
                                                                $htmlPDF .= "</table>";
                                                                ?>
                                                            <div style="display:none;"><input id="table_<?= $categoria->category_alias; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                                                            <div style="display:none;" id="tabela_export_<?= $categoria->category_alias; ?>"><?php echo $htmlPDF; ?></div>
                                                   
                                                   <?php
                                                        $category_alias = $categoria->category_alias;

								echo "<div class='clearfix'></div>
							</div>
								<div class='row report'>
								<ul>
									<li class='titulo'>" . $categoria->category_title . "</li>
									<li class='arrow-down'><a href='#conteudo' role='button'><img src='/joomla/templates/portalTransparencia/images/arrow_down_2.svg' alt='Abrir conteúdo'></a></li>
								</ul>
							</div>
							<div class='row botoes w100'>"; ?>
                                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF('<?= $categoria->category_alias; ?>');">
                                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                                        PDF
                                                    </a>
                                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?= $categoria->category_alias; ?>', 'xml');">
                                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                                        XML
                                                    </a>
                                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('<?= $categoria->category_alias; ?>', 'csv');">
                                                        <div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
                                                        CSV
                                                    </a>
                                                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $categoria->category_alias; ?>', 'export','<?= $categoria->category_title; ?>', this );">
                                                        <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                                                        IMPRIMIR
                                                    </a>
                                                    <?php echo "
								<div class='clearfix'></div>
								<div class='spacer'></div>
								<div class='spacer'></div>
								<table border=0 id='tabela_" . $categoria->category_alias . "'>
								<thead><tr></tr></thead>
								<tbody>";
																									}
																									echo "<tr><td class='bold'>" . $categoria->introtext . "</td></tr>";
																									$category_alias2 = $categoria->category_alias;
																								} ?>
                                                    </tbody>
                                                </table>
                                                <?php 
                                                    //Aqui conteém o HTML que vai ser trandormado em PDF.
                                                    $htmlPDF = "<h3>Banco de Termos de Referência</h3>";
                                                    $htmlPDF .= "<h4>" . $categoria->category_title . "</h4>";
                                                    $htmlPDF .= $categoria->introtext;
                                                    $htmlPDF .= str_replace("<table ", "<table border='1'", $categoria->introtext);
                                                    $htmlPDF .= str_replace("<br />", "", $htmlPDF);
                                                    $htmlPDF .= "</table>";
                                                    ?>
                                                <div style="display:none;"><input id="table_<?= $categoria->category_alias; ?>" type="text" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                                                <div style="display:none;" id="tabela_export_<?= $categoria->category_alias; ?>"><?php echo $htmlPDF; ?></div>
                                                <div class='clearfix'></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>









                            <?php
														$ano = 0;
														if ($group->category_alias == "selecoes") :

															$ordernar = false;
															foreach ($list as $group) {
																$horarioAno = explode("-", $group->created);
																if (!empty($horarioAno[0])) {
																	$ordernar = true;
																	$group->anoOrdem = $horarioAno[0];
																}
															}
															if ($ordernar) {
																array_sort_by($list, 'anoOrdem', $order = SORT_DESC);
															}
															?>
                            <div class="container demonstrativo bg_azul_fundo">
                                <div class="row conteudo selecionado">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="titulo">Seleções</div>
                                        </div>
                                        <div class="row">
                                            <small>Última atualização: <?php echo getDataAtualizacaoArtigo($list) ?></small>
                                        </div>
                                        <?php
																				foreach ($list as $group_name => $group) :
																					$horarioAno = explode("-", $group->created);
																					if ($ano != $horarioAno[0]) :
																						$ano = $horarioAno[0];
																						?>
                                        <div class="row report">
                                            <ul>
                                                <li class="titulo"><?php echo $horarioAno[0]; ?></li>
                                                <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                                            </ul>
                                        </div>
                                        <div class="row botoes w100">
                                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>);">
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
                                            <a href="#conteudo" role="button" class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
                                                <div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
                                                IMPRIMIR
                                            </a>
                                            <br>
                                            <table id="tabela_<?= $ano; ?>">

                                                <tbody>
                                                    <?php	
																										$texto = "";
																										foreach ($list as $group_name =>  $listDados) :
																											$horarioAno2 = explode("-", $listDados->created);
																											if ($horarioAno2[0] == $horarioAno[0]) :
																												$texto .= "<tr><td  style='text-align:left;border-bottom: 0px solid  ' >";
																												$texto .=  html_entity_decode($listDados->introtext);
																												$texto .= "</td></tr>";
																												?>
                                                    <?php	endif;
																								endforeach;
																								echo  str_replace("<br />", "", $texto);
																								?>
                                                </tbody>
                                            </table>
                                            <?php 
																						//Aqui conteém o HTML que vai ser trandormado em PDF.

																						$htmlPDF = "<h3>" . $group->category_title . "</h3>";
																						$htmlPDF .= "<h4>" . $ano . "</h4>";
																						$htmlPDF .= "<table  cellspacing=0 cellpadding=5 >
						<tr>
						<th></th>
						</tr>";
																						$htmlPDF .= str_replace("<br />", "", $texto);
																						$htmlPDF .= "</table>";
																						?>
                                            <div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>" /></div>
                                            <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>


                                        </div>
                                        <?php	endif;
																		endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?> 