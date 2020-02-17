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
        <div class="titulo">Relação de Obras/Reformas em Execução no TRF5</div>
      </div>
      <div class="row">
        <small>Última atualização: <?=$dataAtualizacao?></small>
      </div>

      <?php 
      rsort($list['anos']);
      foreach ($list['anos'] as $art) : ?>
        <?php 
            $ano = $art;
        ?>

        <div class="row report">
          <ul>
            <li class="titulo"><?= $ano; ?></li>
            <li class="arrow-down"><img src="templates/portalTRF5/images/arrow_down_2.svg" width="34"></li>
          </ul>
        </div>
        <div class="row botoes w100">
          <div class="download" onClick="javascript:baixarPDF(<?= $ano; ?>, 'pdf');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						PDF
					</div>
					<div class="download"  onClick="javascript:baixarDocumento(<?= $ano; ?>, 'xml');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						XML
					</div>
					<div class="download"  onClick="javascript:baixarDocumento(<?= $ano; ?>, 'csv');">
						<div class="icone"><img src="templates/portalTRF5/images/download.svg"></div>
						CSV
					</div>
					<div class="download" onClick="javascript:baixarDocumento('tabela_export_<?= $ano; ?>', 'export', '', this);">
						<div class="icone"><img src="templates/portalTRF5/images/impressora.svg"></div>
						IMPRIMIR
		   </div>
          <div class="clearfix"></div>
          <div class="spacer"></div>
          <div class="spacer"></div>
          <table id="tabela_<?= $ano; ?>" >
		  <thead>
            <tr>
              <th>Obra/Reforma</th>
              <th>Objeto</th>
              <th>Processo</th>
              <th>Pregão</th>
              <th>Contrato</th>
              <th>Valor</th>
              <th>Contratada</th>
              <th>CNPJ</th>
              <th>Tipo</th>
              <th>Executado</th>
              <th>Situação</th>
            </tr>
			</thead>
			<tbody>
            <?php
				  $texto = "";			
				  foreach ($list['items'] as $item) : 
                  $anoArtigoValor = new DateTime($item->created);
                  $anoArtigo = $anoArtigoValor->format('Y');

                  if ($ano == $anoArtigo) : ?>
                       <?php 
							$texto = str_replace("<p>", "", $item->introtext);
                            $texto = str_replace("</p>", "", $texto);
							$texto =   html_entity_decode($texto); 
						?>
                      <?php echo html_entity_decode($texto); ?>
                  <?php endif; ?>
              <?php endforeach; ?>
			</tbody> 
          </table> 
		  <?php 
		  //Aqui conteém o HTML que vai ser trandormado em PDF.
			$htmlPDF = "<h3>".$list['items'][0]->category_title."</h3>";
			$htmlPDF .= "<table border='1'>
				    <tr>
				      <th>Obra/Reforma</th>
				      <th>Objeto</th>
				      <th>Precesso</th>
				      <th>Pregão</th>
				      <th>Contrato</th>
				      <th>Valor</th>
				      <th>Contratada</th>
				      <th>CNPJ</th>
				      <th>Tipo</th>
				      <th>Executado</th>
				      <th>Situação</th>
				    </tr>";
			$htmlPDF .= $texto;
			$htmlPDF .= "</table>"; ?>
		  <div style="display:none;"><input type="text" id="table_<?= $ano; ?>" value="<?php echo urlencode($htmlPDF); ?>"/></div>
            <div style="display:none;" id="tabela_export_<?= $ano; ?>"><?php echo $htmlPDF; ?></div>
			<div class="clearfix"></div>
        </div>

      <?php endforeach; ?>

    </div>
  </div>
</div>



