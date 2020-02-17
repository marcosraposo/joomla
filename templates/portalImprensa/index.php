
 <style type="text/css">
  .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
    </style>




    <div id="google_translate_element" class="boxTradutor" style="display:none"></div>



    <script type="text/javascript">
    var comboGoogleTradutor = null; 

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'pt',
            includedLanguages: 'en,es,pt',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');

        comboGoogleTradutor = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
    }

    function changeEvent(el) {
        if (el.fireEvent) {
            el.fireEvent('onchange');
        } else {
            var evObj = document.createEvent("HTMLEvents");

            evObj.initEvent("change", false, true);
            el.dispatchEvent(evObj);
        }
    }

    function trocarIdioma(sigla) {
        if (comboGoogleTradutor) {
            comboGoogleTradutor.value = sigla;
            changeEvent(comboGoogleTradutor);//Dispara a troca
        }
    }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>








<?php
/**
 * @package     Portal.Site
 * @subpackage  Templates.portalTRF5
 *
 * @copyright   Copyright (C) 2018 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

$path    = $this->baseurl."/templates/".$this->template;
$pathCSS = $path."/css/";
$pathJS  = $path."/javascript/";
$pathIMG = $path."/images/";

// No direct access.
defined('_JEXEC') or die; ?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Portal TRF5 - Imprensa</title>
	<link rel="icon" href="<?= $path; ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?= $path; ?>/favicon.ico" type="image/x-icon" />
    <link href="<?= $pathCSS; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>owl.carousel.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>owl.theme.default.min.css" rel="stylesheet">
    <link href="<?= $pathCSS; ?>template.css" rel="stylesheet">
    <!-- <link href="<?php //$pathCSS; ?>style.css" rel="stylesheet"> -->
  </head>
    
  <body>    
    <div class="headermenu mobileonly">
      <a href="index.php">
        <img class="logo" src="<?php echo $pathIMG; ?>logo.svg" alt="Tribunal Regional Federal 5ª Região">
      </a>
      <img class="togglemobilemenu hamburger" src="<?= $pathIMG; ?>harmburger.svg">
      <div class="clearfix"></div>
    </div>
    <div class="headermenucontent">
        <img class="togglemobilemenu close_menu" src="<?= $pathIMG; ?>close_menu.svg">
        <div class="itens"> 
            <!-- MENU PRINCIPAL -->
            <jdoc:include type="modules" name="menuPrincipal" style="none" />
            <li> 
              <div class="inner-addon"> 
                <i class="fa fa-search" aria-hidden="true"></i>
                <input type="text" class="form-control inputPesquisaHome" placeholder="Consultar por" />
              </div>
            </li>
            <li><a href="index.php/ouvidoria" style="color:#5776B0; text-decoration:none; ">SIC – Serviço de Informação ao Cidadão</a></li>
        </div>
    </div> 
    <div class="container hidemobile">
      <div class="row topo">
          <div class="col-6 links">
            <a href="http://www.jfal.jus.br/" target="_blank"><span class="botao">JFAL&nbsp;&nbsp;</span></a>
            <a href="http://www.jfce.jus.br/" target="_blank"><span class="botao">JFCE&nbsp;&nbsp;</span></a>
            <a href="http://www.jfpb.jus.br/" target="_blank"><span class="botao">JFPB&nbsp;&nbsp;</span></a>
            <a href="http://www.jfpe.jus.br/" target="_blank"><span class="botao">JFPE&nbsp;&nbsp;</span></a>
            <a href="http://www.jfrn.jus.br/" target="_blank"><span class="botao">JFRN&nbsp;&nbsp;</span></a>
            <a href="http://www.jfse.jus.br/" target="_blank"><span class="botao">JFSE&nbsp;&nbsp;</span></a>
          </div>
          <div class="col-md-6 text-right acessibilidade">
            <a href="http://www.vlibras.gov.br" target="_blank"><span>libras</span></a>
            <img class="btnFontMais" src="<?= $pathIMG; ?>acessibilidade_ap.svg" alt="Aumentar a letra">
            <img class="btnFontMenos" src="<?= $pathIMG; ?>acessibilidade_am.svg" alt="Diminuir a letra">
            <img class="btnDaltonismo" src="<?= $pathIMG; ?>acessibilidade_c.svg" alt="Contraste">
            <img class="btnVoltarNormal" src="<?= $pathIMG; ?>acessibilidade_back.svg" alt="Voltar ao Normal"> 
            <img class="btnTradutor" src="<?= $pathIMG; ?>acessibilidade_t.svg" title="Tradutor">
        </div>
    </div>
    <div id="barraIdiomas" class="hidemobile" style="display:none; margin-right:9px ; font-size: 10px; text-align: end;">
       <a href="javascript:trocarIdioma('en')">Inglês</a> / 
       <a href="javascript:trocarIdioma('es')">Espanhol</a> / 
       <a href="javascript:trocarIdioma('pt')">Português</a>
       <br>A tradução não é de responsabilidade do TRF5.
   </div>
</div>   


<div id="fixado" class="hidemobile">
  <div class="container">
        <div class="row menu">
          <div class="col-2">
          <a href="index.php"><img src="<?php echo $pathIMG; ?>logo.svg"></a>
          </div>
          <div class="col-10">
            <ul class="list-inline">
              <!-- MENU PRINCIPAL -->
              <jdoc:include type="modules" name="menuPrincipal" style="none" />
              <li class="botao list-inline-item"><a href="index.php/ouvidoria" style="color:#FFF; text-decoration:none; ">SIC – Serviço de Informação ao Cidadão</a></li>
            </ul>              
          </div>          
        </div>          
      </div>
    </div>

    <!-- ITENS DO MENU PROCESSOS E CONSULTAS -->
    <div class="row menu_exp" data-menu="3">      
      <div class="container">
          <jdoc:include type="modules" name="menuItemImprensa" style="none" />
      </div>
      <div class="clearfix"></div>
    </div>

    <!-- BREADCRUMB -->
    <div class="container">
      <div class="row pagina">
        <div class="col-10 navigation">
          <jdoc:include type="modules" name="position-1" style="none" />
        </div>
        <div class="col-2 buscafield">
          <div class="inner-addon">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" class="form-control inputPesquisaHomeWeb" placeholder="Consultar por"/>
          </div>
        </div>
      </div>
    </div>

    <?php if (
      strpos($_SERVER ['REQUEST_URI'], "imprensa-home") != false ||
      strpos($_SERVER ['REQUEST_URI'], "imprensa") != false 
    ): ?>

      <!-- MENU MID IMPRENSA -->
      <div class="menu_expandido">
        <div class="container">
          <jdoc:include type="modules" name="midMenuImprensa" style="none" />
        <div class="clearfix"></div>
        </div>
      </div>
    <?php else: ?>
      <div class="container">
        <jdoc:include type="component"/>
      </div>
    <?php endif; ?>

    <!-- MODULO DE NOTICIAS BANNER -->
    <jdoc:include type="modules" name="modNoticiasBanner" style="none" />

    <!-- MODULO DE ULTIMAS NOTICIAS -->
    <jdoc:include type="modules" name="modNoticias" style="none" />

    <!-- ULTIMAS NOTICIAS -->
    <div class="container">
      <jdoc:include type="modules" name="noticias" style="none" />
    </div>

    <div class="footer">
        <div class="container">
            <img class="fixadorodape" src="<?= $pathIMG; ?>scroll.png" class="scrolltop" alt="Subir para o topo">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="row" style="position: relative;">
                        <div class="box fullwidth h158 align-self-center" style="position: relative">
                            <div class="icone icone_azul textoInferiorAcessecibilidade" style="position: absolute; top: -35px; left: calc(50% - 80px);"><img src="<?= $pathIMG; ?>acessibilidade_icones.png"></div>
                            Este site é preparado para<br>
                            pessoas com deficiências<br>
                            visual e auditiva<br>
                            <div class="acessibilidade">
                                <a href="http://www.vlibras.gov.br" target="_blank"><span>libras</span></a>
                                <img class="botao btnFontMais" src="<?= $pathIMG; ?>a-1.svg" alt="Aumentar a letra">
                                <img class="botao btnFontMenos" src="<?= $pathIMG; ?>a-2.svg" alt="Diminuir a letra">
                                <img class="botao btnDaltonismo" src="<?= $pathIMG; ?>a-3.svg" alt="Contraste">
                                <img class="botao btnVoltarNormal" src="<?= $pathIMG; ?>a-4.svg" alt="Voltar ao Normal">
                                <img class="botao btnTradutor" src="<?= $pathIMG; ?>a-5.svg">
							  <div id="barraIdiomasInferior" class="hidemobile" style="display:none; color: #fff; margin-right:9px ; font-size: 10px; ">
								<a style="color:#ffffff" href="javascript:trocarIdioma('en')">Inglês</a> / 
								<a style="color:#ffffff" href="javascript:trocarIdioma('es')">Espanhol</a> / 
								<a style="color:#ffffff" href="javascript:trocarIdioma('pt')">Português</a>
								<br>A tradução não é de responsabilidade do TRF5.
							  </div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="row">
                        <div class="box links h72 c4" style="position: relative">
                            <div class="titulo_links_footer" style="position: absolute; top: -10px; left: calc(50% - 100px);">Acessos diretos</div>
                            <a href="http://www.jfal.jus.br/" target="_blank"><span class="botao" style='color:#ffffff'>JFAL&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfce.jus.br/" target="_blank"><span class="botao" style='color:#ffffff'>JFCE&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfpb.jus.br/" target="_blank"><span class="botao" style='color:#ffffff'>JFPB&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfpe.jus.br/" target="_blank"><span class="botao" style='color:#ffffff'>JFPE&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfrn.jus.br/" target="_blank"><span class="botao" style='color:#ffffff'>JFRN&nbsp;&nbsp;</span></a>
                            <a href="http://www.jfse.jus.br/" target="_blank"><span class="botao" style='color:#ffffff'>JFSE&nbsp;&nbsp;</span></a>
                            <div class="clearfix"></div>
                        </div>
                        <a class="botao box small links c1" style="font-weigth:bold; font-size:25px; text-decoration: none;" target="_blank" href="https://sei.trf5.jus.br/">sei!</a>
                        <a class="botao box small links c1 white" style="text-decoration: none;" target="_blank" href="https://www4.trf5.jus.br/eventosinternet/">
                            <div class="icone_small"><img src="<?= $pathIMG; ?>icone_star.svg"></div>
                            <div>Eventos<br><span class="small">TRF5</span></div>
                        </a>
                    </div>
                    <div class="row">
                        <a class="botao box small c1 h72" target="_blank" href="https://www2.trf5.jus.br/ccheque/views/login.php">RECURSOS HUMANOS</a>
                        <a class="botao box small c1 h72" target="_blank" href="https://www5.trf5.jus.br/noticias/rss-portal-completas.php">ASSINE <br>NOSSO RSS</a>
                        <a class="botao box small c1 h72"  href="index.php/jornal-mural">JORNAL MURAL <br>DIARIO</a>
                        <a class="botao box small c1 h72" target="_blank" href="https://www4.trf5.jus.br/julia/entrar">JULIA</a>
                        <a class="botao box small c2 white" target="_blank" href="https://www4.trf5.jus.br/portal-bi/login.html">PORTAL BUSINESS INTELLIGENCE</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <a class="botao box small sic white" href="index.php/ouvidoria">SIC – Serviço de Informação ao Cidadão</a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="row">
                        <a class="botao box small h40" href="https://webmail.trf5.jus.br" target="_blank">
							<div class="icone_small"><img src="<?= $pathIMG; ?>mail.svg"></div>
							webmail
						</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="row footerlogo">
                    <img src="<?= $pathIMG; ?>trf5.svg" alt="Tribunal Regional Federal 5ª Região">
                    <div class="mapadosite">Mapa do site</div>
                </div>
            </div>
        </div>
        <div class="row negative-margin">
            <div class="col-9">
                <div class="address">
                    <strong>
                        Cais do Apolo, s/n - Edifício Ministro Djaci Falcão
                        <br>Bairro do Recife - Recife - PE
                    </strong>
                    <br>CEP: 50030-908 | CNPJ:24.130.072/0001-11
                    <br><strong>Horário de Atendimento: </strong> Das 09h às 18h.
                </div>
                <div class="address">
                    <strong>PABX: </strong><small>81</small> 3425.9000<br>
                    <strong>Protocolo: </strong><small>81</small> 3425.9550<br>
                    <strong>FAX: </strong><small>81</small> 3425.9952 | 53 | 54<br>
                </div>
                <div class="social">
                    <a href="https://pt-br.facebook.com/pages/Tribunal-Regional-Federal-da-5%C2%AA-Regi%C3%A3o-TRF5/190892010955333" target="_blank">
                        <img src="<?= $pathIMG; ?>facebook.svg" alt="facebook">
                    </a>
                    <a href="http://twitter.com/TRF5_oficial" target="_blank">
                        <img src="<?= $pathIMG; ?>twitter.svg" alt="twitter">
                    </a>
					<a href="https://www.instagram.com/trf5_oficial/" target="_blank">
                        <img src="<?= $pathIMG; ?>instagram.png" alt="Instagram" style="max-width: 34px">
                    </a>
                    <a href="https://www.youtube.com/TRF5Regiao" target="_blank">
                        <img src="<?= $pathIMG; ?>youTube.png" alt="Youtube" >
                    </a>
                    <a href="http://www.trf5.jus.br/noticias/rss-portal-completas.php" target="_blank">
                        <img src="<?= $pathIMG; ?>feed.svg"  alt="Notícias">    
                    </a>
                </div>
            </div>
        </div>
    </div>

	</div>
    <div class="mapadosite_conteudo">
        <div class="fecha_mapa">
            <img src="<?= $pathIMG; ?>fecha_mapa.png">
        </div>
        <div class="box">Mapa do site</div>
        <div class="superior">
            <ul>
				<a href="index.php/institucional-home">
					<li class="titulo">INSTITUCIONAL</li>
				</a>
                <a href="index.php/biblioteca-home">
                    <li>Biblioteca</li>
                </a>
                <a href="index.php/feriados">
                    <li>Feriados</li>
                </a>
                <a href="#">
                    <li>Competência e Composição</li>
                </a>
                <a href="index.php/portal-dos-servicos-publicos/administrativo-tela/conselho-de-administracao#container">
                    <li>Conselho de Administração</li>
                </a>
                <a href="index.php/corregedoria">
                    <li>Corregedoria</li>
                </a>
                <a href="https://ead.trf5.jus.br/login/index.php"  target="_blank">
                    <li>Ensino a Distância - Portal EAD</li>
                </a>
                <a href="index.php/esmafe-land">
                    <li>ESMAFE</li>
                </a>
                <a href="#">
                    <li>Comitê Gestor do Cód. de Conduta (5ª Região)</li>
                </a>
                <a href="index.php/ouvidoria">
                    <li>Fale com o Presidente</li>
                </a>
                <a href="index.php/gabinete-de-conciliacao">
                    <li>Gabinete de Conciliação</li>
                </a>
                <a href="index.php/gabinete-da-revista">
                    <li>Gabinete de Revista</li>
                </a>
                <a href="index.php/gestao-estrategica">
                    <li>Gestão Estratégica</li>
                </a>
                <a href="http://govti.trf5.jus.br/" target="_blank">
                    <li>Governança de TI</li>
                </a>
                <a href="http://www5.trf5.jus.br/jurisdicao/" target="_blank">
                    <li>Jurisdição</li>
                </a>
                <a href="#">
                    <li>Lista Telefônica</li>
                </a>
                <a href="#">
                    <li>Lista de Diretores</li>
                </a>
                <a href="#">
                    <li>Memória</li>
                </a>
                <a href="index.php/gestao-socio-ambiental">
                    <li>Responsabilidade Social</li>
                </a>
                <a href="#">
                    <li>Organograma de Atribuições</li>
                </a>
                <a href="index.php/trf5-sustentavel">
                    <li>TRF5 Sustentável</li>
                </a>
                <a href="https://www4.trf5.jus.br/controleinspecao/"  target="_blank">
                    <li>Inspeção no TRF5 2018</li>
                </a>
            </ul>

            <ul>
                <a href="index.php/portal-dos-servicos-publicos3">
                    <li class="titulo">SERVIÇOS</li>
                </a>
                <a href="https://www4.trf5.jus.br/baixa-eletronica/" target="_blank">
                    <li>Baixa Eletrônica</li>
                </a>
                <a href="http://www5.trf5.jus.br/validar_assinatura/" target="_blank">
                    <li>Autenticidade de Documentos</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/atas-de-registro-de-preco" target="_blank">
                    <li>Atas de Distribuição - Processos Físicos</li>
                </a>
                <a href="https://www4.trf5.jus.br/custasinternet/" target="_blank">
                    <li>Cálculos de Custas</li>
                </a>
                <a href="https://www4.trf5.jus.br/certidoes/" target="_blank">
                    <li>Certidão Negat. Distri./Eleitoral/Penal</li>
                </a>
                <a href="http://www5.trf5.jus.br/pautas_julgamento/" target="_blank">
                    <li>Consulta Pautas de Julgamento - Processos Físicos</li>
                </a>
                <a href="index.php/portal-dos-servicos-publicos/tela-processos-fisicos/editais-de-eliminacao-2">
                    <li>Editais de Eliminação</li>
                </a>
                <a href="http://www5.trf5.jus.br/rpvprecatorio/" target="_blank">
                    <li>Consulta RPV/Precatório</li>
                </a>
                <a href="index.php/portal-dos-servicos-publicos/tela-judiciais/estatisticas-3">
                    <li>Estatísticas</li>
                </a>
                <a href="https://www4.trf5.jus.br/InteiroTeor/" target="_blank">
                    <li>Consulta Inteiro Teor</li>
                </a>
                <a href="https://www4.trf5.jus.br/temis/login.jsf" target="_blank">
                    <li>Consulta de Transação e Suspensão Penal</li>
                </a>
                <a href="http://jef.trf5.jus.br/home/home.php" target="_blank">
                    <li>Juizados Federais - Portal dos JEFs</li>
                </a>
                <a href="https://www4.trf5.jus.br/Jurisprudencia/" target="_blank">
                    <li>Consulta Jurisprudência</li>
                </a>
                <a href="https://www4.trf5.jus.br/processos-sobrestados/" target="_blank">
                    <li>NUGEP – Processos Sobrestados</li>
                </a>
                <a href="https://www4.trf5.jus.br/diarioeletinternet/" target="_blank">
                    <li>Diário Eletrônico da JF 5ª Região</li>
                </a>
                <a href="index.php/escala-do-plantao-judiciario">
                    <li>Plantão da Judiciária</li>
                </a>
                <a href="index.php/portal-dos-servicos-publicos/tela-judiciais/quero-conciliar-2">
                    <li>Quero Conciliar!</li>
                </a>
                <a href="https://pje.trf5.jus.br/pje/ConsultaPublica/listView.seam" target="_blank">
                    <li>Processo Judicial Eletrônico</li>
                </a>
                <a href="https://www4.trf5.jus.br/sustentacao-oral/login.html" target="_blank">
                    <li>Sustentação Oral por Videoconferência</li>
                </a>
                <a href="https://www4.trf5.jus.br/TRF5_Push/" target="_blank">
                    <li>TRF5 Push</li>
                </a>
                <a href="http://jef.trf5.jus.br/jurisprudencia/jurisprudencia.php" target="_blank">
                    <li>Turma Regional – JEF</li>
                </a>
                <a href="#">
                    <li>Portaria 35/2017, TRF5</li>
                </a>
            </ul>

            <ul>
                <li class="titulo">PUBLICAÇÕES</li>
                <a href="#">
                    <li>Planos de Autidoria</li>
                </a>
                <a href="index.php/jurisdicao-publicacoes">
                    <li>Boletins de Jurisprudência</li>
                </a>
                <a href="https://www4.trf5.jus.br/diarioeletinternet/" target="_blank">
                    <li>Diário Eletrônico da JF 5ª Região</li>
                </a>
                <a href="index.php/jurisdicao-publicacoes">
                    <li>Revistas de Jurisprudência</li>
                </a>
                <a href="index.php/revista-esmafe">
                    <li>Revistas da ESMAFE</li>
                </a>
                <li>&nbsp;</li>
                <a href="index.php/legislacao-home">
                    <li class="titulo">LEGISLAÇÃO</li>
                </a>
                <a href="index.php/legislacao-home">
                    <li>Regimento Interno</li>
                </a>
                <a href="index.php/legislacao-home">
                    <li>Legislação - Busca por Tipo</li>
                </a>
                <a href="index.php/legislacao-home">
                    <li>Portarias da Corregedoria-Geral do CJF</li>
                </a>
                <a href="index.php/legislacao-home">
                    <li>Resoluções do CJF</li>
                </a>
                <a href="index.php/legislacao-home">
                    <li>Súmulas</li>
                </a>
                <a href="index.php/legislacao-home">
                    <li>Resoluções do Conselho de Administração</li>
                </a>
                <li>&nbsp;</li>
                <a href="index.php/jurisprudencia-home" target="_blank">
                    <li class="titulo">JURISPRUDÊNCIA</li>
                </a>
                <a href="https://www4.trf5.jus.br/Jurisprudencia/" target="_blank">
                    <li>Jurisprudência TRF 5ª Região</li>
                </a>
                <a href="index.php/arguicao">
                    <li>Arguição de Inconstitucionalidade</li>
                </a>
                <a href="http://jef.trf5.jus.br/jurisprudencia/jurisprudencia.php" target="_blank">
                    <li>Jurisprudência Turmas Recursais 5ª Região</li>
                </a>
                <a href="index.php/uniformizacao">
                    <li>Uniformização de Jurisprudência</li>
                </a>
                <a href="index.php/julgados-escolhidos">
                    <li>Julgados Escolhidos</li>
                </a>
                <a href="https://www4.trf5.jus.br/irdr/paginas/publico.xhtml" target="_blank">
                    <li>IRDR’s</li>
                </a>
            </ul>

            <ul>
                <a href="index.php/portal-transparencia">
                    <li class="titulo">PORTAL DA TRANSPARÊNCIA</li>
                </a>
                <a href="index.php/convenios-e-acordos/termos-de-cooperacao-compromisso-e-parceria">
                    <li>Acordos, Termos e Convênios</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/atas-de-registro-de-preco#abaAdesao">
                    <li>Adesões às Atas de Registros de Preços</li>
                </a>
                <a href="index.php/gestao-patrimonial">
                    <li>Administração Patrimonial de Bens Móveis</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/atas-de-registro-de-preco">
                    <li>Atas de Registro de Preços</li>
                </a>
                <a href="index.php/gestao-de-pessoas/atividades-de-docencia-dos-magistrados">
                    <li>Atividades de Docência dos Magistrados</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/banco-de-termos-de-referencia">
                    <li>Banco de Termos de Referência</li>
                </a>
                <a href="http://www4.trf5.jus.br/contratos_web/" target="_blank">
                    <li>Consulta de Contratos</li>
                </a>
                <a href="https://www4.trf5.jus.br/temis/TemisHelp.htm"  target="_blank">
                    <li>Consulta Transação e Suspensão Penal</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/contratacoes-diretas">
                    <li>Contratações Diretas</li>
                </a>
                <a href="index.php/convenios-e-acordos">
                    <li>Convênios</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/cotacao-eletronica">
                    <li>Cotações Eletrônicas</li>
                </a>
                <a href="index.php/gestao-patrimonial/desfazimento-de-bens">
                    <li>Desfazimento de Bens</li>
                </a>
                <a href="#">
                    <li>Justiça Criminal</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/licitacoes">
                    <li>Licitações</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/participacoes-do-trf5-em-licitacoes-de-outros-orgaos">
                    <li>Participações do TRF5 em licitações de outros Órgãos</li>
                </a>
                <a href="index.php/portal-transparencia">
                    <li>Portal da Transparência</li>
                </a>
                <a href="index.php/licitacoes-e-contratos/processos-de-aplicacao-de-penalidades">
                    <li>Processos de Aplicação de Penalidades</li>
                </a>
                <a href="index.php/gestao-patrimonial/relacao-de-imoveis">
                    <li>Relação de Imóveis</li>
                </a>
                <a href="index.php/gestao-patrimonial/relacao-de-obras-reformas-em-execucao">
                    <li>Relação de Obras/Reformas</li>
                </a>
                <a href="index.php/gestao-orcamentaria/gestao-demonstrativos-e-relatorios">
                    <li>Relatórios de Gestão</li>
                </a>
                <a href="index.php/gestao-orcamentaria/gestao-demonstrativos-e-relatorios">
                    <li>Relatórios de Gestão Fiscal</li>
                </a>
                <a href="index.php/ouvidoria">
                    <li>SIC – Serviço de Informação ao Cidadão</li>
                </a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="inferior">
            <ul>
                <a href="index.php/imprensa-home">
                    <li class="titulo">IMPRENSA</li>
                </a>
                <a href="index.php/banco-de-imagens">
                    <li>Banco de Imagens</li>
                </a>
                <a href="index.php/assessoria-de-imprensa">
                    <li>Contatos</li>
                </a>
                <a href="index.php/jornal-mural">
                    <li>Jornal Mural TRF</li>
                </a>
                <a href="index.php/noticias">
                    <li>Notícias</li>
                </a>
                <a href="index.php/projetos-especiais">
                    <li>Projetos Especiais</li>
                </a>
                <a href="index.php/revista-argumento">
                    <li>Revista Argumento</li>
                </a>
            </ul>

            <ul>
                <a href="index.php/concursos-selecoes">
                    <li class="titulo">CONCURSOS E SELEÇÕES</li>
                </a>
                <a href="index.php/estagiarios">
                    <li>Estagiários</li>
                </a>
                <a href="index.php/magistrados">
                    <li>Magistrados</li>
                </a>
                <a href="#">
                    <li>Magistrados – CNJ e CNMP</li>
                </a>
                <a href="index.php/servidores-e-nomeacoes">
                    <li>Servidores</li>
                </a>
                <a href="index.php/selecoes">
                    <li>Seleções</li>
                </a>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <script src="<?= $pathJS; ?>jquery-3.3.1.min.js" ></script>    
    <!-- <script src="<?php //$pathJS; ?>tether.min.js"></script> -->
    <script src="<?= $pathJS; ?>bootstrap.min.js"></script>
    <script src="<?= $pathJS; ?>ie10-viewport-bug-workaround.js"></script>
    <!-- <script src="<?php //$pathJS; ?>tether.js?v=3"></script>   -->
    <script src="<?= $pathJS; ?>owl.carousel.min.js"></script>   
    <script src="<?= $pathJS; ?>custom.js?v=3"></script>
    <script src="<?= $pathJS; ?>jquery.inputmask.js"></script>
    <script src="<?= $pathJS; ?>noticias.js"></script>
    <script src="<?= $pathJS; ?>bancoImagens.js"></script>
    <script src="<?= $pathJS; ?>buscaGeral.js"></script>
	<script src="<?= $pathJS; ?>acessibilidade.js"></script>
    <script>
     $(document).ready(function(){

      $("#dataInicioNoticia").inputmask("dd/mm/yyyy");
      $("#dataFimNoticia").inputmask("dd/mm/yyyy");


      $(window).scroll(function(){
        var sticky = $('#fixado'),
            scroll = $(window).scrollTop();
        if (scroll >= 100) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
      });
      var anti_bounce_fix ;
      $(window).scroll(function(){
        var sticky = $('.fixadorodape'),
            scroll = $(window).scrollTop();
        var stop = $(document).height() - $('.footer').height() - $(window).height();
        if (scroll >= 100 && scroll < stop) {
          sticky.addClass('fixed_rodape');
        }else{          
          sticky.removeClass('fixed_rodape');
        }        
      });      
     });
    </script>
  </body>
</html>
