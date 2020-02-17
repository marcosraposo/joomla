<?php 
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//var_dump($list); die();

?>

<div class="container demonstrativo bg_azul_fundo">
  <div class="row conteudo selecionado responsivo" data-aba-id="1" style="padding-bottom: 20px;">

    <!-- TITULO -->
    <div class="col-12">
      <div class="row">
        <div class="titulo">Notícias</div>
      </div>
      <div class="spacer"></div>
      <div class="row">
        <small>PESQUISAR POR</small>
      </div>

      <!-- FORM CONSULTA -->
      <div class="row">
        <div class="col-12 col-md-3 mb-2">
          <form id="formPesquisa" method="post" class="form-baixa-login">
            <input type="hidden" id="inputLimite" name="limite" value="0">
			<input type="hidden" id="inputPagina" name="pagina" value="12">
			<input type="hidden" id="qtdRegistros" name="qtdRegistros" value="0">
			
            <div class="row">
              <input 
                name="txtTextoPesquisa"
                id="inputPesquisaImprensa" 
                class="a-campo-i6-6 nomarginxs" 
                type="text" 
                placeholder="Palavra, frase ou texto"  
                style="margin-top:0px;">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="row">
              <div class="col-md-6 nopaddingxs" style="padding: 0 5px 0 0;">
                <input 
                  data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy"
                  id="dataInicioNoticia"
                  style="text-align: left; text-align-last: left; margin-top:0px;" 
                  class="mb-2 ic-calendar-3" 
                  name="txtDataInicio" 
                  type="text"
                  placeholder="Data Inicio">
              </div>
              <div class="col-md-6 nopaddingxs" style="padding: 0 0 0 5px;">
                <input 
                  data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy"
                  id="dataFimNoticia"
                  style="text-align: left; text-align-last: left; margin-top:0px;" 
                  class="mb-2 ic-calendar-3" 
                  name="txtDataFim" 
                  type="text"
                  placeholder="Data Fim">
              </div>
            </div>
        </div>
		<div class="col-12 col-md-1">
			<div class="row">
				<div  style="padding: 0 0 0 5px;">
                <input 
				  id="inputPesquisaBotao" 
				  type="button"
				  class="botaoProcurar";
				  value="Procurar">
              </div>
			</div>
		</div>
		
		<div class="col-12 col-md-1">
			<div class="row">
				<div  style="padding: 0 0 0 5px;">
                <input 
				  id="inputBotaoLimpar" 
				  type="button"
				  class="botaoLimparNoticia";
				  value="Limpar">
				</div>
			</div>
		</div>
		
		
		
		
		
		</form>
			
      </div>

      <!-- SELECT - QUANTIDADE POR PAGINA -->
      <!-- <div class="col-12 col-md-6 mb-2 d-flex align-items-center justify-content-end">
        <div class="small text-uppercase">resultados por página</div>
        <form method="post" class="form-baixa-login ajuste-form">
          <div class="row">
            <select class="a-select-6-1" style="margin-top:0px;" name="">
              <option value=""> 18 </option>
              <option value=""> 18 </option>
              <option value=""> 18 </option>
            </select>
          </div>
        </form>
      </div>
      </div>
      <div class="row d-flex justify-content-end">
        <div class="small text-uppercase mt-2">18 de 18216 RESULTADOS</div>
      </div> -->

      <!-- NOTICIAS -->
      <div class="row p-0">
        <div class="col-12 p-0">
          <div class="container_conteudo" id="noticiasContainer">
            <?php foreach($list['listaNoticias'] as $noticia):
			?>
              <a class="box_simples" href="index.php/noticias/leitura-de-noticias?/id=<?= $noticia['id']; ?>" style="text-decoration: none; color: #5776B0">  
                <div class="conteudo_noticias">
                  <div class="titulo lower ml-4" style="margin-top:12px;"><?= $noticia['titulo']; ?></div> 
                  <div class="p-box-noticias-1 ml-4 mr-3 mt-3">
                    <?php echo mb_strimwidth(strip_tags(html_entity_decode($noticia['texto'])), 0, 285, "..."); ?>
                  </div>
                  <div class="box-plus mt-1 mb-2 mr-4">
                    
                  </div>
                  
                </div>
                <img class="conteudo_icone_mais" width="20" src="templates/portalProcessosConsultas/images/plus.svg">
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>   
    </div>
    <br/>
    <br/>
    <div class="row" style="margin: 0 auto;">
      <div class="col-12">
        <button id="buttonLoadMore" class="button-load-more" value="Carregar mais">
          Carregar Mais
        </button>
      </div>
    </div> 

  </div>
  <div class="clearfix"></div>
</div>
