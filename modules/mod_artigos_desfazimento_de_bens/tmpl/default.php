<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

    //Data de atualizacao utiliza o campo Data de Publicacao
    //Caso não tenha nenhum artigo publicado, utilizará a data atual;
    $dataAtualizacao = new DateTime();
    if(isset($list['items'][0]->publish_up) && !empty($list['items'][0]->publish_up)){
        $dataAtualizacao = new DateTime($list['items'][0]->publish_up);
    }
    $dataAtualizacao = $dataAtualizacao->format('d/m/Y');

?>

<div class="container demonstrativo bg_azul_fundo">
    <div class="row conteudo selecionado" data-aba-id="1">
        <div class="col-12">
            <div class="row">
                <div class="titulo">Desfazimento de Bens</div>
            </div>
            <div class="row">
                <small>Última atualização: <?=$dataAtualizacao?></small>
            </div>
            
            <?php 
                rsort($list['anos']);
                foreach ($list['anos'] as $art) : 
                $ano = $art;
            ?>
                <div class="row report">
                    <ul>
                        <li class="titulo"><?= $ano; ?></li>
                        <li class="arrow-down"><a href="#conteudo" role="button"><img src="templates/portalTRF5/images/arrow_down_2.svg" alt="Abrir conteúdo"></a></li>
                    </ul>
                </div>
               
                <div class="row botoes w100">
                    <!--
                    <a href="#conteudo" role="button" class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						PDF
					</a>
					<a href="#conteudo" role="button" class="download"  onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						XML
					</a>
					<a href="#conteudo" role="button" class="download"  onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						CSV
					</a>
					<a href="#conteudo" role="button" class="download" onClick="javascript:imiprimirTabela(<?= $ano; ?>);">
						<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
						IMPRIMIR
                    </a>
                -->
                    <div class="clearfix"></div>
                    <div class="spacer"></div>
                    <div class="spacer"></div>
                    <table  id="tabela_<?= $ano; ?>" >
					<!--<thead>
                        <tr>
                            <th>Data Publicação</th>
                            <th>Data Atualização</th>
                            <th>Documentos</th>
                            <th>Data Final Para Entrega do Pedido de Doação</th>
                            <th>Endereço de Entrega do Pedido de Doação e Documentações de Habilitação</th>
                            <th>Resultado do Aviso</th>
                        </tr>
					</thead>-->
					<tbody>
                        <?php 
						foreach ($list['items'] as $item) : ?>
                            <?php 

                            $anoArtigoValor = new DateTime($item->created);
                            $anoArtigo = $anoArtigoValor->format('Y');

                            if ($ano == $anoArtigo) : ?>
                                <?php 
								$texto = str_replace("<p>", "", $item->introtext);
                                $texto = str_replace("</p>", "", $texto);
								$texto =   html_entity_decode($texto); 
								?>
                            <?php endif; ?>
                        <?php endforeach; 
						 echo $texto;
						?>
						</tbody>
                    </table>
					<?php 
					  //Aqui conteém o HTML que vai ser trandormado em PDF.
					  $htmlPDF = "<h3>".$list['items'][0]->category_title."</h3>";
                      $htmlPDF .= "<table border=1  cellspacing=0 cellpadding=5 >";
                     /*
                      $htmlPDF .= "
							<tr>
                            <th>Data Publicação</th>
                            <th>Data Atualização</th>
                            <th>Documentos</th>
                            <th>Data Final Para Entrega do Pedido de Doação</th>
                            <th>Endereço de Entrega do Pedido de Doação e Documentações de Habilitação</th>
                            <th>Resultado do Aviso</th>
                        </tr>";

                        */
						$htmlPDF .= str_replace("<br />","",$texto);
						$htmlPDF .= "</table>";
					  ?>
					<div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>"/></div>

                    <div class="clearfix"></div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>